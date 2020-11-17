<?php
session_start();
include("config/db.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reset PASSWORD</title>
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<div class="container">
	
	<div class="jumbotron">
		<h1>RESET Password</h1>
	</div>

	<div class="row">

		<div class="col-md-4"></div>
		<div class="col-md-4">
			
        <form action="" method="POST">
            <div class="form-group">
					<label>Enter New Password</label>
					<input type="password" id="mem_new_pass" name="mem_new_pass" class="form-control" required>
			</div>
            <div class="form-group">
					<label>Confirm Password</label>
					<input type="password" id="mem_conf_pass" name="mem_conf_pass" class="form-control" required>
			</div>

			<div class="form-group">
					<button type="login" name="changepassButton" class="btn btn-primary btn-block" >Reset Password</button>
            </div>
            
			        
						
		  
            
        </form>
    </div>  
</div>
<?php


if (isset($_POST['changepassButton'])) {
    $mem_new_pass=$_POST["mem_new_pass"];
    $mem_conf_pass=$_POST["mem_conf_pass"];
    $email=$_SESSION['mem_otp_email'];
    if($mem_new_pass == $mem_conf_pass){
        $select=mysqli_query($db_connect, "SELECT  mem_email,mem_pass from user_login_data where mem_email='$email'") ;
            if(mysqli_num_rows($select)==1){
                
                $select=mysqli_query($db_connect,"UPDATE user_login_data SET mem_pass=sha1('$mem_new_pass') where mem_email='$email'");
                header("location:login.php");    
            }
  
    
    }else{
        echo "Passwords did not match";
    }
}

?>
</body>
</html>


