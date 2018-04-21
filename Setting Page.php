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
    <title>Setting Page</title>
    <link rel="stylesheet" href="Setting Page.css">
</head>

<body>
    <div id="MainDiv">
        <img src="./images/Logo.png" alt="Cookie & Coffee" id="logo">

        <p>
            <img src="./images/horizintal.png" id="Hline">
        </p>
        <H1>Setting</H1>
        <form action="Setting PagePhp.php" method="POST">
        <div>
            <label>Email Address</label>
        </div>
        <div class="paddbot">
            <input type="email" class="email" name="email" value="<?=$_SESSION["email"]?>" required>
        </div>

        <div>
            <label>Password</label>
        </div>
        <div class="paddbot">
            <input type="password" id="password" class="password" name="password" value="<?=$_SESSION["password"]?>" minlength="8" required>
        </div>
            
        <div>
            <label>Re-Password</label>
        </div>
        <div class="paddbot">
            <input type="password" id="re-password" class="password" name="re-password" value="<?=$_SESSION["password"]?>" minlength="8" required>
            <div id="confirmMessage" class="confirmMessage" ></div>
        </div>
            
            
        <div>
            <label>Your username</label>
        </div>
        <div class="paddbot">
              <input type="text" id="username" name="username" value="<?=$_SESSION["username"]?>" required>
        </div>
            
            
        <div>
            <label>Phone Number</label>
        </div>
        <div class="paddbot">
            <input type="tel" id="PhoneNo" name="phoneNo" value="<?=$_SESSION["phoneNo"]?>">
        </div>

        <div>
            <label>City</label>
        </div>
        <div class="paddbot">
            <input type="text" id="city" name="city" value="<?=$_SESSION["city"]?>">
        </div>

        <div>
            <label>Street</label>
        </div>
        <div class="paddbot">
            <input type="text" id="street" name="street" value="<?=$_SESSION["street"]?>">
        </div>

            

        <button type="submit">Submit</button>
    </div>
    </form>
    <script src="Setting Page.js"></script>
</body>

</html>


