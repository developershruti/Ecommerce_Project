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
		$_SESSION['sess_plan'] 		= 'Admin';
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
		if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']) ){
 			// $total_count = db_scalar("select count(*) from ngo_users where u_id in ($str_u_ids)");
			// $u_closeid = db_scalar("select u_closeid from ngo_users where u_id in ($str_u_ids)");
			// $sql = "delete from ngo_users where u_id in ($str_u_ids)";
			// db_query($sql);
			// $sql_update="update ngo_closing set close_achieve=close_achieve-$total_count where close_id='$u_closeid'";
 			// db_query($sql_update);
 		}else if(isset($_REQUEST['Submit_password']) || isset($_REQUEST['Submit_password_x']) ) {
 			$sql = "update ngo_users set u_password = '$password' where u_id in ($str_u_ids)";
			db_query($sql);	
		 }else if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']) ) {
			$sql = "update ngo_users set u_status = 'Active' where u_id in ($str_u_ids)";
			db_query($sql);	
  		
		} else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) ) {
			$sql = "update ngo_users set u_status = 'Inactive' where u_id in ($str_u_ids)";
			db_query($sql);
		  
		}else if(isset($_REQUEST['Submit_Block']) || isset($_REQUEST['Submit_Block_x']) ) {
 		  	$sql = "update ngo_users set u_blocked_msg = '$u_blocked_msg' where u_id in ($str_u_ids)";
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
if ($u_username!='') 		{$sql .= " and u_username='$u_username' "; }
if ($u_mobile!='') 		{$sql .= " and u_mobile='$u_mobile' "; }
if ($u_acc_type!='') 		{$sql .= " and u_acc_type='$u_acc_type' "; }
if ($u_status!='') 			{$sql .= " and u_status='$u_status' "; }
$sql = apply_filter($sql, $u_fname, $u_fname_filter,'u_fname');
if ($u_city!='') 			{$sql .= " and u_city like '%$u_city%' "; }
if ($datefrom!='' && $dateto!='') {  $sql .= " and u_date between '$datefrom' AND '$dateto' ";} 
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
                <? include('includes/header.php')?>
                <!-- ========== Topbar End ========== -->

                <div class="px-3">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="py-3 py-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="page-title mb-0">Manage Request Form Setup</h4>
                                </div>
                                <div class="col-lg-6">
                                   <div class="d-none d-lg-block">
                                    <ol class="breadcrumb m-0 float-end">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Manage Request Form Setup</a></li>
                                        <li class="breadcrumb-item active">Manage Request Form Setup</li>
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
                                       <?php /*?> <h4 class="header-title">Basic Data Table </h4><?php */?>
                                         
										 
                                         <div class="table-responsive">
										 <? include("../error_msg.inc.php");?>
										  <? if(mysqli_num_rows($result)==0){?>
            <div class="msg">Sorry, no records found.</div>
            <? } else{ 
	  ?>
            <div align="right"> Showing Records:
              <?= $start+1?>
              to
              <?=($reccnt<$start+$pagesize)?($reccnt-$start):($start+$pagesize)?>
              of
              <?= $reccnt?>
            </div>
            <div>Records Per Page:
              <?=pagesize_dropdown('pagesize', $pagesize);?>
            </div>
            <form method="post" name="form1" id="form1" onSubmit="confirm_submit(this)"> <a   class="btn btn-primary add-btn-mb-3 float-right"  href="manage_requestform_setup_f.php" >Add Manage Request Form Setup</a>
              <table width="100%"  border="0" cellpadding="0" cellspacing="1" class="table table-bordered mb-0">
			  <thead class="table-light">
                <tr>
                  <th width="8%" nowrap="nowrap"># <?= sort_arrows('u_id')?></th>
                  <th width="12%" nowrap="nowrap"> Fild Title  </th>
                  <th width="12%" nowrap="nowrap"> Fild Type </th>
                  <th width="6%" nowrap="nowrap">Mandatory </th>
                   <th width="8%" nowrap="nowrap">DOJ <?= sort_arrows('u_date')?></th>
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
	$user_full_name=$u_fname." ".$u_lname;
 	//$income = db_scalar("SELECT(SUM(IF(pay_drcr='Cr',pay_amount,''))-SUM(IF(pay_drcr='Dr',pay_amount,''))) as balance FROM ngo_users_payment where pay_userid='$u_id'");
	//$ewallet = db_scalar("SELECT (SUM(IF(pay_drcr='Cr',pay_amount,''))-SUM(IF(pay_drcr='Dr',pay_amount,''))) as balance FROM ngo_users_ewallet where pay_userid='$u_id'");
	//$coin_balance = db_scalar("SELECT (SUM(IF(pay_drcr='Cr',pay_amount,''))-SUM(IF(pay_drcr='Dr',pay_amount,''))) as balance FROM ngo_users_coin where pay_userid='$u_id'");
 	//$topup_amount = db_scalar("select max(topup_amount) from ngo_users_recharge where topup_userid='$u_id' and topup_status='Paid'");
  	///$total_direct = db_scalar("select count(*) from ngo_users  where u_ref_userid='$u_id' and u_id in (select topup_userid from ngo_users_recharge)");
	if ($topup_amount>0) {$css = 'td_green';}  else {$css = 'td_red';} 
	if ($u_status=='Banned') {$css = 'highlight';} 
	else if ($u_status=='Inactive') {$css = 'td_sky';}  
	//db_scalar("select utype_code from ngo_users_type where utype_id='$u_utype'");
?>
                <tr class="<?=$css?>">
                <td nowrap="nowrap"><?=$u_id?></td>
                  <td nowrap="nowrap"><?=$fild_title?> </td>
                  <td nowrap="nowrap"><?=$fild_type?> </td>
                  <td nowrap="nowrap"><?=$mandatory?> </td> 
                   <td nowrap="nowrap"><?=datetime_format($u_date)?></td>
                  <td><?=$u_status?></td>
               
                  <td align="center"><a href="manage_requestform_setup_f.php?u_id=<?=$u_id?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a></td>
                  <td align="center"><input name="arr_u_ids[]" type="checkbox" id="arr_u_ids[]" value="<?=$u_id?>"/></td>
                </tr>
                <? }
?>
              </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="right" valign="top" style="padding:2px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr><td width="50%" align="left" valign="top"  ></td>
                         
                        <td width="44%" align="right" valign="top" style="padding:2px"><!--<input name="Submit_cycle" type="image" id="Submit_cycle" src="images/buttons/cycle.gif"  onclick="return  updateConfirmFromUser('arr_u_ids[]')"/>-->
                          <input name="Banned2" type="image" id="Banned2" src="images/buttons/block_id.gif" onClick="return blockConfirmFromUser('arr_u_ids[]')">
                          <input name="Activate" type="image" id="Activate" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_u_ids[]')"/>
                          <input name="Deactivate" type="image" id="Deactivate" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_u_ids[]')"/>
                        </td>
                      </tr>
                    </table>
                    <!--         -->
                  </td>
                </tr>
                <tr>
                  <td align="right" valign="top" style="padding:2px"><!--	<input name="Featured" type="image" id="Featured" src="images/buttons/featured.gif" onclick="return featuredConfirmFromUser('arr_u_ids[]')"/>
                    <input name="Unfeatured" type="image" id="Unfeatured" src="images/buttons/unfeatured.gif" onclick="return UnfeaturedConfirmFromUser('arr_u_ids[]')"/><input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" onclick="return deleteConfirmFromUser('arr_u_ids[]')"/>-->
                  </td>
                </tr>
              </table>
            </form>
            <? }?>
            <? include("paging.inc.php");?>
                                            
                                        </div>

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        <!-- end row-->
                         
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <? include('includes/footer.php')?>
                <!-- end Footer -->

            </div>
            <!-- End Page content -->


        </div>
        <!-- END wrapper -->
        
        <!-- App js -->
		
		
		
        
        <? include('includes/extra_footer.php')?>
        
    </body>
</html>