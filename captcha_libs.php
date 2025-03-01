<?php include ("includes/surya.dream.php");  
   session_start();
  // Generate captcha code
  $random_num    = md5(random_bytes(64));
  $captcha_code  = substr($random_num, 0, 6);
  // Assign captcha in session
  $_SESSION['CAPTCHA_CODE'] = $captcha_code;
  // Create captcha image
  $layer = imagecreatetruecolor(85, 37);
  $captcha_bg = imagecolorallocate($layer, 182, 239, 0);
  imagefill($layer, 0, 0, $captcha_bg);
  $captcha_text_color = imagecolorallocate($layer, 0, 0, 0);
  imagestring($layer, 5, 15, 10, $captcha_code, $captcha_text_color);
  header("Content-type: image/jpeg");
  imagejpeg($layer);
 ?>