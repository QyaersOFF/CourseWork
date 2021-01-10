<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8"/>
<title>Главная страница</title>
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
<br>
<?php
session_start();
if(!empty($_SESSION['login']))
{
echo "<form action='/Kursach_PI/test/log_page and reg/reg_log.php'>";
echo "<p align='right'>Приветствуем ".$_SESSION['login'].",вы авторизированы</p>";
echo "<p align='right'> <input type='submit' value='Выход'/></p>";
echo "</form>";	

}
else 
{
echo "<form action='/Kursach_PI/test/log_page and reg/login_page.php'>";
echo "<p align='center'><input type='submit' value='Авторизоваться'/></p>";
echo "</form>";	
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
Стоматология BeSave	
</h1>
<br><br><br><br><br><br><br><br>
<p align='justify' margin-top-40>
Добро пожаловать на сай стоматологии "BeSave". Для ознакомления с нашим персоналом вы можете перейти на вкладку "Списко врачей",если же вы желаете записаться на прием,но не знаете как откройте "Руководство пользователя" в меню справа.	
</p>
<p align="center"><img src="mp.jpg"/></p>
</div>
</div>

</body>
</html>