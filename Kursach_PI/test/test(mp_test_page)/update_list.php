<?php
session_start();
include "config.php";
$sql3="update list_p set id_u_l=null where id_u_l is not null;"; 
if(mysqli_query($link, $sql3)){
    header('location: /Kursach_PI/test/test(mp_test_page)/Update_admin.php');
} else{
    echo "ERROR: Could not able to execute $sql3. " . mysqli_error($link);
}