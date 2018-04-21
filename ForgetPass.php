<?php

require('db_conn.php');


   $email= $_POST["email"];
   $newPass= md5($_POST["newPass"]);

   
    update_pass($email,$newPass);
?> 