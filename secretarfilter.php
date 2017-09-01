<?php
require 'scripts/connect.php';
			
			$query="SELECT * FROM tasktable";
			$quantrows=mysql_query($query);
			$numm = mysql_num_rows($quantrows);								//общее кол-во записей, без применения фильтра заявок
			$page=$_GET["page"];											//получаем номер страницы
			if ($page==0) {
				$page=1;
			}																
			$limit=20;														//устанавливаем лимит заявок на страницу
			$offset=$limit*($page-1);										//устанавливаем параметр оффсет (указывает, с какой строки из БД возвращать данные)
if (isset($_POST['search'])) {
if ($_POST['select_pay']!='Выбор статуса оплаты'){
	$pay = $_POST['select_pay'];
	$filter ['pay_status']=$pay;
}
if ($_POST['select_chief']!='Выберите начальника отдела'){
	$chief = $_POST['select_chief'];
	$filter ['chief']=$chief;
}
if ($_POST['select_type']!='Выберите тип заявки'){
	$type = $_POST['select_type'];
	$sql.= ' AND type LIKE "%'.$type.'%"';
	}
if ($_POST['select_status']!='Выберите статус'){
	$status = $_POST['select_status'];
	$filter ['status']=$status;
	}
if (!empty($_POST['number'])) {
	$number = $_POST['number'];
	$sql.= ' AND number LIKE "%'.$number.'%"';
	}
if (!empty($_POST['phone'])) {
	$phone = $_POST['phone'];
	$sql.= ' AND phone LIKE "%'.$phone.'%"';
	}
if (!empty($_POST['datein'])) {
	$datein=$_POST['datein'];
	$sql.= ' AND datefilter >="'.$datein.'"';
	}
if (!empty($_POST['dateout'])) {
	$dateout=$_POST['dateout'];
	$sql.= ' AND datefilter <="'.$dateout.'"';
	}
if ($_POST['select_worker']!='Выберите исполнителя'){
	$worker = $_POST['select_worker'];
	$sql.= ' AND (worker LIKE "%'.$worker.'%" OR 2worker LIKE "%'.$worker.'%" OR 3worker LIKE "%'.$worker.'%")';
	}
if (!empty($_POST['object'])) {
	$object=$_POST['object'];
	$sql.= ' AND object LIKE "%'.$object.'%"';
	}
if (!empty($_POST['client'])) {
	$client=$_POST['client'];
	$sql.= ' AND client LIKE "%'.$client.'%"';
	}
	$size = count($filter); 
	if (!empty($filter)) {												//скрипт для проверки пустоты массива и переменной sql, для избежания ошибки при поиске с пустыми фильтрами
		foreach( $filter as $key => $value){
	$a= ' AND '.$key.'="'.$value.'"';
	$sql.=$a;														//через конкантенацию склеиваем строки из цикла с изначально пустолй переменной $sql
	} 
	} else  {
		if (!empty($sql)) {

		} else echo 'Вы не выбрали фильтры. ';

	}
	
$query = "SELECT * FROM tasktable WHERE 1 ".$sql. " ORDER BY number DESC";
$querynum=$query;
$quantrows=mysql_query($query);
$numm = mysql_num_rows($quantrows);																		//количество заявок при включенном фильтре
echo 'Найдено заявок: '.$numm;
} else 
if (isset($_POST['control'])) {																		//по нажатию кнопки Отобразить заявки на контроле ищем заявки с дедлайноm, равным (сегд число +3 дня)
	$timestamp = strtotime("+3 day");
	$findindeadline='"'.date ('Y-m-d' , $timestamp).'"';
	$findoutdeadline='"'.date ('Y-m-d').'"';
	$query = "SELECT * FROM tasktable WHERE deadline <=".$findindeadline." AND deadline >=".$findoutdeadline." AND status!='Выполнена' ORDER BY number DESC";
	$querynum=$query;
	$quantrows=mysql_query($query);
	$numm = mysql_num_rows($quantrows);	
	echo 'Найдено заявок: '.$numm;
} else
{ 
$query = "SELECT * FROM tasktable ORDER BY number DESC LIMIT ".$offset.", ".$limit;	
$querynum = "SELECT * FROM tasktable ORDER BY number DESC";	
echo 'Найдено заявок: '.$numm;
}

