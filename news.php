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
	$max = mysql_result(mysql_query("SELECT MAX(id) FROM `news_freight`"), 0, 0);
	#echo "max id = ".$max."";
	$quanNews = $max-5;
	if ($quanNews < 1)
	{
		$quanNews = 0;
	}
	for ($i = $max; $i>$quanNews; $i--)
	{
		$query = mysql_query ("SELECT * FROM `news_freight` WHERE `id` = '".$i."'");
		$data = mysql_fetch_assoc ($query);
		echo "
			<fieldset>
			<legend>".$data['title']."</legend>
			<p>".$data['date']."</p>
			<p>".$data['text']."</p>";
			if ($data['link']!='0')
			{
				echo "<a href=".$data['link'].">Подробнее>>></a>";
			}
			 echo "</fieldset>";
		
	}


?>
</html>