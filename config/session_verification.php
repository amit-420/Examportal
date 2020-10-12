<?php
include('db_connect.php');

session_start();// Starting Session
// Storing Session
$user_check = $_SESSION['username'];
// SQL Query To Fetch Complete Information Of User
$sql = "SELECT username from user_login_data where username = '$user_check'";
$result = mysqli_query($conn, $sql);
$userdata = mysqli_fetch_array($result);
//
print_r($userdata);
//
$count = mysqli_num_rows($result);
if($result && $count == 1){
    
}else{
    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();
    header("Location: ../portal/login.php");
}

?>