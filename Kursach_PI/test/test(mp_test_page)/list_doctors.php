
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8"/>
<title>Список врачей</title>
<link rel="stylesheet" type="text/css" href="main_pageCSS.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>

   select {
    width: 150px; /* Ширина списка в пикселах */
   }

  </style>
</head>
<body>
<div id="conteiner">
		<div id="Menu">
		<?php
		if(!empty($_SESSION['login']))
		{ ?>
			<form action='/test/log_page and reg/reg_log.php'>
			<p align='right'><?php echo $_SESSION['login'];?>,вы авторизированы</p>
			<p align='right'> <input type='submit' value='Выход'/></p>
			</form>
			<?php
		} else { 
			?>
			<form action='/test/log_page and reg/login_page.php'>
			<br>
			<p align='center'><input type='submit' value='Авторизироваться'/></p>
			</form>	
			<?php
		}
		?>
<nav>
<?php
if(!empty($_SESSION['login']))
{
echo "<h1>Выберите доктора</h1>";
echo "<form action='nochoise(try).php' method='post'>";
echo "<p>";
include 'config.php';
mysqli_query($link,"SET NAMES 'utf8");
mysqli_query($link,"SET CHARACTER SET 'utf8'");
$result6 = mysqli_query($link,"SELECT DISTINCT login_u FROM user_t where privelegy_u='doctor'");
if(mysqli_num_rows($result6)<=0)
	{
        echo ("записей не обнаружено!");
	}else
	{
        echo (" <select type='text' name='theme' class=\"StyleSelectBox\">");
            while ($myrow6 = mysqli_fetch_array($result6)) 
            {
                        echo ("<option  name='theme' value=\"$myrow6[login_u]\">$myrow6[login_u]</option>\n");
            }
        echo ("</select>");        
	}
echo "<input type='submit' value='Перейти' />";
echo "</p>";
echo "</form>";
}
else
{
	echo "<p align='center'> Для записи на прием пройдите авторизацию.</p>";
}
?>
</p>
</nav>
<nav>
<ul class="topmenu">
<h1>Меню</h1>
</ul>
</nav>
<p align="center">
<a href="mp.php">Главная страница</a>
</p>
<p align="center">
<a href="list_doctors.php">Список врачей</a>
</p>
<p align="center">
<a href="readme.php">Руководство пользователя</a>
</p>
</div>
<div id="content">
<h1 align="center">
Список врачей
</h1>
<h2>Lavrov Sergey</h2>
<p align='justify' margin-top-40>
<img align="left" src='Lavrov.png'/></a>
<br>
Лавров Сергей 35 лет, стаж работы более 10 лет в области стоматологии. 
Всегда делает свою работу качественно и быстро. В основном занимаеться проблемами кариеса и более сложных задач.

</p>
<br>
<br>
<br>
<br><br>
<h2>Dushmanov Oleg</h2>
<p align='left'>
<img align="left" height="180" width="150" src='Dushmanov.png'>
<br>
Душманов Олег 30 лет, стаж работы 5 лет,в области стоматологии.
Работает с клиентами любого возраста. В основном занимаеться осмотром и назначением лечения,также яляеться главным врачем.
</p>
<br>
<br><br>
<h2>Sobolev Egor</h2>
<p align='left'>
<img align="left" height="180" width="150" src='Sobolev.jpg'>
<br>
Соболев Егор 29 лет, стаж работы 4 года,в области стоматологии. Занимаеться лечением установкой пломб и лечения кариеса,
быстро и качественно. 
</p>
<br>
<br>
<br>
<br>
<h2>Frankov Nikita</h2>
<p align='justify'>
<img align="left" height="180" width="150" src='Frankov.jpg'>
<br>
Франков Никита 30 лет, стаж работы 5 лет,в области стоматологии.
Хороший специалист который поможет любому клиенту с проблемами боли зубов и кариеса.
</p>
<br>
<br>
<br>
<br>
<h2>Testerov Denis</h2>
<p align='justify'>


<img align="left" height="180" width="150" src='Testerov.jpg'>
<br>
Тестеров Денис 34 года, стаж работы 9 лет,в области стоматологии.
Поможет вам избавиться от проблемных зубов и вставить новые.
</p>
<br>
</div>
</div>
</body>
</html>