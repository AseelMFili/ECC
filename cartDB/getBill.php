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
	$sql = $conn->prepare("SELECT ID FROM `bill` WHERE `user_id`= ? order by `date` desc limit 1");
	if($sql->execute([$uid]) && ($row = $sql->fetch(PDO::FETCH_ASSOC)) !== false){
  $stmt= $conn->prepare("SELECT b.bill_id as ibill, i.price, item_name, quantity, i.ID, img, bi.user_id, bi.date "
  ."FROM `bill` bi inner join `items` i inner join `bill_items` b on(b.`item_id`=i.`ID` AND b.`bill_id` = bi.`ID`) where bi.user_id=? AND bill_id = ?");
  
  if ($stmt->execute([$uid,$row['ID']])) {
	    
	    
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
			$arr[$row["ID"]]=[//insert new item to bill
			"id"=>$row['ibill'],
			"name"=>$row['item_name'],
			"price"=>$row['price'],
			"quantity"=>$row['quantity'],
			"img"=>$row['img'],
			"date"=>$row['date']
			];
		  
		}
    
	}else{
		throw new Exception("unable to excute the select");
		
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
		$result["bill"]=$arr;	
	}
	echo json_encode($result);//convert array to json string
  $conn = NULL;
}