<?php
include ("./includes/surya.dream.php");
///protect_user_page();
$arr_error_msgs =array();
$arr_success_msgs =array();
 if(is_post_back()) {
 	@extract($_POST);
  	//$multiple_500=$creq_amount % 10;	
	//if ($multiple_500 != '0') { $arr_error_msgs[] =  "Enter deposit amount in multiple of $ 10";}
	if ($for_username=='') { $arr_error_msgs[] =  "Enter Your User ID";}
	if ($captcha!=$_SESSION['CAPTCHA_CODE']){ 
		$arr_error_msgs[] ="Captcha string does not match"; 
 	} 
	
	$total_count = db_scalar("select count(*) from ngo_users where u_username='$for_username' and u_status='Active'")+0;
	if ($total_count >0){
  	$sql="select * from ngo_users where u_username='$for_username' and u_status='Active'";
 	$result = db_query($sql);
	if($line=mysqli_fetch_array($result)){
 	 @extract($line); 
  	}
	
	if  ($_POST['Submit']=='Confirm Credentials') {
	
	if ($u_security_qst=='') { $arr_error_msgs[] =  "Security question not setup for this account! Setup First";
	  $verify1 = 'not';
	}
	
	if ($for_mobile!=$u_mobile) { $arr_error_msgs[] =  "Your have entered wrong mobile no. $for_mobile";
	  $verify1 = 'not';
	}
	
	if ($for_answer!=$u_security_ans) { $arr_error_msgs[] =  "Your have entered wrong security answer! Try Again";
	  $verify2 = 'not';
	}
   
   } 
   
   
   
   } else {
    $arr_error_msgs[] ="User ID does not exist with us ";
	$_SESSION['arr_error_msgs'] = $arr_error_msgs;
    }
	
	/*if($creq_remark!='') { 
	 $total_count = db_scalar("select count(*) from ngo_deposit_req where creq_remark = '$creq_remark' ")+0;	
 	 if ($total_count>0) { $arr_error_msgs[] =  "Invalid ".$creq_remark_type."! This ".$creq_remark_type." has been already used";}
	}*/
	
$_SESSION['arr_error_msgs'] = $arr_error_msgs;
		//print_r($arr_error_msgs);
if (count($arr_error_msgs) ==0) {

	if ($_POST['Submit']=='Continue') {
		$arr_success_msgs[] = "Enter your account credentials to retrieve your account";
		$_SESSION['arr_success_msgs'] = $arr_success_msgs;
		$for_question = $u_security_qst; 
		///$action = 'Continue';
		  $action = 'Continue';
		  $_SESSION['CAPTCHA_CODE']='';
		 
    } else if  ($_POST['Submit']=='Confirm Credentials' && $verify1!='not' && $verify2!='not') {
	$action = 'Recovered';
 	$sql2="select * from ngo_users where u_username='$for_username' and u_security_ans='$for_answer' and u_status='Active'";
  	$result2 = db_query($sql2);
	if($line2=mysqli_fetch_array($result2)){/* @extract($line2); */}
	
	  /*$credential_message="
	Dear $u_fname
	
	Here are your ".SITE_NAME." login details:
	
	-------------------------------
	Your User ID is  : $u_username 
	Your Password is  : $u_password 
	Transaction Password is  : $u_password2  
	-------------------------------
	
	Sincerely, 
 	
	". SITE_NAME;*/
	 
 	 
 		$arr_success_msgs[] =  "Your account recovered successfully";
		$_SESSION['arr_success_msgs'] = $arr_success_msgs;
 	//header("Location: fund_deposit_request.php");
	//exit;
	
	} 
	}
 }

/*$sql = "select * from ngo_deposit_req where  creq_id ='$creq_id'";
$result = db_query($sql);
$line= mysqli_fetch_array($result);
@extract($line);*/

 
//  $SITE_CSS = $_SESSION[sess_css];

