<html>
 <head>
  <link href="index.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="index.js"></script>
  <title>Michael's Pi</title>
 </head>
 <body>
<div id="wrapper">
 <div id="header">
 <h1>The Love Zone</h1>
   <nav class="navlinks">
	<a href="index.php">Home</a>
	<a href="shootStill.php">TAKE A PICTURE</a>
	<a href="about.php">About</a>
   </nav>
  </div>
  <div id="content">


<?php
//Connect to the server
include('connectServer.php');

//Set permissions for camera to write to directories
exec("sudo chmod 777 /dev/vchiq");
exec("sudo chmod 777 /var/www");

// Delete procedure
if (array_key_exists('delete_file', $_POST)) {
  $filename = $_POST['delete_file'];
  if (file_exists($filename)) {
    $qry = "UPDATE images SET deleted=1 WHERE path='".$filename."'";
    $result = mysqli_query($conn, $qry);
  } 
}

//$directory = "images/";
 
//$images = glob("" . $directory . "*.jpg");
$qry = "SELECT * FROM images WHERE deleted=0";
$result = mysqli_query($conn, $qry);

while ($row = mysqli_fetch_assoc($result)){
	$image = $row["path"];
	echo '<div class="img">';
	echo '<a target="_blank" href="' .$image. '"><img src="' .$image. '" onload="this.width*=0.5;this.onload=null;" /> ';
	echo '<form method="post">';
	echo '<input type="hidden" value="'.$image.'" name="delete_file" />';
	echo '<input type="submit" value="Delete image" onclick="deletePhoto()"/>';
	echo '</form></a>';
	echo '</div>';
} 

?>




  </div>
  <footer id="footer">
	<p>Michael Lampart</p>
  </footer>
  </div> 
 </body>
</html>

