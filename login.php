<?php
	session_start();
	$connect = mysql_connect("mysql.hostinger.ru","u920145323_admin","d3i0m1a95") or die (mysql_error());
	mysql_select_db("u920145323_bd1");
	if (mysqli_connect_errno()) {
    printf("Соединение не установлено: %s\n", mysqli_connect_error());
    exit();
	
	

	}
?>

	

<? 	if (!$_SESSION ['id'] )
{	
		echo '
		<fieldset>
		<legend>Авторизация/регистрация </legend>
		<form method = "POST">
		<label for = "login"> Логин </label>
		<input   name = "login" class = "inputLogin" type = "text" placeholder = "| Введите логин"> 
		<label for = "password"> Пароль </label>
		<input  name = "password" class = "inputLogin" type = "password" placeholder = "| Введите пароль"> </br>  
		<input name = "EnterLogin"  class = "submitLogin" type = "submit" value = "Войти">
		<input name = "Register" class = "submitLogin" type = "submit" value = "Регистрация">
		</form>
		</fieldset>';
	if (isset ($_POST['EnterLogin']))
	{	
		$err = array();
		
		if (strlen ($_POST['login']) < 1)
		{
			$err[] = "Пожалуйста, введите логин!";
		}
		elseif (strlen ($_POST['password']) < 1)
		{
			$err[] = "Пожалуйста, введите пароль!";
		}
		$query = mysql_query ("SELECT * FROM `user_freight` WHERE `login` = '".$_POST['login']."'");
		if (mysql_affected_rows() > 0)
		{
			$data = mysql_fetch_assoc ($query);
			$pass = md5(md5($_POST['password']));
			
			if($data['password'] !== md5(md5($_POST['password'])))
			{
				$err[] = "Неверный пароль! <a href = 'user.php?act=rees&login=".$_POST['login']." '>Восстановить</a>";
			}
		}
		else 
		{
			$err[] = "Пользователя с таким логином не существует.";
		}
		$query = mysql_query ("SELECT * FROM `user_freight` WHERE `login` = '".$_POST['login']."'");
		$data = mysql_fetch_assoc ($query);
		if ($data['BAN'] === 'yes')
		{
			$err[] = "Ваш аккаунт заблокирован по причине &#171 ".$data['cause_BAN']." &#187";
		}
		
		if (count ($err) == 0)
		{
			
			$_SESSION['id']=$data['id'];
			header ("Location: index11.php");
			$up = mysql_query ("UPDATE `user_freight` SET `status`='online' WHERE `id`='".$_SESSION['id']."'");
			
		}
		else 
		{
			foreach($err AS $error)
					{
						echo  "<p class = 'red'>".$error." </p>";
					}
		}
	}		
}
else  # Если авторизирован
{
	$q = mysql_query ("SELECT * FROM `user_freight` WHERE `id` = '".$_SESSION['id']."'");
	$d = mysql_fetch_assoc ($q);
	echo "
	<fieldset>
	<legend> Здравсвуйте, ".$d['name']." </legend>
	<form method = 'POST'>
		<label>Ваш ID - ".$_SESSION['id']." </br></label>
		<button name = 'MyProfile'> <img src = 'images/user2.png' style='vertical-align: middle'> Мой профиль </bitton>
		<button name = 'exit' title = 'Выйти'> <img src = 'images/exit2.png' style='vertical-align: middle'></bitton> ";
		if ($d['rang']=='Модератор' || $d['rang']=='Адмимнистратор' || $d['rang']=='Создатель')
		{
		echo "<button name = 'admin' title = 'Админпанель'> <img src = 'images/gear2.png' style='vertical-align: middle'> </button>";
		}	
echo"</form>
	</fieldset>
	";
}
	if (isset($_POST['MyProfile']))
	{
		header ("Location: user.php?id=".$_SESSION['id']."");
	}
	if (isset ($_POST['admin']))
	{
		header ("Location: admin-panel.php");
	}
	if (isset ($_POST['Register']))
	{
		header ("Location: register.php");
	}
	if (isset($_POST['exit']))
	{
		$up = mysql_query ("UPDATE `user_freight` SET `status`='offline' WHERE `id`='".$_SESSION['id']."'");
		unset($_SESSION['id']);
		session_destroy();
		header("Location: index11.php");
	}
	
	
?>	
