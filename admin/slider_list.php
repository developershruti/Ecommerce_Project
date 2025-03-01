<?
require_once("../includes/surya.dream.php");
protect_admin_page2();

if (is_post_back()) {

  $arr_slider_ids = $_REQUEST['arr_slider_ids'];
  if (is_array($arr_slider_ids)) {
    $arr_slider_ids = implode(',', $arr_slider_ids);
    if (isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x'])) {
      $sql = "update  ngo_slider set status = 'Active' where slider_id in ($arr_slider_ids)";
      db_query($sql);
    } else if (isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x'])) {
      $sql = "update  ngo_slider set status = 'Inactive' where slider_id in ($arr_slider_ids)";
      db_query($sql);
    }else if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']) ) {
			$sql = "delete from ngo_slider where slider_id in ($arr_slider_ids)";
			db_query($sql);

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
  }
}
}

$start = intval($start);
$pagesize = intval($pagesize) == 0 ? $pagesize = DEF_PAGE_SIZE : $pagesize;
$columns = "select * ";
$sql = " from ngo_slider where 1 ";
// $sql .= " where s_type='Slider'";
// $sql .= " and s_acc_type='2'";
//if ($s_username!='') 		{$sql .= " and s_username='$s_username' "; }
// if ($slider_title != '') {
//   $sql .= " and slider_title like '%$slider_title%'  ";
// }
//if ($s_acc_type!='') 		{$sql .= " and s_acc_type='$s_acc_type' "; }
if ($status != '') {
  $sql .= " and status='$status' ";
}
// /$sql = apply_filter($sql, $slider_title, $slider_title_filter, 'slider_title');

//if ($s_city!='') 			{$sql .= " and s_city like '%$s_city%' "; }
//if ($datefrom!='' && $dateto!='') {  $sql .= " and s_date between '$datefrom' AND '$dateto' ";} 
//if ($s_coordinator!='') 			{$sql .= " and s_coordinator='$s_coordinator' "; }



$order_by == '' ? $order_by = 'slider_id' : true;
$order_by2 == '' ? $order_by2 = 'desc' : true;
$sql_count = "select count(*) " . $sql;
$sql .= "order by $order_by $order_by2 ";
$sql .= "limit $start, $pagesize ";
$sql = $columns . $sql;
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
                <h4 class="page-title mb-0">Slider List</h4>
              </div>
              <div class="col-lg-6">
                <div class="d-none d-lg-block">
                  <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Slider</a></li>
                    <li class="breadcrumb-item active">Slider List</li>
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
                    <form method="get" name="form2" id="form2" onSubmit="return confirm_submit(this)">
                      <table class="table table-bordered">
                        <tr>
                          <td class="tdLabel" align="right" nowrap="nowrap">Name:</td>
                          <td><input name="slider_title" class="form-control" type="text" value="<?= htmlspecialchars($slider_title) ?>" /></td>
                          <td class="tdLabel" align="right" nowrap="nowrap">Status :</td>
                          <td class="tdLabel" align="right" nowrap="nowrap"><?= service_status_dropdown('status', $status) ?></td>
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

                        <div class="col-lg-6 ">
                          <div class="grid-container lh-25">
                            <a class="btn btn-primary float-right" href="slider_f.php">Add Slider</a>
                          </div>
                        </div>
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
                        <div class="col-lg-4 ">
                          <div class="grid-container lh-25">
                            <a class="btn btn-primary float-right" href="slider_f.php">Add Slider</a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="table-responsive">
                      <form method="post" name="form1" id="form1" onSubmit="confirm_submit(this)">

                        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="table table-bordered mb-0">
                          <thead class="table-light">
                            <tr>
                              <th width="8%" nowrap="nowrap"># <?= sort_arrows('slider_id') ?></th>
                              <!-- <th width="9%" nowrap="nowrap"> Cate </th> -->
                              <th width="9%" nowrap="nowrap"> Title </th>
                              <th width="9%" nowrap="nowrap"> SubTitle </th>
                              <th width="8%" nowrap="nowrap">Desc </th>
                              <th width="12%" nowrap="nowrap"> Images </th>
                              <th width="10%" nowrap="nowrap">Button Text</th>
                              <th width="5%" nowrap="nowrap">Status</th>
                              <th width="2%">&nbsp;</th>
                              <th width="2%"><input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" /></th>
                            </tr>
                          </thead>

                          <?
                          while ($line_raw = mysqli_fetch_array($result)) {
                            $line = ms_display_value($line_raw);
                            // print_r($line);
                            @extract($line);
                            $css = ($css == 'trOdd') ? 'trEven' : 'trOdd';
                            $user_full_name = $adm_fname . " " . $adm_lname;
                            $s_created_by_user = db_scalar("SELECT adm_login FROM ngo_admin where adm_userid='$s_created_by'");

                            if ($topup_amount > 0) {
                              $css = 'td_green';
                            } else {
                              $css = 'td_red';
                            }
                            if ($status == 'Banned') {
                              $css = 'highlight';
                            } else if ($status == 'Inactive') {
                              $css = 'td_sky';
                            }
                            //db_scalar("select utype_code from  ngo_admin_type where utype_id='$adm_utype'");
                          ?>
                            <tr class="<?= $css ?>">
                              <td nowrap="nowrap"><?= $slider_id ?></td>
                              <td nowrap="nowrap"><?= $slider_title ?></td>
                              <!-- <td><?= $slider_title ?></td> -->
                              <td><?= $slider_subtitle ?></td>
                              <td><?= $slider_shortdesc ?></td>
                             


                              <td nowrap="nowrap"><? if ($slider_image != '') { ?>
                                <img src="<?= UP_FILES_WS_PATH . '/slider/' . $slider_image ?>" width="98" /> <? } ?> </td>

                              <td><?= $slider_button ?></td>

                              <td>

                                <?php if ($status == 'active') { ?>
                                  <button type="button" class="btn btn-success btn-sm waves-effect waves-light"><?= $status ?></button>
                                <?php } else if ($status == 'inactive') { ?>
                                  <button type="button" class="btn btn-danger btn-sm waves-effect waves-light"><?= $status ?></button>
                                <?php } ?>

                              </td>

                              <td align="center" nowrap="nowrap"><a href="Slider_f.php?slider_id=<?= $slider_id ?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a> 
                              <!-- <a href="faq_list.php?faq_slider_id=<?= $slider_id ?>"><i class="mdi mdi-comment-question-outline font-size-15"></i></a> -->
                            </td>
                              <td align="center"><input name="arr_slider_ids[]" type="checkbox" id="arr_slider_ids[]" value="<?= $slider_id ?>" /></td>
                            </tr>
                          <? }
                          ?>
                        </table>
                        <table width="100%">
                          <tr>
                            <td width="15%" align="left">
                              <?php /*?> <input name="adm_blocked_msg" type="text" class="form-control" placeholder="Reason In Case of blocking Employee" style="float:right;" /><?php */ ?>
                            </td>

                            <td width="25%" align="right" style="padding:2px">
                              <!-- <input name="Banned2" type="image" src="images/buttons/block_id.gif" onClick="return blockConfirmFromUser('arr_slider_ids[]')" /> -->
                              <input name="Activate" type="image" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_slider_ids[]')" />
                              <input name="Deactivate" type="image" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_slider_ids[]')" />
                              <input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" onClick="return deleteConfirmFromUser('arr_slider_ids[]')" /></td>

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