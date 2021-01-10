<!DOCTYPE HTML>
<html>
<head>
<meta content="initial-scale=1, minimum-scale=1, width=device-width" name="viewport" />
<meta charset="utf-8"/>
<title>login page</title>
<link href="log pageCSS.css" rel="stylesheet">
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

  <form action="check.php" id="formlog" method="post">
<?php
# Проверяем наличие в куках номера ошибки
if (isset($errors)) {print "<p align='center'>".$error[$errors]."</p>";}
 ?>
  <p id="text">Login</p><p align="center"><input name="login">
</td>
</tr>
<tr>
<td>
  <p id="text">Password</p> <p align="center"><input type="password" name="password"></p>
   <p align="center"><input type="submit" value="Войти"></p>
   </form>


</td>
</tr>
<td>
<p align="center">Если вы не зарегистрированны пройдите регистрацию.</p>
<p align="center"><button onClick="netrogai('test(reg).php');"align="center">Регистрация</button></p>
</td>
</table>
</div>
</body>
</html> 