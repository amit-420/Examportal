<?php 

	include "db.php";

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Signup</title>
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<div class="container">
	
	<div class="jumbotron">
		<h1>Create your account</h1>
	</div>

	<div class="row">

		<div class="col-md-4"></div>
		<div class="col-md-4">
			
			<h2>Enter your details:</h2>

<?php 

	if (isset($_POST['signupButton'])) {
		
		$mem_name = $_POST['mem_name'];
		$mem_email = $_POST['mem_email'];
		$mem_number = $_POST['mem_number'];
		$mem_pass = sha1($_POST['mem_pass']);
		$mem_clgname = $_POST['mem_clgname'];
		

		$random_verification_code = rand(1000,9999) . rand(8888,99999);


		$query_select = mysqli_query($db_connect, "SELECT * from user where email = '$mem_email' ");

		$checkpoint = mysqli_num_rows($query_select);

		if ($checkpoint == 0) {
			
			$query = mysqli_query($db_connect, "INSERT  into user set 

				mem_name = '$mem_name',
				mem_email = '$mem_email',
				mem_pass = '$mem_pass',
				mem_number = '$mem_number',
				mem_clgname = '$mem_clgname'
				verification_code = '$random_verification_code'

				");


				$email_to = $mem_email ;
				$email_subject = "Verify your account";

				$message_body = "Hello .$mem_name , Welcome to E-cell,VNIT! We are very excited to see you rolling in. Please verify your account by clicking on the link below: \n \n";

				$message_body .= "<a href='http://ecellvnit.org/verify.php?code=".$random_verification_code ."'>http://ahtashamkhan.work/verify.php?code=".$random_verification_code  . "</a>";


				$send_email = mail($email_to, $email_subject, $message_body);


			$success = "Account created! Please check your inbox to verify your email address.";


		}else{

			$error = "This email address is already exists.";
		}

	}

 ?>
<?php 

	if (isset($error)) {
		
		echo "<div class='alert alert-danger'>" . $error . "</div>";
	}

	if (isset($success)) {
		
		echo "<div class='alert alert-success'>" . $success . "</div>";
	}


 ?>
			<form action="" method="POST">
				
				<div class="form-group">
					<label>Full Name</label>
					<input type="text" name="mem_name" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" name="mem_email" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Mobile Number</label>
					<input type="numbers" name="mem_number" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="mem_pass" class="form-control" required>
				</div>
				<div class="form-group">
					<label>College Name</label>
					<input type="text" name="mem_clgname" class="form-control" required>
				</div>

				<div class="form-group"> 
					<button type="submit" name="signupButton" class="btn btn-primary btn-block">Sign Up!</button>
				</div>


			</form>

		</div>
		<div class="col-md-4"></div>

	</div>




</div>
	
</body>
</html>