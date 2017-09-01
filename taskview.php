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
<div class="edittaskblock">
 <?php
 		require 'scripts/connect.php';
 		$num=$_GET["num"];
        $result=mysql_query("SELECT * FROM tasktable WHERE number= '$num'");
        while ($row = mysql_fetch_array($result)){
		echo '<font color="#5C748C">Номер заявки:</font> <font color="#253F56">'.$row["number"].'</font></br>';
		echo '<font color="#5C748C">Дата заявки:</font> <font color="#253F56">'.$row["date"].'</font></br>';
		echo '<font color="#5C748C">Дата план. выполнения заявки:</font> <font color="#253F56">'.$row["deadline"].'</font></br>';
		echo '<font color="#5C748C">ФИО заказчика:</font> <font color="#253F56">'.$row["client"].'</font></br>';
		echo '<font color="#5C748C">Данные по объекту:</font> <font color="#253F56">'.$row["object"].'</font></br>';
		echo '<font color="#5C748C">Телефон:</font> <font color="#253F56">'.$row["phone"].'</font></br>';
		echo '<font color="#5C748C">Вид работы или услуги:</font> <font color="#253F56">'.$row["type"].'</font></br>';
		echo '<font color="#5C748C">Описание работы/услуги:</font> <font color="#253F56">'.$row["name"].'</font></br>';
		echo '<font color="#5C748C">Оплата:</font> <font color="#253F56">'.$row["pay_status"].'</font></br>';
		echo '<font color="#5C748C">Статус:</font> <font color="#253F56">'.$row["status"].'</font></br>';
		echo '<font color="#5C748C">Комментарии:</font> <font color="#253F56">'.$row["comments"].'</font></br>';
		echo '<font color="#5C748C">Начальник отдела:</font> <font color="#253F56">'.$row["chief"].'</font></br>';
		echo '<font color="#5C748C">Исполнитель:</font> <font color="#253F56">'.$row["worker"].'</font></br>';
		echo '<font color="#5C748C">Исполнитель №2:</font> <font color="#253F56">'.$row["2worker"].'</font></br>';
		echo '<font color="#5C748C">Исполнитель №3:</font> <font color="#253F56">'.$row["3worker"].'</font></br>';
		echo '<font color="#5C748C">Время выезда:</font> <font color="#253F56">'.$row["checkout_time"].'</font></br>';
		echo '<font color="#5C748C">Срок выполнения заявки:</font> <font color="#253F56">'.$row["deadline"].'</font></br>';
	}
        
?>
</div>
<div class="footerblock">
<?php
include ('footertext.php');
?>
</div>
</div>
</form>
</body>
</html>