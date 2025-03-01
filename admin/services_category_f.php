<?
require_once('../includes/surya.dream.php');
protect_admin_page2();
if (is_post_back()) {
  ///print_r($_POST);
  $arr_error_msgs = array();
  $arr_success_msgs = array();
  //if ($scate_id =='') { $arr_error_msgs[] =  "User ID  does not exist!";}
 

  if ($_FILES['scate_image']['name'] != '') {
    // Create a new finfo object
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    // Get the MIME type of the uploaded file
    $mime_type = $finfo->file($_FILES['scate_image']['tmp_name']);

    // Check if the file is a valid image type (JPG, JPEG, PNG)
    $allowed_types = array(
      'image/jpeg',
      'image/jpg', 
      'image/png'
    );

    if (!in_array($mime_type, $allowed_types)) {
      $arr_error_msgs[] = "Please upload a valid image file (JPG, JPEG or PNG only).";
    }
  }



  $_SESSION['arr_error_msgs'] = $arr_error_msgs;
  if (count($arr_error_msgs) == 0) {



    if ($_FILES['scate_image']['name'] != '') {
      $scate_image_name = str_replace('.' . file_ext($_FILES['scate_image']['name']), '', $_FILES['scate_image']['name']) . '_' . md5(uniqid(rand(), true)) . '.' . file_ext($_FILES['scate_image']['name']);
      copy($_FILES['scate_image']['tmp_name'], UP_FILES_FS_PATH.'/servicescategory/'.$scate_image_name);
      $update_photo = ", scate_image='$scate_image_name'";
    }

     if ($scate_image_del != '') {
      @unlink(UP_FILES_FS_PATH . '/servicescategory/' . $old_scate_image);
      $update_photo = ", scate_image=''";
    }





 
    if ($scate_parentid != '') {
      
	  $update_subcate = " , scate_parentid='$scate_parentid'";
	  
    } else if ($scate_parentid == '') { 
	  
	  $update_subcate = " , scate_parentid=NULL ";
	  
	}



    if ($scate_id != '') {
      $sql = "UPDATE ngo_service_cate 
        SET scate_name = '$scate_name' "
         . $update_photo . " 
         " . $update_subcate . " 
        WHERE scate_id = '$scate_id'";
       db_query($sql);  


      $arr_success_msgs[] = "Services category details updated successfully!!";
    } else {
      $sql = "INSERT INTO ngo_service_cate 
      SET scate_name = '$scate_name',  
      scate_image = '$scate_image_name'" 
      .$update_subcate. " ,
      scate_status = 'Active', 
      scate_datetime = ADDDATE(now(), INTERVAL 750 MINUTE)";


      db_query($sql);
      $arr_success_msgs[] = "Services category created successfully!";
    }

    $_SESSION['arr_success_msgs'] = $arr_success_msgs;

    if ($sms_send == '1') {
    } else if (isset($_REQUEST['Submit_password']) || isset($_REQUEST['Submit_password_x'])) {
      $sql = "update ngo_service_cate set u_password = '$password' where u_id in ($str_u_ids)";
      db_query($sql);
    } else if (isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x'])) {
      $sql = "update ngo_service_cate set scate_status = 'Active' where scate_id in ($str_u_ids)";
      db_query($sql);
    } else if (isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x'])) {
      $sql = "update ngo_service_cate set scate_status = 'Inactive' where scate_id in ($str_u_ids)";
      db_query($sql);
    }
    #	 $message = "Dear $s_fname, Your login Username is $s_username and Password is $s_password, Thanks for joining ".SITE_URL; 
    //           Dear #value, Your login Username is #value and Password is #value, Thanks for joining #value
    # $s_mobile = '91'.$s_mobile;
    # send_sms ($s_mobile,$message,$msg_id=''); 
  }
  if ($email_send == '1') {


    // send email 

    $message = "
Hi " . $s_fname . ", 
 
We are thrilled to welcome you to the " . SITE_NAME . " family! Thank you for choosing us for your product/service. We are committed to providing you with the best experience possible.
 
Your login information is provided below.  Please also keep in mind that you must finish your registration by clicking on the link below.

Url :  " . SITE_WS_PATH . "/login
Username  = " . $s_username . "
Password = " . $s_password . "
 
  
Once again, Thank you for being a part of " . SITE_NAME . " family

" . SITE_NAME . "
 " . SITE_WS_PATH . "
";

    $HEADERS  = "MIME-Version: 1.0 \n";
    $HEADERS .= "Content-type: text/plain; charset=iso-8859-1 \n";
    $HEADERS .= "From:  <" . ADMIN_EMAIL . ">\n";
    $SUBJECT  = "We welcome you to " . SITE_NAME;
    if ($s_email != '') {
      @mail($s_email, $SUBJECT, $message, $HEADERS);
    }

    /// end 
  }


  header("Location: services_category_list.php");
  ///header("Location: customers_f.php");
  exit;
}

