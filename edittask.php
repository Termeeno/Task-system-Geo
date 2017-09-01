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
 switch ($_SESSION['status']) {
    case 'secretar':
      include ('editsecretar.php');
      break;
    case 'chief':
      include ('editchief.php');
      break;
    case 'worker':
      include ('editworker.php');
      break;
    case 'buh':
      include ('editbuh.php');
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
</form>
</body>
</html>