<?
require_once("../includes/surya.dream.php");
protect_admin_page2();

if (is_post_back()) {
  $arr_document_ids = $_REQUEST['arr_document_ids'];
  if (is_array($arr_document_ids)) {
    $str_document_ids = implode(',', $arr_document_ids);
    if (isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x'])) {
      $sql = "update ngo_document set document_status = 'Active' where document_id in ($str_document_ids)";
      db_query($sql);
    } else if (isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x'])) {
      $sql = "update ngo_document set document_status = 'Inactive' where document_id in ($str_document_ids)";
      db_query($sql);
    }else if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']) ) {
			$sql = "delete from ngo_document where document_id in ($str_document_ids)";
			db_query($sql);

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
  }
}
}

$start = intval($start);
$pagesize = intval($pagesize) == 0 ? $pagesize = DEF_PAGE_SIZE : $pagesize;
$columns = "select * ";
$sql = " from ngo_document ";
$sql .= " where 1 ";
//$sql .= " and faq_acc_type='1'";
if ($document_s_id != '') {
  $sql .= " and document_s_id='$document_s_id' ";
}
if ($document_s_id != '') {
  $sql .= " and document_s_id='$document_s_id' ";
}

if ($document_title != '') {
  $sql .= " and document_title='$document_title' ";
}



$order_by == '' ? $order_by = 'document_id' : true;
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
                <h4 class="page-title mb-0">Add document </h4>
              </div>
              <div class="col-lg-6">
                <div class="d-none d-lg-block">
                  <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Services</a></li>
                    <li class="breadcrumb-item active">Add document</li>
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
                            <input type="text" class="form-control" id="document_title" name="document_title" value="<?= $document_title ?>" placeholder=" Title">
                          </td>
                          <td class="tdLabel" align="right" nowrap="nowrap">Status :</td>
                          <td class="tdLabel" align="right" nowrap="nowrap">
                            <?= service_status_dropdown('scate_status', $scate_status) ?></td>
                          <td align="right">
                            <input name="pagesize" type="hidden" id="pagesize" value="<?= htmlspecialchars($pagesize) ?>" />
                            <button type="submit" class="btn btn-primary">Search</button>
                          </td>
                          <input type="hidden" name="document_id" value="<?= htmlspecialchars($document_id) ?>" />
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
                            <a class="btn btn-primary float-right" href="document_f.php?document_s_id=<?= $document_s_id ?>">Add document</a>
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
                            <a class="btn btn-primary float-right" href="document_f.php?document_s_id=<?= $document_s_id ?>">Add document</a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="table-responsive">
                      <form method="post" name="form1" id="form1" onSubmit="confirm_submit(this)">

                        <table class="table table-bordered mb-0">
                          <thead class="table-light">
                            <tr>
                              <th width="8%" nowrap="nowrap"># <?= sort_arrows('document_id') ?></th>
                              <th width="12%" nowrap="nowrap"> Services Cate </th>
                              <th width="12%" nowrap="nowrap"> Title </th>
                              <th width="12%" nowrap="nowrap"> Instructions </th>
                              <th width="12%" nowrap="nowrap"> Documents </th>
                              <th width="12%" nowrap="nowrap"> Status </th>

                              <!-- <th width="6%">&nbsp;</th>-->
                              <th width="2%">&nbsp;</th>
                              <th width="2%"><input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" /></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php while ($line_raw = mysqli_fetch_array($result)) {
                              $line = ms_display_value($line_raw);
                              @extract($line);
                              //  $css = ($css == 'trOdd') ? 'trEven' : 'trOdd';

                              $service_title = db_scalar("SELECT s_title FROM ngo_services where s_id='$document_s_id'");

                            ?>
                              <tr class="<?= $css ?>">
                                <td nowrap="nowrap"><?= $document_id ?></td>
                                <td><?= $service_title ?></td>
                                <td nowrap="nowrap" title="<?= $document_title ?>"><?= str_stop($document_title, 25) ?> <? //= $document_title 
                                                                                                                      ?> </td>
                                <td nowrap="nowrap" title="<?= $document_ins ?>"><?= str_stop($document_ins, 25) ?> </td>



                                <td width="6%" nowrap="nowrap">
                                  <?php if ($document_file != '') { ?>
                                    <div class="mt-2">
                                      <label class="col-form-label">Current Uploaded File:</label><br>
                                      <?php
                                      $file_extension = pathinfo($document_file, PATHINFO_EXTENSION);
                                      $file_path = UP_FILES_WS_PATH . '/documents/' . $document_file;

                                      // Display image preview if it's a JPG/JPEG
                                      if (in_array($file_extension, ['jpg', 'jpeg'])) {
                                        echo '<img src="' . $file_path . '" width="98" /><br>';
                                      } else {
                                        // Provide a download/view link for PDF and Word documents
                                        echo '<a href="' . $file_path . '" target="_blank">View File</a><br>';
                                      }
                                      // 
                                      ?>
                                    </div>
                                  <?php } ?>
                                </td>


                                <td nowrap="nowrap"><? ///= $document_status
                                                    ?>



                                <?php if ($document_status == 'active') { ?>
                                  <button type="button" class="btn btn-success btn-sm waves-effect waves-light"><?= $document_status ?></button>
                                <?php } else if ($document_status == 'inactive') { ?>
                                  <button type="button" class="btn btn-danger btn-sm waves-effect waves-light"><?= $document_status ?></button>
                                <?php } ?></td>

                                <td align="center"><a href="document_f.php?document_id_en=<?= encryptor('encrypt', $document_id) ?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a></td>
                                <td align="center"><input name="arr_document_ids[]" type="checkbox" id="arr_document_ids[]" value="<?= $document_id ?>" /></td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                        <table width="100%">
                          <tr>

                            <td width="25%" align="right" style="padding:2px">
                              <!-- <input name="Banned2" type="image" src="images/buttons/block_id.gif" onClick="return blockConfirmFromUser('arr_document_ids[]')" />-->
                              <input name="Activate" type="image" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_document_ids[]')" />
                              <input name="Deactivate" type="image" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_document_ids[]')" />
                              <input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" onclick="return deleteConfirmFromUser('arr_document_ids[]')" />

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