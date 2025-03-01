<?php
include ("../includes/surya.dream.php");
protect_user_page();
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">
 <head>
<!-- include file here ????  -->
 <? include('includes/extra_head.php') ?>
</head>
<body>
<!-- Begin page -->
<div class="layout-wrapper">
  <!-- ========== Left Sidebar ========== -->
   <? include('includes/sidebar.php')?>
  <!-- Start Page Content here -->
  <div class="page-content">
    <!-- ========== Topbar Start ========== -->
                <? include('includes/header.php')?>
            <!-- ========== Topbar End ========== -->
    <div class="px-3">
      <!-- Start Content-->
      <div class="container-fluid">
        <!-- start page title -->
        <div class="py-3 py-lg-4">
          <div class="row">
            <div class="col-lg-6">
              <h4 class="page-title mb-0">All Services</h4>
            </div>
            <div class="col-lg-6">
              <div class="d-none d-lg-block">
                <ol class="breadcrumb m-0 float-end">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Manage Services</a></li>
                  <li class="breadcrumb-item active">All Services</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- end page title -->
        <div class="row">
 		
		  <!-- start col -->
          <div class="col-lg-6 col-xl-3">
            <!-- Simple card -->
            <div class="card"> <img class="card-img-top img-fluid" src="assets/images/media/img-1.jpg" alt="Card image cap" />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content. With supporting text below as a natural lead-in to additional content.</p>
                <p style="text-align:center;"><a href="javascript:void(0);" class="btn btn-primary waves-effect waves-light" style="margin-left:auto; margin-right:auto;">View Details</a></p> </div>
            </div>
          </div>
		  
		  <div class="col-lg-6 col-xl-3">
            <!-- Simple card -->
            <div class="card"> <img class="card-img-top img-fluid" src="assets/images/media/img-1.jpg" alt="Card image cap" />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content. With supporting text below as a natural lead-in to additional content.</p>
                <p style="text-align:center;"><a href="javascript:void(0);" class="btn btn-primary waves-effect waves-light" style="margin-left:auto; margin-right:auto;">View Details</a></p> </div>
            </div>
          </div>
		  
		  
		  <div class="col-lg-6 col-xl-3">
            <!-- Simple card -->
            <div class="card"> <img class="card-img-top img-fluid" src="assets/images/media/img-1.jpg" alt="Card image cap" />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content. With supporting text below as a natural lead-in to additional content.</p>
                <p style="text-align:center;"><a href="javascript:void(0);" class="btn btn-primary waves-effect waves-light" style="margin-left:auto; margin-right:auto;">View Details</a></p> </div>
            </div>
          </div>
		  
		  <div class="col-lg-6 col-xl-3">
            <!-- Simple card -->
            <div class="card"> <img class="card-img-top img-fluid" src="assets/images/media/img-1.jpg" alt="Card image cap" />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content. With supporting text below as a natural lead-in to additional content.</p>
                <p style="text-align:center;"><a href="javascript:void(0);" class="btn btn-primary waves-effect waves-light" style="margin-left:auto; margin-right:auto;">View Details</a></p> </div>
            </div>
          </div>
		  
		  <div class="col-lg-6 col-xl-3">
            <!-- Simple card -->
            <div class="card"> <img class="card-img-top img-fluid" src="assets/images/media/img-1.jpg" alt="Card image cap" />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content. With supporting text below as a natural lead-in to additional content.</p>
                <p style="text-align:center;"><a href="javascript:void(0);" class="btn btn-primary waves-effect waves-light" style="margin-left:auto; margin-right:auto;">View Details</a></p> </div>
            </div>
          </div>
          <!-- end col -->
           
          
        </div>
        <!-- end row -->
         
       
        <!-- end row -->
      </div>
      <!-- container -->
    </div>
    <!-- content -->
    <!-- Footer Start -->
     <? include('includes/footer.php')?>
    <!-- end Footer -->
  </div>
  <!-- End Page content -->
</div>
<!-- END wrapper -->
<? include('includes/extra_footer.php')?></body>
</html>
