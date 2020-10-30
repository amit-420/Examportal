<?php 
include('config/session_verification.php');
include('functions.php');
if(isset($_POST['login'])){
    logout();
    header('Location: login.php');
}
$fromsession = $_SESSION['marks'];
$marks = $fromsession;
?>

<!Doctype html>
<html>
    <section>
        <h4><?php echo 'you have earnned total ' . $marks . ' marks'?></h4>
        <form action="thnqu.php" method="POST">
            <input type="submit" name="login" value="Login Again" >
        </form>
    </section>
</html>