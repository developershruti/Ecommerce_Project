<?
require_once('../includes/surya.dream.php');
protect_admin_page2();
$faq_id = encryptor('decrypt', $faq_id_en);

if (is_post_back()) {
  ///print_r($_POST);
  $arr_error_msgs = array();
  $arr_success_msgs = array();
  //if ($faq_id =='') { $arr_error_msgs[] =  "User ID  does not exist!";}

  // if ($faq_email_old != $faq_email) {
  //   $email_count = db_scalar("select count(*) from ngo_faq where faq_email = '$faq_email'");
  //   if ($email_count > 0) {
  //     $arr_error_msgs[] =  "This e-mail is already registered with us.";
  //   }
  // }
  if ($faq_s_id == '') {
    $arr_error_msgs[] = "Service Cate is required!";
  }

  if ($faq_question == '') {
    $arr_error_msgs[] = "Question is required!";
  }

  ///if ($u_mobile =='') { $arr_error_msgs[] = "Mobile number required!";}
  if ($faq_answer == '') {
    $arr_error_msgs[] = "Answer is required!";
  }



  $_SESSION['arr_error_msgs'] = $arr_error_msgs;
  if (count($arr_error_msgs) == 0) {

    // $faq_parent_id = db_scalar("select faq_parent_id from ngo_faq  order by faq_id desc limit 0,1") + rand(1, 9);
    // $abc= array('A','B','C','D','E','F','G','H','I','J','K','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'); 
    /*	$abc= array('A','B','C','D','E','F','G','H','I','J','K','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'); 
		//	$abc= array('1','2','3','4','5','6','7','8','9'); 
  		$arr= array_rand($abc,2);
		$conf_num="";
		$conf_num.=$abc[$arr[0]];
		$conf_num.=$abc[$arr[1]];*/
    //$conf_num.=$abc[$arr[2]];
    //$conf_num.=$abc[$arr[3]];
    //$conf_num.=$abc[$arr[4]];
    //$prefix=$conf_num;
    //$prefix='PG';
    // $faq_username = $prefix.rand(1,9).$faq_parent_id.rand(1,9); 
     

    if ($faq_id != '') {
      $sql = "update ngo_faq set faq_question = '$faq_question', faq_s_id = '$faq_s_id', faq_answer = '$faq_answer' $sql_edit_part where faq_id = $faq_id";
      db_query($sql);
	  $arr_success_msgs[] = "Faq updated successfully!";
    } else {
      $sql = "insert into ngo_faq set faq_s_id = '$faq_s_id',  faq_question = '$faq_question', faq_answer = '$faq_answer', faq_status = 'Active' ";
      db_query($sql);
      $arr_success_msgs[] = "Faq created successfully!";
    }
    $_SESSION['arr_success_msgs'] = $arr_success_msgs;
 
    header("Location: faq_list.php?faq_s_id=$faq_s_id");
    ///header("Location: customers_f.php");
    exit;
  }
}
///$faq_id = $_REQUEST['faq_id'];
if ($faq_id!= '') {
  $sql = "select * from ngo_faq where faq_id = '$faq_id'";
  $result = db_query($sql);
  if ($line_raw = mysqli_fetch_array($result, MYSQLI_BOTH)) {
    //$line = ms_form_value($line_raw);
    @extract($line_raw);
    ///$faq_ref_userid = db_scalar("select faq_username from ngo_faq where faq_id = '$faq_ref_userid'");
  }
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head></head>
<? include('includes/extra_head.php') ?>

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
                  <? if ($faq_id == '') { ?>
                    Add
                  <? } else { ?>
                    Update
                  <? } ?>
                  Faq</h4>
              </div>
              <div class="col-lg-6">
                <div class="d-none d-lg-block">
                  <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Services</a></li>
                    <li class="breadcrumb-item active">
                      <? if ($faq_id == '') { ?>
                        Add
                      <? } else { ?>
                        Update
                      <? } ?>
                      Faq</li>
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
                        

                        <tr>
                          <td width="18%" align="right" class="tdLabel">Service Cate :</td>
                          <td>
                            <?php
                             $sql_faq = "SELECT s_id, concat(s_id, ' - ', s_title) FROM ngo_services WHERE s_status='Active' ORDER BY s_id ";
                            echo make_dropdown($sql_faq, 'faq_s_id', $faq_s_id, 'class="form-control"  style="width: 100%;color:#000;" alt="select" emsg="Select Service Category"', 'Select Service Category');
                            ?>
                          </td>
                        </tr>

                        <tr>
                          <td width="18%" align="right" class="tdLabel">Question <span class="text-danger text-lg">*</span> :</td>
                          <td width="806" class="tdData">
                            <input name="faq_question" type="text" id="faq_question" value="<?=$faq_question?>" class="form-control" alt="blank" emsg="Please enter first name">
                          </td>
                        </tr>

                        <tr>
                          <td align="right" valign="top" class="tdLabel">Answer:</td>
                          <td class="tdData">
                            <textarea name="faq_answer" cols="80" id="faq_answer" class="form-control" rows="6"><?=$faq_answer?></textarea>
                          </td>
                        </tr>

                        <tr>
                          <td class="tdLabel"> </td>
                          <td class="tdData">
                            <input type="hidden" name="faq_id" value="<?=$faq_id?>">
                             <button type="submit" class="btn btn-primary">Submit</button>
                            <p>Fields marked with an asterisk (<span class="text-danger text-lg">*</span>) are mandatory.</p>
                          </td>
                        </tr>
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