<?php 
    session_start();
    include('config/db_connect.php');
    if(!isset($_SESSION['username'])){
        header("location:login.php");
        die();
     }else{
         header("location:index.php");
     }


    //close connection
    mysqli_close($conn);



?>

<!Doctype html>
<html>
    <h4><?php echo "welcome " . $_SESSION['username'] ?></h4>
    <form class="white" action="login.php" method="POST">
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand ">
			</div>
    </form>
</html>