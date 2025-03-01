<?php
require_once('../includes/surya.dream.php');
protect_admin_page2();

if (is_post_back()) {
    $arr_error_msgs = array();
    $arr_success_msgs = array();

    // Validate based on selected type
    if ($blog_type == 'image') {
        if ($_FILES['image']['name'] != '') {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime_type = $finfo->file($_FILES['image']['tmp_name']);

            $allowed_types = array('image/jpeg', 'image/jpg', 'image/png');
            if (!in_array($mime_type, $allowed_types)) {
                $arr_error_msgs[] = "Please upload a valid image file (JPG, JPEG, or PNG only).";
            }
        }
    } elseif ($blog_type == 'video') {
        if ($_FILES['video']['name'] != '') {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime_type = $finfo->file($_FILES['video']['tmp_name']);

            $allowed_types = array('video/mp4', 'video/mpeg', 'video/quicktime');
            if (!in_array($mime_type, $allowed_types)) {
                $arr_error_msgs[] = "Please upload a valid video file (MP4, MPEG, or MOV only).";
            }
        }
    }

    $_SESSION['arr_error_msgs'] = $arr_error_msgs;
    if (count($arr_error_msgs) == 0) {
        
        // Handle image upload
        if ($_FILES['image']['name'] != '' && $blog_type == 'image') {
            $image_name = str_replace('.' . file_ext($_FILES['image']['name']), '', $_FILES['image']['name']) . '_' . md5(uniqid(rand(), true)) . '.' . file_ext($_FILES['image']['name']);
            copy($_FILES['image']['tmp_name'], UP_FILES_FS_PATH.'/photo/'.$image_name);
            $update_photo = ", image='$image_name'";
        }

        // Handle video upload
        if ($_FILES['video']['name'] != '' && $blog_type == 'video') {
            $video_name = str_replace('.' . file_ext($_FILES['video']['name']), '', $_FILES['video']['name']) . '_' . md5(uniqid(rand(), true)) . '.' . file_ext($_FILES['video']['name']);
            copy($_FILES['video']['tmp_name'], UP_FILES_FS_PATH.'/video/'.$video_name);
            $update_video = ", video='$video_name'";
        }

        // Handle image deletion
        if ($image_del != '') {
            @unlink(UP_FILES_FS_PATH . '/photo/' . $old_image);
            $update_photo = ", image=''"; // Clear the image
        }

        // Handle video deletion  
        if ($video_del != '') {
            @unlink(UP_FILES_FS_PATH . '/video/' . $old_video);
            $update_video = ", video=''"; // Clear the video
        }

        if ($blog_id != '') {
            // Update blog
            $sql = "UPDATE ngo_blog SET 
                    blog_name = '$blog_name',
                    blog_shortdesc = '$blog_shortdesc',
                    blog_desc = '$blog_desc'";

            if (!empty($update_photo)) {
                $sql .= $update_photo;
            }
            if (!empty($update_video)) {
                $sql .= $update_video;
            }

            $sql .= " WHERE blog_id = '$blog_id'";

            db_query($sql);
            $arr_success_msgs[] = "Blog details updated successfully!!";
        } else {
            // Initialize variables
            $image_field = "NULL";
            $video_field = "NULL";

            // Set image/video values if files were uploaded
            if (!empty($image_name)) {
                $image_field = "'$image_name'";
            }
            if (!empty($video_name)) {
                $video_field = "'$video_name'";
            }

            // Insert new blog
            $sql = "INSERT INTO ngo_blog SET
                    blog_name = '$blog_name',
                    blog_type = '$blog_type',
                    blog_shortdesc = '$blog_shortdesc',
                    blog_desc = '$blog_desc',
                    blog_status = 'active',
                    image = $image_field,
                    video = $video_field";

            db_query($sql);
            $arr_success_msgs[] = "Blog created successfully!";
        }

        $_SESSION['arr_success_msgs'] = $arr_success_msgs;

        header("Location: blog_list.php");
        exit;
    }
}

