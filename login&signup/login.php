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
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<div class="container">
	
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
			<div class='alert alert-danger'><?php echo $error; ?></div>			
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
		</div>

	

	


	
</body>
</html>            



