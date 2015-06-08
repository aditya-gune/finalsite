<?php session_start(); 
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "gunea-db", "5c7NIUQDT4UN1mvB", "gunea-db");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Profile - iApply</title>
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
<p>
<div class = "body1">
<h2> About iApply</h2>
<p>
iApply was designed and written by Aditya Gune. All images used (unless otherwise specified) were designed by Aditya Gune.
</p>

<h2> Contact </h2>
<p>
Aditya Gune<br />
Email: gunea@onid.oregonstate.edu
</p>







</div>
</div>
</body>
</html>
