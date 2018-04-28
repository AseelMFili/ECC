<?php
require('db_conn.php');

    $email= $_POST["email"];
    $password= md5($_POST["password"]); 
    $username=$_POST["username"]; 
    $phoneNo=$_POST["phoneNo"]; 
    $city=$_POST["city"]; 
    $street=$_POST["street"]; 

    updateCustomer($email,$password,$username,$phoneNo,$city,$street);
 ?> 