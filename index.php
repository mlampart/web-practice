<html>
 <head>
  <link href="index.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="index.js"></script>
  <title>Michael's Pi</title>
 </head>
 <body>

 <h1> Welcome to Michael's Raspberry Pi!</h1>
 <nav>
	<a href="index.php">Home</a>
	<a href="shootStill.php">TAKE A PICTURE</a>
 </nav>
 </body>
</html>


<?php

//Set permissions for camera to write to directories
exec("sudo chmod 777 /dev/vchiq");
exec("sudo chmod 777 /var/www");

// Delete procedure
if (array_key_exists('delete_file', $_POST)) {
  $filename = $_POST['delete_file'];
  if (file_exists($filename)) {
      unlink($filename);
  } 
}

$directory = "images/";
 
$images = glob("" . $directory . "*.jpg");
 
foreach ($images as $image) {
	echo '<div class="img">';
	echo '<a target="_blank" href="' .$image. '"><img src="' .$image. '" onload="this.width*=0.5;this.onload=null;" /> ';
	echo '<form method="post">';
	echo '<input type="hidden" value="'.$image.'" name="delete_file" />';
	echo '<input type="submit" value="Delete image" onclick="deletePhoto()"/>';
	echo '</form></a>';
	echo '</div>';
} 

?>
