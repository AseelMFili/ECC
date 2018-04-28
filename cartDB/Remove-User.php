<?php
  require('../db_conn.php');
  
  
  $id = $_POST["ID"];
  //$name = $_POST["name"];
  
  
  editUser($id);
?>