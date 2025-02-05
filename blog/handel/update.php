<?php 
require_once '../inc/conn.php';
require_once '../inc/success.php';

if(!isset($_SESSION['user_id'])){
    header('location:Login.php');
}

if(isset($_GET['id'])&& isset($_POST['submit'])){
     $id=$_GET['id'];

     //query 
     $query="SELECT image from posts where id=$id";
     $run_Query=mysqli_query($conn ,$query);
     if(mysqli_num_rows($run_Query)==1){
        $oldImage=mysqli_fetch_assoc($run_Query)['image'];
         // 
        $title=trim(htmlspecialchars($_POST['title']));
        $body=trim(htmlspecialchars($_POST['body']));

        //valdetion
        $error=[];
        if(empty( $title)){
            $error[]='title is required';
        }elseif(strlen($title)<3){
            $error[]='title must be at least 3 characters';
        }elseif(strlen($title)>100){
            $error[]='title must be at less 100';
        }elseif (preg_match('/[^a-zA-Z0-9\s]/', $title)){
            $error[]='title must not contain special characters';
        }
    
    
        if(empty( $body)){
            $error[]='body is required';
        }elseif(strlen($body)<3){
            $error[]='body must be at least 3 characters';
        }elseif(strlen($body)>1000){
            $error[]='body must be at less 500';
        }
        // elseif (preg_match('/[^a-zA-Z0-9\s]/', $body)){
        //     $error[]='body must not contain special characters';
        // }


        //image optional
 if(!empty($_FILES['image']['name'])){
              /////// image
    $image=$_FILES['image'];
    $image_name=$image['name'];
    $tmpName_image=$image['tmp_name'];
    $image_error=$image['error'];
    $image_size=$image['size']/(1024*1024);

    $ext=strtolower(pathinfo($image_name,PATHINFO_EXTENSION));
    $newName= uniqid().time().".$ext";
    $type=["jpg,jpeg,png,gif,"];

     if(empty($image)){
       $error[]='image is reqired';
       }
      elseif($image_error !=0){
       $error[]='Image error';

     }elseif(!in_array( $ext ,$type)){
       $errors[]="Image must be jpg,jpeg,png,gif";
    }else if($image_size>1){
       $errors[]="Image size must be less than 1MB";
    }

 }else{
    $newName=$oldImage;
 }

 if(empty($error)){
    $query="UPDATE posts set `title`='$title' , `body`='$body' , `image`='$newName' where id=$id";
    $run_Query=mysqli_query($conn, $query);
    if($run_Query){
        /////// image update
        if(!empty($_FILES['image']['name'])){
                unlink("../uplode/$oldImage");
                move_uploaded_file($tmpName_image,"../uplode/$newName");
        }
        $_SESSION['success'] = "post updated successfuly";
        header("location:../viewPost.php?id=$id");

    }else{
        $_SESSION['error']=['error while update '];
        header("locatio: ../editPost.php?id=$id");
    }
    //    $_SESSION['success']="post update successfuly";
    //    header("location: ../viewPost.php?id=$id ");
 }else{
      $_SESSION['error']=$error;
     header("location: ../editPost.php?id=$id");
 }


     }else{
        header("location:../inc/404.php");
     }
}else{
    header("location:../inc/404.php");
}