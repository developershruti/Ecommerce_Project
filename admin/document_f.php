<?
require_once('../includes/surya.dream.php');
protect_admin_page2();
$document_id = encryptor('decrypt', $document_id_en);

if (is_post_back()) {
    ///print_r($_POST);
    $arr_error_msgs = array();
    $arr_success_msgs = array();




    if ($_FILES['document_file']['name'] != '') {
        // Create a new finfo object
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        // Get the MIME type of the uploaded file
        $mime_type = $finfo->file($_FILES['document_file']['tmp_name']);

        // Allowed file types: PDF, JPG, DOC, DOCX
        $allowed_types = array(
            'application/pdf',
            'image/jpeg',
            'image/jpg',
            'application/msword', // DOC
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' // DOCX
        );

        if (!in_array($mime_type, $allowed_types)) {
            $arr_error_msgs[] = "Please upload a valid file (PDF, JPG, DOC, or DOCX only).";
        }
    }

    //if ($document_id =='') { $arr_error_msgs[] =  "User ID  does not exist!";}

    // if ($faq_email_old != $faq_email) {
    //   $email_count = db_scalar("select count(*) from  ngo_document where faq_email = '$faq_email'");
    //   if ($email_count > 0) {
    //     $arr_error_msgs[] =  "This e-mail is already registered with us.";
    //   }
    // }
    if ($document_s_id == '') {
        $arr_error_msgs[] = "Service Cate is required!";
    }

    if ($document_title == '') {
        $arr_error_msgs[] = "title is required!";
    }

    ///if ($u_mobile =='') { $arr_error_msgs[] = "Mobile number required!";}
    if ($document_ins == '') {
        $arr_error_msgs[] = " Instruction is required!";
    }



    $_SESSION['arr_error_msgs'] = $arr_error_msgs;
    if (count($arr_error_msgs) == 0) {


        if ($_FILES['document_file']['name'] != '') {
            $file_extension = file_ext($_FILES['document_file']['name']);
            $document_file_name = str_replace('.' . $file_extension, '', $_FILES['document_file']['name']) . '_' . md5(uniqid(rand(), true)) . '.' . $file_extension;

            copy($_FILES['document_file']['tmp_name'], UP_FILES_FS_PATH . '/documents/' . $document_file_name);
            $update_file = ", document_file='$document_file_name'";
        }

        if ($document_file_del != '') {
            @unlink(UP_FILES_FS_PATH . '/documents/' . $old_document_file);
            $update_file = ", document_file=''";
        }


        // $faq_parent_id = db_scalar("select faq_parent_id from  ngo_document  order by document_id desc limit 0,1") + rand(1, 9);
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
        // $faq_username = $prefix.rand(1,9).$faq_parent_id.rand(1,9); 


        if ($document_id != '') {
            $sql = "update  ngo_document set 
      document_title = '$document_title',
       document_s_id = '$document_s_id'"
                . $update_file . $update_subcate . ",
        document_ins = '$document_ins'
         where document_id = $document_id";
            db_query($sql);
            $arr_success_msgs[] = "Instruction updated successfully!";
        } else {
            $sql = "insert into  ngo_document set
       document_s_id = '$document_s_id', 
        document_title = '$document_title'"
                . $update_file . $update_subcate . ",
        document_ins = '$document_ins',
          document_status = 'active' ";
            db_query($sql);
            $arr_success_msgs[] = "Instruction  created successfully!";
        }
        $_SESSION['arr_success_msgs'] = $arr_success_msgs;

        header("Location: document_list.php?document_s_id=$document_s_id");
        ///header("Location: customers_f.php");
        exit;
    }
}
///$document_id = $_REQUEST['document_id'];
if ($document_id != '') {
    $sql = "select * from  ngo_document where document_id = '$document_id'";
    $result = db_query($sql);
    if ($line_raw = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        //$line = ms_form_value($line_raw);
        @extract($line_raw);
        ///$faq_ref_userid = db_scalar("select faq_username from  ngo_document where document_id = '$faq_ref_userid'");
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head></head>
<? include('includes/extra_head.php') ?>

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
                                    <? if ($document_id == '') { ?>
                                        Add
                                    <? } else { ?>
                                        Update
                                    <? } ?>
                                    Document</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-none d-lg-block">
                                    <ol class="breadcrumb m-0 float-end">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Services</a></li>
                                        <li class="breadcrumb-item active">
                                            <? if ($document_id == '') { ?>
                                                Add
                                            <? } else { ?>
                                                Update
                                            <? } ?>
                                            Document</li>
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


                                                <tr>
                                                    <td width="18%" align="right" class="tdLabel">Service Cate :</td>
                                                    <td>
                                                        <?php
                                                        $sql_document = "SELECT s_id, concat(s_id, ' - ', s_title) FROM ngo_services WHERE s_status='Active' ORDER BY s_id ";
                                                        echo make_dropdown($sql_document, 'document_s_id', $document_s_id, 'class="form-control"  style="width: 100%;color:#000;" alt="select" emsg="Select Service Category"', 'Select Service Category');
                                                        ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td width="18%" align="right" class="tdLabel">
                                                        Upload File <span class="text-danger text-lg">*</span> :
                                                    </td>
                                                    <td width="806" class="tdData">
                                                        <input name="document_file" type="file" id="document_file" class="form-control" accept=".pdf, .jpg, .jpeg, .doc, .docx">

                                                        <?php if ($document_file != '') { ?>
                                                            <div class="mt-2">
                                                                <span class="col-form-label">Current Uploaded File:</span><br>
                                                                <?php
                                                                $file_extension = pathinfo($document_file, PATHINFO_EXTENSION);
                                                                $file_path = UP_FILES_WS_PATH . '/documents/' . $document_file;

                                                                // Display image preview if it's a JPG/JPEG
                                                                // if (in_array($file_extension, ['jpg', 'jpeg'])) {
                                                                //     echo '<img src="' . $file_path . '" width="98" /><br>';
                                                                // } else {
                                                                //     // Provide a download/view link for PDF and Word documents
                                                                //     echo '<a href="' . $file_path . '" target="_blank">View/Download File</a><br>';
                                                                // }
                                                                // 
                                                                ?>
                                                                Delete
                                                                <input type="checkbox" name="document_file_del" value="1" class="maintxt">
                                                            </div>
                                                        <?php } ?>
                                                    </td>
                                                </tr>



                                                <tr>
                                                    <td width="18%" align="right" class="tdLabel">Title <span class="text-danger text-lg">*</span> :</td>
                                                    <td width="806" class="tdData">
                                                        <input name="document_title" type="text" id="document_title" value="<?= $document_title ?>" class="form-control" alt="blank" emsg="Please enter the title">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td align="right" valign="top" class="tdLabel">Short Instruction:</td>
                                                    <td class="tdData">
                                                        <textarea name="document_ins" cols="80" id="document_ins" class="form-control" rows="6"><?= $document_ins ?></textarea>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="tdLabel"> </td>
                                                    <td class="tdData">
                                                        <input type="hidden" name="document_id" value="<?= $document_id ?>">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <p>Fields marked with an asterisk (<span class="text-danger text-lg">*</span>) are mandatory.</p>
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
        
    </script>
</body>

</html>