?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-layout-mode="dark" data-body-image="img-1" data-preloader="disable">
<? include("includes/extra_file.inc.php")?>
<body>
<div class="auth-page-wrapper pt-5">
  <!-- auth page content -->
  <div class="auth-page-content">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="text-center mt-sm-0 mb-0 text-white-50">
            <div> <a href="index" class="d-inline-block auth-logo"> <img src="assets/images/logo-priyagroup.png" alt="" > </a> </div>
            <?php /*?><p class="mt-3 fs-15 fw-medium">Fast And Easy Way To Access NFT Market</p><?php */?>
          </div>
        </div>
      </div>
      <!-- end row -->
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
          <div class="card mt-4 card-bg-fill">
            <div class="card-body p-4">
              <div class="text-center mt-2">
                <h3 class="text-primary">Recover your Account</h3>
                <!--<p class="text-muted"> Recover your account password details!</p>-->
              </div>
              <div class="p-2 mt-4">
                <? include("error_msg.inc.php");?>
                <form method="post" name="form1" id="login_form_increate"   <?= validate_form()?> enctype="multipart/form-data"  >
                  <?  if ($act!='done') { ?>
                  <table width="100%">
                    <?   if ($action == '')  { ?>
                    <tr>
                      <td> User ID  :</td>
                      <td><input name="for_username" type="text" placeholder="Your User ID"   class="form-control" alt="blank" emsg="Please enter User ID "  >
                      </td>
                    </tr>
					<tr>
                      <td nowrap="nowrap">Captcha :</td>
                      <td> <input name="captcha" id="captcha" type="text" class="form-control " tabindex="3" maxlength="6" style="width:45%; float:left;" placeholder="Captcha" alt="blank" emsg="Please enter captcha" >
					  
                      <button id="MyButton" type="button" style="float:right; background:#fff; border:solid 1px #ccc; padding:2px 5px 2px 5px;" > <i class="ri-refresh-fill" aria-hidden="true" style="color:#063d77; font-size:20px;"></i></button>
          <div class="sig n-fo rget" id="myDiv" style="float:right; background:#f7ae47;"> <img src="captcha_libs.php" > </div>
                     
				  
				   
                      </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input name="Submit" type="submit" value="Continue" class="btn btn-primary mr-2" />
                      </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <? } else if ($action == 'Continue') { ?>
                    <tr>
                      <td>User ID :</td>
                      <td><input name="for_username" type="text" placeholder="Your User ID" readonly="" value="<?=$for_username?>" class="form-control" alt="blank" emsg="Please enter User ID ">
                      </td>
                    </tr>
					<tr>
                      <td >Mobile :</td>
                      <td> <select name="no_code" id="no_code" style="float:left; width:30%; " tabindex="4" class="form-control" onChange="document.getElementById('for_mobile').value=this.value;document.getElementById('for_mobile').focus();">
							<option value="">Country Code</option>
												<option value="+93" style="background: url(images/flags/af.png) no-repeat; padding-left: 20px;">
					Afghanistan +93					</option>
									<option value="+355" style="background: url(images/flags/al.png) no-repeat; padding-left: 20px;">
					Albania +355					</option>
									<option value="+213" style="background: url(images/flags/dz.png) no-repeat; padding-left: 20px;">
					Algeria +213					</option>
									<option value="+1684" style="background: url(images/flags/as.png) no-repeat; padding-left: 20px;">
					American Samoa +1684					</option>
									<option value="+376" style="background: url(images/flags/ad.png) no-repeat; padding-left: 20px;">
					Andorra +376					</option>
									<option value="+244" style="background: url(images/flags/ao.png) no-repeat; padding-left: 20px;">
					Angola +244					</option>
									<option value="+1264" style="background: url(images/flags/ai.png) no-repeat; padding-left: 20px;">
					Anguilla +1264					</option>
									<option value="+0" style="background: url(images/flags/aq.png) no-repeat; padding-left: 20px;">
					Antarctica +0					</option>
									<option value="+1268" style="background: url(images/flags/ag.png) no-repeat; padding-left: 20px;">
					Antigua And Barbuda +1268					</option>
									<option value="+54" style="background: url(images/flags/ar.png) no-repeat; padding-left: 20px;">
					Argentina +54					</option>
									<option value="+374" style="background: url(images/flags/am.png) no-repeat; padding-left: 20px;">
					Armenia +374					</option>
									<option value="+297" style="background: url(images/flags/aw.png) no-repeat; padding-left: 20px;">
					Aruba +297					</option>
									<option value="+61" style="background: url(images/flags/au.png) no-repeat; padding-left: 20px;">
					Australia +61					</option>
									<option value="+43" style="background: url(images/flags/at.png) no-repeat; padding-left: 20px;">
					Austria +43					</option>
									<option value="+994" style="background: url(images/flags/az.png) no-repeat; padding-left: 20px;">
					Azerbaijan +994					</option>
									<option value="+1242" style="background: url(images/flags/bs.png) no-repeat; padding-left: 20px;">
					Bahamas +1242					</option>
									<option value="+973" style="background: url(images/flags/bh.png) no-repeat; padding-left: 20px;">
					Bahrain +973					</option>
									<option value="+880" style="background: url(images/flags/bd.png) no-repeat; padding-left: 20px;">
					Bangladesh +880					</option>
									<option value="+1246" style="background: url(images/flags/bb.png) no-repeat; padding-left: 20px;">
					Barbados +1246					</option>
									<option value="+375" style="background: url(images/flags/by.png) no-repeat; padding-left: 20px;">
					Belarus +375					</option>
									<option value="+32" style="background: url(images/flags/be.png) no-repeat; padding-left: 20px;">
					Belgium +32					</option>
									<option value="+501" style="background: url(images/flags/bz.png) no-repeat; padding-left: 20px;">
					Belize +501					</option>
									<option value="+229" style="background: url(images/flags/bj.png) no-repeat; padding-left: 20px;">
					Benin +229					</option>
									<option value="+1441" style="background: url(images/flags/bm.png) no-repeat; padding-left: 20px;">
					Bermuda +1441					</option>
									<option value="+975" style="background: url(images/flags/bt.png) no-repeat; padding-left: 20px;">
					Bhutan +975					</option>
									<option value="+591" style="background: url(images/flags/bo.png) no-repeat; padding-left: 20px;">
					Bolivia +591					</option>
									<option value="+387" style="background: url(images/flags/ba.png) no-repeat; padding-left: 20px;">
					Bosnia And Herzegovina +387					</option>
									<option value="+267" style="background: url(images/flags/bw.png) no-repeat; padding-left: 20px;">
					Botswana +267					</option>
									<option value="+0" style="background: url(images/flags/bv.png) no-repeat; padding-left: 20px;">
					Bouvet Island +0					</option>
									<option value="+55" style="background: url(images/flags/br.png) no-repeat; padding-left: 20px;">
					Brazil +55					</option>
									<option value="+246" style="background: url(images/flags/io.png) no-repeat; padding-left: 20px;">
					British Indian Ocean Territory +246					</option>
									<option value="+673" style="background: url(images/flags/bn.png) no-repeat; padding-left: 20px;">
					Brunei Darussalam +673					</option>
									<option value="+359" style="background: url(images/flags/bg.png) no-repeat; padding-left: 20px;">
					Bulgaria +359					</option>
									<option value="+226" style="background: url(images/flags/bf.png) no-repeat; padding-left: 20px;">
					Burkina Faso +226					</option>
									<option value="+257" style="background: url(images/flags/bi.png) no-repeat; padding-left: 20px;">
					Burundi +257					</option>
									<option value="+855" style="background: url(images/flags/kh.png) no-repeat; padding-left: 20px;">
					Cambodia +855					</option>
									<option value="+237" style="background: url(images/flags/cm.png) no-repeat; padding-left: 20px;">
					Cameroon +237					</option>
									<option value="+1" style="background: url(images/flags/ca.png) no-repeat; padding-left: 20px;">
					Canada +1					</option>
									<option value="+238" style="background: url(images/flags/cv.png) no-repeat; padding-left: 20px;">
					Cape Verde +238					</option>
									<option value="+1345" style="background: url(images/flags/ky.png) no-repeat; padding-left: 20px;">
					Cayman Islands +1345					</option>
									<option value="+236" style="background: url(images/flags/cf.png) no-repeat; padding-left: 20px;">
					Central African Republic +236					</option>
									<option value="+235" style="background: url(images/flags/td.png) no-repeat; padding-left: 20px;">
					Chad +235					</option>
									<option value="+56" style="background: url(images/flags/cl.png) no-repeat; padding-left: 20px;">
					Chile +56					</option>
									<option value="+86" style="background: url(images/flags/cn.png) no-repeat; padding-left: 20px;">
					China +86					</option>
									<option value="+61" style="background: url(images/flags/cx.png) no-repeat; padding-left: 20px;">
					Christmas Island +61					</option>
									<option value="+672" style="background: url(images/flags/cc.png) no-repeat; padding-left: 20px;">
					Cocos (Keeling) Islands +672					</option>
									<option value="+57" style="background: url(images/flags/co.png) no-repeat; padding-left: 20px;">
					Colombia +57					</option>
									<option value="+269" style="background: url(images/flags/km.png) no-repeat; padding-left: 20px;">
					Comoros +269					</option>
									<option value="+242" style="background: url(images/flags/cg.png) no-repeat; padding-left: 20px;">
					Congo +242					</option>
									<option value="+242" style="background: url(images/flags/cd.png) no-repeat; padding-left: 20px;">
					Congo, The Democratic Republic Of The +242					</option>
									<option value="+682" style="background: url(images/flags/ck.png) no-repeat; padding-left: 20px;">
					Cook Islands +682					</option>
									<option value="+506" style="background: url(images/flags/cr.png) no-repeat; padding-left: 20px;">
					Costa Rica +506					</option>
									<option value="+225" style="background: url(images/flags/ci.png) no-repeat; padding-left: 20px;">
					Cote D'Ivoire +225					</option>
									<option value="+385" style="background: url(images/flags/hr.png) no-repeat; padding-left: 20px;">
					Croatia +385					</option>
									<option value="+53" style="background: url(images/flags/cu.png) no-repeat; padding-left: 20px;">
					Cuba +53					</option>
									<option value="+357" style="background: url(images/flags/cy.png) no-repeat; padding-left: 20px;">
					Cyprus +357					</option>
									<option value="+420" style="background: url(images/flags/cz.png) no-repeat; padding-left: 20px;">
					Czech Republic +420					</option>
									<option value="+45" style="background: url(images/flags/dk.png) no-repeat; padding-left: 20px;">
					Denmark +45					</option>
									<option value="+253" style="background: url(images/flags/dj.png) no-repeat; padding-left: 20px;">
					Djibouti +253					</option>
									<option value="+1767" style="background: url(images/flags/dm.png) no-repeat; padding-left: 20px;">
					Dominica +1767					</option>
									<option value="+1809" style="background: url(images/flags/do.png) no-repeat; padding-left: 20px;">
					Dominican Republic +1809					</option>
									<option value="+593" style="background: url(images/flags/ec.png) no-repeat; padding-left: 20px;">
					Ecuador +593					</option>
									<option value="+20" style="background: url(images/flags/eg.png) no-repeat; padding-left: 20px;">
					Egypt +20					</option>
									<option value="+503" style="background: url(images/flags/sv.png) no-repeat; padding-left: 20px;">
					El Salvador +503					</option>
									<option value="+240" style="background: url(images/flags/gq.png) no-repeat; padding-left: 20px;">
					Equatorial Guinea +240					</option>
									<option value="+291" style="background: url(images/flags/er.png) no-repeat; padding-left: 20px;">
					Eritrea +291					</option>
									<option value="+372" style="background: url(images/flags/ee.png) no-repeat; padding-left: 20px;">
					Estonia +372					</option>
									<option value="+251" style="background: url(images/flags/et.png) no-repeat; padding-left: 20px;">
					Ethiopia +251					</option>
									<option value="+500" style="background: url(images/flags/fk.png) no-repeat; padding-left: 20px;">
					Falkland Islands (Malvinas) +500					</option>
									<option value="+298" style="background: url(images/flags/fo.png) no-repeat; padding-left: 20px;">
					Faroe Islands +298					</option>
									<option value="+679" style="background: url(images/flags/fj.png) no-repeat; padding-left: 20px;">
					Fiji +679					</option>
									<option value="+358" style="background: url(images/flags/fi.png) no-repeat; padding-left: 20px;">
					Finland +358					</option>
									<option value="+33" style="background: url(images/flags/fr.png) no-repeat; padding-left: 20px;">
					France +33					</option>
									<option value="+594" style="background: url(images/flags/gf.png) no-repeat; padding-left: 20px;">
					French Guiana +594					</option>
									<option value="+689" style="background: url(images/flags/pf.png) no-repeat; padding-left: 20px;">
					French Polynesia +689					</option>
									<option value="+0" style="background: url(images/flags/tf.png) no-repeat; padding-left: 20px;">
					French Southern Territories +0					</option>
									<option value="+241" style="background: url(images/flags/ga.png) no-repeat; padding-left: 20px;">
					Gabon +241					</option>
									<option value="+220" style="background: url(images/flags/gm.png) no-repeat; padding-left: 20px;">
					Gambia +220					</option>
									<option value="+995" style="background: url(images/flags/ge.png) no-repeat; padding-left: 20px;">
					Georgia +995					</option>
									<option value="+49" style="background: url(images/flags/de.png) no-repeat; padding-left: 20px;">
					Germany +49					</option>
									<option value="+233" style="background: url(images/flags/gh.png) no-repeat; padding-left: 20px;">
					Ghana +233					</option>
									<option value="+350" style="background: url(images/flags/gi.png) no-repeat; padding-left: 20px;">
					Gibraltar +350					</option>
									<option value="+30" style="background: url(images/flags/gr.png) no-repeat; padding-left: 20px;">
					Greece +30					</option>
									<option value="+299" style="background: url(images/flags/gl.png) no-repeat; padding-left: 20px;">
					Greenland +299					</option>
									<option value="+1473" style="background: url(images/flags/gd.png) no-repeat; padding-left: 20px;">
					Grenada +1473					</option>
									<option value="+590" style="background: url(images/flags/gp.png) no-repeat; padding-left: 20px;">
					Guadeloupe +590					</option>
									<option value="+1671" style="background: url(images/flags/gu.png) no-repeat; padding-left: 20px;">
					Guam +1671					</option>
									<option value="+502" style="background: url(images/flags/gt.png) no-repeat; padding-left: 20px;">
					Guatemala +502					</option>
									<option value="+224" style="background: url(images/flags/gn.png) no-repeat; padding-left: 20px;">
					Guinea +224					</option>
									<option value="+245" style="background: url(images/flags/gw.png) no-repeat; padding-left: 20px;">
					Guinea-Bissau +245					</option>
									<option value="+592" style="background: url(images/flags/gy.png) no-repeat; padding-left: 20px;">
					Guyana +592					</option>
									<option value="+509" style="background: url(images/flags/ht.png) no-repeat; padding-left: 20px;">
					Haiti +509					</option>
									<option value="+0" style="background: url(images/flags/hm.png) no-repeat; padding-left: 20px;">
					Heard Island And Mcdonald Islands +0					</option>
									<option value="+39" style="background: url(images/flags/va.png) no-repeat; padding-left: 20px;">
					Holy See (Vatican City State) +39					</option>
									<option value="+504" style="background: url(images/flags/hn.png) no-repeat; padding-left: 20px;">
					Honduras +504					</option>
									<option value="+852" style="background: url(images/flags/hk.png) no-repeat; padding-left: 20px;">
					Hong Kong +852					</option>
									<option value="+36" style="background: url(images/flags/hu.png) no-repeat; padding-left: 20px;">
					Hungary +36					</option>
									<option value="+354" style="background: url(images/flags/is.png) no-repeat; padding-left: 20px;">
					Iceland +354					</option>
									<option value="+91" style="background: url(images/flags/in.png) no-repeat; padding-left: 20px;">
					India +91					</option>
									<option value="+62" style="background: url(images/flags/id.png) no-repeat; padding-left: 20px;">
					Indonesia +62					</option>
									<option value="+98" style="background: url(images/flags/ir.png) no-repeat; padding-left: 20px;">
					Iran, Islamic Republic Of +98					</option>
									<option value="+964" style="background: url(images/flags/iq.png) no-repeat; padding-left: 20px;">
					Iraq +964					</option>
									<option value="+353" style="background: url(images/flags/ie.png) no-repeat; padding-left: 20px;">
					Ireland +353					</option>
									<option value="+972" style="background: url(images/flags/il.png) no-repeat; padding-left: 20px;">
					Israel +972					</option>
									<option value="+39" style="background: url(images/flags/it.png) no-repeat; padding-left: 20px;">
					Italy +39					</option>
									<option value="+1876" style="background: url(images/flags/jm.png) no-repeat; padding-left: 20px;">
					Jamaica +1876					</option>
									<option value="+81" style="background: url(images/flags/jp.png) no-repeat; padding-left: 20px;">
					Japan +81					</option>
									<option value="+962" style="background: url(images/flags/jo.png) no-repeat; padding-left: 20px;">
					Jordan +962					</option>
									<option value="+7" style="background: url(images/flags/kz.png) no-repeat; padding-left: 20px;">
					Kazakhstan +7					</option>
									<option value="+254" style="background: url(images/flags/ke.png) no-repeat; padding-left: 20px;">
					Kenya +254					</option>
									<option value="+686" style="background: url(images/flags/ki.png) no-repeat; padding-left: 20px;">
					Kiribati +686					</option>
									<option value="+850" style="background: url(images/flags/kp.png) no-repeat; padding-left: 20px;">
					Korea, Democratic People's Republic Of +850					</option>
									<option value="+82" style="background: url(images/flags/kr.png) no-repeat; padding-left: 20px;">
					Korea, Republic Of +82					</option>
									<option value="+965" style="background: url(images/flags/kw.png) no-repeat; padding-left: 20px;">
					Kuwait +965					</option>
									<option value="+996" style="background: url(images/flags/kg.png) no-repeat; padding-left: 20px;">
					Kyrgyzstan +996					</option>
									<option value="+856" style="background: url(images/flags/la.png) no-repeat; padding-left: 20px;">
					Lao People's Democratic Republic +856					</option>
									<option value="+371" style="background: url(images/flags/lv.png) no-repeat; padding-left: 20px;">
					Latvia +371					</option>
									<option value="+961" style="background: url(images/flags/lb.png) no-repeat; padding-left: 20px;">
					Lebanon +961					</option>
									<option value="+266" style="background: url(images/flags/ls.png) no-repeat; padding-left: 20px;">
					Lesotho +266					</option>
									<option value="+231" style="background: url(images/flags/lr.png) no-repeat; padding-left: 20px;">
					Liberia +231					</option>
									<option value="+218" style="background: url(images/flags/ly.png) no-repeat; padding-left: 20px;">
					Libyan Arab Jamahiriya +218					</option>
									<option value="+423" style="background: url(images/flags/li.png) no-repeat; padding-left: 20px;">
					Liechtenstein +423					</option>
									<option value="+370" style="background: url(images/flags/li.png) no-repeat; padding-left: 20px;">
					Lithuania +370					</option>
									<option value="+352" style="background: url(images/flags/lu.png) no-repeat; padding-left: 20px;">
					Luxembourg +352					</option>
									<option value="+853" style="background: url(images/flags/mo.png) no-repeat; padding-left: 20px;">
					Macao +853					</option>
									<option value="+389" style="background: url(images/flags/mk.png) no-repeat; padding-left: 20px;">
					Macedonia, The Former Yugoslav Republic Of +389					</option>
									<option value="+261" style="background: url(images/flags/mg.png) no-repeat; padding-left: 20px;">
					Madagascar +261					</option>
									<option value="+265" style="background: url(images/flags/mw.png) no-repeat; padding-left: 20px;">
					Malawi +265					</option>
									<option value="+60" style="background: url(images/flags/my.png) no-repeat; padding-left: 20px;">
					Malaysia +60					</option>
									<option value="+960" style="background: url(images/flags/mv.png) no-repeat; padding-left: 20px;">
					Maldives +960					</option>
									<option value="+223" style="background: url(images/flags/ml.png) no-repeat; padding-left: 20px;">
					Mali +223					</option>
									<option value="+356" style="background: url(images/flags/mt.png) no-repeat; padding-left: 20px;">
					Malta +356					</option>
									<option value="+692" style="background: url(images/flags/mh.png) no-repeat; padding-left: 20px;">
					Marshall Islands +692					</option>
									<option value="+596" style="background: url(images/flags/mq.png) no-repeat; padding-left: 20px;">
					Martinique +596					</option>
									<option value="+222" style="background: url(images/flags/mr.png) no-repeat; padding-left: 20px;">
					Mauritania +222					</option>
									<option value="+230" style="background: url(images/flags/mu.png) no-repeat; padding-left: 20px;">
					Mauritius +230					</option>
									<option value="+269" style="background: url(images/flags/yt.png) no-repeat; padding-left: 20px;">
					Mayotte +269					</option>
									<option value="+52" style="background: url(images/flags/mx.png) no-repeat; padding-left: 20px;">
					Mexico +52					</option>
									<option value="+691" style="background: url(images/flags/fm.png) no-repeat; padding-left: 20px;">
					Micronesia, Federated States Of +691					</option>

									<option value="+373" style="background: url(images/flags/md.png) no-repeat; padding-left: 20px;">
					Moldova, Republic Of +373					</option>
									<option value="+377" style="background: url(images/flags/mc.png) no-repeat; padding-left: 20px;">
					Monaco +377					</option>
									<option value="+976" style="background: url(images/flags/mn.png) no-repeat; padding-left: 20px;">
					Mongolia +976					</option>
									<option value="+1664" style="background: url(images/flags/ms.png) no-repeat; padding-left: 20px;">
					Montserrat +1664					</option>
									<option value="+212" style="background: url(images/flags/ma.png) no-repeat; padding-left: 20px;">
					Morocco +212					</option>
									<option value="+258" style="background: url(images/flags/mz.png) no-repeat; padding-left: 20px;">
					Mozambique +258					</option>
									<option value="+95" style="background: url(images/flags/mm.png) no-repeat; padding-left: 20px;">
					Myanmar +95					</option>
									<option value="+264" style="background: url(images/flags/na.png) no-repeat; padding-left: 20px;">
					Namibia +264					</option>
									<option value="+674" style="background: url(images/flags/nr.png) no-repeat; padding-left: 20px;">
					Nauru +674					</option>
									<option value="+977" style="background: url(images/flags/np.png) no-repeat; padding-left: 20px;">
					Nepal +977					</option>
									<option value="+31" style="background: url(images/flags/nl.png) no-repeat; padding-left: 20px;">
					Netherlands +31					</option>
									<option value="+599" style="background: url(images/flags/an.png) no-repeat; padding-left: 20px;">
					Netherlands Antilles +599					</option>
									<option value="+687" style="background: url(images/flags/nc.png) no-repeat; padding-left: 20px;">
					New Caledonia +687					</option>
									<option value="+64" style="background: url(images/flags/nz.png) no-repeat; padding-left: 20px;">
					New Zealand +64					</option>
									<option value="+505" style="background: url(images/flags/ni.png) no-repeat; padding-left: 20px;">
					Nicaragua +505					</option>
									<option value="+227" style="background: url(images/flags/ne.png) no-repeat; padding-left: 20px;">
					Niger +227					</option>
									<option value="+234" style="background: url(images/flags/ng.png) no-repeat; padding-left: 20px;">
					Nigeria +234					</option>
									<option value="+683" style="background: url(images/flags/nu.png) no-repeat; padding-left: 20px;">
					Niue +683					</option>
									<option value="+672" style="background: url(images/flags/nf.png) no-repeat; padding-left: 20px;">
					Norfolk Island +672					</option>
									<option value="+1670" style="background: url(images/flags/mp.png) no-repeat; padding-left: 20px;">
					Northern Mariana Islands +1670					</option>
									<option value="+47" style="background: url(images/flags/no.png) no-repeat; padding-left: 20px;">
					Norway +47					</option>
									<option value="+968" style="background: url(images/flags/om.png) no-repeat; padding-left: 20px;">
					Oman +968					</option>
									<option value="+92" style="background: url(images/flags/pk.png) no-repeat; padding-left: 20px;">
					Pakistan +92					</option>
									<option value="+680" style="background: url(images/flags/pw.png) no-repeat; padding-left: 20px;">
					Palau +680					</option>
									<option value="+970" style="background: url(images/flags/ps.png) no-repeat; padding-left: 20px;">
					Palestinian Territory, Occupied +970					</option>
									<option value="+507" style="background: url(images/flags/pa.png) no-repeat; padding-left: 20px;">
					Panama +507					</option>
									<option value="+675" style="background: url(images/flags/pg.png) no-repeat; padding-left: 20px;">
					Papua New Guinea +675					</option>
									<option value="+595" style="background: url(images/flags/py.png) no-repeat; padding-left: 20px;">
					Paraguay +595					</option>
									<option value="+51" style="background: url(images/flags/pe.png) no-repeat; padding-left: 20px;">
					Peru +51					</option>
									<option value="+63" style="background: url(images/flags/ph.png) no-repeat; padding-left: 20px;">
					Philippines +63					</option>
									<option value="+0" style="background: url(images/flags/pn.png) no-repeat; padding-left: 20px;">
					Pitcairn +0					</option>
									<option value="+48" style="background: url(images/flags/pl.png) no-repeat; padding-left: 20px;">
					Poland +48					</option>
									<option value="+351" style="background: url(images/flags/pt.png) no-repeat; padding-left: 20px;">
					Portugal +351					</option>
									<option value="+1787" style="background: url(images/flags/pr.png) no-repeat; padding-left: 20px;">
					Puerto Rico +1787					</option>
									<option value="+974" style="background: url(images/flags/qa.png) no-repeat; padding-left: 20px;">
					Qatar +974					</option>
									<option value="+262" style="background: url(images/flags/re.png) no-repeat; padding-left: 20px;">
					Reunion +262					</option>
									<option value="+40" style="background: url(images/flags/ro.png) no-repeat; padding-left: 20px;">
					Romania +40					</option>
									<option value="+70" style="background: url(images/flags/ru.png) no-repeat; padding-left: 20px;">
					Russian Federation +70					</option>
									<option value="+250" style="background: url(images/flags/rw.png) no-repeat; padding-left: 20px;">
					Rwanda +250					</option>
									<option value="+290" style="background: url(images/flags/sh.png) no-repeat; padding-left: 20px;">
					Saint Helena +290					</option>
									<option value="+1869" style="background: url(images/flags/kn.png) no-repeat; padding-left: 20px;">
					Saint Kitts And Nevis +1869					</option>
									<option value="+1758" style="background: url(images/flags/lc.png) no-repeat; padding-left: 20px;">
					Saint Lucia +1758					</option>
									<option value="+508" style="background: url(images/flags/pm.png) no-repeat; padding-left: 20px;">
					Saint Pierre And Miquelon +508					</option>
									<option value="+1784" style="background: url(images/flags/vc.png) no-repeat; padding-left: 20px;">
					Saint Vincent And The Grenadines +1784					</option>
									<option value="+684" style="background: url(images/flags/ws.png) no-repeat; padding-left: 20px;">
					Samoa +684					</option>
									<option value="+378" style="background: url(images/flags/sm.png) no-repeat; padding-left: 20px;">
					San Marino +378					</option>
									<option value="+239" style="background: url(images/flags/st.png) no-repeat; padding-left: 20px;">
					Sao Tome And Principe +239					</option>
									<option value="+966" style="background: url(images/flags/sa.png) no-repeat; padding-left: 20px;">
					Saudi Arabia +966					</option>
									<option value="+221" style="background: url(images/flags/sn.png) no-repeat; padding-left: 20px;">
					Senegal +221					</option>
									<option value="+381" style="background: url(images/flags/cs.png) no-repeat; padding-left: 20px;">
					Serbia And Montenegro +381					</option>
									<option value="+248" style="background: url(images/flags/sc.png) no-repeat; padding-left: 20px;">
					Seychelles +248					</option>
									<option value="+232" style="background: url(images/flags/sl.png) no-repeat; padding-left: 20px;">
					Sierra Leone +232					</option>
									<option value="+65" style="background: url(images/flags/sg.png) no-repeat; padding-left: 20px;">
					Singapore +65					</option>
									<option value="+421" style="background: url(images/flags/sk.png) no-repeat; padding-left: 20px;">
					Slovakia +421					</option>
									<option value="+386" style="background: url(images/flags/si.png) no-repeat; padding-left: 20px;">
					Slovenia +386					</option>
									<option value="+677" style="background: url(images/flags/sb.png) no-repeat; padding-left: 20px;">
					Solomon Islands +677					</option>
									<option value="+252" style="background: url(images/flags/so.png) no-repeat; padding-left: 20px;">
					Somalia +252					</option>
									<option value="+27" style="background: url(images/flags/za.png) no-repeat; padding-left: 20px;">
					South Africa +27					</option>
									<option value="+0" style="background: url(images/flags/gs.png) no-repeat; padding-left: 20px;">
					South Georgia And The South Sandwich Islands +0					</option>
									<option value="+34" style="background: url(images/flags/es.png) no-repeat; padding-left: 20px;">
					Spain +34					</option>
									<option value="+94" style="background: url(images/flags/lk.png) no-repeat; padding-left: 20px;">
					Sri Lanka +94					</option>
									<option value="+249" style="background: url(images/flags/sd.png) no-repeat; padding-left: 20px;">
					Sudan +249					</option>
									<option value="+597" style="background: url(images/flags/sr.png) no-repeat; padding-left: 20px;">
					Suriname +597					</option>
									<option value="+47" style="background: url(images/flags/sj.png) no-repeat; padding-left: 20px;">
					Svalbard And Jan Mayen +47					</option>
									<option value="+268" style="background: url(images/flags/sz.png) no-repeat; padding-left: 20px;">
					Swaziland +268					</option>
									<option value="+46" style="background: url(images/flags/se.png) no-repeat; padding-left: 20px;">
					Sweden +46					</option>
									<option value="+41" style="background: url(images/flags/ch.png) no-repeat; padding-left: 20px;">
					Switzerland +41					</option>
									<option value="+963" style="background: url(images/flags/sy.png) no-repeat; padding-left: 20px;">
					Syrian Arab Republic +963					</option>
									<option value="+886" style="background: url(images/flags/tw.png) no-repeat; padding-left: 20px;">
					Taiwan, Province Of China +886					</option>
									<option value="+992" style="background: url(images/flags/tj.png) no-repeat; padding-left: 20px;">
					Tajikistan +992					</option>
									<option value="+255" style="background: url(images/flags/tz.png) no-repeat; padding-left: 20px;">
					Tanzania, United Republic Of +255					</option>
									<option value="+66" style="background: url(images/flags/th.png) no-repeat; padding-left: 20px;">
					Thailand +66					</option>
									<option value="+670" style="background: url(images/flags/tl.png) no-repeat; padding-left: 20px;">
					Timor-Leste +670					</option>
									<option value="+228" style="background: url(images/flags/tg.png) no-repeat; padding-left: 20px;">
					Togo +228					</option>
									<option value="+690" style="background: url(images/flags/tk.png) no-repeat; padding-left: 20px;">
					Tokelau +690					</option>
									<option value="+676" style="background: url(images/flags/to.png) no-repeat; padding-left: 20px;">
					Tonga +676					</option>
									<option value="+1868" style="background: url(images/flags/tt.png) no-repeat; padding-left: 20px;">
					Trinidad And Tobago +1868					</option>
									<option value="+216" style="background: url(images/flags/tn.png) no-repeat; padding-left: 20px;">
					Tunisia +216					</option>
									<option value="+90" style="background: url(images/flags/tr.png) no-repeat; padding-left: 20px;">
					Turkey +90					</option>
									<option value="+7370" style="background: url(images/flags/tm.png) no-repeat; padding-left: 20px;">
					Turkmenistan +7370					</option>
									<option value="+1649" style="background: url(images/flags/tc.png) no-repeat; padding-left: 20px;">
					Turks And Caicos Islands +1649					</option>
									<option value="+688" style="background: url(images/flags/tv.png) no-repeat; padding-left: 20px;">
					Tuvalu +688					</option>
									<option value="+256" style="background: url(images/flags/ug.png) no-repeat; padding-left: 20px;">
					Uganda +256					</option>
									<option value="+380" style="background: url(images/flags/ua.png) no-repeat; padding-left: 20px;">
					Ukraine +380					</option>
									<option value="+971" style="background: url(images/flags/ae.png) no-repeat; padding-left: 20px;">
					United Arab Emirates +971					</option>
									<option value="+44" style="background: url(images/flags/gb.png) no-repeat; padding-left: 20px;">
					United Kingdom +44					</option>
									<option value="+1" style="background: url(images/flags/us.png) no-repeat; padding-left: 20px;">
					United States +1					</option>
									<option value="+1" style="background: url(images/flags/um.png) no-repeat; padding-left: 20px;">
					United States Minor Outlying Islands +1					</option>
									<option value="+598" style="background: url(images/flags/uy.png) no-repeat; padding-left: 20px;">
					Uruguay +598					</option>
									<option value="+998" style="background: url(images/flags/uz.png) no-repeat; padding-left: 20px;">
					Uzbekistan +998					</option>
									<option value="+678" style="background: url(images/flags/vu.png) no-repeat; padding-left: 20px;">
					Vanuatu +678					</option>
									<option value="+58" style="background: url(images/flags/ve.png) no-repeat; padding-left: 20px;">
					Venezuela +58					</option>
									<option value="+84" style="background: url(images/flags/vn.png) no-repeat; padding-left: 20px;">
					Viet Nam +84					</option>
									<option value="+1284" style="background: url(images/flags/vg.png) no-repeat; padding-left: 20px;">
					Virgin Islands, British +1284					</option>
									<option value="+1340" style="background: url(images/flags/vi.png) no-repeat; padding-left: 20px;">
					Virgin Islands, U.s. +1340					</option>
									<option value="+681" style="background: url(images/flags/wf.png) no-repeat; padding-left: 20px;">
					Wallis And Futuna +681					</option>
									<option value="+212" style="background: url(images/flags/eh.png) no-repeat; padding-left: 20px;">
					Western Sahara +212					</option>
									<option value="+967" style="background: url(images/flags/ye.png) no-repeat; padding-left: 20px;">
					Yemen +967					</option>
									<option value="+260" style="background: url(images/flags/zm.png) no-repeat; padding-left: 20px;">
					Zambia +260					</option>
									<option value="+263" style="background: url(images/flags/zw.png) no-repeat; padding-left: 20px;">
					Zimbabwe +263					</option>
											</select> <input name="for_mobile" tabindex="5" style="float:left; width:70%; " type="text" class="form-control" id="for_mobile" value="<?=$for_mobile?>" alt="number" emsg="Please Enter Mobile Number " placeholder="Your Mobile"/> 
                      </td>
                    </tr>
                    <tr>
                      <td nowrap="nowrap">Security<br>
 Question  :</td>
                      <td><strong> <?=$for_question?> </strong></td>
                    </tr>
					<tr>
                      <td nowrap="nowrap">Your Answer  :</td>
                      <td><input name="for_answer" type="text" placeholder="Your Security Answer" value="<?=$for_answer?>" class="form-control" alt="blank" emsg="Please enter Security Answer ">
                      </td>
                    </tr>
					
                      <tr>
                      <!-- <td valign="top"></td>-->
                      <td></td>
                      <td valign="top" align="left"> 
					 	 <!--<input name="for_question" type="hidden"  readonly="" value="<?=$for_question?>" class="form-control"  >-->
						 <input name="captcha" id="captcha" type="hidden" class="form-control "  style="width:45%; float:left;" value="<?=$_SESSION['CAPTCHA_CODE']?>"  >
                         <input name="Submit" type="submit" class="btn btn-primary mr-2" value="Confirm Credentials" />
                      </td>
                    </tr>
					<tr>
                       <td colspan="2"><?=$credential_message?></td>
                     </tr>
                    <? } else if ($action == 'Recovered') { ?>
                  
                     <tr>
                      <td width="50%" align="left" style="text-align:left;" > Name </td><td align="center">: </td>
					  <td width="50%" align="right" valign="top" style="text-align:right;"> <?=$u_fname." ".$u_lname?>
                      </td>
                    </tr>
					<tr>
                      <td width="50%" align="left" style="text-align:left;" > Mobile </td><td align="center">: </td>
					  <td width="50%" align="right" valign="top" style="text-align:right;"> <?=$u_mobile?>
                      </td>
                    </tr>
                    <tr>
                      <td width="50%" align="left" valign="top" style="text-align:left;" > User Id  </td><td align="center">: </td> </td>
					  <td width="50%" align="right" valign="top" style="text-align:right;"> <?=$u_username?>
                      </td>
                    </tr>
                    <tr>
                      <td   align="left" valign="top" style="text-align:left;" >Password  </td><td align="center">: </td>  </td>
					  <td width="50%" align="right" valign="top" style="text-align:right;"><?=$u_password?>
                      </td>
                    </tr>
					 <tr>
                      <td   align="left" valign="top" style="text-align:left;" >Transaction Password </td><td align="center">: </td> </td>
					  <td width="50%" align="right" valign="top" style="text-align:right;"> <?=$u_password2?>
                      </td>
                    </tr>
					<tr>
                      <td   align="left" valign="top" style="text-align:left;" >Email  </td><td align="center">: </td> </td>
					  <td width="50%" align="right" valign="top" style="text-align:right;"> <?=$u_email?>
                      </td>
                    </tr>
                   <? }   ?>
				  </table>
				   <? }   ?>
                </form>
                <div class="mt-4 text-center">
                  <p class="mb-0">Already have an account? <a href="login" class="fw-semibold text-primary text-decoration-underline"> Login </a> </p>
                </div>
                <!--<div class="mt-4 text-center">
                    <div class="signin-other-title">
                      <h5 class="fs-13 mb-4 title">Sign In with</h5>
                    </div>
                    <div>
                      <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-facebook-fill fs-16"></i></button>
                      <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-google-fill fs-16"></i></button>
                      <button type="button" class="btn btn-dark btn-icon waves-effect waves-light"><i class="ri-github-fill fs-16"></i></button>
                      <button type="button" class="btn btn-info btn-icon waves-effect waves-light"><i class="ri-twitter-fill fs-16"></i></button>
                    </div>
                  </div>-->
              </div>
            </div>
            <!-- end card body -->
          </div>
          <!-- end card -->
        </div>
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </div>
  <!-- end auth page content -->
  <!-- footer -->
  <? include("includes/footer_login.inc.php")?>
  <!-- end Footer -->
</div>
<!-- end auth-page-wrapper -->
<? include("includes/footer_extra.inc.php")?>
</body>
</html>