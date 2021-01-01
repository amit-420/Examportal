<?php
    include('config/db_connect.php');
    include('Questionarray.php');
    include('config/session_verification.php');
    require('functions.php');
    #echo "start " . $_SESSION['selected_q_no'];
    $error_message = " ";
    if(!isset($_SESSION['selected_q_no'])){
        //will Create the intial variable and fetch the question from questions array
        $_SESSION['selected_q_no'] = 1;
        $_SESSION['selected_question_details'] = question_selection_frompallete($questions);
        // echo " variable not available made available";
    }else{
        // echo 'variable available' . $_SESSION['selected_q_no'];
        $_SESSION['selected_question_details'] = question_selection_frompallete($questions);
    }
    /////////////////////////
    if(isset($_POST['logout'])){
        //will submit marks and redirect it to thnqu.php
        $marks = calculate_and_submit_marks($conn,$total_noof_questions,$marks_of_each_qn);
        setcookie("marks", $marks, 0, "/");
        header('Location: thnqu.php');
    }
    if(isset($_POST[$_SESSION['selected_q_no']])){
        $selected_question_no = $_SESSION['selected_q_no'];
        // echo " in from if submitqution   " . $selected_question_no; #good we are getting the output
        // echo $_POST['answer'];
        if(isset($_POST['answer'])){
            //$_SESSION['answer_of_question'][$selected_question_no] = $_POST['answer'];
            //print_r($_SESSION['answer_of_question']);
            //print_r($_SESSION['no_of_submited_qn']);
            cheacking_answer($conn,$answer_key);     // will check the submited answer and increase the no of right answer
            if($selected_question_no >= $total_noof_questions){
                $selected_question_no = 1;
                $_SESSION['selected_q_no'] = 1;
                $_SESSION['selected_question_details'] = question_selection_frompallete($questions);
            }else{
                $_SESSION['selected_question_details'] = question_selection_bynextbtn($questions,$selected_question_no);
                $_SESSION['selected_q_no'] += 1;
            }
        }else{
            $error_message = "Please select any one option to record";
            $_SESSION['selected_question_details'] = question_selection_frompallete($questions);
        }
    }elseif(isset($_POST['question_no_frompallete'])){
        $_SESSION['selected_q_no'] = $_POST['question_no_frompallete'];
        $_SESSION['selected_question_details'] = question_selection_frompallete($questions);
        // echo "in elseif statement";
    }


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Instructions</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <!-- Google font -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/style.css" />

</head>


<section>

  <script>
    "use strict";

    var nowa = new Date().getTime();

   if(localStorage.getItem('deadline') == null){
        var deadline =  nowa + (1000 * 60 *2 );
        localStorage.setItem('deadline',deadline)
        // deadline is written only if localstorage is empty
    }

    //document.write(localStorage.getItem('deadline'));

    function setTimer() {
        var deadline = localStorage.getItem('deadline');
        var now = new Date().getTime();
        //var t = deadline - now;
        var t = deadline - now;
        var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60));
        var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((t % (1000 * 60)) / 1000);
        document.getElementById("demo").innerHTML = hours;
        document.getElementById("demo1").innerHTML = minutes;
        document.getElementById("demo3").innerHTML = seconds;

        if (t <= 0) {
                clearInterval(x);
                document.getElementById("done").innerHTML = "TIME IS UP!";
                window.location.replace("thnqu.php");
                localStorage.clear();
                }
        }
    var x = setInterval(function() { setTimer(); },1);

    </script>
</section>


<body>

  <nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#">
      <img src="images/log.png" alt="NEO logo" style="height: 70px;"/>
    </a>

  </nav>

    <section class="container grey-text pt-4">

        <p class="timer">
          <span id="demo"></span> :
          <span id="demo1"></span> :
          <span id="demo3"></span>
          <span id="done"></span>
        </p>

        <?php
            $Q_no = $_SESSION['selected_question_details'][0];
            $question = $_SESSION['selected_question_details'][1];
            $option1 = $_SESSION['selected_question_details'][2];
            $option2 = $_SESSION['selected_question_details'][3];
            $option3 = $_SESSION['selected_question_details'][4];
            $image_url = $_SESSION['selected_question_details'][5];
            $checked1 = "";$checked2 = "";$checked3 = "";
            // echo "Q" . $Q_no;
            if(isset($_SESSION['answer_of_question'][$Q_no])){
                $previous_answer = $_SESSION['answer_of_question'][$Q_no];
                switch($previous_answer){
                    case "1":
                        $checked1 = "checked";
                    break;
                    case "2":
                        $checked2 = "checked";
                    break;
                    case "3":
                        $checked3 = "checked";
                    break;
                    default:
                        $checked1 = "";$checked2 = "";$checked3 = "";
                    break;
                    }
            }
        ?>


    <!-- Bootstrap grid for layout of question palette and options -->

    <div class="container">
      <div class="row">

        <div class="col-md-8">

          <!-- Display question number and the question -->
          <p class="question-text" style="font-size: 1.3rem;">
            <strong><?php echo "Q. ". $Q_no . " " ?></strong><?php echo $question ?>
            <?php if($image_url != ""){ ?><img src=<?php echo $image_url ?> alt="Stickman" width="200" height="200"> <?php }else{ } ?>
          </p>

          <form class="white" action="portal.php" method="POST">

              <input type="radio" id="option1" name="answer" value="1" <?php echo $checked1?>>
              <label for="option1"><?php echo $option1?></label><br>

              <input type="radio" id="option2" name="answer" value="2" <?php echo $checked2?>>
              <label for="option2"><?php echo $option2 ?></label><br>

              <input type="radio" id="option3" name="answer" value="3" <?php echo $checked3?>>
              <label for="option3"><?php echo $option3 ?></label>

              <div class="col-md-6 pl-0">
                <input type="submit" name="<?php echo $Q_no ?>" value="Save and Next Question"  class="btn btn-dark">
              </div>

          <h5><?php echo $error_message;?></h5>
          </form>
        </div>

        <div class="col-md-4 text-right pr-0">
          <h6>Question palette</h6>
          <div class="row">

          <form action="portal.php" method="post">
              <?php for($i=1;$i <= $total_noof_questions; $i++)
              {?>
              <input type="submit" class="col-md-2" name="question_no_frompallete" value="<?php echo $i ?>"/>
              <?php
              }?>
          </form>
          </div>
        </div>

      </div>


      <div class="row justify-content-end">
        <div class="col-md-6 text-right">
          <form action="portal.php" method="POST">
            <input type="submit" class="btn btn-primary" name="logout" value="Submit">
          </form>
        </div>

      </div>


    </section>

    </body>

</html>
