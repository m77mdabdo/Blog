<?php
require_once  '../inc/conn.php';

if(isset($_SESSION['user_id'])){
    header('location:../index.php');
    exit();
  }

if(isset($_POST['submit'])){
    $name=trim(htmlspecialchars($_POST['name']));
    $email=trim(htmlspecialchars($_POST['email']));
    $password=trim(htmlspecialchars($_POST['password']));
    $phone=trim(htmlspecialchars($_POST['phone']));

    //validation
    $errors=[];

    //name
    if(empty($name)){
       $errors[]="name is  reqired";
    }elseif(strlen($name)<3){
        $errors[]="name must be at least 3 characters";
    }elseif(strlen($name)>100){
        $errors[]="name must be at less 100";
    }elseif (preg_match('/[^a-zA-Z0-9\s]/', $name)){
        $errors[]="name must not contain special characters";
    }

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
    }elseif(strlen($password)<6){
        $errors[]="password must be at least 6 characters";
    }elseif(strlen($password)>100){
        $errors[]="password must be at less 100";
    }else if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "Password must contain at least one uppercase letter (A-Z)";
    }elseif (!preg_match('/[a-z]/', $password)) {
        $errors[] = "Password must contain at least one lowercase letter (a-z)";
    }elseif (!preg_match('/[0-9]/', $password)) {
        $errors[] = "Password must contain at least one digit (0-9)";
    }elseif (!preg_match('/[\W]/', $password)) {
        $errors[] = "Password must contain at least one special character (@, #, $, %, etc.)";
    }

    //phone
    if(empty($phone)){
        $errors[]="phone is reqired ";
    }
    // elseif (!preg_match('/^\+?[0-9]{10,15}$/', $phone)) {
    //     $errors[] = "Phone number must be between 10 and 15 digits and can start with '+'";
    // }

    $password=password_hash($password,PASSWORD_DEFAULT);
    
    if(empty($errors)){
      $query="INSERT INTO users ( `name`, `email`, `password`, `phone`)
       VALUES ('$name','$email','$password','$phone')";
       $run_Query=mysqli_query($conn,$query);
       if($run_Query){
      
        //session success
        $_SESSION['success']="you registered successfuly";

       
        //header  login
        header("location:../Login.php");

    }else{
        $_SESSION['error']=['not register'];
        header("location:../register.php");
    }
        
    }else{
 
        // $_SESSION['name']=$name;
        // $_SESSION['email']=$email;
        // $_SESSION['password']=$password;
        // $_SESSION['phone']=$phone;
        $_SESSION['errors']=$errors;
        header("location:../register.php");
    }

}else{
    header("location:../register.php");
}