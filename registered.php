<?php
include ("includes/surya.dream.php");  
$page='registration' ;
//protect_user_page();

?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-layout-mode="dark" data-body-image="img-1" data-preloader="disable">
<? include("includes/extra_file.inc.php")?>
<body>
<body>
<div class="auth-page-wrapper pt-5">
<!-- auth page content -->
<div class="auth-page-content">
  <div class="container">
    <div class="row">
        <div class="col-lg-12">
          <div class="text-center mt-sm-0 mb-0 text-white-50">
            <div> 
			<? if($_SESSION['sess_uid']==''){ ?>
                 <a href="index" class="d-inline-block auth-logo"> <img src="assets/images/logo-priyagroup.png" alt="" > </a>
				<? } else { ?>
				 <a href="./userpanel/myaccount" class="d-inline-block auth-logo"> <img src="assets/images/logo-priyagroup.png" alt="" > </a>
 			 <? } ?> 
			 </div>
            <?php /*?><p class="mt-3 fs-15 fw-medium">Fast And Easy Way To Access NFT Market</p><?php */?>
          </div>
        </div>
      </div>
    <!-- end row -->
	<div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
					
                        <div class="card mt-4 card-bg-fill">

                            <div class="card-body p- 4">
							 
                                <div class="text-center mt-2">
								<h3 class="text-primary">Congratulations!</h3>
								<h5 class="text-primary">Registration Confirmed</h5>
								 <p align="center"> <img width="35%"  src="assets/login-libs/images/success.gif"/></p>   
								 
								 
             <?php /*?> <p class="text-muted"> Thank You for Joining . Kindly Save Your Login Details!</p><?php */?>
                                
                                </div>
                                <div class="p-2 mt -4">
								
								 <? include("error_msg.inc.php");?>
								 <form name="registration" class="login-form "  id="contact-form" method="post" action="<?=$_SERVER['PHP_SELF']?>" enctype="multipart/form-data"  <?= validate_form()?> >
                  <? 
if ($u_id=='') {
	if ($_SESSION['sess_recid']!='') {$u_id=$_SESSION['sess_recid'];} else {$u_id = $_SESSION['sess_uid'];} 
}
								
$sql = "select * from ngo_users where  u_id ='$u_id'";
$result = db_query($sql);
$line= mysqli_fetch_array($result);
@extract($line);
							  ?>
							

                  <table width="85%" border="0" style="margin-left:auto; margin-right:auto;"   >
				  
                    <tr>
                      <td width="50%" align="left" style="text-align:left;" > Name </td><td align="center">: </td>
					  <td width="50%" align="right" valign="top" style="text-align:right;"> <?=$u_fname." ".$u_lname?>
                      </td>
                    </tr>
					<?php /*?><tr>
                      <td width="50%" align="left" style="text-align:left;" > Mobile </td><td align="center">: </td>
					  <td width="50%" align="right" valign="top" style="text-align:right;"> <?=$u_mobile?>
                      </td>
                    </tr><?php */?>
                    <tr>
                      <td width="50%" align="left" valign="top" style="text-align:left;" > User ID  </td><td align="center">: </td> </td>
					  <td width="50%" align="right" valign="top" style="text-align:right;"> <?=$u_username?>
                      </td>
                    </tr>
					<tr>
                      <td   align="left" valign="top" style="text-align:left;" >Email  </td><td align="center">: </td> </td>
					  <td width="50%" align="right" valign="top" style="text-align:right;">&nbsp;<?=$u_email?>
                      </td>
                    </tr>
                    <tr>
                      <td   align="left" valign="top" style="text-align:left;" >Password  </td><td align="center">: </td>  </td>
					  <td width="50%" align="right" valign="top" style="text-align:right;"><?=$u_password?>
                      </td>
                    </tr>
					 <tr>
                      <td   align="left" valign="top" style="text-align:left;" nowrap="nowrap" >Transaction Password </td><td align="center">: </td> </td>
					  <td width="50%" align="right" valign="top" style="text-align:right;"> <?=$u_password2?>
                      </td>
                    </tr>
					 <tr>
                      <td   align="left" valign="top" style="text-align:left;" >Date  </td><td align="center">: </td> </td>
					  <td width="50%" align="right" valign="top" style="text-align:right;"> <?=date_format2($u_date)?>
                      </td>
                    </tr>
					<?php /*?><tr>
                      <td   align="left" valign="top" style="text-align:left;" >Sponsor Id  </td><td align="center">: </td> </td>
					  <td width="50%" align="right" valign="top" style="text-align:right;"> <?=db_scalar("select u_username from ngo_users where u_id = '$u_ref_userid'");?>
                      </td>
                    </tr><?php */?>
					
					
					<?php /*?><tr>
                      <td   align="left" valign="top" style="text-align:left;" >City  </td><td align="center">: </td> </td>
					  <td width="50%" align="right" valign="top" style="text-align:right;"> <?=$u_city?>
                      </td>
                    </tr><?php */?>
                  </table>
                </form>
<div class="mt-4 text-center">
                            
							
				<? if($_SESSION['sess_uid']==''){ ?>
                          <p class="mb-0">Want to access your account? <a href="login" class="fw-semibold text-primary text-decoration-underline"> Login </a>
						  
						<? } else { ?>
						<p class="mb-0">Go back to dashboard <a href="./userpanel/myaccount" class="fw-semibold text-primary text-decoration-underline"> Click here </a>  OR <a href="./userpanel/logout" class="fw-semibold text-primary text-decoration-underline"> Logout </a> </p>
						<? } ?>	
						<p class="mb-0">Don't have an account ? <a href="register-user.php" class="fw-semibold text-primary text-decoration-underline"> Join Us</a> </p>		
							
							
							 </p>
                        </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        

                    </div>
                </div>
     
    <!-- end container -->
  </div>
  <!-- end auth page content -->
  <!-- footer -->
    <? include("includes/footer_login.inc.php")?>
  <!-- end Footer -->
</div>
<? include("includes/footer_extra.inc.php")?>
</body>
</html>
