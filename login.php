<?php 
	include('config/db_connect.php');
	require('Questionarray.php');
	//echo $_COOKIE['marks'];
	$username = $password = '';
	$errors = array('username'=>'', 'password'=>'');

		if(isset($_POST['submit'])){

		// check title
		if(empty($_POST['username'])){
			$errors['username'] = 'A username is required <br />';
		} else{
			$username = $_POST['username'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $username)){
				$errors['username'] = 'Username must be letters and spaces only';
			}
		}

		// check password
		if(empty($_POST['password'])){
			$errors['password'] = 'Password cannot be empty <br />';
		}else{
			$password = $_POST['password'];
			// if(!preg_match('/^[a-zA-Z\s]+$/', $password)){
			// 	$errors['password'] = 'Password invalid';
			// }
        }
        
        if(!array_filter($errors)){

			$username = mysqli_real_escape_string($conn, $_POST['username']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);
			

			$sql = "SELECT * FROM user_login_data WHERE username = '$username' AND password = '$password'";
			$result = mysqli_query($conn,$sql);
			$userData = mysqli_fetch_array($result);
			$count = mysqli_num_rows($result);
			print_r($count);
			if($count == 1 && $userData['username'] == $username) {
				session_start();
				$_SESSION['user_id'] = $userData['id'];
				$_SESSION['username'] = $username;
				$_SESSION['selected_q_np'];
				$_SESSION['no_of_submited_qn'] = array();
				$_SESSION['payment_status'] = TRUE;
				$_SESSION['exam_status'] = FALSE;
				#$_SESSION['school_name']
				// if(!in_array($_SESSION['school_name'],$allowed_schools)){
				// 	session_unset();
				// 	session_destroy();
				// 	header("Location: timetable.php");
				// }
				
				header("location: rules.php");
			 }else {
				$error = "Your Login Name or Password is invalid";
			 }
			
			
        }
	} // end POST check
	

?>

<!DOCTYPE html>
<html>
	

	<section class="container grey-text">
		<h4 class="center">Student Login</h4>
		<form class="white" action="login.php" method="POST">
			<label>Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username)?>">
            <div class="red-text"><?php echo $errors['username']?></div>
			<label>Password</label>
            <input type="password" name="password" value="<?php echo htmlspecialchars($password)?>">
            <div class="red-text"><?php echo $errors['password']?></div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand ">
			</div>
		</form>
	</section>

   
    

</html>