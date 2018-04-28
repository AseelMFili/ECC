<?php

require('db_conn.php');


   $email= $_POST["email"];
   $password= md5($_POST["password"]); 

if(check_customers($email,$password)){
    header("Location:https://ecc-test-aseelmfili.c9users.io/newOrderPage.php");
}else{
    header("Location:https://ecc-test-aseelmfili.c9users.io/Home-Pagee.php?error=Login Error Please check your email and password!");
}
?>


