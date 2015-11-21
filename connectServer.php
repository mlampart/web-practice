<?php

// Create connection
$servername = "localhost";
$username = "root";
$password = "mlampar2";
$dbname = "SavedPhotos";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}

?>
