<?php
include('config/db_connect.php');
include('Questionarray.php');
include('functions.php');
include('config/session_verification.php');
if(isset($_POST['login'])){
    setcookie("marks", $marks, time() - 7200, "/");
    logout();
    header('Location: login&signup/login.php');
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
      <meta charset="utf-8" />

      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;800&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="css/style.css" />

      <Script>
          localStorage.clear();
      </Script>
    </head>
    <section>
        <h4 class="text-center"><?php echo 'You have earned total ' . $marks . '    marks'?></h4>
        <form action="thnqu.php" method="POST" class="text-center pt-4">
            <input type="submit" class="btn btn-primary" name="login" value="Login Again" >
        </form>
    </section>
</html>
