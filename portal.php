<?php 
    include('config/db_connect.php');
    include('Questionarray.php');
    include('config/session_verification.php');
    require('functions.php');
    include('admin.php');
    #echo "start " . $_SESSION['selected_q_no'];
    $error_message = " ";
    if(!isset($_SESSION['selected_q_no'])){    
        $_SESSION['selected_q_no'] = 1;
        $_SESSION['selected_question_details'] = question_selection_frompallete($questions);
        echo " variable not available made available";
    }else{
        echo 'variable available' . $_SESSION['selected_q_no'];
        $_SESSION['selected_question_details'] = question_selection_frompallete($questions);
    }
    /////////////////////////
    if(isset($_POST['logout'])){
        $marks = calculate_and_submit_marks($conn,$total_noof_questions,$marks_of_each_qn);
        setcookie("marks", $marks, 0, "/"); 
        header('Location: thnqu.php');
        //logout();
    }
    if(isset($_POST[$_SESSION['selected_q_no']])){
        $selected_question_no = $_SESSION['selected_q_no'];
        echo " in from if submitqution   " . $selected_question_no; #good we are getting the output
        echo $_POST['answer'];
        if(isset($_POST['answer'])){
            //$_SESSION['answer_of_question'][$selected_question_no] = $_POST['answer'];
            //print_r($_SESSION['answer_of_question']);
            print_r($_SESSION['no_of_submited_qn']);
            cheacking_answer($conn,$answer_key);     
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
        echo "in elseif statement";
    }
    
		
?>


<!Doctype html>
<html>
<section>
<script>
    "use strict";
    // Code to check browser support   
 
    //var deadline = new Date("nov 7, 2020 12:46:00").getTime(); 
    var nowa = new Date().getTime();
    
    //localStorage.setItem("now", now);
    //var check = localStorage.getItem('deadline');
    
   if(localStorage.getItem('deadline') == null){
        var deadline =  nowa + (1000 * 60 * 2);
        localStorage.setItem('deadline',deadline)
        //document.write(localStorage.getItem('deadline'));
        //document.write("in if statment javascript");
    }
    //document.write("javascript");
    document.write(localStorage.getItem('deadline'));
    //localStorage.clear();
    
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
        
        if (t < 0) { 
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
    <section class="container grey-text">
        <p id="demo"></p>
        <p id="demo1"></p>
        <p id="demo3"></p>
        <p id="done"></p>

        <h3>Question pallate </h3>
        <form method="portal.php" method="post"> 
            <input type="submit" name="question_no_frompallete" value="1"/> 
            <input type="submit" name="question_no_frompallete" value="2"/> 
            <input type="submit" name="question_no_frompallete" value="3"/> 
            <input type="submit" name="question_no_frompallete" value="4"/> 
        </form>
        <?php
            $Q_no = $_SESSION['selected_question_details'][0];
            $question = $_SESSION['selected_question_details'][1];
            $option1 = $_SESSION['selected_question_details'][2];
            $option2 = $_SESSION['selected_question_details'][3];
            $option3 = $_SESSION['selected_question_details'][4];
            $checked1 = "";$checked2 = "";$checked3 = "";
            echo "here  Q" . $Q_no;
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
    <h4 class="center"><?php echo $question ?></h4>
    <form class="white" action="portal.php" method="POST">
        
        <input type="radio" id="option1" name="answer" value="1" <?php echo $checked1?>>
        <label for="option1"><?php echo $option1?></label><br>
        
        <input type="radio" id="option2" name="answer" value="2" <?php echo $checked2?>>
        <label for="option"><?php echo $option2 ?></label><br>
        
        <input type="radio" id="option3" name="answer" value="3" <?php echo $checked3?>>
        <label for="option3"><?php echo $option3 ?></label> 
        
    <div class="center">
        <!-- <input type="submit" name="<?php #echo $Q_no ?>" value="Submit" class="btn brand "> -->
        <input type="submit" name="<?php echo $Q_no ?>" value="Submit & next Qn"  class="btn brand ">
    </div>
    <h5><?php echo $error_message;?></h5>
    </form>
   
    </section>
    <section>
    <form action="portal.php" method="POST">
        <input type="submit" name="logout" value="Finalsubmit" >
    </form>

    </section>

    </body>
    
</html>
