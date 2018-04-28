<?php
require('db_conn.php');

if(!check_customers($_SESSION['email'],$_SESSION['password'])){
   
    header('location:./Home-Pagee.php');
    exit();
}
?>


<html>
<head>
     <meta charset="utf-8">
        <title>Cookie & Coffee </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/fontawesome-all.min.css">
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="Home-Page.css">

</head>
<body>
    
    
     <div><a href="../cartDB/SignOut.php">
                <img src="../cartDB/images/pack02-05-512.png" alt="SignOut" id="SignOut" style="float:left;margin-left:20px;width:30px;height:30px;">
                </a>
                
                <a href="../Setting%20Page.php">
                <img src="../cartDB/images/settings.png" alt="Settings" id="settings.png" style="float:left;width:30px;height:30px;">
                </a></div>
                
    <div id="MainDiv" style="padding-top:50px;">
        
        <img src="./images/Logo.png" alt="Cookie & Coffee" id="logo">

               
        <p>
            <img src="./images/horizintal.png" id="Hline">
        </p>
        
       <h1>Your order is Pending!</h1>
    </div>
    
</body>

</html>


