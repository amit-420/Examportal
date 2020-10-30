<?php 




?>
<!DOCTYPE HTML> 
<html> 
<head> 
 
</head> 
<body> 
<?php
            $Q_no = 1;
            $question = "ldkfjod f kjlfklkdjflkdjdokjkj lkdflkf";
            $option1 = " njflk ";
            $option2 = "nvdkf ";
            $option3 = "jfldkf ";
            echo "here  Q" . $Q_no;
            $_POST['answer'] = $Q_no;
            $checked = "checked"
            ?>
            <h4 class="center"><?php echo $question ?></h4>
            <form class="white" action="sandbox.php" method="POST">
                
                <input type="radio" id="option1" name="answer" value="1">
                <label for="option1"><?php echo $option1?></label><br>
                
                <input type="radio" id="option2" name="answer" value="2" >
                <label for="option"><?php echo $option2 ?></label><br>
                
                <input type="radio" id="option3" name="answer" value="3" <?php echo $checked?>>
                <label for="option3"><?php echo $option3 ?></label> 
                
            <div class="center">
                <!-- <input type="submit" name="<?php #echo $Q_no ?>" value="Submit" class="btn brand "> -->
                <input type="submit" name="<?php echo $Q_no ?>" value="Submit & next Qn"  class="btn brand ">
            </div>
            </form>
           
  

</html> 