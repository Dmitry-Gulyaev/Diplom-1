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
	<style>
		body {
		background-color:#ABCDEF ;
		}
	</style>
</head>

<body>
	<div class = "header">
	<span class = "text"> <img src = "images/logo.png" style="vertical-align: middle" ></span> 
	<a href = "index11.php" class = "menuButton"> <img src = "images/house.png" style="vertical-align: middle">Главная </a>
	<a href = "earn.php" class = "menuButton"> <img src = "images/dollars.png" style="vertical-align: middle">Заработать</a>
	<a href = "recruitment.php.php" class = "menuButton"> <img src = "images/truck.png" style="vertical-align: middle"> Нанять </a> 
	
	
	
	<form method = "POST" class = "search"> 
	<input type = "search" name = "searchInput" class = "searchInput" placeholder = "Поиск" > 
	<input type="submit" name="searchSubmit" value="" class="searchSubmit" >
	</form>
	
	</div>
	<div class = "content">
		<div class = "textContent">
		<p align = "right"> <a href="help.php" target="_blank"><img src="http://www.gifmania.ru/Animated-Gifs-Animirovannykh-Alfavitov/Animations-Punctuation-Marks/Images-Question-mark/Question-mark-26249.gif" alt="Справка" height = "20px" title = "Справка" /></a> </p>
<?
echo '
		<fieldset>
				<legend>Форма регистрации</legend>
				<table>
				<tr>
				<form method = "POST">
				<td>	Придумайте логин  </td>
				<td>	<input required type = "text" name = "login"  placeholder = "| Введите логин" value = '.$_POST['login'].'>  </td>
				</tr> <tr>
				<td>	  Введите Email  </td>
				<td>	<input required type = "text" name = "email" placeholder = "| Введите Email"  value = '.$_POST['email'].'> </td>
				</tr><tr>
				<td>	<label for = "password"> Придумайте пароль</label> </td>
				<td>	<input required type = "password" name = "password" placeholder = "| Введите пароль"> </td>
				</tr><tr>
				<td>	<label for = "rePassword"> Повторите пароль</label> </td>
				<td>	<input required type = "password" name = "rePassword" placeholder = "| Повторите пароль"> </td>
				</tr> <tr>
				
				</tr> <tr>
							
				<td> <button name = "enterReg"> <img src = "images/todo.png" style="vertical-align: middle">Регистрация </button> </td>
				</form>
				</table>
				
			</fieldset> ';
?>			
			
<?	if (isset ($_POST ['searchSubmit']))
	{
		header ("Location: search.php?query=".$_POST['searchInput']."");
		
	}
	if (isset($_POST['enterReg']))
	{
			$err = array();
			
			if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
			{
				$err[] = "Логин может содержать только символы латинского алфавита и цифры!";
			}
			
			$query = mysql_query("SELECT COUNT(id) FROM user_freight WHERE login='".mysql_real_escape_string($_POST['login'])."'");
			if(mysql_result($query, 0) > 0)
			{
				$err[] = "К сожалению, пользователь с таким логином уже существует в базе данных. Пожалуйста, придумайте другой логин.";
			}
			
			if (strlen ($_POST['login'])<3 or strlen ($_POST['login'])>50)
			{
				$err[] = "Ваш логин слишком короткий или длинный. Он должен содержать не менее 3-х и не более 50-ти символов. ";
			}
			
			
			if (strlen ($_POST['password'])<6 or strlen ($_POST ['password'])>50)
			{
				$err[] = "Ваш пароль слишком короткий или длинный. Он должен содержать не менее 6-ти и не более 50-ти символов.";
			}
			if ($_POST['password'] != $_POST['rePassword'])
			{
				$err[] = "Введеные Вами пароли не совпадают!";
			}
			else 
			{
				$pass = md5(md5($_POST['password']));
			}
			
			if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
			{
				$err[] = "Укажите свой настоящий адрес почтового ящика!";
			}
			
			/*$number = $_POST['phone'] {0};
			
			if ($number !=9 or strlen ($_POST['phone']) !=10)
			{
				$err []= "Введите номер мобильного телефона без &#171 8 &#187."; #&#171  &#187
			}
			if ($_POST['select'] == "Не выбрано")
			{
				$err []="Пожалуйста, выберете место проживания. Если этого населенного пункта нет в списке, то выберете ближайшее к нему.";
			}*/
			
				if(count($err) == 0) 
				{
					date_default_timezone_set('UTC');
					$offset=strtotime("+6 hours");
					$data_reg = date('d/m/Y H:i',$offset);
					echo "<p class = 'green'> Аккаунт успешно зарегистрирован! Дата: ".$data_reg."</p> Пожалуйста, перейдите в личный кабинет и заполните информацию о себе.";
					$reg = mysql_query ("INSERT INTO user_freight SET `login` = '".$_POST['login']."', `password` = '".$pass."', `email` = '".$_POST['email']."', `activation_mail`='Не активирован', `rang` = 'Пользователь', `data_reg` = '".$data_reg."', `BAN` = 'no'");
				}
				else 
				{
					echo "<p class = 'red'> Во время регистрации возникли следующие ошибки: </p> ";
					
					foreach($err AS $error)
					{
						echo  "<p class = 'red'>".$error." </p>";
					}
				}
	}
			
?>		
			
			
		</div>
	</div>
	
	<div class = "right"> 
		<div class = "profile">
			<img src = "images/user.png" title = "Ваш профиль" style="vertical-align: middle"> 
			
			Заполняем...
		</div>
		
		<div class = "news">
			<img src = "images/news.png" title = "Новости"> </br>
			<? require_once ('news.php'); ?>
		</div>
		
		<div class = "add">
			<img src = "images/add.png" title = "Реклама"> 
		</div>
	</div>
</body>

<?

?>


</html>



