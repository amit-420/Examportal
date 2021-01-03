<?php 
include('config/db_connect.php');
include('Questionarray.php');
//include('config/session_verification.php');
#require('functions.php');
if(isset($_POST['change_payment_status'])){
    $e = $_POST['change_payment_status'];
    $changed_value = 1 - $e;
    //echo $changed_value;
    $mem_email = $_POST['mem_email'];
    $sql3 = "UPDATE `user_login_data` SET `payment_status`= '$changed_value' WHERE `user_login_data`.`mem_email` = '$mem_email';";
    
    $result = mysqli_multi_query($conn,$sql3);
    session_start();
    
    $_SESSION['is_admin_logged_in'] = "started_session";
    if($result){
        //echo "Data stored succesfully by updating existing data";
    }else{
         echo  "Error: " . $sql3 . "<br>" . mysqli_error($conn);
    }
}
elseif(isset($_POST['change_exam_status'])){
    $e = $_POST['change_exam_status'];
    $changed_value = 1 - $e;
    
    $mem_email = $_POST['mem_email'];
    $sql3 = "UPDATE `user_login_data` SET `exam_status`= '$changed_value' WHERE `user_login_data`.`mem_email` = '$mem_email';";
    $result = mysqli_multi_query($conn,$sql3);
    
    session_start();
	$_SESSION['is_admin_logged_in'] = "started_session";
   
    if($result){
        //echo "Data stored succesfully by updating existing data";
    }else{
        echo  "Error: " . $sql3 . "<br>" . mysqli_error($conn);
    }
}elseif(isset($_POST['submit'])){
    if($_POST['username'] == "ecell" and $_POST['password'] == "password"){
        session_start();
		$_SESSION['is_admin_logged_in'] = "started_session";
    }else{
        echo "Password or username is incorrect";
    }
}elseif(isset($_POST['logout'])){
    session_unset();
}

?>
<?php if(!isset($_SESSION['is_admin_logged_in'])){?>
    <!Doctype html>
    <html lang="en">
        <form action="admin.php" method="post">
            <label>Username</label>
            <input type="text" name="username" > <br> <br>
            <label>Password</label>
            <input type="password" name="password"> <br><br> <br>
            <input type="submit" name="submit" value="login">
        </form>
    </html>
<?php } else {?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Data</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="ajax/ajax.js"></script>
</head>
<body>
    <div class="container">
	<p id="success"></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2><b>Manage Users</b></h2>
                    </div >
                    
                </div>
            </div> <br>
            <div class="col-sm-6"> <form method="post" action="admin.php"><input type="submit" name="logout" value= "Logout"></form></div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>SL NO</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
						<th>PHONE</th>
                        <th>Collage Name</th>
                        <th>Payment Status</th>
                        <th>Exam Status</th>
                    </tr>
                </thead>
				<tbody>
				
				<?php
				$result = mysqli_query($conn,"SELECT * FROM user_login_data ORDER BY mem_clgname ASC");
					$i=1;
					while($row = mysqli_fetch_array($result)) {
				?>
				<tr id="<?php echo $row["id"]; ?>">
				
					<td><?php echo $i; ?></td>
					<td><?php echo $row["mem_name"]; ?></td>
					<td><?php echo $row["mem_email"]; ?></td>
					<td><?php echo $row["mem_number"]; ?></td>
					<td><?php echo $row["mem_clgname"]; ?></td>
                    <td><form action="admin.php" method="post">
                        <input type="hidden" name="mem_email" value="<?php echo $row["mem_email"]?>">
                        <input type="submit" class="col-md-2" name="change_payment_status" value="<?php echo $row['payment_status'] ?>"/>
                        </form></td>
                    <td><form action="admin.php" method="post">
                    <input type="hidden" name="mem_email" value="<?php echo $row["mem_email"]?>">
                        <input type="submit" class="col-md-2" name="change_exam_status" value="<?php echo $row['exam_status'] ?>"/>
                        </form></td>
                </td>
                    
				</tr>
				<?php
				$i++;
				}
				?>
				</tbody>
			</table>
			
        </div>
    </div>
	<!-- Add Modal HTML -->



</body>
</html>  <?php } ?>  