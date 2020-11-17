<?php 
        $questions = array(
            array("1","1orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ?","male","female","Other"),
            array("2","2orem ipsum dolor sit amet, incididunt ut labore et dolore magna aliqua. ?","male","female","Other"),
            array("3","3orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ?","Male","Female","Other"),
            array("4","4orem ipsum dolor sit amet, or incididunt ut labore et dolore magna aliqua. ?","Male","Female","Other"),
        );
        $total_noof_questions = 4;
        $answer_key = array(
            array("1","2"),
            array("2","3"),
            array("3","2"),
            array("4","2"),
        );
        date_default_timezone_set("Asia/Kolkata");
        $marks_of_each_qn = 4;
        $_SESSION['answer_of _questions'] = array();
        
        $date=date_create("2020-11-04");

        $todo = date_time_set($date,16,39);
        echo date_format($date,"Y-m-d H:i:s") . "<br>";

        date_time_set($date,12,20,55);
        $now = time();
        echo date("d-m-y H:i:s", $now) . "<br>";
        $now = date("d-m-y H:i:s", $now);
        echo date_format($date,"d-m-y");
        if($now > $todo){
            $allowed_schools = array();
            echo "allowed schools";
         }
         else{
             echo " not allowed schools";
         }






?>