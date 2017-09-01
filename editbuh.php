<?php
 		require 'scripts/connect.php';

        $num=$_GET["num"];
        echo '<p class="button" style="text-align:center;"><a href="alltask.php" style="text-decoration: none; padding:5px 5px; color:#000000; background-color:#F6F6F6; border-radius:10px; border: 1px solid #b1b4b5;">Закрыть окно редактирования</a></p>';
        echo '<p align="center"><font color="#C11212">Заявка №: </font><font color="#097A1C">'.$num.'</font></p>';
        $editresult=mysql_query("SELECT * FROM tasktable WHERE number= '$num'");
        while ($row = mysql_fetch_array($editresult)){
          $edClient=$row["client"];
          $edPhone=$row["phone"];
          $edObject=$row["object"];
          $edType[]=$row["type"];
          $edTypeLabel=$row["type"];
        	$edComment=$row["comments"];        	
        	$edPay=$row["pay_status"];
        	$edlog=$row["log"];
        }
         echo '<font color="#5C748C">Заказчик:   </font><font color="#097A1C">'.$edClient.'</font></br>';
        echo '<font color="#5C748C">Телефон:   </font><font color="#097A1C">'.$edPhone.'</font></br>';
        echo '<font color="#5C748C">Объект:   </font><font color="#097A1C">'.$edObject.'</font></br>';
        echo '<font color="#5C748C">Виды работ:   </font><font color="#097A1C">'.$edTypeLabel.'</font><br/><br/>';
        echo '<form enctype="multipart/form-data" method="post" name="form">
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
<select name="select[]" id="para" size="5" multiple>';
$result=mysql_query("SELECT * FROM resources");
      while ($row = mysql_fetch_array($result)){
        $text=$row["type_list"]; 
        }
        echo $text;
      echo '</select><br/>
      <label for="comment">Комментарий</label><br/>
<textarea type="text" name="comment" style="width: 500px; height: 100px;" maxlength="250" placeholder="Добавьте комментарий к заявке"></textarea><br/>
<br/>
<select name="select_pay" required="required">
<option selected="selected">Выберите статус оплаты</option>
          <option value="Оплачен">Оплачен</option>
          <option value="Не оплачен">Не оплачен</option>
          <option value="Внесен аванс">Внесен аванс</option>
      </select><br/><br/>
      <input id="submit" type="submit" name="update" style="width: 150px; font-size:14px; " value="Сохранить заявку">
</form>';
if (isset($_POST['update'])) {					//по нажатию кнопки Сохранить апдейтим базу
	if (!empty($_POST['comment'])){                                                                               //если не ввели никаких комментариев, то добавляем в базу только старый коммент
  $comments = $edComment.'<br/>'.$_SESSION['surname'].' ('.date ('d.m.Y  H.i.s').'): '.$_POST['comment'];
} else $comments=$edComment;
  if ($_POST['select_pay']=='Выберите статус оплаты') {
    $pay_status=$edPay;
  } else $pay_status = $_POST['select_pay'];
	$dateedit=date ('d.m.Y  H.i.s');
  if (!empty($_POST['select'])){
  $type = $_POST['select'];
} else $type=$edType;
	$log= $edlog.' Заявка отредактирована ('.$_SESSION['surname'].', '.$dateedit.'): ';
	$updateTask = mysql_query("UPDATE tasktable SET type='".implode("<br/>", $type)."', comments='$comments', pay_status='$pay_status', log='$log' WHERE number ='$num'");
	echo '<br/><font color="#35A13F">Изменения сохранены</font>';
}
?>