<?
require_once("../includes/surya.dream.php");
protect_admin_page2();

if ($act=='login') {
		$sql = "select * from ngo_users where  u_username = '$username'  ";
		$result = db_query($sql);
		$line= mysqli_fetch_array($result);
		@extract($line);
 		$_SESSION['sess_uid'] 		= $u_id;
		$_SESSION['sess_username'] 	= $u_username;
		$_SESSION['sess_username2'] = $u_username2;
    	$_SESSION['sess_email']		= $u_email;
   		$_SESSION['sess_mobile']		= $u_mobile;
		$_SESSION['sess_fname']		= $u_fname;
		$_SESSION['sess_date']		= $u_date;
 		//$_SESSION['sess_security_code']= $u_password2;
		$_SESSION['sess_plan'] = 'Admin';
		header("Location: ../userpanel/myaccount.php");
		exit;
}
if(is_post_back()) {
 		if((isset($_REQUEST['Banned']) || isset($_REQUEST['Banned_x'])) && ($block_ids!='')) {
		 	$sql = "update ngo_users set u_status = 'Banned', u_blocked_msg='$u_blocked_msg' where u_id in ($block_ids)";
			db_query($sql);
			$msg="User ID blocked Successfully!";
 		/*}else if((isset($_REQUEST['Submit']) || isset($_REQUEST['Submit_x'])) && ($block_ids!='')) {
		  	$sql = "update ngo_users set u_blocked_msg='$u_blocked_msg' where u_id in ($block_ids)";
			db_query($sql);	
			$msg="message update successfully !";*/
 		}
		
 	$arr_u_ids = $_REQUEST['arr_u_ids'];
	if(is_array($arr_u_ids)) {
		$str_u_ids = implode(',', $arr_u_ids); 
		
		if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']) ) {
			$sql = "update ngo_users set u_status = 'Active' where u_id in ($str_u_ids)";
			db_query($sql);	
  		
		} else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) ) {
			$sql = "update ngo_users set u_status = 'Inactive' where u_id in ($str_u_ids)";
			db_query($sql);
		  
		}else if(isset($_REQUEST['Banned2']) || isset($_REQUEST['Banned2_x']) ) {
			$sql = "update ngo_users set u_status = 'Banned', u_blocked_msg = '$u_blocked_msg' where u_id in ($str_u_ids)";
 		  	///$sql = "update ngo_users set  where u_id in ($str_u_ids)";
			db_query($sql);	
  		}
		 
	header("Location: ".$_SERVER['HTTP_REFERER']);
	exit;
  }
}

$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql = " from ngo_users ";
$sql .= " where 1 ";
//$sql .= " and u_acc_type='1'";
//if ($u_username!='') 		{$sql .= " and u_username='$u_username' "; }
if ($u_email!='') 		{$sql .= " and u_email='$u_email' "; }

//if ($u_acc_type!='') 		{$sql .= " and u_acc_type='$u_acc_type' "; }
//if ($u_status!='') 			{$sql .= " and u_status='$u_status' "; }
$sql = apply_filter($sql, $u_fname, $u_fname_filter,'u_fname');

if ($u_mobile!='') 		{$sql .= " and u_mobile='$u_mobile' "; }
///if ($u_city!='') 			{$sql .= " and u_city like '%$u_city%' "; }
//if ($datefrom!='' && $dateto!='') {  $sql .= " and u_date between '$datefrom' AND '$dateto' ";} 
//if ($u_coordinator!='') 			{$sql .= " and u_coordinator='$u_coordinator' "; }

  
 
$order_by == '' ? $order_by = 'u_id' : true;
$order_by2 == '' ? $order_by2 = 'desc' : true;
$sql_count = "select count(*) ".$sql; 
$sql .= "order by $order_by $order_by2 ";
$sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);



?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">
<head>
    <?php include('includes/extra_head.php'); ?>
