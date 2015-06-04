<?php
//ini_set('display_errors', 'On');
global $mysqli;
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "gunea-db", "5c7NIUQDT4UN1mvB", "gunea-db");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
addtoDB();
function addtoDB(){
	global $mysqli;
$username = isset($_POST['newuser'])? $_POST['newuser']: '';
$password = isset($_POST['newpass'])? md5($_POST['newpass']): '';

$query = "SELECT username FROM users";
$result = $mysqli->query($query);
while($row = $result->fetch_assoc()){
	if($row["username"] == $username && !is_null($username))
		echo "Username already taken.";
}

if (!($stmt = $mysqli->prepare("INSERT INTO users (username, password) VALUES ('".$username ."', '".$password."')"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

$stmt->bind_param('ss', $username, $password);

$stmt->execute();
	//if (is_null($_POST['newuser'])) echo "Username cannot be blank!<br>";
	//if (is_null($_POST['newpass'])) echo "Please enter a password.<br>";
    //if($stmt->errno == "1062")		echo "Username already exists. <br>";
	
}

?>