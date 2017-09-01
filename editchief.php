<?php
 		require 'scripts/connect.php';

      $result=mysql_query("SELECT * FROM resources");                             //запрос списка работников и статусов
      while ($row = mysql_fetch_array($result)){
        $text=$row["worker_list"]; 
        $statlist=$row["status_list"]; 
        }

        $num=$_GET["num"];
        echo '<p class="button" style="text-align:center;"><a href="alltask.php" style="text-decoration: none; padding:5px 5px; color:#000000; background-color:#F6F6F6; border-radius:10px; border: 1px solid #b1b4b5;">Закрыть окно редактирования</a></p>';
        echo '<p align="center"><font color="#C11212">Заявка №: </font><font color="#097A1C">'.$num.'</font></p>';
        $editresult=mysql_query("SELECT * FROM tasktable WHERE number= '$num' AND chief LIKE '%".$_SESSION['surname']."%'");
        while ($row = mysql_fetch_array($editresult)){
          $edClient=$row["client"];
          $edPhone=$row["phone"];
        	$edObject=$row["object"];
          $edType=$row["type"];
        	$edComment=$row["comments"];        	
        	$edStatus=$row["status"];
        	$edWorker=$row["worker"];
        	$ed2Worker=$row["2worker"];
        	$ed3Worker=$row["3worker"];
        	$edCheckout_time=$row["checkout_time"];
        	$edlog=$row["log"];
        }
        echo '<font color="#5C748C">Заказчик:   </font><font color="#097A1C">'.$edClient.'</font></br>';
        echo '<font color="#5C748C">Телефон:   </font><font color="#097A1C">'.$edPhone.'</font></br>';
        echo '<font color="#5C748C">Объект:   </font><font color="#097A1C">'.$edObject.'</font></br>';
        echo '<font color="#5C748C">Виды работ:   </font><font color="#097A1C">'.$edType.'</font><br/><br/>';
        echo '<form enctype="multipart/form-data" method="post" name="form">
        <label for="object">Объект Заказчика</label><br/>
<input type="text" name="object" size="30" maxlength="300" style="width: 500px;" placeholder="Введите информацию об объекте Заказчика" required="required" value="'.$edObject.'"><br/><br/>
      <label for="comment">Комментарий<font size="1" color="green" face="Arial"> (Обратите внимание- старые комментарии сохраняются)</font></label><br/>
<textarea type="text" name="comment" style="width: 500px; height: 100px;" maxlength="250" placeholder="Добавьте комментарий к заявке"></textarea><br/><br/>
<font size="1" color="red" face="Arial">При назначении исполнителя статус автоматически меняется на "Направлена исполнителю"</font>
<select name="select_status">
      <option selected="selected">Выберите статус</option>
      '.$statlist.'
      </select>
      <br/><br/>
Выбор исполнителя для заявки (возможен выбор нескольких) и дату для каждого исполнителя<br/>
<select name="select_worker" style="width: 220px;">
      <option selected="selected">Не назначен</option>'
      .$text.
      '</select>
      <select name="select_2worker" style="width: 240px;">
      <option selected="selected">Не назначен</option>'
          .$text.
      '</select>
      <select name="select_3worker" style="width: 240px;">
      <option selected="selected">Не назначен</option>'
            .$text.
      '</select>
      <br/>
      <input type="date" name="datefirst" size="30" maxlength="300" style="width: 210px;">
      <input type="date" name="datesecond" size="30" maxlength="300" style="width: 230px;">
      <input type="date" name="datethird" size="30" maxlength="300" style="width: 220px;">
      <br/>
      <label for="checkout_time">Назначьте время выезда</label><br/>
<input type="text" name="checkout_time" size="30" maxlength="300" style="width: 500px;" placeholder="Введите планируемое время выезда" value="'.$edCheckout_time.'"><br/>
      <input id="submit" type="submit" name="update" style="width: 150px; font-size:14px; " value="Сохранить заявку">
       <input id="submit" type="submit" name="take" style="width: 150px; font-size:14px; " value="Взять в работу">
