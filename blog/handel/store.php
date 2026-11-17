<?php


require_once '../inc/conn.php';

//authorization
if(!isset($_SESSION['user_id'])){
    header('location:Login.php');
} 

if(isset($_POST['submit'])){
    // trim(htmlspecialchars(extract($_POST)));
    $title=trim(htmlspecialchars($_POST['title']));
    $body=trim(htmlspecialchars($_POST['body']));
    $user_id=1;
   

  


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
  

    /////// image
    $image=$_FILES['image'];
    $image_name=$image['name'];
    $tmpName_image=$image['tmp_name'];
    $image_error=$image['error'];
    $image_size=$image['size']/(1024*1024);

$ext=strtolower(pathinfo($image_name,PATHINFO_EXTENSION));
$nweName= uniqid().time().".$ext";
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

   if(empty($error)){

    $query="INSERT INTO posts ( `title`,`body`, `image`,`user_id` ) VALUES ('$title','$body','$nweName',$user_id)";
    $runQuery=mysqli_query($conn,$query);
    if($runQuery){
        //move
        move_uploaded_file($tmpName_image,"../uplode/$nweName");
        //session success
        $_SESSION['success']=['data inserted successfully'];
        //header 
        header("location:../index.php");

    }else{
        $_SESSION['error']=['error while inserting data'];
        header("location:../inc/404.php");
    }
    
    
   }else{
    $_SESSION ['title']=$title;
    $_SESSION ['body']=$body;
    $_SESSION ['image']=$image;
    $_SESSION['error']=$error;
    header("location:../addPost.php");
   }
  

}else{
    header("location: ../addPost.php");
}


// session_start(); // Start the session
// require_once '../inc/conn.php';

// if (isset($_POST['submit'])) {
//     trim(htmlspecialchars(extract($_POST)));
//     // // Read and sanitize the values from $_POST
//     // $title = trim(htmlspecialchars($_POST['title']));
//     // $body = trim(htmlspecialchars($_POST['body']));
//     // $user_id = 1; // Replace with the real user_id

//     // Handle the image
//     $image = $_FILES['image'];
//     $image_name = $image['name'];
//     $tmpName_image = $image['tmp_name'];
//     $image_error = $image['error'];
//     $image_size = $image['size'] / (1024 * 1024); // Image size in MB

//     $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
//     $newName = uniqid() . time() . ".$ext"; // Generate a unique image name
//     $allowed_types = ["jpg", "jpeg", "png", "gif"]; // Allowed image types

//     // Validate
//     $errors = [];
//     if (empty($title)) {
//         $errors[] = 'Title is required';
//     } elseif (strlen($title) < 3) {
//         $errors[] = 'Title must be at least 3 characters';
//     } elseif (strlen($title) > 100) {
//         $errors[] = 'Title must be less than 100 characters';
//     }elseif (preg_match('/[^a-zA-Z0-9\s]/', $title)){
//         $errors[] = 'Title must not contain special characters';
//     }

//     if (empty($body)) {
//         $errors[] = 'Body is required';
//     } elseif (strlen($body) < 3) {
//         $errors[] = 'Body must be at least 3 characters';
//     } elseif (strlen($body) > 500) {
//         $errors[] = 'Body must be less than 500 characters';
//     }elseif (preg_match('/[^a-zA-Z0-9\s]/', $body)){
//         $errors[] = 'Body must not contain special characters';
//     }

//     if (empty($image_name)) {
//         $errors[] = 'Image is required';
//     } elseif ($image_error != 0) {
//         $errors[] = 'Image error';
//     } elseif (!in_array($ext, $allowed_types)) {
//         $errors[] = 'Image must be jpg, jpeg, png, or gif';
//     } elseif ($image_size > 1) {
//         $errors[] = 'Image size must be less than 1MB';
//     }

//     // If there are no errors
//     if (empty($errors)) {
//         // Insert the data into the database
//         $query = "INSERT INTO posts (`title`, `body`, `image`, `user_id`) VALUES ('$title', '$body', '$newName', '$user_id')";
//         $runQuery = mysqli_query($conn, $query);

//         if ($runQuery) {
//             // Move the image to the uploads folder
//             move_uploaded_file($tmpName_image, "upload/$newName");
//             $_SESSION['success'] = "Post added successfully!";
//         } else {
//             $_SESSION['error'] = "Failed to add post: " . mysqli_error($conn);
//         }
//     } else {
//         // Store the errors and old input in the session
//         $_SESSION['title'] = $title;
//         $_SESSION['body'] = $body;
//         $_SESSION['errors'] = $errors;
//     }

//     // Redirect back to the page
//     header("location:../addPost.php");
//     exit();
// } else {
//     header("location: ../addPost.php");
//     exit();
// }