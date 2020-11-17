<?php 
    session_start();
	include("config/db.php");
	include("config/confirmmail.php");
	include("funs.php");
	$error = '';
	if (isset($_POST['signupButton'])) {
		if($_POST['con_mem_pass'] == $_POST['mem_pass']){
			
									
			$_SESSION['mem_email'] = $_POST['mem_email'];
			$email= $_SESSION['mem_email'];
	
			$query_select = mysqli_query($db_connect, "SELECT * from user_login_data where mem_email = '$email' ");
	
			$checkpoint = mysqli_num_rows($query_select);
	
			echo $checkpoint;
	
			if ($checkpoint==0) {
				account_creation($db_connect);
										
			}else{
	
				$error = "Email already exist.SignIN!";
										
			}
									
		}else{
				$error = "Those passwords didn't match. Try again.";	
		}
	}


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
			
			


       <form action="login.php">
	   		<button type="submit" name="loginButton" class="btn btn-primary btn-block" >Already a Member? SignIN!</button>

	   </form>
	   <br><p>OR
	   </p>
	   <h2>Enter your details:</h2>

			<form action="signup.php" method="POST">
			    
				
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
					<label>Confirm Password</label>
					<input type="password" name="con_mem_pass" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="mem_clgname">Select your College:</label>
					<select name="mem_clgname" id="mem_clgname" required>
						<option value="vnit">VNIT, Nagpur</option>
						<option value="iiiit">IIIT, Nagpur</option>
						<option value="vit">VIT, Nagpur</option>
					</select>
			
				</div>
				<div><?php echo $error; ?></div>
                
				<div class="form-group"> 
					<button type="submit" name="signupButton" class="btn btn-primary btn-block" >Sign Up!</button>
				</div>
					


			</form>

		</div>
		<div class="col-md-4"></div>

	</div>




</div>
	
</body>
</html>
