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
<?php
	include "config.php";
	$result0 = mysqli_query($link,"SELECT DISTINCT work_h FROM work_h,list_p WHERE id_h=id_p_wh and id_u_l is not Null");
	if (!$result0) {
		die("Query to show fields from table failed");
	}
	$result1 = mysqli_query($link,"SELECT DISTINCT login_u FROM user_t,list_p WHERE id_u_l=id_u and id_u_l");
	if (!$result1) {
		$result1="Null";
	}
	echo "<br><br><br><table align='center' border='1'><tr>";
	while ($finfo = $result0->fetch_field()) {
        echo "<td><h1> Время</h1></td><td><h1> Запись</h1></td>";
		}
	echo "</tr>\n";
	
	while($row = $result0->fetch_array(MYSQLI_ASSOC))
	{
	while($row1 = $result1->fetch_array(MYSQLI_ASSOC))
	{
	foreach($row1 as $cell2)
	echo "<tr>";
	foreach($row as $cell)
	echo "<td><h1>$cell</h1></td>";
	echo "<td><h1>$cell2</h1></td>";
	echo "</tr>\n";
	}
	}
	echo "</table>";
?>
<br>
<h1 align='center'>
<form action="/Kursach_PI/test/test(mp_test_page)/update_list.php">
<input type='submit' value="Очистить список клиентов"/>
</form></h1>
</div>
</div>

</body>
</html>