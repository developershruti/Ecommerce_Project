<?
require_once('../includes/surya.dream.php');
protect_admin_page2();
if (is_post_back()) {
  ///print_r($_POST);
  $arr_error_msgs = array();
  $arr_success_msgs = array();
  //if ($zzzzzid =='') { $arr_error_msgs[] =  "User ID  does not exist!";}

  if ($_FILES['slider_image']['name'] != '') {
    // Create a new finfo object
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    // Get the MIME type of the uploaded file
    $mime_type = $finfo->file($_FILES['slider_image']['tmp_name']);

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

    if ($_FILES['slider_image']['name'] != '') {
      $slider_image_name = str_replace('.' . file_ext($_FILES['slider_image']['name']), '', $_FILES['slider_image']['name']) . '_' . md5(uniqid(rand(), true)) . '.' . file_ext($_FILES['slider_image']['name']);
      copy($_FILES['slider_image']['tmp_name'], UP_FILES_FS_PATH.'/slider/'.$slider_image_name);
      $update_photo = ", slider_image='$slider_image_name'";
    }

     if ($slider_image_del != '') {
      @unlink(UP_FILES_FS_PATH . '/slider/' . $old_slider_image);
      $update_photo = ", slider_image=''";
    }

    
 	// if($s_scate_sub_id!=''){ $update_subcate = " , s_scate_sub_id='$s_scate_sub_id'"; } 
 
    if ($slider_id != '') {
      $sql = "update ngo_slider set 
      slider_title = '$slider_title'" 
       . $update_photo . $update_subcate .",
       slider_subtitle = '$slider_subtitle',
        slider_shortdesc = '$slider_shortdesc' , 
        slider_button = '$slider_button' 
         where slider_id = '$slider_id'";
      db_query($sql);
      $arr_success_msgs[] = "slider details updated successfully!!";
    } else {
      $sql = "insert into ngo_slider set
       slider_title = '$slider_title'"
         . $update_photo . $update_subcate . ",
          slider_subtitle = '$slider_subtitle',
          slider_button = '$slider_button', 
          status = 'active',
           slider_shortdesc = '$slider_shortdesc'";
           
      db_query($sql);
      $arr_success_msgs[] = "slider created successfully!";
    }

    $_SESSION['arr_success_msgs'] = $arr_success_msgs;
    #	 $message = "Dear $s_fname, Your login Username is $s_username and Password is $s_password, Thanks for joining ".SITE_URL; 
    //           Dear #value, Your login Username is #value and Password is #value, Thanks for joining #value
    # $s_mobile = '91'.$s_mobile;
    # send_sms ($s_mobile,$message,$msg_id=''); 
	
	
	 header("Location: slider_list.php");
  	 ///header("Location: customers_f.php");
  	 exit;
	
  }
   
 
}

$slider_id = $_REQUEST['slider_id'];
if ($slider_id != '') {
  $sql = "select * from ngo_slider where slider_id = '$slider_id'";
  $result = db_query($sql);
  if ($line_raw = mysqli_fetch_array($result, MYSQLI_BOTH)) {
    //$line = ms_form_value($line_raw);
    @extract($line_raw);
    /// $s_ref_userid = db_scalar("select s_username from ngo_slider where slider_id = '$s_ref_userid'");
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
                  <? if ($slider_id == '') { ?>
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
                      <? if ($slider_id == '') { ?>
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
                                            <label class="col-md-2 col-form-label" for="simpleinput">Title <span class="text-danger text-lg">*</span></label>
                                            <div class="col-md-10">
                                              <input type="text" id="simpleinput" class="form-control" name="slider_title" value="<?= $slider_title ?>" alt="blank" emsg="Enter the Service title" placeholder="Title ">
                                            </div>
                                          </div>

                                          </div>
										  
									

                                          <div class="mb-2 row">
                                            <label class="col-md-2 col-form-label" for="simpleinput"> Subtitle Title <span class="text-danger text-lg">*</span></label>
                                            <div class="col-md-10">
                                              <input type="text" id="simpleinput" class="form-control" name="slider_subtitle" value="<?= $slider_subtitle ?>" alt="blank" emsg="Enter the Service title" placeholder="Subtitle ">
                                            </div>
                                          </div>

                                          <div class="mb-2 row">
                                            <label class="col-md-2 col-form-label" for="summernote">Description :</label>
                                            <div class="col-md-10">
                                              <textarea id="slider_shortdesc" class="summernote" name="slider_shortdesc" alt="blank" emsg="Enter service description" placeholder="Enter Description"><?= $slider_shortdesc ?></textarea>
                                            </div>
                                          </div>



                                          <?php if ($slider_image != '') { ?>
                                            <div class="mb-2 row">
                                              <label class="col-md-2 col-form-label" for="example-fileinput">Current slider image</label>
                                              <div class="col-md-10">
                                                <img src="<?= UP_FILES_WS_PATH . '/slider/' . $slider_image ?>" width="98" /><br>
                                                Delete
                                                <input type="checkbox" name="slider_image_del" value="1" class="maintxt">
                                              </div>
                                            </div>
                                          <?php } ?>

                                          <div class="mb-2 row">
                                            <label class="col-md-2 col-form-label" for="example-fileinput">slider_image (778x 400px) <span class="text-danger text-lg">*</span></label>
                                            <div class="col-md-10">
                                              <input type="file" class="form-control" id="example-fileinput" name="slider_image">
                                            </div>
                                          </div>

                                        



                                          <div class="mb-2 row">
                                              <label class="col-md-2 col-form-label" for="example-textarea">Slider Button <span class="text-danger text-lg">*</span></label>
                                              <div class="col-md-10">
                                                <input type="text" class="form-control" id="myeditor" name="slider_button" rows="5"></input>
                                              </div>
                                            </div>



                                          <div class="mb-2 row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-10">
                                              <input type="hidden" name="slider_id" value="<?= $slider_id ?>">
                                              <input name="old_slider_image" type="hidden" class="txtbox" id="old_slider_image" value="<?= $slider_image ?>" />
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