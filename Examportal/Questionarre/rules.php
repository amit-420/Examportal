<?php 
include('config/db_connect.php');
include('config/session_verification.php');





if(isset($_POST['to_portal'])){

    header('Location: portal.php');
}


?>

<!DOCTYPE HTML> 
<html> 
    <?php
    if($_SESSION['payment_status'] == True and $_SESSION['exam_status'] == false) {?>
    <body> 
        <h4 class="center">Exam Rules</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
        Pellentesque vitae tempus velit, sit amet condimentum lacus. 
        In et mi sit amet augue auctor cursus. Ut ultrices, risus 
        sit amet fermentum volutpat, purus purus eleifend ex, id 
        pharetra erat quam eget nibh. Ut facilisis eget felis 
        condimentum imperdiet. Mauris varius, sapien eget posuere 
        imperdiet, metus eros iaculis nunc, at lacinia ex augue non 
        orci. Proin vitae lobortis eros, laoreet consectetur quam. Orci
         varius natoque penatibus et magnis dis parturient montes, 
         nascetur ridiculus mus. In quis hendrerit mi, nec feugiat 
         sem. Donec a ipsum eu nibh venenatis commodo. Sed non 
         interdum diam, vel scelerisque mi. </p>
         <form>
         <input type="submit" name="to_portal" value="Start the Exam" >
         </form>
    </body>  
    <?php } else if($_SESSION['payment_status'] == false and $_SESSION['exam_status'] == false){?>
        <body> 
        <h4 class="center">Your payment is overdue.</h4>
        <p>Click the button below to pay the fee and resume with exam</p>
         <form>
         <input type="submit" name="to_payment" value="Pay" >
         </form>
    </body>  
    <?php } else if($_SESSION['payment_status'] == true and $_SESSION['exam_status'] == true){?>
        <h4 class="center">We appreciate your enthuciasm but You can give exam only once.</h4>
    <?php }?>

            
           
  

</html> 