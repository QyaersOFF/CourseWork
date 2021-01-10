<!DOCTYPE HTML>
<html>
<head>
<meta content="initial-scale=1, minimum-scale=1, width=device-width" name="viewport" />
<meta charset="utf-8"/>
<title>login page</title>
<link href="log pageCSS.css" rel="stylesheet">
<script type="text/javascript" src="js.js">
</script>
</head>
<body>

<div id="logplase">
<table>
<tr>
<td>
<?php
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

  if(isset($_POST['login'])) 
  { 
    
    # Вытаскиваем из БД запись, у которой логин равняеться введенному 
    $data = mysqli_fetch_assoc(mysqli_query($link,"SELECT id_u, password_u FROM user_t WHERE login_u='".mysqli_real_escape_string($_POST['login'])."' LIMIT 1")); 
     
    # Соавниваем пароли 
    if($data['password_u'] == md5(md5($_POST['password']))) 
    { 
      # Генерируем случайное число и шифруем его 
      $hash = md5(generateCode(10)); 
           
      # Записываем в БД новый хеш авторизации и IP 
      mysqli_query("UPDATE user_t SET users_hash='".$hash."' WHERE id_u='".$data['id_u']."'") or die("MySQL Error: " . mysqli_error()); 
       
      # Ставим куки 
      setcookie("id", $data['id_u'], time()+60*60*24*30); 
      setcookie("hash", $hash, time()+60*60*24*30); 
       
      # Переадресовываем браузер на страницу проверки нашего скрипта 
      header("Location: check.php"); exit(); 
	} 
    else 
    { 
      print "Вы ввели неправильный логин/пароль<br>"; 
    }
  }
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