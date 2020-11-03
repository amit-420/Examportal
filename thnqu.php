<?php 
include('functions.php');
if(isset($_POST['login'])){
    logout();
    header('Location: login.php');
}
$marks = $_COOKIE['marks'];
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