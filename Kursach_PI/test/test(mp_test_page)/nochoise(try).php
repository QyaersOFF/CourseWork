<?php
//Функция дебага для проверки работы запросов и записей.
include_once $_SERVER['DOCUMENT_ROOT'] . "/Kursach_PI/test/lib/db.php";

	function Debug($var, $var_name = null) {
		echo "<pre>";
		if ($var_name !== null) 
			echo "$var_name = ";
		print_r($var);
		echo "</pre>";
	}
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8"/>
<title>Запись на прием</title>
<style>
   select {
    width: 150px; /* Ширина списка в пикселах */
   }
   
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="main_pageCSS.css" />
<script 
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous">
</script>
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
<?php
	$check_them1=$_POST['theme'];
	include "config.php";
	mysqli_query($link,"SET NAMES 'utf8");
	mysqli_query($link,"SET CHARACTER SET 'utf8'");
	$Thema_SQL=mysqli_query($link,"SELECT DISTINCT login_u FROM user_t WHERE login_u='$check_them1'");
		if(!$Thema_SQL)
		{
			die ("Query to show fields from table failed");
		}
		while($themas = $Thema_SQL->fetch_array(MYSQLI_ASSOC))
		{ 
			foreach($themas as $row)
			{
				echo "<h1 name='check_theme' id='check_theme_id' align='center'>Запись на прием к $row</h1>";
			}
		}
$log=$_SESSION['login'];		
$user_id=mysqli_query($link,"SELECT id_u FROM user_t WHERE login_u='$log'");
if(mysqli_num_rows($user_id)<=0){
    echo ("записей не обнаружено!");
	}
	else{    
	$myrow1 = mysqli_fetch_array($user_id);          
	}
	$id_user_t=$myrow1['id_u'];
//-------
$user_id=mysqli_query($link,"SELECT id_u_l FROM list_p WHERE id_u_l='$id_user_t'");
if(mysqli_num_rows($user_id)<=0){
    $id_time_u='0';
	}
	else{    
	$myrow2 = mysqli_fetch_array($user_id);          
	$id_time_u=$myrow2['id_u_l'];	
	}
$time_list=mysqli_query($link,"SELECT id_p_wh FROM list_p WHERE id_u_l is NULL");
	if(mysqli_num_rows($user_id)<=0){
	
	}
	else{
	$row_list_pwh=mysqli_fetch_array($time_list);
	$id_row_time=$row_list_pwh['id_p_wh'];
	}
//-------
if(!$user_id=$id_time_u){		
	$result0 = mysqli_query($link,"SELECT DISTINCT work_h FROM work_h,user_t,doctor where id_dockor_t=id_u and login_u='$check_them1'");
	if (!$result0) {
		die("Query to show fields from table failed");
	}
	echo "<br><br><br><table border='1'><tr>";
	while ($finfo = $result0->fetch_field()) {
        echo "<td><h1> Время</h1></td><td><h1> Запись</h1></td>";
		}
	echo "</tr>\n";
	while($row = $result0->fetch_array(MYSQLI_ASSOC))
	{
	echo "<tr>";
	foreach($row as $cell)
	echo "<td><h1>$cell</h1></td>";
	echo "<td><h1><form action=\"result.php\" method=\"post\"><input type=\"hidden\" name=\"work_h\" id=\"work_h\" value=\"".$row["work_h"]."\"><input type=\"submit\" value=\"Запись\"></form></h1></td>";
		echo "</tr>\n";
	}
	echo "</table>";
}
else{
	echo "<br><br><br><p align='justify'>Вы уже записаны на прием в нащей поликлинике,если хотите записаться повторно,то ожидайте обнавления списка клиентов.<br>Обновление происходит каждый день, кроме выходных в 20:00 по МСК.</p>";
}
?>
		</div>
	</div>
</body>
</html>