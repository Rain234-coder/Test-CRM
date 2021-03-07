<!DOCTYPE html> 
<html> 
<head> 
<meta charset="utf-8"> 
<title>Обновление бд</title> 
</head> 
<link rel="stylesheet" href="style.css" type="text/css"/>
<body> 
<form action="main.php" method="post">
 <div class="main" align='center'>
<?php
$mysql_login='root';
$mysql_host='localhost';
$mysql_pass=''; 
$mysql_db='testdb';
$connect=mysql_connect($mysql_host,$mysql_login,$mysql_pass) or die("Не могу подключиться к БД MySQL: " . mysql_error());
$select=mysql_select_db($mysql_db) or die("БД с таким именем не найдена: " . mysql_error());
$n0=trim($_POST["income_date"]);
$n1=trim($_POST["type1"]);
$n2=trim($_POST["text"]);
$n3=trim($_POST["status"]);
$n4=trim($_POST["comm"]);
$n5=trim($_POST["work_date"]);
$n6=trim($_POST["id"]);
$n7=trim($_POST["comm2"]);
if ($n3=='Входящая')
{
$sql = mysql_query("INSERT INTO `requests` (`income_date`, `type`,`text`,`status`) VALUES ('$n0', '$n1', '$n2', '$n3')") or die(mysql_error());
}
elseif ($n3=='В работе')
{
$sql = mysql_query("UPDATE `requests` SET `status`='$n3', `comm1`='$n4', `work_date`='$n5' WHERE `id`='$n6'") or die(mysql_error());	
}
else{
	$sql = mysql_query("UPDATE `requests` SET `status`='$n3', `comm2`='$n7' WHERE `id`='$n6'") or die(mysql_error());	
}
if ($sql==TRUE) {
      echo '<p>Данные успешно добавлены в таблицу.</p>';
    } else {
      echo '<p>Произошла ошибка: ' . mysqli_error($connect) . '</p>';
	}
mysql_close($connect);
session_start();
?>
<input type="submit" value="Вернуться в панель" style="margin:0 auto">
<input type="hidden" name="login" value="<?php echo $_SESSION['login'];?>">
<input type="hidden" name="password" value="<?php echo $_SESSION['password'];?>">
<?php 
session_unset();
session_destroy();
?>
 </div>
</body> 
</html>