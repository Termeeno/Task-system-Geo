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
<img src="images/header.png" alt="Geoplan" width="1080" height="276" class="header" />
<div class="mainblock">

	<div class="helloblock">
	<?php
	echo 'Здравствуйте, '.$_SESSION['user'].' '.$_SESSION['secname'];
	?>
	</br>
		<div class="helloblocktext">
		<?php
			echo '</br></br><strong><FONT COLOR=#F42B32> Внимание!</FONT></strong></br>';
      echo 'В архиве находятся заявки за 2017 год. Редактированию не подлежат. Если вам необходимо изменить статус заявки, находящейся в архиве- обратитесь в 7 кабинет.';
      echo '</br></br></br><a href="alltask.php?do=logout">Выход</a>';
		?>
		</div>
</div>
<?php                                                                //блок кнопок сверху
 switch ($_SESSION['status']) {
    case 'secretar':
      include ('buttonblocksecretar.php');
      break;
      case 'director':
      include ('buttonblockbuh.php');
      break;
    case 'chief':
      include ('buttonblockchief.php');
      break;
    case 'worker':
      include ('buttonblockworker.php');
      break;
    case 'buh':
      include ('buttonblockbuh.php');
      break;
  }
?>
	<div class="controlblock">
Управление заявками
<div class="filterblock">
<form method="post" name="searchform">
<select name="select_type" style="width: 180px;">
          <option selected="selected">Выберите тип заявки</option>
           <?php
      require 'scripts/connect.php';
      $result=mysql_query("SELECT * FROM resources");
      while ($row = mysql_fetch_array($result)){
        $text=$row["type_list"]; 
        }
        echo $text;
         ?>
      </select>
      <input type="text" name="number" size="30" maxlength="300" style="width: 160px;" placeholder="Введите номер заявки">
      <select name="select_worker" required="required">
      <option selected="selected">Выберите исполнителя</option>
                <?php
      require 'scripts/connect.php';
      $result=mysql_query("SELECT * FROM resources");
      while ($row = mysql_fetch_array($result)){
        $text=$row["worker_list"]; 
        }
        echo $text;
         ?>
      </select>
      <br/>
      <select name="select_pay" style="width: 180px;">
      <option selected="selected">Выбор статуса оплаты</option>
          <?php
      require 'scripts/connect.php';
      $result=mysql_query("SELECT * FROM resources");
      while ($row = mysql_fetch_array($result)){
        $text=$row["pay_list"]; 
        }
        echo $text;
         ?>
      </select>
    <input type="text" name="client" size="30" maxlength="300" style="width: 160px;" placeholder="Введите ФИО Заказчика">
    <select name="select_status" required="required">
      <option selected="selected">Выберите статус</option>
         <option value="Отменена">Отменена</option>
         <option value="Выполнена">Выполнена</option>
      </select>
      <br/>
    <input type="text" name="phone" size="30" maxlength="300" style="width: 160px;" placeholder="Телефон Заказчика">
    <select name="select_chief" required="required" style="width: 230px;">
      <option selected="selected">Выберите начальника отдела</option>
          <option value="Утнюхин Р.В.">Утнюхин Р.В.</option>
          <option value="Конюкова И.В.">Конюкова И.В.</option>
      </select>
      <input type="text" name="object" size="30" maxlength="300" style="width: 205px;" placeholder="Введите название объекта">
      <br/>
      <input type="date" name="datein" size="30" maxlength="300" style="width: 170px;"> - 
      <input type="date" name="dateout" size="30" maxlength="300" style="width: 170px;">
      <br/>
      <input id="search" name="search" autofocus type="submit" style="width: 70px;" value="Найти"><input type="reset" style="width: 150px;" value="Очистить форму">
</form>
</div>
</div>
<div class="listtaskblock">
<table border="1">
   <tr>
    <th><font size="2" color=#02674C>Номер</font></th>
    <th><font size="2" color=#02674C>Дата и время</font></th>
    <th><font size="2" color=#02674C>ФИО Заказчика&nbsp;&nbsp;</font></th>
    <th><font size="2" color=#02674C>&nbsp;&nbsp;Объект&nbsp;&nbsp;</font></th>
    <th><font size="2" color=#02674C>Телефон</font></th>
    <th><font size="2" color=#02674C>Вид работ</font></th>
    <th><font size="2" color=#02674C>Контакты</font></th>
    <th><font size="2" color=#02674C>Оплата</font></th>
    <th><font size="2" color=#02674C>&nbsp;&nbsp;&nbsp;Статус&nbsp;&nbsp;&nbsp;</font></th>
    <th><font size="2" color=#02674C>Начальник отдела</font></th>
    <th><font size="2" color=#02674C>Исполнитель</font></th>
    <th><font size="2" color=#02674C>Исп-ль №2</font></th>
    <th><font size="2" color=#02674C>Исп-ль №3</font></th>
    <th><font size="2" color=#02674C>Действия</font></th>
   </tr>
