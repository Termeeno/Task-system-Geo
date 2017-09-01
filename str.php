<?php
session_start();
echo '<form method="post" name="searchform">
    <input type="text" name="phone" size="30" maxlength="300" style="width: 160px;" placeholder="текст">
    
    <input id="search" name="control" type="submit" style="width: 210px; background-color: #F6AE47;" value="Добавить запись">
    <input id="search" name="uns" type="submit" style="width: 210px; background-color: #F6AE47;" value="Очистка сессии"> 
      <br/>
</form>';
$temp=$_SESSION['stroke'];
if (isset($_POST['control'])) {
$text=$_POST['phone'];
$out=htmlspecialchars('<option value="'.$text.'">'.$text.'</option>');
$_SESSION['stroke']= $temp.'<br/>'.$out;
echo $_SESSION['stroke'];
}
if (isset($_POST['uns'])) {
  unset ($_SESSION['stroke']);
  }
?>