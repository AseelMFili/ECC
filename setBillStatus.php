<?php
require('db_conn.php');

    $status= $_POST["status"];
    $ID= $_POST["ID"];

    changeBillStatus($status,$ID);
 ?> 