<?php include("includes/surya.dream.php");

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
<html lang="en">

<head>
  <?php include("includes/extra_head.inc.php") ?>
</head>



<body class="custom-cursor">
  <?php include("includes/loader.inc.php") ?>
  <!-- Preloader End -->
  <div class="page-wrapper">
    <!-- Main Header -->
    <?php include("includes/header.inc.php") ?>
    <!-- Main Header End -->
    <section class="page-header">
      <div class="page-header__bg"></div>
      <!-- /.page-header__bg -->
      <div class="page-header__shape1"></div>
      <!-- /.page-header__shape1 -->
      <div class="page-header__shape2"></div>
      <!-- /.page-header__shape1 -->
      <div class="page-header__shape3 wow slideInRight" data-wow-delay="300ms"></div>
      <!-- /.page-header__shape3 -->  
      <? $page_cate_name = db_scalar("select scate_name from ngo_service_cate where scate_id='$scate_id' ") ?>
      <div class="container">
        <ul class="page-header__breadcrumb list-unstyled">
          <li><a href="index.php">Home</a></li>
          <li><span>Services</span></li>
          <li><span><?= $page_cate_name ?></span></li>
        </ul>
        <!-- /.page-breadcrumb list-unstyled -->
        <h2 class="page-header__title"><?= $page_cate_name ?></h2>
        <!-- /.page-title -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /.page-header -->
    <!-- Services Details Start -->
    <section class="services-details">
      <div class="container">
        <div class="row">
          
          <!-- /.column -->
          <section class="services-details">
  <div class="container">
    <div class="row">
      <div class="col-12 wow fadeInUp animated" data-wow-delay="400ms">
        <div class="services-details__content">
          <?php if ($line_raw['s_image'] != '') { ?>
            <div class="services-details__thumb">
              <img src="<?= show_thumb(UP_FILES_WS_PATH . '/services/' . $line_raw['s_image'], 970, 381, 'resize') ?>" width="100%" />
            </div>
          <?php } ?>
          <h3 class="services-details__content__title"> <?= ($line_raw['s_title']); ?></h3>
          <style>
            p img {
              margin: 10px !important;
              border: solid 1px #eee !important;
            }
          </style>
          <p class="services-details__content__text"> <?= ($line_raw['s_description']); ?> </p>
          <section class="services-details__documents">
            <?php
            $sql_document = "SELECT * FROM ngo_document WHERE document_status='active' AND document_s_id = '$s_id' ORDER BY document_id ASC";
            $result_document = db_query($sql_document);
            $total_document = mysqli_num_rows($result_document);
            if ($total_document > 0) {
              echo '<div class="row g-4">';
              while ($line_document = mysqli_fetch_array($result_document)) {
            ?>
                <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="card shadow-lg border-0 rounded-4 hover-zoom h-100">
                    <div class="card-body p-4">
                      <h3 class="services-details__content__title text-primary fw-bold">📄 Document</h3>
                      <hr class="mb-3">
                      <h4 class="services-details__content__title">
                        <strong>Title:</strong>
                        <span class="card-text badge bg-warning text-dark px-2 py-1 rounded-pill">
                          <?= htmlspecialchars($line_document['document_title']); ?>
                        </span>
                      </h4>
                      <h5 class="mt-3 text-secondary">📜 Document Instructions:</h5>
                      <div class="alert alert-success">
                        <?= htmlspecialchars($line_document['document_ins']); ?>
                      </div>
                      <?php if (!empty($line_document['document_file'])) {
                        $file_path = UP_FILES_WS_PATH . '/documents/' . $line_document['document_file'];
                        $file_extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
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
                        $file_format = isset($file_types[$file_extension]) ? $file_types[$file_extension] : '📁 Unknown File';
                      ?>
                        <div class="file-preview-container text-center">
                          <div class="file-preview-card shadow-lg rounded-3 p-3">
                            <h6 class="text-secondary mb-2">Format: <strong><?= $file_format; ?></strong></h6>
                            <?php if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) { ?>
                              <img src="<?= $file_path; ?>" class="img-fluid rounded" alt="Document Image">
                            <?php } elseif ($file_extension === 'pdf') { ?>
                              <iframe src="<?= $file_path; ?>" class="pdf-preview w-100" frameborder="0"></iframe>
                            <?php } else { ?>
                              <div class="file-icon">
                                <i class="bi bi-file-earmark-text text-primary" style="font-size: 4rem;"></i>
                              </div>
                            <?php } ?>
                            <div class="mt-3">
                              <a href="<?= $file_path; ?>" target="_blank" class="btn btn-outline-success fw-bold me-2">
                                👁️ View File
                              </a>
                              <a href="<?= $file_path; ?>" download class="btn btn-outline-primary fw-bold">
                                ⬇️ Download
                              </a>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
            <?php
              }
              echo '</div>';
            } 
            ?>
          </section>
          <div class="accrodion-one__wrapper nisoz-accrodion" data-grp-name="nisoz-accrodion">
            <h3 class="services-details__content__title">Service Related FAQ</h3>
            <?php
            $sql_faq = "SELECT * FROM ngo_faq WHERE faq_status='Active' and faq_s_id = '$s_id' ORDER BY faq_id ASC";
            $result_faq = db_query($sql_faq);
            $total_faq = mysqli_num_rows($result_faq);
            if ($total_faq > 0) {
              while ($line_faq = mysqli_fetch_array($result_faq)) {
            ?>
                <div class="accrodion">
                  <div class="accrodion-title">
                    <h4><?= htmlspecialchars($line_faq['faq_question']); ?></h4>
                  </div>
                  <div class="accrodion-content">
                    <div class="inner">
                      <p><?= htmlspecialchars($line_faq['faq_answer']); ?></p>
                    </div>
                  </div>
                </div>
            <?php
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


        </div>
      </div>
    </section>
    <!-- Services Details End -->
    <!-- Footer -->

  </div>

  </section>

  <?php include("includes/footer.inc.php") ?>
  <!-- Footer End -->
  <!--extra Footer -->
  <?php include("includes/extra_footer.inc.php") ?>
  <!--extra Footer End  -->
  </div>
</body>

</html>