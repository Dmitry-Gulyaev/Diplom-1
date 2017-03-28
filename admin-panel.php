
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
		<fieldset>
		<legend>Админпанель</legend>
<?
		$err = array();
		if (!$_SESSION['id'])
		{
			$err[] ="Вы не авторизированы! ";
		}
		$query = mysql_query ("SELECT * FROM `user_freight` WHERE `id` = '".$_SESSION['id']."'");
		$data = mysql_fetch_assoc($query);
		
				
		if ($data['rang'] == "Пользователь") 
		{
			$err []= "Вы не администратор";
		}
				
		if (count ($err)==0)
		{
			echo "<p class ='green'> Здравствуйте, администратор. Ваш ранг - ".$data['rang']."</p>";
			switch ($data['rang'])
			{
				case 'Модератор':
				mode();
				break;
				
				case 'Администратор':
				adm();
				break;
				
				case 'Создатель':
				adm();
				break;
			}
						
		}
		else
		{
			foreach($err AS $error)
			{
				echo "<p class = 'red'> ".$error." </p>";
			}
			
		}
		function mode()
		{
		echo "
			<fieldset>
			<form method = 'POST'>
			<button name = 'editNews'> <img src = 'images/edit.png' style='vertical-align: middle'>Редактирование новостей </button>
			<button name = 'support'> <img src = 'images/support.png' style='vertical-align: middle'>Тех поддержка </button>
			</form>
			</fieldset>
		
		";
		}
		
		function adm() 
		{
		echo "
			<fieldset>
			<form method = 'POST'>
			<button name = 'editNews'> <img src = 'images/edit.png' style='vertical-align: middle'>Редактирование новостей </button>
			<button name = 'support'> <img src = 'images/support.png' style='vertical-align: middle'>Тех поддержка </button>
			<button name = 'givadm'> <img src = 'images/givadm.png' style='vertical-align: middle'>Назначить руководителя</button>
			<button name = 'ban'> <img src = 'images/ban.png' style='vertical-align: middle'>Забанить пользователя</button>
			</form>
			</fieldset>
		
		";
		}
		
		
	 	if (isset ($_POST['editNews']))
		{
			echo "
				<fieldset>
				<legend>Добавить новую новость. </legend>
					<form method = 'POST'>
						<input type = 'text' name = 'title' placeholder = 'Заголовок новости (20 символов)' style ='width:350px'> </br>
						<input type = 'text' name = 'link' placeholder = 'Ссылка если нужна(100 символов)'style ='width:350px'> </br>
						<textarea placeholder='Текст новости (200 символов)' name = 'text' maxlength = '200' style = 'width:350px; height:250px;resize: none;'></textarea> </br>
						<input type = 'submit' name = 'enterNews' value = 'Опубликовать'>
					</form>
				</fieldset>
				";  
				
		}
		
		if (isset ($_POST['enterNews']))
		{
			if (strlen ($_POST['link'])==0)
			{
				$link =0;
			}
			else
			{
				$link = $_POST['link']; 
			}
			echo "<p class = 'green'> Новость успешно опубликована.</p>";
			date_default_timezone_set('UTC');
			$offset=strtotime("+6 hours");
			$data_reg = date('d/m/Y H:i',$offset);
			$q = mysql_query ("INSERT INTO `news_freight` SET `title` = '".$_POST['title']."', `link` = '".$link."', `date` = '".$data_reg."', `text`= '".$_POST['text']."' ");
			
			# log лог 
			$query = mysql_query ("SELECT * FROM `user_freight` WHERE `id` = '".$_SESSION['id']."'");
			$data_adm = mysql_fetch_assoc($query);
			$login_adm = $data_adm['login'];
			$log = mysql_query ("INSERT INTO `log_adm` SET `login_adm` = '".$login_adm."', `act`= 'Редактировал новость', `title_news` = '".$_POST['title']."' ");
		}
		
		if (isset ($_POST['givadm']))
		{
			
				echo "
				<fieldset>
				<legend>Выдать администраторские права</legend>
				<form method = 'POST'>
				<input type = 'text' name='idUserAdm' placeholder = 'Введите id пользователя, которого хотите назначить руководителем' style = 'width: 500px'> 
				<input type = 'submit' name = 'insp' value = 'Проверить'>
				</form>
				</fieldset>
				";
												
		}
		if (isset ($_POST['insp']))
		{
			
			$q = mysql_query ("SELECT * FROM `user_freight` WHERE `id` = '".$_POST['idUserAdm']."'");
			if (mysql_affected_rows()<1)
			{
				echo  " <p class = 'red'>Пользователь с таким id не зарегистрирован </p>";
			}
			else 
			{
				$d = mysql_fetch_assoc ($q);
				echo "Вы имели ввиду этого пользователя?";
				echo "<a href = 'user.php?id=".$d['id']."'> ".$d['login']." </a>";
				$_SESSION['hash'] = $d['login'];
				echo "
				<form method = 'POST'>
				<input type = 'submit' name = 'YesIdUserAdm' value = 'Да'>
				<input type = 'submit' name = 'NoIdUserAdm' value = 'Нет'>
				</form>
				";
			}
		}
		
		if (isset ($_POST['YesIdUserAdm']))
		{
			
			echo "Какой ранг Вы хотите выдать пользователю ".$_SESSION['hash']."? </br>
			<form method = 'POST'>
			<label> <input required type = 'radio' name = 'rang' value = 'Пользователь'>Пользователь</label>
			<label> <input required type = 'radio' name = 'rang' value = 'Модератор'>Модератор </label>
			<label> <input required type = 'radio' name = 'rang' value = 'Администратор'>Администратор</label>
			<input type = 'submit' name = 'enterGiveRang' value = 'Назначить'>
			</form>
			";
		}
		if (isset ($_POST['enterGiveRang']))
		{
			switch ($_POST['rang'])
			{
				case 'Пользователь':
				$rang_out = 'Пользователем';
				break;
				
				case 'Модератор':
				$rang_out = 'Модератором';
				break;
				
				case 'Администратор':
				$rang_out = 'Администратором';
				break;
				
			}
			$up = mysql_query ("UPDATE `user_freight` SET `rang` ='".$_POST['rang']."' WHERE `login`='".$_SESSION['hash']."' ");
			echo "<p class = 'green'>  Пользователь ".$_SESSION['hash']." успешно назначен ".$rang_out." </p>";
			
			#log лог
			$query = mysql_query ("SELECT * FROM `user_freight` WHERE `id` = '".$_SESSION['id']."'");
			$data_adm = mysql_fetch_assoc($query);
			$login_adm = $data_adm['login'];
			$log = mysql_query ("INSERT INTO `log_adm` SET `login_adm` = '".$login_adm."', `act`= 'Назначил руководителя', `login_user` = '".$_SESSION['hash']."', `give_rang` = '".$rang_out."' ");
			
			unset($_SESSION['hash']);
		}
		if (isset ($_POST['NoIdUserAdm']))
		{
			header ('Location: admin-panel.php');
		}
		
		if (isset ($_POST['ban']))
		{
			echo "
				<fieldset>
				<legend>Забанить пользователя</legend>
				<form method = 'POST'>
				<input type = 'text' name='idUserBan' placeholder = 'Введите id пользователя, которого хотите забанить' style = 'width: 500px'> 
				<input type = 'submit' name = 'inspBan' value = 'Проверить'>
				</form>
				</fieldset>
				";
		}
		
		if (isset($_POST['inspBan']))
		{
			$q = mysql_query ("SELECT * FROM `user_freight` WHERE `id` = '".$_POST['idUserBan']."'");
			if (mysql_affected_rows() <1)
			{
				echo  " <p class = 'red'>Пользователь с таким id не зарегистрирован </p>";
			}
			else
			{
				$d = mysql_fetch_assoc ($q);
				echo "Вы имели ввиду этого пользователя?";
				echo "<a href = 'user.php?id=".$d['id']."'> ".$d['login']." </a>";
				$_SESSION['hash'] = $d['login'];
				echo "
				<form method = 'POST'>
				<input type = 'submit' name = 'YesIdUserBan' value = 'Да'>
				<input type = 'submit' name = 'NoIdUserBan' value = 'Нет'>
				</form>
				";
			}
		}
		 
		if (isset($_POST['YesIdUserBan']))
		{
			echo "
			<form method = 'POST'>
				<input required type = 'text' name = 'cause' placeholder = 'Укажите причину бана'>
				<input type = 'submit' name = 'giveBan' value = 'Забанить!'>
			</form>
			";
			
		}
		
		if (isset($_POST['NoIdUserBan']))
		{
			header ("Location: admin-panel.php");
		}
		
		if (isset ($_POST['giveBan']))
		{
			echo "
			<p class = 'red'> Пользователь ".$_SESSION['hash']." забанен! </p>
			";
			$ban = mysql_query ("UPDATE `user_freight` SET `BAN` = 'yes', `cause_BAN` = '".$_POST['cause']."' WHERE `login` = '".$_SESSION['hash']."'");
			# log лог
			$query = mysql_query ("SELECT * FROM `user_freight` WHERE `id` = '".$_SESSION['id']."'");
			$data_adm = mysql_fetch_assoc($query);
			$login_adm = $data_adm['login'];
			$log = mysql_query ("INSERT INTO `log_adm` SET `login_adm` = '".$login_adm."', `act`= 'Забанил пользователя', `login_user` = '".$_SESSION['hash']."', `cause` = '".$_POST['cause']."' ");
			
			unset($_SESSION['hash']);
		}
		
		if (isset ($_POST['support']))
		{
			
			$supp = mysql_query ("SELECT id, title FROM `support` WHERE `status` = 'Активен'");
										
						if (mysql_affected_rows() > 0)
						{
							$row = mysql_fetch_assoc($supp);
							$num = mysql_num_rows($supp);
							echo '<p> '.$num.' вопрос(ов) от пользователей ждут ответа :</br></p>' ;
							
								do
								{
									$q1 = mysql_query ("SELECT id, title FROM `support` WHERE id = '$row[id]'");
									$row1 = mysql_fetch_assoc($q1);
									
									echo '<a href = "admin-panel.php?support='.$row['id'].'">'.$row1['title'].'</a>, ';
								}
								while ($row=mysql_fetch_assoc($supp));
						}
						else
						{
							echo '<p>Нет вопросов, ждущих ответа администратора.</p>' ;
						}
						
			
		}
		
		if ($_GET['support'])
		{
			$supp = mysql_query ("SELECT * FROM `support` WHERE `id` = '".$_GET['support']."'");
			$d_supp = mysql_fetch_assoc($supp);
			$_SESSION['hash_tit'] = $d_supp['title'];
			$_SESSION ['hash_user'] = $d_supp['login_user'];
			$query_user = mysql_query ("SELECT `id` FROM `user_freight` WHERE `login` = '".$d_supp['login_user']."'");
			$data = mysql_fetch_assoc($query_user);
			echo "
			<fieldset>
			<legend>&#171 ".$d_supp['title']."&#187 от пользователя <a href = 'user.php?id=".$data['id']."'>".$d_supp['login_user']."</a> </legend>
			<p>".$d_supp['textAsk']."</p>
			<form method = 'POST'>
			<textarea required placeholder='Ответьте на вопрос(макс 1000 символов)' name = 'answerSupport' maxlength = '1000' style = 'width:850px; height:150px;resize: none;'></textarea> </br>
			<input type= 'submit' name = 'answer' value = 'Ответить'>
			</form>
			</fieldset>
			
			";
		}
		
		if (isset ($_POST['answer']))
		{
			$answer = mysql_query ("UPDATE `support` SET `textAnswer`= '".$_POST['answerSupport']."', `status`='Закрыт' WHERE `id` = '".$_GET['support']."'");
			
			# log лог 
			
			$query = mysql_query ("SELECT * FROM `user_freight` WHERE `id` = '".$_SESSION['id']."'");
			$data_adm = mysql_fetch_assoc($query);
			$login_adm = $data_adm['login'];
			$log = mysql_query ("INSERT INTO `log_adm` SET `login_adm` = '".$login_adm."', `act`= 'Ответил в саппорте', `title_sup` = '".$_SESSION['hash_tit']."', `login_user` = '".$_SESSION['hash_user']."'");
			
			unset($_SESSION['hash_id']);
			unset($_SESSION['hash_tit']);
			unset($_SESSION['hash_user']);
			
			header ("location: admin-panel.php");
		}
		
?>		
	</fieldset>
		</div>
		
		<div class = 'log_adm'>
		лог
		<? require_once ('adm_log.php'); ?>
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