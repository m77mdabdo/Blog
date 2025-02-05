<?php require_once 'inc/header.php'; ?>

<?php
//authorization
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:Login.php');
    exit();
}
?>

<!-- Page Content -->
<div class="page-heading products-heading header-text">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-content">
                    <h4>New Post</h4>
                    <h2>Add New Personal Post</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// session_start();


if (isset($_SESSION['error'])) {
    
    foreach ($_SESSION['error'] as $err) {?>

        
  <div class="alert alert-denger "> <?php echo $err ."<br>"; ?></div>
  <?php  }
   
    unset($_SESSION['error']);
}
?>

<div class="container w-50">
 
    <div class="d-flex justify-content-center">
        <h3 class="my-5">Add New Post</h3>
    </div>
    <form method="POST" action="handel/store.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php if(isset($_SESSION['title'])) echo($_SESSION['title']) ;unset($_SESSION['title']) ?>">
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea class="form-control" id="body" name="body" rows="5"><?php if(isset($_SESSION['body'])) echo($_SESSION['body']) ;unset($_SESSION['body'])  ?></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>

<?php require_once 'inc/footer.php'; ?>