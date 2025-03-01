<?
include("../includes/surya.dream.php");
protect_user_page();
$s_id = $_REQUEST['s_id'];
if ($s_id != '') {
  $sql = "select * from ngo_services where s_id = '$s_id'";
  $result = db_query($sql);
  if ($line_raw = mysqli_fetch_array($result, MYSQLI_BOTH)) {
    //$line = ms_form_value($line_raw);
    //@extract($line_raw);
    /// $s_ref_userid = db_scalar("select s_username from ngo_services where s_id = '$s_ref_userid'");
  }
}

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
    <? include('includes/sidebar.php') ?>
    <!-- Start Page Content here -->
    <div class="page-content">
      <!-- ========== Topbar Start ========== -->
      <? include('includes/header.php') ?>
      <!-- ========== Topbar End ========== -->
      <div class="px-3">
        <!-- Start Content-->
        <div class="container-fluid">
          <!-- start page title -->
          <div class="py-3 py-lg-4">
            <div class="row">
              <div class="col-lg-6">
                <h4 class="page-title mb-0"><? if ($scate_id != '') { ?><?= $page_cate_name = db_scalar("select scate_name from ngo_service_cate where scate_id='$scate_id' ") ?><? } else { ?>All Services<? }  ?></h4>
              </div>
              <div class="col-lg-6">
                <div class="d-none d-lg-block">
                  <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Services</a></li>
                    <li class="breadcrumb-item active"><? if ($scate_id != '') { ?><?= $page_cate_name = db_scalar("select scate_name from ngo_service_cate where scate_id='$scate_id' ") ?><? } else { ?>All Services<? }  ?></li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- end page title -->
          <div class="row ">

            <?

            $sql_service = "select * from ngo_services where s_scate_id='$scate_id' and s_status='Active' order by s_id asc  ";  // 
            $result_service = db_query($sql_service);
            $total_service = mysqli_num_rows($result_service);

            if ($total_service > 0) {
              while ($line_service = mysqli_fetch_array($result_service)) {;
                $ctr_service++;
            ?>
                <!-- start col -->
                <div class="col-lg-6 col-xl-3">
                  <!-- Simple card -->
                  <div class="card">

                    <? if (($line_service['s_image'] != '') && (file_exists(UP_FILES_FS_PATH . '/services/' . $line_service['s_image']))) {

                    ?>
                      <img class="card-img-top img-fluid" src="<?= show_thumb(UP_FILES_WS_PATH . '/services/' . $line_service['s_image'], 770, 481, 'resize'); ?>" alt=" " />

                    <? } else { ?>
                      <img class="card-img-top img-fluid" src="assets/images/no-service-img.png" alt=" " />
                    <? }  ?>







                    <div class="card-body">
                      <h5 class="card-title"><?= ($line_service['s_title']); ?></h5>
                      <?php /*?> <p class="card-text"><?= str_stop($line_service['s_description'], 150); ?></p> <?php */ ?>
                      <p style="text-align:center; padding-top:10px;"><a href="services_details.php?scate_id=<?= $line_service['s_scate_id'] ?>&s_id=<?= $line_service['s_id'] ?>" class="btn btn-primary waves-effect waves-light" style="margin-left:auto; margin-right:auto;">Apply For services</a></p>
                    </div>
                  </div>
                </div>


            <? }
            } ?>
          </div>



        </div>
      </div>
      <!-- end row -->


      <!-- end row -->

      <!-- container -->

      <!-- content -->
      <!-- Footer Start -->
      <? include('includes/footer.php') ?>
      <!-- end Footer -->
    </div>
    <!-- End Page content -->
  </div>
  <!-- END wrapper -->
  <? include('includes/extra_footer.php') ?>
</body>

</html>