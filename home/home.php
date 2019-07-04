<?php
	//creating session
	session_start();

	//connecting to the database
	$conn =  new mysqli('localhost','root','','chatbox') or die ("Database not connected");

	//selecting and storing query result
	$sql = "SELECT username, image FROM user";
	$result = mysqli_query($conn, $sql);
	$arr = $result->fetch_assoc();

	//check if someone directly opens home then match if they are logged in or not 
	if(!isset($_SESSION['username'])){
		$_SESSION['message']="Please login";
		header("location: ../login/login.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<script src="http://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<div class="side-bar">
			<div class="side-topbar">
				<div class="img-container">	
					<?php echo "<img src='$arr[image]'>"; ?>
						<h4><?php echo $_SESSION['username']; ?></h4>
						<div class="btn">
							<button name="logout" id="logout-btn"><a href="../logout/logout.php">LogOut</a></button>
					</div>
				</div>
			</div>

			<div class="side-chatbar">
				<?php
					//looping through the database and extracting image and username using associative arrays
					while($row = $result->fetch_assoc()){
						echo "<div class='side-chatbar-section'>";
						echo "<div class='side-chatbar-img-container'> ";
						echo "<img src='$row[image]'> ";
						echo  "<h4>$row[username]</h4> </div></div>";
					}
				?>
			</div>
		</div>

		<div class="chat-window">
			<div class="chat-window-topbar"> 
				<h3>Chat-Box</h3>
			</div>
			<div  style="width: 70%; height: 60%;	 overflow-y: auto;">
				<div id="chatlogs">	LOADING CHATLOG...</div>
			</div>
			<form name="form1" style="overflow-y: auto;"> <br />Your Message: <br />
				<textarea id="msg_area" name="msg" ></textarea>
				<a href="#" onclick="submitChat()">Send</a><br /><br />
			</form>
		</div>
	</div>

</body>


<script>
	//javascript code to load chat using ajax 
	function submitChat() {
		var msg = form1.msg.value;
		var xmlhttp = new XMLHttpRequest();
		
		xmlhttp.onreadystatechange = function() {
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById('chatlogs').innerHTML = xmlhttp.responseText;
			}
		}
		
		xmlhttp.open('GET','insert.php?&msg='+msg,true);
		xmlhttp.send();
		form1.msg.value = '';
	}

	$(document).ready(function(e){
		$( "#msg_area" ).keyup(function(e) {
			var code = e.keyCode || e.which;
			if(code == 13) {
			submitChat();
			}
		});
		setInterval( function(){ $('#chatlogs').load('logs.php'); }, 2000 );
	});

</script>
</html>