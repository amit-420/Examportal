<?php 
    include('config/db_connect.php');
    include('Questionarray.php');
    include('config/session_verification.php');

    #echo "start " . $_SESSION['selected_q_no'];
    function answer_submition($conn,$question) {
        $answer = mysqli_real_escape_string($conn,$_POST['answer']);
        $user_id = mysqli_real_escape_string($conn,$_SESSION['user_id']);
        $question_no = mysqli_real_escape_string($conn,$question[0]);
        
        #$sql3 = "INSERT INTO selected_option (user_id,$question_no) VALUES ('1','$answer')";
        $sql3 = "update selected_option set $question_no = $answer where user_id = $user_id";//Updating data in mysql table
        echo $question_no;
        echo "<br>" . $user_id . "<br>";
        $result = mysqli_query($conn,$sql3);
        if(isset($result)){
            echo "Data stored succesfully by updating existing data";
        }else{
            echo  "Error: " . $sql3 . "<br>" . mysqli_error($conn);
            $sql3 = "INSERT INTO selected_option (user_id,$question_no) VALUES ('$user_id','$answer')";
            $result = mysqli_query($conn,$sql3);
            if($result){
                    echo "data stored succesfully by creating new entry in table";
            }else{
                    echo  "Error: " . $sql3 . "<br>" . mysqli_error($conn);
            }
            
        }
    }
    function question_selection_frompallete($questions){
        echo " in from pallete function   " . $_SESSION['selected_q_no'] . $_POST['question_no_frompallete'];
        $pack = $questions[$_SESSION['selected_q_no'] - 1];
        echo " in from palete function   " . $pack[0] . "    ";
        return $pack; 
    }
    function question_selection_bynextbtn($questions,$selected_question_no = 1,$total_noof_questions){
        echo " in from bynextbuttn function   " . $selected_question_no;
        $pack = $questions[$selected_question_no];
        print($pack[0]);
        return $pack;
    }
    foreach($questions as $question) {              // question template :: array("Q1","Question comes here ?","male","female","Other"),
        if(isset($_POST[$question[0]])){       // if the question[0] matches with question[0] from which post request
            echo $_POST['answer'];
            answer_submition($conn,$question);
        }
    }
    if(isset($_POST['submit+next_question'])){
        $selected_question_no = $_SESSION['selected_q_no'];
        echo " in from if submitqution   " . $selected_question_no; #good we are getting the output
        #answer_submition($conn,$question);      
        if($selected_question_no >= $total_noof_questions){
            $selected_question_no = 1;
            $_SESSION['selected_q_no'] = 1;
            $pack = question_selection_frompallete($questions);
        }else{  
            $pack = question_selection_bynextbtn($questions,$selected_question_no,$total_noof_questions);                                       
            $_SESSION['selected_q_no'] += 1;
        }

    }elseif(isset($_POST['question_no_frompallete'])){
        $_SESSION['selected_q_no'] = $_POST['question_no_frompallete'];
        $pack = question_selection_frompallete($questions);
        echo "in elseif statement";
    }
    if(!isset($_SESSION['selected_q_no'])){
        $_SESSION['selected_q_no'] = 1;
        $pack = question_selection_frompallete($questions);
        echo " variable not available made available";
    }else{
        echo 'variable available' . $_SESSION['selected_q_no'];
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
            $Q_no = $pack[0];
            $question = $pack[1];
            $option1 = $pack[2];
            $option2 = $pack[3];
            $option3 = $pack[4];
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
                           <!-- <input type="submit" name="<?php echo $Q_no ?>" value="Submit" class="btn brand "> -->
                            <input type="submit" name="submit+next_question" value="Submit & next Qn"  class="btn brand ">
                        </div>

                        </form>
        <?php   ?> 
       
         
       	
            
	</section>
    <section>
        <form action="config/session_verification.php" method="POST">
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

//testing algo = if(sel_opti - ans != 0){
   # flag
#} no of flags is equal to no of wrong answers 
?>