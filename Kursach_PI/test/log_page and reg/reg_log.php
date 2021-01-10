<?php
session_start();
$_SESSION = array();
setcookie("id",''); 
setcookie("hash",''); 
session_destroy();
header('Location: /Kursach_PI/test/log_page and reg/Login_page.php'); exit();
?>  