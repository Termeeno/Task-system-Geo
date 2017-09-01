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
			switch ($_SESSION['status']) {
    		case 'secretar':
      		include ('hellosecretar.php');
      		break;
      		case 'director':
      		include ('hellosecretar.php');
      		break;
    		case 'chief':
      		include ('hellochief.php');
      		break;
      		case 'worker':
      		include ('helloworker.php');
      		break;
      		case 'buh':
      		include ('hellobuh.php');
      		break;
  }

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
<?php
 switch ($_SESSION['status']) {
    case 'secretar':
      include ('formsecretar.php');
      break;
      case 'director':
      include ('formsecretar.php');
      break;
    case 'chief':
      include ('formchief.php');
      break;
    case 'worker':
      include ('formworker.php');
      break;
    case 'buh':
      include ('formbuh.php');
      break;
  }
?>
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
 switch ($_SESSION['status']) {
    case 'secretar':
      include ('secretarfilter.php');
      break;
      case 'director':
      include ('directorfilter.php');
      break;
    case 'chief':
      include ('chieffilter.php');
      break;
    case 'worker':
      include ('workerfilter.php');
      break;
    case 'buh':
      include ('buhfilter.php');
      break;
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