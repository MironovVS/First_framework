<?php

require_once('c/Model/M_MYSQL.php');



class M_Articles
{
	// ссылка на экземпляр класса
	private static $instance;

	// ссылка на драйвер
	private $mysql;

	private function __construct()
	{
		$this->mysql = M_MYSQL::Instance();
}

	// получение единственного экземпляра класса
	public static function Instance()
	{
		// гарантия одного экземпляра
		if (self::$instance === null) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	// общие методы для всех моделей
	public function All_main($sub, $page, $count)
	{

		$sub = (int)$sub;       // кол-во символов которое требуется вернуть
		$page = (int)$page;     // номер страницы

		// Постраничная навигация

		$page = !empty($page) ? $page : 1;
		$offset = ($page-1) * $count;

		$query = "SELECT `id`, `name`, `date`, SUBSTRING(`content`, 1, '$sub') AS `content` FROM `Articles` ORDER BY `id` DESC LIMIT $offset, $count";
		return $this->mysql->select($query);

	}

	public function All($table)
	{
		$query = "SELECT * FROM $table";
		return $this->mysql->select($query);
	}

	// получить последние 10 записей
	public function latests()
	{

	}

	public function Intro($content)
	{

	}

	public function Get()
	{
		// Подготовка
		$id=(int)$_GET['id'];
		if (!$id) {
			die("Не верный id");
		}

				return $this->mysql->select_article('Articles', 'id='.$id);

	}

	function article_new($name, $date, $content)
	{
		// Подготовка
		$name = trim($name);
		$content = trim($content);
		$date = trim($date);

		//Безопасность данных от иньекций
		$name =M_MYSQL::Instance()->sql_escape($name);
		$content = M_MYSQL::Instance()->sql_escape($content);
		$date= M_MYSQL::Instance()->sql_escape($date);

		// Проверка
		if ($name == '') {
			return false;
		}

		return $this->mysql->insert('Articles', array('date'=>$date, 'name'=>$name, 'content'=>$content));
	}

//	public function Get_comm()
//	{
//		// Подготовка
//		$id=(int)$_GET['id'];
//		if (!$id) {
//			die("Не верный id");
//		}
//
//		return $this->mysql->select_comm('id='.$id);
//
//
//	}

}