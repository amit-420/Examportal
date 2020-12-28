<?php
include("config/db.php");
include("funs.php");
$error = '';
if (isset($_POST['loginButton'])) {
                                
    $_SESSION['mem_email'] = $_POST['mem_email'];
    $email= $_SESSION['mem_email'];

    $query_select = mysqli_query($db_connect, "SELECT * from user_login_data where mem_email = '$email' ");

	$checkpoint = mysqli_num_rows($query_select);
	
	echo $checkpoint;

    if ($checkpoint>0) {
		
		login_func($db_connect);
		
    }else{

        $error = "Email doesn't exist, Signup!";
                                
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>LOGIN</title>
	<!-- Bootstrap CSS  -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<!-- eXTERNAL css  -->
	<link rel="stylesheet" href="assets/css/login.css">
	<!-- font styles  -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

<!-- Styling of page start  -->

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
              <p class="login-card-description">Sign into your account</p>
              <!-- <form action="login.php" method="POST">
                  <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="mem_email" id="mem_email" class="form-control" placeholder="Email address" required>
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="mem_pass" id="mem_pass" class="form-control" placeholder="***********" required>
                  </div>
                  <div class="form-group">
				  <button name="login" name="loginButton" class="btn btn-block login-btn mb-4" >Login</button>
				  </div>
				</form> -->
				
				<form action="login.php" method="POST">
            <div class="form-group">
					<label>Email</label>
					<input type="email" id="mem_email" name="mem_email" class="form-control" placeholder="Email address" required>
			</div>
            <div class="form-group mb-4">
					<label>Password</label>
					<input type="password" id="mem_pass" name="mem_pass" class="form-control" placeholder="***********" required>
			</div>

			<div class="form-group">
					<button type="login" name="loginButton" class="btn btn-block login-btn mb-4" >Login!</button>
			</div>
					
        </form>
                <a href="forgotpass.php" name="forgotButton" class="forgot-password-link">Forgot password?</a>
                <p class="login-card-footer-text">Don't have an account? <a href="signup.php" name="" class="text-reset">Register here</a></p>
                <nav class="login-card-footer-nav">
				Copyright: <a href="ecellvnit.org">E-Cell VNIT </a>
                </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>


<!-- Styling of page end -->
<!-- <div class="container">
	
	<div class="jumbotron">
		<h1>LOGIN</h1>
	</div>

	<div class="row">

		<div class="col-md-4"></div>
		<div class="col-md-4">
			
        <form action="login.php" method="POST">
            <div class="form-group">
					<label>Email</label>
					<input type="email" id="mem_email" name="mem_email" class="form-control" required>
			</div>
            <div class="form-group">
					<label>Password</label>
					<input type="password" id="mem_pass" name="mem_pass" class="form-control" required>
			</div>

			<div class="form-group">
					<button type="login" name="loginButton" class="btn btn-primary btn-block" >Login!</button>
			</div>
					
        </form>
		<br><br>
		<div class="forgotpass">
				<form action="forgotpass.php">
					<button type="Submit" name="forgotButton" class="btn btn-primary btn-block" >Forgot Password</button>
        		</form>
			</div><br>
             
        <div class="signup">
		<form action="signup.php">
				<button type="submit" name="notsignupButton" class="btn btn-primary btn-block" >Not a member? Sign Up!</button>
        </form>
		</div> -->

	

	

<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>            



