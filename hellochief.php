<?php
			require 'scripts/connect.php';
			$quantrowsall=mysql_query("SELECT * FROM tasktable WHERE chief LIKE '%".$_SESSION['surname']."%' AND status='на рассмотрении начальника отдела'");
			$quantrowsdep=mysql_query("SELECT * FROM tasktable WHERE chief LIKE '%".$_SESSION['surname']."%'");
			$nummall = mysql_num_rows($quantrowsall);		
			$nummdep = mysql_num_rows($quantrowsdep);	
			echo 'Предыдущий вход: <strong><FONT COLOR=#D43D42>'.$_SESSION['enter'].'</FONT></strong></br>';
			echo 'Всего заявок по отделу: <strong><FONT COLOR=#D43D42>'.$nummdep.'</FONT></strong></br>';
			echo 'Необработанных заявок по Вашему отделу: <strong><FONT COLOR=#D43D42>'.$nummall.'</FONT></strong></br>';
			echo '<a href="alltask.php?do=logout">Выход</a>';
			echo '</br></br><strong><FONT COLOR=#F42B32> Внимание!</FONT></strong></br>';
			echo 'С 9 января 2018 года все заявки 2017 года, имеющие статус "Выполнена" (отмеченные зеленым в поиске), будут перемещены в архив. ';


		?>