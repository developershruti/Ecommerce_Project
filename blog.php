<?php include("includes/surya.dream.php");


?>

<!DOCTYPE html>
<html lang="en">




<head><?php include("includes/extra_head.inc.php") ?></head>

<style>
  .blog-one__item {
    height: 450px;
    /* Set a fixed height */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    overflow: hidden;
  }

  .blog-one__content {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .blog-one__title {
    flex-grow: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    /* Adjust number of lines before cutoff */
    -webkit-box-orient: vertical;
  }
</style>

<body class="custom-cursor">
  <?php include("includes/loader.inc.php") ?>
  <!-- Preloader End  -->
  <div class="page-wrapper">
    <!-- Main Header  -->

    <?php include("includes/header.inc.php") ?>

    <!-- Main Header End  -->

    <section class="page-header">
      <div class="page-header__bg"></div>
      <!-- page-header__bg  -->
      <div class="page-header__shape1"></div>
      <!-- page-header__shape1 -->
      <div class="page-header__shape2"></div>
      <!-- page-header__shape1  -->
      <div class="page-header__shape3 wow slideInRight" data-wow-delay="300ms"></div>
      <!-- page-header__shape3 -->
      <? $page_cate_name = db_scalar("select blog_name from ngo_blog where blog_id='$blog_id' ") ?>
      <div class="container">
        <ul class="page-header__breadcrumb list-unstyled">
          <li><a href="index.php">Home</a></li>
          <li><span>Blog</span></li>
          <!-- <li><span><?= $page_cate_name ?></span></li>  -->
        </ul>
        <!-- page-breadcrumb list-unstyled  -->
        <h2 class="page-header__title"><?= $page_cate_name ?></h2>
        <!-- page-title  -->
      </div>
      <!-- container  -->
    </section>
    <!-- page-header  -->
    <!-- Services Details Start  -->
    <section class="services-details">
      <div class="container">
        <div class="row">
          <?php
          $sql_blog = "SELECT * FROM ngo_blog WHERE blog_status='Active' ORDER BY blog_id   DESC";
          $result_blog = db_query($sql_blog);

          while ($blog = mysqli_fetch_array($result_blog)) {
          ?>
            <div class="col-lg-4 col-md-6">
              <div class="blog-one__item" style="border:1px solid #000;">
                <div class="blog-one__image">
                  <?php if ($blog['blog_type'] == 'image' && file_exists(UP_FILES_FS_PATH . '/photo/' . $blog['image'])) { ?><img
                      src="<?= show_thumb(UP_FILES_WS_PATH . '/photo/' . $blog['image'], 368, 278, 'resize') ?>"
                      alt="<?= $blog['blog_name']  ?>"><?php } elseif ($blog['blog_type'] == 'video' && file_exists(UP_FILES_FS_PATH . '/video/' . $blog['video'])) { ?><video
                      width="100%" controls>
                      <source src="<?= UP_FILES_WS_PATH . '/video/' . $blog['video'] ?>" type="video/mp4">
                      Your browser does not support the video
                      tag.
                    </video><?php } else { ?><img src="assets/images/blog/blog-1-1.jpg"
                      alt="Default Blog Image"><?php } ?><a href=""></a>
                  <div style="color:#b6ef00;" class="blog-one__date">
                    <?= $blog['blog_date'] ?></div>
                  <div class="blog-one__date"><?= $blog['blog_date'] ?>
                  </div>
                  <!-- blog-date -->
                </div>
                <!-- blog-image -->
                <div class="blog-one__content">
                  <div class="blog-one__meta">
                    <div class="blog-one__meta__author">
                      <!-- <div class="blog-one__meta__thumb"><img
                                                                    src="assets/images/blog/author-1.png"
                                                                    alt="Priya Group" />
                                                        </div> -->
                      <?= str_stop(htmlspecialchars($blog['blog_name']), 20); ?><br>
                    </div>
                    <!-- <span class="fas fa-comments"></span>2 Comments  -->
                  </div><br>
                  <!-- blog-meta  -->
                  <h3 class="blog-one__title"><a
                      href="blog_detail.php?blog_id=<?= $blog['blog_id'] ?>"><?= str_stop(htmlspecialchars($blog['blog_shortdesc']), 50); ?></a>
                  </h3>
                  <!-- blog-title -->
                  <a href="blog_detail.php?blog_id=<?= $blog['blog_id'] ?>" class="nisoz-btn"><span
                      class="nisoz-btn__shape"></span><span class="nisoz-btn__shape"></span><span
                      class="nisoz-btn__shape"></span><span class="nisoz-btn__shape"></span><span
                      class="nisoz-btn__text">Read
                      More<span class="icon-right-arrow"></span></span></a>
                  <!-- blog-read-more  -->
                </div>
                <!-- blog-content  -->
              </div>
              <!-- blog-card-one  -->
            </div><?php } ?>
        </div>
      </div>
    </section>
    <!-- Services Details End  -->
    <!-- Footer  -->
  </div>
  </section><?php include("includes/footer.inc.php") ?>
  <!-- Footer End  -->
  <!-- extra Footer -->
  <?php include("includes/extra_footer.inc.php") ?>
  <!-- extra Footer End  -->
  </div>
</body>

</html>