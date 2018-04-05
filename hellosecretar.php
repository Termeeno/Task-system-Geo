<?php
			require 'scripts/connect.php';
			$quantrowsall=mysql_query("SELECT * FROM tasktable WHERE status='на рассмотрении начальника отдела'");
			$quantrowsgeo=mysql_query("SELECT * FROM tasktable WHERE chief='Конюкова И.В.'");
			$quantrowsgen=mysql_query("SELECT * FROM tasktable WHERE chief='Утнюхин Р.В.'");
			$result=mysql_query("SELECT * FROM resources");
			$nummall = mysql_num_rows($quantrowsall);	
			$nummgeo = mysql_num_rows($quantrowsgeo);	
			$nummgen = mysql_num_rows($quantrowsgen);	
			echo 'Предыдущий вход: <strong><FONT COLOR=#D43D42>'.$_SESSION['enter'].'</FONT></strong></br>';
			echo 'Необработанных заявок: <strong><FONT COLOR=#D43D42>'.$nummall.'</FONT></strong></br>';
			echo 'Всего заявок по отделу Генплана: <strong><FONT COLOR=#D43D42>'.$nummgen.'</FONT></strong></br>';
			echo 'Всего заявок по отделу Геослужбы: <strong><FONT COLOR=#D43D42>'.$nummgeo.'</FONT></strong></br>';
			echo '<a href="alltask.php?do=logout">Выход</a>';
			while ($row = mysql_fetch_array($result)){
        	$text=$row["helloblockmem"]; 
       		 }
        	echo $text;


		?>