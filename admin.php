<?php 
include('config/db_connect.php');
include('Questionarray.php');
//include('config/session_verification.php');
#require('functions.php');




$sql = "SELECT * FROM user_login_data";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
print_r($row);



?>

<!Doctype html>
<html>


<section>



</section>



</html>