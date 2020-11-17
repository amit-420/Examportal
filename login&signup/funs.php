<?php 
	function account_creation($db_connect){
	
		$mem_name = $_POST['mem_name'];
		$mem_email = $_POST['mem_email'];
		$mem_number = $_POST['mem_number'];
		$mem_pass = sha1($_POST['mem_pass']);
		$mem_clgname = $_POST['mem_clgname'];

		
		$query = "INSERT INTO user_login_data
				(`id`,`mem_name`, `mem_email`, `mem_pass`, `mem_number`, `mem_clgname`, `payment_status`, `exam_status`, `marks`) 
				VALUES ('NULL', '$mem_name', '$mem_email', '$mem_pass', '$mem_number', '$mem_clgname', '0', '0', '0') ;";
		$query .= "INSERT INTO `$mem_clgname` (`id`,`mem_name`, `mem_email`,`marks`) VALUES ('NULL', '$mem_name','$mem_email','0') ";
		$result = mysqli_multi_query($db_connect,$query);

		
		
		$success = "Account created! Please check your inbox to verify your email address.";
		$sub="Confirmemail";
		$event="Welcome ur email is confirmed";
		//htmlMail($mem_email,$sub,$mem_name,"",$event);
		
		if(isset($result)){
			header("Location:login.php");
			echo "Data stored succesfully by updating existing data" . mysqli_error($db_connect);
		}else{
			echo  "Error: " . "<br>" . mysqli_error($db_connect);
		}
			
	}


	function login_func($db_connect){
		include("../Questionarray.php");

		// username and password sent from form 
		
		$myusername = mysqli_real_escape_string($db_connect,$_POST['mem_email']);
		$mypassword = sha1(mysqli_real_escape_string($db_connect,$_POST['mem_pass'])); 
		
		$sql = "SELECT * FROM user_login_data WHERE mem_email = '$myusername' and mem_pass = '$mypassword'";
		$result = mysqli_query($db_connect,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		//$active = $row['active'];
		
		$count = mysqli_num_rows($result);
		
		// If result matched $myusername and $mypassword, table row must be 1 row
			
		if($count == 1) {
			
			// Here we will check if student has logged in in designeted time;
			
			
			if(!in_array($row['mem_clgname'],$allowed_schools)){
				echo "exam not started yet";
				header("Location: ../timetable.php");
			
			}else{
				session_start();
				$_SESSION['mem_email'] = $row['mem_email'];
				$_SESSION['selected_q_np'];
				
				$_SESSION['no_of_submited_qn'] = array();
				$_SESSION['mem_clgname'] = $row['mem_clgname']; 
				
				$_SESSION['payment_status'] = $row['payment_status'];
				$_SESSION['exam_status'] = $row['exam_status'];
				header("location:../rules.php");
				echo " U are Logged in";
			}
		
		
		}else{
			$error =  "Wrong password";
		}
	}

	

 ?>
