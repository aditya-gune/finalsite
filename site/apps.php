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
<title>iApply, Making job applications easier</title>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="script.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div class="header">
<img src="header.jpg" text="iApply. Making job applications easier." />
register
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
<?php 
if(!isset($_SESSION["username"])){
		echo '<h2>Please log in to view your applications: </h2>';
		echo '<form action="apps.php" method="POST">';
		echo 'Username<br /> <input type="text" id="username" name="username"><br />';
		echo 'Password<br /> <input id="password" type="password" name="password"><br>';
		echo '<input type="submit" value = "Submit">';
		echo '</form>';
		fetchDB();
		exit;
}



function fetchDB(){
	global $mysqli;
	$username = isset($_POST['username'])? $_POST['username']: '';
	$password = isset($_POST['password'])? md5($_POST['password']): '';
	$stmt = $mysqli->prepare("SELECT * FROM users");
	$stmt->bind_param('ss', $username, $password);
	$stmt->execute();
 	$results = $stmt->get_result();
	while($r = $results->fetch_row()){
		if($r[1] == $username && $r[2] == $password){
			$_SESSION["username"] = $username;
			echo "<script> location.reload();</script>";
		}
	}
}
if(isset($_SESSION["username"])){
	echo "Welcome, " . $_SESSION["username"] . "!<br>";
}
?>
		<div class = "body1">
  
<div class = "addapp">
<h2> Add a New Application </h2>
Add an application here and it will be stored in our database. You can view all your applications below.


<input hidden id="username" readonly="readonly" value="<?php echo $_SESSION["username"] ?>" /><br />
Position<br /> <input id="position" type="text" name="position"><br />
Company<br /> <input id="company" type="text" name="company"><br>
Status<br /> <select id="status" name="status">
<option id="wip">In Progress</option>
<option id="applied">Applied</option>
<option id="interview">Interview</option>
<option id="received">Received Offer</option>
<option id="accepted">Accepted Offer</option>
<option id="none">No Offer</option>
</select><br>
Date Applied<br /> <input id="date_applied" type="text" name="date_applied" placeholder="YYYY/MM/DD" onchange="return checkDate(this)"><br />
Close Date<br /> <input id="date_closing" type="text" name="date_closing" placeholder="YYYY/MM/DD" onchange="return checkDate(this)"><br>
File Upload<br /> <input id="fileupload" type="text" name="fileupload">
<br>
  <input id="addbtn" type="submit" value = "Add Application"> <br />
  <textarea readonly="readonly" id="addstatus" > </textarea>
 </div>
<div class="myapps">
<h2 align="center"> My Applications</h2>
<div class = "tablediv"> </div>
</div>
</div>
</div>
</body>
</html>
