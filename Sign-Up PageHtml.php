<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="Sign-Up Page.css">
</head>

<body>
    <div id="MainDiv">
        
        
    <form action="Sign-Up Page.php" method="POST">
        <img src="./images/Logo.png" alt="Cookie & Coffee" id="logo">
        <p><img src="./images/horizintal.png" id="Hline"></p>
      
        <div><label>Enter Your Email Address</label></div>
        <div class="paddbot"><input type="email" id="email" class="email" name="email" value="" required></div>
        
        <div><label>Re-Enter Your Email Address</label></div>
        <div class="paddbot"><input type="email" id="re-email" class="email" name="re-email" value="" required>
        <div id="confirmEmail" class="confirmEmail" ></div></div>

        <div><label>Enter Your Password</label></div>
        <div class="paddbot"><input type="password" id="password" class="password" name="password" value="" minlength="8" required></div>
        
        <div><label>Re-Enter Your Password</label></div>
        <div class="paddbot"><input type="password" id="re-password" class="password" name="re-password" value="" minlength="8" required>
            <div id="confirmMessage" class="confirmMessage" ></div></div>
        
        <div><label>Choose Your Username</label></div>
        <div class="paddbot"><input type="text" id="username" name="username" value="" required></div>

        <div><label>Enter Your Phone Number</label></div>
        <div class="paddbot"><input type="tel" id="PhoneNo" name="phoneNo" value=""></div>

        <div><label>City</label></div>
        <div class="paddbot"><input type="text" id="city" name="city" value=""></div>

        <div><label>Street</label></div>
        <div class="paddbot"><input type="text" id="street" name="street" value=""></div>

        <button type="submit">Submit</button>
    </form>

    </div>
    
    <script src="Sign-Up Page.js"></script>
</body>

</html>
  <!-- start php code -->
       
         <?php /*
         if(isset($_POST['email']) && !empty($_POST['email']) AND isset($_POST['password']) && !empty($_POST['password'])){
            $email = mysql_escape_string($_POST['email']); // Turn our post into a local variable
            $password = mysql_escape_string($_POST['password']); // Turn our post into a local variable
            $hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.
            // Example output: f4552671f8909587cf485ea990207f3b

            $to  = $email; // Send email to our user
            $subject = 'Verification'; // Give the email a subject 
            $message = '
 
            Thanks for signing up!
            Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
           ------------------------
           Email: '.$email.'
           Password: '.$password.'
           ------------------------
 
           Please click this link to activate your account:
           http://www.yourwebsite.com/verify.php?email='.$email.'&hash='.$hash.'
 
           '; // Our message above including the link
                     
           $headers = 'From:noreply@cookiecoffee.com' . "\r\n"; // Set from headers
           mail($to, $subject, $message, $headers); // Send our email
            
            }
          ?>
          
          
          <?php 
            if(isset($msg)){  // Check if $msg is not empty
            echo '<div class="statusmsg">'.$msg.'</div>'; // Display our message and wrap it with a div with the class "statusmsg".
            } 
       */ ?>
        <!-- stop php code -->
        