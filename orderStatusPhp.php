<?php
    require('db_conn.php');
    
    $ID = $_POST['ID'];
    
    getStatus($ID);
    
?>