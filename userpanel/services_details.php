<?
include("../includes/surya.dream.php");
protect_user_page();
$s_id = $_REQUEST['s_id'];
if ($s_id != '') {
  $sql = "select * from ngo_services where s_id = '$s_id'";
  $result = db_query($sql);
  if ($line_raw = mysqli_fetch_array($result, MYSQLI_BOTH)) {
    //$line = ms_form_value($line_raw);
    //@extract($line_raw);
    /// $s_ref_userid = db_scalar("select s_username from ngo_services where s_id = '$s_ref_userid'");
  }
}

?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="">

<head>
  <!-- include file here ????  -->
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
          <? $page_cate_name = db_scalar("select scate_name from ngo_service_cate where scate_id='$scate_id' ") ?>
          <!-- start page title -->
          <div class="py-3 py-lg-4">
            <div class="row">
              <div class="col-lg-6">
                <h4 class="page-title mb-0"><?= $page_cate_name ?></h4>
              </div>
              <div class="col-lg-6">
                <div class="d-none d-lg-block">
                  <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"><?= $page_cate_name ?></a></li>
                    <li class="breadcrumb-item active"><?= $page_cate_name ?></li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- end page title -->

          <div class="row">
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body">

                  <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                      <div class="carousel-item active">




                        <? /*if($line_raw['s_image']!=''){ ?><? } */ ?>
                        <div class="services-details__thumb">

                          <? if (($line_raw['s_image'] != '') && (file_exists(UP_FILES_FS_PATH . '/services/' . $line_raw['s_image']))) {

                          ?>
                            <img class="card-img-top img-fluid" src="<?= show_thumb(UP_FILES_WS_PATH . '/services/' . $line_raw['s_image'], 770, 481, 'resize'); ?>" alt=" " />

                          <? } else { ?>
                            <img class="card-img-top img-fluid" src="assets/images/no-service-img.png" alt=" " />
                          <? }  ?>


                          <!--<img src="<? ///=show_thumb(UP_FILES_WS_PATH.'/services/'.$line_raw['s_image'],770,481,'resize')
                                        ?>" width="100%" /> -->
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>



            <div class="col-xl-8">
              <div class="card">
                <div class="card-body">
                  <h3 class="services-details__content__title"><?= ($line_raw['s_title']); ?></h3>
                  <p class="services-details__content__text"><?= ($line_raw['s_description']);?> </p>

                </div>
              </div> <!-- end card -->
            </div> <!-- end col -->

            <!-- end row -->



            <?php
            $sql_document = "SELECT * FROM ngo_document WHERE document_status='active' AND document_s_id = '$s_id' ORDER BY document_id ASC";
            $result_document = db_query($sql_document);
            $total_document = mysqli_num_rows($result_document);

            if ($total_document > 0) {
              echo '<div class="row g-4">'; // Start Row

              while ($line_document = mysqli_fetch_array($result_document)) {
            ?>
                <div class="col-lg-4 col-md-6 col-sm-12"> <!-- 3 Columns Per Row -->
                  <div class="card shadow-lg border-0 rounded-4 hover-zoom h-100">
                    <div class="card-body p-4">

                      <!-- Animated Heading -->
                      <h3 class="services-details__content__title text-primary fw-bold fade-in">📄 Documents</h3>
                      <hr class="mb-3">

                      <!-- Document Title -->
                      <h4 class="services-details__content__title">
                        <strong>Title:</strong>
                        <span class="card-text badge bg-warning text-dark px-2 py-1 rounded-pill">
                          <?= htmlspecialchars($line_document['document_title']); ?>
                        </span>
                      </h4>

                      <!-- Document Instructions -->
                      <h5 class="mt-3 text-secondary">📜 Document Instructions:</h5>
                      <div class="alert alert-warning fade-in">
                        <?= htmlspecialchars($line_document['document_ins']); ?>
                      </div>

                      <?php if (!empty($line_document['document_file'])) {
                        $file_path = UP_FILES_WS_PATH . '/documents/' . $line_document['document_file'];
                        $file_extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

                        // Define file type based on extension
                        $file_types = [
                          'pdf' => '📄 PDF',
                          'doc' => '📝 Word Document',
                          'docx' => '📝 Word Document',
                          'jpg' => '🖼️ Image (JPG)',
                          'jpeg' => '🖼️ Image (JPEG)',
                          'png' => '🖼️ Image (PNG)',
                          'gif' => '🖼️ Image (GIF)',
                          'xlsx' => '📊 Excel File',
                          'xls' => '📊 Excel File',
                          'ppt' => '📽️ PowerPoint',
                          'pptx' => '📽️ PowerPoint',
                          'txt' => '📜 Text File',
                          'zip' => '📁 ZIP Archive',
                          'rar' => '📁 RAR Archive'
                        ];

                        // Get file format label
                        $file_format = isset($file_types[$file_extension]) ? $file_types[$file_extension] : '📁 Unknown File';
                      ?>
                        <div class="file-preview-container text-center">
                          <div class="file-preview-card shadow-lg rounded-3 p-3">

                            <!-- Display File Type -->
                            <h6 class="text-secondary mb-2">Format: <strong><?= $file_format; ?></strong></h6>

                            <!-- File Preview -->
                            <?php if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) { ?>
                              <img src="<?= $file_path; ?>" class="img-fluid rounded" alt="Document Image">

                            <?php } elseif ($file_extension === 'pdf') { ?>
                              <iframe src="<?= $file_path; ?>" class="pdf-preview w-100" frameborder="0"></iframe>
                              <?php } elseif (in_array($file_extension, ['doc', 'docx'])) { ?>
    <!-- Placeholder for Word file preview with dummy image -->
    <div class="word-preview text-center bg-light p-3 rounded">
        <img src="assets/images/down.jpeg" class="img-fluid rounded shadow-sm" alt="Word File Preview">
        <p class="text-secondary mt-2">If you want to view the file, you can download it first.</p>
    </div>






                            <?php } else { ?>
                              <div class="file-icon">
                                <i class="bi bi-file-earmark-text text-primary" style="font-size: 4rem;"></i>
                              </div>
                            <?php } ?>

                            <!-- View & Download Buttons -->
                            <div class="mt-3">
                              <?php if (!in_array($file_extension, ['doc', 'docx'])) { ?>
                                <a href="<?= $file_path; ?>" target="_blank" class="btn btn-outline-success fw-bold me-2">
                                  👁️ View File
                                </a>
                              <?php } ?>
                              <a href="<?= $file_path; ?>" download class="btn btn-outline-primary fw-bold">
                                ⬇️ Download
                              </a>
                            </div>
                          </div>
                        </div>
                      <?php } ?>

                    </div> <!-- End Card Body -->
                  </div> <!-- End Card -->
                </div> <!-- End Column -->
            <?php
              }
              echo '</div>'; // Close Row
            } else {
              echo '<div class="alert alert-danger text-center">No documents found.</div>';
            }
            ?>



            <style>
              .hover-zoom {
                transition: transform 0.3s ease-in-out;
              }

              .hover-zoom:hover {
                transform: scale(1.05);
              }

              .fade-in {
                animation: fadeIn 1s ease-in-out;
              }

              @keyframes fadeIn {
                from {
                  opacity: 0;
                  transform: translateY(10px);
                }

                to {
                  opacity: 1;
                  transform: translateY(0);
                }
              }
            </style>


            <!-- faq code -->

            <?
            $sql_faq = "SELECT * FROM ngo_faq WHERE faq_status='Active' and faq_s_id = '$s_id' ORDER BY faq_id ASC";
            $result_faq = db_query($sql_faq);
            $total_faq = mysqli_num_rows($result_faq);

            if ($total_faq > 0) {
            ?>

              <div class="col-xl-12">
                <div class="card">
                  <div class="card-body">



                    <h4 class="header-title mb-3">FAQs (Frequently Asked Questions) are a great way to provide quick and accessible answers to common questions people might have. </h4>

                    <div class="accordion accordion-flush" id="accordionFlushExample">

                      <?

                      if ($total_faq > 0) {
                        while ($line_faq = mysqli_fetch_array($result_faq)) {
                      ?>

                          <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                              <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                <?= htmlspecialchars($line_faq['faq_question']); ?>
                              </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne"
                              data-bs-parent="#accordionFlushExample">
                              <div class="accordion-body"><?= htmlspecialchars($line_faq['faq_answer']); ?></div>
                            </div>
                          </div>

                      <?
                        }
                      }
                      ?>
                    </div>
                    <!-- end accordion -->
                  </div>
                  <!-- end card body -->
                </div>
                <!-- end card -->
              </div> <!-- end col -->



            <? } ?>

            <!-- faq end -->





          </div>
        </div>
      </div>

      <? include('includes/footer.php') ?>
      <!-- end Footer -->
    </div>
    <!-- End Page content -->
  </div>
  <!-- END wrapper -->
  <? include('includes/extra_footer.php') ?>
</body>

</html>