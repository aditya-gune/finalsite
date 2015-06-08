<?php
session_start();
//echo "session started";
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "gunea-db", "5c7NIUQDT4UN1mvB", "gunea-db");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

fetchDB();
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
			echo '<script> location.reload();</script>';
		}
	}
}
?>