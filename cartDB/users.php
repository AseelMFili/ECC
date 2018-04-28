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

  $stmt= $conn->prepare("SELECT ID, username, admin_flag FROM `customers`");
  //if ($stmt->execute(["%{$search_word}%"])) {
	if ($stmt->execute()) {    
		$arr = [];
		
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$arr[]=[//insert new user to array
			"id"=>$row['ID'],
			"name"=>$row['username'],
			"Ad_flag"=>$row['admin_flag']
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
		$result["users"]=$arr;	
	}
	echo json_encode($result);//convert array to json string
  $conn = NULL;
}