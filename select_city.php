<?php
	
	session_start();
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
	<title> Выбор точки маршрута </title>
	</head>
	
	<body>
	<?
		
	?>
	<form method = "POST">
		<select  name='select' style='width: 300px'> 
			<option value="1"> -Выберете населеный пункт- </option>
			<option value="2"> Омск  </option>
			<option value="3"> Береговой </option>
			<option value="4"> Большеречье </option>
			<option value="5"> Большие Уки </option>
			<option value="6"> Горьковское  </option>
			<option value="7"> Знаменское </option>
			<option value="8"> Исилькуль </option>
			<option value="9"> Калачинск </option>
			<option value="10"> Колосовка </option>
			<option value="11"> Кормиловка  </option>
			<option value="12"> Крутинка </option>
			<option value="13"> Любинский </option>
			<option value="14"> Марьяновка </option>
			<option value="15"> Муромцево </option>
			<option value="16"> Называевск </option>
			<option value="17"> Нижняя Омка </option>
			<option value="18"> Нововаршавка </option>
			<option value="19"> Одесское </option>
			<option value="20"> Оконешниково </option>
			<option value="21"> Павлоградка </option>
			<option value="22"> Полтавка </option>
			<option value="23"> Русская Поляна </option>
			<option value="24"> Саргатское </option>
			<option value="25"> Седельниково </option>
			<option value="26"> Таврическое </option>
			<option value="27"> Тара </option>
			<option value="28"> Тевриз </option>
			<option value="29"> Тюкалинск </option>
			<option value="30"> Усть-Ишим </option>
			<option value="31"> Черлак </option>
			<option value="32"> Шербакуль </option>
		</select>
		<input type = "submit" name = "Button_Select" value = "Просмотр">
	</form>
	
	<?php
		
		
		if (isset($_POST['Button_Select']))
		{
			$select = $_POST['select'];
			$query = mysql_query ("SELECT * FROM `City` WHERE ".$select." = `id_city`");
			$data = mysql_fetch_assoc ($query);
			echo '<p>Выбран населенный пункт: '.$data["name"].'</p>';
			echo ''.$data["js"].'';
			
		}
		
		if ($_GET['act'] == 'select_punctA' AND $select != '1')
		{
			echo '
			<a href = "recruitment.php?punctA='.$select.'" class = "menuButton"> <img src = "images/todo.png" style="vertical-align: middle"> Сохранить </a> 
			';
		}
		
		
		?>
		
	
	
	</body>

</html>