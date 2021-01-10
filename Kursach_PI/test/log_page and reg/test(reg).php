<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content='width=1000' />
<title>registartion page</title>
<link href="reg_pageCSS.css" rel="stylesheet">
</head>
<body>
	<div id="logplase">
<?php
// Подключаем конфиг
include 'config.php';

if (isset($_POST['submit'])) {

    $err = array();

    // проверям логин
    $loginFromRequest = $_POST['login'];
    if (! preg_match("/^[a-zA-Z0-9]+$/", $loginFromRequest)) {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }

    if (strlen($loginFromRequest) < 3 or strlen($loginFromRequest) > 30) {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }

    // проверяем, не сущестует ли пользователя с таким именем
    $queryText = "SELECT COUNT(id_u) as count FROM user_t WHERE login_u='". $loginFromRequest. "'";
    $query = mysqli_query($link, $queryText);
    
    $row = mysqli_fetch_assoc($query);
    
    if (($row['count']) > 0) {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }
    //
    echo $row['count'];
    // Если нет ошибок, то добавляем в БД нового пользователя
    if (count($err) == 0) {

        $login = $loginFromRequest;

        // Убераем лишние пробелы и делаем  шифрование
		
		$password = hash("sha256",(trim($_POST['password'])));
        $email_i = $_POST['email'];
        mysqli_query($link, "INSERT INTO user_t SET login_u='" . $login . "', password_u='" . $password . "', email='" . $email_i . "'");
        header('Location: close_reg.php'); exit();
        exit();
    }
}
?>
  <form method="POST" action="">
			<p id="text">Login</p>
			<p align="center">
				<input type="text" name="login" id="reg_inp">
			
			
			<p id="text">Password</p>
			<p align="center">
				<input type="password" name="password" id="reg_inp">
			</p>
			<p id="text">Email</p>
			<p align="center">
				<input type="text" name="email">
			</p>
			<p align="center">
				<input type="submit" name="submit" value="Зарегистрироваться">
			</p>
		</form>

  <?php
if (isset($err)) {
    print "<b>При регистрации произошли следующие ошибки:</b><br>";
    foreach ($err as $error) { 
        print $error."<br>"; 
      }   
    }
  ?>
 </div>
</body>
</html>