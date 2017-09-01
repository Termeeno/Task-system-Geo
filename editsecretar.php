<?php
 		require 'scripts/connect.php';

        $num=$_GET["num"];
        echo '<p class="button" style="text-align:center;"><a href="alltask.php" style="text-decoration: none; padding:5px 5px; color:#000000; background-color:#F6F6F6; border-radius:10px; border: 1px solid #b1b4b5;">Закрыть окно редактирования</a></p>';
        echo '<p align="center"><font color="#C11212">Заявка №: </font><font color="#097A1C">'.$num.'</font></p>';
        $editresult=mysql_query("SELECT * FROM tasktable WHERE number= '$num'");
        while ($row = mysql_fetch_array($editresult)){
        	$edClient=$row["client"];
        	$edObject=$row["object"];
        	$edPhone=$row["phone"];
        	$edType=$row["type"];
        	$edName=$row["name"];
        	$edComment=$row["comments"];        	
        	$edPay=$row["pay_status"];
        	$edStatus=$row["status"];
        	$edChief=$row["chief"];
        	$edWorker=$row["worker"];
        	$edDeadline=$row["deadline"];
        	$edlog=$row["log"];
        }
         echo '<font color="#5C748C">Заказчик:   </font><font color="#097A1C">'.$edClient.'</font></br>';
        echo '<font color="#5C748C">Телефон:   </font><font color="#097A1C">'.$edPhone.'</font></br>';
        echo '<font color="#5C748C">Объект:   </font><font color="#097A1C">'.$edObject.'</font></br>';
        echo '<font color="#5C748C">Виды работ:   </font><font color="#097A1C">'.$edType.'</font><br/><br/>';
        echo '<form enctype="multipart/form-data" method="post" name="form">
        <br/>
<label for="client">ФИО заявителя</label><br/>
<input type="text" name="client" size="30" maxlength="300" style="width: 500px;" placeholder="Введите имя и фамилию Заказчика" required="required" value="'.$edClient.'"><br/>
<label for="object">Объект</label><br/>
<input type="text" name="object" size="30" maxlength="300" style="width: 500px;" placeholder="Введите информацию об объекте Заказчика" required="required" value="'.$edObject.'"><br/>
<label for="phone">Телефон</label><br/>
<input type="text" name="phone" size="30" maxlength="300" style="width: 500px;" placeholder="Введите телефон Заказчика" required="required"value="'.$edPhone.'"><br/>
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
<select name="select[]" id="para" size="5" multiple required="required">';
      $result=mysql_query("SELECT * FROM resources");
      while ($row = mysql_fetch_array($result)){
        $text=$row["type_list"]; 
        }
        echo $text;
echo '</select><br/>
<label for="name">Описание работы:</label><br/>
<textarea type="text" name="name" style="width: 500px; height: 100px;" maxlength="4000" placeholder="Введите полное название работы или услуги" required="required">'.$edName.'</textarea><br/>
      </select><br/>
      <label for="comment">Комментарий</label><br/>
<textarea type="text" name="comment" style="width: 500px; height: 100px;" maxlength="250" placeholder="Добавьте комментарий к заявке"></textarea><br/>
<label for="phone">Планируемая дата выполнения</label><br/>
<input type="date" name="deadline" size="30" maxlength="300" style="width: 500px;" placeholder="Введите план. дату" required="required" value="'.$edDeadline.'"><br/>
Выберите начальника отдела</br>
<select name="chief" required="required">
          <option value="Утнюхин Р.В.">Утнюхин Р.В.</option>
          <option value="Конюкова И.В.">Конюкова И.В.</option>
      </select><br/>
      <input id="submit" type="submit" name="update" style="width: 150px; font-size:14px; " value="Сохранить заявку">
</form>';
if (isset($_POST['update'])) {					//по нажатию кнопки Сохранить апдейтим базу
	$client = $_POST['client'];
	$object = $_POST['object'];
	$phone = $_POST['phone'];
  $type = $_POST['select'];
	$name = $_POST['name'];
	if (!empty($_POST['comment'])){                                                                               //если не ввели никаких комментариев, то добавляем в базу только старый коммент
  $comments = $edComment.'<br/>'.$_SESSION['surname'].' ('.date ('d.m.Y  H.i.s').'): '.$_POST['comment'];
} else $comments=$edComment;
	$status = $_POST['status'];
	$chief = $_POST['chief'];
	$deadline= $_POST['deadline'];
	$dateedit=date ('d.m.Y  H.i.s');
	$log= $edlog.' Заявка отредактирована ('.$_SESSION['surname'].', '.$dateedit.'): ';
	$updateTask = mysql_query("UPDATE tasktable SET client='$client', object='$object', phone='$phone', type='".implode("<br/>", $type)."', name='$name', comments='$comments', chief='$chief', deadline='$deadline', log='$log' WHERE number ='$num'");
	echo '<br/><font color="#35A13F">Изменения сохранены</font>';
}
?>