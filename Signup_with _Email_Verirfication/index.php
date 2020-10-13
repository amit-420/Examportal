<?php 

	include "db.php";

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
			
        <form action="" method="POST">
            <div class="form-group">
					<label>Email</label>
					<input type="email" name="mem_email" class="form-control" required>
			</div>
            <div class="form-group">
					<label>Password</label>
					<input type="password" name="mem_pass" class="form-control" required>
			</div>
            <div class="form-group"> 
					<button type="login" name="Loginbutton" class="btn btn-primary btn-block">LOGIN!</button>
			</div>    
            
        </form>
        <form action="signup.php">
					<button type="submit" name="notsignupButton" class="btn btn-primary btn-block" >Not a member? Sign Up!</button>
                </form>     
</body>
</html>            


