<?php
require('db_conn.php');

if(!check_customers($_SESSION['email'],$_SESSION['password'])){
   
    header('location:../Home-Pagee.php');
    exit();
}
?>


<html>

<head>
    <meta charset="utf-8">
    <title>Forget Password</title>
    <link rel="stylesheet" href="ForgetPass.css">
</head>

<body>
    <div id="MainDiv">
        <form action="ForgetPass.php" method="POST">
        <img src="./images/Logo.png" alt="Cookie & Coffee" id="logo">

        <p>
            <img src="./images/horizintal.png" id="Hline">
        </p>
        
        <div>
            <label>Enter your email address</label>
        </div>
        <div class="paddbot">
            <input type="email" class="email" name="email" value="" required>
        </div>
        
        <div>
            <label>Enter your new password</label>
        </div>
        <div class="paddbot">
            <input type="password" class="password" name="newPass" value="" minlength="8" required>
        </div>
        
        <div>
            <label>Re-enter your new password</label>
        </div>
        <div class="paddbot">
            <input type="password" class="password" name="newPass" value="" minlength="8" required>
        </div>


        <button type="submit">Confirm</button>
    </form>

    </div>
</body>

</html>