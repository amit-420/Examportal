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
    }
    /////////////////////////
    if(isset($_POST['logout'])){
        $marks = calculate_and_submit_marks($conn,$total_noof_questions,$marks_of_each_qn);
        logout();
    }
    if(isset($_POST[$_SESSION['selected_q_no']])){
        $selected_question_no = $_SESSION['selected_q_no'];
        echo " in from if submitqution   " . $selected_question_no; #good we are getting the output
        echo $_POST['answer'];
        if(isset($_POST['answer'])){
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


<?php 
//mysql commands
#For adding table $sql = "CREATE TABLE test (
                              // PersonID int,
                              // LastName varchar(255),
                              // FirstName varchar(255),
                              // Address varchar(255),
                              // City varchar(255))";
                  #For adding column in a table $sql1 = "ALTER TABLE `test` ADD `extracolun` INT NOT NULL AFTER `City`"; #Code only for test
                   #For creating foreign key link $sql2 = "ALTER TABLE `selected_option` ADD CONSTRAINT `user_linkto_option` FOREIGN KEY (`user_id`) REFERENCES `user_login_data`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; "
                  #for updating data $sql3 = update addingValueToExisting set GameScore = GameScore+10 where Id = 4;

#$sql3 = "INSERT INTO selected_option (user_id,$question_no) VALUES ('1','$answer')";
//testing algo = if(sel_opti - ans != 0){
   # flag
#} no of flags is equal to no of wrong answers 
?>