<?php
session_start();
$server = "localhost";
$username = "root";
$password = "";
$database = "studentconcession";
try {
  $conn = mysqli_connect($server,$username,$password,$database);
  //echo '<script>alert("Connection successful")</script>';
}
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}

if(!$conn){  
	echo "<script type='text/javascript'>alert('Database failed');</script>";
  	die('Could not connect: '.mysqli_connect_error());  
}
/*if($_SERVER["REQUEST_METHOD"]=="POST"){
  $fname=$_POST['fname'];
  $lname=$_POST['lname'];
  $regid=$_POST['regid'];
  $email=$_POST['email'];
  $pw=$_POST['pw'];
  $cpw=$_POST['cpw'];
  $gender=$_POST['gender'];
  $exists = false;

  if($pw == $cpw && $exists == false){
    $sql = "INSERT INTO `students`(`p_fname`, `p_lname`, `p_regid`, `p_email`, `p_password`, `p_gender`) VALUES ('$fname','$lname','$regid','$email','$pw','$gender')";
    $result = mysqli_query($conn, $sql);
    if($result){  
      $message = "You have been successfully registered";
    }
    else
    {  
      $message = "Could not insert record"; 
    }
    echo "<script type='text/javascript'>alert('$message');</script>";
  }
  else{
    $showError = "Passwords do not match";
  }
}*/
//echo '<script>alert("Before main if")</script>';
if (isset($_POST['submit']))
{
  //echo '<script>alert("Inside main if")</script>';
$fname=$_POST['fname'];
//echo '<script>alert("First Name: " $fname)</script>';
$lname=$_POST['lname'];
$regid=$_POST['regid'];
$email=$_POST['email'];
$pw=$_POST['pw'];
$cpw=$_POST['cpw'];
$gender=$_POST['gender'];

if($pw == $cpw ){
  //echo '<script>alert("Inserting")</script>';
  $sql = "INSERT INTO students (p_fname, p_lname, p_regid, p_email, p_password, p_gender) VALUES ('$fname', '$lname', '$regid', '$email', '$pw', '$gender');";
	if(mysqli_query($conn, $sql))
{  
	$message = "You have been successfully registered";
}
else
{  
	$message = "Could not insert record"; 
}
	echo "<script type='text/javascript'>alert('$message');</script>";
}
  echo "<script> location.href='login.php'; </script>";
  exit;

}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/validate.js"></script>
   </head>
<body>
  <div class="container">
    <div class="title">Registration</div>
    <div class="content">
      <form name="register" method="post" action="" onsubmit="return validate()">
        <div class="user-details">
          <div class="input-box">
            <span class="details">First Name</span>
            <input type="text" name="fname" id="fname" placeholder="Enter your first name" required>
          </div>
          <div class="input-box">
            <span class="details">Last Name</span>
            <input type="text" placeholder="Enter your last name" id="lname" name="lname" required>
          </div>
          <div class="input-box">
            <span class="details">Registration ID</span>
            <input type="text" name="regid" id="regid" placeholder="Enter your Registration Id" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" name="email" id="email" placeholder="Enter your email" required>
          </div>
          
        
          <div class="input-box">
            <span class="details">New Password</span>
            <input type="password" name="pw" id="pw" placeholder="Enter your password" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" name="cpw" id="cpw" placeholder="Confirm your password" required>
          </div>
        
        <div class="gender-details">
          <input type="radio" name="gender" id="dot-1" value="male">
          <input type="radio" name="gender" id="dot-2" value="female">
          <input type="radio" name="gender" id="dot-3" value="other">
          <span class="gender-title">Gender</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="gender">Other</span>
            </label>
          </div>
          </div>
          </div>
        <div class="button">
          <input type="Submit" id="submit" name="submit" value="Submit" style="color: black;">
        </div>
      </form> 
      <a href="login.php">Already have an account? Sign In</a>
    </div>
  </div>

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
