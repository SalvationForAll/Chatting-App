<?php

//creating session for php session variables
session_create();

//session variable to store error messages 
$_SESSION['message']='';

//connecting to the database
$conn =  new mysqli('localhost','root','','chatbox') or die ("Database not connected");

?>


<!DOCTYPE html>
<html>
<head>
    <title>Forget</title>
    <link rel="stylesheet" type="text/css" href="css/forget.css">
    <link rel="stylesheet" type="text/css" href="stylelogin.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

    <div class="wrapper fadeInDown">
      <h2>Forgot Password</h2>
        <div id="formContent">
          <div class="fadeIn first"></div>
            <form action="forget.php" method="post">
              <input type="text" id="username" class="fadeIn second" name="username" placeholder="Username">
              <input type="password" id="npassword" class="fadeIn third" name="newpass" placeholder="New Password">
              <input type="submit" class="fadeIn fourth" value="Submit">
            </form>
        </div>
    </div>

</body>
</html>


