
<!DOCTYPE html>
<?php
	session_start();
	$connect = mysql_connect("mysql.hostinger.ru","u920145323_admin","d3i0m1a95") or die (mysql_error());
	mysql_select_db("u920145323_bd1");
	if (mysqli_connect_errno()) {
    printf("Соединение не установлено: %s\n", mysqli_connect_error());
    exit();

	}
?>
<html>

<head>
	<meta charset = "UTF-8">
	<title>Доставка грузов. Омск</title>
	<link rel="shortcut icon" href="images/ico.png" type="image/x-icon">
	<link rel="stylesheet" href="style.css">
	<meta name="description" content="Грузоперевозки Омск"> 
	<meta name="Keywords" content="Груз, грузоперевозки, Омск, 55 регион, 55 rus, грузодоставки, ГрузОмск, доставка грузов"> 
	<style>
		body {
		background-color:#ABCDEF ;
		}
	</style>
 </head>
	


<body>
	<div class = "header">
	<span class = "text"> <img src = "images/logo.png" style="vertical-align: middle" ></span> 
	<a href = "index11.php" class = "menuButton"><img src = "images/house.png" style="vertical-align: middle" > Главная </a>
	<a href = "earn.php" class = "menuButton"> <img src = "images/dollars.png" style="vertical-align: middle">Заработать</a>
	<a href = "recruitment.php" class = "menuButton"> <img src = "images/truck.png" style="vertical-align: middle"> Нанять </a> 
	
	
	<form method = "POST" class = "search"> 
	<input type = "search" name = "searchInput" class = "searchInput" placeholder = "Поиск" > 
	<input type="submit" name="searchSubmit" value="" class="searchSubmit" >
	</form>
	
	</div>
	<div class = "content">
		<div class = "textContent">
		<p align = "right"> <a href="help.php" target="_blank"><img src="http://www.gifmania.ru/Animated-Gifs-Animirovannykh-Alfavitov/Animations-Punctuation-Marks/Images-Question-mark/Question-mark-26249.gif" alt="Справка" height = "20px" title = "Справка" /></a> </p>
		<table>
			<tr>
				<td> У Вас есть автомобиль? Вы собираетесь поехать в поездку по Омской области и в Вашем багажнике или кузове есть свободное место? </br> Так почему бы не подобрать на нашем сервисе попутчика с грузом и не заработать на этом? </br> На нашем сервисе Вы с легкостью сможете подобрать человека с грузом, который под силу Вашему автомобилю, связаться с этим человеком, обсудить стоимость и выдвинуться в путь! </br> Регистрируйтесь бесплатно прямо сейчас!</td>
				<td> <img src = 'images/truck_back.png'> </td>
			</tr>
		</table>
		<p align = 'center' ><a href = "register.php" class = "menuButton"> <img src = "images/handshake.png" style="vertical-align: middle"> НАЧАТЬ ПОЛЬЗОВАТЬСЯ </a> </p>
		<table>
			<tr>
				<td> <img src = 'images/freight1.png'></td>
				<td> Вам нужно перевести какой-то груз по Омску и Омской области, но специализирующиеся на этом компании - не по карману? </br> На нашем сервисе Вы сможете подобрать себе водителя с подходящим для Вашего груза автомобилем и договориться о доставке по низкой цене. </td>
			</tr>
		</table>
		
		
		
		
		</div>
	</div>
	
	<div class = "right"> 
		<div class = "profile">
			<img src = "images/user.png" title = "Ваш профиль"> 
			<? require_once ('login.php'); ?>
		</div>
		
		<div class = "news">
			<img src = "images/news.png" title = "Новости"> <br>
			<? require_once ('news.php'); ?>
		</div>
		
		<div class = "add">
			<img src = "images/add.png" title = "Реклама"> <br>
			<? require_once ('advertising.php'); ?>
		</div>
	</div>
</body>

<?
	if (isset ($_POST ['searchSubmit']))
	{
	
		header ("Location: search.php?query=".$_POST['searchInput']."");
	}

?>























</html>