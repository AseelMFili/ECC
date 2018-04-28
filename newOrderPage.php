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
        
        
          <div>
             <button type=button onclick="window.location.href='https://ecc-test-aseelmfili.c9users.io/cartDB/cart.php'"><h4>New Order</h4></button>
             <button type=button  onclick="window.location.href='https://ecc-test-aseelmfili.c9users.io/orderStatus.php'"><h4>Order Status</h4></button>
          </div>
    </div>
    
</body>

</html>