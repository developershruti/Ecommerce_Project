<?php include("includes/surya.dream.php");



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("includes/extra_head.inc.php") ?>
</head>

<body class="custom-cursor">
  <?php include("includes/loader.inc.php") ?>
  <!-- Preloader End -->
  <div class="page-wrapper">
    <!-- Main Header -->
    <?php include("includes/header.inc.php") ?>
    <!-- Main Header End -->
    <section class="page-header">
      <div class="page-header__bg"></div>
      <!-- /.page-header__bg -->
      <div class="page-header__shape1"></div>
      <!-- /.page-header__shape1 -->
      <div class="page-header__shape2"></div>
      <!-- /.page-header__shape1 -->
      <div class="page-header__shape3 wow slideInRight" data-wow-delay="300ms"></div>
      <!-- /.page-header__shape3 -->
      <? $page_cate_name = db_scalar("select blog_name from ngo_blog where blog_id='$blog_id' ") ?>
      <div class="container">
        <ul class="page-header__breadcrumb list-unstyled">
          <li><a href="index.php">Home</a></li>
          <li><span>Blog</span></li>
          <!-- <li><span><?= $page_cate_name ?></span></li> -->
        </ul>
        <!-- /.page-breadcrumb list-unstyled -->
        <h2 class="page-header__title"><?= $page_cate_name ?></h2>
        <!-- /.page-title -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /.page-header -->
    <!-- Services Details Start -->
    <section class="services-details">
      <div class="container ">
        <div class="row">
        
          <!-- /.column -->
          <div class="col-xl-8 col-lg-7">
            <div class="services-details__content">
              <div class="services-details__thumb">
                <img src="assets/images/services/service-1.jpg" width="100%" />
              </div>
              <h3 class="services-details__content__title">Blog Title</h3>
              <h4 style="color:#b6ef00;" class="services-details__content__text">Short Description</h4>
              <p class="services-details__content__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet nulla auctor, vestibulum magna sed, convallis ex. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed sit amet nulla auctor, vestibulum magna sed, convallis ex. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>

            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Services Details End -->
    <!-- Footer -->

  </div>

  </section>

  <?php include("includes/footer.inc.php") ?>
  <!-- Footer End -->
  <!--extra Footer -->
  <?php include("includes/extra_footer.inc.php") ?>
  <!--extra Footer End  -->
  </div>
</body>

</html>