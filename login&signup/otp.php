<?php
 session_start();
 $random_verification_code = rand(1000,9999);
 $_SESSION["otp"]=$random_verification_code;
 
 include_once("config/mailing.php");
    $sub="OTPverify";
    $name="user";
    
    
        

    htmlMail($_SESSION['mem_otp_email'],$sub,$name,"",$_SESSION["otp"]);
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
		<h1>Recover Password</h1>
	</div>

	<div class="row">

		<div class="col-md-4"></div>
		<div class="col-md-4">
        <p>Check your Email for OTP</p>
			
        <form action="otpverify.php" method="POST">
            <div class="form-group">
					<label>Enter OTP:</label>
					<input type="integer" id="otp" name="mem_otp" class="form-control" required>
			</div>
            <div class="form-group">
					<button type="Submit" name="otpverifyButton" class="btn btn-primary btn-block" >Verify</button>
            </div>
        </form>
    </div>
</div>
<?php



?>

