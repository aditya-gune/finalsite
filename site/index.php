<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>iApply, Making job applications easier</title>

<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div class="header">
<img src="header.jpg" text="iApply. Making job applications easier." /> 
</div>
<div class="container">
<div class = "menu">
<ul>
  <li><a href="index.php">Home</a></li>
  <li><a href="me.php">My Profile</a></li>
  <li><a href="apps.php">My Applications</a></li>
  <li><a href="about.php">About Us</a></li>
</ul>
</div>
<p>
<div class = "body1">
Welcome to iApply!
We make your life easier by helping you keep track of your applications.

</p>
<h2> How Does it Work?</h2>
<p>
iApply keeps a database of your job applications, sparing you the hassle of remembering where each of your applications are. You can update statuses, include resumes, and more. 

<div class = "login">
<?php 
if(!isset($_SESSION["username"])){
		echo '<h2>Please log in to get started! </h2>';
		echo '<form action="index.php" method="POST">';
		echo 'Username<br /> <input type="text" id="username" name="username"><br />';
		echo 'Password<br /> <input id="password" type="password" name="password"><br>';
		echo '<input type="submit" value = "Submit">';
		echo '</form>';
		fetchDB();
}
?>
</div>
<div class = "register">
<p>
Don't have an account? Register here!</p>

<p>Username<br /> <input id="newuser" type="text" name="newuser"><br />
  Password<br /> <input id="newpass" type="password" name="newpass"><br>
  <input id="registerbtn" type="submit" value = "Submit">
  </p>
</p>
<p>
  <textarea readonly="readonly" id="regstatus" ></textarea>
</p>
</div>





</div>
</div>
</body>
</html>
