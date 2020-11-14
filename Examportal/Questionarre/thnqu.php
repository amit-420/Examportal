<?php 
include('config/db_connect.php');
include('Questionarray.php');
include('functions.php');
include('config/session_verification.php');
if(isset($_POST['login'])){
    setcookie("marks", $marks, time() - 7200, "/"); 
    logout();
    header('Location: login.php');
}
if(!isset($_COOKIE['marks'])){
    $marks = calculate_and_submit_marks($conn,$total_noof_questions,$marks_of_each_qn);
    echo $marks . " in if statment";
    setcookie("marks", $marks, 0, "/"); 
    $_COOKIE['marks'] = $marks;   
    $marks = isset($_COOKIE['marks']) ? $_COOKIE['marks'] : "X";
    logout();
}else{
    $marks = $_COOKIE['marks'];
    logout();
}
?>

<!Doctype html>
<html>
    <head>
        <Script>
            localStorage.clear();
        </Script>
    </head>
    <section>
        <h4><?php echo 'you have earnned total ' . $marks . '    marks'?></h4>
        <form action="thnqu.php" method="POST">
            <input type="submit" name="login" value="Login Again" >
        </form>
    </section>
</html>