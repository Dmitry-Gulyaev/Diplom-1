<?	session_start();
	$connect = mysql_connect("mysql.hostinger.ru","u920145323_admin","d3i0m1a95") or die (mysql_error());
	mysql_select_db("u920145323_bd1");
	if (mysqli_connect_errno()) {
    printf("Соединение не установлено: %s\n", mysqli_connect_error());
    exit();
	}
?>
<!DOCTYPE html>

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
		 
<?		 
		$query = mysql_query ("SELECT * FROM `user_freight` WHERE `id` = '".$_GET['id']."'");
		$data = mysql_fetch_assoc($query);
		
		
		if ($_GET ['act'] == 'rees' AND $_GET['login'])
		{
			$query_rees = mysql_query ("SELECT * FROM `user_freight` WHERE `login` = '".$_GET['login']."'");
			$data_rees = mysql_fetch_assoc($query_rees);
			echo "Login: ".$_GET['login']."<br>Для восстановления доступа к аккаунту, на почту будет выслан код, который нужно будет ввести в специальное окно.";
			echo "
			<form method = 'POST'> 
			<input type='submit' name = 'go_mail' value = 'Выслать код'>
			</form>
			";

		}
		
		else if ($_GET['id'] == $_SESSION['id'])
		{
			echo "
			Это ваша страница. <img src = 'images/on.png' title = 'online' style='vertical-align: middle' >
			 
			
			<table style='border:1px solid #D7CBB1'>
			<tr> 
			<td rowspan = '6'> <img src = 'images/avatar/".$_GET['id'].".png' width='100' height = '150' style = 'vertical-align: middle;  border: 1px solid red;' alt = 'Нет аватарки'> </td>
			</tr> </tr>
			<td> Ваш id: </td>
			<td> ".$_SESSION['id']." </td>
			</tr> <tr>
			<td> Ваше имя: </td>";
			if (strlen($data['name']) == 0)
			{
				echo "<td>Не указано.</td>
				</tr> <tr>";
			}
			else 
			{
			echo "<td> ".$data['name']." </td>
			</tr> <tr>";
			}
			echo "<td > Ваш Email: </td>
			<td> ".$data['email']." </td> ";
			if ($data['activation_mail'] != 'Активирован')
			{
				echo "<td> <p class = 'red'>Ваш Email не подтвержден</p> </td>
				<td>
				<form method = 'POST'>
				<input type = 'submit' name = 'go_activ' value = 'Активировать'>
				</form>
				</td>";
			}
			echo "
			</tr> <tr>
			<td> Ваш телефон: </td>";
			if (strlen($data['phone']) == 0)
			{
				echo "<td>Не указан. </td>
				</tr> <tr>";
			}
			else 
			{
			echo "<td> 8".$data['phone']." </td>
			</tr> <tr>";
			}
			 echo "<td> Ранг: </td>
			<td> ".$data['rang']." </td>
			</tr> <tr>
			";
			
			echo "</table>";
			echo "
			<form method = 'POST'>
				<button name = 'edit_profile'><img src = 'images/write1.png' style = 'vertical-align: middle'>Редактировать</button>
			</form>
			";
			
			$login = $data['login'];
		
			$supp = mysql_query ("SELECT * FROM `support` WHERE `login_user` = '".$login."' AND `status` = 'Закрыт'");
										
						if (mysql_affected_rows() > 0)
						{
							$row = mysql_fetch_assoc($supp);
							$num = mysql_num_rows($supp);
							echo "<p>У вас есть непросмотренные ответы от администрации <br>" ;
							
								do
								{
									$q1 = mysql_query ("SELECT * FROM `support` WHERE id = '$row[id]'");
									$row1 = mysql_fetch_assoc($q1);
									
									echo '<a href = "user.php?id='.$_SESSION['id'].'&support='.$row['id'].'">'.$row1['title'].'</a> ';
								}
								while ($row=mysql_fetch_assoc($supp));
						}
			$orders = mysql_query ("SELECT * FROM `orders` WHERE `id_user` = '".$_SESSION['id']."'");
						if (mysql_affected_rows() > 0)
						{
							$row_or1 = mysql_fetch_assoc($orders);
							$num1 = mysql_fetch_assoc($orders);
							echo "<br>";
							echo "Ваши заказы: <br>";
							
							do
								{
									$q2 = mysql_query ("SELECT * FROM `orders` WHERE id = '$row_or1[id]'");
									$row2 = mysql_fetch_assoc($q2);
									
									echo "<a href = 'order.php?id=".$row2['id']."'>Заказ ".$row2['id']." </a>";
								}
								while ($row_or1=mysql_fetch_assoc($orders));
						}
			
		}
		
		else if ($_GET['id'] != $_SESSION['id'])
		{
			echo "
			".$data['login'].""; 
			if ($data['status'] =='online')
			{
				echo "<img src = 'images/on.png' title = 'online' style='vertical-align: middle'>";
			}
			else 
			{
				echo "<img src = 'images/off.png' title = 'offline' style='vertical-align: middle'>";
			}
			echo "
			<table style='border:1px solid #D7CBB1'>
			<tr> 
			<td rowspan = '6'> <img src = 'images/avatar/".$_GET['id'].".png' width='100' height = '150' style = 'vertical-align: middle; border: 1px solid red;' alt = ' Нет аватарки '> </td>
			</tr> </tr> 
			<td> id: </td>
			<td> ".$_GET['id']." </td>
			</tr> <tr>
			<td> Имя: </td>
			<td> ".$data['name']." </td>
			</tr> <tr>
			<td> Email: </td>
			<td> ".$data['email']." </td>
			</tr> <tr>
			<td> Телефон: </td>";
			if ($data['status_phone'] == "Скрыт")
			{
			echo "
			<td> Скрыт </td>
			</tr> <tr>";
			}
			else 
			{
			echo "
			<td> 8".$data['phone']." </td>
			</tr> <tr>";
			}
			echo "
			</table>";
			
			
			
			echo "
			<form method = POST>
			<button name = write_letter><img src = 'images/write1.png' style='vertical-align: middle' > Написать письмо</button>
			</form>
			";
		}
		
		if ($_GET ['support'])
			{
				
				$supp_view = mysql_query ("SELECT * FROM `support` WHERE id = '".$_GET['support']."'");
				$supp_view_d = mysql_fetch_assoc($supp_view);
			 
				echo "
				<fieldset>
					<legend> ".$supp_view_d['title']."</legend>
						<fieldset>
						Вопрос: </br>
						".$supp_view_d['textAsk']."
						
						<fieldset>
							Ответ от Администратора: </br>
							".$supp_view_d['textAnswer']."
						</fieldset>
					</fieldset>
					<form method = 'POST'>
						<button name = 'thank'><img src = 'images/like.png' style='vertical-align: middle'>Больше не показывать этот ответ</button>
					</form>
				</fielset>
				
				";
			}
		if (isset($_POST['go_mail']))
		{
			
			
			echo "На Вашу почту <b>".$data_rees['email']."</b> отправлен код. Введите его в форму ниже.";
			
			$code = rand(11111, 99999);
						$email = $data_rees['email'];
						$subject = "Password || Грузодоставки Омск" ;
						$server = $_SERVER['HTTP_HOST'];
						$message = "Enter this code in the form on the site: ".$code."" ;
						mail( "$email", "$subject",
						$message, "From: admin@" . $_SERVER['HTTP_HOST'] );
									
			
			$update = mysql_query ("UPDATE `user_freight` SET `password` = '".$code."' WHERE `login` = '".$_GET['login']."'");
			
			echo "
			<form method = 'POST'>
				<input name = 'code_pass' type = 'text' placeholder = 'Введите код'>
				<input type = 'submit' name = 'rees_ok' value = 'Проверить'>
			</form>
			";
		}
		if (isset($_POST['rees_ok']))	
		{
			if ($_POST['code_pass'] == $data_rees['password'])
			{
				echo "<p class = 'green'>Введите новый пароль:</p>";
				echo "
					<form method = 'POST'>
					<input type = 'password' name = 'new_pass' placeholder = 'Введите новый пароль'> <br>
					<input type = 'password' name = 'new_R_pass' placeholder = 'Повторите пароль'>
					<input type = 'submit' name = 'rees_pass' value = 'Сохранить'> 
					</form>
				";
			}
			else
			{
				echo "<p class = 'red'>Неверный код подтверждения! Вышлите код заново.</p>";
			}
				
		}
		if (isset($_POST['rees_pass']))
		{
			if ($_POST['new_pass'] == $_POST ['new_R_pass'])
			{
				$new_pass = md5(md5($_POST['new_pass']));
				$q2 = mysql_query ("UPDATE `user_freight` SET `password` = '".$new_pass."' WHERE `login` = '".$_GET['login']."'");
				echo "<p class = 'green'>Пароль изменен.</p>";
			}
			else 
			{
				echo "<p class = 'red'>Введеные Вами пароли не совпадают.</p>";
			}
		}
		if (isset ($_POST['thank']))
		{
			$do_not_show = mysql_query ("UPDATE `support` SET `status` = 'Просмотрено' WHERE `id` = '".$_GET['support']."'");
			header ("Location: user.php?id=".$_SESSION['id']."");
		}	
		if (isset ($_POST['go_activ']))
		{
			$code = rand(11111, 99999);
			
			$email = $data['email'] ;
						$subject = "Активация аккаунта Грузодоставки Омск" ;
						$server = $_SERVER['HTTP_HOST'];
						$message = "Enter this code in the form on the site: ".$code."" ;
						mail( "$email", "$subject",
						$message, "From: admin@" . $_SERVER['HTTP_HOST'] );
									
			
			$update = mysql_query ("UPDATE `user_freight` SET `activation_mail` = '".$code."' WHERE `id` = '".$_SESSION['id']."'");
			
			echo "
				<fieldset>
				<legend> Активация Email </legend>
				<form method= 'POSt'>
					На Ваш электронный адрес ".$data['email']." отправлено сообщение с кодом. Введите его в форму ниже. </br>
					<input type = 'text' name = 'code' placeholder = 'Введите код сюда'>
					<input type = 'submit' name = 'rev_code' value = 'Проверить'>
				</form>
				</fieldset>
				";
			
		}
		if (isset ($_POST['rev_code']))
		{
			
			if ($_POST['code'] == $data['activation_mail'])
			{
				echo "<p class = 'green'>Ваш Email подтвержден.</p>";
				$update = mysql_query ("UPDATE `user_freight` SET `activation_mail` = 'Активирован' WHERE `id` = '".$_SESSION['id']."'");
			}
			else 
			{
				
					echo "<p class = 'red'>Код введен неверно, поэтому теперь он недействителен. Заново отправьте письмо с кодом. </p>";
					$update = mysql_query ("UPDATE `user_freight` SET `activation_mail` = 'Не активирован' WHERE `id` = '".$_SESSION['id']."'");
				
			}
		}
		 
		 if (isset ($_POST['select_car']))
		 {
			 $update = mysql_query ("UPDATE `user_freight` SET `car` = '".$_POST['car']."' WHERE `id` = '".$_SESSION['id']."'");
			 header ('Location: user.php?id='.$_SESSION['id'].'');
		 }
		 if (isset ($_POST ['write_letter']))
		 {
			 $q = mysql_query ("SELECT * FROM `user_freight` WHERE `id` = '".$_SESSION['id']."'");
			 $d = mysql_fetch_assoc($q);
			 $_SESSION['log_hash'] = $d['login'];
			 $_SESSION['em_hash'] = $d['email'];
			 if ($d['activation_mail'] != "Активирован")
			 {
				 echo "<p class = 'red'> К сожалению Вы не можете отправлять сообщения, так как Ваш Email не подтвержден. <br> Пожалуйста, активируйте свой аккаунт!</p>";
			 }
			 else 
			 {
				 echo "
					<fieldset> 
						<legend> Отправить письмо на адрес: ".$data['email']."</legend>
						<form method = 'POST'>
						Письмо будет отправлено от имени Вашего электронного адреса: ".$d['email']." </br> Дальнейшая переписка будет вестись с помощью средств Вашей электронной почты.
						<textarea placeholder='Текст сообщения (1000 символов)' name = 'textMess' maxlength = '1000' style = 'width:500px; height:250px;resize: none;'></textarea> </br>
						<button name = 'goWriteLetter'><img src = 'images/letter1.png' style='vertical-align: middle'>Отправить</button>
						</form>
					</fieldset>
				 
				 ";
			 }
		 }
		 
		 if (isset ($_POST['goWriteLetter']))
		 {
						
						$email = $data['email'] ;
						$subject = "Вам сообщение || Грузодоставки Омск" ;
						$server = $_SERVER['HTTP_HOST'];
						$message = "Сообщение от ".$_SESSION['log_hash'].": 
						".$_POST['textMess']."
						
						E-mail: ".$_SESSION['em_hash']."";
						mail( "$email", "$subject",
						$message, "From: admin@" . $_SERVER['HTTP_HOST'] );
						
						echo "<p class = 'green'> Письмо отправлено.</p>
						
						";
						
						
		 }
		 if (isset($_POST['edit_profile']))
		 {
			 header ("Location: my_user.php?act=edit");
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