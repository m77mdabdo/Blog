<!DOCTYPE html>
<?php  
 session_start();

// if(isset($_SESSION['lang'])){
//   if($_SESSION['lang']=="ar"){
//     require_once 'message_ar.php';
//   }else{
//     require_once 'message_en.php';
//   }

// }else{
//   require_once 'message_en.php';
// }


?>

<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Blog</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--

    TemplateMo 546 Sixteen Clothing

    https://templatemo.com/tm-546-sixteen-clothing

    -->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">

  </head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader" >
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="padding-0">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.php"><h2> <em>Blog</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">All Posts
                  <span class="sr-only">(current)</span>
                </a>
              </li> 
              <?php if(isset($_SESSION['user_id'])): ?>
              <li class="nav-item">
                <a class="nav-link" href="addPost.php">Add Post</a>
              </li>
              <?php endif; ?>
              <li class="nav-item">
                <a class="nav-link" href="inc/changeLang.php?lang=en">English</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="inc/changeLang.php?lang=ar">العربية</a>
                <?php 
               
                if(isset($_SESSION['user_id'])):
                ?>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="handel/logout.php">Logout</a>
             
              </li>
              <li class="nav-item">
               
              </li>
              <?php 
              else:
              ?>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
                <a class="nav-link" href="handel/register.php">Register</a>
              </li>
              <?php endif ; ?>
              <li class="nav-item">
              
                <a class="nav-link" href="handel/register.php">Register</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>