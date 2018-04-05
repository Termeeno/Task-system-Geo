<?php
			require 'scripts/connect.php';
			$quantrowsall=mysql_query("SELECT * FROM tasktable WHERE chief LIKE '%".$_SESSION['surname']."%' AND status='на рассмотрении начальника отдела'");
			$quantrowsdep=mysql_query("SELECT * FROM tasktable WHERE chief LIKE '%".$_SESSION['surname']."%'");
			$result=mysql_query("SELECT * FROM resources");
			$nummall = mysql_num_rows($quantrowsall);		
			$nummdep = mysql_num_rows($quantrowsdep);	
			echo 'Предыдущий вход: <strong><FONT COLOR=#D43D42>'.$_SESSION['enter'].'</FONT></strong></br>';
			echo 'Всего заявок по отделу: <strong><FONT COLOR=#D43D42>'.$nummdep.'</FONT></strong></br>';
			echo 'Необработанных заявок по Вашему отделу: <strong><FONT COLOR=#D43D42>'.$nummall.'</FONT></strong></br>';
			echo '<a href="alltask.php?do=logout">Выход</a>';
			while ($row = mysql_fetch_array($result)){
        	$text=$row["helloblockmem"]; 
       		 }
        	echo $text;


		?>