<?
$ran_ad = rand(0,3);

switch ($ran_ad)
{
	case 0:
	echo "<a href = 'https://google.ru' target='_blank'><img src = 'images/ad1.png' height = '220' width= '180'> </a>";
	break;
	
	case 1:
	echo "<a href = 'https://yandex.ru' target='_blank'><img src = 'images/ad2.png' height = '220' width = '180'> </a>";
	break;
	
	case 2:
	echo "<a href = 'https://mail.ru' target='_blank'><img src = 'images/ad3.png' height= '220' width = '180'> </a>";
	break;
	
	case 3:
	echo '<a href="http://api.hostinger.ru/redir/18444985" target="_blank"><img src="http://www.hostinger.ru/banners/ru/hostinger-125x125-powered-1.gif" alt="Хостинг" border="0" width="180" height="220" /></a>';
	break;
}

?>