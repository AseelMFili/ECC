<?php
  require('../db_conn.php');
  
$total=$_POST["total"];
  
  makeBill($_SESSION["email"],$total);
?>