</form>';
if (isset($_POST['update'])) {					//по нажатию кнопки Сохранить апдейтим базу
	$object = $_POST['object'];
  if (!empty($_POST['comment'])){                                                                               //если не ввели никаких комментариев, то добавляем в базу только старый коммент
	$comments = $edComment.'<br/>'.$_SESSION['surname'].' ('.date ('d.m.Y  H.i.s').'): '.$_POST['comment'];
} else $comments=$edComment;
	if ($_POST['select_worker']!='Не назначен' OR $_POST['select_2worker']!='Не назначен' OR $_POST['select_3worker']!='Не назначен') {
		$status = 'Направлена исполнителю';
	} else if($_POST['select_status']!='Выберите статус' AND $_POST['select_worker']=='Не назначен' AND $_POST['select_2worker']=='Не назначен' AND $_POST['select_3worker']=='Не назначен') {
		$status = $_POST['select_status'];
	} else if ($_POST['select_status']!='Выберите статус' AND ($_POST['select_worker']=='Не назначен' OR $_POST['select_2worker']=='Не назначен' OR $_POST['select_3worker']=='Не назначен')) {
		$status = 'Направлена исполнителю';
  }  else if ($_POST['select_status']=='Выберите статус' AND $_POST['select_worker']=='Не назначен' AND $_POST['select_2worker']=='Не назначен' AND $_POST['select_3worker']=='Не назначен') {
    $status=$edStatus;
  }
  if ($_POST['select_worker']=='Не назначен') {
    $worker=$edWorker;
  } else { if (!empty($_POST['datefirst'])) {
      $worker= $_POST['select_worker'].'<br/>('.$_POST['datefirst'].')';
    } else $worker= $_POST['select_worker'];
  }
  if ($_POST['select_2worker']=='Не назначен') {
    $worker2=$ed2Worker;
  } else { if (!empty($_POST['datesecond'])) {
      $worker2= $_POST['select_2worker'].'<br/>('.$_POST['datesecond'].')';
    } else $worker2= $_POST['select_2worker'];
  }
  if ($_POST['select_3worker']=='Не назначен') {
    $worker3=$ed3Worker;
  } else { if (!empty($_POST['datethird'])) {
      $worker3= $_POST['select_3worker'].'<br/>('.$_POST['datethird'].')';
    } else $worker3= $_POST['select_3worker'];
  }  
	$checkout_time= $_POST['checkout_time'];
	$dateedit=date ('d.m.Y  H.i.s');
	$log= $edlog.' Заявка отредактирована ('.$_SESSION['surname'].', '.$dateedit.'): ';
	$updateTask = mysql_query("UPDATE tasktable SET object='$object', comments='$comments', status='$status', worker='$worker', 2worker='$worker2', 3worker='$worker3', checkout_time='$checkout_time', log='$log' WHERE number ='$num'");
	echo '<br/><font color="#35A13F">Изменения сохранены</font>';
}
if (isset($_POST['take'])) {         //Нажатие кнопки "Взять в работу"
  $object = $_POST['object'];
  if (!empty($_POST['comment'])){                                                                               //если не ввели никаких комментариев, то добавляем в базу только старый коммент
  $comments = $edComment.'<br/>'.$_SESSION['surname'].' ('.date ('d.m.Y  H.i.s').'): '.$_POST['comment'];
} else $comments=$edComment;
$checkout_time= $_POST['checkout_time'];
  $dateedit=date ('d.m.Y  H.i.s');
  $log= $edlog.' Заявка взята в работу начальником отдела ('.$_SESSION['surname'].', '.$dateedit.'): ';
  $workerchief = $_SESSION['surname'].' '.mb_substr($_SESSION['user'],0,1, 'UTF-8').'.'.mb_substr($_SESSION['secname'],0,1, 'UTF-8').'.';    // получаем фамилию и инициалы из сессии
  $worker2= $_POST['select_2worker'];
  $worker3= $_POST['select_3worker'];
  $status = 'Принята в работу';
  $checkout_time= $_POST['checkout_time'];
  $updateTask = mysql_query("UPDATE tasktable SET object='$object', comments='$comments', status='$status', worker='$workerchief', 2worker='$worker2', 3worker='$worker3', checkout_time='$checkout_time', log='$log' WHERE number ='$num'");
  echo '<br/><font color="#35A13F">Заявка принята в работу:</font>';
}
?>