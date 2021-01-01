<?php

function cheacking_answer($conn,$answer_key) {
    $answer = mysqli_real_escape_string($conn,$_POST['answer']);
    $question_no = $_SESSION['selected_q_no'];

    if(!isset($_SESSION['no_of_right_qn'])){ $_SESSION['no_of_right_qn'] = 0;}

    if(in_array($question_no,$_SESSION['no_of_submited_qn'])){
        $previous_answer = $_SESSION['answer_of_question'][$question_no];

        if((($answer_key[$question_no - 1][1] - $previous_answer) == 0 ) and (($answer_key[$question_no - 1][1] - $answer) != 0)){
            $_SESSION['answer_of_question'][$question_no] = $answer;
            $_SESSION['no_of_right_qn'] -= 1;
            // echo "wrong option updated";
        }elseif((($answer_key[$question_no - 1][1] - $previous_answer) != 0) and (($answer_key[$question_no - 1][1] - $answer) == 0)){
            $_SESSION['answer_of_question'][$question_no] = $answer;
            $_SESSION['no_of_right_qn'] += 1;
            // echo "right option updated";
        }else{
            // echo "same as previous option selected";
        }
    }else{

        if(($answer_key[$question_no - 1][1] - $answer) == 0){
            $_SESSION['answer_of_question'][$question_no] = $answer;
            $_SESSION['no_of_submited_qn'][] = $_SESSION['selected_q_no'];
            $_SESSION['no_of_right_qn'] += 1;
            // echo "right option selected";
        }else{
            $_SESSION['answer_of_question'][$question_no] = $answer;
            $_SESSION['no_of_submited_qn'][] = $_SESSION['selected_q_no'];
        }
    }


}

function calculate_and_submit_marks($conn,$total_noof_questions,$marks_of_each_qn){

    $mem_email = mysqli_real_escape_string($conn,$_SESSION['mem_email']);
    $mem_clgname = mysqli_real_escape_string($conn, $_SESSION['mem_clgname']);

    if(!isset($_SESSION['no_of_right_qn'])){ $_SESSION['no_of_right_qn'] = 0;}
    $no_of_right_qn = mysqli_real_escape_string($conn,$_SESSION['no_of_right_qn']);

    $marks = $no_of_right_qn * $marks_of_each_qn;

    //$sql3 = "update user_login_data set marks = '$marks' where mem_email = '$mem_email' ";
    //Updating data in mysql table
    $sql3 = "UPDATE `user_login_data` SET `marks` = '$marks', `exam_status`= '1' WHERE `user_login_data`.`mem_email` = '$mem_email';";
    $sql3 .= "UPDATE `$mem_clgname` SET `marks` = '$marks' WHERE `$mem_clgname`.`mem_email` = '$mem_email'";
    echo $marks;
    echo "<br>" . $mem_email . "<br>";
    $result = mysqli_multi_query($conn,$sql3);

    if($result){
        // echo "Data stored succesfully by updating existing data";
    }else{
        // echo  "Error: " . $sql3 . "<br>" . mysqli_error($conn);
    }
    return $marks;
}

function question_selection_frompallete($questions){
    $_PACK = $questions[$_SESSION['selected_q_no'] - 1];
    return $_PACK;
}

function question_selection_bynextbtn($questions,$selected_question_no = 1){
    $_PACK = $questions[$selected_question_no];
    return $_PACK;
}

function logout(){
    session_unset();
    session_destroy();

}
?>
