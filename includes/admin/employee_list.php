<?
require_once("../includes/surya.dream.php");
protect_admin_page2();

if(is_post_back()) {
 		 
 	$arr_adm_userids = $_REQUEST['arr_adm_userids'];
	if(is_array($arr_adm_userids)) {
		$str_adm_userids = implode(',', $arr_adm_userids); 
		if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']) ) {
			$sql = "update  ngo_admin set adm_status = 'Active' where adm_userid in ($str_adm_userids)";
			db_query($sql);	
  		
		} else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) ) {
			$sql = "update  ngo_admin set adm_status = 'Inactive' where adm_userid in ($str_adm_userids)";
			db_query($sql);
		  
		} else if(isset($_REQUEST['Banned2']) || isset($_REQUEST['Banned2_x']) ) {
 		  	$sql = "update ngo_admin set adm_status = 'Banned' , adm_blocked_msg = '$adm_blocked_msg' where adm_userid in ($str_adm_userids)";
			db_query($sql);	
  		}
		 
	header("Location: ".$_SERVER['HTTP_REFERER']);
	exit;
  }
}

$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql = " from ngo_admin ";
$sql .= " where adm_type='employee' ";
// $sql .= " and adm_acc_type='2'";

//if ($adm_username!='') 		{$sql .= " and adm_username='$adm_username' "; }
if ($adm_phone!='') 		{$sql .= " and adm_phone='$adm_phone' "; }
//if ($adm_acc_type!='') 		{$sql .= " and adm_acc_type='$adm_acc_type' "; }
//if ($adm_status!='') 			{$sql .= " and adm_status='$adm_status' "; }
$sql = apply_filter($sql, $adm_name, $adm_name_filter,'adm_name');
if ($adm_email!='') 			{$sql .= " and adm_email like '%$adm_email%' "; }
//if ($adm_city!='') 			{$sql .= " and adm_city like '%$adm_city%' "; }
//if ($datefrom!='' && $dateto!='') {  $sql .= " and adm_date between '$datefrom' AND '$dateto' ";} 
//if ($adm_coordinator!='') 			{$sql .= " and adm_coordinator='$adm_coordinator' "; }

  
 
