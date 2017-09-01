<?php
			require 'scripts/connect.php';
			$quantrowsall=mysql_query("SELECT * FROM tasktable WHERE (worker LIKE '%".$_SESSION['surname']."%' OR 2worker LIKE '%".$_SESSION['surname']."%' OR 3worker LIKE '%".$_SESSION['surname']."%')");
			$quantrowsdep=mysql_query("SELECT * FROM tasktable WHERE (worker LIKE '%".$_SESSION['surname']."%' OR 2worker LIKE '%".$_SESSION['surname']."%' OR 3worker LIKE '%".$_SESSION['surname']."%') AND status='Направлен исполнителю'");
			$nummall = mysql_num_rows($quantrowsall);		
			$nummdep = mysql_num_rows($quantrowsdep);	
			echo 'Предыдущий вход: <strong><FONT COLOR=#D43D42>'.$_SESSION['enter'].'</FONT></strong></br>';
			echo 'Всего ваших заявок: <strong><FONT COLOR=#D43D42>'.$nummall.'</FONT></strong></br>';
			echo 'Количество необработанных заявок: <strong><FONT COLOR=#D43D42>'.$nummdep.'</FONT></strong></br>';
			echo '<a href="alltask.php?do=logout">Выход</a>';

		?>