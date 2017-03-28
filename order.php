
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
		$q = mysql_query ("SELECT * FROM `orders` WHERE `id` = '".$_GET['id']."'");
		$data = mysql_fetch_assoc($q);
		
		$q_user = mysql_query ("SELECT * FROM `user_freight` WHERE `id` = '".$data['id_user']."'");
		$d_user = mysql_fetch_assoc($q_user);
		echo "
		<div class = 'card_big'>
		<p class = 'mini' align = 'right'> ID заказа : ".$_GET['id']." </p>
		<table>
		<tr>
		<td width = '30%'>
		Тип заказа: <b>".$data['type']." </b> <br>
		Заказчик: <a href = 'user.php?id=".$data['id_user']."'> ".$d_user['login']."</a>. <br>
		Откуда: ".$data['locality_A'].". <br>
		Куда: ".$data['locality_B'].". <br>
		Автомобиль: ".$data['car']." <br>";
		if ($data['contact'] == 'all')
		{
			echo "Email: ".$d_user['email']." <br>"; 
			echo "Телефон: 8".$d_user['phone']." <br>";
		}
		if ($data['contact'] == 'email')
		{
			echo "Email: ".$d_user['email']."<br>"; 
		}
		if ($data['contact'] == 'phone')
		{
			echo "Телефон: 8".$d_user['phone']."<br>";
		}
		if ($data['sell'] ==0)
		{
			echo "Цена: договорная.";
		}
		if ($data['sell'] !=0)
		{
			echo "Цена: ".$data['sell']."";
				if ($data['fuel'] == 'Yes')
				{
					echo "<img src = 'images/fuel.png' style = 'float: right'  title = 'ГСМ оплачивается сверх указанной цены.'>";
				}
		}
		echo "</td>";
		echo "<td valign = 'top' style = 'border: 1px solid gray; height: 90%; width:70%'  >";
		echo "Примечание: ".$data['note']." </td>";
		if ($data['id_user'] == $_SESSION['id'])
		{
			echo "<td valign='top'><a href = '#join_form-1' id='join_pop'> <img src='images/edit.png' title='Редактирoвать'> </a></td>";
		}
		echo "</tr>";
		echo "</table>";
		echo "</div>";
		
		$rout_query = mysql_query ("SELECT * FROM `rout` WHERE `punkt_A` = '".$data['locality_A']."' AND `punkt_B` = '".$data['locality_B']."'");
		if (mysql_affected_rows() > 0)
		{
			$rout_data = mysql_fetch_assoc ($rout_query);
		}
		else 
		{
			$rout_query = mysql_query ("SELECT * FROM `rout` WHERE `punkt_B` = '".$data['locality_A']."' AND `punkt_A` = '".$data['locality_B']."'");
			$rout_data = mysql_fetch_assoc ($rout_query);
		}
		echo "<br>
		Попутные поселения:";
		for ($i=0; $i<10; $i++)
		{
			echo "".$rout_data['city'.$i.'']." ";
		}
		echo "<br>";
		echo "<p align = 'center'> ".$rout_data['code']."</p>";
		
		
		
		
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
	
	<a href="#x" class="overlay" id="join_form-1"></a>   
	<div class="popup">
	<div align="center">
	<div style="height:550px; background-color:#efefef; font-size:14px; width:800px; padding-top: 10px;">
<?

		$q = mysql_query ("SELECT * FROM `orders` WHERE `id` = '".$_GET['id']."'");
		$data = mysql_fetch_assoc($q);
		echo "
		<form method = 'POST'>
			<table>
			<tr>
			<td>Цена:</td> <td><input type = 'number' name = 'sell' value='".$data['sell']."'>  </td>
			</tr><tr>
			<td>Примечание:</td> <td><textarea name = 'note' maxlength = '200' style = 'width:300px; height:250px;resize: none;'> ".$data['note']."</textarea> </td>
			</tr><tr>
			<td>Использовать для связи:</td> <td> <label><input type = 'radio' name = 'contact' value = 'phone'  >Телефон</label> <label><input type= 'radio' name = 'contact' value = 'email'>Email</label> <label> <input type= 'radio' name = 'contact' value = 'all'  selected>Любой способ</label> </td>
			</table>
			<button name = 'save'><img src = 'images/save.png' style = 'vertical-align: middle'>Сохранить</button> <button name = 'delete'><img src = 'images/delete.png' style = 'vertical-align: middle' >Удалить</button>
		</form>
		";
	
	if (isset($_POST['save']))
	{
		$update_order = mysql_query("UPDATE `orders` SET `sell` = '".$_POST['sell']."', `note` = '".$_POST['note']."', `contact` = '".$_POST['contact']."' WHERE `id`= '".$data['id']."'");
		echo "<p class ='green'>Информация о заказе изменена.</p>";
		header ("Refresh:2; order.php?id=".$_GET['id']."");
	}
	if (isset ($_POST['delete']))
	{
		echo "
		<p class = 'red'>Удалить заказ? Отменить это действие будет невозможно. </p>
		<form method = 'POST'>
		<input type = 'submit' name = 'yes_delete' value = 'Удалить'>
		<input type = 'submit' name = 'no_delete' value = 'ОТМЕНА'>
		</form>
		";
	}
	if (isset($_POST['yes_delete']))
	{
		$delete_order = mysql_query ("DELETE FROM `orders` WHERE `id` = '".$data['id']."'");
		echo "<p class = 'red'>Заказ удален.</p>";
	}
	if (isset($_POST['no_delete']))
	{
		header ("location: order.php?id=".$_GET['id']."");
	}
?>
	</div>
	</div>   
	<a class="close" href="#close"></a>
	</div>
	</body>

<?
	if (isset ($_POST ['searchSubmit']))
	{
	
		header ("Location: search.php?query=".$_POST['searchInput']."");
	}
	
?>























</html>