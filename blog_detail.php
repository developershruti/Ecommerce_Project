<?php include("includes/surya.dream.php");


$blog_id = $_REQUEST['blog_id'];
if ($blog_id != '') {
  $sql = "select * from ngo_blog where blog_id = '$blog_id'";
  $result = db_query($sql);
  if ($line_raw = mysqli_fetch_array($result, MYSQLI_BOTH)) {
    //$line = ms_form_value($line_raw);
    //@extract($line_raw);
    /// $s_ref_userid = db_scalar("select s_username from ngo_services where s_id = '$s_ref_userid'");
  }
}

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
      <div class="container">
        <div class="row">
        <div class="col-xl-4 col-lg-5 wow fadeInUp animated" data-wow-delay="300ms">
            <div class="services-details__sidebar">
              <div class="services-details__services-list">
                <h3 class="services-details__services-title"><? if($blog_id!=''){ ?><?=$blog_name?> <? } else { ?>All Blogs<? } ?></h3>
                <ul class="services-details__services list-unstyled">
                  <?

                  $sql_blog = "select * from  ngo_blog where blog_status='Active' order by blog_id desc  ";  // 
                  $result_blog = db_query($sql_blog);
                  $total_blog = mysqli_num_rows($result_blog);
                  if ($total_blog > 0) {
                    while ($line_service = mysqli_fetch_array($result_blog)) {;
                      $ctr_blog++;
                  ?>
                      <li><a href="blog_detail.php?blog_id=<?=$blog_id?>&blog_id=<?= ($line_service['blog_id']); ?>"><?= ($line_service['blog_name']); ?></a></li>
 

                  <? }
                  } ?>
                  <!-- <li><a href="#">Audit & Assurance</a></li>
                  <li><a href="#">Advisory Services</a></li>
                  <li><a href="#">Risk Management</a></li>
                  <li><a href="#">Corporate Finance</a></li>
                  <li><a href="#">Management Consulting</a></li> -->
                </ul>
              </div>
              <!-- /.service-widget -->
             
              <!-- /.service-widget -->
            </div>
            <!-- /.service-sidebar -->
          </div>

          <!-- /.column -->
          <div class="col-xl-8 col-lg-7 wow fadeInUp animated" data-wow-delay="400ms">
            <div class="services-details__content">
            <?php if (!empty($line_raw['image'])) { ?>
              
              <div class="services-details__thumb">
                <img src="<?= show_thumb(UP_FILES_WS_PATH . '/photo/' . $line_raw['image'], 770, 581, 'resize') ?>" width="100%" />
              </div>
            
            <?php } elseif (!empty($line_raw['video'])) { ?>
              
              <div class="services-details__thumb">
                <video width="100%" controls>
                  <source src="<?= UP_FILES_WS_PATH . '/video/' . $line_raw['video'] ?>" type="video/mp4">
                  Your browser does not support the video tag.
                </video>
              </div>
            
            <?php } ?>

              <h3 class="services-details__content__title"><?= ($line_raw['blog_name']); ?></h3>
              <style>
                p img {
                  margin: 10px !important;
                  border: solid 1px #eee !important;
                }
              </style>
              <h4 style="color:#b6ef00;" class="services-details__content__text"><?= ($line_raw['blog_shortdesc']); ?> </h4>
              <p  class="services-details__content__text"><?= ($line_raw['blog_desc']); ?> </p>



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