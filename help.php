
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
	<a href = "index11.php" class = "menuButton"><img src = "images/house.png" style="vertical-align: middle" > Главная </a>
	<a href = "earn.php" class = "menuButton"> <img src = "images/dollars.png" style="vertical-align: middle">Заработать</a>
	<a href = "recruitment.php.php" class = "menuButton"> <img src = "images/truck.png" style="vertical-align: middle"> Нанять </a> 
	
	
	<form method = "POST" class = "search"> 
	<input type = "search" name = "searchInput" class = "searchInput" placeholder = "Поиск" > 
	<input type="submit" name="searchSubmit" value="" class="searchSubmit" >
	</form>
	
	</div>
	<div class = "content">
		<div class = "textContent">
		
		<p class = 'green'> Пожалуйста, ознакомьтесь со справочной информацией, находящейся снизу. Если Вы не нашли интересующую Вас информацию - обратитесь в <a href = 'help.php?anchor=support'>техподдержку.</a></p>	
			
			
			
			
			
			
		<?
				if ($_GET['anchor'] == 'support')
				{
					if ($_SESSION['id'])
					{
						$query = mysql_query ("SELECT * FROM `user_freight` WHERE `id` = '".$_SESSION['id']."'");
						$data = mysql_fetch_assoc($query);
						
						echo "
							<fieldset>
								<legend> Задать вопрос администрации </legend>
								<form method = 'POST'>
								<input required name = 'title' type = 'text' placeholder = 'Введите заголовок вопроса' style = 'width:350px'> </br>
								<textarea required placeholder='Изложите суть вопроса (макс 1000 символов)' name = 'askSupport' maxlength = '1000' style = 'width:350px; height:350px;resize: none;'></textarea> </br>
								<button name = 'askButton'> <img src = 'images/message.png' style='vertical-align: middle'> Спросить</button>
								</form>
							</fieldset>
						";
						
						if (isset ($_POST['askButton']))
						{
							echo "Ваш вопрос отправлен. Ожидайте ответа администрации.";
							$ask = mysql_query ("INSERT INTO `support` SET `login_user` = '".$data['login']."', `title` = '".$_POST['title']."',`textAsk` = '".$_POST['askSupport']."', `status` = 'Активен'");
						}
					}
				}
		?>		
			
		</div>
	</div>
	
	<div class = "right"> 
		<div class = "profile">
			<img src = "images/user.png" title = "Ваш профиль"> 
			<? require_once ('login.php'); ?>
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
	if (isset ($_POST ['searchSubmit']))
	{
	
		header ("Location: search.php?query=".$_POST['searchInput']."");
	}

?>























</html>