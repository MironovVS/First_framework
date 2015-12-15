<?php

require_once('c/Model/M_Articles.php');

class C_Editor extends C_Base {

  public $title_art = "";
  public $content_art = "";
  public $error = false;

  //Посмотр всех статей
  public function action_list() {

    // Подготовка данных
    $articles_all = M_Articles::getInstance()->All('lesson2');


    $this->title .= '::Просмотр статей';

    $this->content = $this->Template('v/v_editor.php', array('articles_all' => $articles_all));
  }

  //редактирование статьи
  public function action_edit(){

    $id=(int)$_GET['id'];
    if (!$id) {
      die("Не верный id");
    }

    // Подготовка данных
    $article_edit = M_Articles::getInstance()->Get();

    if (isset($_POST['submit'])) {
      M_MYSQL::getInstance()->update('lesson2', array('id'=>$_POST['id'],'name'=>$_POST['name'], 'content'=>$_POST['content']), 'id='.$_POST['id']);
      die(header('Location: index.php'));
    }

    $this->title .= '::Редактирование';

    $this->content = $this->Template('v/v_edit.php', array('article_edit'=>$article_edit));
  }

  //Просмотр одной статьи
  public function action_show(){

    $id=(int)$_GET['id'];
    if (!$id) {
      die("Не верный id");
    }

    $article = M_Articles::getInstance()->Get();

    $comm_all = M_Articles::getInstance()->Get_comm();

    $this->title .= '::Просмотр статьи';

    $comm=$this->template('v/block/v_comm_all.php', array('comm'=>$comm_all));

    $comm_new=$this->template('v/block/v_comm_new.php', array('comm'=>$comm_all));

    var_dump($comm_all);



    $this->content = $this->template('v/v_article.php', array('article'=>$article, 'comm_new'=>$comm_new, 'comm'=>$comm));

  }

  //Удаление статьи
  public function action_del() {

    $id=(int)$_GET['id'];
    if (!$id) {
      die("Не верный id");
    }

    M_MYSQL::getInstance()->delete('lesson2', 'id='.$id);
    header('Location: index.php');

  }

  //Добавление статьи
  public function action_new() {
  // Обработка отправки формы
    if (isset($_POST['submit'])) {
      if ($_POST['title_art'] != "" && $_POST['content_art'] != "") {
        M_Articles::getInstance()->article_new($_POST['title_art'], $_POST['date_art'], $_POST['content_art']);
        die(header('Location: index.php'));
      }
    }

    $this->title .= '::Добавить статью';

    $this->content = $this->Template('v/v_new.php');
  }
}