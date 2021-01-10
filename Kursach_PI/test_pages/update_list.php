<?php
session_start();
include "config.php";
$sql3="update test_l set id_u_l=null where id_u_l is not null;"; 
if(mysqli_query($link, $sql3)){
    header('location: Test_page.php');
} else{
    echo "ERROR: Could not able to execute $sql3. " . mysqli_error($link);
}