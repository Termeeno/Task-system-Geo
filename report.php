<?php
require "auth.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>"Геоплан"</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<img src="images/header.png" alt="Geoplan" width="1580" height="200" class="header" />
<div class="reportblock">
<div class="reporttextblock">
<table border="1">
   <tr>
    <th><font size="2" color=#02674C>Номер</font></th>
    <th><font size="2" color=#02674C>Дата и время</font></th>
    <th><font size="2" color=#02674C>ФИО Заказчика&nbsp;&nbsp;</font></th>
    <th><font size="2" color=#02674C>&nbsp;&nbsp;Объект&nbsp;&nbsp;</font></th>
    <th><font size="2" color=#02674C>Телефон</font></th>
    <th><font size="2" color=#02674C>Тип работ</font></th>
    <th><font size="2" color=#02674C>Контакты</font></th>
    <th><font size="2" color=#02674C>Оплата</font></th>
    <th><font size="2" color=#02674C>&nbsp;&nbsp;&nbsp;Статус&nbsp;&nbsp;&nbsp;</font></th>
    <th><font size="2" color=#02674C>Начальник отдела</font></th>
    <th><font size="2" color=#02674C>Исполнитель</font></th>
    <th><font size="2" color=#02674C>Исполнитель №2</font></th>
    <th><font size="2" color=#02674C>Исполнитель №3</font></th>
    <th><font size="2" color=#02674C>Дата выезда</font></th>
    <th><font size="2" color=#02674C>Срок выполнения</font></th>
   </tr>
<?php
require 'scripts/connect.php';
session_start();
$query =$_SESSION['sql'] ;
//unset($_SESSION['sql']);
$result=mysql_query ($query);
while ($row = mysql_fetch_array($result)){
				$deaddate=$row["deadline"];	
				$checkstatus=$row["status"];																//вычисляем время до дедлайна заявки, если остается <3, то подсвечиваем оранж.
				$check= strtotime($deaddate)-time();
				$days = floor($check/86400);
				if ($days<3 AND $days>=0 AND $checkstatus!='Выполнена') {
					$color='#F6AE47';
				} else if ($days<0 AND $checkstatus!='Выполнена') {
					$color='#FA6363';
				} else if ($checkstatus!='Выполнена') {$color='#EDEBEB';
			} else {$color='#1EF647';
		}
	echo '<tr><th bgcolor='.$color.'>'.$row["number"].'</th><th bgcolor='.$color.'>'.$row["date"].'</th><th bgcolor='.$color.'>'.$row["client"].'</th><th bgcolor='.$color.'>'.$row["object"].'</th><th bgcolor='.$color.'>'.$row["phone"].'</th><th bgcolor='.$color.'>'.$row["type"].'</th><th bgcolor='.$color.'>'.$row["name"].'</th><th bgcolor='.$color.'>'.$row["pay_status"].'</th><th bgcolor='.$color.'>'.$row["status"].'</th><th bgcolor='.$color.'>'.$row["chief"].'</th><th bgcolor='.$color.'>'.$row["worker"].'</th><th bgcolor='.$color.'>'.$row["2worker"].'</th><th bgcolor='.$color.'>'.$row["3worker"].'</th><th bgcolor='.$color.'>'.$row["checkout_time"].'</th><th bgcolor='.$color.'>'.$row["deadline"].'</th></tr>';
}
	echo '</table>';
	?>

	</div>
</div>
<div class="footerreportblock">
<?php
include ('footertext.php');
?>
</div>
</div>


</form>
</body>
</html>