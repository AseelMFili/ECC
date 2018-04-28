<?php

require('../db_conn.php');

    $cash = $_POST['cash'];
    $visa = $_POST['visa'];
    $transfer = $_POST['transfer'];
    
if($cash){
    paymentMethod($cash);
}else if($visa){
    paymentMethod($visa);
}else{
    paymentMethod($transfer);
}