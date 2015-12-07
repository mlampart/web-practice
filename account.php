<?php 
include('loginCheck.php');
if(!$logged_in){
    header('location: login.html');
}
?>
<html>
    <head>
        <link href="index.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="index.js"></script>
        <title>Your Account</title>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <nav id="navlinks">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="logout.php">Logout</a></li>
                        <li><a href="shootStill.php"><span id="snap">TAKE A PICTURE</span></a></li>
                    </ul>
                </nav>
            </div>
            <div id="content">
                <h2>Photos uploaded by 
                    <?php echo $_SESSION['fullname'] ?>
                </h2>
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

//identify who is currently logged in
$uploader = $_SESSION['login_user'];

//display all images
$qry = "SELECT * FROM images WHERE deleted=0 AND uploader='".$uploader."'";
$result = mysqli_query($conn, $qry);

while ($row = mysqli_fetch_assoc($result)){
    $image = $row["path"];
    echo '<div class="img">';
    echo '<a target="_blank" href="'
         .$image.
         '"><img src="'
         .$image.
         '" onload="this.width*=0.5;this.onload=null;"/> ';
    echo '<form method="post">';
    echo '<input type="hidden" value="'
         .$image.
         '" name="delete_file" />';
    echo '<input type="submit" class="delete" value="Delete image" onclick="deletePhoto()"/>';
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
