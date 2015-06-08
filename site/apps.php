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
<title>My Applications - iApply</title>
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
  <li><a class="listitem" href="apps.php">My Applications</a></li>
  <li><a class="listitem" href="about.php">About Us</a></li>
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
	echo "Welcome, " . $_SESSION["username"] . "!";
	echo '<div class="accountoptions"> <a href="apps.php?logout=1"><button class="btn">Log Out</button></a></div>';
}

if(isset($_GET['logout'])){
		session_unset();
		session_destroy();
		echo "<script> location.reload();</script>";
		echo "<h2>You have been successfully logged out.</h2>";
		exit;
}
?>

<div class = "body1">
  
<div class = "addapp">
<h2> Add a New Application </h2>
Add an application here and it will be stored in our database. You can view all your applications to the right. After adding an application, you can also upload a file, such as a resume, cover letter, or more. 

<form id="newapp">
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
Close Date<br /> <input id="date_closing" type="text" name="date_closing" placeholder="YYYY/MM/DD" onchange="return checkDate(this)"	>
<br></form>
  <input id="addbtn" type="submit" value = "Add Application"> <br />
  <textarea class="stopselect" readonly="readonly" id="addstatus" > </textarea>
</div>
<div class="myapps">
<h2 align="center"> My Applications</h2>
<div class = "tablediv"> 
<?php	
	require_once('preheader.php'); // <-- this include file MUST go first before any HTML/output

	#the code for the class
	include ('ajaxCRUD.class.php'); // <-- this include file MUST go first before any HTML/output
	//ini_set('Display errors', 'On');

    #this one line of code is how you implement the class
    ########################################################
    ##

    $appstable = new ajaxCRUD("Applications", "applications", "id", "username", "position", "company", "status", "date_applied", "date_closing", "fileupload");
	$username = $_SESSION['username'];
    ##
    ########################################################

    ## all that follows is setup configuration for your fields....
    ## full API reference material for all functions can be found here - http://ajaxcrud.com/api/
    ## note: many functions below are commented out (with //). note which ones are and which are not

    #i can define a relationship to another table
    #the 1st field is the fk in the table, the 2nd is the second table, the 3rd is the pk in the second table, the 4th is field i want to retrieve as the dropdown value
    #http://ajaxcrud.com/api/index.php?id=defineRelationship
    //$tblDemo->defineRelationship("fkID", "tblDemoRelationship", "pkID", "fldName", "fldSort DESC"); //use your own table - this table (tblDemoRelationship) not included in the installation script

    #i don't want to visually show the primary key in the table
    $appstable->omitPrimaryKey();

    #the table fields have prefixes; i want to give the heading titles something more meaningful
    $appstable->displayAs("position", "Position");
    $appstable->displayAs("company", "Company");
    $appstable->displayAs("status", "Status");
    $appstable->displayAs("date_applied", "Date Applied");
    $appstable->displayAs("date_closing", "Date Closing");
	$appstable->displayAs("fileupload", "Files");
	#set the textarea height of the longer field (for editing/adding)
    #http://ajaxcrud.com/api/index.php?id=setTextareaHeight
    $appstable->setTextareaHeight('fldLongField', 150);

    #i could omit a field if I wanted
    #http://ajaxcrud.com/api/index.php?id=omitField
    $appstable->omitField("username");

    #i could omit a field from being on the add form if I wanted
    //$appstable->omitAddField("fldField2");

    #i could disallow editing for certain, individual fields
    //$appstable->disallowEdit('fldField2');

    #i could set a field to accept file uploads (the filename is stored) if wanted
    $appstable->setFileUpload("fileupload", "");

    #i can have a field automatically populate with a certain value (eg the current timestamp)
    //$tblDemo->addValueOnInsert("fldField1", "NOW()");

    #i can use a where field to better-filter my table
    $appstable->addWhereClause("WHERE (username = \"$username\")");

    #i can order my table by whatever i want
    //$appstable->addOrderBy("ORDER BY fldField1 ASC");

    #i can set certain fields to only allow certain values
    #http://ajaxcrud.com/api/index.php?id=defineAllowableValues
    $allowableValues = array("In Progress", "Applied", "Interview", "Received Offer", "Accepted Offer", "No Offer");
    $appstable->defineAllowableValues("status", $allowableValues);

    //set field fldCheckbox to be a checkbox
    //$appstable->defineCheckbox("fldCheckbox");

    #i can disallow deleting of rows from the table
    #http://ajaxcrud.com/api/index.php?id=disallowDelete
    //$appstable->disallowDelete();

    #i can disallow adding rows to the table
    #http://ajaxcrud.com/api/index.php?id=disallowAdd
    $appstable->disallowAdd();

    #i can add a button that performs some action deleting of rows for the entire table
    #http://ajaxcrud.com/api/index.php?id=addButtonToRow
    //$appstable->addButtonToRow("Add", "add_item.php", "all");

    #set the number of rows to display (per page)
    $appstable->setLimit(60);

	#set a filter box at the top of the table
    //$appstable->addAjaxFilterBox('fldField1');


    #if really desired, a filter box can be used for all fields
    //$appstable->addAjaxFilterBoxAllFields();

    #i can set the size of the filter box
    //$appstable->setAjaxFilterBoxSize('fldField1', 3);

	#i can format the data in cells however I want with formatFieldWithFunction
	#this is arguably one of the most important (visual) functions
	//$appstable->formatFieldWithFunction('fldField1', 'makeBlue');
	//$appstable->formatFieldWithFunction('fldField2', 'makeBold');

	//$appstable->modifyFieldWithClass("fldField1", "zip required"); 	//for testing masked input functionality
	//$appstable->modifyFieldWithClass("fldField2", "phone");			//for testing masked input functionality

	//$appstable->onAddExecuteCallBackFunction("mycallbackfunction"); //uncomment this to try out an ADD ROW callback function

	$appstable->deleteText = "delete";

?>
		<div style="float: left">
			You have <b><?=$appstable->insertRowsReturned();?> </b> applications.<br />
		</div>

		<div style="clear:both;"></div>

<?php

	#actually show the table
	$appstable->showTable();

	#my self-defined functions used for formatFieldWithFunction
	function makeBold($val){
		if ($val == "") return "no value";
		return "<b>$val</b>";
	}

	function makeBlue($val){
		return "<span style='color: blue;'>$val</span>";
	}

	function myCallBackFunction($array){
		echo "THE ADD ROW CALLBACK FUNCTION WAS implemented";
		print_r($array);
	}
?></div>
</div>
</div>
</div>
</body>
</html>
