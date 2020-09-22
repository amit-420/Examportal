<?php 
      include('config/db_connect.php');
      include('Questionarray.php');
      include('config/session_verfication.php');
      foreach($questions as $question) {              // question template :: array("Q1","Question comes here ?","male","female","Other"),
            if(isset($_POST[$question[0]])){       // if the question[0] matches with question[0] from which post request
                  echo $_POST['answer'];
                  
                  $answer = mysqli_real_escape_string($conn,$_POST['answer']);
                  $user_id = mysqli_real_escape_string($conn,$_SESSION['user_id']);
                  $question_no = mysqli_real_escape_string($conn,$question[0]);
                 
                  #$sql3 = "INSERT INTO selected_option (user_id,$question_no) VALUES ('1','$answer')";
                  $sql3 = "update selected_option set $question_no = $answer where user_id = $user_id";//Updating data in mysql table
                  echo $question_no;
                  $result = mysqli_query($conn,$sql3);
                  if($result){
                        echo "Data stored succesfully ";
                  }else{
                        echo  "Error: " . $sql3 . "<br>" . mysqli_error($conn);
                  }
            }
      }
		
?>


<!Doctype html>
<html>
    <section class="container grey-text">
            <?php foreach($questions as $question) { // looping through questions which can be added in Questionarray file and displaying them one by one?> 
                  <h4 class="center"><?php echo $question[1] ?></h4>
                  <form class="white" action="portal.php" method="POST">
                  <input type="radio" id="male" name="answer" value="0">
                  <label for="male"><?php echo $question[2] ?></label><br>
                  <input type="radio" id="female" name="answer" value="1">
                  <label for="female"><?php echo $question[3] ?></label><br>
                  <input type="radio" id="other" name="answer" value="2">
                  <label for="other"><?php echo $question[4] ?></label> 
                  <div class="center">
                        <input type="submit" name="<?php echo $question[0] ?>" value="Submit" class="btn brand ">
                  </div>
		<?php } ?>	
            
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
?>