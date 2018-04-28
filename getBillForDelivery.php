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
			 
  $stmt= $conn->prepare("select c.username, c.phoneNo, c.lat, c.lng, b.ID, b.paid_flag,b.total, bi.price, bi.quantity from customers c INNER JOIN bill b INNER JOIN bill_items bi on c.ID = b.user_id AND bi.bill_id = b.ID");
  
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
			$arr[$row["ID"]]=[//insert new item to billDelivery
			"name"=>$row['username'],
			"phoneNo"=>$row['phoneNo'],
			"lat"=>$row['lat'],
			"lng"=>$row['lng'],
			"bill_ID"=>$row['ID'],
			"paid_flag"=>$row['paid_flag'],
			"price"=>$row['price'],
			"quantity"=>$row['quantity'],
			"total"=>$row['total']
			
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
		$result["bill"]=$arr;	
	}
	echo json_encode($result);//convert array to json string
  $conn = NULL;
}