<?php 
require 'scripts/connect.php';
session_start();
$client = $_REQUEST['client'];
$object = $_REQUEST['object'];
$phone = $_REQUEST['phone'];
$select = $_REQUEST['select'];
$name = $_REQUEST['name'];
$select2 = $_REQUEST['select2'];
$comment = $_SESSION['surname'].'('.date ('d.m.Y  H.i.s').'): '.$_REQUEST['comment'];
$select3 = $_REQUEST['select3'];
$status = 'На рассмотрении начальника отдела';
$pay_status='Не оплачен';
$checkout_time = 'Не назначено';
$worker= 'Не назначен';
$worker2= 'Не назначен';
$worker3= 'Не назначен';
$deadline = $_REQUEST['deadline'];
/*$lastname='images'.rand(100,10000).'.png'; //рандомим и имя
copy($_FILES['image']['tmp_name'],"images/".$lastname); //копируем из временного каталога в постоянный+ новое рандомное имя
$imagepath= "images/$lastname";*/
$date = date ('d.m.Y  H.i.s');
$datefilter= date ('Y-m-d');
$log = 'Заявка создана (Гусевская К.А., '.$date.'): ';
$result = mysql_query("INSERT INTO tasktable (date, datefilter, client, object, phone, type, name, pay_status, status, comments, chief, worker, 2worker, 3worker, checkout_time, deadline, log) VALUES ('$date', '$datefilter', '$client', '$object', '$phone', '".implode("<br/>", $select)."', '$name', '$pay_status', '$status', '$comment', '$select3', '$worker', '$worker2', '$worker3', '$checkout_time', '$deadline', '$log')");
if($result == 'true')
{echo "Ваши данные успешно добавлены";}
else {echo "Ваши данные не добавлены";}
?>