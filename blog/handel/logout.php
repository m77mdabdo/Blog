<?php
//unset 
//destroy  
session_start();
if(isset($_SESSION['user_id'])){
unset($_SESSION['user_id']);
header('location:../Login.php');

}else{
    header('location:../Login.php');
}
