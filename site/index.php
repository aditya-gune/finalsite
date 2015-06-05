<?php session_start(); 
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "gunea-db", "5c7NIUQDT4UN1mvB", "gunea-db");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>iApply, Making job applications easier</title>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="script.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
<div class="header">
<img src="header.jpg" text="iApply. Making job applications easier." /> 
</div>
<div class="container">
<div class = "menu">
<ul>
  <li><a class="listitem" href="index.php">Home</a></li>
  <li><a class="listitem" href="me.php">My Profile</a></li>
  <li><a class="listitem" href="apps.php">My Applications</a></li>
  <li><a class="listitem" href="about.php">About Us</a></li>
</ul>
</div>
<?php
//ini_set('display_errors', 'On');
if(isset($_SESSION["username"])){
	echo "Welcome, " . $_SESSION["username"] . "!";
	echo '<div class="accountoptions"> <a href="index.php?logout=1"><button class="btn">Log Out</button></a></div>';
}

if(isset($_GET['logout'])){
		session_unset();
		session_destroy();
		echo '<script> location.href = "index.php";</script>';
}
?>
<p>
<div class = "body1">
Welcome to iApply!
We make your life easier by helping you keep track of your applications.

</p>
<h2> How Does it Work?</h2>
<p>
iApply keeps a database of your job applications, sparing you the hassle of remembering where each of your applications are. You can update statuses, include resumes, and more.

 
<?php 
if(!isset($_SESSION["username"])){
		
			
		echo '<div class = "login">';
		echo '<p>Log in to get started! </p>';
		echo '<form action="index.php" method="POST">';
		echo 'Username<br /> <input type="text" id="username" name="username" required><br />';
		echo 'Password<br /> <input id="password" type="password" name="password" required><br>';
		echo '<input id="loginbtn" type="submit" value = "Submit" onclick ="location.reload()">';
		echo '</form>';
		echo '</div>';
		
		echo '<div class = "register">';
		echo "<p>Don't have an account? Register here!</p>";
		echo '<form action="index.php" method="POST">'; 
		echo '<p>Username<br /> <input id="newuser" type="text" name="newuser" onchange="checkUsername(this.value)" required>  <textarea readonly="readonly" id="regstatus" ></textarea><br />';
  		echo 'Password<br /> <input id="newpass" type="password" name="newpass" required><br>';
  		echo '<input id="registerbtn" type="submit" value = "Submit" onclick ="location.reload()">';
		echo '</form>';
  		echo '</p>';
		echo '</p>';
		echo '<p>';
		echo '</p>';
		echo '</div>';
		
	
}
?>




</div>
</div>
</body>
</html>
