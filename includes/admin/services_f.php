<?
require_once('../includes/surya.dream.php');
protect_admin_page2();
if (is_post_back()) {
  ///print_r($_POST);
  $arr_error_msgs = array();
  $arr_success_msgs = array();
  //if ($zzzzzid =='') { $arr_error_msgs[] =  "User ID  does not exist!";}

  if ($_FILES['s_image']['name'] != '') {
    // Create a new finfo object
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    // Get the MIME type of the uploaded file
    $mime_type = $finfo->file($_FILES['s_image']['tmp_name']);

    // Check if the file is a JPG or JPEG image
    if ($mime_type == 'image/jpeg' || $mime_type == 'image/jpg') {
      // Generate a unique file name for the uploaded image
    } else {
      $arr_error_msgs[] = "The uploaded file is not a valid JPG image.";
    }
  }

  $_SESSION['arr_error_msgs'] = $arr_error_msgs;
  if (count($arr_error_msgs) == 0) {

    if ($_FILES['s_image']['name'] != '') {
      $s_image_name = str_replace('.' . file_ext($_FILES['s_image']['name']), '', $_FILES['s_image']['name']) . '_' . md5(uniqid(rand(), true)) . '.' . file_ext($_FILES['s_image']['name']);
      copy($_FILES['s_image']['tmp_name'], UP_FILES_FS_PATH.'/services/'.$s_image_name);
      $update_photo = ", s_image='$s_image_name'";
    }

     if ($s_image_del != '') {
      @unlink(UP_FILES_FS_PATH . '/services/' . $old_s_image);
      $update_photo = ", s_image=''";
    }

    
 	if($s_scate_sub_id!=''){ $update_subcate = " , s_scate_sub_id='$s_scate_sub_id'"; } 
 
    if ($s_id != '') {
      $sql = "update ngo_services set
       s_title = '$s_title', 
       s_scate_id = '$s_scate_id' "
        . $update_photo . $update_subcate .",
         s_description = '$s_description' ,
          s_updated_by ='" . $_SESSION['sess_admin_userid'] . "
          ' where s_id = '$s_id'";

      db_query($sql);
      $arr_success_msgs[] = "Services details updated successfully!!";
    } else {
      $sql = "insert into ngo_services set 
      s_title = '$s_title',
       s_scate_id = '$s_scate_id' "  
       . $update_photo . $update_subcate . ",
        s_created_by = '" . $_SESSION['sess_admin_userid'] . "
        ', s_status = 'Active' ,
         s_description = '$s_description' ";
      db_query($sql);
      $arr_success_msgs[] = "Services created successfully!";
    }

    $_SESSION['arr_success_msgs'] = $arr_success_msgs;
    #	 $message = "Dear $s_fname, Your login Username is $s_username and Password is $s_password, Thanks for joining ".SITE_URL; 
    //           Dear #value, Your login Username is #value and Password is #value, Thanks for joining #value
    # $s_mobile = '91'.$s_mobile;
    # send_sms ($s_mobile,$message,$msg_id=''); 
	
	
	 header("Location: services_list.php");
  	 ///header("Location: customers_f.php");
  	 exit;
	
  }
   


 
}

