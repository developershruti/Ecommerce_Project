<?
require_once('../includes/surya.dream.php');
protect_admin_page2();
if (is_post_back()) {
	$arr_error_msgs = array();
	$arr_success_msgs = array();


	if ($adm_login_old != $adm_login) {
		$adm_login_count = db_scalar("select count(*) from ngo_admin where adm_login = '$adm_login'");
		if ($adm_login_count > 0) {
			$arr_error_msgs[] =  "Login Username is already taken. Please enter another one.";
		}
	}


	if ($adm_login2_old != $adm_login2) {
		$adm_login2_count = db_scalar("select count(*) from ngo_admin where adm_login2 = '$adm_login2'");
		if ($adm_login2_count > 0) {
			$arr_error_msgs[] =  "Login Access Code is already taken. Please enter another one.";
		}
	}



	$_SESSION['arr_error_msgs'] = $arr_error_msgs;
	if (count($arr_error_msgs) == 0) {

		/*if (is_array($permission_check)) {
			$adm_permission = implode(',', $permission_check);
		}*/
		/*
	
	if($_POST['adm_picture_del']!='') {
		$sql_edit_part .= ", adm_picture = '' ";
	}
	if($_FILES['adm_picture']['name']!='') {
		$adm_picture_name = rawurlencode($_FILES['adm_picture']['name']).'-'.md5(uniqid(rand(), true)).'.'.file_ext($_FILES['adm_picture']['name']);
		copy($_FILES['adm_picture']['tmp_name'], UP_FILES_FS_PATH.'/'.$adm_picture_name);
		$sql_edit_part .= ", adm_picture = '$adm_picture_name' ";
	}*/
		//adm_login = '$adm_login',
	 
			$sql = "update ngo_admin set adm_name = '$adm_name', adm_address = '$adm_address', adm_city = '$adm_city', adm_state = '$adm_state', adm_country = '$adm_country', adm_phone = '$adm_phone', adm_email = '$adm_email',adm_gender = '$adm_gender',adm_nationality ='$adm_nationality',adm_marital_status = '$adm_marital_status', adm_dob = '$adm_dob', adm_personal_email = '$adm_personal_email', adm_alt_mobile = '$adm_alt_mobile', adm_curr_address = '$adm_curr_address', adm_father_name = '$adm_father_name', adm_mother_name = '$adm_mother_name', adm_type = 'employee'   $sql_edit_part where adm_userid = $_SESSION[sess_admin_userid] ";
			db_query($sql);
			$arr_success_msgs[] = "Profile details updated successfully!";
		 
		$_SESSION['arr_success_msgs'] = $arr_success_msgs;
		/*header("Location: employee_list.php");
		exit;*/
	}
}

