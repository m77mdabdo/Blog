<?php
session_start();


if (isset($_SESSION['error'])) {
    
    foreach ($_SESSION['error'] as $err) {?>

        
  <div class="alert alert-denger "> <?php echo $err ."<br>"; ?></div>
  <?php  }
   
    unset($_SESSION['error']); 
}
?>