</head>
<body>
    <!-- Begin page -->
    <div class="layout-wrapper">
        <!-- ========== Left Sidebar ========== -->
        <?php include('includes/sidebar.php'); ?>
        <!-- Start Page Content here -->
        <div class="page-content">
            <!-- ========== Topbar Start ========== -->
            <?php include('includes/header.php'); ?>
            <!-- ========== Topbar End ========== -->
            <div class="px-3">
                <!-- Start Content-->
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="py-3 py-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 class="page-title mb-0">Customer List</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-none d-lg-block">
                                    <ol class="breadcrumb m-0 float-end">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Accounts</a></li>
                                        <li class="breadcrumb-item active">Customer List</li>
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
                                    <h4 class="header-title">Search</h4>
                                    <div class="table-responsive">
                                        <form method="get" name="form2" id="form2" onsubmit="return confirm_submit(this)">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td class="tdLabel" align="right" nowrap="nowrap">Name:</td>
                                                    <td><input name="u_fname" class="form-control" type="text" value="<?= htmlspecialchars($u_fname) ?>" /></td>
                                                    <td nowrap="nowrap"><?= filter_dropdown('u_fname_filter', $u_fname_filter) ?></td>
                                                    <td class="tdLabel" align="right" nowrap="nowrap">Email:</td>
                                                    <td><input name="u_email" type="text" class="form-control" value="<?= htmlspecialchars($u_email) ?>"></td>
                                                    <td class="tdLabel" align="right" nowrap="nowrap">Mobile:</td>
                                                    <td><input name="u_mobile" type="text" class="form-control" value="<?= htmlspecialchars($u_mobile) ?>"></td>
                                                    <td align="right">
                                                        <input name="pagesize" type="hidden" id="pagesize" value="<?= htmlspecialchars($pagesize) ?>" />
                                                        <button type="submit" class="btn btn-primary">Search</button>
                                                    </td>
                                                    <input type="hidden" name="u_id" value="<?= htmlspecialchars($u_id) ?>" />
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php include("../error_msg.inc.php"); ?>
                                    <?php if (mysqli_num_rows($result) == 0) { ?>
									<div class="grid-structure">
                                            <div class="row">
											
                                                <div class="col-lg-6 text-left">
                                                    <div class="grid-container display-flex lh-25">
                                                        Records Per Page: <?= pagesize_dropdown('pagesize', $pagesize); ?>
                                                    </div>
                                                </div>
                                                 
												 <div class="col-lg-6 "> <div class="grid-container lh-25">
											 <a class="btn btn-primary float-right" href="employee_f.php">Add Employee</a>
											 </div></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="msg">Sorry, no records found.</div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="grid-structure">
                                            <div class="row">
											
                                                <div class="col-lg-4 text-left">
                                                    <div class="grid-container display-flex lh-25">
                                                        Records Per Page: <?= pagesize_dropdown('pagesize', $pagesize); ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 text-center">
                                                    <div class="grid-container lh-25">
                                                        Showing Records:
                                                        <?= $start + 1 ?> to <?= ($reccnt < $start + $pagesize) ? ($reccnt - $start) : ($start + $pagesize) ?> of <?= $reccnt ?>
                                                    </div>
                                                </div>
												 <div class="col-lg-4 "> <div class="grid-container lh-25">
											 <a class="btn btn-primary float-right" href="customers_f.php">Add Customer</a>
											 </div></div>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <form method="post" name="form1" id="form1" onsubmit="confirm_submit(this)">
                                               
                                                <table class="table table-bordered mb-0">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th nowrap="nowrap"># <?= sort_arrows('u_id') ?></th>
                                                            <th nowrap="nowrap">Customer Id</th>
                                                            <th nowrap="nowrap">Email</th>
                                                            <th nowrap="nowrap">Password</th>
                                                            <th nowrap="nowrap">Name</th>
                                                            <th nowrap="nowrap">Mobile</th>
                                                            <th nowrap="nowrap">Company Name</th>
                                                            <th nowrap="nowrap">Address</th>

                                                            <th nowrap="nowrap">City</th>
                                                            <th nowrap="nowrap">DOJ <?= sort_arrows('u_date') ?></th>
 															<th nowrap="nowrap">Status</th>
															<th nowrap="nowrap">Edit</th>
                                                            <th><input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" /></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php while ($line_raw = mysqli_fetch_array($result)) {
                                                            $line = ms_display_value($line_raw);
                                                            @extract($line);
                                                            $css = ($css == 'trOdd') ? 'trEven' : 'trOdd';
                                                            $user_full_name = htmlspecialchars($u_fname . " " . $u_lname);
                                                            if ($topup_amount > 0) { $css = 'td_green'; }
                                                            else { $css = 'td_red'; }
                                                            if ($u_status == 'Banned') { $css = 'highlight'; }
                                                            else if ($u_status == 'Inactive') { $css = 'td_sky'; }
                                                        ?>
                                                            <tr class="<?= $css ?>">
                                                                <td><?= htmlspecialchars($u_id) ?></td>
                                                                <td><a href="users_list.php?act=login&username=<?= urlencode($u_username) ?>" target="_blank"><?= htmlspecialchars($u_username) ?></a></td>
                                                                <td><?= htmlspecialchars($u_email) ?></td>
                                                                <td><?= htmlspecialchars($u_password) ?></td>
                                                                <td title="<?= $user_full_name ?>"><?= str_stop($user_full_name, 20) ?></td>
                                                                <td><?= htmlspecialchars($u_mobile) ?></td>
                                                                <td><?= htmlspecialchars($u_company_name) ?></td>
                                                                <td><?= htmlspecialchars($u_address) ?></td>
                                                                <td><?= htmlspecialchars($u_city) ?></td>
                                                                <td><?= datetime_format($u_date) ?></td>
                                                                <td>
                                                                    <?php if ($u_status == 'Active') { ?>
                                                                        <button type="button" class="btn btn-success btn-sm waves-effect waves-light"><?= $u_status ?></button>
                                                                    <?php } else if ($u_status == 'Inactive') { ?>
                                                                        <button type="button" class="btn btn-info btn-sm waves-effect waves-light"><?= $u_status ?></button>
                                                                    <?php } else { ?>
                                                                        <button type="button" class="btn btn-danger btn-sm waves-effect waves-light" title="<?= htmlspecialchars($u_blocked_msg) ?>"><?= $u_status ?></button>
                                                                    <?php } ?>
                                                                </td>
                                                                <td align="center"><a href="customers_f.php?u_id_en=<?= encryptor('encrypt', $u_id) ?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" /></a></td>
                                                                <td align="center"><input name="arr_u_ids[]" type="checkbox" value="<?= htmlspecialchars($u_id) ?>" /></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                                <table width="100%">
                                                    <tr>
                                                        <td width="15%" align="left">
                                                            <input name="u_blocked_msg" type="text" class="form-control" placeholder="Reason In Case of blocking Customer" style="float:right;" />
                                                        </td>
                                                        <td width="25%" align="right" style="padding:2px">
                                                            <input name="Banned2" type="image" src="images/buttons/block_id.gif" onClick="return blockConfirmFromUser('arr_u_ids[]')" />
                                                            <input name="Activate" type="image" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_u_ids[]')" />
                                                            <input name="Deactivate" type="image" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_u_ids[]')" />
                                                        </td>
                                                    </tr>
                                                </table>
                                            </form>
                                        </div>
                                    <?php } ?>
                                    <?php include("paging.inc.php"); ?>
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
            <?php include('includes/footer.php'); ?>
            <!-- end Footer -->
        </div>
        <!-- End Page content -->
    </div>
    <!-- END wrapper -->
    <!-- App js -->
    <?php include('includes/extra_footer.php'); ?>
</body>
</html>
