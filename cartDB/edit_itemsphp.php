<?php
  require('../db_conn.php');
  
  
  $img = $_POST["img"];
  $name = $_POST["name"];
  $price = $_POST["price"];
  $id = $_POST["ID"];
  $flag = $_POST["flag"];
  
  editItem($id,$name,$price,$img,$flag);
?>