<?php
        $questions = array(
            array("1","1orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ?","male","female","Other","https://i.imgur.com/qaZhHdm.png"),
            array("2","2orem ipsum dolor sit amet, incididunt ut labore et dolore magna aliqua. ?","male","female","Other","https://i.imgur.com/MHDNmLM.png"),
            array("3","3orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ?","Male","Female","Other","https://i.imgur.com/TxtPvGk.png"),
            array("4","4orem ipsum dolor sit amet, or incididunt ut labore et dolore magna aliqua. ?","Male","Female","Other",""),
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
        
        $allowed_schools = array("vnit","vit","iiit");
        
        $now = time();
        // echo date("d-m-y H:i:s", $now) . "<br>";







?>
