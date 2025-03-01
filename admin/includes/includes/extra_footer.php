 <!-- App js -->

<?php /*?> <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script><?php */?>
    <!-- Include Bootstrap JS -->
   <?php /*?> <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script><?php */?>
    

    <!-- Include Summernote JS -->
   
    <!-- Include Bootstrap CSS and JS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
   <?php /*?> <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script><?php */?>
    <!-- Include Summernote CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css" rel="stylesheet">
    <?php /*?><script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script><?php */?>
   	<!-- Include Summernote JS -->



   
 <script src="<?=SITE_BACKEND_BASE_URL?>/js/vendor.min.js"></script>
<script src="<?=SITE_BACKEND_BASE_URL?>/js/app.js"></script>



<!-- Knob charts js -->
<script src="<?=SITE_BACKEND_BASE_URL?>/libs/jquery-knob/jquery.knob.min.js"></script>

<!-- Sparkline Js-->
<script src="<?=SITE_BACKEND_BASE_URL?>/libs/jquery-sparkline/jquery.sparkline.min.js"></script>

<script src="<?=SITE_BACKEND_BASE_URL?>/libs/morris.js/morris.min.js"></script>

<script src="<?=SITE_BACKEND_BASE_URL?>/libs/raphael/raphael.min.js"></script>


<!-- Dashboard init-->

<script src="<?=SITE_BACKEND_BASE_URL?>/js/pages/dashboard.js"></script>
<!-- <script src="<?=SITE_BACKEND_BASE_URL?>/js/pages/ckeditor.js"></script> -->
 <script src="<?=SITE_BACKEND_BASE_URL?>/js/summernote-bs4.min.js"></script> 
  
  
  
  
<!--summer note new start script --> 

 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>
  
<!--summer note new start script -->
  
  
  
  
  
  <script>
  
  $('#summernote').summernote({
    callbacks: {
        onImageUpload: function(files) {
            uploadImage(files[0]);
        }
    }
});

/*function uploadImage(file) {
    var data = new FormData();
    data.append("file", file);
    $.ajax({
        url: 'upload.php', // Your server-side upload script
        type: 'POST',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(url) {
            $('#summernote').summernote('insertImage', url);
        },
        error: function(data) {
            console.log(data);
        }
    });
}*/
 
        $(document).ready(function() {
            // $('#summernote').summernote({
            //     placeholder: 'Write your content here',
            //     height: 200
            // });
			
			$('.summernote').summernote({
                placeholder: 'Write your content here',
                height: 428
            });
			
			
        });
    </script>

<? include('../includes/fvalidate.inc.php') ?>