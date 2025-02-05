<?php 
require_once '../inc/conn.php';

if(isset($_SESSION['user_id'])){
  header('location:../index.php');
  exit();
}

if(isset($_POST['submit'])){
    $email=trim(htmlspecialchars($_POST['email']));
    $password=trim(htmlspecialchars($_POST['password']));
     
    // validation
    $errors=[];
       //email
       if(empty($email)){
        $errors[]="email is  reqired";
     }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors[]="email is not valid";
     }elseif(strlen($email)>100){
        $errors[]="email must be at less 100";
     }elseif (!preg_match('/[^a-zA-Z0-9\s]/', $email)){
        $errors[]="email must not contain special characters";
     
    }

    //password
    if(empty($password)){
      $errors[]="password is  reqired";
    }
    // }elseif(strlen($password)<6){
    //     $errors[]="password must be at least 6 characters";
    // }elseif(strlen($password)>100){
    //     $errors[]="password must be at less 100";
    // }else if (!preg_match('/[A-Z]/', $password)) {
    //     $errors[] = "Password must contain at least one uppercase letter (A-Z)";
    // }elseif (!preg_match('/[a-z]/', $password)) {
    //     $errors[] = "Password must contain at least one lowercase letter (a-z)";
    // }elseif (!preg_match('/[0-9]/', $password)) {
    //     $errors[] = "Password must contain at least one digit (0-9)";
    // }elseif (!preg_match('/[\W]/', $password)) {
    //     $errors[] = "Password must contain at least one special character (@, #, $, %, etc.)";
    // }


    if(empty($errors)){
    //compare email 
    $query="select id , name, email , password from users where email= '$email'";
    $run_Query=mysqli_query($conn,$query);
    if(mysqli_num_rows($run_Query)==1){
        $user=mysqli_fetch_assoc($run_Query);
        $oldpassword=$user['password'];
        $user_id=$user['id'];
        $userName=$user['name'];

        //password verify 
      $is_verify=  password_verify($password,$oldpassword);
      if($is_verify){
        $_SESSION['user_id']=$user_id;
        $_SESSION['success']= "$userName welcome";
        header('location:../index.php');

      }else{
        $_SESSION['error']=['credentials not correct'];
        header('location:../Login.php');

      }

    }else{
        $_SESSION['error']=['credentials not correct'];
        header('location:../Login.php');
    }
    //compare password



}else{
    $_SESSION['error']=$errors;
    header('location:../Login.php');
}
}else{
    header('location:../Login.php');
}
