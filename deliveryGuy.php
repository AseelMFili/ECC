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
    <title>Cookie & Coffee </title>
    <link rel="stylesheet" href="deliveryGuy.css">
</head>

<body>
   <form action="DeliveryGuyPhp.php" method="GET">
    <div id="MainDiv">
        <img src="./images/Logo.png" alt="Cookie & Coffee" id="logo">

    
        <p>
            <img src="./images/horizintal.png" id="Hline">
        </p>
        
       <h1>Delivery Guy Page</h1>
  <button type="GET">Get Location</button>
   </form>
</body>

</html>