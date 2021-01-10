<?php
session_start();
$_SESSION = array();
setcookie("id",''); 
setcookie("hash",''); 
session_destroy();
header('Location: Test_page.php'); exit();
?>  