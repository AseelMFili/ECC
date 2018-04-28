<?php
  require('db_conn.php');
  
  $lat = $_POST["lat"];
  $lng = $_POST["lng"];
  
  addloc($lat,$lng);
?>