<?php   
   
   function cheacking_answer($conn,$answer_key) {
    $answer = mysqli_real_escape_string($conn,$_POST['answer']);
    $question_no = $_SESSION['selected_q_no'];
    if(($answer_key[$question_no - 1][1] - $answer) != 0){
        $_SESSION['no_of_wrong_qn'] += 1;
        echo "wrong option selected";
    }
    
}
function calculate_and_submit_marks($conn,$total_noof_questions,$marks_of_each_qn){
    $user_id = mysqli_real_escape_string($conn,$_SESSION['user_id']);
    $no_of_wrong_qn = mysqli_real_escape_string($conn,$_SESSION['no_of_wrong_qn']);
    
    $marks = ($total_noof_questions - $no_of_wrong_qn) * $marks_of_each_qn;
    
    $sql3 = "update user_login_data set marks = $marks where id = $user_id";//Updating data in mysql table
    echo $marks;
    echo "<br>" . $user_id . "<br>";
    $result = mysqli_query($conn,$sql3);
    if(isset($result)){
        echo "Data stored succesfully by updating existing data";
    }else{
        echo  "Error: " . $sql3 . "<br>" . mysqli_error($conn);
    }
    return $marks;
}
function question_selection_frompallete($questions){
    #echo " in from pallete function   " . $_SESSION['selected_q_no'] . $_POST['question_no_frompallete'];
    $_PACK = $questions[$_SESSION['selected_q_no'] - 1];
# echo " in from palete function   " . $_PACK[0] . "    ";
    return $_PACK; 
}
function question_selection_bynextbtn($questions,$selected_question_no = 1){
    #echo " in from bynextbuttn function   " . $selected_question_no;
    $_PACK = $questions[$selected_question_no];
    #print($_PACK[0]);
    return $_PACK;
}
function logout(){
    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();
    header("Location: login.php");
}      
?>