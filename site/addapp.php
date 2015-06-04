 <?php
session_start();
//ini_set('display_errors', 'On');
global $mysqli;
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "gunea-db", "5c7NIUQDT4UN1mvB", "gunea-db");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
addtoDB();
function addtoDB(){
	global $mysqli;

$username = isset($_POST['username'])? $_POST['username']: '';
//echo "Username: " . $username;
$position = isset($_POST['position'])? $_POST['position']: '';

$company = isset($_POST['company'])? $_POST['company']: '';

$status = isset($_POST['status'])? $_POST['status']: '';

$date_applied = isset($_POST['date_applied'])? date($_POST['date_applied']): '';

$date_closing = isset($_POST['date_closing'])? date($_POST['date_closing']): '';

if((empty($_POST['position'])) || (empty($_POST['company']))){
	echo "Invalid input.";
	exit;
}

//$fileupload = isset($_POST['company'])? $_POST['company']: '';

if (!($stmt = $mysqli->prepare("INSERT INTO applications (username, position, company, status, date_applied, date_closing) VALUES ('".$username ."', '".$position ."', '".$company."', '".$status."', '".$date_applied."', '".$date_closing."')"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if(!($stmt->bind_param('ssssss', $username, $position, $company, $status, $date_applied, $date_closing)))
	//echo "Name Binding Failed: (" . $stmt->errno . ") " . $stmt->error;

if (!$stmt->execute())
   echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
//else
//echo "<div class='body1'> Application added successfully!</div><br>";
	
}



?>