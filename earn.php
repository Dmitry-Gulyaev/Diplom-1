
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
		
		
		
		
		<form method = 'POST'>
			<button name = 'add_orders'> <img src = "images/plus1.png" style="vertical-align: middle"> Создать заказ на поиск перевозчика</button>
		</form>
		<?
			if (isset ($_POST['add_orders']))
			{
				header ('Location: earn.php?act=add_orders');
			}
		?>
		
		<div class = 'list'>
		<?
			if ($_GET['act'] == 'add_orders')
			{ 
				if (!$_SESSION['id'])
				{
					echo "<p class = 'error'>Вы не авторизированы. </p>";
				}
				else
				{
						$query = mysql_query ("SELECT * FROM `user_freight` WHERE `id` = '".$_SESSION['id']."'");
						$data = mysql_fetch_assoc($query);
						if ($data['activation_mail'] == 'Не активирован')
						{
							echo "<p class ='red'>К сожалению, Вы не можете создавать заказы, так как Ваш email адрес не подтвержден. </p> <p>Пожалуйста, перейдите в личный кабинет и подтвердите Ваш электронный адрес. Тем самым Вы активируете учетную запись. </p>";
						}
						else 
						{
							echo "<form method = 'POST'>";
							echo "Создание заказа на поиск перевозчика <br>
							<table>
							<tr>
							";
							
							echo '<td> Откуда: </td> <td>   <select  name="select_A" style="width: 300px"> 
										<option value="Не выбрано"> -Выберете населеный пункт- </option>
										<option value="Омск"> Омск  </option>
										<option value="Береговой"> Береговой </option>
										<option value="Большеречье"> Большеречье </option>
										<option value="Большие Уки"> Большие Уки </option>
										<option value="Горьковское"> Горьковское  </option>
										<option value="Знаменское"> Знаменское </option>
										<option value="Исилькуль"> Исилькуль </option>
										<option value="Калачинск"> Калачинск </option>
										<option value="Колосовка"> Колосовка </option>
										<option value="Кормиловка"> Кормиловка  </option>
										<option value="Крутинка"> Крутинка </option>
										<option value="Любинский"> Любинский </option>
										<option value="Марьяновка"> Марьяновка </option>
										<option value="Муромцево"> Муромцево </option>
										<option value="Называевск"> Называевск </option>
										<option value="Нижняя Омка"> Нижняя Омка </option>
										<option value="Нововаршавка"> Нововаршавка </option>
										<option value="Одесское"> Одесское </option>
										<option value="Оконешниково"> Оконешниково </option>
										<option value="Павлоградка"> Павлоградка </option>
										<option value="Полтавка"> Полтавка </option>
										<option value="Русская Поляна"> Русская Поляна </option>
										<option value="Саргатское"> Саргатское </option>
										<option value="Седельниково"> Седельниково </option>
										<option value="Таврическое"> Таврическое </option>
										<option value="Тара"> Тара </option>
										<option value="Тевриз"> Тевриз </option>
										<option value="Тюкалинск"> Тюкалинск </option>
										<option value="Усть-Ишим"> Усть-Ишим </option>
										<option value="Черлак"> Черлак </option>
										<option value="Шербакуль"> Шербакуль </option>
									</select> </td>';
							
								
							echo "</tr> <tr>";
							echo '<td> Куда: </td> <td>   <select  name="select_B" style="width: 300px"> 
										<option value="Не выбрано"> -Выберете населеный пункт- </option>
										<option value="Омск"> Омск  </option>
										<option value="Береговой"> Береговой </option>
										<option value="Большеречье"> Большеречье </option>
										<option value="Большие Уки"> Большие Уки </option>
										<option value="Горьковское"> Горьковское  </option>
										<option value="Знаменское"> Знаменское </option>
										<option value="Исилькуль"> Исилькуль </option>
										<option value="Калачинск"> Калачинск </option>
										<option value="Колосовка"> Колосовка </option>
										<option value="Кормиловка"> Кормиловка  </option>
										<option value="Крутинка"> Крутинка </option>
										<option value="Любинский"> Любинский </option>
										<option value="Марьяновка"> Марьяновка </option>
										<option value="Муромцево"> Муромцево </option>
										<option value="Называевск"> Называевск </option>
										<option value="Нижняя Омка"> Нижняя Омка </option>
										<option value="Нововаршавка"> Нововаршавка </option>
										<option value="Одесское"> Одесское </option>
										<option value="Оконешниково"> Оконешниково </option>
										<option value="Павлоградка"> Павлоградка </option>
										<option value="Полтавка"> Полтавка </option>
										<option value="Русская Поляна"> Русская Поляна </option>
										<option value="Саргатское"> Саргатское </option>
										<option value="Седельниково"> Седельниково </option>
										<option value="Таврическое"> Таврическое </option>
										<option value="Тара"> Тара </option>
										<option value="Тевриз"> Тевриз </option>
										<option value="Тюкалинск"> Тюкалинск </option>
										<option value="Усть-Ишим"> Усть-Ишим </option>
										<option value="Черлак"> Черлак </option>
										<option value="Шербакуль"> Шербакуль </option>
									</select> </td>';
							echo "</tr> <tr>";
							echo "<td>Примечание: </td><td><textarea placeholder='Опишите возможности Вашего автомобиля, напишите примечания. (max 200 символов)' name = 'note' maxlength = '200' style = 'width:300px; height:250px;resize: none;'></textarea> </td>";
							echo "</tr> <tr>";
							echo "<td>Цена : </td> <td><input required type = 'number' name = 'sell'> рублей</td>";
							echo "</tr> <tr>";
							echo "<td>Расходы ГСМ оплачиваются отдельно?:  </td> <td><label><input required type = 'radio' name = 'fuel' value = 'Yes' >Да</label>  <label><input required type = 'radio' name = 'fuel' value = 'No'>Нет</label></td>";
							echo "</tr> <tr>";
							echo "<td>Контакт со мной по: </td> <td> <label><input type= 'radio' name = 'contact' value = 'email'>Электронной почте</label><label> <input type= 'radio' name = 'contact' value = 'phone'>Телефону</label> <label><input type= 'radio' name = 'contact' value = 'all' checked>Любой способ</label> </td>";
							echo "</tr> <tr>";
							echo "<td>Ваш автомобиль:</td> <td> <label> <input type = 'radio' name = 'car' value = 'Легковой'> Легковой</label> <label> <input type = 'radio' name = 'car' value = 'Универсал'> Универсал</label> <label> <input type = 'radio' name = 'car' value = 'Грузовой до 3.5 т'> Грузовой до 3.5 т</label> <label> <input type = 'radio' name = 'car' value = 'Грузовой более 3.5 т'> Грузовой более 3.5 т</label></td>";
							echo "</tr> <tr>";
							echo " <td> <button name = 'save'> <img src = 'images/save.png' style = 'vertical-align: middle'>Сохранить заказ</button> </td>";
							echo "</tr>";
							echo "</table>";
							echo "</form>";
						}
				}
			}		
					else 
					{	
						echo "Найдите заказчика, чей груз и условия большего всего Вам подходят.";
						echo "Если цена не указана, то она не имеет значения.";
						echo "<form method = 'POST'>";#фильтры
						echo 'Откуда: <select  name="SEARCHselect_A" style="width: 100px" > 
									<option value="'.$_POST['SEARCHselect_A'].'">'.$_POST['SEARCHselect_A'].' </option>
									<option value="Омск"> Омск  </option>
									<option value="Береговой"> Береговой </option>
									<option value="Большеречье"> Большеречье </option>
									<option value="Большие Уки"> Большие Уки </option>
									<option value="Горьковское"> Горьковское  </option>
									<option value="Знаменское"> Знаменское </option>
									<option value="Исилькуль"> Исилькуль </option>
									<option value="Калачинск"> Калачинск </option>
									<option value="Колосовка"> Колосовка </option>
									<option value="Кормиловка"> Кормиловка  </option>
									<option value="Крутинка"> Крутинка </option>
									<option value="Любинский"> Любинский </option>
									<option value="Марьяновка"> Марьяновка </option>
									<option value="Муромцево"> Муромцево </option>
									<option value="Называевск"> Называевск </option>
									<option value="Нижняя Омка"> Нижняя Омка </option>
									<option value="Нововаршавка"> Нововаршавка </option>
									<option value="Одесское"> Одесское </option>
									<option value="Оконешниково"> Оконешниково </option>
									<option value="Павлоградка"> Павлоградка </option>
									<option value="Полтавка"> Полтавка </option>
									<option value="Русская Поляна"> Русская Поляна </option>
									<option value="Саргатское"> Саргатское </option>
									<option value="Седельниково"> Седельниково </option>
									<option value="Таврическое"> Таврическое </option>
									<option value="Тара"> Тара </option>
									<option value="Тевриз"> Тевриз </option>
									<option value="Тюкалинск"> Тюкалинск </option>
									<option value="Усть-Ишим"> Усть-Ишим </option>
									<option value="Черлак"> Черлак </option>
									<option value="Шербакуль"> Шербакуль </option>
								</select> ';
								echo 'Куда: <select  name="SEARCHselect_B" style="width: 100px" value = "'.$_POST['SEARCHselect_B'].'"> 
									<option value="'.$_POST['SEARCHselect_B'].'">'.$_POST['SEARCHselect_B'].' </option>
									<option value="Омск"> Омск  </option>
									<option value="Береговой"> Береговой </option>
									<option value="Большеречье"> Большеречье </option>
									<option value="Большие Уки"> Большие Уки </option>
									<option value="Горьковское"> Горьковское  </option>
									<option value="Знаменское"> Знаменское </option>
									<option value="Исилькуль"> Исилькуль </option>
									<option value="Калачинск"> Калачинск </option>
									<option value="Колосовка"> Колосовка </option>
									<option value="Кормиловка"> Кормиловка  </option>
									<option value="Крутинка"> Крутинка </option>
									<option value="Любинский"> Любинский </option>
									<option value="Марьяновка"> Марьяновка </option>
									<option value="Муромцево"> Муромцево </option>
									<option value="Называевск"> Называевск </option>
									<option value="Нижняя Омка"> Нижняя Омка </option>
									<option value="Нововаршавка"> Нововаршавка </option>
									<option value="Одесское"> Одесское </option>
									<option value="Оконешниково"> Оконешниково </option>
									<option value="Павлоградка"> Павлоградка </option>
									<option value="Полтавка"> Полтавка </option>
									<option value="Русская Поляна"> Русская Поляна </option>
									<option value="Саргатское"> Саргатское </option>
									<option value="Седельниково"> Седельниково </option>
									<option value="Таврическое"> Таврическое </option>
									<option value="Тара"> Тара </option>
									<option value="Тевриз"> Тевриз </option>
									<option value="Тюкалинск"> Тюкалинск </option>
									<option value="Усть-Ишим"> Усть-Ишим </option>
									<option value="Черлак"> Черлак </option>
									<option value="Шербакуль"> Шербакуль </option>
								</select>';
								echo 'Автомобиль: 	<select name = "car" value = "'.$_POST['car'].'">
														<option value="'.$_POST['car'].'">'.$_POST['car'].' </option>
														<option value = "Легковой"> Легковой </option>
														<option value = "Универсал"> Универсал </option>
														<option value = "Грузовой до 3.5 т"> Грузовой до 3.5 т </option>
														<option value = "Грузовой более 3.5 т"> Грузовой более 3.5 т </option>
													</select>
								';
								echo "Цена не дороже: <input type = 'number' name = 'max_sell' value = '".$_POST['max_sell']."' title = 'Если указано 0, то цена значения не имеет.'> руб. ";
								echo "<button name = 'search_orders'> <img src = 'images/search_copy.png'></button>";
						
						echo "</form>";
					}
					
					if (isset ($_POST['save']))
					{
						
						echo "<p class = 'green'>Заказ сохранен<p>";
						$ins  = mysql_query ("INSERT INTO `orders` SET `id_user` = '".$_SESSION['id']."', `type` = 'Нужен заказчик', `sell` = '".$_POST['sell']."', `locality_A` = '".$_POST['select_A']."',`locality_B` = '".$_POST['select_B']."', `fuel` = '".$_POST['fuel']."', `contact` = '".$_POST['contact']."', `car` = '".$_POST['car']."', `note` = '".$_POST['note']."' ");
					}
					
					if (isset ($_POST['search_orders']))
					{
						
						if ($_POST['max_sell'] == 0)
						{
								$q = "SELECT * FROM `orders` WHERE `type` = 'Нужен перевозчик' AND `locality_A` = '".$_POST['SEARCHselect_A']."' AND `locality_B` = '".$_POST['SEARCHselect_B']."' AND`car` = '".$_POST['car']."'";
								
								$result = mysql_query($q);
								if (mysql_affected_rows() > 0) 
							{ 
								echo "<p class = 'green'>Эти люди помогут Вам перевезти Ваш груз:</p>";
								$row = mysql_fetch_assoc($result); 
								$num = mysql_num_rows($result);

								

								do 
								{
									
									$q1 = "SELECT * FROM `orders` WHERE `id` = '".$row['id']."'";
									$result1 = mysql_query($q1);

									if (mysql_affected_rows() > 0) {
										$row1 = mysql_fetch_assoc($result1);
									}
									$id_isp = $row1['id_user'];
									$query_user = mysql_query ("SELECT * FROM `user_freight` WHERE `id` = '".$id_isp."'");
									$data_user = mysql_fetch_assoc($query_user);
									echo "
									<div class = 'card'>
									
									<p class = 'mini' align= 'right'>ID заказа:".$row1['id']."<br> </p>";
									if ($row1['fuel'] == 'Yes')
									{
										echo "<img src = 'images/fuel.png' style = 'float: right'  title = 'ГСМ оплачивается сверх указанной цены.'>";
									}
									
									echo" Исполнитель: <a href='user.php?id=".$data_user['id']."'> ".$data_user['login']."</a> <br>";
									echo "Откуда: ".$row1['locality_A']." <br>
									Куда: ";
									if ($row1['locality_A'] == $row1['locality_B'])
									{
										echo "по городу. <br>";
									}
									else
									{
										echo "".$row1['locality_B']."<br>";
									}
									echo " <td>Автомобиль: ".$row1['car']." <br>";
									
									echo "<td> Желаемая цена:
									";
									if ($row1['sell'] == 0)
									{
										echo "договорная. <br>";
									}
									else 
									{
										echo "".$row1['sell']." <br>";
									}
									
									echo "<p align = 'right'><a href = 'order.php?id=".$row1['id']."'> Подробнее >>></a></p>";						
									echo "</div>";
									

								} 
								while ($row = mysql_fetch_assoc($result)); 
							
							}	
							
							else
							{
								echo "К сожалению, перевозчики, удовлетворяющие параметрам поиска не найдены, но мы подобрали для Вас похожие варианты:";
								
								$rout_query = mysql_query ("SELECT * FROM `rout` WHERE `punkt_A` = '".$_POST['SEARCHselect_A']."'  AND `punkt_B` ='".$_POST['SEARCHselect_B']."' ");
								
								if (mysql_affected_rows() > 0)
								{
									$rout_data = mysql_fetch_assoc($rout_query);
									$rout_num = mysql_num_rows($rout_query);
									
									do 
									{
										
										
										$q = "SELECT * FROM `orders` WHERE type = 'Нужен перевозчик' AND (`locality_A` = '".$_POST['SEARCHselect_A']."' AND (`locality_B` = '".$rout_data['city1']."' OR `locality_B` = '".$rout_data['city2']."' OR `locality_B` = '".$rout_data['city3']."' OR `locality_B` = '".$rout_data['city4']."' OR `locality_B` = '".$rout_data['city5']."' OR `locality_B` = '".$rout_data['city6']."' OR `locality_B` = '".$rout_data['city7']."' OR `locality_B` = '".$rout_data['city8']."' OR `locality_B` = '".$rout_data['city9']."' OR `locality_B` = '".$rout_data['city9']."' OR `locality_B` = '".$rout_data['city10']."'))";
												$result = mysql_query($q);
												if (mysql_affected_rows() > 0) 
											{ 
												
												$row = mysql_fetch_assoc($result); 
												$num = mysql_num_rows($result);

												

												do 
												{
													
													$q1 = "SELECT * FROM `orders` WHERE `id` = '".$row['id']."'";
													$result1 = mysql_query($q1);

													if (mysql_affected_rows() > 0) {
														$row1 = mysql_fetch_assoc($result1);
													}
													$id_isp = $row1['id_user'];
													$query_user = mysql_query ("SELECT * FROM `user_freight` WHERE `id` = '".$id_isp."'");
													$data_user = mysql_fetch_assoc($query_user);
													echo "
													<div class = 'card'>
													<p class = 'mini' align= 'right'>ID заказа:".$row1['id']."<br> </p>";
													if ($row1['fuel'] == 'Yes')
													{
														echo "<img src = 'images/fuel.png' style = 'float: right' title = 'ГСМ оплачивается сверх указанной цены.'>";
													}
													
													echo" Исполнитель: <a href='user.php?id=".$data_user['id']."'> ".$data_user['login']."</a> <br>";
													echo "Откуда: ".$row1['locality_A']." <br>
													Куда: ";
													if ($row1['locality_A'] == $row1['locality_B'])
													{
														echo "по городу. <br>";
													}
													else
													{
														echo "".$row1['locality_B']."<br>";
													}
												echo "Автомобиль: ".$row1['car']." <br>
													Желаемая цена: ";
													if ($row1['sell'] == 0)
													{
														echo "договорная. <br>";
													}
													else 
													{
														echo "".$row1['sell']." <br>";
													}
													echo "<p align = 'right'><a href = 'order.php?id=".$row1['id']."'> Подробнее >>></a></p>";					
													 
													echo "</div>";
													
													

												} 
												while ($row = mysql_fetch_assoc($result)); 
											
											}	
										
										
									}
									while ($rout_data = mysql_fetch_assoc($rout_query)); 
								}
								else 
								{
									$rout_query = mysql_query ("SELECT * FROM `rout` WHERE `punkt_A` = '".$_POST['SEARCHselect_B']."'  AND (`city1` = '".$_POST['SEARCHselect_A']."' OR `city2` = '".$_POST['SEARCHselect_A']."' OR `city3` = '".$_POST['SEARCHselect_A']."' OR `city4` = '".$_POST['SEARCHselect_A']."' OR `city5` = '".$_POST['SEARCHselect_A']."' OR `city6` = '".$_POST['SEARCHselect_A']."' OR `city7` = '".$_POST['SEARCHselect_A']."' OR `city8` = '".$_POST['SEARCHselect_A']."' OR `city9` = '".$_POST['SEARCHselect_A']."' OR `city10` = '".$_POST['SEARCHselect_A']."') ");
								
								if (mysql_affected_rows() > 0)
								{
									$rout_data = mysql_fetch_assoc($rout_query);
									$rout_num = mysql_num_rows($rout_query);
									
									do 
									{
										$punkt_B = $rout_data['punkt_B'];
										
										$q = "SELECT * FROM `orders` WHERE `type` = 'Нужен перевозчик' AND (`locality_A` = '".$_POST['SEARCHselect_A']."' AND  `locality_B` = '".$punkt_B."')";
												$result = mysql_query($q);
												if (mysql_affected_rows() > 0) 
											{ 
												
												$row = mysql_fetch_assoc($result); 
												$num = mysql_num_rows($result);

												

												do 
												{
													
													$q1 = "SELECT * FROM `orders` WHERE `id` = '".$row['id']."'";
													$result1 = mysql_query($q1);

													if (mysql_affected_rows() > 0) {
														$row1 = mysql_fetch_assoc($result1);
													}
													$id_isp = $row1['id_user'];
													$query_user = mysql_query ("SELECT * FROM `user_freight` WHERE `id` = '".$id_isp."'");
													$data_user = mysql_fetch_assoc($query_user);
													echo "
													<div class = 'card'>
													<p class = 'mini' align= 'right'>ID заказа:".$row1['id']."<br> </p>";
													if ($row1['fuel'] == 'Yes')
													{
														echo "<img src = 'images/fuel.png' style = 'float: right' title = 'ГСМ оплачивается сверх указанной цены.'>";
													}
													
													echo" Исполнитель: <a href='user.php?id=".$data_user['id']."'> ".$data_user['login']."</a> <br>";
													echo "Откуда: ".$row1['locality_A']." <br>
													Куда: ";
													if ($row1['locality_A'] == $row1['locality_B'])
													{
														echo "по городу. <br>";
													}
													else
													{
														echo "".$row1['locality_B']."<br>";
													}
												echo "Автомобиль: ".$row1['car']." <br>
													Желаемая цена: ";
													if ($row1['sell'] == 0)
													{
														echo "договорная. <br>";
													}
													else 
													{
														echo "".$row1['sell']." <br>";
													}
													echo "<p align = 'right'><a href = 'order.php?id=".$row1['id']."'> Подробнее >>></a></p>";					
													echo "</div>";
													
													

												} 
												while ($row = mysql_fetch_assoc($result)); 
											
											}	
										
										
									}
									while ($rout_data = mysql_fetch_assoc($rout_query)); 
								}
								
								}	
							}
						}
						
						else 
						{
							$q = "SELECT * FROM `orders` WHERE `type` = 'Нужен перевозчик' AND `sell` <= '".$_POST['max_sell']."' AND `locality_A` = '".$_POST['SEARCHselect_A']."' AND `locality_B` = '".$_POST['SEARCHselect_B']."' AND`car` = '".$_POST['car']."'";
								
								$result = mysql_query($q);
								if (mysql_affected_rows() > 0) 
							{ 
								echo "<p class = 'green'>Эти люди помогут Вам перевезти Ваш груз:</p>";
								$row = mysql_fetch_assoc($result); 
								$num = mysql_num_rows($result);

								

								do 
								{
									
									$q1 = "SELECT * FROM `orders` WHERE `id` = '".$row['id']."'";
									$result1 = mysql_query($q1);

									if (mysql_affected_rows() > 0) {
										$row1 = mysql_fetch_assoc($result1);
									}
									$id_isp = $row1['id_user'];
									$query_user = mysql_query ("SELECT * FROM `user_freight` WHERE `id` = '".$id_isp."'");
									$data_user = mysql_fetch_assoc($query_user);
									echo "
									<div class = 'card'>
									
									<p class = 'mini' align= 'right'>ID заказа:".$row1['id']."<br> </p>";
									if ($row1['fuel'] == 'Yes')
									{
										echo "<img src = 'images/fuel.png' style = 'float: right'  title = 'ГСМ оплачивается сверх указанной цены.'>";
									}
									
									echo" Исполнитель: <a href='user.php?id=".$data_user['id']."'> ".$data_user['login']."</a> <br>";
									echo "Откуда: ".$row1['locality_A']." <br>
									Куда: ";
									if ($row1['locality_A'] == $row1['locality_B'])
									{
										echo "по городу. <br>";
									}
									else
									{
										echo "".$row1['locality_B']."<br>";
									}
									echo " <td>Автомобиль: ".$row1['car']." <br>";
									
									echo "<td> Желаемая цена:
									";
									if ($row1['sell'] == 0)
									{
										echo "договорная. <br>";
									}
									else 
									{
										echo "".$row1['sell']." <br>";
									}
									
									echo "<p align = 'right'><a href = 'order.php?id=".$row1['id']."'> Подробнее >>></a></p>";						
									echo "</div>";
									

								} 
								while ($row = mysql_fetch_assoc($result)); 
							
							}	
							
							else
							{
								echo "К сожалению, перевозчики, удовлетворяющие параметрам поиска не найдены, но мы подобрали для Вас похожие варианты:";
								
								$rout_query = mysql_query ("SELECT * FROM `rout` WHERE `punkt_A` = '".$_POST['SEARCHselect_A']."'  AND (`city1` = '".$_POST['SEARCHselect_B']."' OR `city2` = '".$_POST['SEARCHselect_B']."' OR `city3` = '".$_POST['SEARCHselect_B']."' OR `city4` = '".$_POST['SEARCHselect_B']."' OR `city5` = '".$_POST['SEARCHselect_B']."' OR `city6` = '".$_POST['SEARCHselect_B']."' OR `city7` = '".$_POST['SEARCHselect_B']."' OR `city8` = '".$_POST['SEARCHselect_B']."' OR `city9` = '".$_POST['SEARCHselect_B']."' OR `city10` = '".$_POST['SEARCHselect_B']."') ");
								
								if (mysql_affected_rows() > 0)
								{
									$rout_data = mysql_fetch_assoc($rout_query);
									$rout_num = mysql_num_rows($rout_query);
									
									do 
									{
										$punkt_B = $rout_data['punkt_B'];
										
										$q = "SELECT * FROM `orders` WHERE `type` = 'Нужен перевозчик' AND `sell` <= '".$_POST['max_sell']."' AND (`locality_A` = '".$_POST['SEARCHselect_A']."' AND  `locality_B` = '".$punkt_B."')";
												$result = mysql_query($q);
												if (mysql_affected_rows() > 0) 
											{ 
												
												$row = mysql_fetch_assoc($result); 
												$num = mysql_num_rows($result);

												

												do 
												{
													
													$q1 = "SELECT * FROM `orders` WHERE `id` = '".$row['id']."'";
													$result1 = mysql_query($q1);

													if (mysql_affected_rows() > 0) {
														$row1 = mysql_fetch_assoc($result1);
													}
													$id_isp = $row1['id_user'];
													$query_user = mysql_query ("SELECT * FROM `user_freight` WHERE `id` = '".$id_isp."'");
													$data_user = mysql_fetch_assoc($query_user);
													echo "
													<div class = 'card'>
													<p class = 'mini' align= 'right'>ID заказа:".$row1['id']."<br> </p>";
													if ($row1['fuel'] == 'Yes')
													{
														echo "<img src = 'images/fuel.png' style = 'float: right' title = 'ГСМ оплачивается сверх указанной цены.'>";
													}
													
													echo" Исполнитель: <a href='user.php?id=".$data_user['id']."'> ".$data_user['login']."</a> <br>";
													echo "Откуда: ".$row1['locality_A']." <br>
													Куда: ";
													if ($row1['locality_A'] == $row1['locality_B'])
													{
														echo "по городу. <br>";
													}
													else
													{
														echo "".$row1['locality_B']."<br>";
													}
												echo "Автомобиль: ".$row1['car']." <br>
													Желаемая цена: ";
													if ($row1['sell'] == 0)
													{
														echo "договорная. <br>";
													}
													else 
													{
														echo "".$row1['sell']." <br>";
													}
													echo "<p align = 'right'><a href = 'order.php?id=".$row1['id']."'> Подробнее >>></a></p>";					
													 
													echo "</div>";
													
													

												} 
												while ($row = mysql_fetch_assoc($result)); 
											
											}	
										
										
									}
									while ($rout_data = mysql_fetch_assoc($rout_query)); 
								}
								else 
								{
									$rout_query = mysql_query ("SELECT * FROM `rout` WHERE `punkt_A` = '".$_POST['SEARCHselect_B']."'  AND (`city1` = '".$_POST['SEARCHselect_A']."' OR `city2` = '".$_POST['SEARCHselect_A']."' OR `city3` = '".$_POST['SEARCHselect_A']."' OR `city4` = '".$_POST['SEARCHselect_A']."' OR `city5` = '".$_POST['SEARCHselect_A']."' OR `city6` = '".$_POST['SEARCHselect_A']."' OR `city7` = '".$_POST['SEARCHselect_A']."' OR `city8` = '".$_POST['SEARCHselect_A']."' OR `city9` = '".$_POST['SEARCHselect_A']."' OR `city10` = '".$_POST['SEARCHselect_A']."') ");
								
								if (mysql_affected_rows() > 0)
								{
									$rout_data = mysql_fetch_assoc($rout_query);
									$rout_num = mysql_num_rows($rout_query);
									
									do 
									{
										$punkt_B = $rout_data['punkt_B'];
										
										$q = "SELECT * FROM `orders` WHERE `type` = 'Нужен перевозчик' AND (`locality_A` = '".$_POST['SEARCHselect_A']."' AND  `locality_B` = '".$punkt_B."')";
												$result = mysql_query($q);
												if (mysql_affected_rows() > 0) 
											{ 
												
												$row = mysql_fetch_assoc($result); 
												$num = mysql_num_rows($result);

												

												do 
												{
													
													$q1 = "SELECT * FROM `orders` WHERE `id` = '".$row['id']."'";
													$result1 = mysql_query($q1);

													if (mysql_affected_rows() > 0) {
														$row1 = mysql_fetch_assoc($result1);
													}
													$id_isp = $row1['id_user'];
													$query_user = mysql_query ("SELECT * FROM `user_freight` WHERE `id` = '".$id_isp."'");
													$data_user = mysql_fetch_assoc($query_user);
													echo "
													<div class = 'card'>
													<p class = 'mini' align= 'right'>ID заказа:".$row1['id']."<br> </p>";
													if ($row1['fuel'] == 'Yes')
													{
														echo "<img src = 'images/fuel.png' style = 'float: right' title = 'ГСМ оплачивается сверх указанной цены.'>";
													}
													
													echo" Исполнитель: <a href='user.php?id=".$data_user['id']."'> ".$data_user['login']."</a> <br>";
													echo "Откуда: ".$row1['locality_A']." <br>
													Куда: ";
													if ($row1['locality_A'] == $row1['locality_B'])
													{
														echo "по городу. <br>";
													}
													else
													{
														echo "".$row1['locality_B']."<br>";
													}
												echo "Автомобиль: ".$row1['car']." <br>
													Желаемая цена: ";
													if ($row1['sell'] == 0)
													{
														echo "договорная. <br>";
													}
													else 
													{
														echo "".$row1['sell']." <br>";
													}
													echo "<p align = 'right'><a href = 'order.php?id=".$row1['id']."'> Подробнее >>></a></p>";					
													echo "</div>";
													
													

												} 
												while ($row = mysql_fetch_assoc($result)); 
											
											}	
										
										
									}
									while ($rout_data = mysql_fetch_assoc($rout_query)); 
								}
								
								}	
							}
							}	
								
						
						}
		?>
		</div>
		
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