$result=mysql_query ($query);
while ($row = mysql_fetch_array($result)){
				$deaddate=$row["deadline"];	
				$checkstatus=$row["status"];
				$worker1color=$row["worker_1_check"];	
				$worker2color=$row["worker_2_check"];	
				$worker3color=$row["worker_3_check"];																	//вычисляем время до дедлайна заявки, если остается <3, то подсвечиваем оранж.
				$check= strtotime($deaddate)-time();
				$days = floor($check/86400);
				switch ($checkstatus) {
					case ($days<3 AND $days>=0 AND $checkstatus!='Выполнена' AND $checkstatus!='Выполнена частично' AND $checkstatus!='Приостановлена'):
						$color='#F6AE47';
						break;

					case (($days<0 OR $checkstatus=='Отменена')AND $checkstatus!='Выполнена' AND $checkstatus!='Выполнена частично' AND $checkstatus!='Приостановлена'):
						$color='#FBA2A2';
						break;

					case ($checkstatus=='На рассмотрении начальника отдела'):
						$color='#D0DFEF';
						break;

					case($checkstatus=='Направлена исполнителю'):
						$color='#ADB1FB';
						break;

					case($checkstatus=='Принята в работу'):
						$color='#FAD5BF';
						break;

					case ($checkstatus=='Выполнена'):
						$color='#7BE18E';
						break;

					case($checkstatus=='Выполнена частично'):
						$color='#EFC2FC';
						break;

					case($checkstatus=='Приостановлена'):
						$color='#8AF4F3';
						break;
				}	
		if ($worker1color!='#7BE18E') {								// сделано для того, чтобы все ячейки были общего цвета $color, кроме ячеек работников, выполнивших заявку
				$worker1color=$color;
			}
			if ($worker2color!='#7BE18E') {
				$worker2color=$color;
			}
			if ($worker3color!='#7BE18E') {
				$worker3color=$color;
			}
	echo '<tr><th bgcolor='.$color.'><a href="taskview.php?num='.$row["number"].'"style="color: #699274; text-align: left;">'.$row["number"].'</a></th><th bgcolor='.$color.'>'.$row["date"].'</th><th bgcolor='.$color.'>'.$row["client"].'</th><th bgcolor='.$color.'>'.$row["object"].'</th><th bgcolor='.$color.'>'.$row["phone"].'</th><th bgcolor='.$color.'>'.$row["type"].'</th><th bgcolor='.$color.'>'.$row["name"].'</th><th bgcolor='.$color.'>'.$row["pay_status"].'</th><th bgcolor='.$color.'>'.$row["status"].'</th><th bgcolor='.$color.'>'.$row["chief"].'</th><th bgcolor='.$worker1color.'>'.$row["worker"].'</th><th bgcolor='.$worker2color.'>'.$row["2worker"].'</th><th bgcolor='.$worker3color.'>'.$row["3worker"].'</th><th><a href="edittask.php?num='.$row["number"].'"style="color: #699274; text-align: left;">Редакт.</a></th></tr>';
}
	echo '</table>';
	echo '<br/><a href="report.php" style="font-size: 12px; text-decoration: none; padding:5px 5px; color:#000000; background-color:#F6F6F6; border-radius:8px; border: 1px solid #b1b4b5;">Подготовить отчет</a>
</input><br/><br/>';
$_SESSION['sql'] = $querynum;
//код для постраничного вывода
$quantity=20;								//кол-во записей на страницу
$pagesquantity=ceil($numm/$quantity);		//количество страниц
for ($i=1; $i<=$pagesquantity; $i++) {
	echo '<a href="alltask.php?page='.$i.'"style="color: #BA720C; text-decoration:none; text-align: left;"/>&nbsp;'.$i.'&nbsp;</a>';
}
?>