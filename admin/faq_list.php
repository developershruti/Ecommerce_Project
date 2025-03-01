<?

require_once("../includes/surya.dream.php");

protect_admin_page2();



if (is_post_back()) {

  $arr_faq_ids = $_REQUEST['arr_faq_ids'];

  if (is_array($arr_faq_ids)) {

    $str_faq_ids = implode(',', $arr_faq_ids);

    if (isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x'])) {

      $sql = "update ngo_faq set faq_status = 'Active' where faq_id in ($str_faq_ids)";

      db_query($sql);
    } else if (isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x'])) {

      $sql = "update ngo_faq set faq_status = 'Inactive' where faq_id in ($str_faq_ids)";

      db_query($sql);
    } else if (isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x'])) {
      $sql = "delete from ngo_faq where faq_id in ($str_faq_ids)";
      db_query($sql);



      header("Location: " . $_SERVER['HTTP_REFERER']);

      exit;
    }
  }
}



$start = intval($start);

$pagesize = intval($pagesize) == 0 ? $pagesize = DEF_PAGE_SIZE : $pagesize;

$columns = "select * ";

$sql = " from ngo_faq ";

$sql .= " where 1 ";

//$sql .= " and faq_acc_type='1'";

if ($faq_s_id != '') {
  $sql .= " and faq_s_id='$faq_s_id' ";
}

if ($faq_s_id != '') {

  $sql .= " and faq_s_id='$faq_s_id' ";
}



if ($faq_question != '') {

  $sql .= " and faq_question='$faq_question' ";
}







$order_by == '' ? $order_by = 'faq_id' : true;

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

                                <h4 class="page-title mb-0">Add Faq</h4>

                            </div>

                            <div class="col-lg-6">

                                <div class="d-none d-lg-block">

                                    <ol class="breadcrumb m-0 float-end">

                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Services</a></li>

                                        <li class="breadcrumb-item active">Add Faq</li>

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
                                        <form method="get" name="form2" id="form2"
                                            onSubmit="return confirm_submit(this)">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td class="tdLabel" align="right" nowrap="nowrap">Question:</td>
                                                    <td><input name="faq_question" class="form-control" type="text"
                                                            value="<?= htmlspecialchars($faq_question) ?>" /></td>

                                                    <td class="tdLabel" align="right" nowrap="nowrap">Status :</td>
                                                    <td class="tdLabel" align="right" nowrap="nowrap">
                                                        <?= service_status_dropdown('faq_status', isset($_GET['faq_status']) ? $_GET['faq_status'] : '') ?>
                                                    </td>
                                                    <td align="right">
                                                        <input name="pagesize" type="hidden" id="pagesize"
                                                            value="<?= htmlspecialchars($pagesize) ?>" />
                                                        <button type="submit" class="btn btn-primary">Search</button>
                                                    </td>
                                                    <input type="hidden" name="f_id"
                                                        value="<?= htmlspecialchars($f_id) ?>" />
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

                                                    <a class="btn btn-primary float-right"
                                                        href="faq_f.php?faq_s_id=<?= $faq_s_id ?>">Add Faq</a>

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

                                                    <?= $start + 1 ?> to
                                                    <?= ($reccnt < $start + $pagesize) ? ($reccnt - $start) : ($start + $pagesize) ?>
                                                    of <?= $reccnt ?>

                                                </div>

                                            </div>

                                            <div class="col-lg-4 ">

                                                <div class="grid-container lh-25">

                                                    <a class="btn btn-primary float-right"
                                                        href="faq_f.php?faq_s_id=<?= $faq_s_id ?>">Add Faq</a>

                                                </div>

                                            </div>

                                        </div>

                                    </div>



                                    <div class="table-responsive">

                                        <form method="post" name="form1" id="form1" onSubmit="confirm_submit(this)">



                                            <table class="table table-bordered mb-0">

                                                <thead class="table-light">

                                                    <tr>

                                                        <th width="8%" nowrap="nowrap"># <?= sort_arrows('faq_id') ?>
                                                        </th>

                                                        <th width="12%" nowrap="nowrap"> Services Cate </th>

                                                        <th width="12%" nowrap="nowrap"> Question </th>

                                                        <th width="12%" nowrap="nowrap"> Answer </th>

                                                        <th width="12%" nowrap="nowrap"> Status </th>



                                                        <!-- <th width="6%">&nbsp;</th>-->

                                                        <th width="2%">&nbsp;</th>

                                                        <th width="2%"><input name="check_all" type="checkbox"
                                                                id="check_all" value="1"
                                                                onClick="checkall(this.form)" /></th>

                                                    </tr>

                                                </thead>

                                                <tbody>

                                                    <?php while ($line_raw = mysqli_fetch_array($result)) {

                              $line = ms_display_value($line_raw);

                              @extract($line);

                              //  $css = ($css == 'trOdd') ? 'trEven' : 'trOdd';



                              $service_title = db_scalar("SELECT s_title FROM ngo_services where s_id='$faq_s_id'");



                            ?>

                                                    <tr class="<?= $css ?>">

                                                        <td nowrap="nowrap"><?= $faq_id ?></td>

                                                        <td><?= $service_title ?></td>

                                                        <td nowrap="nowrap" title="<?= $faq_question ?>">
                                                            <?= str_stop($faq_question, 25) ?>
                                                            <? //= $faq_question 
                                  ?>
                                                        </td>

                                                        <td nowrap="nowrap" title="<?= $faq_answer ?>">
                                                            <?= str_stop($faq_answer, 25) ?> </td>

                                                        <td nowrap="nowrap">
                                                            <? ///= $faq_status
                                  ?>



                                                            <?php if ($faq_status == 'Active') { ?>

                                                            <button type="button"
                                                                class="btn btn-success btn-sm waves-effect waves-light"><?= $faq_status ?></button>

                                                            <?php } else if ($faq_status == 'Inactive') { ?>

                                                            <button type="button"
                                                                class="btn btn-danger btn-sm waves-effect waves-light"><?= $faq_status ?></button>

                                                            <?php } ?>
                                                        </td>



                                                        <td align="center"><a
                                                                href="faq_f.php?faq_id_en=<?= encryptor('encrypt', $faq_id) ?>"><img
                                                                    src="images/icons/edit.png" alt="Edit" width="16"
                                                                    height="16" border="0" /></a></td>

                                                        <td align="center"><input name="arr_faq_ids[]" type="checkbox"
                                                                id="arr_faq_ids[]" value="<?= $faq_id ?>" /></td>

                                                    </tr>

                                                    <?php } ?>

                                                </tbody>

                                            </table>

                                            <table width="100%">

                                                <tr>



                                                    <td width="25%" align="right" style="padding:2px">

                                                        <!-- <input name="Banned2" type="image" src="images/buttons/block_id.gif" onClick="return blockConfirmFromUser('arr_faq_ids[]')" />-->

                                                        <input name="Activate" type="image"
                                                            src="images/buttons/activate.gif"
                                                            onClick="return activateConfirmFromUser('arr_faq_ids[]')" />

                                                        <input name="Deactivate" type="image"
                                                            src="images/buttons/deactivate.gif"
                                                            onClick="return deactivateConfirmFromUser('arr_faq_ids[]')" />
                                                        <input name="Delete" type="image" id="Delete"
                                                            src="images/buttons/delete.gif"
                                                            onClick="return deleteConfirmFromUser('arr_faq_ids[]')" />
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