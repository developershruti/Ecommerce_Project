<?php include("includes/surya.dream.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes/extra_head.inc.php") ?>
</head>


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

            <div class="container">
                <ul class="page-header__breadcrumb list-unstyled">
                    <li><a href="index.php">Home</a></li>
                    <li><span>Services Category</span></li>
                    <!-- <li><span>Services Category</span></li> -->
                </ul>
                <!-- /.page-breadcrumb list-unstyled -->
                <h2 class="page-header__title">Services Category</h2>
                <!-- /.page-title -->
            </div>
            <!-- /.container -->
        </section>
        <!-- /.page-header -->
        <!-- Services Details Start -->
        <section class="services-details">
            <div class="container">

                <div class="row">
                    <?php
                    $sql_service_cate = "SELECT * FROM  ngo_service_cate WHERE scate_status='Active' ORDER BY scate_id  asc";
                    $result_service_cate = db_query($sql_service_cate);

                    while ($service_cate = mysqli_fetch_array($result_service_cate)) {
                    ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="blog-one__item" style="border:1px solid #000;">
                                <div class="blog-one__image">


                                    <?php if (file_exists(UP_FILES_FS_PATH . '/servicescategory/' . $service_cate['scate_image'])) { ?>
                                        <img src="<?= show_thumb(UP_FILES_WS_PATH . '/servicescategory/' . $service_cate['scate_image'], 368, 278, 'resize') ?>"
                                            alt="<?= $service_cate['scate_name']  ?>">
                                    <?php } else { ?>
                                        <img src="assets/images/blog/blog-1-1.jpg" alt="Default Blog Image">
                                    <?php } ?>



                                    <a href=""></a>
                                    <!-- <div style="color:#b6ef00;" class="blog-one__date"> <?= $service_cate['scate_datetime'] ?> </div> -->
                                    <!-- <div class="blog-one__date"> <?= $blog['blog_date'] ?> </div> -->
                                    <!-- /.blog-date -->
                                </div>
                                <!-- /.blog-image -->
                                <div class="blog-one__content">
                                    <div class="blog-one__meta">
                                        <div class="blog-one__meta__author">
                                            <!-- <div class="blog-one__meta__thumb">
                          <img src="assets/images/blog/author-1.png" alt="Priya Group" />
                        </div> -->

                                            <?= $service_cate['scate_name'] ?><br>

                                        </div>
                                        <!-- <span class="fas fa-comments"></span>2 Comments -->
                                    </div> <br>
                                    <!-- /.blog-meta -->

                                    <h3 class="blog-one__title">
                                        <a
                                            href="services.php?scate_id=<?= $service_cate['scate_id'] ?>"><?= $service_cate['scate_name'] ?></a>
                                    </h3>

                                    <!-- /.blog-title -->

                                    <a href="services.php?scate_id=<?= $service_cate['scate_id'] ?>" class="nisoz-btn">
                                        <span class="nisoz-btn__shape">

                                        </span><span class="nisoz-btn__shape">

                                        </span><span class="nisoz-btn__shape">

                                        </span><span class="nisoz-btn__shape">

                                        </span> <span class="nisoz-btn__text">Read More<span
                                                class="icon-right-arrow"></span></span> </a>
                                    <!-- /.blog-read-more -->
                                </div>
                                <!-- /.blog-content -->
                            </div>
                            <!-- /.blog-card-one -->
                        </div>
                    <?php } ?>


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