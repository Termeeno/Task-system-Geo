<form method="post" name="searchform">
<select name="select_type" style="width: 180px;">
          <option selected="selected">Выберите тип заявки</option>
           <?php
      require 'scripts/connect.php';
      $result=mysql_query("SELECT * FROM resources");
      while ($row = mysql_fetch_array($result)){
        $text=$row["type_list"]; 
        }
        echo $text;
         ?>
      </select>
      <input type="text" name="number" size="30" maxlength="300" style="width: 160px;" placeholder="Введите номер заявки">
      <br/>
      <select name="select_pay" style="width: 180px;">
      <option selected="selected">Выбор статуса оплаты</option>
          <?php
      require 'scripts/connect.php';
      $result=mysql_query("SELECT * FROM resources");
      while ($row = mysql_fetch_array($result)){
        $text=$row["pay_list"]; 
        }
        echo $text;
         ?>
      </select>
    <input type="text" name="client" size="30" maxlength="300" style="width: 160px;" placeholder="Введите ФИО Заказчика">
    <select name="select_status" required="required">
      <option selected="selected">Выберите статус</option>
          <?php
      require 'scripts/connect.php';
      $result=mysql_query("SELECT * FROM resources");
      while ($row = mysql_fetch_array($result)){
        $text=$row["status_list"]; 
        }
        echo $text;
         ?>
      </select>
      <br/>
    <input type="text" name="phone" size="30" maxlength="300" style="width: 160px;" placeholder="Телефон Заказчика">
      <input type="text" name="object" size="30" maxlength="300" style="width: 205px;" placeholder="Введите название объекта">
      <br/>
      <input type="date" name="datein" size="30" maxlength="300" style="width: 170px;"> - 
      <input type="date" name="dateout" size="30" maxlength="300" style="width: 170px;">
      <br/>
      <input id="search" name="search" autofocus type="submit" style="width: 70px;" value="Найти"><input type="reset" style="width: 150px;" value="Очистить форму"><input id="search" name="control" type="submit" style="width: 210px; background-color: #F6AE47;" value="Отобразить заявки на контроле">  
</form>