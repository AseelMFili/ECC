<?php

session_start();

function db_connection(){
    try{
    $servername = "localhost";
    $user = "aseelmfili";
    $dbname = "ecc_db";
    $dbpass = "";
        // Create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $dbpass);
            
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }else{
            return $conn;
        }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}

function check_customers($email,$password){
    
    try{
        
    $conn = db_connection();
    
    $check_stmt=  $conn->prepare("SELECT * FROM customers WHERE email=? AND password=?");
      
      if ($check_stmt->execute([$email,$password]) && ($row=$check_stmt->fetch(PDO::FETCH_ASSOC))!==false) {
         
                            
         $_SESSION["isAdmin"]=($row['admin_flag']==1);
         $_SESSION["email"]=$row['email'];
         $_SESSION["password"]=$row['password'];
         $_SESSION["username"]=$row['username'];
         $_SESSION["phoneNo"]=$row['phoneNo'];
         $_SESSION["city"]=$row['city'];
         $_SESSION["street"]=$row['street'];
         
         return true;
      } else { 
          $_SESSION["isAdmin"]=false;
          return false;
      }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    
}

function insert_customers($email,$password,$username,$phoneNo,$city,$street){
    
    try {
           $conn = db_connection();
     
            
            $stmt = $conn->prepare("INSERT INTO customers(email,password,username,phoneNo,city,street) VALUES (?,?,?,?,?,?)");
            
            if($stmt->execute([$email,md5($password),$username,$phoneNo,$city,$street])){
                    header("Location:https://ecc-test-aseelmfili.c9users.io/Home-Pagee.php");
                } 
        }
        catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

            
}

function update_pass($email,$newPass){
     try{
     $conn = db_connection();
            
    
     $update_stmt =  $conn->prepare("UPDATE customers SET password = ? WHERE email = ?");
     
        if ($update_stmt->execute([$newPass,$email])) {
                    header("Location:https://ecc-test-aseelmfili.c9users.io/Home-Pagee.php");
                } else {
                    echo "Error: " . $update_stmt . "<br>" . $conn->error;
                }
         
     }catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

            $conn->close();
    }    
    
function edit($email,$password){
    
    try{
     $conn = db_connection();
     
        
      $edit_stmt=  $conn->prepare("SELECT * FROM customers WHERE email= ? AND password= ?");
      
      
      $response = $update_stmt->execute([$email,$password]);
      
      if ($response && $response->num_rows > 0) {
           header("Location:https://ecc-test-aseelmfili.c9users.io/cartDB/cart.php");
      } else { 
          echo '<h2>ERROR! Please try again</h2>';
      }     
         
     }catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

     }
     
function getCategories(){
     
     try{
     $conn = db_connection();     
         return  $conn->query("SELECT * FROM category");
         
     }catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

            $conn->close();
    }    
    
     
function addloc($lat,$lng){
    
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
            $stmt = $conn->prepare("INSERT INTO location(lat,lng,user_id) VALUES (?,?,?)");
            
            if($stmt->execute([$lat,$lng,$uid])){
                //responseText for redirect in ajax
                   echo "1";
                    }
                }
            }
    }catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }
}

function editItem($id,$name,$price,$img,$flag){
    
    try {
           $conn = db_connection();
     
            
          if($flag == 1){
            
            
            $stmt = $conn->prepare("UPDATE items set item_name=? , price= ? , img= ? where ID=?");
            
            if($stmt->execute([$name,$price,$img,$id])){
                echo "item updated!";
                                  
                }else{
                    echo "item not updated!!";
                }
          }//if of flag=1 ends here  
          
          else if($flag == 2){
              
              $stmt = $conn->prepare("DELETE from items WHERE ID=?");
            
            if($stmt->execute([$id])){
                echo "item deleted";
                    
                }else{
                    echo "item not deleted!!";
                }
                
          }//if of flag=2 ends here
        
        }catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }
}   

