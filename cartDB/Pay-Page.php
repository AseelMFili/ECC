<?php
require('../db_conn.php');

if(!check_customers($_SESSION['email'],$_SESSION['password'])){
   
    header('location:../Home-Pagee.php');
    exit();
}
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Cookie & Coffee | Payment Method</title>
    
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/fontawesome-all.min.css">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
<link rel="stylesheet" href="/cartDB/Pay-Page.css">
    
</head>

<body>
    
    <div id="MainDiv">
        <img src="./images/Logo.png" alt="Cookie & Coffee" id="logo" style="margin-top: 50px;">

        <p>
            <img src="./images/horizintal.png" id="Hline">
        </p>
        <h2>Please Choose How do you want to pay: </h2>
        </div>

    
     <div class="card-group" style=" margin-left:-50; margin-top:-400;">
    
    <form action="Pay-PagePhp.php" method="POST">
        
    <div class="card" style="float:left;margin-left:330px;padding:80px 40px;background-color:transparent;border-style:none;">
        <img class="card-img-top" src="./images/cash-payment-icon-5.png" alt="Card image cap" style="height:150px;width:150px">
        <div class="card-body">
        <h5 class="card-title" style="text-align:center;font-weight:bold;">Cash</h5>
    <br>
    <br>
    <br>
    <button type="submit" href="https://ecc-test-aseelmfili.c9users.io/cartDB/bill_Page.php" class="btn btn-primary"  name = "cash" value="cash">Confirm Order!</button>
      </div>
    </div><!-- Cash ends here -->

        
    <div class="card" style="float:left;padding:80px 40px;background-color:transparent;border-style:none;">
  <img class="card-img-top" src="./images/Visa.png" alt="Card image cap" style="width: 200px;">
  <div class="card-body">
    <h5 class="card-title" style="text-align:center;font-weight:bold;">VISA</h5>
    
    <div class="form-group">
        <label for="exampleInputEmail1">Name: </label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Abdullah Wael">
    </div>
    
    <div class="form-group">
        <label for="exampleInputEmail1">Card Number: </label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="XXXXXX XX XXXX XXXX XXX">
    </div>
    
    <div class="form-group">
        <label for="exampleInputEmail1">CCV: </label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="XXX">
    </div>
    
    <div class="form">
        <label for="exampleInputEmail1">Expire Date: </label>
        
        <div class="form-row">
        <div class="form-group col-md-4">
      <label for="inputState">Month</label>
      <select id="inputState" class="form-control">
        <option selected>01</option>
        <option>02</option>
        <option>03</option>
        <option>04</option>
        <option>05</option>
        <option>06</option>
        <option>07</option>
        <option>08</option>
        <option>09</option>
        <option>10</option>
        <option>11</option>
        <option>12</option>
      </select>
      
      </div>
      
       <div class="form-group col-md-4">
        
        <label for="inputState">Year</label>
      <select id="inputState" class="form-control">
        <option selected>2018</option>
        <option>2019</option>
        <option>2020</option>
        <option>2021</option>
        <option>2022</option>
        <option>2023</option>
        <option>2024</option>
        <option>2025</option>
      </select>
    </div>
      
    </div>
    </div>
   
    
    <button type="submit" href="https://ecc-test-aseelmfili.c9users.io/cartDB/bill_Page.php" class="btn btn-primary"  name = "visa" value="visa">Confirm Order!</button>
  </div>
</div><!-- VISA card ends here-->
    

    <div class="card" style="float:left;padding:80px 40px;background-color:transparent;border-style:none;">
  <img class="card-img-top" src="./images/ATM.jpg" alt="Card image cap" style="width: 200px;">
  <div class="card-body">
    <h5 class="card-title" style="text-align:center;font-weight:bold;">Transfer</h5>
    <p class="card-text">Al Ahli IBAN: </p><p>SA14 3256 0367 7883 3452 2221</p><br>
    <p class="card-text">Al Rajhi IBAN: </p><p>SA64 7775 8747 0088 6534 9934</p><br>
    <p class="card-text">Samba IBAN: </p><p>SA89 9456 3749 6753 3301 0303</p>
    <button type="submit" href="https://ecc-test-aseelmfili.c9users.io/cartDB/bill_Page.php" class="btn btn-primary"  name = "transfer" value="transfer">Confirm Order!</button>
  </div>
</div><!-- tranfer card ends here -->
</form>
    </div><!-- card group ends here -->


                

    
</body>

</html>