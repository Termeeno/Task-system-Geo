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
      <select name="select_worker" required="required">
      <option selected="selected">Выберите исполнителя</option>
                <?php
      require 'scripts/connect.php';
      $result=mysql_query("SELECT * FROM resources");
      while ($row = mysql_fetch_array($result)){
        $text=$row["worker_list"]; 
        }
        echo $text;
         ?>
      </select>
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
    <select name="select_chief" required="required">
      <option selected="selected">Выберите начальника отдела</option>
          <option value="Утнюхин Р.В.">Утнюхин Р.В.</option>
          <option value="Конюкова И.В.">Конюкова И.В.</option>
      </select>
    <input id="search" name="control" type="submit" style="width: 210px; background-color: #F6AE47;" value="Отобразить заявки на контроле">  
      <br/>
      <input type="date" name="datein" size="30" maxlength="300" style="width: 170px;"> - 
      <input type="date" name="dateout" size="30" maxlength="300" style="width: 170px;">
      <input type="text" name="object" size="30" maxlength="300" style="width: 260px;" placeholder="Введите название объекта">
      <br/>
      <input id="search" name="search" autofocus type="submit" style="width: 70px;" value="Найти"><input type="reset" style="width: 150px;" value="Очистить форму">
</form>