function getLocation(){
         
         try{   
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
            $stmt= $conn->prepare("SELECT * FROM `location` where user_id = ? ORDER BY date DESC LIMIT 1");
       
            if($stmt->execute([$uid])){
                while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			 
                $lat=$row['lat'];
                $lng=$row['lng'];
		    }
		        echo "<script> window.location.href='https://maps.google.com/maps?saddr=Coffee%20Cookies,Az%20Zuhd,Mecca&daddr=$lat,$lng' </script>";
      
            }else { 
                echo "Error! :)";
                }
                }
            }
     }catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

            $conn->close();
    }    
    
    
function makeBill($email){
            
            
            $result=[
                "success"=>false,
                "error"=>"Nothing execute!",
                "debug"=>$email
                ];
            try{
          $conn = db_connection();
     
     $stmt = $conn->prepare("SELECT ID from customers WHERE email=?");
     
     if($stmt->execute([$email]) && ($row=$stmt->fetch(PDO::FETCH_ASSOC)) !== false){
         
        
            
            $stmt = $conn->prepare("INSERT INTO bill (date, user_id, paid_flag, status) VALUES (Now(), ?, 0, 'on delivery') ");
            
            if($stmt->execute([$row['ID']])){
                $id = $conn->lastInsertId();
                
                $stmt = $conn->prepare("INSERT INTO bill_items (bill_id, item_id, price, quantity) (SELECT ?, item_id, price, quantity 
                FROM cart WHERE user_id = ?)");
                
                $fieldsValues =[];
                $fieldsValues[]=$id;
                $fieldsValues[]=$row['ID'];
                
                if($stmt->execute($fieldsValues)){
                
                $stmt = $conn->prepare("DELETE FROM cart WHERE user_id=?");
                
                if($stmt->execute([$row['ID']])){
                    $result["success"]=true;
                    
                }else{
                    $result["error"]="Unable to clear your cart!";
                }
                }else{
                    $result["error"]="Unable to get items from your cart!";
                }
            }else{
                $result["error"]="Unable to create new bill! \n Please contact admin!";
            }
     }else{
         $result["error"]="Please Log in! B";
     }
     
     echo json_encode($result);
     
         
     }catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

            
    }    
    
        

function editUser($id){
            
            try{
                
            
            $conn = db_connection();
            

            $stmt = $conn->prepare("DELETE from customers WHERE ID=?");
            
            if($stmt->execute([$id])){
                //responseText for redirect in ajax
                   echo "1";
                    }else{
                        echo "0";
                    }
                    
         
     }catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }

            $conn->close();
    }//editUser function ends here
        
        
function change_Admin($id){
    
     $conn = db_connection();
            

            $stmt = $conn->prepare("SELECT admin_flag from customers WHERE ID=?");
            
            if($stmt->execute([$id])){
                //responseText for redirect in ajax
                
                $ad_flag =[];
                $ad_flag[0]=$row['admin_flag'];
                
                
                if($ad_flag[0] == 1){
                    $stmt = $conn->prepare("UPDATE customers SET admin_flag= 0 WHERE ID=?");
                    if($stmt->execute([$id])){
                        echo "1";
                    }else{
                        echo "0";
                    }
                    
                }
                else if($ad_flag[0] == 0){
                   $stmt = $conn->prepare("UPDATE customers SET admin_flag= 1 WHERE ID=?");
                   if($stmt->execute([$id])){
                        echo "1";
                    }else{
                        echo "0";
                    }
                }
                else{
                    echo "Update query not executed!!";
                }
                
                   
            }else{
                echo "No ID selected!!";
            }     
}//change_Admin function ends here



function updateCustomer($email,$password,$username,$phoneNo,$city,$street){
    
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
	    $stmt = $conn->prepare("UPDATE customers SET `email`=? ,`password`=? ,`username`=? ,`phoneNo`=? ,`city`=? ,`street`=? where ID = $uid");
            
        if($stmt->execute([$email,$password,$username,$phoneNo,$city,$street])){
                echo "Updated successfully";
                }else{
                echo "Error! Correct information!";
                }
            }
        }
        }catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }
}

?>