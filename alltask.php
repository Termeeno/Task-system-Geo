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
    <th><font size="2"><a href="alltask.php?blocksession=true&sort=number&<?php if ($_GET['order']=="DESC"){ echo 'order=ASC';} else echo 'order=DESC' ?>&page=<?php echo $_GET['page']; ?>" style="color: #02674C; text-decoration: none;">Номер</a></font></th>
    <th><font size="2"><a href="alltask.php?blocksession=true&sort=date&<?php if ($_GET['order']=="DESC"){ echo 'order=ASC';} else echo 'order=DESC' ?>&page=<?php echo $_GET['page']; ?>" style="color: #02674C; text-decoration: none;">Дата и время</a></font></th>
    <th><font size="2"><a href="alltask.php?blocksession=true&sort=client&<?php if ($_GET['order']=="DESC"){ echo 'order=ASC';} else echo 'order=DESC' ?>&page=<?php echo $_GET['page']; ?>" style="color: #02674C; text-decoration: none;">ФИО Заказчика&nbsp;&nbsp;</a></font></th>
    <th><font size="2"><a href="alltask.php?blocksession=true&sort=object&<?php if ($_GET['order']=="DESC"){ echo 'order=ASC';} else echo 'order=DESC' ?>&page=<?php echo $_GET['page']; ?>" style="color: #02674C; text-decoration: none;">Объект</a></font></th>
    <th><font size="2"><a href="alltask.php?blocksession=true&sort=phone&<?php if ($_GET['order']=="DESC"){ echo 'order=ASC';} else echo 'order=DESC' ?>&page=<?php echo $_GET['page']; ?>" style="color: #02674C; text-decoration: none;">Телефон</a></font></th>
    <th><font size="2"><a href="alltask.php?blocksession=true&sort=type&<?php if ($_GET['order']=="DESC"){ echo 'order=ASC';} else echo 'order=DESC' ?>&page=<?php echo $_GET['page']; ?>" style="color: #02674C; text-decoration: none;">Вид работ</a></font></th>
    <th><font size="2"><a href="alltask.php?blocksession=true&sort=name&<?php if ($_GET['order']=="DESC"){ echo 'order=ASC';} else echo 'order=DESC' ?>&page=<?php echo $_GET['page']; ?>" style="color: #02674C; text-decoration: none;">Контакты</a></font></th>
    <th><font size="2"><a href="alltask.php?blocksession=true&sort=pay_status&<?php if ($_GET['order']=="DESC"){ echo 'order=ASC';} else echo 'order=DESC' ?>&page=<?php echo $_GET['page']; ?>" style="color: #02674C; text-decoration: none;">Оплата</a></font></th>
    <th><font size="2"><a href="alltask.php?blocksession=true&sort=status&<?php if ($_GET['order']=="DESC"){ echo 'order=ASC';} else echo 'order=DESC' ?>&page=<?php echo $_GET['page']; ?>" style="color: #02674C; text-decoration: none;">Статус</a></font></th>
    <th><font size="2"><a href="alltask.php?blocksession=true&sort=chief&<?php if ($_GET['order']=="DESC"){ echo 'order=ASC';} else echo 'order=DESC' ?>&page=<?php echo $_GET['page']; ?>" style="color: #02674C; text-decoration: none;">Начальник отдела</a></font></th>
    <th><font size="2"><a href="alltask.php?blocksession=true&sort=worker&<?php if ($_GET['order']=="DESC"){ echo 'order=ASC';} else echo 'order=DESC' ?>&page=<?php echo $_GET['page']; ?>" style="color: #02674C; text-decoration: none;">Исполнитель</a></font></th>
    <th><font size="2"><a href="alltask.php?blocksession=true&sort=2worker&<?php if ($_GET['order']=="DESC"){ echo 'order=ASC';} else echo 'order=DESC' ?>&page=<?php echo $_GET['page']; ?>" style="color: #02674C; text-decoration: none;">Исп-ль №2</a></font></th>
    <th><font size="2"><a href="alltask.php?blocksession=true&sort=3worker&<?php if ($_GET['order']=="DESC"){ echo 'order=ASC';} else echo 'order=DESC' ?>&page=<?php echo $_GET['page']; ?>" style="color: #02674C; text-decoration: none;">Исп-ль №3</font></th>
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