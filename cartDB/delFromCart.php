<?php

require('../db_conn.php');

if(!check_customers($_SESSION['email'],$_SESSION['password'])){
   
    /*header('location:../Home-Page.html');
    exit();*///to do return json to redirect to home page
}

$conn = null;
try {
	
  $host = 'localhost';
  $username = 'aseelmfili';
  $password = '';
  $database = 'ecc_db';
  // PDO class gives ability of choosing type of DB whether MySQL, ORACLE, MS SQL, and much more using correct driver!
  $conn = new PDO("mysql:host={$host};dbname={$database}", $username, $password);  
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  
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
			$sql = "DELETE from cart where item_id = ? and user_id = ?";
  $stmt = $conn->prepare($sql);
  

if(!$stmt->execute([$_POST["id"] , $uid])){
	
	throw Exception ("Cannot delete from cart, try again!!");
}

	}else{
	throw Exception ("Cannot find cartID to delete from cart, try again!!");
	
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