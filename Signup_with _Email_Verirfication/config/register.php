<?php 
    
    include("db.php");

	if (isset($_POST['signupButton'])) {
		
		$mem_name = $_POST['mem_name'];
		$mem_email = $_POST['mem_email'];
		$mem_number = $_POST['mem_number'];
		$mem_pass = sha1($_POST['mem_pass']);
		$mem_clgname = $_POST['mem_clgname'];
		
		

		


		$query_select = mysqli_query($db_connect, "SELECT * from users where mem_email = '$mem_email' ");

		$checkpoint = mysqli_num_rows($query_select);
		


		
		if ($checkpoint == 0) {
			
			
				$query = mysqli_query($db_connect, "INSERT  into users set 

					mem_name = '$mem_name',
					mem_email = '$mem_email',
					mem_pass = '$mem_pass',
					mem_number = '$mem_number',
					mem_clgname = '$mem_clgname'
				

					");

		
		
				
				
				$success = "Account created! Please check your inbox to verify your email address.";
				include("confirmmail.php");
				$sub="Confirmemail";
				$event="Welcome ur email is confirmed";
				
				htmlMail($mem_email,$sub,$mem_name,"",$event);
				
			
			

		}
	}	

	

 ?>
