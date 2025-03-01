<footer class="main-footer">
            <div class="main-footer__bg" style="background-image: url(assets/images/shapes/footer-bg-1.png);"></div>
            <div class="container">
                <div class="main-footer__top wow fadeInUp" data-wow-delay="100ms">
                    <a href="index.html" class="main-footer__logo">
                        <img src="./assets/images/logo-priyagroup.png" alt="Priya Group" width="200"  >
                    </a><!-- /.footer-logo -->
                    <div class="main-footer__social">
                        <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>
                        <a href="https://www.pinterest.com/"><i class="fab fa-pinterest-p"></i></a>
                        <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                    </div><!-- /.footer-social -->
                </div><!-- footer-top -->
                <div class="row">
                    <div class="col-lg-2 col-md-4 wow fadeInUp" data-wow-delay="200ms">
                        <div class="main-footer__navmenu">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="index.php#about">About</a></li>
                                <li><a href="index.php#services">Services</a></li>
                                <li><a href="index.php#portfolio">Portfolio</a></li>
                            </ul><!-- /.list-unstyled -->
                        </div><!-- /.footer-menu -->
                    </div>
                    <div class="col-lg-2 col-md-4 wow fadeInUp" data-wow-delay="300ms">
                        <div class="main-footer__navmenu">
                            <ul>
                                <li><a href="index.php#testimonial">Testimonial</a></li>
                                <li><a href="blog.php">Blog</a></li>
                                <li><a href="index.php#contact">Contact</a></li>
                               
                            </ul><!-- /.list-unstyled -->
                        </div><!-- /.footer-menu -->
                    </div>


                    <div class="col-lg-3 col-md-4 wow fadeInUp" data-wow-delay="400ms">
                        <div class="main-footer__about">
                        <? 
                            $sql = "select * from ngo_staticpage";
                            $result = db_query($sql);
                            if ($line_raw = mysqli_fetch_array($result)) {
                              
                            } ?>
                            <p class="main-footer__about__text"> <?= $line_raw['ngo_address'];?></p>
                            <ul class="main-footer__about__info">
                            
                                <?php
                                $sql_static = "select * from ngo_staticpage where static_id=3";
                                $result_static = db_query($sql_static);
                                if ($line_raw_static = mysqli_fetch_array($result_static)) {
                                ?>
                                <li><span class="fas fa-phone-square"></span><a href="tel:+923680006800">+91 <?= $line_raw_static['static_desc'];?></a></li>
                                <?php
                                }
                                ?>


                                <?php
                                $sql_email = "select * from ngo_staticpage where static_id=2";
                                $result_email = db_query($sql_email);
                                if ($line_raw_email = mysqli_fetch_array($result_email)) {
                                ?>
                                <li><span class="fas fa-envelope"></span><a href="mailto:<?= $line_raw_email['static_desc']; ?>"><?= $line_raw_email['static_desc']; ?></a></li>
                                <?php
                                }
                                ?>

                            </ul>
                        </div><!-- /.footer-about -->
                    </div>


                    <div class="col-lg-5 col-md-12 wow fadeInUp" data-wow-delay="500ms">
                        <div class="main-footer__newsletter">
                            <h5 class="main-footer__newsletter__text">Subscribe to get latest updates on daily basis</h5>
                            <form class="main-footer__email-box mc-form" data-url="MC_FORM_URL" novalidate="novalidate">
                                <div class="main-footer__email-input-box">
                                    <input type="email" placeholder="Email address" name="EMAIL">
                                </div>
                                <button type="submit" class="nisoz-btn">
                                    <span class="nisoz-btn__shape"></span><span class="nisoz-btn__shape"></span><span class="nisoz-btn__shape"></span><span class="nisoz-btn__shape"></span>
                                    <span class="nisoz-btn__text">Subscribe</span>
                                </button>
                            </form>
                            <div class="mc-form__response"></div>
                        </div><!-- /.footer-mailchimp -->
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container -->
        </footer>


        <section class="copyright text-center">
            <div class="container wow fadeInUp" data-wow-delay="500ms">
                <p class="copyright__text">© Copyright <span class="dynamic-year"></span><!-- /.dynamic-year --> by <a href="index.php">Priya Group</a> !!!</p>
            </div><!-- /.container -->
        </section><!-- /.copyright -->

    </div><!-- /.page-wrapper -->


    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <!-- /.mobile-nav__overlay -->
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>
            <div class="logo-box">
                <a href="index.html" aria-label="logo image"><img src="assets/images/logo-light.png" width="96" height="34" alt="nisoz" /></a>
            </div>
            <!-- /.logo-box -->
            <div class="mobile-nav__container"></div>
            <!-- /.mobile-nav__container -->
            <ul class="mobile-nav__contact list-unstyled">
                   <?php
                                $sql_static = "select * from ngo_staticpage where static_id=3";
                                $result_static = db_query($sql_static);
                                if ($line_raw_static = mysqli_fetch_array($result_static)) {
                                ?>
                                <li><span class="fas fa-phone-square"></span><a href="tel:+923680006800">+91 <?= $line_raw_static['static_desc'];?></a></li>
                                <?php
                                }
                                ?>


                                <?php
                                $sql_email = "select * from ngo_staticpage where static_id=2";
                                $result_email = db_query($sql_email);
                                if ($line_raw_email = mysqli_fetch_array($result_email)) {
                                ?>
                                <li><span class="fas fa-envelope"></span><a href="mailto:<?= $line_raw_email['static_desc']; ?>"><?= $line_raw_email['static_desc']; ?></a></li>
                                <?php
                                }
                                ?>
            </ul><!-- /.mobile-nav__contact -->
            <div class="mobile-nav__social">
                <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>
                <a href="https://www.pinterest.com/"><i class="fab fa-pinterest-p"></i></a>
                <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
            </div><!-- /.mobile-nav__social -->
        </div>
        <!-- /.mobile-nav__content -->
    </div>
    <!-- /.mobile-nav__wrapper -->

    <div class="search-popup">
        <div class="search-popup__overlay search-toggler"></div>
        <!-- /.search-popup__overlay -->
        <div class="search-popup__content">
            <form role="search" method="get" class="search-popup__form" action="#">
                <input type="text" id="search" placeholder="Search Here..." />
                <button type="submit" aria-label="search submit" class="nisoz-btn">
                    <span class="nisoz-btn__shape"></span><span class="nisoz-btn__shape"></span><span class="nisoz-btn__shape"></span><span class="nisoz-btn__shape"></span>
                    <span class="nisoz-btn__text"><i class="icon-magnifying-glass"></i></span>
                </button>
            </form>
        </div>
        <!-- /.search-popup__content -->
    </div>
    <!-- /.search-popup -->
    <!-- back-to-top-start -->
    <a href="#" class="scroll-top">
        <svg class="scroll-top__circle" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </a>