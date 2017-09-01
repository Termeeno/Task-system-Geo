<?php
session_start();
require 'scripts/connect.php';
if (isset($_POST['submit'])) // Отлавливаем нажатие кнопки "Отправить"
{
if (empty($_POST['login'])) // Если поле логин пустое
{
echo '<div class="errorblock">Поле "логин"" не заполнено</div>'; // То выводим сообщение об ошибке
}
elseif (empty($_POST['password'])) // Если поле пароль пустое
{
echo '<div class="errorblock">Поле "пароль"" не заполнено</div>'; // То выводим сообщение об ошибке
}
else  // Иначе если все поля заполненны
{    
$login = $_POST['login']; // Записываем логин в переменную 
$password = md5($_POST['password']);// Записываем пароль в переменную   
$result=mysql_query("SELECT name, secname, surname, status, enter FROM users WHERE login='$login' and password='$password'");
while ($row = mysql_fetch_array($result)){
	$user=$row["name"];
	$status=$row["status"];
	$secname=$row["secname"];
	$surname=$row["surname"];
	$enter=$row["enter"];
}
echo $row['name'];
if (empty($user)) // Если запрос к бд не возвразяет id пользователя
{
echo '<div class="errorblock">Неверные Логин или Пароль</div>'; // Значит такой пользователь не существует или не верен пароль
}
else // Если возвращяем id пользователя, выполняем вход под ним
{
$date = date ('d.m.Y  H.i.s');
$insertdate = mysql_query("UPDATE users SET enter='$date' WHERE login ='$login'");
$_SESSION['password'] = $password; // Заносим в сессию  пароль
$_SESSION['login'] = $login; // Заносим в сессию  логин
$_SESSION['user'] = $user; // Заносим в сессию  id
$_SESSION['status'] = $status; //заносим статус для опредления полномочий
$_SESSION['secname'] = $secname;
$_SESSION['surname'] = $surname;
$_SESSION['enter'] = $enter;
if ($status=='secretar') {
	header("Location: newtask.php");
} else
header("Location: alltask.php");
echo 'Вы успешно вошли в систему, '.$user; // Выводим сообщение что пользователь авторизован        
}     
}		
} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>"Геоплан"</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<div class="loginblock">
<p align="center"><font color="#C11212" size="3">Добро пожаловать в систему обработки заявок "Геоплан"</font></p>
<form method="post">
Ваш логин: &nbsp;&nbsp;<input type="text" name="login" /><br />
Ваш пароль: <input type="password" name="password" /><br />
<p align="center"><input type="submit" name="submit" value="Войти" style="width: 150px; text-align: center; " /></p>
</br></br></br></br>
<font color="#373636" size="1">Если вы забыли логин или пароль- звоните по телефонам:</br>внутренний: 1668</br>мобильный: +7-924-81-7011</font>
</form>
</div>