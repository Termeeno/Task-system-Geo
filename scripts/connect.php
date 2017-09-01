<?php
mysql_connect("localhost", "taskadmin", "753951")//параметры в скобках ("хост", "имя пользователя", "пароль")
or die("<p>Ошибка подключения к базе данных! " . mysql_error() . "</p>");

mysql_select_db("taskadmin")//параметр в скобках ("имя базы, с которой соединяемся")
 or die("<p>Ошибка выбора базы данных! ". mysql_error() . "</p>");
 mysql_query("set names utf8"); // задаем правильную кодировку.
?>