$blog_id = $_REQUEST['blog_id'];
if ($blog_id != '') {
    $sql = "SELECT * FROM ngo_blog WHERE blog_id = '$blog_id'";
    $result = db_query($sql);
    if ($line_raw = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        @extract($line_raw);
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
                  <? if ($blog_id == '') { ?>
                    Add
                  <? } else { ?>
                    Update
                  <? } ?>
                  Blog</h4>
              </div>
              <div class="col-lg-6">
                <div class="d-none d-lg-block">
                  <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Services</a></li>
                    <li class="breadcrumb-item active">
                      <? if ($blog_id == '') { ?>
                        Add
                      <? } else { ?>
                        Update
                      <? } ?>
                      Blog</li>
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
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-12">
                              <div class="card">
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col-12">
                                      <div class="p-2">
                                        <div class="form-horizontal" role="form">

                                        <div class="mb-2 row">
                                            <label class="col-md-2 col-form-label" for="simpleinput">Name <span class="text-danger text-lg">*</span></label>
                                            <div class="col-md-10">
                                              <input type="text" id="simpleinput" class="form-control" name="blog_name" value="<?= $blog_name ?>" alt="blank" emsg="Enter the name" placeholder="Name">
                                            </div>
                                          </div>

                                          </div>
										  
									
<div class="mb-2 row">
    <label class="col-md-2 col-form-label" for="blog_type">Type <span class="text-danger text-lg">*</span></label>
    <div class="col-md-10">
        <select name="blog_type" id="blog_type" class="form-control" onchange="toggleUploadFields()">
            <option value="">Select Option</option>
            <option value="image" <?= ($blog_type == 'image') ? 'selected' : '' ?>>Image</option>
            <option value="video" <?= ($blog_type == 'video') ? 'selected' : '' ?>>Video</option>
        </select>
    </div>
</div>

<div id="image_upload" class="mb-2 row" style="display: <?= ($blog_type == 'image') ? 'flex' : 'none' ?>">
    <label class="col-md-2 col-form-label" for="image">Image Upload <span class="text-danger text-lg">*</span></label>
    <div class="col-md-10">
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
        <?php if (!empty($image)) { ?>
            <div class="mt-2">
                <img src="<?= UP_FILES_WS_PATH . '/photo/' . $image ?>" width="98" alt="Current Image" /><br>
                Delete <input type="checkbox" name="image_del" value="1" class="maintxt">
            </div>
        <?php } ?>
    </div>
</div>

<div id="video_upload" class="mb-2 row" style="display: <?= ($blog_type == 'video') ? 'flex' : 'none' ?>">
    <label class="col-md-2 col-form-label" for="video">Video Upload <span class="text-danger text-lg">*</span></label>
    <div class="col-md-10">
        <input type="file" class="form-control" id="video" name="video" accept="video/*">
        <?php if (!empty($video)) { ?>
            <div class="mt-2">
                <video width="150" controls>
                    <source src="<?= UP_FILES_WS_PATH . '/video/' . $video ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video><br>
                Delete <input type="checkbox" name="video_del" value="1" class="maintxt">
            </div>
        <?php } ?>
    </div>
</div>

<div class="mb-2 row">
    <label class="col-md-2 col-form-label" >Short Description:</label>
    <div class="col-md-5">
      <textarea id="blog_shortdesc" name="blog_shortdesc" alt="blank" emsg="Enter short description" placeholder="Enter short Description"><?= $blog_shortdesc ?></textarea>
    </div>
</div>

<div class="mb-2 row">
    <label class="col-md-2 col-form-label" for="summernote">Long Description:</label>
    <div class="col-md-10">
      <textarea id="blog_desc" class="summernote" name="blog_desc" alt="blank" emsg="Enter long description" placeholder="Enter long Description"><?= $blog_desc ?></textarea>
    </div>
</div>

                                
                                <div class="mb-2 row">
                                  <div class="col-md-2"></div>
                                  <div class="col-md-10">
                                    <input type="hidden" name="blog_id" value="<?= $blog_id ?>">
                                    <input name="old_image" type="hidden" class="txtbox" id="old_image" value="<?= $image ?>" />
                                    <input name="old_video" type="hidden" class="txtbox" id="old_video" value="<?= $video ?>" />
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                  </div>
                                  <div class="col-md-2"></div>
                                  <div class="col-md-10">
                                    <p>Fields marked with an asterisk (<span class="text-danger text-lg">*</span>) are mandatory.</p>
                                  </div>


                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
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

  <!-- Add this JavaScript at the bottom of the file, before </body> -->
  <script>
  function toggleUploadFields() {
      const type = document.getElementById('blog_type').value;
      const imageUpload = document.getElementById('image_upload');
      const videoUpload = document.getElementById('video_upload');
      
      if (type === 'image') {
          imageUpload.style.display = 'flex';
          videoUpload.style.display = 'none';
      } else if (type === 'video') {
          imageUpload.style.display = 'none';
          videoUpload.style.display = 'flex';
      } else {
          imageUpload.style.display = 'none';
          videoUpload.style.display = 'none';
      }
  }
  </script>
</body>

</html>