<?php
require 'scripts/connect.php';
      
      $query="SELECT * FROM archive_2017";
      $quantrows=mysql_query($query);
      $numm = mysql_num_rows($quantrows);               //общее кол-во записей, без применения фильтра заявок
      $page=$_GET["page"];                      //получаем номер страницы
      if ($page==0) {
        $page=1;
      }                               
      $limit=100;                           //устанавливаем лимит заявок на страницу
      $offset=$limit*($page-1);                   //устанавливаем параметр оффсет (указывает, с какой строки из БД возвращать данные)
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
if ($_POST['select_worker']!='Выберите исполнителя'){
  $worker = $_POST['select_worker'];
  $sql.= ' AND (worker LIKE "%'.$worker.'%" OR 2worker LIKE "%'.$worker.'%" OR 3worker LIKE "%'.$worker.'%")';
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
if (!empty($_POST['object'])) {
  $object=$_POST['object'];
  $sql.= ' AND object LIKE "%'.$object.'%"';
  }
if (!empty($_POST['client'])) {
  $client=$_POST['client'];
  $sql.= ' AND client LIKE "%'.$client.'%"';
  }
  $size = count($filter); 
  if (!empty($filter)) {                        //скрипт для проверки пустоты массива и переменной sql, для избежания ошибки при поиске с пустыми фильтрами
    foreach( $filter as $key => $value){
  $a= ' AND '.$key.'="'.$value.'"';
  $sql.=$a;                           //через конкантенацию склеиваем строки из цикла с изначально пустолй переменной $sql
  } 
  } else  {
    if (!empty($sql)) {

    } else echo 'Вы не выбрали фильтры. ';

  }
  
$query = "SELECT * FROM archive_2017 WHERE 1 ".$sql. " ORDER BY number DESC";
$querynum=$query;
$quantrows=mysql_query($query);
$numm = mysql_num_rows($quantrows);                                   //количество заявок при включенном фильтре
echo 'Найдено заявок: '.$numm;
} else { 
$query = "SELECT * FROM archive_2017 ORDER BY number DESC LIMIT ".$offset.", ".$limit; 
$querynum = "SELECT * FROM archive_2017 ORDER BY number DESC"; 
echo 'Найдено заявок: '.$numm;
}

$result=mysql_query ($query);
while ($row = mysql_fetch_array($result)){
        $deaddate=$row["deadline"]; 
        $checkstatus=$row["status"];
        $worker1color=$row["worker_1_check"]; 
        $worker2color=$row["worker_2_check"]; 
        $worker3color=$row["worker_3_check"];                                 //скрипт выбора цвета. Лень переделывать, хотя в архиве нужно всего 2 цвета- красный и зеленый.
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
    if ($worker1color!='#7BE18E') {               // сделано для того, чтобы все ячейки были общего цвета $color, кроме ячеек работников, выполнивших заявку
        $worker1color=$color;
      }
      if ($worker2color!='#7BE18E') {
        $worker2color=$color;
      }
      if ($worker3color!='#7BE18E') {
        $worker3color=$color;
      }
  echo '<tr><th bgcolor='.$color.'><a href="archtaskview.php?num='.$row["number"].'"style="color: #699274; text-align: left;">'.$row["number"].'</a></th><th bgcolor='.$color.'>'.$row["date"].'</th><th bgcolor='.$color.'>'.$row["client"].'</th><th bgcolor='.$color.'>'.$row["object"].'</th><th bgcolor='.$color.'>'.$row["phone"].'</th><th bgcolor='.$color.'>'.$row["type"].'</th><th bgcolor='.$color.'>'.$row["name"].'</th><th bgcolor='.$color.'>'.$row["pay_status"].'</th><th bgcolor='.$color.'>'.$row["status"].'</th><th bgcolor='.$color.'>'.$row["chief"].'</th><th bgcolor='.$worker1color.'>'.$row["worker"].'</th><th bgcolor='.$worker2color.'>'.$row["2worker"].'</th><th bgcolor='.$worker3color.'>'.$row["3worker"].'</th><th bgcolor='.$color.'><a href="archtaskview.php?num='.$row["number"].'"style="color: #699274; text-align: left;">Просмотр</a></th></tr>';
}
  echo '</table>';
  $_SESSION['sql'] = $querynum;
//код для постраничного вывода
$quantity=100;                //кол-во записей на страницу
$pagesquantity=ceil($numm/$quantity);   //количество страниц
for ($i=1; $i<=$pagesquantity; $i++) {
  echo '<a href="archive.php?page='.$i.'"style="color: #BA720C; text-decoration:none; text-align: left;"/>&nbsp;'.$i.'&nbsp;</a>';
}
?>
</div>
<div class="footerblock">
<?php
include ('footertext.php');
?>
</div>
</div>
</div>
</div>
</form>
</body>
</html>