$scate_id = $_REQUEST['scate_id'];
if ($scate_id != '') {
  $sql = "select * from ngo_service_cate where scate_id = '$scate_id'";
  $result = db_query($sql);
  if ($line_raw = mysqli_fetch_array($result, MYSQLI_BOTH)) {
    //$line = ms_form_value($line_raw);
    @extract($line_raw);
    /// $s_ref_userid = db_scalar("select s_username from ngo_service_cate where scate_id = '$s_ref_userid'");
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
                <? if ($scate_id == '') { ?>
                Add
                <? } else { ?>
                Update
                <? } ?>
                Services Category</h4>
            </div>
            <div class="col-lg-6">
              <div class="d-none d-lg-block">
                <ol class="breadcrumb m-0 float-end">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Services</a></li>
                  <li class="breadcrumb-item active">
                    <? if ($scate_id == '') { ?>
                    Add
                    <? } else { ?>
                    Update
                    <? } ?>
                    Services Category</li>
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
                                          <label class="col-md-2 col-form-label" for="simpleinput">Service Cate
                                          <!--<span class="text-danger text-lg">*</span>-->
                                          </label>
                                          <div class="col-md-10">
                                            <?php
                                              $sql_scate = "SELECT scate_id, scate_name FROM ngo_service_cate WHERE scate_parentid IS NULL AND scate_status='Active' ORDER BY scate_id";
                                             // echo make_dropdown($sql_scate, 'scate_parentid', $scate_parentid, 'class="form-control" style="width: 100%;color:#000;"  onchange="location.href=\'' . $_SERVER['PHP_SELF'] . '?scate_parentid=\'+this.value"', 'Select Service Category');
											 
											  echo make_dropdown($sql_scate, 'scate_parentid', $scate_parentid, 'class="form-control" style="width: 100%;color:#000;" ', 'Select Service Category');
                                              ?>  
                                          </div>
                                        </div>
                                        <div class="mb-2 row">
                                          <label class="col-md-2 col-form-label" for="simpleinput">Category Name <span class="text-danger text-lg">*</span></label>
                                          <div class="col-md-10">
                                            <input type="text" id="simpleinput" class="form-control" name="scate_name" value="<?=$scate_name?>" alt="blank" emsg="Enter the Service title" placeholder="Service title">
                                          </div>
                                        </div>




                                        <?php if ($scate_image != '') { ?>
                                            <div class="mb-2 row">
                                              <label class="col-md-2 col-form-label" for="example-fileinput">Current services category image</label>
                                              <div class="col-md-10">
                                                <img src="<?= UP_FILES_WS_PATH . '/servicescategory/' . $scate_image ?>" width="98" /><br>
                                                Delete
                                                <input type="checkbox" name="scate_image_del" value="1" class="maintxt">
                                              </div>
                                            </div>
                                          <?php } ?> 

                                          <div class="mb-2 ro w">
                                            <label class="col-md-2 col-form-label" for="example-fileinput">scate_image (778x 400px) <span class="text-danger text-lg">*</span></label>
                                            <div class="col-md-10">
                                              <input type="file" class="form-control" id="example-fileinput" name="scate_image">
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
                                            <input type="hidden" name="scate_id" id="scate_id" value="<?=$scate_id?>">
                                            <!--<input name="old_s_image" type="hidden" class="txtbox" id="old_s_image" value="<?= $s_image ?>" />-->
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
