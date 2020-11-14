<?php 
    $conn = mysqli_connect('localhost','amit','amit2424','portal_data');
    
    //check connection
    if(!$conn){
        echo 'Connection error' . mysqli_connect_error();
    }

?>