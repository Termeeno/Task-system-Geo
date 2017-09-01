<?php
			require 'scripts/connect.php';
			$quantrowsall=mysql_query("SELECT * FROM tasktable");
			$quantrowsnotpay=mysql_query("SELECT * FROM tasktable WHERE pay_status='Не оплачен'");
			$quantrowspay=mysql_query("SELECT * FROM tasktable WHERE pay_status='Оплачен'");
			$quantrowsprepay=mysql_query("SELECT * FROM tasktable WHERE pay_status='Внесен аванс'");
			$nummall = mysql_num_rows($quantrowsall);		
			$nummnotpay = mysql_num_rows($quantrowsnotpay);	
			$nummpay = mysql_num_rows($quantrowspay);	
			$nummprepay = mysql_num_rows($quantrowsprepay);	
			echo 'Предыдущий вход: <strong><FONT COLOR=#D43D42>'.$_SESSION['enter'].'</FONT></strong></br>';
			echo 'Всего заявок в базе: <strong><FONT COLOR=#D43D42>'.$nummall.'</FONT></strong></br>';
			echo 'Количество неоплаченных заявок: <strong><FONT COLOR=#D43D42>'.$nummnotpay.'</FONT></strong></br>';
			echo 'Количество оплаченных заявок: <strong><FONT COLOR=#D43D42>'.$nummpay.'</FONT></strong></br>';
			echo 'Количество заявок с авансом: <strong><FONT COLOR=#D43D42>'.$nummprepay.'</FONT></strong></br>';
			echo '<a href="alltask.php?do=logout">Выход</a>';
		?>