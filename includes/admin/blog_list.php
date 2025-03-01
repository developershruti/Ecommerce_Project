<?
require_once("../includes/surya.dream.php");
protect_admin_page2();

if (is_post_back()) {

  $arr_blog_ids = $_REQUEST['arr_blog_ids'];
  if (is_array($arr_blog_ids)) {
    $arr_blog_ids = implode(',', $arr_blog_ids);
    if (isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x'])) {
      $sql = "update  ngo_blog set blog_status = 'Active' where blog_id in ($arr_blog_ids)";
      db_query($sql);
    } else if (isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x'])) {
      $sql = "update  ngo_blog set blog_status = 'Inactive' where blog_id in ($arr_blog_ids)";
      db_query($sql);
    } else if (isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x'])) {
      $sql = "delete from ngo_blog where blog_id in ($arr_blog_ids)";
      db_query($sql);

      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit;
    }
  }
}

$start = intval($start);
$pagesize = intval($pagesize) == 0 ? $pagesize = DEF_PAGE_SIZE : $pagesize;
$columns = "select * ";
$sql = " from ngo_blog where 1 ";
// $sql .= " where s_type='Slider'";
// $sql .= " and s_acc_type='2'";
//if ($s_username!='') 		{$sql .= " and s_username='$s_username' "; }
// if ($slider_title != '') {
//   $sql .= " and slider_title like '%$slider_title%'  ";
// }
//if ($s_acc_type!='') 		{$sql .= " and s_acc_type='$s_acc_type' "; }
if ($blog_status != '') {
  $sql .= " and blog_status='$blog_status' ";
}
// /$sql = apply_filter($sql, $slider_title, $slider_title_filter, 'slider_title');

//if ($s_city!='') 			{$sql .= " and s_city like '%$s_city%' "; }
//if ($datefrom!='' && $dateto!='') {  $sql .= " and s_date between '$datefrom' AND '$dateto' ";} 
//if ($s_coordinator!='') 			{$sql .= " and s_coordinator='$s_coordinator' "; }



$order_by == '' ? $order_by = 'blog_id' : true;
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
                <h4 class="page-title mb-0">Blog List</h4>
              </div>
              <div class="col-lg-6">
                <div class="d-none d-lg-block">
                  <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">services</a></li>
                    <li class="breadcrumb-item active">Blog List</li>
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
						  <td class="tdLabel" align="right" nowrap="nowrap"> 
              <input type="text" class="form-control" id="blog_name"  name="blog_name" value="<?=$blog_name?>" placeholder=" Name"></td>
              <td class="tdLabel" align="right" nowrap="nowrap">Status :</td>
                          <td class="tdLabel" align="right" nowrap="nowrap">
                            <?= service_status_dropdown('scate_status', $scate_status) ?></td>
                          <td align="right">
                            <input name="pagesize" type="hidden" id="pagesize" value="<?= htmlspecialchars($pagesize) ?>" />
                            <button type="submit" class="btn btn-primary">Search</button>
                          </td>
                          <input type="hidden" name="blog_id" value="<?= htmlspecialchars($blog_id) ?>" />
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
                            <a class="btn btn-primary float-right" href="blog_f.php">Add Blog</a>
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
                            <a class="btn btn-primary float-right" href="blog_f.php">Add Blog</a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="table-responsive">
                      <form method="post" name="form1" id="form1" onSubmit="confirm_submit(this)">

                        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="table table-bordered mb-0">
                          <thead class="table-light">
                            <tr>
                              <th width="8%" nowrap="nowrap"># <?= sort_arrows('blog_id') ?></th>
                              <!-- <th width="9%" nowrap="nowrap"> Cate </th> -->
                              <th width="9%" nowrap="nowrap"> Name </th>
                              <th width="9%" nowrap="nowrap"> Type </th>
                              <th width="9%" nowrap="nowrap"> image/videos </th>
                              <th width="8%" nowrap="nowrap"> short Desc </th>
                              <th width="12%" nowrap="nowrap"> Long Desc </th>
                              <!-- <th width="10%" nowrap="nowrap">Button Text</th> -->
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
                              <td nowrap="nowrap"><?= $blog_id ?></td>
                              <td nowrap="nowrap"><?= $blog_name ?></td>
                            
                            

                              <td nowrap="nowrap">
                                <?php echo ($blog_type == 'image') ? 'image' : 'video'; ?>
                              </td>

                              <td width="6%" nowrap="nowrap">
                                <?php if ($blog_type == 'image') { ?>
                                  <img src="<?= show_thumb(UP_FILES_WS_PATH . '/photo/' . $image, 75, 75, 'height') ?>" align="center" border="0" class="txtbox" />
                                <?php } else { ?>
                                  <video width="75" height="75" controls>
                                    <source src="<?= UP_FILES_WS_PATH . '/video/' . $video ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                  </video>
                                <?php } ?>
                              </td>

                              <td><?= $blog_shortdesc ?></td>
                              <td><?= $blog_desc ?></td>

                              

                              <td>

                              <?php if ($blog_status == 'active') { ?>
                                  <button type="button" class="btn btn-success btn-sm waves-effect waves-light"><?= $blog_status ?></button>
                                <?php } else if ($blog_status == 'inactive') { ?>
                                  <button type="button" class="btn btn-danger btn-sm waves-effect waves-light"><?= $blog_status ?></button>
                                <?php } ?>

                              </td>

                              <td align="center" nowrap="nowrap"><a href="blog_f.php?blog_id=<?= $blog_id ?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a>
                                <!-- <a href="faq_list.php?faq_blog_id=<?= $blog_id ?>"><i class="mdi mdi-comment-question-outline font-size-15"></i></a> -->
                              </td>
                              <td align="center"><input name="arr_blog_ids[]" type="checkbox" id="arr_blog_ids[]" value="<?= $blog_id ?>" /></td>
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
                              <!-- <input name="Banned2" type="image" src="images/buttons/block_id.gif" onClick="return blockConfirmFromUser('arr_blog_ids[]')" /> -->
                              <input name="Activate" type="image" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_blog_ids[]')" />
                              <input name="Deactivate" type="image" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_blog_ids[]')" />
                              <input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" onclick="return deleteConfirmFromUser('arr_blog_ids[]')" />
                            </td>

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