<?php

require('../db_conn.php');

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
			
  $stmt= $conn->prepare("SELECT c.ID as icart, i.price, item_name, quantity, i.ID, img FROM `cart` c inner join `items` i on(c.`item_id`=i.`ID`) where `user_id`=?");
  if ($stmt->execute([$uid])) {
	    
		$arr = [];
		/*{
            name:"Cookie", 
            price:5,
            img: "./images/cookies1.jpg", 
            quantity:1
        }*/
		//echo "<pre>";
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			//print_r($row);
			$arr[$row["ID"]]=[//insert new item to array
			"id"=>$row['icart'],
			"name"=>$row['item_name'],
			"price"=>$row['price'],
			"quantity"=>$row['quantity'],
			"img"=>$row['img']
			];
		  
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
		$result["cart"]=$arr;	
	}
	echo json_encode($result);//convert array to json string
  $conn = NULL;
}