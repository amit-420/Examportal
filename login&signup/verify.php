<?php 

	include "db.php";

	$get_verify_code = $_GET['code'];


		$query = mysqli_query($db_connect, "SELECT * from user where verification_code = '$get_verify_code' ");

		$checkpoint = mysqli_num_rows($query);


			if ($checkpoint == 1) {
				
				$query_update = mysqli_query($db_connect, "UPDATE user set verify_status = 1 where verification_code = '$get_verify_code' ");

				echo "Congratulations! Your email address has been verified successfully!";

			}else{

				echo "Sorry! Your verification link is invalid.";
			}


 ?>