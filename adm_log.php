<!DOCTYPE html>

<html>

<head>
	<meta charset = "UTF-8">
	<title>Доставка грузов. Омск</title>
</head>
<?
	$connect = mysql_connect("mysql.hostinger.ru","u920145323_admin","d3i0m1a95") or die (mysql_error());
	mysql_select_db("u920145323_bd1");
	if (mysqli_connect_errno())
{
    printf("Соединение не установлено: %s\n", mysqli_connect_error());
    exit();
}
	$max = mysql_result(mysql_query("SELECT MAX(id) FROM `log_adm`"), 0, 0);
	$quanNews = $max-10;
	if ($quanNews < 1)
	{
		$quanNews = 0;
	}
	for ($i = $max; $i>$quanNews; $i--)
	{
		$query = mysql_query ("SELECT * FROM `log_adm` WHERE `id` = '".$i."'");
		$data = mysql_fetch_assoc ($query);
		
				
		switch ($data['act'])
		{
			case 'Редактировал новость':
			
			echo "
			<fieldset>
			<legend>".$data['act']."</legend>
			<p> Администратор &#171 ".$data['login_adm']." &#187  добавил новость &#171 ".$data['title_news']." &#187 </p>
			</fieldset>";
			
			break;
			
			case 'Ответил в саппорте':
			
			echo "
			<fieldset>
			<legend>".$data['act']."</legend>
			<p> Администратор &#171 ".$data['login_adm']." &#187  ответил на вопрос &#171 ".$data['title_sup']." &#187 от пользователя  &#171 ".$data['login_user']." &#187</p>
			</fieldset>";
			break;
			
			break;
			
			case 'Назначил руководителя':
				echo "
			<fieldset>
			<legend>".$data['act']."</legend>
			<p> Администратор &#171 ".$data['login_adm']." &#187  назначил &#171 ".$data['give_rang']." &#187 пользователя  &#171 ".$data['login_user']." &#187</p>
			</fieldset>";
			break;
			
			case 'Забанил пользователя':
			echo "
			<fieldset>
			<legend>".$data['act']."</legend>
			<p> Администратор &#171 ".$data['login_adm']." &#187  забанил пользователя  &#171 ".$data['login_user']." &#187 по причине &#171 ".$data['cause']." &#187 </p>
			</fieldset>";
			break;
		}
		
		
		
	}


?>
</html>