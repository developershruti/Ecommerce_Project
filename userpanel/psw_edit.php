<?php
include("../includes/surya.dream.php");
protect_user_page();
/*
if ($_SESSION['sess_security_code2']=='') {
	$_SESSION['sess_back']=basename($_SERVER['PHP_SELF'])."?".$_SERVER['QUERY_STRING'];
	 header("location: security_code_otp.php");
	 exit;
  }
 #print_r($_POST);
*/
 if (is_post_back()) {
  @extract($_POST);
   $arr_error_msgs = array();
  $arr_success_msgs = array();
   //check if there is no error
   $query = "select u_password from ngo_users where u_password = '$oldpassword' and u_id= '$_SESSION[sess_uid]'";
  $chkpass = db_scalar($query);

  if ($chkpass == '') {
    $arr_error_msgs[] = "Please enter correct old password";
    //$msgs="";

  }

  if ($cnfpassword != $newpassword) {

    //$msgs="";
    $arr_error_msgs[] = "Your confirm password does not match with new password";
  }


  $_SESSION['arr_error_msgs'] = $arr_error_msgs;
  if (count($arr_error_msgs) == 0) {

    $oldpassword = ms_form_value($oldpassword);
    $newpassword = ms_form_value($newpassword);
    $cnfpassword = ms_form_value($cnfpassword);

    $query_update = "update ngo_users set u_password = '$newpassword' where u_password = '$oldpassword' and u_id= '$_SESSION[sess_uid]'";
    $res = db_query($query_update);
    //$msgs="You have successfully changed your password.";
    $arr_success_msgs[] = "Your password has been changed successfully.";
    $_SESSION['arr_success_msgs'] = $arr_success_msgs;
   /* header("location: psw_edit");
    exit;*/
  }
}

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head>
    <?php include('includes/extra_head.php') ?>
</head>

<body>
    <!-- Begin page -->
    <div class="layout-wrapper">
        <!-- ========== Left Sidebar ========== -->
        <?php include('includes/sidebar.php') ?>
        <!-- Start Page Content here -->
        <div class="page-content">
            <!-- ========== Topbar Start ========== -->
            <?php include('includes/header.php') ?>
            <!-- ========== Topbar End ========== -->
            <div class="px-3">
                <!-- Start Content-->
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="py-3 py-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 class="page-title mb-0">
                                   Change Password  <?php /// echo ($u_userid == '') ? "Change Password" : "Change Password"; ?>
                                </h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-none d-lg-block">
                                    <ol class="breadcrumb m-0 float-end">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Profile</a></li>
                                        <li class="breadcrumb-item active">
                                            Change Password  <?php /// echo ($u_userid == '') ? "Change Password" : "Change Password"; ?>
                                        </li>
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
                                    <div class="table-responsive">
                                        <?php include("../error_msg.inc.php"); ?>
                                        <form name="form1" method="post" enctype="multipart/form-data" <?= validate_form() ?>>
                                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm">
                                                

                                                <tr>
                                                    <td align="right" class="tdLabel">New Password <span class="text-danger text-lg">*</span>:</td>
                                                    <td class="tdData">
													<input type="password" name="newpassword" id="newpassword"   class="form-control" alt="blank" emsg="Please enter new password" placeholder="New password" />
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td align="right" class="tdLabel">Confirm Password <span class="text-danger text-lg">*</span>:</td>
                                                    <td class="tdData">
													<input type="password" name="cnfpassword" id="cnfpassword"   class="form-control" placeholder="Confirm Password" alt="blank" emsg="Please enter Confirm password" />
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td width="18%" align="right" class="tdLabel">Old Password <span class="text-danger text-lg">*</span>:</td>
                                                    <td width="806" class="tdData">
													<input type="password" id="oldpassword" name="oldpassword"   class="form-control" placeholder="Old Password" alt="blank" emsg="Please enter old password" />

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="tdLabel">&nbsp;</td>
                                                    <td class="tdData"><br>
                                                        <input type="hidden" name="u_userid" value="<?=$u_userid ?>">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <p> Fields marked with an asterisk (<span class="text-danger text-lg">*</span>) are mandatory.</p>
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
            <?php include('includes/footer.php') ?>
            <!-- end Footer -->
        </div>
        <!-- End Page content -->
    </div>
    <!-- END wrapper -->
    <!-- App js -->
    <?php include('includes/extra_footer.php') ?>

</body>

</html>
