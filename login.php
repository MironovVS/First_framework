<?php

require_once('c/Model/model.php');

function __autoload($classname){
  switch ($classname[0])
  {
    case 'C':
      include_once("c/Classes/$classname.php");
      break;
    case 'M':
      include_once("c/Model/$classname.php");
  }
}

// Установка параметров, подключение к БД, запуск сессии.
startup();

// Менеджеры.
$mUsers = M_Users::Instance();

// Очистка старых сессий.
$mUsers->ClearSessions();

// Выход.
$mUsers->Logout();


// Обработка отправки формы.
if (!empty($_POST))
{
  if ($mUsers->Login($_POST['login'],
    $_POST['password'],
    isset($_POST['remember'])))
  {
    header('Location: index.php');
    die();
  }
}

// Кодировка.
header('Content-type: text/html; charset=utf-8');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <title>Веб-Гуру</title>
  <meta content="text/html; charset=utf-8" http-equiv="content-type">
<!--  <link rel="stylesheet" type="text/css" media="screen" href="theme/style.css" />-->
</head>
<body>
<h1>Авторизация</h1>
<a href="index.php">Главная</a> | <a href="reg.php">Зарегистрироваться</a>

<form method="post">
  E-mail: <input type="text" name="login" /><br/>
  Пароль: <input type="password" name="password" /><br/>
  <input type="checkbox" name="remember" /> Запомить меня<br/>
  <input type="submit" />
</form>
</body>
</html>
