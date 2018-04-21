<?php

require('../db_conn.php');

$conn = null;
try {
	
  $conn = db_connection();
  
  if (isset($_SESSION['email'], $_SESSION['password'])) {
  	$values=[];
  $values[]=$_SESSION['email'];
  $values[]=$_SESSION['password'];
  
	$stmt= $conn->prepare("SELECT * FROM `customers` where email = ? and password = ?");
	if($stmt->execute($values)){
		$uid=false;
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			$uid=$row["ID"];
			break;
		}
	}
	if($uid!== false){
		$stmt= $conn->prepare("SELECT * FROM `cart` where user_id = ? and item_id = ?");
		if($stmt->execute([$uid,$_POST['id']])){
		$cartid=false;
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			$cartid=$row["ID"];
			break;
		}
	}
	
	if($cartid!==false){
			$sql = "UPDATE cart set `quantity`=`quantity` + ? where item_id = ? and user_id = ?";
  $stmt = $conn->prepare($sql);
  

if(!$stmt->execute([$_POST["quantity"],$_POST["id"] , $uid])){
	
	throw Exception ("Cannot update to cart, try again!!");
}

	}else{
		$stmt=$conn->prepare("SELECT price from items WHERE ID=?");
		if($stmt->execute([$_POST["id"]]) && ($row=$stmt->fetch(PDO::FETCH_ASSOC)) !== false){
		$sql = "INSERT INTO cart (`item_id`, `quantity`, `user_id`, `price`) VALUES (?, ?, ?,?)";
  $stmt = $conn->prepare($sql);
		

if($stmt->execute([$_POST["id"], $_POST["quantity"], $uid, $row["price"]])){
  $cartid= $conn->lastInsertId();
}else{
	throw Exception ("Cannot add to cart, try again!!");
	}
		}
		
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
		$result["id"]=$cartid;	
	}
	echo json_encode($result);//convert array to json string
  $conn = NULL;
}