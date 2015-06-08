<?php
session_start();
ini_set('Display errors', 'On');
$target_dir = "uploads/";
$uploadfile = $target_dir . basename($_FILES["fileupload"]["name"]);
echo '<pre>';
if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}
$filepath = rtrim($uploadfile, '/');
echo $filepath;
?>