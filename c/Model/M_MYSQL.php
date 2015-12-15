<?php

// Помощник работы с БД

class M_MYSQL
{
    // Настройки подключения к БД.
	private static $instance;
	private $hostname = 'localhost';
	private $username = 'root';
	private $password = '';
	private $dbName = 'first_framework';
  protected $link;

    // SINGLETON
    public static function Instance()
    {
    	if (self::$instance === null) {
    		self::$instance = new self();
    	}
    	return self::$instance;
    }

	private function __construct()
	{
	    // Подключение к БД
	    $link = mysqli_connect($this->hostname, $this->username, $this->password);
	    $db = mysqli_select_db($link, $this->dbName);
	    // Создание БД, таблицы и заполнение таблицы
	    if(!$db) {
	        mysqli_select_db($link, $this->dbName) or die('No data base');
	    }
	    mysqli_query($link, 'SET NAMES utf8');
	    mysqli_set_charset($link, 'utf8');
	    $this->link = $link;
	}

	/** Выборка строк
		@var $query - полный текст SQL запроса
		@result array - массив полученных строк из БД
	*/
	public function select($query)
	{
		$result = mysqli_query($this->link, $query);
		if (!$result) {
			die(mysqli_error($this->link));
		}
		$arr = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$arr[] = $row;
		}
		return $arr;
	}

	/**
		@var $table - имя таблицы
		@var $object - массив, ключи - имена столбцов, значение - данные в базу
		@return int id вставленной записи
	*/
	public function insert($table, $object)
	{
		$columns = array();
		$values = array();

		foreach($object as $key => $value) {
			$key = mysqli_escape_string($this->link, $key . '');
			$columns[] = "`$key`";
			if ($value === null) {
				$values[] = 'NULL';
			} else {
				$value = mysqli_escape_string($this->link, $value . '');
				$values[] = "'$value'";
			}
		}
		// INSERT INTO `table` (`col1`, `col2`, `col3`) VALUES ('val1', 'val2', 'val3')
		$columns = implode(', ', $columns);
		$values = implode(', ', $values);

		$query = sprintf("INSERT INTO `%s` (%s) VALUES (%s)", $table, $columns, $values);
		$result = mysqli_query($this->link, $query);
		if (!$result) {
			die(mysqli_error($this->link));
		}
		return mysqli_insert_id($this->link);
	}

	/**
		@var $table - имя таблицы
		@var $object - массив, ключи - имена столбцов, значение - данные в базу
		@var $where - условие (часть SQL запроса)
		@return int кол-во затронутых строк
	*/
	public function update($table, $object, $where)
	{
		$sets = array();
		foreach ($object as $key => $value) {
			$key = mysqli_escape_string($this->link, $key . '');
			if ($value === null) {
				$sets[] = "`$key`=NULL";
			} else {
				$value = mysqli_escape_string($this->link, $value . '');
				$sets[] = "`$key`='$value'";
			}
		}
		$sets = implode(', ', $sets);
		$query = sprintf("UPDATE `%s` SET %s WHERE %s", $table, $sets, $where);
		$result = mysqli_query($this->link, $query);
		if (!$result) {
			die(mysqli_error($this->link));
		}
		return mysqli_affected_rows($this->link);
		// UPDATE `table` SET `col1` = 'val1', `col2` = 'val2'
	}

	/**
		@var $table - имя таблицы
		@var @where - строка вида первичный ключ = число
		@return int количество удаленных строк
	*/
	public function delete($table, $where)
	{
		$query = sprintf("DELETE FROM %s WHERE %s", $table, $where);
		$result = mysqli_query($this->link, $query);
		if (!$result) {
			die(mysqli_error($this->link));
		}
		return mysqli_affected_rows($this->link);
	}

	public function articles_count()
	{
		$query = "SELECT COUNT(*) AS `count` FROM Articles";

		// Выполнение запроса
		$result = mysqli_query($this->link, $query);

		if (!$result) {
			die(mysqli_error($this->link));
		}

		// извлекаем из БД данные
		$array = array();
		while($row = mysqli_fetch_assoc($result))
			$array[] = $row;

		return $array['0']['count'];
	}

// экранирование переменных
	public function sql_escape($param)
	{
		return mysqli_escape_string($this->link, $param);
	}

	/**
	@var $table - имя таблицы
	@var @where - строка вида первичный ключ = число
	@return int количество удаленных строк
	 */
	public function select_article($table, $where)
	{
		$query = sprintf("SELECT * FROM %s WHERE %s", $table, $where);
		$result = mysqli_query($this->link, $query);
		if (!$result) {
			die(mysqli_error($this->link));
		}

		// извлекаем из БД данные
		$array = array();
		while($row = mysqli_fetch_assoc($result)){
			$array[] = $row;
		}

		return array($array);
	}

//	public function select_comm($where)
//	{
//		$query=sprintf("SELECT * FROM Comments, (SELECT name FROM Articles WHERE %s) as D WHERE Comments.name_art= D.name", $where);
////		$query=sprintf("SELECT name FROM lesson2 WHERE %s", $where);
//		$result = mysqli_query($this->link, $query);
//		if (!$result) {
//			die(mysqli_error($this->link));
//		}
//
//		// извлекаем из БД данные
//		$array = array();
//		while($row = mysqli_fetch_assoc($result)){
//			$array[] = $row;
//		}
////		var_dump($array);
//		return array($array);
//
//
//	}



}






