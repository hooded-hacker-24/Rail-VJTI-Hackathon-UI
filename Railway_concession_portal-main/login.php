<?php
$login = false;
//$message = false;
$message = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$conn = mysqli_connect("localhost","root","","studentconcession");
	if(!$conn){  
		echo "<script type='text/javascript'>alert('Database failed');</script>";
		die('Could not connect: '.mysqli_connect_error());  
	}
	$regid=$_POST['regid'];
	$password=$_POST['password'];

	$sql="SELECT * FROM students WHERE p_regid='$regid' AND p_password='$password'"; 
	$result = mysqli_query ($conn, $sql);
	$num = mysqli_num_rows($result);
	if ($num == 1){
		$login = true;
		session_start();
		$_SESSION['loggedin'] = true;
		$_SESSION['regid'] = $regid;
		$message = "Logged in successfully";
		echo "<script type='text/javascript'>alert('$message');</script>";
		header("location: dashboard.html");

	}
	else{
		$message = "Invalid username or password";
		echo "<script type='text/javascript'>alert('$message');</script>";
		
	}
}
	//echo "<script type='text/javascript'>alert('$message');</script>";
?>

<!DOCTYPE html>
<html>
<head>
<title> Login Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/signin.css">
<link rel="stylesheet" href="css/index.css">

</head>
<script type="text/javascript">
	function validate()	{
		var pw=document.getElementById("pw");
		
   		if(pw.value.length< 8)
		{
			alert("Password consists of atleast 8 characters");
			pw.focus();
			return false;
		}
		return true;
	}
</script>
<body>
<header>
    <div class="wrapper">
        <div class="logo">
            <img src="images/VJTI Logo (Enhanced).png" height="100px" alt="" >  
        </div>
<ul class="nav-area">
<li><a href="index.html">Home</a></li>
<li><a href="about.html">About</a></li>
<li><a href="login.php">Sign In</a></li>
<li><a href="https://vjti.ac.in/"; target="_blank">VJTI Site</a></li>
<li><a href="contact.php">Contact</a></li>
</ul>
</div>
</header>
 <div class="loginBox">
  <h2>Log In </h2>
  <form id="login" action="" onsubmit="return validate()" method="post" name="login">
    <input type="text" name="regid" id="regid" placeholder="Enter Registration ID" required>
    <input type="password" name="password" id="password" placeholder="Enter Password">
    <input type="submit" style="color:black;" name="sign_in" id="sign_in" value="Sign In" >
    <a href="register.php">Don't have an account? Sign Up</a>
  </form>
</div>
<footer style="background-color: black; height: 50px; padding-top: 20px;">
    <p style="color: aliceblue; text-align: center;">Copyright &copy; 2022 VJTI Student Railway Concession, All Rights Reserved.</p>
</footer>
<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>
</html> 