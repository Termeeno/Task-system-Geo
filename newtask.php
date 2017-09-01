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
<div class="controlblock">
Формирование новой заявки
<div class="formblock">
<form action="form.php" form enctype="multipart/form-data" method="post" name="form">
<label for="client">ФИО заявителя</label><br/>
<input type="text" name="client" size="30" maxlength="300" style="width: 500px;" placeholder="Введите имя и фамилию Заказчика" required="required"><br/>
<label for="object">Адрес объекта</label><br/>
<input type="text" name="object" size="30" maxlength="300" style="width: 500px;" placeholder="Введите информацию об объекте Заказчика" required="required"><br/>
<label for="phone">Телефон</label><br/>
<input type="text" name="phone" size="30" maxlength="300" style="width: 500px;" placeholder="Введите телефон Заказчика" required="required"><br/>
Выберите вид работы или услуги</br>
<style>
      #para {
    border-radius: 5px !important;
    background: #d3dcda !important;
    border: 1px #cecece !important;
    padding: 5px !important;
    border: 0 !important;
    font-size: 14px !important;
    line-height: 1 !important;
    width: 510px !important;
    height: 100px !important;
      } 
    </style>
<select name="select[]" id="para" size="5" multiple>
          <?php
      require 'scripts/connect.php';
      $result=mysql_query("SELECT * FROM resources");
      while ($row = mysql_fetch_array($result)){
        $text=$row["type_list"]; 
        }
        echo $text;
         ?>
      </select><br/>
<label for="name">Контакты:</label><br/>
<textarea type="text" name="name" style="width: 500px; height: 100px;" maxlength="4000" placeholder="Введите контактные данные Заказчика" required="required"></textarea><br/>
      </select><br/>
      <label for="comment">Комментарий</label><br/>
<textarea type="text" name="comment" style="width: 500px; height: 100px;" maxlength="250" placeholder="Добавьте комментарий к заявке" ></textarea><br/>
<label for="deadline">Планируемая дата выполнения</label><br/>
<input type="date" name="deadline" size="30" maxlength="300" style="width: 500px;" placeholder="Введите планируемую дату выполнения" required="required"><br/>
Выберите начальника отдела</br>
<select name="select3" required="required">
          <option value="Утнюхин Р.В.">Утнюхин Р.В.</option>
          <option value="Конюкова И.В.">Конюкова И.В.</option>
      </select><br/>
<br/>
<input id="submit" type="submit" value="Создать заявку"><input type="reset" value="Очистить форму"><br/>
</form>
</div>
</div>
<div class="searchblock">
Поиск заявки
<?php
include ("searchtask.php");
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