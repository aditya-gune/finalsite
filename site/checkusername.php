<?php
session_start();
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "gunea-db", "5c7NIUQDT4UN1mvB", "gunea-db");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$username = isset($_POST['newuser'])? $_POST['newuser']: '';
$password = isset($_POST['newpass'])? md5($_POST['newpass']): '';
$stmt = $mysqli->prepare("SELECT * FROM users");
	$stmt->bind_param('ss', $username, $password);
	$stmt->execute();
 	$results = $stmt->get_result();
	while($r = $results->fetch_row()){
		if($r[1] == $username){
			echo "Username already taken.";
			$taken = true;
		}
	}
?>