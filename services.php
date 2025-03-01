<?php include("includes/surya.dream.php");

// $s_id = $_REQUEST['s_id'];
// if ($s_id != '') { 
//   $sql = "select * from ngo_services where s_id = '$s_id'";
//   $result = db_query($sql);
//   if ($line_raw = mysqli_fetch_array($result, MYSQLI_BOTH)) {
//     //$line = ms_form_value($line_raw);
//     //@extract($line_raw);
//     /// $s_ref_userid = db_scalar("select s_username from ngo_services where s_id = '$s_ref_userid'");
//   }
// }



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
            <? $page_cate_name = db_scalar("select scate_name from ngo_service_cate where scate_id='$scate_id' ") ?>
            <div class="container">
                <ul class="page-header__breadcrumb list-unstyled">
                    <li><a href="index.php">Home</a></li>
                    <li><span>Services</span></li>
                    <li><span><?= $page_cate_name ?></span></li>
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
                    <?php
                    // Pagination configuration
                    $items_per_page = 12;
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $offset = ($page - 1) * $items_per_page;

                    // Build the query
                    if ($scate_parentid != '') {
                        $sql_service_part = " AND s_scate_sub_id='$scate_id' AND s_scate_id='$scate_parentid' ";
                    } else {
                        $sql_service_part = " AND s_scate_id='$scate_id'";
                    }

                    // Count total records
                    $sql_count = "SELECT COUNT(*) as count FROM ngo_services WHERE 1 " . $sql_service_part . " AND s_status='Active'";
                    $count_result = db_query($sql_count);
                    $total_records = mysqli_fetch_assoc($count_result)['count'];
                    $total_pages = ceil($total_records / $items_per_page);

                    // Main query with pagination
                    $sql_service = "SELECT * FROM ngo_services WHERE 1 " . $sql_service_part . " AND s_status='Active' 
                                  ORDER BY s_id ASC LIMIT $offset, $items_per_page";
                    $result_service = db_query($sql_service);

                    if (mysqli_num_rows($result_service) > 0) {
                        while ($line_service = mysqli_fetch_array($result_service)) {
                            // If you have a creation date field, adjust accordingly (here we assume 's_created')

                            // Use a short description if available, otherwise fallback to title
                            $serviceShortDesc = !empty($line_service['s_shortdesc'])
                                ? $line_service['s_shortdesc']
                                : $line_service['s_title'];
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-one__item" style="border:1px solid #000;">
                            <div class="blog-one__image">
                                <?php if (!empty($line_service['s_image']) && file_exists(UP_FILES_FS_PATH . '/services/' . $line_service['s_image'])) { ?>
                                <img src="<?= show_thumb(UP_FILES_WS_PATH . '/services/' . $line_service['s_image'], 368, 278, 'resize') ?>"
                                    alt="<?= htmlspecialchars($line_service['s_title']); ?>">
                                <?php } else { ?>
                                <img src="assets/images/blog/blog-1-1.jpg" alt="Default Service Image">
                                <?php } ?>
                                <!-- Wrap the image with a link to the service details page -->
                                <a href="services?scate_id=<?= $scate_id ?>&s_id=<?= $line_service['s_id']; ?>"></a>
                                <!-- <div style="color:#b6ef00;" class="blog-one__date"><?= $serviceDate; ?></div> -->
                            </div>
                            <div class="blog-one__content">
                                <div class="blog-one__meta">
                                    <?= str_stop(htmlspecialchars($line_service['s_title']), 50); ?><br>

                                    <div class="blog-one__meta__author">
                                        <!-- <div class="blog-one__meta__thumb">
                      <img src="assets/images/blog/author-1.png" alt="Service Provider" />
                    </div> -->
                                    </div>
                                </div>
                                <br>
                                <h3 class="blog-one__title">
                                    <a
                                        href="services_detail?scate_id=<?= $scate_id ?>&s_id=<?= $line_service['s_id']; ?>">
                                        <?= str_stop(htmlspecialchars($serviceShortDesc), 50); ?>
                                    </a>
                                </h3>
                                <a href="services_detail?scate_id=<?= $scate_id ?>&s_id=<?= $line_service['s_id']; ?>"
                                    class="nisoz-btn">
                                    <span class="nisoz-btn__shape"></span>
                                    <span class="nisoz-btn__shape"></span>
                                    <span class="nisoz-btn__shape"></span>
                                    <span class="nisoz-btn__shape"></span>
                                    <span class="nisoz-btn__text">Read More<span class="icon-right-arrow"></span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    } else {
                        echo '<div class="col-12"><p>No services available.</p></div>';
                    }
                    ?>
                </div>




                <style>
                .page-item.active .page-link {
                    background-color: #b6ef00;
                    border-color: #b6ef00;

                }

                .page-link {
                    color: rgb(3, 3, 3);
                }

                .page-link:hover {
                    color: #b6ef00;
                }
                </style>

                <!-- Pagination -->
                <?php if ($total_pages > 1): ?>
                <div class="row">
                    <div class="col-15">
                        <div class="pagination-block text-center mt-5">
                            <ul class="pagination justify-content-center">

                                <!-- Previous Button -->
                                <?php if ($page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link"
                                        href="?scate_id=<?= $scate_id ?><?= $scate_parentid ? '&scate_parentid=' . $scate_parentid : '' ?>&page=<?= $page - 1 ?>">
                                        ‹ Prev
                                    </a>
                                </li>
                                <?php endif; ?>

                                <!-- Page Numbers with Ellipsis -->
                                <?php
                                    $range = 2; // Show two pages before and after current page
                                    $start = max(1, $page - $range);
                                    $end = min($total_pages, $page + $range);

                                    if ($start > 1) {
                                        echo '<li class="page-item"><a class="page-link" href="?scate_id=' . $scate_id . ($scate_parentid ? '&scate_parentid=' . $scate_parentid : '') . '&page=1">1</a></li>';
                                        if ($start > 2) {
                                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                        }
                                    }

                                    for ($i = $start; $i <= $end; $i++) {
                                        echo '<li class="page-item ' . ($page == $i ? 'active' : '') . '">';
                                        echo '<a class="page-link" href="?scate_id=' . $scate_id . ($scate_parentid ? '&scate_parentid=' . $scate_parentid : '') . '&page=' . $i . '">' . $i . '</a>';
                                        echo '</li>';
                                    }

                                    if ($end < $total_pages) {
                                        if ($end < $total_pages - 1) {
                                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                        }
                                        echo '<li class="page-item"><a class="page-link" href="?scate_id=' . $scate_id . ($scate_parentid ? '&scate_parentid=' . $scate_parentid : '') . '&page=' . $total_pages . '">' . $total_pages . '</a></li>';
                                    }
                                    ?>

                                <!-- Next Button -->
                                <?php if ($page < $total_pages): ?>
                                <li class="page-item">
                                    <a class="page-link"
                                        href="?scate_id=<?= $scate_id ?><?= $scate_parentid ? '&scate_parentid=' . $scate_parentid : '' ?>&page=<?= $page + 1 ?>">
                                        Next ›
                                    </a>
                                </li>
                                <?php endif; ?>

                            </ul>
                        </div>
                    </div>
                </div>
                <?php endif; ?>



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