$order_by == '' ? $order_by = 'adm_userid' : true;
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
                                <h4 class="page-title mb-0">Employee List</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-none d-lg-block">
                                    <ol class="breadcrumb m-0 float-end">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Accounts</a></li>
                                        <li class="breadcrumb-item active">Employee List</li>
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
                                                    <td><input name="adm_name" class="form-control" type="text" value="<?=htmlspecialchars($adm_name) ?>" /></td>
                                                    <td nowrap="nowrap"><?= filter_dropdown('adm_name_filter', $adm_name_filter) ?></td>
                                                    <td class="tdLabel" align="right" nowrap="nowrap">Email:</td>
                                                    <td><input name="adm_email" type="text" class="form-control" value="<?=htmlspecialchars($adm_email) ?>"></td>
                                                    <td class="tdLabel" align="right" nowrap="nowrap">Mobile:</td>
                                                    <td><input name="adm_phone" type="text" class="form-control" value="<?=htmlspecialchars($adm_phone) ?>"></td>
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
											 <a class="btn btn-primary float-right" href="employee_f.php">Add Employee</a>
											 </div></div>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <form method="post" name="form1" id="form1" onsubmit="confirm_submit(this)">
                                               
                                                 <table width="100%"  border="0" cellpadding="0" cellspacing="1" class="table table-bordered mb-0">
                      <thead class="table-light">
                        <tr>
                          <th width="8%" nowrap="nowrap">#
                            <?= sort_arrows('adm_userid')?></th>
                          <th width="9%" nowrap="nowrap">Employee Id </th>
                          <th width="9%" nowrap="nowrap">Email </th>
                          <th width="8%" nowrap="nowrap">Password </th>
                          <th width="12%" nowrap="nowrap"> Name </th>
                          <!-- <th width="12%" nowrap="nowrap"> City </th> -->
                          <!-- <th width="12%" nowrap="nowrap"> State </th> -->
                          <th width="6%" nowrap="nowrap">Phone </th>
                          <th width="8%" nowrap="nowrap">DOJ
                            <?= sort_arrows('adm_date')?></th>
                          <th width="5%" nowrap="nowrap">Status</th>
                          <!-- <th width="6%">&nbsp;</th>-->
                          <th width="2%">&nbsp;</th>
                          <th width="2%"><input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" /></th>
                        </tr>
                      </thead>
                      <?
		while ($line_raw = mysqli_fetch_array($result)) {
	$line = ms_display_value($line_raw);
	@extract($line);
	$css = ($css=='trOdd')?'trEven':'trOdd';
	$user_full_name=$adm_fname." ".$adm_lname;
 	//$income = db_scalar("SELECT(SUM(IF(pay_drcr='Cr',pay_amount,''))-SUM(IF(pay_drcr='Dr',pay_amount,''))) as balance FROM  ngo_admin_payment where pay_userid='$adm_userid'");
	//$ewallet = db_scalar("SELECT (SUM(IF(pay_drcr='Cr',pay_amount,''))-SUM(IF(pay_drcr='Dr',pay_amount,''))) as balance FROM  ngo_admin_ewallet where pay_userid='$adm_userid'");
	//$coin_balance = db_scalar("SELECT (SUM(IF(pay_drcr='Cr',pay_amount,''))-SUM(IF(pay_drcr='Dr',pay_amount,''))) as balance FROM  ngo_admin_coin where pay_userid='$adm_userid'");
 	//$topup_amount = db_scalar("select max(topup_amount) from  ngo_admin_recharge where topup_userid='$adm_userid' and topup_status='Paid'");
  	///$total_direct = db_scalar("select count(*) from  ngo_admin  where adm_ref_userid='$adm_userid' and adm_userid in (select topup_userid from  ngo_admin_recharge)");
	if ($topup_amount>0) {$css = 'td_green';}  else {$css = 'td_red';} 
	if ($adm_status=='Banned') {$css = 'highlight';} 
	else if ($adm_status=='Inactive') {$css = 'td_sky';}  
	//db_scalar("select utype_code from  ngo_admin_type where utype_id='$adm_utype'");
?>
                      <tr class="<?=$css?>">
                        <td  ><?=$adm_userid?></td>
                        <td  ><?=$adm_login?></td>
                        <td ><?=$adm_email?></td>
                        <td ><?=$adm_password?></td>
                        <td  ><?=$adm_name?> </td>
                        <td><?=$adm_phone?></td>
                        <td ><?=datetime_format($adm_date)?></td>
                        <td><? ///=$adm_status?>
						
						<?php if ($adm_status == 'Active') { ?>
                                                                        <button type="button" class="btn btn-success btn-sm waves-effect waves-light"><?= $adm_status ?></button>
                                                                    <?php } else if ($adm_status == 'Inactive') { ?>
                                                                        <button type="button" class="btn btn-info btn-sm waves-effect waves-light"><?= $adm_status ?></button>
                                                                    <?php } else { ?>
                                                                        <button type="button" class="btn btn-danger btn-sm waves-effect waves-light" title="<?= htmlspecialchars($u_blocked_msg) ?>"><?= $adm_status ?></button>
                                                                    <?php } ?>
						
						</td>
                        <td align="center"><a href="employee_f.php?adm_userid=<?=$adm_userid?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a></td>
                        <td align="center"><input name="arr_adm_userids[]" type="checkbox" id="arr_adm_userids[]" value="<?=$adm_userid?>"/></td>
                      </tr>
                      <? }
?>
                    </table>
                                                <table width="100%">
                                                    <tr>
                                                        <td width="15%" align="left">
                                                            <input name="adm_blocked_msg" type="text" class="form-control" placeholder="Reason In Case of blocking Employee" style="float:right;" />
                                                        </td>
                                                        <td width="25%" align="right" style="padding:2px">
                                                            <input name="Banned2" type="image" src="images/buttons/block_id.gif" onClick="return blockConfirmFromUser('arr_adm_userids[]')" />
                                                            <input name="Activate" type="image" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_adm_userids[]')" />
                                                            <input name="Deactivate" type="image" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_adm_userids[]')" />
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
