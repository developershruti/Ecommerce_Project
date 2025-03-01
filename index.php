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
    <!--Main Slider Start-->
    <section class="main-slider" id="home">
      <div class="main-slider__one nisoz-owl__carousel owl-carousel" data-owl-options='{
		"loop": true,
		"animateOut": "slideOutDown",
		"animateIn": "fadeIn",
		"items": 1,
		"smartSpeed": 1000, 
        "autoplay": true, 
        "autoplayTimeout": 6000, 
		"autoplayHoverPause": true,
		"nav": false,
		"dots": true,
		"margin": 0
	    }'>

        <?php
        // Fetch slider data from database
        $sql_slider = "SELECT * FROM ngo_slider WHERE status='Active' ORDER BY slider_id DESC";
        $result_slider = db_query($sql_slider);

        while ($slider = mysqli_fetch_array($result_slider)) {
        ?>
          <div class="item">
            <div class="main-slider__item">
              <div class="main-slider__shape-1"> <img src="assets/images/shapes/slider-1-bg-1.png" alt="Priya Group"> </div>
              <div class="main-slider__shape-2"> <img src="assets/images/shapes/slider-1-shape-1.png" alt="Priya Group"> </div>
              <div class="main-slider__shape-3">
                <?php if ($slider['slider_image'] != '') { ?>
                  <img src="<?= UP_FILES_WS_PATH . '/slider/' . $slider['slider_image'] ?>" alt="<?= $slider['slider_title'] ?>">
                <?php } ?>
              </div>
              <div class="main-slider__shape-4"> <img src="assets/images/shapes/slider-1-shape-2.png" alt="Priya Group"> </div>

              <div class="container">
                <div class="row">
                  <div class="col-xl-8">
                    <div class="main-slider__content">
                      <h2 class="main-slider__title"><?= $slider['slider_title'] ?></h2>
                      <p class="main-slider__text"><?= $slider['slider_subtitle'] ?></p>
                      <p class="about-one__content__text"><?= $slider['slider_shortdesc'] ?></p>

                      <?php if ($slider['slider_button'] != '') { ?>
                        <div class="main-slider__btn">
                          <a href="#" class="nisoz-btn">
                            <span class="nisoz-btn__shape"></span>
                            <span class="nisoz-btn__shape"></span>
                            <span class="nisoz-btn__shape"></span>
                            <span class="nisoz-btn__shape"></span>
                            <span class="nisoz-btn__text"><?= $slider['slider_button'] ?></span>
                          </a>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>

      </div>
    </section>
    <!--Main Slider End-->
    <!-- About Start -->
    <section class="about-one" style="background-image: url(assets/images/shapes/about-1-bg-1.png);" id="about">
      <div class="container">
        <div class="row">
          <div class="col-xl-6">
            <div class="about-one__thumb">
              <!-- about thumb start -->
              <div class="about-one__thumb__one wow fadeInLeft" data-wow-delay="200ms"> <img src="assets/images/resources/about-1-1.jpg" alt="Priya Group"> </div>
              <div class="about-one__thumb__two nisoz-tilt" data-tilt-options='{ "glare": false, "maxGlare": 0, "maxTilt": 10, "speed": 700, "scale": 1 }'> <img src="assets/images/resources/about-1-2.jpg" alt="Priya Group"> </div>
              <div class="about-one__fact-wrapper wow fadeInUp" data-wow-delay="400ms">
                <div class="about-one__fact">
                  <div class="about-one__fact__icon"><span class="icon-expertise"></span></div>
                  <!-- /.fact-one__icon -->
                  <div class="about-one__fact__count"> <span class="count-box"> <span class="count-text" data-stop="30" data-speed="1500"></span> </span>+ </div>
                  <!-- /.fact-one__count -->
                  <h3 class="about-one__fact__title">Years Experience</h3>
                  <!-- /.fact-one__title -->
                </div>
                <!-- /.fact-item -->
                <div class="about-one__fact">
                  <div class="about-one__fact__icon"><span class="icon-development"></span></div>
                  <!-- /.fact-one__icon -->
                  <div class="about-one__fact__count"> <span class="count-box"> <span class="count-text" data-stop="28" data-speed="1500"></span> </span>+ </div>
                  <!-- /.fact-one__count -->
                  <h3 class="about-one__fact__title">experienced team</h3>
                  <!-- /.fact-one__title -->
                </div>
                <!-- /.fact-item -->
              </div>
            </div>
            <!-- about thumb end -->
          </div>
          <div class="col-xl-6">
            <div class="about-one__content">
              <!-- about content start-->
              <div class="section-title">
                <div class="section-title__triangle"> <span class="section-title__triangle-left"></span> <span class="section-title__triangle-right"></span> </div>
                <h5 class="section-title__tagline">about Priyagroup</h5>
                <h2 class="section-title__title">We provide solutions for your creative business needs</h2>
              </div>
              <!-- section-title -->
              <p class="about-one__content__text"> We specialize in delivering tailored solutions that enhance your creative business, helping you achieve your goals with innovative strategies, expert guidance, and unparalleled support. </p>
              <div class="row">
                <div class="col-md-6">
                  <div class="about-one__box">
                    <div class="about-one__box__top">
                      <h4 class="about-one__box__title">get free consultation</h4>
                      <div class="about-one__box__icon"><span class="icon-customer-support"></span></div>
                    </div>
                    <p class="about-one__box__text">Receive a complimentary consultation at no charge.</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="about-one__box">
                    <div class="about-one__box__top">
                      <h4 class="about-one__box__title">High quality projects</h4>
                      <div class="about-one__box__icon"><span class="icon-good-quality"></span></div>
                    </div>
                    <p class="about-one__box__text">Premium, top-tier, high-standard projects.</p>
                  </div>
                </div>
              </div>
              <!--<div class="about-one__progress">
              <h4 class="about-one__progress--title">Strategic Financial Planning</h4>
              <div class="about-one__progress--bar">
                <div class="about-one__progress--inner count-bar" data-percent="77%">
                  <div class="about-one__progress--number count-text">77%</div>
                </div>
              </div>
            </div>-->
              <!-- /.skills-item -->
              <a href="#" class="nisoz-btn mt-5"> <span class="nisoz-btn__shape"></span><span class="nisoz-btn__shape"></span><span class="nisoz-btn__shape"></span><span class="nisoz-btn__shape"></span> <span class="nisoz-btn__text">Discover More</span> </a>
              <!-- /.btn -->
            </div>
            <!-- about content end-->
          </div>
        </div>
      </div>
    </section>
    <!-- About End -->
    <div class="client-carousel @@extraClassName">
      <div class="container">
        <h5 class="client-carousel__tilte"><span>1K+ Brands Trust Us</span></h5>
        <!-- section-title -->
        <div class="client-carousel__one nisoz-owl__carousel owl-theme owl-carousel" data-owl-options='{
            "items": 5,
            "margin": 65,
            "smartSpeed": 700,
            "loop":true,
            "autoplay": 6000,
            "nav":false,
            "dots":false,
            "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
            "responsive":{
                "0":{
                    "items":1,
                    "margin": 0
                },
                "360":{
                    "items":2,
                    "margin": 0
                },
                "575":{
                    "items":3,
                    "margin": 30
                },
                "768":{
                    "items":3,
                    "margin": 40
                },
                "992":{
                    "items": 4,
                    "margin": 40
                },
                "1200":{
                    "items": 5
                }
            }
            }'>
          <div class="client-carousel__one__item"> <img src="assets/images/brand/brand-img-not-found.png" alt="Priya Group"> </div>
          <!-- /.owl-slide-item-->
          <div class="client-carousel__one__item"> <img src="assets/images/brand/brand-img-not-found.png" alt="Priya Group"> </div>
          <!-- /.owl-slide-item-->
          <div class="client-carousel__one__item"> <img src="assets/images/brand/brand-img-not-found.png" alt="Priya Group"> </div>
          <!-- /.owl-slide-item-->
          <div class="client-carousel__one__item"> <img src="assets/images/brand/brand-img-not-found.png" alt="Priya Group"> </div>
          <!-- /.owl-slide-item-->
          <div class="client-carousel__one__item"> <img src="assets/images/brand/brand-img-not-found.png" alt="Priya Group"> </div>
          <!-- /.owl-slide-item-->
          <div class="client-carousel__one__item"> <img src="assets/images/brand/brand-img-not-found.png" alt="Priya Group"> </div>
          <!-- /.owl-slide-item-->
          <div class="client-carousel__one__item"> <img src="assets/images/brand/brand-img-not-found.png" alt="Priya Group"> </div>
          <!-- /.owl-slide-item-->
          <div class="client-carousel__one__item"> <img src="assets/images/brand/brand-img-not-found.png" alt="Priya Group"> </div>
          <!-- /.owl-slide-item-->
          <div class="client-carousel__one__item"> <img src="assets/images/brand/brand-img-not-found.png" alt="Priya Group"> </div>
          <!-- /.owl-slide-item-->
          <div class="client-carousel__one__item"> <img src="assets/images/brand/brand-img-not-found.png" alt="Priya Group"> </div>
          <!-- /.owl-slide-item-->
          <div class="client-carousel__one__item"> <img src="assets/images/brand/brand-img-not-found.png" alt="Priya Group"> </div>
          <!-- /.owl-slide-item-->
        </div>
        <!-- /.thm-owl__slider -->
      </div>
      <!-- /.container -->
    </div>
    <!-- /.client-carousel -->
    <!-- Service Start -->

    <section class="service-one" style="background-image: url(assets/images/shapes/service-bg-1.jpg);" id="services">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-title text-center">
              <div class="section-title__triangle"> <span class="section-title__triangle-left"></span> <span class="section-title__triangle-right"></span> </div>
              <h5 class="section-title__tagline">our services</h5>
              <h2 class="section-title__title">what we offer</h2>
            </div>
            <!-- section-title -->
          </div>
        </div>
        <div class="row">
          <?



          $sql_service = "select * from ngo_services where s_status='Active' order by rand() limit 0,3 ";
          $result_service = db_query($sql_service);
          $total_service = mysqli_num_rows($result_service);
          if ($total_service > 0) {
            while ($line_service = mysqli_fetch_array($result_service)) {;
              $ctr_service++;
          ?>
              <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                <a href="services?scate_id=<?= $line_service['s_scate_id'] ?>&s_id=<?= ($line_service['s_id']); ?>">
                  <div class="service-one__item">
                    <div class="service-one__item__wrapper">
                      <div class="service-one__item__hover" style="background-image: url(assets/images/shapes/service-1-hover-shape.png);"></div>
                      <div class="service-one__item__number">Service </div>
                      <!-- /.service-number -->
                      <div class="clearfix"></div>
                      <? ///= UP_FILES_WS_PATH . '/services/' . $line_service['s_image'] 
                      ?>
                      <div class="service-one__item__icon"><? if ($line_service['s_image'] != '') { ?><img src="<?= show_thumb(UP_FILES_WS_PATH . '/services/' . $line_service['s_image'], 1000, 1000, 'resize') ?>" width="100%" />

                        <? } else {  ?>
                          <img src="backend-assets/images/services-not-available.png" width="100%" />
                        <? }  ?>

                      </div>
                      <!-- /.service-icon -->
                      <h3 class="service-one__item__title"> <?= ($line_service['s_title']); ?> </h3>
                      <!-- /.service-title -->
                      <!--<p class="service-one__item__text"><? ///=str_stop($line_service['s_description'], 300);
                                                              ?> </p>-->
                      <!-- /.service-content -->
                    </div>
                  </div>
                </a>
                <!-- /.service-card-one -->
              </div>

            <? }
            ?>

            <?php /*?><div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="200ms">
          <div class="service-one__item">
            <div class="service-one__item__wrapper">
              <div class="service-one__item__hover" style="background-image: url(assets/images/shapes/service-1-hover-shape.png);"></div>
              <div class="service-one__item__number">Service</div>
              <!-- /.service-number -->
              <div class="clearfix"></div>
              <div class="service-one__item__icon"> <span class="icon-website-development"></span> </div>
              <!-- /.service-icon -->
              <h3 class="service-one__item__title"> <a href="#">Customized project solutions</a> </h3>
              <!-- /.service-title -->
              <p class="service-one__item__text">Tailored project solutions to meet your specific needs.</p>
              <!-- /.service-content -->
            </div>
          </div>
          <!-- /.service-card-one -->
        </div>
        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="300ms">
          <div class="service-one__item">
            <div class="service-one__item__wrapper">
              <div class="service-one__item__hover" style="background-image: url(assets/images/shapes/service-1-hover-shape.png);"></div>
              <div class="service-one__item__number">Service</div>
              <!-- /.service-number -->
              <div class="clearfix"></div>
              <div class="service-one__item__icon"> <span class="icon-mobile-application"></span> </div>
              <!-- /.service-icon -->
              <h3 class="service-one__item__title"> <a href="#">Innovative design and development</a> </h3>
              <!-- /.service-title -->
              <p class="service-one__item__text">Cutting-edge design and development solutions.</p>
              <!-- /.service-content -->
            </div>
          </div>
          <!-- /.service-card-one -->
        </div>
        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="400ms">
          <div class="service-one__item">
            <div class="service-one__item__wrapper">
              <div class="service-one__item__hover" style="background-image: url(assets/images/shapes/service-1-hover-shape.png);"></div>
              <div class="service-one__item__number">Service</div>
              <!-- /.service-number -->
              <div class="clearfix"></div>
              <div class="service-one__item__icon"> <span class="icon-digital-marketing"></span> </div>
              <!-- /.service-icon -->
              <h3 class="service-one__item__title"> <a href="#">Top-tier project management.</a> </h3>
              <!-- /.service-title -->
              <p class="service-one__item__text">High-standard project management services.</p>
              <!-- /.service-content -->
            </div>
          </div>
          <!-- /.service-card-one -->
        </div><?php */ ?>
        </div>
        <div class="text-center wow fadeInUp" data-wow-delay="500ms">
          <?
            $first_scate_id = db_scalar("select scate_id from ngo_service_cate where scate_status='Active' order by scate_id ");
            $first_s_id = db_scalar("select s_id from ngo_services where s_status='Active' and s_scate_id='$first_scate_id' order by s_id asc ");
          ?>

          <h5 class="service-one__text"> Customized digital agency services tailored for your business. <a href="services?scate_id=<?= $first_scate_id ?>&s_id=<?= $first_s_id; ?>" class="nisoz-btn"> <span class="nisoz-btn__shape"></span><span class="nisoz-btn__shape"></span><span class="nisoz-btn__shape"></span><span class="nisoz-btn__shape"></span> <span class="nisoz-btn__text">View All Services</span> </a>
            <!-- /.btn -->
          </h5>
        </div>
      </div>
    </section>
  <? } ?>
  <!-- Service Start -->
  <!-- Call To Action Start -->
  <section class="cta-one jarallax" data-jarallax data-speed="0.3" data-imgPosition="50% -100%">
    <div class="cta-one__bg jarallax-img" style="background-image: url(assets/images/backgrounds/cta-bg-1.jpg);"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-xl-8 wow fadeInLeft" data-wow-delay="200ms">
          <div class="section-title">
            <h2 class="section-title__title">Flourish with Community and Unleash Boundless Potential.</h2>
          </div>
          <!-- section-title -->
        </div>
        <div class="col-md-4 col-xl-4 text-end wow fadeInRight" data-wow-delay="300ms"> <a href="#" class="nisoz-btn"> <span class="nisoz-btn__shape"></span><span class="nisoz-btn__shape"></span><span class="nisoz-btn__shape"></span><span class="nisoz-btn__shape"></span> <span class="nisoz-btn__text">Discover More</span> </a>
          <!-- /.btn -->
        </div>
      </div>
      <div class="cta-one__text wow fadeInUp" data-wow-delay="400ms">
        <div class="section-title__triangle"> <span class="section-title__triangle-left"></span> <span class="section-title__triangle-right"></span> </div>
        <p>Tailored creative agency services designed specifically for your business.</p>
      </div>
    </div>
  </section>
  <!-- Call To Action End -->
  <!-- Feature Start -->
  <section class="feature-one">
    <div class="container">
      <div class="feature-one__wrapper">
        <div class="row">
          <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="200ms">
            <div class="feature-one__item">
              <div class="feature-one__item__icon"><span class="icon-tick"></span></div>
              <h3 class="feature-one__item__title">We think differently</h3>
              <p class="feature-one__item__text">We approach challenges with a unique perspective, finding innovative solutions that set us apart from the rest.</p>
            </div>
            <!-- /.feature-box -->
          </div>
          <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="300ms">
            <div class="feature-one__item">
              <div class="feature-one__item__icon"><span class="icon-tick"></span></div>
              <h3 class="feature-one__item__title">High quality projects</h3>
              <p class="feature-one__item__text">Top-tier projects that deliver exceptional value, excellence, and innovation, consistently meeting the highest standards.</p>
            </div>
            <!-- /.feature-box -->
          </div>
          <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="400ms">
            <div class="feature-one__item">
              <div class="feature-one__item__icon"><span class="icon-tick"></span></div>
              <h3 class="feature-one__item__title">Expert team members</h3>
              <p class="feature-one__item__text">Highly skilled and experienced team members who excel in their fields and drive exceptional results.</p>
            </div>
            <!-- /.feature-box -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Feature End -->
  <!-- Portfolio Start -->
  <section class="portfolio-one" id="portfolio">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="section-title text-center">
            <div class="section-title__triangle"> <span class="section-title__triangle-left"></span> <span class="section-title__triangle-right"></span> </div>
            <h5 class="section-title__tagline">our completed works</h5>
            <h2 class="section-title__title">Recent clients projects</h2>
          </div>
          <!-- section-title -->
        </div>
      </div>
      <div class="portfolio-one__slider nisoz-owl__carousel owl-carousel" data-owl-options='{
            "loop": true,
            "items": 3,
            "smartSpeed": 1000, 
            "autoplay": true, 
            "autoplayTimeout": 6000, 
            "center": true,
            "nav": false,
            "dots": false,
            "margin": 30,
            "responsive":{
                "0":{
                    "items": 1,
                    "margin": 0
                },
                "768":{
                    "items": 1.5
                },
                "992":{
                    "items": 2
                },
                "1300":{
                    "items": 3
                }
            }
            }'>
        <div class="item">
          <!-- slider-item-start -->
          <div class="portfolio-one__item">
            <div class="portfolio-one__thumb"> <img src="assets/images/portfolio/portfolio-1-1.jpg" alt="Priya Group" /> </div>
            <div class="portfolio-one__hover"> <a class="portfolio-one__read-more" href="#"><span class="icon-right-arrow"></span></a>
              <div class="portfolio-one__hover-bottom">
                <div class="portfolio-one__cats"><a href="#">Project Overview</a></div>
                <h3 class="portfolio-one__title"><a href="#">Brief description of the project and its objectives.</a></h3>
              </div>
            </div>
          </div>
          <!-- folio-item -->
        </div>
        <!-- slider-item-end -->
        <div class="item">
          <!-- slider-item-start -->
          <div class="portfolio-one__item">
            <div class="portfolio-one__thumb"> <img src="assets/images/portfolio/portfolio-1-2.jpg" alt="Priya Group" /> </div>
            <div class="portfolio-one__hover"> <a class="portfolio-one__read-more" href="#"><span class="icon-right-arrow"></span></a>
              <div class="portfolio-one__hover-bottom">
                <div class="portfolio-one__cats"><a href="#">Client Name</a></div>
                <h3 class="portfolio-one__title"><a href="#">Name of the client (if permissible).</a></h3>
              </div>
            </div>
          </div>
          <!-- folio-item -->
        </div>
        <!-- slider-item-end -->
        <div class="item">
          <!-- slider-item-start -->
          <div class="portfolio-one__item">
            <div class="portfolio-one__thumb"> <img src="assets/images/portfolio/portfolio-1-3.jpg" alt="Priya Group" /> </div>
            <div class="portfolio-one__hover"> <a class="portfolio-one__read-more" href="#"><span class="icon-right-arrow"></span></a>
              <div class="portfolio-one__hover-bottom">
                <div class="portfolio-one__cats"><a href="#">Scope of Work</a></div>
                <h3 class="portfolio-one__title"><a href="#">Key tasks and deliverables.</a></h3>
              </div>
            </div>
          </div>
          <!-- folio-item -->
        </div>
        <!-- slider-item-end -->
      </div>
      <!-- slider-end -->
    </div>
  </section>
  <!-- Portfolio End -->
  <!--Testimonial Start-->
  <section class="testimonial-one" id="testimonial">
    <div class="container">
      <div class="testimonial-one__carousel nisoz-owl__carousel owl-theme owl-carousel" data-owl-options='{
            "items": 1,
            "margin": 0,
            "smartSpeed": 700,
            "loop":true,
            "autoplay": true,
            "nav":true,
            "dots":false,
            "navText": ["<span class=\"icon-left-arrow\"></span>","<span class=\"icon-right-arrow\"></span>"]
            }'>
        <!-- Testimonial Item -->
        <div class="item">
          <div class="testimonial-one__item">
            <div class="testimonial-one__author"> <img src="assets/images/resources/testimonial-1-1.jpg" alt="Priya Group">
              <div class="testimonial-one__icon"><span class="icon-quote"></span></div>
              <!-- testimonial-quote-icon -->
              <div class="testimonial-one__border">
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="290" viewBox="0 0 21 290">
                  <path class="cls-1" d="M761,4387h1v76.34l-20,24.11,20,26.24V4677h-1V4513.68l-20-26.16,20-24.1V4387Z" transform="translate(-741 -4387)" />
                </svg>
              </div>
              <!-- svg-border -->
            </div>
            <!-- testimonial-author-thumb -->
            <div class="testimonial-one__content">
              <div class="testimonial-one__ratings"> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> </div>
              <!-- testimonial-ratings -->
              <div class="testimonial-one__quote"> Working with this team has been exceptional. Their expertise, dedication, and innovative solutions exceeded our expectations, delivering outstanding results. Communication was seamless, and their commitment to quality was evident throughout. </div>
              <!-- testimonial-quote -->
              <div class="testimonial-one__meta">
                <h5 class="testimonial-one__title">Riley</h5>
                <span class="testimonial-one__designation">ceo & co founder</span>
              </div>
              <!-- testimonial-meta -->
            </div>
            <!-- testimonial-content -->
          </div>
        </div>
        <!-- Testimonial Item -->
        <!-- Testimonial Item -->
        <div class="item">
          <div class="testimonial-one__item">
            <div class="testimonial-one__author"> <img src="assets/images/resources/testimonial-1-2.jpg" alt="Priya Group">
              <div class="testimonial-one__icon"><span class="icon-quote"></span></div>
              <!-- testimonial-quote-icon -->
              <div class="testimonial-one__border">
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="290" viewBox="0 0 21 290">
                  <path class="cls-1" d="M761,4387h1v76.34l-20,24.11,20,26.24V4677h-1V4513.68l-20-26.16,20-24.1V4387Z" transform="translate(-741 -4387)" />
                </svg>
              </div>
              <!-- svg-border -->
            </div>
            <!-- testimonial-author-thumb -->
            <div class="testimonial-one__content">
              <div class="testimonial-one__ratings"> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> </div>
              <!-- testimonial-ratings -->
              <div class="testimonial-one__quote"> Collaborating with this team was outstanding. Their expertise, commitment, and creative solutions went beyond our expectations, achieving remarkable results. Their communication was flawless, and their dedication to quality was clear throughout. </div>
              <!-- testimonial-quote -->
              <div class="testimonial-one__meta">
                <h5 class="testimonial-one__title">aleesha michale</h5>
                <span class="testimonial-one__designation">ceo & co founder</span>
              </div>
              <!-- testimonial-meta -->
            </div>
            <!-- testimonial-content -->
          </div>
        </div>
        <!-- Testimonial Item -->
        <!-- Testimonial Item -->
        <div class="item">
          <div class="testimonial-one__item">
            <div class="testimonial-one__author"> <img src="assets/images/resources/testimonial-1-3.jpg" alt="Priya Group">
              <div class="testimonial-one__icon"><span class="icon-quote"></span></div>
              <!-- testimonial-quote-icon -->
              <div class="testimonial-one__border">
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="290" viewBox="0 0 21 290">
                  <path class="cls-1" d="M761,4387h1v76.34l-20,24.11,20,26.24V4677h-1V4513.68l-20-26.16,20-24.1V4387Z" transform="translate(-741 -4387)" />
                </svg>
              </div>
              <!-- svg-border -->
            </div>
            <!-- testimonial-author-thumb -->
            <div class="testimonial-one__content">
              <div class="testimonial-one__ratings"> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> </div>
              <!-- testimonial-ratings -->
              <div class="testimonial-one__quote"> Collaborating with this team has been outstanding. Their expertise, dedication, and innovative approach surpassed our expectations, producing remarkable results. Communication was flawless, and their unwavering commitment to quality was clear throughout </div>
              <!-- testimonial-quote -->
              <div class="testimonial-one__meta">
                <h5 class="testimonial-one__title">Morgan</h5>
                <span class="testimonial-one__designation">ceo & co founder</span>
              </div>
              <!-- testimonial-meta -->
            </div>
            <!-- testimonial-content -->
          </div>
        </div>
        <!-- Testimonial Item -->
      </div>
    </div>
  </section>
  <!--Testimonial End-->
  <!-- Choose Start -->
  <section class="choose-one">
    <div class="choose-one__bg wow slideInLeft" data-wow-delay="200ms">
      <div class="choose-one__bg__one"></div>
      <div class="choose-one__bg__two"></div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="choose-one__content wow fadeInUp" data-wow-delay="500ms">
            <div class="section-title">
              <div class="section-title__triangle"> <span class="section-title__triangle-left"></span> <span class="section-title__triangle-right"></span> </div>
              <h5 class="section-title__tagline">agency benefits</h5>
              <h2 class="section-title__title">why choose agency?</h2>
            </div>
            <!-- section-title -->
            <p class="choose-one__content__text"> Why choose our agency We offer exceptional expertise, innovative solutions, and outstanding results tailored to your needs. </p>
            <ul class="choose-one__content__list">
              <li><span class="icon-right-arrow-1"></span>Elegant, effective, and straightforward approach ensuring optimal results with ease</li>
              <li><span class="icon-right-arrow-1"></span>"Elegant, efficient, and clear approach guaranteeing optimal results effortlessly.</li>
            </ul>
          </div>
          <div class="choose-one__fact">
            <div class="choose-one__fact__icon"><span class="icon-project-management"></span></div>
            <!-- /.choose-fact__icon -->
            <div class="choose-one__fact__count"> <span class="count-box"> <span class="count-text" data-stop="3800" data-speed="1500"></span> </span>+ </div>
            <!-- /.choose-fact__count -->
            <h3 class="choose-one__fact__title">Projects has been<br>
              completed</h3>
            <!-- /.choose-fact__title -->
          </div>
          <!-- /.choose-fact -->
        </div>
        <div class="col-lg-7">
          <div class="nisoz-stretch-element-inside-column">
            <div class="nisoz-stretch__image wow slideInRight" data-wow-delay="400ms"> <img src="assets/images/resources/choose-1.jpg" alt="ogency"> </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Choose End -->
  <!-- Call To Action Start -->
  <section class="fact-one">
    <div class="fact-one__bg" style="background-image: url(assets/images/shapes/funfact-bg-1.png);"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 wow fadeInUp animated" data-wow-delay="100ms">
          <div class="fact-one__item text-center">
            <div class="fact-one__item__icon"><span class="icon-campaign"></span></div>
            <!-- /.fact-one__icon -->
            <div class="fact-one__item__count"> <span class="count-box"> <span class="count-text" data-stop="886" data-speed="1500"></span> </span> </div>
            <!-- /.fact-one__count -->
            <h3 class="fact-one__item__title">Projects Completed</h3>
            <!-- /.fact-one__title -->
          </div>
          <!-- /.fact-one__item -->
        </div>
        <!-- /.col-lg-3 col-md-6 -->
        <div class="col-lg-3 col-md-6 wow fadeInUp animated" data-wow-delay="200ms">
          <div class="fact-one__item text-center">
            <div class="fact-one__item__icon"><span class="icon-recommend"></span></div>
            <!-- /.fact-one__icon -->
            <div class="fact-one__item__count"> <span class="count-box"> <span class="count-text" data-stop="601" data-speed="1500"></span> </span> </div>
            <!-- /.fact-one__count -->
            <h3 class="fact-one__item__title">Satisfied Customers</h3>
            <!-- /.fact-one__title -->
          </div>
          <!-- /.fact-one__item -->
        </div>
        <!-- /.col-lg-3 col-md-6 -->
        <div class="col-lg-3 col-md-6 wow fadeInUp animated" data-wow-delay="300ms">
          <div class="fact-one__item text-center">
            <div class="fact-one__item__icon"><span class="icon-increment"></span></div>
            <!-- /.fact-one__icon -->
            <div class="fact-one__item__count"> <span class="count-box"> <span class="count-text" data-stop="960" data-speed="1500"></span> </span> </div>
            <!-- /.fact-one__count -->
            <h3 class="fact-one__item__title">Repeat Customers</h3>
            <!-- /.fact-one__title -->
          </div>
          <!-- /.fact-one__item -->
        </div>
        <!-- /.col-lg-3 col-md-6 -->
        <div class="col-lg-3 col-md-6 wow fadeInUp animated" data-wow-delay="400ms">
          <div class="fact-one__item text-center">
            <div class="fact-one__item__icon"><span class="icon-consulting"></span></div>
            <!-- /.fact-one__icon -->
            <div class="fact-one__item__count"> <span class="count-box"> <span class="count-text" data-stop="240" data-speed="1500"></span> </span> </div>
            <!-- /.fact-one__count -->
            <h3 class="fact-one__item__title">Extra Team</h3>
            <!-- /.fact-one__title -->
          </div>
          <!-- /.fact-one__item -->
        </div>
        <!-- /.col-lg-3 col-md-6 -->
      </div>
    </div>
  </section>
  <!-- Call To Action End -->
  <!-- Blog Start -->
  <section class="blog-one" id="blog">
    <div class="container">
      <div class="row">
        <div class="col-md-12 wow fadeInUp" data-wow-delay="100ms">
          <div class="section-title text-center">
            <div class="section-title__triangle"> <span class="section-title__triangle-left"></span> <span class="section-title__triangle-right"></span> </div>
            <h5 class="section-title__tagline">From the Blog</h5>
            <h2 class="section-title__title">News & articles</h2>
          </div>
          <!-- section-title -->
        </div>
      </div>

      <div class="row">

        <?php
        $sql_blog = "SELECT * FROM ngo_blog WHERE blog_status='Active' ORDER BY blog_id   DESC LIMIT 3";
        $result_blog = db_query($sql_blog);

        while ($blog = mysqli_fetch_array($result_blog)) {
        ?>
          <div class="col-lg-4 col-md-6">
            <div class="blog-one__item" style="border:1px solid #000;">
              <div class="blog-one__image">


                <?php if ($blog['blog_type'] == 'image' && file_exists(UP_FILES_FS_PATH . '/photo/' . $blog['image'])) { ?>
                  <img src="<?= show_thumb(UP_FILES_WS_PATH . '/photo/' . $blog['image'], 368, 278, 'resize') ?>" alt="<?= $blog['blog_name']  ?>">
                <?php } elseif ($blog['blog_type'] == 'video' && file_exists(UP_FILES_FS_PATH . '/video/' . $blog['video'])) { ?>
                  <video width="100%" controls>
                    <source src="<?= UP_FILES_WS_PATH . '/video/' . $blog['video'] ?>" type="video/mp4">
                    Your browser does not support the video tag.
                  </video>
                <?php } else { ?>
                  <img src="assets/images/blog/blog-1-1.jpg" alt="Default Blog Image">
                <?php } ?>



                <a href=""></a>
                <div style="color:#b6ef00;" class="blog-one__date"> <?= $blog['blog_date'] ?> </div>
                <!-- <div class="blog-one__date"> <?=str_stop(htmlspecialchars($blog['blog_date']), 10) ; ?> </div> -->
                <!-- /.blog-date -->
              </div>
              <!-- /.blog-image -->
              <div class="blog-one__content">
                <div class="blog-one__meta">
                  <div class="blog-one__meta__author">
                    <!-- <div class="blog-one__meta__thumb">
                      <img src="assets/images/blog/author-1.png" alt="Priya Group" />
                    </div> -->

                    <?= $blog['blog_name'] ?><br>

                  </div>
                  <!-- <span class="fas fa-comments"></span>2 Comments -->
                </div> <br>
                <!-- /.blog-meta -->
                <h3 class="blog-one__title"> <a href="blog_detail.php?blog_id=<?= htmlspecialchars($blog['blog_id']); ?>"><?= $blog['blog_shortdesc'] ?></a> </h3>
                <!-- /.blog-title -->
                <a href="blog_detail.php?blog_id=<?= $blog['blog_id'] ?>" class="nisoz-btn"> <span class="nisoz-btn__shape">

                  </span><span class="nisoz-btn__shape">

                  </span><span class="nisoz-btn__shape">

                  </span><span class="nisoz-btn__shape">

                  </span> <span class="nisoz-btn__text">Read More<span class="icon-right-arrow"></span></span> </a>
                <!-- /.blog-read-more -->
              </div>
              <!-- /.blog-content -->
            </div>
            <!-- /.blog-card-one -->
          </div>
        <?php } ?>


      </div>


    <a href="blog.php" class="neon-btn" style="width: 30%; height: 30%; justify-content: center; margin: 0 auto; display: flex; align-items: center; margin-top: 20px;">
  <span class="nisoz-btn__text" >
    View All Blogs <span class="icon-right-arrow">➜</span>
  </span>
