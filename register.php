<?php
if($_POST["username"] == $_POST["confirm_username"]){
    //connect to database
    include('connectServer.php');
    //INSERT user into database
    $qry = "INSERT into users (username,fullname)VALUES ('"
        .$_POST["username"].
        "','"
        .$_POST["fullname"].
        "')";
    $result = mysqli_query($conn, $qry);
    mysqli_close($conn);
    header('Location: index.php');
}
else{
    header('Location: register.html');
}
?>
