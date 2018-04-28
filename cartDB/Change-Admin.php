<?php
  require('../db_conn.php');
  
  
  $id = $_POST["ID"];
  //$name = $_POST["name"];
  
  
  change_Admin($id);
?>