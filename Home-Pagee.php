<script>
window.onload = function() {
<?php
if (isset($_GET["error"])) {
?>
alert('<?=str_replace("'","\\'",$_GET["error"])?>');
<?php
}
?>
}
</script>


<html>
<head>
    <meta charset="utf-8">
    <title>Cookie & Coffee </title>
    <link rel="stylesheet" href="Home-Page.css">
</head>

<body>
    <form action="Home-Page.php" method="POST">
    <div id="MainDiv">
        <img src="./images/Logo.png" alt="Cookie & Coffee" id="logo">

    
        <p>
            <img src="./images/horizintal.png" id="Hline">
        </p>
        
        <div>
            <label for="email">Email Address</label>
        </div>
        <div class="paddbot">
            <input type="email" id="email" name="email" value="" required>
        </div>
        <div>
            <label for="password">Your Password</label>
        </div>
        <div class="paddbot">
            <input type="password" id="password" name="password" value="" required>
        </div>

        <div class="paddbot">
            <a href="https://ecc-test-aseelmfili.c9users.io/ForgetPassHtml.php">Forgot password?</a>
        </div>

        <div class="paddbot">
            <button class="btn" type="submit">Sign In</button>
        </div>
    </form>
        <div class="paddbot">
            <span>if you don't have an account please sign up here</span>
        </div>
        <div class="paddbot">
            <button class="btn" type="submit" ><a href="https://ecc-test-aseelmfili.c9users.io/Sign-Up PageHtml.php" style="text-decoration:none;color:black;">Sign up</a></button>
        </div>
    </div>
    

    <script src="Home-Page.js"></script>
</body>

</html>