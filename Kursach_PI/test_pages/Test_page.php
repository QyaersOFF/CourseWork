<!DOCTYPE HTML>
<html>
<head>
<meta content="initial-scale=1, minimum-scale=1, width=device-width" name="viewport" />
<meta charset="utf-8"/>
<title>login page</title>
<script src="1.js">
</script>
</head>
<body>
<div id="logplase">
<table>
<tr>
<td>

<?php
session_start();
 function generateCode($length=6) { 
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789"; 
    $code = ""; 
    $clen = strlen($chars) - 1;   
    while (strlen($code) < $length) { 
        $code .= $chars[mt_rand(0,$clen)];   
    } 
    return $code; 
  } 
  
  # Если есть куки с ошибкой то выводим их в переменную и удаляем куки
  if (isset($_COOKIE['errors'])){
      $errors = $_COOKIE['errors'];
      setcookie('errors', '', time() - 60*24*30*12, '/');
  }

  # Подключаем конфиг
  include 'config.php';

?>
<p align='left'>Тест 1 Регистрация пользователя</p>
<p align="left"><button onClick="netrogai('test(reg).php');"align="center">Регистрация</button></p>

<p align='left'> Тест 2 Авторизация пользователя: Введите логин TestUser и пароль 123</p>
<?php

if(!empty($_SESSION['login']))
{
echo "<form action='reg_log.php'>";
echo "<p align='left'>Приветствуем ".$_SESSION['login'].",тест на регистрацию и авттризацию пройден!!</p>";
echo "<p align='right'> <input type='submit' value='Выход'/></p>";
echo "</form>";	

}
else 
{
echo "<form action='check.php' id='formlog' method='post'>";

# Проверяем наличие в куках номера ошибки
if (isset($errors)) {print "<p align='center'>".$error[$errors]."</p>";}
 ?>
  <p align="left">Login</p><p align="left"><input name="login">
</td>
</tr>
<tr>
<td>
  <p align="left">Password</p> <p align="left"><input type="password" name="password"></p>
   <p align="left"><input type="submit" value="Войти"></p>
   </form>
<?php
}
?>
<p align="left">Тест 3 Тест на обнавление информации в бд</p>
<form action="update_list.php">
<input type='submit' value="Очистить список клиентов"/>
</form>
<?php
$check_u_l=mysqli_query($link,"SELECT id_u_l FROM test_l WHERE id_u_l>0");
	if(mysqli_num_rows($check_u_l)<=0){
		echo "Тест пройден";
	}
	else{

	}
?>
</td>
</tr>
</table>
</div>
</body>
</html> 