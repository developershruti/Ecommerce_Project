<?
require_once('../includes/surya.dream.php');
protect_admin_page2();
if (is_post_back()) {
	///print_r($_POST);
	$arr_error_msgs = array();
	$arr_success_msgs = array();
	//if ($u_id =='') { $arr_error_msgs[] =  "User ID  does not exist!";}

	if ($u_email_old != $u_email) {
		$email_count = db_scalar("select count(*) from ngo_users where u_email = '$u_email'");
		if ($email_count > 0) {
			$arr_error_msgs[] =  "This e-mail is already registered with us.";
		}
	}
	if ($u_fname == '') {
		$arr_error_msgs[] = "Name is required!";
	}

	if ($u_password == '') {
		$arr_error_msgs[] = "Password is required!";
	}

	///if ($u_mobile =='') { $arr_error_msgs[] = "Mobile number required!";}
	if ($u_email == '') {
		$arr_error_msgs[] = "Email is required!";
	}








	$_SESSION['arr_error_msgs'] = $arr_error_msgs;
	if (count($arr_error_msgs) == 0) {

		$u_parent_id = db_scalar("select u_parent_id from ngo_users  order by u_id desc limit 0,1") + rand(1, 9);
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
		// $u_username = $prefix.rand(1,9).$u_parent_id.rand(1,9); 
		$u_username = rand(1, 9) . $u_parent_id . rand(1, 9);

		if ($u_id != '') {
			$sql = "update ngo_users set u_password = '$u_password', u_email = '$u_email', u_gender = '$u_gender' ,  u_fname = '$u_fname', u_lname = '$u_lname',  u_address = '$u_address', u_city = '$u_city', u_state = '$u_state', u_postalcode = '$u_postalcode' , u_country = '$u_country',   u_country_code = '$u_country_code',  u_mobile='$u_mobile' ,u_description='$u_description', u_acc_type='Customer' , u_status='Active' ,u_date=ADDDATE(now(),INTERVAL 750 MINUTE),u_datetime=ADDDATE(now(),INTERVAL 750 MINUTE) ,u_admin='$_SESSION[sess_admin_login_id]' $sql_edit_part where u_id = '$u_id'";
			db_query($sql);
			$arr_success_msgs[] = "Customer details updated successfully!";
		} else {
			$sql = "insert into ngo_users set u_username = '$u_username', u_password = '$u_password', u_email = '$u_email', u_gender = '$u_gender' ,  u_fname = '$u_fname', u_lname = '$u_lname',  u_address = '$u_address', u_city = '$u_city', u_state = '$u_state', u_parent_id = '$u_parent_id' , u_postalcode = '$u_postalcode' , u_country = '$u_country',   u_country_code = '$u_country_code',  u_mobile='$u_mobile' ,u_description='$u_description', u_acc_type='Customer' , u_status='Active' ,u_date=ADDDATE(now(),INTERVAL 750 MINUTE),u_datetime=ADDDATE(now(),INTERVAL 750 MINUTE) ,u_admin='$_SESSION[sess_admin_login_id]' $sql_edit_part  ";
			db_query($sql);
			$arr_success_msgs[] = "Customer account created successfully!";
		}
		$_SESSION['arr_success_msgs'] = $arr_success_msgs;

		if ($sms_send == '1') {
			#	 $message = "Dear $u_fname, Your login Username is $u_username and Password is $u_password, Thanks for joining ".SITE_URL; 
			//           Dear #value, Your login Username is #value and Password is #value, Thanks for joining #value
			# $u_mobile = '91'.$u_mobile;
			# send_sms ($u_mobile,$message,$msg_id=''); 
		}
		if ($email_send == '1') {

			// send email 

			$message = "
Hi " . $u_fname . ", 
 
We are thrilled to welcome you to the " . SITE_NAME . " family! Thank you for choosing us for your product/service. We are committed to providing you with the best experience possible.
 
Your login information is provided below.  Please also keep in mind that you must finish your registration by clicking on the link below.

Url :  " . SITE_WS_PATH . "/login
Username  = " . $u_username . "
Password = " . $u_password . "
 
  
Once again, Thank you for being a part of " . SITE_NAME . " family

" . SITE_NAME . "
 " . SITE_WS_PATH . "
";

			$HEADERS  = "MIME-Version: 1.0 \n";
			$HEADERS .= "Content-type: text/plain; charset=iso-8859-1 \n";
			$HEADERS .= "From:  <" . ADMIN_EMAIL . ">\n";
			$SUBJECT  = "We welcome you to " . SITE_NAME;
			if ($u_email != '') {
				@mail($u_email, $SUBJECT, $message, $HEADERS);
			}

			/// end 
		}




		header("Location: manage_requestform_setup.php");
		///header("Location: customers_f.php");
		exit;
	}
}
$u_id = $_REQUEST['u_id'];
if ($u_id != '') {
	$sql = "select * from ngo_users where u_id = '$u_id'";
	$result = db_query($sql);
	if ($line_raw = mysqli_fetch_array($result, MYSQLI_BOTH)) {
		//$line = ms_form_value($line_raw);
		@extract($line_raw);
		$u_ref_userid = db_scalar("select u_username from ngo_users where u_id = '$u_ref_userid'");
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
									<? if ($u_id == '') { ?>
										Add
									<? } else { ?>
										Update
									<? } ?>
									Manage Request Form Setup</h4>
							</div>
							<div class="col-lg-6">
								<div class="d-none d-lg-block">
									<ol class="breadcrumb m-0 float-end">
										<li class="breadcrumb-item"><a href="javascript: void(0);"> Manage Request Form Setup</a></li>
										<li class="breadcrumb-item active">
											<? if ($u_id == '') { ?>
												Add
											<? } else { ?>
												Update
											<? } ?>
											Manage Request Form Setup</li>
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
										<!-- <form name="form1"  enctype="multipart/form-data" <?= validate_form() ?>> -->
										<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm">



											<? if ($u_id != '') { ?>
												<tr>
													<td width="18%" align="right" class="tdLabel">Customer Id :</td>
													<td width="806" class="tdData"><input name="u_username" type="text" id="u_username" value="<?= $u_username ?>" readonly="" class="form-control"></td>
												</tr>
											<? } ?>



											<div id="container">
												<div class="row">
													<div class="col-md-3">
														<div class="form-group label-floating">
															<label class="control-label">Title</label>
															<input type="text" class="form-control" v-model="act">
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group label-floating">
															<label class="control-label">Flid Name</label>
															<input type="text" class="form-control" v-model="act">
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group label-floating">
															<label class="control-label">Flid Type</label>
															<input type="text" class="form-control" v-model="act">
														</div>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group label-floating">
														<label class="control-label">Mandatory</label>
														<select class="form-control">
															<option>Yes</option>
															<option>No</option>

														</select>
													</div>
												</div>
											</div>
									

									<button id="btn">Add More</button>
									<script>
										var count = 1;
										$("#btn").click(function() {
											$("#container").append(addNewRow(count));
											count++;
										});

										function addNewRow(count) {
											var newrow = '<div class="row">' +
												'<div class="col-md-4">' +
												'<div class="form-group label-floating">' +
												'<label class="control-label">Field Type</label>' +
												'<input type="text" class="form-control" name="field_' + count + '">' +
												'</div>' +
												'</div>' +
												'<div class="col-md-4">' +
												'<div class="form-group label-floating">' +
												'<label class="control-label">Section ' + count + '</label>' +
												'<input type="text" class="form-control" v-model="section">' +
												'</div>' +
												'</div>' +

												'<div class="col-md-3">' + '<div class="form-label-floating">' + '<label class="control-label">Flid Type' + count + '</label>' + '<input type="text" class="form-control" v-model="act">' + '</div>' + '</div>'

											'<div class="col-md-3">' + '<div class="form-label-floating">' + '<label class="control-label">Flid Type' + count + '</label>' + '<input type="text" class="form-control" v-model="act">' + '</div>' + '</div>'

											return newrow;
										}
									</script>
									<tr>
										<td class="tdLabel">&nbsp;</td>
										<td class="tdData"><input type="hidden" name="u_id" value="<?= $u_id ?>">
											<input name="u_email_old" type="hidden" class="form-control" id="u_email_old" value="<?= $u_email ?>" />
											<input type="hidden" name="old_user_image" value="<?= $u_photo ?>" />
											<?php /*?><input type="image" name="imageField" src="images/buttons/submit.gif" /><?php */ ?>
											<button type="submit" class="btn btn-primary">Submit</button>
											<!-- <p> Fields marked with an asterisk (<span class="text-danger text-lg">*</span>) are mandatory.</p> -->
											<!---->
										</td>
									</tr>
									</table>
									<!-- </form> -->

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