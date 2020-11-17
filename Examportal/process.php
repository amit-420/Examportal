
	<?php
   include("db.php");
   
   
   
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db_connect,$_POST['mem_email']);
      $mypassword = sha1(mysqli_real_escape_string($db_connect,$_POST['mem_pass'])); 
      
      $sql = "SELECT id FROM users WHERE mem_email = '$myusername' and mem_pass = '$mypassword'";
      $result = mysqli_query($db_connect,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         
         header("location:Questionarre/rules.php");
         echo " U are LOgged in";
      }else{
         echo "Wrong password";
      }
   
?>
<html>    
