<?php
    include("connectServer.php");
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //check database to see if username is present
        $user = mysqli_real_escape_string($conn,$_POST['username']);
	$qry = "SELECT id FROM users WHERE username ='"
	        .$user.
                "'";
	$result = mysqli_query($conn,$qry);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $active = $row['active'];
        $count = mysqli_num_rows($result);
        if($count == 1){
            $_SESSION['login_user'] = $user;
            header("location: index.php");
        }
        else{
            $error = "username invalid";
            header("location: login.html");
            
        }
    }
?>
