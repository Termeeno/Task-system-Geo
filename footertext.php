<div class="footertext">
<?php
			require 'scripts/connect.php';
			$result=mysql_query("SELECT * FROM resources");
			while ($row = mysql_fetch_array($result)){
				$text=$row["footer"];	
				}
				echo '<p align="left">'.$text.'</p>';
		?>
		</div>