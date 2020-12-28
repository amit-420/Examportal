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
	<!-- Bootstrap CSS  -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<!-- eXTERNAL css  -->
	<link rel="stylesheet" href="assets/css/login.css">
	<!-- font styles  -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

<!-- Signup Design start  -->
<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="assets/images/login.jpg" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
			  	<img src="assets/images/logo-ecell-sm.png" alt="logo" class="logo"> <br><br><h4><b>E-Cell VNIT </b></h4>
              </div>
              <p class="login-card-description">Create Account</p>
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
					<select class="dropdown-toggle" name="mem_clgname" id="mem_clgname" required>
						<option value="vnit"> VNIT, Nagpur</option>
						<option value="iiiit"> iiiT, Nagpur</option>
						<option value="vit"> VIT, Nagpur</option>
					</select>
			
				</div>
				<div><?php echo $error; ?></div>
                
				<div class="form-group"> 
					<button type="submit" name="signupButton" class="btn btn-block login-btn mb-4" >Sign Up!</button>
				</div>
					


			</form>
                <p class="login-card-footer-text">Already have an account? <a href="login.php" name="loginButton" class="text-reset">Sign into your account</a></p>
                <nav class="login-card-footer-nav">
				Copyright: <a href="ecellvnit.org">E-Cell VNIT </a>
                </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
<!-- signup design end  -->
<!-- <div class="container">
	
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
						<option value="vnit"> VNIT, Nagpur</option>
						<option value="iiiit"> iiiT, Nagpur</option>
						<option value="vit"> VIT, Nagpur</option>
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
	 -->

	 <!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
