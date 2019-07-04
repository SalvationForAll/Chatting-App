<?php

session_start();
$_SESSION['message']='';

//connect to database
$conn =  new mysqli('localhost','root','','chatbox') or die ("Database not connected");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if($_POST['password_1'] == $_POST['password_2']){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password_1']);
    $avatar = mysqli_real_escape_string($conn, 'img/'.$_FILES['pic']['name']);

    if(preg_match("!image!", $_FILES['pic']['type'])){
      if(copy($_FILES['pic']['tmp_name'], $avatar)){
        $_SESSION['username'] = $username;
        $_SESSION['pic'] = $avatar;

        $sql = "INSERT INTO user (username, email, password, image) VALUES ('$username','$email','$password','$avatar')";

        if(mysqli_query($conn, $sql)===TRUE){
          $_SESSION['message'] = 'Registered Successfully';
          header("location: ../home/home.php");
        }
        else{
          $_SESSION['message'] = 'User couldnot be added';
        }
      }
      else{
        $_SESSION['message'] = 'Image could not be uploaded';
      }
    }
    else{
      $_SESSION['message'] = 'Please upload correct image type';
    }
  }
  else{
    $_SESSION['message'] = 'Passwords donot match';
  }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>SignUp</title>
    <link rel="stylesheet" type="text/css" href="css/signup.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

    <div class="wrapper fadeInDown">
      <h2>Registration</h2>
        <div id="formContent">
          <div class="fadeIn first"></div>
            <form class="form" action="signup.php" method="post" enctype="multipart/form-data">
              <div class="session"><?php echo $_SESSION['message'] ?></div>
              <input type="text" id="Username" class="fadeIn second" name="username" placeholder="Username" required>
              <input type="text" id="Email" class="fadeIn second" name="email" placeholder="Email" required>
              <input type="password" id="Password" class="fadeIn third" name="password_1" placeholder="Password" required>
              <input type="password" id="Cpassword" class="fadeIn third" name="password_2" placeholder="Confirm Password" required>
              <input type="file" id="picture" class="fadeIn third" name="pic" accept="img/*">
              <input type="submit" class="fadeIn fourth" value="Sign Up">
              <p>Already a User> <a href="../login/login.php" target="_blank"> Login here</a></p>
            </form>
        </div>
    </div>
</body>
</html>


