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
Руководство пользователя
</h1>
<p align='justify' margin-top-40>
Добрый день! Сегодня вы решили посетить наш сайт. И наврное вам бы хотелось узнать,что это за ресурс и для чего он был создан.
Данный сайт представляет собой систему автоматизации деятельности стоматологии .Где любой желающий может зарегестрироваться  и после записаться на прием в нашу стоматологию.</p>
<p align='justify'>

Чтобы записаться на прием  вам нужно лишь выбрать Врача из списка в правой части сайта,после того как у вас откроется страница записи на прием выберите время из предоставленных в таблице и нажмите кнопку записи. П.С. 
Если вы хотите записаться на другое время у вас не получиться,так как в день установлен лимит на запись,он обнавляеться каждый день в 20:00 по МСК у каждого врача.
</p>
</div>
</div>

</body>
</html>