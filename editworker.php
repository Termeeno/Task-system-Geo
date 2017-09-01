<?php
 		require 'scripts/connect.php';

        $num=$_GET["num"];
        echo '<p class="button" style="text-align:center;"><a href="alltask.php" style="text-decoration: none; padding:5px 5px; color:#000000; background-color:#F6F6F6; border-radius:10px; border: 1px solid #b1b4b5;">Закрыть окно редактирования</a></p>';
        echo '<p align="center"><font color="#C11212">Заявка №: </font><font color="#097A1C">'.$num.'</font></p>';
        $editresult=mysql_query("SELECT * FROM tasktable WHERE number= '$num' AND (worker LIKE '%".$_SESSION['surname']."%' OR 2worker LIKE '%".$_SESSION['surname']."%' OR 3worker LIKE '%".$_SESSION['surname']."%')");
        while ($row = mysql_fetch_array($editresult)){
          $edClient=$row["client"];
          $edPhone=$row["phone"];
          $edObject=$row["object"];
          $edType=$row["type"];
        	$edComment=$row["comments"];
          $edWorker1=$row["worker"];          
          $edWorker2=$row["worker2"];         
          $edWorker3=$row["worker3"];        	
        	$edStatus=$row["status"];
        	$edlog=$row["log"];
        }
        $checkResult=mysql_query("SELECT * FROM tasktable WHERE number= '$num' AND worker LIKE '%".$_SESSION['surname']."%'");                //цикл для выяснения, под каким номером данный исполнитель. 
         while ($row = mysql_fetch_array($checkResult)){                                                                                      //Нужно для того, чтобы отмечать цветом ячейки работников 
          $checkUser=$row["worker"];                                                                                                          //(типа когда выполнили только свою часть заявки)
        }
        if (!empty($checkUser)) {
            $nameRow='worker_1_check';
        }  else 
        $checkResult=mysql_query("SELECT * FROM tasktable WHERE number= '$num' AND 2worker LIKE '%".$_SESSION['surname']."%'");
                while ($row = mysql_fetch_array($checkResult)){
                $check2User=$row["2worker"];
              }
         if (!empty($check2User)) {
                $nameRow='worker_2_check';
         } else 
         $checkResult=mysql_query("SELECT * FROM tasktable WHERE number= '$num' AND 3worker LIKE '%".$_SESSION['surname']."%'");
                while ($row = mysql_fetch_array($checkResult)){
                $check3User=$row["3worker"];
              } if (!empty($check3User)) {
                $nameRow='worker_3_check';
              }
         echo '<font color="#5C748C">Заказчик:   </font><font color="#097A1C">'.$edClient.'</font></br>';
        echo '<font color="#5C748C">Телефон:   </font><font color="#097A1C">'.$edPhone.'</font></br>';
        echo '<font color="#5C748C">Объект:   </font><font color="#097A1C">'.$edObject.'</font></br>';
        echo '<font color="#5C748C">Виды работ:   </font><font color="#097A1C">'.$edType.'</font><br/><br/>';
        echo '<form enctype="multipart/form-data" method="post" name="form">
        <br/>
      <label for="comment">Комментарий<font size="1" color="green" face="Arial"> (Обратите внимание- старые комментарии сохраняются)</font></label><br/>
<textarea type="text" name="comment" style="width: 500px; height: 100px;" maxlength="250" placeholder="Добавьте комментарий к заявке"></textarea><br/><br/>
Текущий статус заявки: '.$edStatus.'<br/>
<input id="submit" type="submit" name="finish" style="width: 240px; font-size:14px; " value="Поставить отметку о выполнении"><input id="submit" type="submit" name="notfinish" style="width: 240px; font-size:14px; " value="Снять отметку о выполнении"><br/><br/>
<select name="select_status">
      <option selected="selected">Выберите статус</option>
          <option value="Принята в работу">Принята в работу</option>
          <option value="Приостановлена">Приостановлена</option>
          <option value="Отменена">Отменена</option>
          <option value="Выполнена частично">Выполнена частично</option>
          <option value="Выполнена">Выполнена</option>
      </select>
            <input id="submit" type="submit" name="update" style="width: 150px; font-size:14px; " value="Сохранить заявку">
</form>';
if (isset($_POST['finish'])) {          //по нажатию кнопки поставить отметку меняем цвет в ячейке работника
  $updateTask=mysql_query("UPDATE tasktable SET log='$log', ".$nameRow."='#7BE18E' WHERE number ='$num' AND (worker LIKE '%".$_SESSION['surname']."%' OR 2worker LIKE '%".$_SESSION['surname']."%' OR 3worker LIKE '%".$_SESSION['surname']."%')");
  echo '<br/><font color="#35A13F">Отметка о выполнении проставлена</font>';
  }
if (isset($_POST['notfinish'])) {          //по нажатию кнопки поставить отметку меняем цвет в ячейке работника
  $updateTask=mysql_query("UPDATE tasktable SET log='$log', ".$nameRow."='#D0DFEF' WHERE number ='$num' AND (worker LIKE '%".$_SESSION['surname']."%' OR 2worker LIKE '%".$_SESSION['surname']."%' OR 3worker LIKE '%".$_SESSION['surname']."%')");
  echo '<br/><font color="#35A13F">Отметка о выполнении снята</font>';
  }
if (isset($_POST['update'])) {					//по нажатию кнопки Сохранить апдейтим базу
  if (!empty($_POST['comment'])){                                                                               //если не ввели никаких комментариев, то добавляем в базу только старый коммент
	$comments = $edComment.'<br/>'.$_SESSION['surname'].' ('.date ('d.m.Y  H.i.s').'): '.$_POST['comment'];
} else $comments=$edComment;
if ($_POST['select_status']=='Выберите статус') {
  $status=$edStatus;
} else $status= $_POST['select_status'];
	$dateedit=date ('d.m.Y  H.i.s');
	$log= $edlog.' Заявка отредактирована ('.$_SESSION['surname'].', '.$dateedit.'): ';
	$updateTask = mysql_query("UPDATE tasktable SET comments='$comments', status='$status', log='$log' WHERE number ='$num' AND (worker LIKE '%".$_SESSION['surname']."%' OR 2worker LIKE '%".$_SESSION['surname']."%' OR 3worker LIKE '%".$_SESSION['surname']."%')");
  echo '<br/><font color="#35A13F">Изменения сохранены</font>';
}
?>