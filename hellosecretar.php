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
			echo '<a href="alltask.php?do=logout">Выход</a>';
			echo '</br></br><strong><FONT COLOR=#F42B32> Внимание!</FONT></strong></br>';
			echo 'С 9 января 2018 года все заявки 2017 года, имеющие статус "Выполнена" (отмеченные зеленым в поиске), будут перемещены в архив. ';


		?>