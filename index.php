<?php include('loginCheck.php'); ?>
<html>
 <head>
  <link href="index.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="index.js"></script>
  <title>Michael's Pi</title>
 </head>
 <body>
<div id="wrapper">
 <div id="header">
 <h1 id="title">Michael Lampart</h1>
    <nav class="navlinks">
	<a href="index.php">Home</a>
        <?php
        if(!$logged_in){
            echo '<a href="login.html">Login</a>';
        }
        else{
            echo '<a href="logout.php">Logout</a>';
        }
        ?>
        <a href="account.php">Account</a>
        <a href="register.html">Register</a>
	<a href="shootStill.php"><span style="float:right;">TAKE A PICTURE</span></a>
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
mysqli_close($conn);
?>
  </div>
  <footer id="footer">
	<p>Michael Lampart</p>
  </footer>
  </div> 
 </body>
</html>

