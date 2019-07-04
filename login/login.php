<?php

session_start();
$_SESSION['message']='';

$conn =  new mysqli('localhost','root','','chatbox') or die ("Database not connected");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = md5($_POST['password']);
  

  $result = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$password'") 
             or die("Unable to load data from database");

  $row = mysqli_fetch_array($result);

  if(($row['username'] == $username) && ($row['password'] == $password)){
    $_SESSION['username']=$username;
    header("location: ../home/home.php");
  }
  else{
    $_SESSION['message'] = 'Login Failed. Please try again!';
  }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <div class="wrapper fadeInDown">
      <h2>Sign In</h2>
        <div id="formContent">
          <div class="fadeIn first"></div>
            <form action="login.php" method="post">
              <div class="session"><?php echo $_SESSION['message'] ?></div>
              <input type="text" id="username" class="fadeIn second" name="username" placeholder="Username" required>
              <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password" required>
              <input type="submit" name="Submit" class="fadeIn fourth" value="Log In" >
            </form>
            <div id="formFooter">
              <a class="underlineHover" href="../forget/forget.php" target="_blank">Forgot Password?</a></br>
              <a class="underlineHover" href="../signup/signup.php" target="_blank">Dont have an account?</a>
            </div>
        </div>
    </div>
</body>
</html>


