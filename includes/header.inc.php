<section class="topbar">
    <div class="container-fluid">
        <div class="topbar__wrapper">
            <ul class="list-unstyled topbar__list">
                <li> <span class="fas fa-envelope"></span> <a href="mailto:needhelp@company.com">priya.reg@gmail.com</a>
                </li>
                <li> <span class="fas fa-map-marker"></span> 7/11, Sahara-II, Rajendra Nagar, Sector-5, Sahibabad,
                    (Near HDFC Bank)Ghaziabad-201005, U.P., India </li>
            </ul>
            <!-- /.icon-box -->
            <ul class="list-unstyled topbar__menu">
                <li><a href="#">Help</a></li>
                <li><a href="#">Support</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <!-- /.list-menu -->
            <div class="topbar__social"> <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a> <a
                    href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a> <a
                    href="https://www.pinterest.com/"><i class="fab fa-pinterest-p"></i></a> <a
                    href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a> </div>
            <!-- /.social-links -->
        </div>
    </div>
</section>
<!-- /.topbar-header -->
<header class="main-header">
    <nav class="main-menu">
        <div class="container-fluid">
            <div class="main-menu__logo"> <a href="index.php"> <img src="assets/images/priya.png" width="140"
                        alt="<?= SITE_NAME ?>"> </a> </div>
            <!-- /.main-menu__logo -->
            <div class="main-menu__nav">
                <ul class="main-menu__list one-page-scroll-menu">
                    <li class="scrollToLink current"><a href="index.php">Home</a></li>
                    <li class="scrollToLink"><a href="index.php#about">About</a></li>
                    <!-- <li class="scrollToLink"><a href="index.php#services">Services</a></li> -->
                    <li class="dropdown"><a href="services_cate.php">Services</a>
                        <ul class="sub-menu">
                            <?php
                            // Fetch main categories where scate_parentid is NULL
                            $sql_scate = "SELECT scate_id, scate_name FROM ngo_service_cate WHERE scate_status='Active' AND scate_parentid IS NULL ORDER BY scate_id ASC";
                            $result_scate = db_query($sql_scate);

                            if (mysqli_num_rows($result_scate) > 0) {
                                while ($line_scate = mysqli_fetch_array($result_scate)) {
                                    $first_service_id = db_scalar("SELECT s_id FROM ngo_services WHERE s_scate_id='{$line_scate['scate_id']}' AND s_status='Active' ORDER BY s_id ASC");
                            ?>
                            <li>
                                <a
                                    href="services?scate_id=<?= $line_scate['scate_id']; ?>&s_id=<?= $first_service_id ?>">
                                    <?= $line_scate['scate_name']; ?>
                                </a>

                                <?php
                                        // If this category is "Certification", fetch its subcategories
                                        if ($line_scate['scate_id'] == 1) {
                                            $sql_subcate = "SELECT scate_id,scate_parentid, scate_name FROM ngo_service_cate WHERE scate_status = 'Active' AND scate_parentid = '$line_scate[scate_id]' ORDER BY scate_id ASC";
                                            $result_subcate = db_query($sql_subcate);

                                            if (mysqli_num_rows($result_subcate) > 0) {
                                                echo '<ul class="sub-menu">';
                                                while ($line_subcate = mysqli_fetch_array($result_subcate)) {
                                                    $sub_service_id = db_scalar("SELECT s_id FROM ngo_services WHERE s_scate_sub_id='{$line_subcate['scate_id']}' AND s_status='Active' AND s_title != 'Product Certification' ORDER BY s_id ASC");
                                        ?>
                            <li>
                                <!-- &s_id=<? ///= $sub_service_id 
                                                    ?> -->
                                <a
                                    href="services?scate_id=<?= $line_subcate['scate_id']; ?>&scate_parentid=<?= $line_subcate['scate_parentid']; ?>">
                                    <?= $line_subcate['scate_name']; ?>
                                </a>
                            </li>
                            <?php
                                                }
                                                echo '</ul>';
                                            }
                                        }
                        ?>
                    </li>
                    <?php
                                }
                            }
            ?>
                </ul>
                </li>






                <li class="scrollToLink"><a href="index.php#portfolio">Portfolio</a></li>
                <li class="scrollToLink"><a href="index.php#testimonial">Testimonial</a></li>
                <li class="scrollToLink"><a href="blog.php">Blog</a></li>
                <li class="dropdown"> <a href="#">Customer Panel</a>
                    <ul class="sub-menu">
                        <li><a href="login.php">Customer Login</a></li>
                        <li><a href="register.php">Customer Registration</a></li>
                    </ul>
                </li>
                <!-- <li class="scrollToLink"><a href="login.php"></a></li> -->
                </ul>
            </div>
            <div class="main-menu__right"> <a href="#" class="main-menu__toggler mobile-nav__toggler"> <i
                        class="fa fa-bars"></i> </a>
                <!-- /.mobile menu btn -->
                <a href="tel:+919716550547" class="main-menu__phone"> <i class="icon-telephone"></i> +91 9716550547 </a>
                <!-- /.phone-number -->
                <a href="#" class="main-menu__search search-toggler"> <i class="icon-magnifying-glass"></i> </a>
                <!-- /.search btn -->
                <!-- <a href="#" class="main-menu__cart cart-toggler"> <i class="icon-shopping-cart"></i> <span
                        class="main-menu__cart__count">0</span> </a> -->
                <!-- /.cart btn -->
            </div>
            <!-- /.main-menu__right -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- /.main-menu -->
</header>
<!-- /.main-header -->
<!-- Main Header End -->
<div class="stricky-header stricked-menu main-menu">
    <div class="sticky-header__content"></div>
    <!-- /.sticky-header__content -->
</div>
<!-- /.stricky-header -->