<?php 
    include('config/db_connect.php');
    include('Questionarray.php');
    include('config/session_verification.php');
    foreach($questions as $question) {              // question template :: array("Q1","Question comes here ?","male","female","Other"),
        if(isset($_POST[$question[0]])){       // if the question[0] matches with question[0] from which post request
            echo $_POST['answer'];
            
            $answer = mysqli_real_escape_string($conn,$_POST['answer']);
            $user_id = mysqli_real_escape_string($conn,$_SESSION['user_id']);
            $question_no = mysqli_real_escape_string($conn,$question[0]);
            
            #$sql3 = "INSERT INTO selected_option (user_id,$question_no) VALUES ('1','$answer')";
            $sql3 = "update selected_option set $question_no = $answer where user_id = $user_id";//Updating data in mysql table
            echo $question_no;
            echo "<br>" . $user_id . "<br>";
            $result = mysqli_query($conn,$sql3);
            if(isset($result)){
                echo "Data stored succesfully by updating existing data ";
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
    }
		
?>


<!Doctype html>
<html>
    <section>


    </section>
    <section class="container grey-text">

        <h3>Question pallate </h3>
        <form method="post"> 
            <input type="submit" name="question_no" value="1"/> 
            <input type="submit" name="question_no" value="2"/> 
            <input type="submit" name="question_no" value="3"/> 
            <input type="submit" name="question_no" value="4"/> 
        </form>
        <?php
            if(isset($_POST['question_no'])) { 
                 $question_no = $questions[$_POST['question_no'] - 1];
                    echo "here" . $question_no[0];
                    ?>
                        <h4 class="center"><?php echo $question_no[1] ?></h4>
                        <form class="white" action="portal.php" method="POST">
                            
                            <input type="radio" id="option1" name="answer" value="1">
                            <label for="option1"><?php echo $question_no[2] ?></label><br>
                            
                            <input type="radio" id="option2" name="answer" value="2">
                            <label for="option"><?php echo $question_no[3] ?></label><br>
                            
                            <input type="radio" id="option3" name="answer" value="3">
                            <label for="option3"><?php echo $question_no[4] ?></label> 
                            
                        <div class="center">
                            <input type="submit" name="<?php echo $question_no[0] ?>" value="Submit" class="btn brand ">
                        </div>
        <?php  } ?> 
       
         
       	
            
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