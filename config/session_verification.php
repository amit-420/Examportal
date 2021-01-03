<?php
include('db_connect.php');

session_start();// Starting Session
// Storing Session
$user_check = $_SESSION['mem_email'];
// SQL Query To Fetch Complete Information Of User
$sql = "SELECT mem_email from user_login_data where mem_email = '$user_check'";
$result = mysqli_query($conn, $sql);
$userdata = mysqli_fetch_array($result);
//

// Commenting the next line out so that it doesn't display on the main page
// print_r($userdata);
//


$count = mysqli_num_rows($result);
if($result && $count == 1){

}else{
    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();
    header("Location: login&signup/login.php");
}

?>
