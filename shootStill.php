<?php

// Create connection
include('connectServer.php');
include('logicCheck.php');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Create image filename and execute camera command
$date = date("H_i_s");
$imgname = "image" . $date . ".jpg";
exec("raspistill -o images/".$imgname." -w 500 -h 768");

//put reference to picture into database
$qry = "INSERT INTO images (path,timestamp,uploader) VALUES ('images/"
        .$imgname.
        "','"
        .$date.
        "','"
        .$_SESSION['login_user'].
        "')";
        
$result = mysqli_query($conn, $qry);

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
