<?php
session_start();
//variable to report whether someone is logged in or not
$user = $_SESSION['login_user'];
/*
$qry = "SELECT FROM users WHERE username = '"
        .$user.
        "'";
$ses_sql = mysqli_query($conn,$qry);
$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
$login_session = $row['username'];
if(!isset($login_session)){
    header("location: login.html");
}
*/
if(isset($user)){
    echo "USER IS LOGGED IN";
    $logged_in = true;
}
else{
    echo "USER IS NOT LOGGED IN"; 
    $logged_in = false;
}
mysqli_close()
?>

