<?php

require('./db_conn.php');

$conn = null;
try {
	
  $conn = db_connection();
  
  if (isset($_SESSION['email'], $_SESSION['password'])) {
	$stmt= $conn->prepare("SELECT * FROM `customers` where email = ? and password = ?");
	
	$values = [];
	$values[]=$_SESSION['email'];
	$values[]=$_SESSION['password'];
	
	if($stmt->execute($values)){
		
		$uid=false;
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			$uid=$row["ID"];
			break;
		}
	}
	if($uid!== false){
			 
			 
			 
  $stmt= $conn->prepare("select b.ID, b.status, c.username from customers c INNER JOIN bill b on c.ID = b.user_id ");
  
  if ($stmt->execute([$uid])) {
	    
	  
		$arr = [];
	
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			//print_r($row);
			
			$x=[//insert new item to billChief
			"bill_ID"=>$row['ID'],
			"name"=>$row['username'],
			"status"=>$row['status'],
			"paid_flag"=>$row['paid_flag'],
			"items"=>[]
			];
		  $stmt2= $conn->prepare("select bi.quantity, i.item_name from  bill_items bi INNER JOIN items i on i.ID = bi.item_id where bill_ID=?");
		  
	if($stmt2->execute([$row['ID']])){
			while($row2=$stmt2->fetch(PDO::FETCH_ASSOC)){
			$x['items'][]=[
			"quantity" => $row2['quantity'],
			"item_name" => $row2['item_name']
			];
	}	
		}
		$arr[]=$x;
		}
    
	}else{
		throw new Exception("unable to excute the select");
		
	}
	}else{
		throw new Exception("user not exist");
		
	}
	}else{
	  throw new Exception("Please log in!!");
  }
  } catch (Exception $e) {//edit the exception
	 $err=$e->getMessage();
    
} finally {
	$result=[];
	if(isset($err)){
		$result["error"]=$err;
	}else{
		$result["bill"]=$arr;	
	}
	echo json_encode($result);//convert array to json string
  $conn = NULL;
}