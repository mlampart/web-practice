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
        <nav id="navlinks">
            <ul>
                <li><a href="index.php">Home</a></li>
            <?php
            if(!$logged_in){
                echo "<li><a href=\"login.html\">Login</a></li>\n"; 
                echo '<li><a href="register.html">Register</a></li>';
            }
            else{
                echo '<li><a href="logout.php">Logout</a></li>';
	        echo '<li><a href="shootStill.php"><span id="snap">TAKE A PICTURE</span></a></li>';
            }
            ?>
                <li><a href="account.php">Account</a></li>
            <ul>
        </nav>
      </div>
    <div id="content">
<?php 
if(!$logged_in){
    echo'<p>Welcome, if you want to take a picture, please login!</p><br><br>';
}
echo'<h2>All uploaded photos</h2>';
?>
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

//display all images
$qry = "SELECT * FROM images WHERE deleted=0";
$result = mysqli_query($conn, $qry);

while ($row = mysqli_fetch_assoc($result)){
	$image = $row["path"];
	echo '<div class="img">';
	echo '<a target="_blank" href="'.$image. 
             '"><img src="'.$image.
             '" onload="this.width*=0.5;this.onload=null;"/> ';
        if($logged_in){
	    echo '<form method="post">';
    	    echo '<input type="hidden" value="'.$image.'" name="delete_file" />';
            echo '<input type="submit" class="delete" value="Delete" onclick="deletePhoto()"/>';
	    echo '</form></a>';
        }
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

