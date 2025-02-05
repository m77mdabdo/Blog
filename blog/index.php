
<?php require_once 'inc/header.php' ?>
<?php  require_once 'inc/conn.php'; ?>
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <div class="text-content">
            <!-- <h4>Best Offer</h4> -->
            <!-- <h2>New Arrivals On Sale</h2> -->
          </div>
        </div>
        <div class="banner-item-02">
          <div class="text-content">
            <!-- <h4>Flash Deals</h4> -->
            <!-- <h2>Get your best products</h2> -->
          </div>
        </div>
        <div class="banner-item-03">
          <div class="text-content">
            <!-- <h4>Last Minute</h4> -->
            <!-- <h2>Grab last minute deals</h2> -->
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->

    <div class="latest-products">
      <div class="container">
        <div class="row">
          <?php require_once 'inc/success.php'; ?>
          <div class="col-md-12">
            
            <div class="section-heading">
              <h2>Latest Posts</h2>
              <!-- <a href="products.html">view all products <i class="fa fa-angle-right"></i></a> -->
            </div>
          </div>
          <?php
          


           $limit=3;
           if(isset($_GET['page'])){
            $page=$_GET['page'];
           }else{
            $page=1;
           }
// //      total number of posts 
           $query="select count(id) as total from posts";
           $runQuery=mysqli_query($conn,$query);
           $total=mysqli_fetch_assoc($runQuery)['total'];
//     numbeer of pages 
            $nuberOfpages=ceil($total/$limit);

//   check if the page is valid

           if($page>$nuberOfpages){
           header("location: {$_SERVER['PHP_SELF']}?page=$nuberOfpages");
           }elseif($page<1){
            header("location: {$_SERVER['PHP_SELF']}?page=1");
           }

           $offset=($page-1)*$limit;


           $query= "select id , title , substr(`body`,1,48) as body,image ,created_at  from posts limit $limit offset $offset ";
           $runQuery=mysqli_query($conn,$query);
            
           if(mysqli_num_rows($runQuery)>0){
            
            $posts= mysqli_fetch_all($runQuery,MYSQLI_ASSOC);
            if(!empty($posts)){
              
          
            foreach($posts as $post) { ?>

                <div class="col-md-4">
                  <div class="product-item">
                   <a href="#"><img src="uplode/<?php echo  $post['image']?>"  alt=""></a>
                   <div class="down-content">
                <a href="#"><h4><?php echo  $post['title']?></h4></a>
                <h7><?php echo  $post ['created_at'] ?></h7>
                <p> <?php echo  $post['body']?></p>
               
                <div class="d-flex justify-content-end">
                  <a href="viewPost.php?id=<?php echo  $post['id']?>" class="btn btn-info "> view</a>
                </div>
                
              </div>
            </div>
                </div>
          <?php  }


           }else{
            $msg="No posts found";
            // header("location:inc/404.php");
           }
          }else{
            echo $msg;
          }

           ?>


         
         

        </div>
      </div>
    </div>

 <div class="container d-flex justify-content-center">

       <nav aria-label="Page navigation example">
       <ul class="pagination">
      <li class="page-item  
      <?php 
      // check if the page is the first page
      if($page==1)echo "disabled";
      ?>
      ">
        <a class="page-link" href="<?php echo $_SERVER['PHP_SELF']."?page=".($page-1) ?>" ?>">Previous</a></li>
      <li class="page-item"><a class="page-link" href="<?php echo $_SERVER['PHP_SELF']."?page=".($page+1) ?>">1</a></li>
      <li class="page-item"><a class="page-link" href="<?php echo $_SERVER['PHP_SELF']."?page=".($page+1) ?>">2</a></li>
      <li class="page-item"><a class="page-link" href="<?php echo $_SERVER['PHP_SELF']."?page=".($page+1) ?>">3</a></li>
      <li class="page-item
        <?php
        // check if the page is the last page
        if($page==$nuberOfpages)echo "disabled";
        ?>
      ">
      <a class="page-link" href="<?php echo $_SERVER['PHP_SELF']."?page=".($page+1) ?>" ?>">Next</a></li>
        </ul>
        </nav>  
  </div>
    
<?php require_once 'inc/footer.php' ?>
