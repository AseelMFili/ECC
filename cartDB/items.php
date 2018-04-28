<?php



$conn = null;
try {
  $host = 'localhost';
  $username = 'aseelmfili';
  $password = '';
  $database = 'ecc_db';
  // PDO class gives ability of choosing type of DB whether MySQL, ORACLE, MS SQL, and much more using correct driver!
  $conn = new PDO("mysql:host={$host};dbname={$database}", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt= $conn->prepare("SELECT * FROM `items`");
  //if ($stmt->execute(["%{$search_word}%"])) {
	if ($stmt->execute()) {    
		$arr = [];
		/*{
            name:"Cookie", 
            price:5,
            img: "./images/cookies1.jpg", 
            quantity:1
        }*/
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$arr[]=[//insert new item to array
			"id"=>$row['ID'],
			"name"=>$row['item_name'],
			"price"=>$row['price'],
			"quantity"=>1,
			"img"=>$row['img'],
			"catID"=>$row['category_id']
			];
		  
		}
    
	}
  } catch (Exception $e) {//edit the exception
	 $err=$e->getMessage();
    
} finally {
	$result=[];
	if(isset($err)){
		$result["error"]=$err;
	}else{
		$result["products"]=$arr;	
	}
	echo json_encode($result);//convert array to json string
  $conn = NULL;
}