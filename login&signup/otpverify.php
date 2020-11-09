<?php
session_start();






?>
<?php
    
    

    if (isset($_POST['otpverifyButton'])) {
        
        

    
        
        $mem_otp=$_POST["mem_otp"];
        if($mem_otp == $_SESSION["otp"]){
            //echo "u can change the password";
            header("Location:changepass.php");
        }
        else{
            echo "Wrong OTP";
        }
    }
?>