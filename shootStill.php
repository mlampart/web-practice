<?php

// Create connection
$servername = "localhost";
$username = "pi";
$password = "mlampar2";
$dbname = "SavedPhotos";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Create image filename and execute camera command
$imgname = "image" . date("H_i_s") . ".jpg";
exec("raspistill -o images/".$imgname." -w 500 -h 768");

//Redirect back to home page
function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
    	header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }
    exit();
}
Redirect('index.php', false);
die();

?>
