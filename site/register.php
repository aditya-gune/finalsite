<?php
session_start();

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "gunea-db", "5c7NIUQDT4UN1mvB", "gunea-db");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

addtoDB();
function addtoDB(){
	global $mysqli;
	$username = isset($_POST['newuser'])? $_POST['newuser']: '';
	$password = isset($_POST['newpass'])? md5($_POST['newpass']): '';
if (!($stmt = $mysqli->prepare("INSERT INTO users (username, password) VALUES ('".$username ."', '".$password."')"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

$stmt->bind_param('ss', $username, $password);

$stmt->execute();
$_SESSION["username"] = $username;
	
}
?>