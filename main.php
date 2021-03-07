<!DOCTYPE html> 
<html> 
<head> 
<link rel="stylesheet" href="style.css" type="text/css"/>
<meta charset="utf-8"> 
<title>Главная страница</title> 
</head> 
<body> 
<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
$login=trim($_POST["login"]);
$password=trim($_POST["password"]);
/* Проверка заполнения всех полей формы авторизации */
if(empty($login) or empty($password))
{
 ?>
 <html>
 <head>
 <link rel="stylesheet" href="style.css" type="text/css"/>
 <title>Error</title></head>
 <body>
 <div align='center' class="main">
 <h1 align='center'>Одно из полей не заполнено</h1>
 <a href="/index.php" align='center'>Назад к заполнению</a>
 </div>
 </body>
 </html>
<?php
session_unset();
session_destroy();
exit;
}
/* Подключение к базе в случае успеха предыдущих проверок */
$mysql_login='root';
$mysql_host='localhost';
$mysql_pass=''; 
$mysql_db='testdb';
$connect=mysql_connect($mysql_host,$mysql_login,$mysql_pass) or die("Не могу подключиться к БД MySQL: " . mysql_error());
$select=mysql_select_db($mysql_db) or die("БД с таким именем не найдена: " . mysql_error());
/* Проверяем наличие пользователя с таким логином в БД */
$query_login = mysql_query("SELECT * FROM `users` WHERE `login` = '$login' LIMIT 0 , 30") or die(mysql_error());
$answer=mysql_num_rows($query_login);
if ($answer==0)
{
 ?><html>
 <head>
 <link rel="stylesheet" href="style.css" type="text/css"/>
 <title>Error</title></head>
 <body>
 <div align='center' class="main">
 <h2 align='center'>Пользователь с таким логином в БД не найден..</h2>
 <a href="/index.php" align='center'>Вернуться назад</a>
 </div>
 </body>
 </html>
 <?php
 mysql_close($connect);
session_unset();
session_destroy();
 exit;
}
/* Проверяем корректность пары логин-пароль */
$answer_pass=mysql_fetch_array($query_login);
$_SESSION['login']=$login;
$_SESSION['password']=$password;
if($answer_pass['password']!=$password)
 {
 ?><html>
 <head>
 <link rel="stylesheet" href="style.css" type="text/css"/>
 <title>Error</title></head>
 <body>
 <div align='center' class="main">
 <h1 align='center'>Пароль введен не верно.</h1>
 <a href="/index.php" align='center'>Вернуться назад</a>
 </div>
 </body>
 </html>
 <?php
 mysql_close($connect);
session_unset();
session_destroy();
 exit;
 }
?>
 <div align='center' class="main" style="width:600px; margin:0 auto">
 <a href="/index.php" style="margin:10px 0 0 90%; height:30px; text-decoration:none; border:3px solid black; padding:3px; color:black">Выйти</a>
 <h1 style="margin:5px auto">Личный кабинет <font color="red"><?php echo
