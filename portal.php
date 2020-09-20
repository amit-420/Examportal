<?php 
      session_start();
	include('config/db_connect.php');

		if(isset($_POST['submit'])){
                  echo $_POST['gender'];


            }


?>


<!Doctype html>
<html>
    <section class="container grey-text">
		<h4 class="center">orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ?</h4>
		<form class="white" action="portal.php" method="POST">
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Male</label><br>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label><br>
            <input type="radio" id="other" name="gender" value="other">
            <label for="other">Other</label> 
            <div class="center">
			<input type="submit" name="submit" value="Submit" class="btn brand ">
		</div>
			
		</form>
	</section>

</html>