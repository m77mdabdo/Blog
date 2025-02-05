<?php
require_once '../inc/conn.php';

if(!isset($_SESSION['user_id'])){
    header('location:Login.php');
    exit();
}

if(isset($_POST['submit'])){
    if(isset($_GET['id'])){
        $id=$_GET['id'];


        $query="select image from posts where id=$id";
        $run_Query=mysqli_query($conn,$query);
        if(mysqli_num_rows($run_Query)==1){

            $oldImage =   mysqli_fetch_assoc($run_Query)['image'];

             $query="DELETE FROM `posts` WHERE id=$id";
            $run_Query=mysqli_query($conn,$query);
                if($run_Query){
                    if(! empty($oldImage)){
                        unlink("../uplode/$oldImage");
                    }
                    $_SESSION['success'] = "post deleted successfuly";
                    header("location:../index.php");
                }else{
                    $_SESSION['errors'] = "error while delete";
                    header("location:../index.php");
                }
               
           

        }else{
            header("location:../inc/404.php");
        }
      
      
    }else{
        header("location:../inc/404.php");
    }

}else{
    header("location:../inc/404.php");
}

            