$s_id = $_REQUEST['s_id'];
if ($s_id != '') {
  $sql = "select * from ngo_services where s_id = '$s_id'";
  $result = db_query($sql);
  if ($line_raw = mysqli_fetch_array($result, MYSQLI_BOTH)) {
    //$line = ms_form_value($line_raw);
    @extract($line_raw);
    /// $s_ref_userid = db_scalar("select s_username from ngo_services where s_id = '$s_ref_userid'");
  }
}
?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head>
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
                <h4 class="page-title mb-0">
                  <? if ($s_id == '') { ?>
                    Add
                  <? } else { ?>
                    Update
                  <? } ?>
                  Services</h4>
              </div>
              <div class="col-lg-6">
                <div class="d-none d-lg-block">
                  <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Services</a></li>
                    <li class="breadcrumb-item active">
                      <? if ($s_id == '') { ?>
                        Add
                      <? } else { ?>
                        Update
                      <? } ?>
                      Services</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- end page title -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <?php /*?> <h4 class="header-title">Basic Data Table </h4><?php */ ?>
                  <div class="table-responsive">
                    <? include("../error_msg.inc.php"); ?>
                    <form name="form1" method="post" enctype="multipart/form-data" <?= validate_form() ?>>
                      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm">
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-12">
                              <div class="card">
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col-12">
                                      <div class="p-2">
                                        <div class="form-horizontal" role="form">

                                          <div class="mb-2 row">
                                            <label class="col-md-2 col-form-label" for="simpleinput">Service Cate <span class="text-danger text-lg">*</span></label>
                                            <div class="col-md-10">
                                              <?php
                                             // $sql_scate = "SELECT scate_id, concat(scate_id, ' - ', scate_name) FROM ngo_service_cate WHERE scate_status='Active' ORDER BY scate_id ";
											  $sql_scate = "SELECT scate_id, scate_name FROM ngo_service_cate WHERE scate_parentid is null and scate_status='Active' ORDER BY scate_id ";
                                              echo make_dropdown($sql_scate, 's_scate_id', $s_scate_id, 'class="form-control"  style="width: 100%;color:#000;" alt="select" onchange="location.href=\''.$_SERVER['PHP_SELF'].'?s_scate_id=\'+this.value" emsg="Select Service Category"', 'Select Service Category');
                                              ?>
                                            </div>
                                          </div>
										  
										  <? 
										  $count_child_service = db_scalar("select count(*) from ngo_service_cate where scate_parentid = '$s_scate_id'")+0;
 										  if($count_child_service>0){ ?>
                                           
                                            <div class="mb-2 row"  id="certification_sub_category">
                                            <label class="col-md-2 col-form-label" for="certification">Sub Cate <span class="text-danger text-lg">*</span></label>
                                            <div class="col-md-10">
                                            <?php
                                              $sql_scate2 = "SELECT scate_id, scate_name FROM ngo_service_cate WHERE scate_parentid = '$s_scate_id' and scate_status='Active' ORDER BY scate_id ";
                                              echo make_dropdown($sql_scate2, 's_scate_sub_id', $s_scate_sub_id, 'class="form-control" style="width: 100%;color:#000;" alt="select" emsg="Select Service Category"', 'Select Service Category');
                                              ?>
                                              <!-- <select class="form-control" name="certification">
                                                <option value="">Select Certification</option>
                                                <option value="product_certification">Product Certification</option>
                                                <option value="system_certification">System Certification</option>
                                              </select> -->
                                            </div>
                                          </div>

										 <?  }  ?>



                                          <div class="mb-2 row">
                                            <label class="col-md-2 col-form-label" for="simpleinput">Title <span class="text-danger text-lg">*</span></label>
                                            <div class="col-md-10">
                                              <input type="text" id="simpleinput" class="form-control" name="s_title" value="<?= $s_title ?>" alt="blank" emsg="Enter the Service title" placeholder="Service title">
                                            </div>
                                          </div>

                                          <?php if ($s_image != '') { ?>
                                            <div class="mb-2 row">
                                              <label class="col-md-2 col-form-label" for="example-fileinput">Current Image</label>
                                              <div class="col-md-10">
                                                <img src="<?= UP_FILES_WS_PATH . '/services/' . $s_image ?>" width="98" /><br>
                                                Delete
                                                <input type="checkbox" name="s_image_del" value="1" class="maintxt">
                                              </div>
                                            </div>
                                          <?php } ?>

                                          <div class="mb-2 row">
                                            <label class="col-md-2 col-form-label" for="example-fileinput">Image (778x 400px) <span class="text-danger text-lg">*</span></label>
                                            <div class="col-md-10">
                                              <input type="file" class="form-control" id="example-fileinput" name="s_image">
                                            </div>
                                          </div>

                                          <div class="mb-2 row">
                                            <label class="col-md-2 col-form-label" for="summernote">Description :</label>
                                            <div class="col-md-10">
                                              <textarea id="s_description" class="summernote" name="s_description" alt="blank" emsg="Enter service description" placeholder="Enter Description"><?= $s_description ?></textarea>
                                            </div>
                                          </div>



                                          <!-- <div class="mb-2 row">
                                              <label class="col-md-2 col-form-label" for="example-textarea">Description <span class="text-danger text-lg">*</span></label>
                                              <div class="col-md-10">
                                                <textarea class="form-control" id="myeditor" name="s_description" rows="5"></textarea>
                                              </div>
                                            </div> -->



                                          <div class="mb-2 row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-10">
                                              <input type="hidden" name="s_id" value="<?= $s_id ?>">
                                              <input name="old_s_image" type="hidden" class="txtbox" id="old_s_image" value="<?= $s_image ?>" />
                                              <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-10">
                                              <p>Fields marked with an asterisk (<span class="text-danger text-lg">*</span>) are mandatory.</p>
                                            </div>


                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </table>
                    </form>
                  </div>

                </div>
                <!-- end card body-->
              </div>
              <!-- end card -->
            </div>
            <!-- end col-->
          </div>
          <!-- end row-->
        </div>
        <!-- container -->
      </div>

      <!-- content -->
      <!-- Footer Start -->
      <? include('includes/footer.php') ?>
      <!-- end Footer -->
    </div>
    <!-- End Page content -->
  </div>
  <!-- END wrapper -->
  <!-- App js -->


  <? include('includes/extra_footer.php') ?>
</body>

</html>