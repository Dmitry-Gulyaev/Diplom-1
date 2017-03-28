
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
	<a href = "recruitment.php" class = "menuButton"> <img src = "images/truck.png" style="vertical-align: middle"> Нанять </a> 
	
	
	<form method = "POST" class = "search"> 
	<input type = "search" name = "searchInput" class = "searchInput" placeholder = "Поиск" > 
	<input type="submit" name="searchSubmit" value="" class="searchSubmit" >
	</form>
	
	</div>
	<div class = "content">
		<div class = "textContent">
		<p align = "right"> <a href="help.php" target="_blank"><img src="http://www.gifmania.ru/Animated-Gifs-Animirovannykh-Alfavitov/Animations-Punctuation-Marks/Images-Question-mark/Question-mark-26249.gif" alt="Справка" height = "20px" title = "Справка" /></a> </p>
		
		<?
		if (!$_SESSION['id'])
		{
			echo "<p class = 'red'>Вы не авторизованы!</p>";
		}
		else 
		{
			$query_user = mysql_query ("SELECT * FROM `user_freight` WHERE `id` = '".$_SESSION['id']."'");
			$data_user = mysql_fetch_assoc ($query_user);
			
			echo "Ваш ID = ".$_SESSION['id']."<br>";
			echo "Ваш логин: ".$data_user['login']."";
			echo "
			<form method = 'POST'>
			 <label>Телефон:<input type = 'number' value = '".$data_user['phone']."' name = 'phone' title = 'Телефон нужен для связи с Вами.' required> </label> <br>
			 Отображать телефон на Вашей странице? <label> <input type = 'radio' name = 'status_phone'  value = 'Не скрыт'> Да</label> <label> <input type = 'radio' name = 'status_phone'  value = 'Скрыт'> Нет</label> <br>
			<label>Ваше имя: <input type = 'text' name = 'name' value = '".$data_user['name']."' title = 'Укажите имя, чтобы мы знали как к Вам обращаться.'> </label>
			<button name = 'save'><img src = 'images/save.png' style ='vertical-align: middle'>Сохранить изменения</button> 
			</form>
			
			Аватар: <br> Оптимальный размер фотографии: 100х125px <br>
			<form enctype = 'multipart/form-data' method = 'POST'>
				<input type = 'file'  name ='filename' accept='image/*'>
				<button name = 'download_photo'> <img src = 'images/download.png' style = 'vertical-align: middle'> Загрузить фото</button>
			</form>
			";
		}	
		
		if (isset ($_POST['save']))
		{
			$update_user  = mysql_query ("UPDATE `user_freight` SET `phone` = '".$_POST['phone']."', `status_phone` = '".$_POST['status_phone']."', `name` = '".$_POST['name']."' WHERE `id` = '".$_SESSION['id']."' ");
			echo "<p class = 'green'>Информация изменена.</p>";
		}
		if (isset($_POST['download_photo']))
		{
					$id = $_SESSION['id'];
					$filename = "$id".".png";
					if ($_FILES["filename"]["size"] > 2*1024*1024)
					{
						echo "<p class = 'red'>Размер файла превышает 2 Мб. Уменьшите размер фото и попробуйте снова. </p>  ";
						exit;
					}
					
					if (is_uploaded_file($_FILES ["filename"]["tmp_name"]))
					{
						 move_uploaded_file($_FILES["filename"]["tmp_name"], "images/avatar/".$filename);
						 echo ("<p class = 'green'>Аватар обновлен.</p>");
					}
					else 
					{
						echo("<p class = 'red'> Ошибка загрузки файла</p>");
					
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