$adm_userid = $_SESSION['sess_admin_userid']; /// $_REQUEST['adm_userid']
if ($adm_userid != '') {
	$sql = "select * from ngo_admin where adm_userid = '$adm_userid'";
	$result = db_query($sql);
	if ($line_raw = mysqli_fetch_array($result)) {
		$line = ms_form_value($line_raw);
		@extract($line);
		$permission_check = explode(",", $adm_permission);
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
									<? if ($adm_userid == '') { ?>
										Add
									<? } else { ?>
										Update
									<? } ?>
									Profile</h4>
							</div>
							<div class="col-lg-6">
								<div class="d-none d-lg-block">
									<ol class="breadcrumb m-0 float-end">
										<li class="breadcrumb-item"><a href="javascript: void(0);">Accounts Settings</a></li>
										<li class="breadcrumb-item active">
											<? if ($adm_userid == '') { ?>
												Add
											<? } else { ?>
												Update
											<? } ?>
											Profile </li>
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
												<?php /*?><tr>
													<td width="18%" align="right" class="tdLabel">Login Username <span class="text-danger text-lg">* :</td>
													<td width="806" class="tdData">

														<input name="adm_login" type="text" id="adm_login" value="<?= $adm_login ?>" class="form-control" alt="blank" emsg="Login Username can not be blank">


														<input name="adm_login_old" type="hidden" class="form-control" id="adm_login_old" <? if ($line['adm_userid'] != '') {  ?> value="<?= $adm_login ?>" <? } else { ?> value="" <? } ?> />


														<!--<input name="adm_login" type="text" id="adm_login" value="<?= $adm_login ?>" <? if ($line['adm_login'] != '') { ?>readonly="" <? } ?> class="form-control">-->
													</td>
												</tr>

												<tr>
													<td width="18%" align="right" class="tdLabel">Password <span class="text-danger text-lg">*</span> :</td>
													<td width="806" class="tdData"><input name="adm_password" type="text" id="adm_password" value="<?= $adm_password ?>" class="form-control" alt="blank" emsg="Please enter the password"></td>
												</tr>

												<tr>
													<td width="18%" align="right" class="tdLabel">Login Access Code <span class="text-danger text-lg">*</span> :</td>
													<td width="806" class="tdData"><input name="adm_login2" type="text" id="adm_login2" value="<?= $adm_login2 ?>" class="form-control" alt="blank" emsg="Login Access Code can not be blank">
														<input  name="adm_login2_old" type="hidden" class="form-control" id="adm_login2_old" <? if ($line['adm_userid'] != '') {  ?> value="<?= $adm_login2 ?>" <? } else { ?> value="" <? } ?> />
													</td>
												</tr>

												<tr>
													<td width="18%" align="right" class="tdLabel">Access Pass <span class="text-danger text-lg">*</span> :</td>
													<td width="806" class="tdData"><input name="adm_password2" type="text" id="adm_password2" value="<?= $adm_password2 ?>" class="form-control" alt="blank" emsg="Access Pass can not be blank"></td>
												</tr><?php */?>
												<tr>
													<td width="18%" align="right" class="tdLabel">Name <span class="text-danger text-lg">*</span> :</td>
													<td width="806" class="tdData">
														<input name="adm_name" type="text" id="adm_name" value="<?= $adm_name ?>" class="form-control" alt="blank" emsg="Access Name can not be blank"></td>
												</tr>
												<tr>
													<td width="18%" align="right" class="tdLabel">Email <span class="text-danger text-lg">*</span> :</td>
													<td width="806" class="tdData">
														<input name="adm_email" type="text" id="adm_email" value="<?= $adm_email ?>" class="form-control" alt="blank" emsg="Email  can not be blank"></td>
												</tr>

												<tr>
													<td width="18%" align="right" class="tdLabel">Mobile :</td>
													<td width="806" class="tdData"><input name="adm_phone" type="text" id="adm_phone" value="<?= $adm_phone ?>" class="form-control"></td>
												</tr>

												<tr>
													<td align="right" valign="top" class="tdLabel">Gender : </td>
													<td align="left" valign="top"><span class="maintxt"> <?= gender_dropdown_emp($adm_gender, 'class="form-control" ') ?>
													</td>
												</tr>

												<!-- <tr>
													<td align="right" valign="top" class="tdLabel">Religion : </td>
													<td align="left" valign="top"><span class="maintxt"> <?= religion_dropdown('adm_religion', $adm_religion) ?>
													</td>
												</tr> -->

												<tr>
													<td align="right" valign="top" class="tdLabel">Nationality : </td>
													<td align="left" valign="top"><span class="maintxt"> <?= nationality_dropdown('adm_nationality', $adm_nationality) ?>
														</span></td>
												</tr>




												<tr>
													<td align="right" valign="top" class="tdLabel">Marital Status : </td>
													<td align="left" valign="top"><span class="maintxt"> <?= marital_status_dropdown('adm_marital_status', $adm_marital_status) ?>
													</td>
												</tr>

												<tr>
													<td width="18%" align="right" class="tdLabel">Date Of Birth :</td>
													<td width="806" class="tdData"><input name="adm_dob" type="date" id="adm_dob" value="<?= $adm_dob ?>" class="form-control"></td>
												</tr>



												<tr>
													<td width="18%" align="right" class="tdLabel">Current Address :</td>
													<td width="806" class="tdData">
														<input name="adm_curr_address" type="text" id="adm_curr_address" value="<?= $adm_curr_address ?>" class="form-control">
													</td>
												</tr>

												<tr>
													<td width="18%" align="right" class="tdLabel">Permanent Address :</td>
													<td width="806" class="tdData">
														<input name="adm_address" type="text" id="adm_address" value="<?= $adm_address ?>" class="form-control">
														<input type="checkbox" id="address_confirm" name="address_confirm" onClick="copyAddress()">
														<label for="address_confirm">Same as Current Address</label>
													</td>
												</tr>

											

												<tr>
													<td width="18%" align="right" class="tdLabel">Personal Email :</td>
													<td width="806" class="tdData"><input name="adm_personal_email" type="text" id="adm_personal_email" value="<?= $adm_personal_email ?>" class="form-control"></td>
												</tr>

												<tr>
													<td width="18%" align="right" class="tdLabel">Alternate Mobile :</td>
													<td width="806" class="tdData"><input name="adm_alt_mobile" type="text" id="adm_alt_mobile" value="<?= $adm_alt_mobile ?>" class="form-control"></td>
												</tr>


												<td width="18%" align="right" class="tdLabel">Father Name :</td>
												<td width="806" class="tdData"><input name="adm_father_name" type="text" id="adm_father_name" value="<?= $adm_father_name ?>" class="form-control"></td>
												</tr>
												<tr>
													<td width="18%" align="right" class="tdLabel">Mother Name :</td>
													<td width="806" class="tdData"><input name="adm_mother_name" type="text" id="adm_mother_name" value="<?= $adm_mother_name ?>" class="form-control"></td>
												</tr>


												<tr>
													<td class="tdLabel">&nbsp;</td>
													<td class="tdData"><br>
														<!--<input type="hidden" name="adm_userid" value="<?= $adm_userid ?>">-->
														<!--<input type="image" name="imageField" src="images/buttons/submit.gif" />-->

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
			<? include('includes/footer.php') ?>
			<!-- end Footer -->
		</div>
		<!-- End Page content -->
	</div>
	<!-- END wrapper -->
	<!-- App js -->
	<? include('includes/extra_footer.php') ?>

	<script>
			function Address() {
			if (document.getElementById('address_confirm').checked) {
				document.getElementById('adm_address').value = document.getElementById('adm_curr_address').value;
			} else {
				document.getElementById('adm_address').value = '';
			}
		}
	</script>
</body>

</html>