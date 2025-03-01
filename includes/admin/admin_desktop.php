<?php include_once"../includes/surya.dream.php";
//print_r($_SESSION);
protect_admin_page2();
 
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
  <!-- ============================================================== -->
  <!-- Start Page Content here -->
  <!-- ============================================================== -->
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
              <h4 class="page-title mb-0">Admin</h4>
            </div>
            <div class="col-lg-6">
              <div class="d-none d-lg-block">
                <ol class="breadcrumb m-0 float-end">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Dashboard</a></li>
                  <li class="breadcrumb-item active">Admin Overview</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- end page title -->
        <div class="row">
          <div class="col-md-6 col-xl-3">
            <div class="card">
              <div class="card-body">
                <div class="mb-4"> <span class="badge badge-soft-primary float-end">Active</span>
                  <h5 class="card-title mb-0">Customer</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                  <div class="col-8">
                    <h2 class="d-flex align-items-center mb-0"> <?=db_scalar("select count(*) from ngo_users where u_status='Active' ")+0?> </h2>
                  </div>
                  <div class="col-4 text-end"> <span class="text-muted"> </span> </div>
                </div>
                <div class="progress shadow-sm" style="height: 5px;">
                  <div class="progress-bar bg-success" role="progressbar" style="width: 57%;"> </div>
                </div>
              </div>
              <!--end card body-->
            </div>
            <!-- end card-->
          </div>
          <!-- end col-->
          <div class="col-md-6 col-xl-3">
            <div class="card">
              <div class="card-body">
                <div class="mb-4"> <span class="badge badge-soft-primary float-end">Active</span>
                  <h5 class="card-title mb-0">Employee</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                  <div class="col-8">
                    <h2 class="d-flex align-items-center mb-0"> <?=db_scalar("select count(*) from ngo_admin where adm_type='employee' and adm_status='Active' ")+0?>  </h2>
                  </div>
                  <div class="col-4 text-end"> <span class="text-muted">   </span>
                                                
                 </div>
                </div>
                <div class="progress shadow-sm" style="height: 5px;">
                  <div class="progress-bar bg-danger" role="progressbar" style="width: 57%;"> </div>
                </div>
              </div>
              <!--end card body-->
            </div>
            <!-- end card-->
          </div>
          <!-- end col-->
          <div class="col-md-6 col-xl-3">
            <div class="card">
              <div class="card-body">
                <div class="mb-4"> <span class="badge badge-soft-primary float-end">Active</span>
                  <h5 class="card-title mb-0">Service</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                  <div class="col-8">
                    <h2 class="d-flex align-items-center mb-0"> <?=db_scalar("select count(*) from ngo_services where s_status='Active' ")+0?>  </h2>
                  </div>
                  <div class="col-4 text-end"> <span class="text-muted"></span> </div>
                </div>
                <div class="progress shadow-sm" style="height: 5px;">
                  <div class="progress-bar bg-warning" role="progressbar" style="width: 57%;"> </div>
                </div>
              </div>
              <!--end card body-->
            </div>
            <!--end card-->
          </div>
          <!-- end col-->
          <div class="col-md-6 col-xl-3">
            <div class="card">
              <div class="card-body">
                <div class="mb-4"> <span class="badge badge-soft-primary float-end">Total</span>
                  <h5 class="card-title mb-0">Service Request</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                  <div class="col-8">
                    <h2 class="d-flex align-items-center mb-0"> 0 </h2>
                  </div>
                  <div class="col-4 text-end"> <span class="text-muted"> </span> </div>
                </div>
                <div class="progress shadow-sm" style="height: 5px;">
                  <div class="progress-bar bg-info" role="progressbar" style="width: 57%;"></div>
                </div>
              </div>
              <!--end card body-->
            </div>
            <!-- end card-->
          </div>
          <!-- end col-->
        </div>
        <!-- end row-->
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Service Analytics</h4>
                <p class="card-subtitle mb-4">From date of 1st Jan 2024 to continue</p>
                <div id="morris-bar-example" style="max-height:212px;" class="morris-chart"></div>
              </div>
              <!--end card body-->
            </div>
            <!-- end card-->
          </div>
          <!-- end col -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Service Request</h4>
                <p class="card-subtitle mb-4">Recent Service Request</p>
                <div class="text-center">
                  <input data-plugin="knob" data-width="165" data-height="165" data-linecap=round
                                            data-fgColor="#7a08c2" value="95" data-skin="tron" data-angleOffset="180"
                                            data-readOnly=true data-thickness=".15" />
                  <h5 class="text-muted mt-3">Total Service Request today</h5>
                 <!-- <p class="text-muted w-75 mx-auto sp-line-2">Traditional heading
                    elements are designed to work best in the meat of your page content.</p>-->
                  <!--<div class="row mt-3">
                    <div class="col-6">
                      <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                      <h4><i class="fas fa-arrow-up text-success me-1"></i>$0.0k</h4>
                    </div>
                    <div class="col-6">
                      <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                      <h4><i class="fas fa-arrow-down text-danger me-1"></i>$0.0k</h4>
                    </div>
                  </div>-->
                </div>
              </div>
              <!--end card body-->
            </div>
            <!-- end card-->
          </div>
          <!-- end col -->
          <?php /*?><div class="col-lg-3">
            <div class="card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col">
                    <h4 class="card-title">Manage Request</h4>
                    <p class="card-subtitle mb-4">Transaction period from 21 July to
                      25 Aug</p>
                    <h3>0 <span class="badge badge-soft-success float-end"></span> </h3>
                  </div>
                </div>
                <!-- end row -->
                <div id="sparkline1" class="mt-3"></div>
              </div>
              <!--end card body-->
            </div>
            <!--end card-->
          </div><?php */?>
          <!-- end col -->
        </div>
        <!--end row-->
      
        <!--end row-->
      </div>
     
    </div>
    <!-- content -->
    <? include('includes/footer.php')?>
    <!-- end Footer -->
  </div>
  <!-- ============================================================== -->
  <!-- End Page content -->
  <!-- ============================================================== -->
</div>
<!-- END wrapper -->
<? include('includes/extra_footer.php')?>
</body>
</html>
