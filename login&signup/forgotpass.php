<?php
    session_start();
    include("config/db.php");
    include("../Questionarray.php");
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Recover password</title>
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<div class="container">
	
	<div class="jumbotron">
		<h1>Forgot password</h1>
	</div>

	<div class="row">

		<div class="col-md-4"></div>
		<div class="col-md-4">
			
        <form action="" method="POST">
            <div class="form-group">
					<label>Enter your Email:</label>
					<input type="email" id="mem_otp_email" name="mem_otp_email" class="form-control" required>
			</div>
            <div class="form-group">
				<button type="Submit" name="forgotpassButton" class="btn btn-primary btn-block"  >Get OTP</button>
           </div>
            
            
               
        </form>
        
        
            
    </div>
</div>

<?php

//$mem_email = $_SESSION[]

if (isset($_POST['forgotpassButton'])) {
                                
    $_SESSION['mem_otp_email'] = $_POST['mem_otp_email'];
    $email= $_SESSION['mem_otp_email'];

    $query_select = mysqli_query($db_connect, "SELECT * from `$tablename` where mem_email = '$email' ");

    $checkpoint = mysqli_num_rows($query_select);

    if ($checkpoint>0) {
        $success = " Please check your inbox for OTP.";
        
        header("Location:otp.php");
                                
    }else{

        $error = "Email doesn't exist.Signup!";
                                
    }
                            

    if (isset($error)) {
                        
        echo "<div class='alert alert-danger'>" . $error . "</div>";
    }

    if (isset($success)) {
                        
        echo "<div class='alert alert-success'>" . $success . "</div>";
        
                                
                        
    }
}
?>




        	
</body>
</html>            