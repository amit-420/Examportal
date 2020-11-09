<?php 


	$db_connect = mysqli_connect('localhost','root','','user_register');

		if (!$db_connect) {
			
			echo "Something Went Wrong!";
		}

 ?>