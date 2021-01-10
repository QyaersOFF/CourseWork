<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8"/>
<title>Запись выполнена</title>
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
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><p></p>
</div>
<div id="content">
<h1 align="center">
Вы записались на прием.
</h1>
<?php
include_once("config.php");
$log=$_SESSION['login'];
$id = mysqli_real_escape_string($link, $_REQUEST['work_h']);
$time_h=mysqli_query($link,"SELECT id_h FROM work_h WHERE work_h='$id'");
if(mysqli_num_rows($time_h)<=0){
    echo ("записей не обнаружено!");
	}
	else{    
	$myrow1 = mysqli_fetch_array($time_h);          
	}
	$id_user_h=$myrow1['id_h'];
$user_id=mysqli_query($link,"SELECT id_u FROM user_t WHERE login_u='$log'");
if(mysqli_num_rows($user_id)<=0){
    echo ("записей не обнаружено!");
	}
	else{    
	$myrow2 = mysqli_fetch_array($user_id);          
	}
	$id_user_t=$myrow2['id_u'];
$sql3="UPDATE list_p set id_u_l='$id_user_t' where id_p_wh=$id_user_h"; 
if(mysqli_query($link, $sql3)){
    echo "Запись успешна,вы записаны на прием в $id. <br> <a href=mp.php>На главную</a>";
} else{
    echo "ERROR: Could not able to execute $sql3. " . mysqli_error($link);
}
?>
</div>
</div>

</body>
</html>