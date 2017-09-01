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
			require 'scripts/connect.php';
			$quantrowsall=mysql_query("SELECT * FROM tasktable WHERE status='на рассмотрении начальника отдела'");
			$quantrowsgeo=mysql_query("SELECT * FROM tasktable WHERE chief='Конюкова И.В.'");
			$quantrowsgen=mysql_query("SELECT * FROM tasktable WHERE chief='Утнюхин Р.В.'");
			$nummall = mysql_num_rows($quantrowsall);	
			$nummgeo = mysql_num_rows($quantrowsgeo);	
			$nummgen = mysql_num_rows($quantrowsgen);	
			echo 'Предыдущий вход: <strong><FONT COLOR=#D43D42>'.$_SESSION['enter'].'</FONT></strong></br>';
			echo 'Необработанных заявок: <strong><FONT COLOR=#D43D42>'.$nummall.'</FONT></strong></br>';
			echo 'Всего заявок по отделу Генплана: <strong><FONT COLOR=#D43D42>'.$nummgen.'</FONT></strong></br>';
			echo 'Всего заявок по отделу Геослужбы: <strong><FONT COLOR=#D43D42>'.$nummgeo.'</FONT></strong></br>';
			echo '<a href="mainpage.php?do=logout">Выход</a>';

		?>
		</div>
</div>
<div class="buttonblock">
		<a href="newtask.php" class="menu_newtask"/>Новая заявка</a>
		<a href="alltask.php?page=1" class="menu_alltask"/>Все заявки</a>
		<a href="newslist.php" class="menu_daily"/>Ежедневник</a>
		</div>
<div class="edittaskblock">
 <?php
 		echo 'dffdfrd';
        
?>
</div>
<div class="searchblock">
Поиск заявки
<?php
include ("searchtask.php");
?>
</div>
<div class="footerblock">
fdhjkgkfdjhgkhfd
</div>
</div>
</form>
</body>
</html>