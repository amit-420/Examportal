<?php 


$db_connect = mysqli_connect('localhost','amit','amit2424','portal_data');

$tablename = 'user_login_data';
		if (!$db_connect) {
			echo 'Connection error' . mysqli_connect_error();
			
			echo "Something Went Wrong!";
		}

 ?>