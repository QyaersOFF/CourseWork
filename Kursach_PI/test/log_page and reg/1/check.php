<?php
# подключаем конфиг
include 'config.php';  

# проверка авторизации
if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) 
{    
    $query = (mysqli_query("SELECT * FROM user_t WHERE id_u = '".intval($_COOKIE['id'])."' LIMIT 1"));
	$userdata = mysqli_fetch_assoc($query);

    if(($userdata['users_hash'] !== $_COOKIE['hash']) or ($userdata['users_id'] !== $_COOKIE['id'])) 
    { 
        setcookie('id', '', time() - 60*24*30*12, '/'); 
        setcookie('hash', '', time() - 60*24*30*12, '/');
    setcookie('errors', '1', time() + 60*24*30*12, '/');
    header('Location: Login_page.php'); exit();
    } 
	else
	{
		print "Привет, ".$userdata['login_u'].". Всё работает!";
	}
} 
else 
{ 
  setcookie('errors', '2', time() + 60*24*30*12, '/');
  header('Location: Login_page.php'); exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
  <title>check_log</title>
<script  language="javascript">
 
var seconds=10;
document.d.d2.value='0';
 
function display()
{
    if (seconds<2)
    {
    <?
    if ($s==0)print "top.location.href='/test/test(тесты и главная страница)/mp.php'";
    ?>
 
    }
    seconds-=1;
    document.d.d2.value=seconds;
    setTimeout("display()",1000);
}
</script>
</head>
<body>
<?php
session_start();
$name_log=$_POST['login'];

$_SESSION[$name_log]
?>
 display();
</body>
</html>