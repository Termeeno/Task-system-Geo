<div class="formblock">
<form method="post" name="searchform">
 <br/>
<input type="text" name="number" size="30" maxlength="300" style="width: 250px;" placeholder="Введите номер заявки"><br/>
<input id="search" name="search" type="submit" style="width: 100px;" value="Найти"><br/>
</input>
</form>
</div>
<div class="listtasktext">
<?php
require 'scripts/connect.php';
if (isset($_POST['search'])) {
	$number = $_POST['number'];
	$result=mysql_query("SELECT * FROM tasktable WHERE number='$number'");
	while ($row = mysql_fetch_array($result)){
		echo '<font color="#1E14F3">Номер заявки:</font> '.$row["number"].'</br>';
		echo '<font color="#1E14F3">Дата заявки:</font> '.$row["date"].'</br>';
		echo '<font color="#1E14F3">Дата план. выполнения заявки:</font> '.$row["deadline"].'</br>';
		echo '<font color="#1E14F3">ФИО заказчика:</font> '.$row["client"].'</br>';
		echo '<font color="#1E14F3">Данные по объекту:</font> '.$row["object"].'</br>';
		echo '<font color="#1E14F3">Телефон:</font> '.$row["phone"].'</br>';
		echo '<font color="#1E14F3">Вид работы или услуги:</font> '.$row["type"].'</br>';
		echo '<font color="#1E14F3">Описание работы/услуги:</font> '.$row["name"].'</br>';
		echo '<font color="#1E14F3">Оплата:</font> '.$row["pay_status"].'</br>';
		echo '<font color="#1E14F3">Статус:</font> '.$row["status"].'</br>';
		echo '<font color="#1E14F3">Начальник отдела:</font> '.$row["chief"].'</br>';
		echo '<font color="#1E14F3">Исполнитель:</font> '.$row["worker"].'</br>';
		echo '<font color="#1E14F3">Исполнитель №2:</font> '.$row["2worker"].'</br>';
		echo '<font color="#1E14F3">Исполнитель №3:</font> '.$row["3worker"].'</br>';
		echo '<font color="#1E14F3">Время выезда:</font> '.$row["checkout_time"].'</br>';
		echo '<font color="#1E14F3">Срок выполнения заявки:</font> '.$row["deadline"].'</br>';
	}
}
?>
</div>