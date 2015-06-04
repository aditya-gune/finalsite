<?php
session_start();
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "gunea-db", "5c7NIUQDT4UN1mvB", "gunea-db");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
ini_set('display_errors', 'On');
$query = "SELECT position, company, status, date_applied, date_closing FROM applications WHERE username LIKE '".$_SESSION["username"]."'";
$result = $mysqli->query($query);

echo "<table border = '1' id='appstable'>";
echo "<tr>";
echo "<th> Position </th>";
echo "<th> Company </th>";
echo "<th> Status </th>";
echo "<th> Date Applied </th>";
echo "<th> Date Closing </th>";
echo "<tbody>";
while($r = $result->fetch_row()){
    echo "<tr class='alt'>";
	echo "<td>" . $r[0] . "</td>";
    echo "<td>" . $r[1] . "</td>";
	echo "<td>" . $r[2] . "</td>";
	echo "<td>" . $r[3] . "</td>";
	echo "<td>" . $r[4] . "</td>";
}

echo "</tbody> </table>";
?>