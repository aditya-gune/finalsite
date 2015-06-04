<?php
session_start();
ini_set('display_errors', 'On');
//echo "session started";
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "gunea-db", "5c7NIUQDT4UN1mvB", "gunea-db");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

fetchDB();
function fetchDB(){
	global $mysqli;
	$username = isset($_POST['username'])? $_POST['username']: '';
	echo $username . "<br>";
	$password = isset($_POST['password'])? md5($_POST['password']): '';
	echo $password . "<br>";
	$login = false;
	$query = "SELECT username, password FROM users";
	$result = $mysqli->query($query);
	while($row = $result->fetch_assoc()){
	if($row["username"] == $username && $row["password"] == $password){
		$login = true;
		echo "$row[username]: " . $row['username'] . "   $username: " . $username;
		echo "$row[password]: " . $row['password'] . "   $password: " . $_POST['password']; 
	}
}

		


if($login == true){

$_SESSION['username'] = $username;
echo "Welcome, " . $username;
}
else echo "Invalid username or password.";
}
?>