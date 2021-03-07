<!DOCTYPE html> 
<?php
 
 
/*Соединяеся с базой и делаем выборку из таблицы*/
 
$mysql_login='root';
$mysql_host='localhost';
$mysql_pass=''; 
$mysql_db='testdb';
$connect=mysql_connect($mysql_host,$mysql_login,$mysql_pass) or die("Не могу подключиться к БД MySQL: " . mysql_error());
$select=mysql_select_db($mysql_db) or die("БД с таким именем не найдена: " . mysql_error());
/* Проверяем наличие пользователя с таким логином в БД */
$sql = mysql_query("SELECT DISTINCT type FROM requests LIMIT 0 , 30") or die(mysql_error());
?>
<html> 
<head> 
<meta charset="utf-8"> 
<title>Создание заявки</title> 
</head> 
<link rel="stylesheet" href="style.css" type="text/css"/>
<body> 
<form method="post" action="done.php"> 
 <div class="main" align='center'>
<table style="margin-top:10px"> 
<tr> 
<td><label for="income_date">Дата создания: </label> 
<td><input type="date" placeholder="Введите дату обращения:" name="income_date" id="income_date""> 
<tr> 
<td><label for="type">Тип обращения: </label> 
<td>
<input list="type" name="type1" id="type1" autocomplete="off">
<datalist id="type">
    <?php while($object = mysql_fetch_object($sql)):?>
    <option value ="<?=$object->type?>"><?=$object->type?></option>
    <?php endwhile;
	 mysql_close($connect);?>
</datalist>
<tr> 
<td><label for="text">Предмет обращения: </label> 
<td><textarea name="text" rows="10" cols="40"></textarea><br> 
<tr> 
<td><label for="status">Статус заявки</label>
<td><input type="text" value="Входящая" name="status" readonly="on">
<tr>
<td colspan="3" style="text-align:center"><input type="submit" value="Сохранить">
</div>
</form>
</body> 
</html>
