
<?php
require('../db_conn.php');

if(!check_customers($_SESSION['email'],$_SESSION['password'])){
   
    header('location:../Home-Pagee.php');
    exit();
}
?>

    <html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/fontawesome-all.min.css">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="/cartDB/method_Of_OrderPage.css">

    </head>

    <body>
 <div id="MainDiv">
        <img src="./images/Logo.png" alt="Cookie & Coffee" id="logo" style="margin-top: 50px;">

        <p>
            <img src="./images/horizintal.png" id="Hline">
        </p>
         <h2>Please Choose the Method of Order:</h2>
        </div>
        
        <div style="margin-top:-350px; margin-left:80px;">
         <a type="button" class="btn btn-info" href="https://ecc-test-aseelmfili.c9users.io/cartDB/Pay-Page.php" style="margin: 20px 50px 80px 340px; height: 220px; width:220px;"><img src="/cartDB/images/pickup.png" style="height: 200px; width:200px; margin-right: 500px;"/></a>
        
        <a type="button" class="btn btn-info"  href="https://ecc-test-aseelmfili.c9users.io/locationPage.php" style="margin: 20px 50px 80px ; height: 220px; width:220px;"><img src="/cartDB/images/delivery.png" style="height: 200px; width:200px; margin-right: 500px;"/></a>
        </div>
       
       
        
</body>
</html>