$answer_pass['login'];?></font></p></h1>
<div class="tabs">
    <input type="radio" name="inset" value="" id="tab_1" checked>
    <label for="tab_1">Входящие</label>

    <input type="radio" name="inset" value="" id="tab_2">
    <label for="tab_2">В работе</label>

    <input type="radio" name="inset" value="" id="tab_3">
    <label for="tab_3">Выполненные</label>
		<div id="txt_1">
	<?php
	$sql = mysql_query("SELECT * FROM `requests` WHERE `status` = 'Входящая' LIMIT 0 , 30") or die(mysql_error());
	 while($object = mysql_fetch_object($sql)):?>
			<div class="tab" id="<?=$object->id?>">
				<input id="tab-<?=$object->id?>" type="checkbox" name="tabs" style="position:absolute"> 
				<label for="tab-<?=$object->id?>" style="background:#42aaff">Обращение №<?=$object->id?></label>
					<div class="tab-content">
						<form method="post" action="done.php"> 
						<table style="margin-top:10px"> 
						<tr> 
						<td><label for="income_date">Дата создания: </label> 
						<td><input type="date" value="<?=$object->income_date?>" readonly="on" name="income_date" id="income_date"> 
						<tr> 
						<td><label for="type">Тип обращения: </label> 
						<td>
						<input list="type" value="<?=$object->type?>" readonly="on" name="type1" id="type1">
						<tr> 
						<td><label for="text">Предмет обращения: </label> 
						<td><textarea name="text" rows="10" cols="40"readonly="on"" ><?=$object->text?></textarea><br> 
						
						<tr>
						<td><label for="comm">Комментарий: </label> 
						<td><textarea name="comm" rows="10" cols="40"></textarea><br> 
						<tr> 
						<td><label for="work_date">Дата назначения заявки: </label> 
						<td><input type="date" name="work_date" id="work_date"> 
						<tr> 
						<td><label for="status">Статус заявки</label>
						<td><select name="status" id="status">
						<option selected value ="Входящая">Входящая</option>
						<option value ="В работе">В работе</option>
						</select>
						<tr>
						<td colspan="3" style="text-align:center"><input type="submit"  name="<?=$object->id?>" value="Сохранить">
						<input type="hidden"  name="id" value="<?=$object->id?>">
						</table>
						</form>
					</div>
			</div>
		<?php endwhile;
	?>
		</div>
    <div id="txt_2">
	<?php
	$sql = mysql_query("SELECT * FROM `requests` WHERE `status` = 'В работе' LIMIT 0 , 30") or die(mysql_error());
	 while($object = mysql_fetch_object($sql)):?>
			<div class="tab" id="<?=$object->id?>">
				<input id="tab-<?=$object->id?>" type="checkbox" name="tabs" style="position:absolute"> 
				<label for="tab-<?=$object->id?>" style="background:#42aaff">Обращение №<?=$object->id?></label>
					<div class="tab-content">
						<form method="post" action="done.php"> 
						<table style="margin-top:10px"> 
						<tr> 
						<td><label for="income_date">Дата создания: </label> 
						<td><input type="date" value="<?=$object->income_date?>" readonly="on" name="income_date" id="income_date"> 
						<tr> 
						<td><label for="type">Тип обращения: </label> 
						<td>
						<input list="type" value="<?=$object->type?>" readonly="on" name="type1" id="type1">
						<tr> 
						<td><label for="text">Предмет обращения: </label> 
						<td><textarea name="text" rows="10" cols="40" readonly="on" ><?=$object->text?></textarea><br> 
						
						<tr>
						<td><label for="comm">Комментарий: </label> 
						<td><textarea name="comm" rows="10" cols="40"><?=$object->comm1?></textarea><br> 
						<tr> 
						<td><label for="work_date">Дата назначения заявки: </label> 
						<td><input type="date" value="<?=$object->income_date?>" name="work_date" id="work_date"> 
						<tr>
						<td><label for="comm2">Комментарий от рабочего: </label> 
						<td><textarea name="comm2" rows="10" cols="40"></textarea><br> 
						<tr> 
						<td><label for="status">Статус заявки</label>
						<td><select name="status" id="status">
						<option selected value ="В работе">В работе</option>
						<option value ="Выполнено">Выполнено</option>
						</select>
						<tr>
						<td colspan="3" style="text-align:center"><input type="submit"  name="<?=$object->id?>" value="Сохранить">
						<input type="hidden"  name="id" value="<?=$object->id?>">
						</table>
						</form>
					</div>
			</div>
		<?php endwhile;
	?>
    </div>
    <div id="txt_3">
<?php
	$sql = mysql_query("SELECT * FROM `requests` WHERE `status` = 'Выполнено' LIMIT 0 , 30") or die(mysql_error());
	 while($object = mysql_fetch_object($sql)):?>
			<div class="tab" id="<?=$object->id?>">
				<input id="tab-<?=$object->id?>" type="checkbox" name="tabs" style="position:absolute"> 
				<label for="tab-<?=$object->id?>" style="background:#42aaff">Обращение №<?=$object->id?></label>
					<div class="tab-content">
						<form method="post" action="done.php"> 
						<table style="margin-top:10px"> 
						<tr> 
						<td><label for="income_date">Дата создания: </label> 
						<td><input type="date" value="<?=$object->income_date?>" readonly="on" name="income_date" id="income_date"> 
						<tr> 
						<td><label for="type">Тип обращения: </label> 
						<td>
						<input list="type" value="<?=$object->type?>" readonly="on" name="type1" id="type1">
						<tr> 
						<td><label for="text">Предмет обращения: </label> 
						<td><textarea name="text" rows="10" cols="40"readonly="on"" ><?=$object->text?></textarea><br> 
						<tr>
						<td><label for="comm">Комментарий: </label> 
						<td><textarea name="comm" rows="10" cols="40" readonly="on" ><?=$object->comm1?></textarea><br> 
						<tr> 
						<td><label for="work_date">Дата назначения заявки: </label> 
						<td><input type="date" name="work_date" id="work_date" readonly="on" value="<?=$object->work_date?>"> 
						<tr>
						<td><label for="comm2">Комментарий от рабочего: </label> 
						<td><textarea name="comm2" rows="10" cols="40" readonly="on"><?=$object->comm2?></textarea><br> 
						<tr> 
						<td><label for="status">Статус заявки</label>
						<td><input type="text" name="status" value="<?=$object->status?>" readonly="on">
						</table>
						</form>
					</div>
			</div>
		<?php endwhile;
	?>
    </div>
</div>
<form action="request.php" method="post">
<input type="submit" value="Создать заявку" style="margin:10px 90% 0 0">
</div>
</body> 
</html>
