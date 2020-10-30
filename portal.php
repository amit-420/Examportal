<?php 
    include('config/db_connect.php');
    include('Questionarray.php');
    include('config/session_verification.php');
    include('functions.php');

    #echo "start " . $_SESSION['selected_q_no'];
    $error_message = " ";
    if(!isset($_SESSION['selected_q_no'])){
        $_SESSION['selected_q_no'] = 1;
        $_PACK = question_selection_frompallete($questions);
        echo " variable not available made available";
    }else{
        echo 'variable available' . $_SESSION['selected_q_no'];
        $_PACK = question_selection_frompallete($questions);
    }
    /////////////////////////
    if(isset($_POST['logout'])){
        $marks = calculate_and_submit_marks($conn,$total_noof_questions,$marks_of_each_qn);
        $_SESSION['marks'] = $marks;
        header('Location: thnqu.php');
    }
    if(isset($_POST[$_SESSION['selected_q_no']])){
        $selected_question_no = $_SESSION['selected_q_no'];
        echo " in from if submitqution   " . $selected_question_no; #good we are getting the output
        echo $_POST['answer'];
        if(isset($_POST['answer'])){
            $_SESSION['answer_of_question'][$selected_question_no] = $_POST['answer'];
            print_r($_SESSION['answer_of_question']);
            print_r($_SESSION['no_of_submited_qn']);
            cheacking_answer($conn,$answer_key);     
            if($selected_question_no >= $total_noof_questions){
                $selected_question_no = 1;
                $_SESSION['selected_q_no'] = 1;
                $_PACK = question_selection_frompallete($questions);
            }else{  
                $_PACK = question_selection_bynextbtn($questions,$selected_question_no);                                       
                $_SESSION['selected_q_no'] += 1;
            }
        }else{
            $error_message = "Please select any one option to record";
            $_PACK = question_selection_frompallete($questions);
        }        
    }elseif(isset($_POST['question_no_frompallete'])){
        $_SESSION['selected_q_no'] = $_POST['question_no_frompallete'];
        $_PACK = question_selection_frompallete($questions);
        echo "in elseif statement";
    }
    
		
?>


<!Doctype html>
<html>
    <section>
    <h1>Countdown</h1> 
        <div id="clockdiv"> 
        <div> 
            <div class="smalltext">Time Left:</div> 
            <span id="hour"></span>
            <span id="minute"></span> 
            <span id="second"></span> 
        </div> 
        
        <p id="done">
        </p> 
        
        <script> 
        
        var deadline = new Date("oct 29, 2020 20:30:00").getTime(); 
        
        var x = setInterval(function() { 
        
        var now = new Date().getTime(); 

        var t = deadline - now; 
        var days = Math.floor(t / (1000 * 60 * 60 * 24)); 
        var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60)); 
        var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60)); 
        var seconds = Math.floor((t % (1000 * 60)) / 1000); 
        document.getElementById("hour").innerHTML =hours; 
        document.getElementById("minute").innerHTML = minutes;  
        document.getElementById("second").innerHTML =seconds;  
        if (t < 0) { 
                clearInterval(x); 
                document.getElementById("done").innerHTML = "TIME IS UP!"; 
                document.getElementById("hour").innerHTML ='0'; 
                document.getElementById("minute").innerHTML ='0' ;  
                document.getElementById("second").innerHTML = '0'; 
                // <?php 
                //     $marks = calculate_and_submit_marks($conn,$total_noof_questions,$marks_of_each_qn);
                //     $_SESSION['marks'] = $marks;
                //     header('Location: thnqu.php');
                // ?>            
            } 
        }, 1000); 
        </script> 
    </section>
    <section class="container grey-text">

        <h3>Question pallate </h3>
        <form method="post"> 
            <input type="submit" name="question_no_frompallete" value="1"/> 
            <input type="submit" name="question_no_frompallete" value="2"/> 
            <input type="submit" name="question_no_frompallete" value="3"/> 
            <input type="submit" name="question_no_frompallete" value="4"/> 
        </form>
        <?php
            $Q_no = $_PACK[0];
            $question = $_PACK[1];
            $option1 = $_PACK[2];
            $option2 = $_PACK[3];
            $option3 = $_PACK[4];
            echo "here  Q" . $Q_no;
            ?>
            <h4 class="center"><?php echo $question ?></h4>
            <form class="white" action="portal.php" method="POST">
                
                <input type="radio" id="option1" name="answer" value="1">
                <label for="option1"><?php echo $option1?></label><br>
                
                <input type="radio" id="option2" name="answer" value="2">
                <label for="option"><?php echo $option2 ?></label><br>
                
                <input type="radio" id="option3" name="answer" value="3">
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

</html>