</a>

<style>
  .neon-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 12px 24px;
    background-color: #b6ef00; /* Neon Green */
    color: #000;
    font-size: 18px;
    font-weight: bold;
    text-decoration: none;
    border-radius: 8px;
    box-shadow: 0 0 10px #b6ef00, 0 0 20px #b6ef00, 0 0 30px #b6ef00;
    transition: 0.3s ease-in-out;
    border: 2px solid #b6ef00;
  }

  .neon-btn:hover {
    background-color: #000;
    color: #b6ef00;
    box-shadow: 0 0 15px #b6ef00, 0 0 30px #b6ef00, 0 0 45px #b6ef00;
  }

  .icon-right-arrow {
    font-size: 18px;
    margin-left: 8px;
  }
</style>





    </div>
  </section>
  <!-- Blog End -->
  <!-- Call To Action Start -->
  <section class="cta-two">
    <div class="container">
      <div class="cta-two__info-top wow fadeInUp" data-wow-delay="200ms">
        <div class="cta-two__bg" style="background-image: url(assets/images/shapes/cta-bg-2.png);"></div>
        <div class="section-title">
          <h2 class="section-title__title">Let's start working together.<br>
            Get in touch with us!</h2>
        </div>
        <!-- section-title -->
        <a href="#" class="cta-two__icon"><span class="icon-long-arrow"></span></a>
      </div>
      <h5 class="cta-two__info-bottom wow fadeInDown" data-wow-delay="300ms"> or call us to get free quote: <a href="tel:+9236809850">+0-9716550547</a> </h5>
    </div>
  </section>
  <!-- Call To Action End -->
  <!--Google Map Start-->
  <section class="google-map">
    <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4562.753041141002!2d-118.80123790098536!3d34.152323469614075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80e82469c2162619%3A0xba03efb7998eef6d!2sCostco+Wholesale!5e0!3m2!1sbn!2sbd!4v1562518641290!5m2!1sbn!2sbd"
      
      class="google-map__one" allowfullscreen></iframe> -->
    <!-- 
      <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d3500.339271921283!2d77.3537109!3d28.6794961!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1738041586281!5m2!1sen!2sin" 
     class="google-map__one" allowfullscreen ></iframe> -->



    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7000.713773568019!2d77.353046!3d28.678969!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfb9cc20eec83%3A0xb296c88e52bb9fbd!2sSahara-II!5e0!3m2!1sen!2sin!4v1738041897906!5m2!1sen!2sin" class="google-map__one" allowfullscreen class="google-map__one" allowfullscreen></iframe>

  </section>
  <!--Google Map End-->
  <!-- Footer -->
  <?php include("includes/footer.inc.php") ?>
  <!-- Footer End -->
  <!--extra Footer -->
  <?php include("includes/extra_footer.inc.php") ?>
  <!--extra Footer End  -->
  </div>
</body>

</html>