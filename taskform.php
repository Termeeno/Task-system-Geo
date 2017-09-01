
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>"Геоплан"</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form action="form.php" form enctype="multipart/form-data" method="post" name="form">
<fieldset>
<label for="client">ФИО заявителя</label><br/>
<input type="text" name="client" size="30" maxlength="300"><br/>
<label for="contacts">Контакты</label><br/>
<input type="text" name="contacts" size="30" maxlength="300"><br/>
<select name="select">
          <option selected="selected">Выберите тип заявки</option>
          <option value="ГПЗУ">ГПЗУ</option>
          <option value="Техплан">Техплан</option>
      </select><br/>
<label for="name">Название работы:</label><br/>
<textarea type="text" name="name" style="width: 500px; height: 100px;" maxlength="4000"></textarea><br/>
<select name="select2">
          <option value="Не оплачен">Не оплачен</option>
          <option value="Оплачен">Оплачен</option>
      </select><br/>
      <label for="comment">Комментарий</label><br/>
<textarea type="text" name="comment" style="width: 400px; height: 100px;" maxlength="250"></textarea><br/>
<select name="select3">
          <option selected="selected">Выберите начальника отдела</option>
          <option value="Утнюхин Р.В.">Утнюхин Р.В.</option>
          <option value="Конюкова И.В.">Конюкова И.В.</option>
      </select><br/>
</fieldset>
<br/>
<fieldset>
<input id="submit" type="submit" value="Опубликовать"><br/>
</fieldset>
<a href="adm.php?do=logout">Выход из админапаки</a>
</form>
</body>
</html>