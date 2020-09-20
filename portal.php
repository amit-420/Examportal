<?php 
      session_start();
      include('config/db_connect.php');
      include('Questionarray.php');
      foreach($questions as $question) {
            if(isset($_POST[$question[0]])){
                  echo $_POST['gender'];
                  #For adding table $sql = "CREATE TABLE test (
                              // PersonID int,
                              // LastName varchar(255),
                              // FirstName varchar(255),
                              // Address varchar(255),
                              // City varchar(255))";
                        $q1 = $_POST['gender'];
                  #For adding column in a table $sql1 = "ALTER TABLE `test` ADD `extracolun` INT NOT NULL AFTER `City`"; #Code only for test
                  #For creating foreign key link $sql2 = "ALTER TABLE `selected_option` ADD CONSTRAINT `user_linkto_option` FOREIGN KEY (`user_id`) REFERENCES `user_login_data`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; "
                  $sql3 = "INSERT INTO selected_option($question[0]) VALUES('$q1')";
                  $result = mysqli_query($conn,$sql3);
                  if($result){
                        echo "table created succesfully";
                  }else{
                        echo "some problem is there";
                  }
            }
      }
		
                  


            


?>


<!Doctype html>
<html>
    <section class="container grey-text">
            <?php foreach($questions as $question) { ?>
                  <h4 class="center"><?php echo $question[1] ?></h4>
                  <form class="white" action="portal.php" method="POST">
                  <input type="radio" id="male" name="gender" value="0">
                  <label for="male"><?php echo $question[2] ?></label><br>
                  <input type="radio" id="female" name="gender" value="1">
                  <label for="female"><?php echo $question[3] ?></label><br>
                  <input type="radio" id="other" name="gender" value="2">
                  <label for="other"><?php echo $question[4] ?></label> 
                  <div class="center">
                        <input type="submit" name="<?php echo $question[0] ?>" value="Submit" class="btn brand ">
                  </div>
		<?php } ?>	
            
	</section>

</html>