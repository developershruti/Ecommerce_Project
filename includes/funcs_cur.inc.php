<?
function validate_form()
{
	return ' onsubmit="return validateForm(this,0,0,0,1,8);" ';
}
 
/////////////// sendgrid.com API function Start  ////////////////////////////


function sendmail($to, $subject, $message){
	$curlData	=	array(
		'url'			=>	'https://api.sendgrid.com/v3/mail/send',
		'httpHeader'	=>	array(
			'Content-Type: application/json',
			'Authorization: Bearer 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'
		)
	);
	$postData = array(
		'personalizations'	=>	array(
			array('to'	=>	array(array('email' => $to)))
		),
		'from'	=>	array (
			'email' => 	'info@rozipay.com',
			'name'	=>	'Rozipay'
		),
		'subject' => $subject,
		'content' => array (array ('type' => 'text/html', 'value' => $message,),),
	);
	
	if($attachment){
		$attachmentData = array();
		foreach($attachment as $key_attachment => $attach){
			$attachmentData[] = array('content' => base64_encode(file_get_contents($attach['file'])), 'filename' => $attach['filename']);
		}
		$postData['attachments']	=	$attachmentData;
	}
	
	$postData = json_encode($postData);
	return sendCURL($curlData, $postData);
	}
	
	
	function sendCURL($data, $postFields = false, $getHeaderResponse = false){
		$url    =   $data['url'];
		$curl	=	curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		//curl_setopt($curl, CURLOPT_FRESH_CONNECT, TRUE);
		if(isset($data['connectTimeOut'])){
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $data['connectTimeOut']);
		}else{
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT,2);
		}
		if(isset($data['timeout']) && $data['timeout'] != ""){
			curl_setopt($curl, CURLOPT_TIMEOUT, $data['timeout']);
		}
		if(isset($data['loginAuthentication'])){
			curl_setopt( $curl, CURLOPT_USERPWD, $data['loginAuthentication']['username'] . ':' . $data['loginAuthentication']['password']);
		}
		if(isset($data['httpHeader']) && $data['httpHeader'] != ""){
			curl_setopt( $curl, CURLOPT_HTTPHEADER, $data['httpHeader']);
		}
		if($postFields){
			//var_dump($postFields);die('test');
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $postFields);
		}
		//curl_setopt($curl,CURLOPT_PROXYTYPE,CURLPROXY_HTTP);
		if(isset($data['skipResponse']) && $data['skipResponse'] != ""){
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);
		}else{
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		}
		curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_ENCODING, 'identity');
		curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		curl_setopt($curl, CURLOPT_USERAGENT, 'Bizz91');
		$buffer = curl_exec ($curl);
		$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		if(!$buffer){
			$buffer = "Error: (". curl_errno($curl) . ") " . curl_error($curl);
		}
		curl_close($curl);
		if($getHeaderResponse){
			return  ['httpCode' => $httpcode, 'response' => $buffer];
		}else{
			return $buffer;
		}
	}
	

///////////////sendgrid.com API function End  ////////////////////////////

 

	function send_sms($mobilenumbers,$message,$msg_id='') {
		if ($mobilenumbers!='' && $message!='') {
		
			//$url="https://api.bizzsms.in/api/v2/SendSMS?SenderId=ROZIPY&Is_Unicode=false&Is_Flash=false&Message=$message&MobileNumbers=$mobilenumbers&ApiKey=70sLcArgjj5gnPKZ6G8te/ycrk+nrfElnnC5iWro6Nc=&ClientId=2122085a-abe2-43de-9569-99ceced7747d";
	   
			$message = urlencode($message);
			//$url="http://bulk.onestopsms.in/GatewayAPI/rest";
			//"loginid=onlinemarketing&password=313770&msg=$message&send_to=$mobilenumbers&senderId=WEZOOM&routeId=8&smsContentType=english"
			$url="https://api.bizzsms.in/api/v2/SendSMS?";
			$ch = curl_init(); 
			if (!$ch){die("Couldn't initialize a cURL handle");}
			$ret = curl_setopt($ch, CURLOPT_URL,$url);
			//curl_setopt ($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);          
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt ($ch, CURLOPT_POSTFIELDS,"SenderId=ROZIPY&Is_Unicode=false&Is_Flash=false&Message=$message&MobileNumbers=$mobilenumbers&ApiKey=70sLcArgjj5gnPKZ6G8te/ycrk+nrfElnnC5iWro6Nc=&ClientId=2122085a-abe2-43de-9569-99ceced7747d");
			$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		   
			$curlresponse = curl_exec($ch); // execute
	   
			///print $url="http://bulk.onestopsms.in/rest/services/sendSMS/sendGroupSms?AUTH_KEY=6181ddeefc5fa7d09c669a633b0f117&message=$message&senderId=wezoom&routeId=8&mobileNos=$mobilenumbers&smsContentType=english";
			//print_r($curlresponse);
		   if(curl_errno($ch))
			   echo 'curl error : '. curl_error($ch);
		   
			if (empty($ret)) {
			   // some kind of an error happened
			   die(curl_error($ch));
			   curl_close($ch); // close cURL handler
			} else {
			   $info = curl_getinfo($ch);
			   curl_close($ch); // close cURL handler
			   //echo "<br>";
			   return $curlresponse;    //echo "Message Sent Succesfully" ;
			 }
		
	   
		}	 
	   }
 
 
function protect_admin_page() {
	//return true;
	 $cur_dir = dirname($_SERVER['PHP_SELF']);
	if($cur_dir == SITE_SUB_PATH.'/admin') {
		$cur_page = basename($_SERVER['PHP_SELF']);
		 //echo "<br>cur_page: $cur_page";
		if($cur_page != 'login.php') {
			if ($_SESSION['sess_admin_login_id']=='') {
			#	header('Location: login.php');
			#	exit;
			}
		}
	}
}

function protect_admin_page2() {

	if ($_SESSION['sess_admin_login_id']=='') {
 		header('Location: login.php');
		exit;
	}
}

function protect_user_page() {

	if ($_SESSION['sess_uid']=='') {
 		/// $_SESSION['sess_back']=basename($_SERVER['PHP_SELF'])."?".$_SERVER['QUERY_STRING'];
 		$_SESSION['sess_back']='/userpanel/'.basename($_SERVER['PHP_SELF'])."?".$_SERVER['QUERY_STRING'];
		header('Location: login.php');
		exit;
	}
}


function get_sponsor_id($u_ref_userid,$u_ref_side){
  	while ($sb!='stop'){
		$u_id = db_scalar("select u_id from ngo_users  where  u_sponsor_id ='$u_ref_userid' and u_ref_side='$u_ref_side' limit 0,1");
		if ($u_id!='') { $u_ref_userid = $u_id; } else { $sb='stop';}
  } 
 return $u_ref_userid;
}


  
/// Sajax Funtion Start 

 
 
 

function get_user_details($name='user_details',$topup_username) {
	//check uesrname availability
	
 
	if ($topup_username!='') { $sql_part = " and u_username= '$topup_username' ";} else {$sql_part = " and u_id= '$_SESSION[sess_uid]' ";}
	$sql_you  = "select * from ngo_users where  u_username= '$topup_username' ";
	$result_you  = db_query($sql_you );
	$line_you   = mysqli_fetch_array($result_you );
  	//aassmapvt.com
	  if ($line_you['u_id']!='') {
		return '<span  style="color:#40BB82">'.$line_you['u_fname'].'</span>';
	} else {
		return '<span class="error">Username Does not exist!</span>';
	}
}

function get_referal_details($name='referal_details',$ref_userid) {
	//check uesrname availability
 	if ($ref_userid!='') { $sql_part = " and u_username= '$ref_userid' ";} else {$sql_part = " and u_id= '$_SESSION[sess_uid]' ";}
	$sql_you  = "select u_id, u_fname from ngo_users where 1 $sql_part ";
	$result_you  = db_query($sql_you);
	$line_you   = mysqli_fetch_array($result_you );
	 //return "OK" .$line_you[u_id];
	if ($line_you['u_id']!='') {
		return '<span  style="color:#40BB82">'.$line_you['u_fname'].'</span>';
	} else {
		return '<span class="error">Accounts Does not exist!</span>';
	}
  	
}

 

/*function sk start*/
 /// Sajax Funtion Start 
 
//($name='direct_downline_details',$userid)
function get_direct_downline_details($name ,$userid) {
	//check uesrname availability
	/// return $userid;
 	if ($userid!='') { $sql_part = " and u_id= '$userid' ";} else {$sql_part = " and u_id= '$_SESSION[sess_uid]' ";}
	$sql_you  = "select * from ngo_users where 1 $sql_part";
	$result_you  = db_query($sql_you );
	$line_you   = mysqli_fetch_array($result_you);
	
	
	$referer_id = db_scalar("select u_username from ngo_users where u_id='$line_you[u_ref_userid]'  ");
	$total_topup = db_scalar("select sum(topup_amount) from ngo_users_recharge where topup_userid='$line_you[u_id]' ");
 	
	$total_downline_business  = direct_total_business_date_range($userid , "")+0;
 	// Left-Right Recharge Business :	 
	#$total_recharge_left  = binary_total_business_date_range($left_side_id, " and topup_plan='RECHARGE'")+0;
	#$total_recharge_right = binary_total_business_date_range($right_side_id, " and topup_plan='RECHARGE'")+0 ;
	//aassmapvt.com
  
	$return_msg = '
	 
 	<table width="100%" border="1" cellspacing="1" cellpadding="1"   class="table table-nowrap" >
	<tr class="tdhead" >
	  <th width="20%" align="center" colspan="2"> <strong>'.$line_you['u_username'].' Account Details</strong></th>
		 
 	    </tr>
	  <tr class="tdOdd" >
	  <td width="20%" align="left"  > <strong>Name </strong></td>
		<td width="30%"  nowrap="nowrap"  align="left">:'.$line_you['u_fname'].'</td>
 	    </tr>
	  <tr  class="tdEven" >
	   <td width="20%" align="left"  ><strong>Username  </strong></td>
	    <td width="30%" align="left"  nowrap="nowrap">:'.$line_you['u_username'].'</td>	
	   </tr>
	  <tr  class="tdOdd" >
	  <td align="left"  nowrap="nowrap" > <strong>Date of join  </strong></td>
		<td align="left" >:'. date_format2($line_you['u_date']).'</td>
		 </tr>
	  <tr  class="tdEven" >
	  <td align="left" > <strong>Sponsor ID   </strong></td>
		<td align="left" >:'.$referer_id.'</td>
	 </tr>
 	  <tr  class="tdOdd" >
	  <td align="left"  ><strong> Self Topup </strong></td>
		<td align="left" >:'.  $total_topup .'  </td>
  		 </tr>
	  <tr  class="tdEven" ><td align="left"  nowrap="nowrap" ><strong>Downline Business:</strong></td>
	    <td align="left" nowrap="nowrap" >:'.price_format($total_downline_business).' </td>
	  </tr>
 	  </table>
	   ';
	 
	 
	 
	return $return_msg;
}




/*function sk end*/



function get_downline_details($name='downline_details',$userid) {
 	//check uesrname availability
 	
 	if ($userid!='') { $sql_part = " and u_id= '$userid' ";} else {$sql_part = " and u_id= '$_SESSION[sess_uid]' ";}
 	$sql_you  = "select * from ngo_users where 1 $sql_part";
 	$result_you  = db_query($sql_you );
 	$line_you   = mysqli_fetch_array($result_you );
 	//and topup_status='Paid'
 	#$direct_count = db_scalar("select count(*) from ngo_users where u_ref_userid='$line_you[u_id]' ");
  	$referer_id = db_scalar("select u_username from ngo_users where u_id='$line_you[u_ref_userid]' ");
 	$total_topup = db_scalar("select sum(topup_amount)  from ngo_users_recharge where topup_userid='$line_you[u_id]'  order by topup_id desc ");
 #	$topup_date = db_scalar("select topup_date from ngo_users_recharge where topup_userid='$line_you[u_id]' and topup_status='Paid' order by topup_id desc ");
 	$left_side_id = db_scalar("select u_id from ngo_users where u_sponsor_id='$line_you[u_id]' and u_ref_side='A'");
 	$right_side_id = db_scalar("select u_id from ngo_users where u_sponsor_id='$line_you[u_id]' and u_ref_side='B'");
 	$total_paid_left  = binary_total_business_date_range($left_side_id , "")+0;
 	$total_paid_right = binary_total_business_date_range($right_side_id , "")+0 ;
 
	$return_msg = '
<table width="100%" border="0"cellpadding="0" cellspacing="0"  style="background-color:#f2f2f2;color:#000000"  >
	  <tr class="tdOdd" > <td align="right" width="50%"><strong>User ID :</strong></td>
 <td align="left" width="50%" >'.$line_you['u_username'].' </td>

</tr>
  	    <tr class="tdEven" >
  	     <td align="right"  >Referal ID :  </td>
 	    <td align="left"  >'.$referer_id.' </td>
  	   </tr>
	   
	    <tr class="tdEven" >
  	     <td align="right"  > Direct Referal :</td>
 	    <td align="left"  > '.$direct_count.'</td>
  	   </tr><!--
  	    <tr class="tdEven" >
  		<td   align="right">Self Package : </td>
 		 <td align="left"  >'.price_format($total_topup).' </td>
 </tr>-->
  	    
    	  <tr  class="tdEven" >
 	  <td align="right">Business Left :</td>
 		<td align="left" > '.price_format($total_paid_left).' </td>
 </tr>
  	    <tr class="tdEven" >
   		<td align="right"  >Business Right :</td>
 	    <td align="left"  >'. price_format($total_paid_right).' </td>
 	  </tr>
 	  
  	  </table>
 	   ';
 
	return $return_msg;
 
}





/// Sajax Funtion Start 


function binary_total_paid_close($userid){
 	if ($userid!=''){
 	$id = array();
	$id[]=$userid;
 	while ($sb!='stop'){
	if ($referid=='') {$referid=$userid;}
	$sql_test = "select u_id  from ngo_users  where u_sponsor_id in ($referid) ";
	$result_test = db_query($sql_test);
	$count = mysqli_num_rows($result_test);
		if ($count>0) {
			//print "<br> $count = ".$ctr++;
			$refid = array();
			while ($line_test= mysqli_fetch_array($result_test)){
				$id[]=$line_test['u_id'];
				$refid[]=$line_test['u_id'];
			}
			 $refid = array_unique($refid); 
			 $referid = implode(",",$refid);
			 
		} else {
			$sb='stop';
		}
	 } 
	$id = array_unique($id); 
	$id_in = implode(",",$id); 
 	$total_business = db_scalar("select sum(topup_amount)  from ngo_users_recharge  where   topup_status!='Unpaid'  and topup_userid in ($id_in)  ")+0; 
	return $total_business;
}
}

function binary_total_ids($userid){
	if ($userid!=''){
 	$id = array();
	$id[]=$userid;
 	while ($sb!='stop'){
	$ctr++;
	//if ($ctr>=10) {$sb='stop';}
 	if ($referid=='') {$referid=$userid;}
	$sql_test = "select u_id  from ngo_users  where u_sponsor_id in ($referid) ";
	$result_test = db_query($sql_test);
	$count = mysqli_num_rows($result_test);
 		if ($count>0) {
			//print "<br> $count = ".$ctr++;
			$refid = array();
			while ($line_test= mysqli_fetch_array($result_test)){
				$id[]=$line_test['u_id'];
				$refid[]=$line_test['u_id'];
			}
			  $refid = array_unique($refid); 
			 $referid = implode(",",$refid);
		} else {
			$sb='stop';
		}
	 } 
	$id = array_unique($id); 
  	$id_in = implode(",",$id); 
 	$total_ids = db_scalar("select count(u_id)  from ngo_users  where  u_sponsor_id in ($id_in) ")+1; 
	return $total_ids;
 }
}


function binary_total_paid_ids($userid,$sql_part){
	if ($userid!=''){
 	$id = array();
	$id[]=$userid;
 	while ($sb!='stop'){
	$ctr++;
	//if ($ctr>=10) {$sb='stop';}
  	if ($referid=='') {$referid=$userid;}
	$sql_test = "select u_id  from ngo_users  where u_sponsor_id in ($referid) ";
	$result_test = db_query($sql_test);
	$count = mysqli_num_rows($result_test);
 		if ($count>0) {
			//print "<br> $count = ".$ctr++;
			$refid = array();
			while ($line_test= mysqli_fetch_array($result_test)){
				$id[]=$line_test['u_id'];
				$refid[]=$line_test['u_id'];
			}
			  $refid = array_unique($refid); 
			 $referid = implode(",",$refid);
		} else {
			$sb='stop';
		}
	 } 
	 $id = array_unique($id); 
  	$id_in = implode(",",$id); 
	//return "select count(*)   from ngo_users_recharge  where  topup_userid in ($id_in) $sql_part ";
	//$total_ids = db_scalar("select count(*) from ngo_users_recharge  where  topup_userid in ($id_in) $sql_part ");
  	$total_ids = db_scalar("select  count(*) from ngo_users_recharge  where  topup_userid in ($id_in)   $sql_part "); 
	return $total_ids;
}
}


function binary_total_business_date_range($userid ,$sql_part){
 	if ($userid!=''){
 	$id = array();
	$id[]=$userid;
 	while ($sb!='stop'){
	if ($referid=='') {$referid=$userid;}
	$sql_test = "select u_id  from ngo_users  where u_sponsor_id in ($referid) ";
	$result_test = db_query($sql_test);
	$count = mysqli_num_rows($result_test);
		if ($count>0) {
			//print "<br> $count = ".$ctr++;
			$refid = array();
			while ($line_test= mysqli_fetch_array($result_test)){
				$id[]=$line_test['u_id'];
				$refid[]=$line_test['u_id'];
			}
			 $refid = array_unique($refid); 
			 $referid = implode(",",$refid);
		} else {
			$sb='stop';
		}
	 } 
	 $id = array_unique($id); 
	$id_in = implode(",",$id); 
 	 #print  "<br> select sum(topup_amount)  from ngo_users_recharge  where  topup_userid in ($id_in) $sql_part ";
	$total_business = db_scalar("select sum(topup_amount)  from ngo_users_recharge  where  topup_userid in ($id_in) $sql_part ")+0; 
	return $total_business;
}
}

function binary_total_paid($userid){
 	if ($userid!=''){
 	$id = array();
	$id[]=$userid;
 	while ($sb!='stop'){
	if ($referid=='') {$referid=$userid;}
	$sql_test = "select u_id  from ngo_users  where u_sponsor_id in ($referid) ";
	$result_test = db_query($sql_test);
	$count = mysqli_num_rows($result_test);
		if ($count>0) {
			//print "<br> $count = ".$ctr++;
			$refid = array();
			while ($line_test= mysqli_fetch_array($result_test)){
				$id[]=$line_test['u_id'];
				$refid[]=$line_test['u_id'];
			}
			 $refid = array_unique($refid); 
			 $referid = implode(",",$refid);
			 
		} else {
			$sb='stop';
		}
	 } 
	$id = array_unique($id); 
	$id_in = implode(",",$id); 
 	$total_business = db_scalar("select sum(topup_amount)  from ngo_users_recharge  where topup_userid!='$userid' and  topup_userid in ($id_in) ")+0; 
	return $total_business;
}
}


function binary_total_date($userid,$datefrom,$dateto){
	if ($userid!=''){
 	$id = array();
	$id[]=$userid;
 	while ($sb!='stop'){
	if ($referid=='') {$referid=$userid;}
	$sql_test = "select u_id  from ngo_users  where    u_sponsor_id in ($referid) ";
	if ($datefrom!='' && $dateto!='') {  $sql_test .= " and u_date between '$datefrom' AND '$dateto' ";  }
 	$result_test = db_query($sql_test);
	$count = mysqli_num_rows($result_test);
		if ($count>0) {
			//print "<br> $count = ".$ctr++;
			$refid = array();
			while ($line_test= mysqli_fetch_array($result_test)){
				$id[]=$line_test['u_id'];
				$refid[]=$line_test['u_id'];
			}
			 $refid = array_unique($refid); 
			 $referid = implode(",",$refid);
		} else {
			$sb='stop';
		}
	 } 
	$id = array_unique($id); 
	$id_in = implode(",",$id); 
	//	 print "select count(u_id)  from ngo_users  where  u_sponsor_id in ($id_in) ";

 	$total_ids = db_scalar("select count(u_id)  from ngo_users  where u_status='Active' and  u_sponsor_id in ($id_in) ")+1; 
	return $total_ids;
}
}


function downline_ids($userid){
	if ($userid!=''){
 	$id = array();
	$id[]=$userid;
	
	while ($sb!='stop'){
	if ($referid=='') {$referid=$userid;}
	$sql_test = "select u_id  from ngo_users  where  u_ref_userid in ($referid)  ";
	$result_test = db_query($sql_test);
	$count = mysqli_num_rows($result_test);
		if ($count>0) {
			//print "<br> $count = ".$ctr++;
			$refid = array();
			while ($line_test= mysqli_fetch_array($result_test)){
				$id[]=$line_test['u_id'];
				$refid[]=$line_test['u_id'];
			}
			 $refid = array_unique($refid); 
			 $referid = implode(",",$refid);
		} else {
			$sb='stop';
		}
	 } 
	$id = array_unique($id); 
	$id_in = implode(",",$id); 
	return $id_in;
}
}
function downline_ids_count_sk($userid){
	if ($userid!=''){
 	$id = array();
	$id[]=$userid;
	
	while ($sb!='stop'){
	if ($referid=='') {$referid=$userid;}
	$sql_test = "select u_id  from ngo_users  where  u_ref_userid in ($referid)";
	$result_test = db_query($sql_test);
	$count = mysqli_num_rows($result_test);
		if ($count>0) {
			//print "<br> $count = ".$ctr++;
			$refid = array();
			while ($line_test= mysqli_fetch_array($result_test)){
				$id[]=$line_test['u_id'];
				$refid[]=$line_test['u_id'];
			}
			 $refid = array_unique($refid); 
			 $referid = implode(",",$refid);
		} else {
			$sb='stop';
		}
	 } 
	$id = array_unique($id); 
	$result = count($id);
	//$id_in = implode(",",$id); 
	
	return $result;
}
}
function coordinator_upling_ids($u_ref_userid){
  if ($u_ref_userid!='') {
 				while ($sb!='stop'){
					if ($u_ref_userid==0 || $u_ref_userid=='') {$sb='stop'; }
						$u_coordinator = db_scalar("select u_coordinator  from ngo_users  where  u_id ='$u_ref_userid'  ");
						//print " <br> $u_userid =$u_total_referer ,";
						if ($u_coordinator=='Yes') {
							$coordinator_id = $u_ref_userid;
							$sb='stop';
						} else {
							$u_ref_userid = db_scalar("select u_ref_userid  from ngo_users  where  u_id ='$u_ref_userid'  ");
						}
				} 
				
				
			 }
	return  $coordinator_id;
 
 }

function coordinator_ids($u_userid){
	 
	if ($u_userid!='') {
	$id = array();
 	while ($sb!='stop'){
	if ($referid=='') {$referid=$u_userid;}
	$sql_test = "select u_id ,u_coordinator from ngo_users  where  u_ref_userid in ($referid)  ";
	$result_test = db_query($sql_test);
	$count = mysqli_num_rows($result_test);
		if ($count>0) {
			// print "<br> $count = ".$ctr++;
			$refid = array();
			while ($line_test= mysqli_fetch_array($result_test)){
 				if ($line_test[u_coordinator]=='Yes') { 
					$id[]=$line_test['u_id'];
 				 }  else {
					$refid[]=$line_test['u_id'];
				 }
 			}
			 $refid = array_unique($refid); 
			 $referid = implode(",",$refid);
		} else {
			$sb='stop';
		}
	 } 
	$id = array_unique($id); 
	$coordinator_id_in = implode(",",$id);
 }  
	return  $coordinator_id_in;
	 
}


////////////////////////////////////////////
function str_stop($string, $max_length){
	if (strlen($string) > $max_length){
		$string = substr($string, 0, $max_length);
		$pos = strrpos($string, " ");
		if($pos === false) {
			  return substr($string, 0, $max_length)."...";
		  }
		return substr($string, 0, $pos)."...";
	}else{
		return $string;
	}
}


function date_month($date, $format) {
	if (strlen($date) >= 10) {
		if ($date == '0000-00-00 00:00:00' || $date	== '0000-00-00') {
			return '';
		}
		$mktime	= mktime(0,	0, 0, substr($date,	5, 2), substr($date, 8,	2),	substr($date, 0, 4));
		//return date("F", $mktime);
		return date($format, $mktime);
	} else {
		return $s;
	}
}
function cal_age($DOB) { 
 	    $birth = explode("-", $DOB); 
         $age = date("Y") - $birth[0]; 
         if(($birth[1] > date("m")) || ($birth[1] == date("m") && date("d") < $birth[2])) { 
                $age -= 1; 
        } 
        return $age; 
}
function payment_group_dropdown($selected,$extra) {
 	global $ARR_PAYMENT_GROUP;
	return array_dropdown($ARR_PAYMENT_GROUP,$selected,'pay_group',$extra);
}

function payment_processor_dropdown($selected,$extra) {
 	global $ARR_PAYMENT_PROCESSOR;
	return array_dropdown($ARR_PAYMENT_PROCESSOR,$selected,'pay_group',$extra);
}


function payment_status_dropdown($name,$sel_value){
	$arr = array('' => 'Please Select', 'New' => 'New', 'Paid' => 'Paid', 'Unpaid' => 'Unpaid', 'Failed' => 'Failed', 'Pending' => 'Pending');
	return array_dropdown($arr, $sel_value, $name);
}
function payment_mode_dropdown($name,$sel_value){
	$arr = array('' => 'Please Select', 'Cash' => 'Cash', 'Cheque' => 'Cheque', 'Other' => 'Other');
	return array_dropdown($arr, $sel_value, $name);
}
function total_ref_dropdown($name,$sel_value){
	$arr = array('' => 'Please Select', '3' => 'Referer 3', '5' => 'Referer 5', '11' => 'Referer 11', '25' => 'Referer 25', '0' => 'Referer 0');
	return array_dropdown($arr, $sel_value, $name);
}

function bank_dropdown($name,$sel_value){
	$arr = array('' => 'Please Select', "ICICI" => 'ICICI', 'BOI' => 'BOI','BOB'=>'BOB','HDFC'=>'HDFC','AXIS'=>'AXIS');
	return array_dropdown($arr, $sel_value, $name);
}

function bank_dropdown2($name,$sel_value){
	$arr = array('' => 'Please Select', "ICICI" => 'ICICI', 'BOI' => 'BOI','BOB'=>'BOB','HDFC'=>'HDFC','AXIS'=>'AXIS','SBI'=>'SBI');
	return array_dropdown($arr, $sel_value, $name);
}

function checkstatus_dropdown($name,$sel_value){
	$arr = array( '' => 'Please Select','Not Deliver' => 'Not Deliver', 'Deliver' => 'Deliver','Cancel'=>'Cancel','New Request'=>'New Request');
	return array_dropdown($arr, $sel_value, $name);
}
function checktype_dropdown($name,$sel_value){
	$arr = array( '' => 'Please Select','PDC' => 'PDC','DIRECT' => 'DIRECT','MATCHING' => 'MATCHING' ,'TRADE_PROFIT'=>'TRADE_PROFIT' ,'GENERAL' => 'GENERAL');
	return array_dropdown($arr, $sel_value, $name);
}

function deduction_dropdown($name,$sel_value,$extra){
	$ARR_DEUCTION = array( '' => 'Please Select','TDS'=>'TDS' );
	 
	return array_dropdown($ARR_DEUCTION,$sel_value,$name,$extra);
}

 

function gender_dropdown($selected,$extra) {
 	
	global $ARR_GENDER;
	return array_dropdown($ARR_GENDER,$selected,'u_gender',$extra);
}


function gender_dropdown_emp($selected,$extra) {
 	
	global $ARR_GENDER;
	return array_dropdown($ARR_GENDER,$selected,'adm_gender',$extra);
}

function religion_dropdown($name, $sel_value){
	$arr = array("" => 'Select Religion',  "Hinduism" => 'Hinduism', 'Christianity' => 'Christianity', 'Buddhism' => 'Buddhism', 'Sikhism' => 'Sikhism', 'Jainism' => 'Jainism', 'Islam' => 'Islam');
	return array_dropdown($arr, $sel_value, $name);
}
function  nationality_dropdown($name, $sel_value){
	$arr = array("" => 'Select Religion',  "Indian" => 'Indian', 'Foreigner' => 'Foreigner');
	return array_dropdown($arr, $sel_value, $name);
}

function marital_status_dropdown($name, $sel_value){
	$arr = array("" => 'Select Marital Status',  "Single" => 'Single', 'Married' => 'Married', 'Divorced' => 'Divorced', 'Widowed' => 'Widowed', 'Separated' => 'Separated', 'Engaged' => 'Engaged');
	return array_dropdown($arr, $sel_value, $name);
}

function us_state_dropdown($selected,$extra) {
 	global $arr_us_state;
	return array_dropdown($arr_us_state, $selected, 'u_state' , $extra);
}


	
function  payment_type_dropdown($sel_value,$name,$extra){
// 	( $arr, $sel_value='', $name='', $extra='', $choose_one='', $arr_skip= array())
	global $ARR_PAYMENT_TYPE;
	return array_dropdown($ARR_PAYMENT_TYPE, $sel_value, $name,$extra);
}
function traxrate_dropdown($name,$sel_value){
	$arr = array( "Exempted" => 'Exempted', '4' => '4%', '12.5' => '12.5%','1' => '1%');
	return array_dropdown($arr, $sel_value, $name);
}

function taxable_dropdown($name,$sel_value){
	$arr = array( "taxable" => 'Taxable', 'nontaxable' => 'Non Taxable');
	return array_dropdown($arr, $sel_value, $name);
}

function guardian_dropdown($name,$sel_value){
	$arr = array( "father" => 'Father', 'husband' => 'Husband', 'other' => 'Other');
	return array_dropdown($arr, $sel_value, $name);
}

function status_dropdown($name ,$sel_value ){
	$arr = array( "" => 'Please Select ','Banned' => 'Block ID\'s','Active' => 'Active', 'Inactive' => 'Inactive', 'Reject' => 'Rejected');
	return array_dropdown($arr, $sel_value, $name);
}


function service_status_dropdown($name ,$sel_value ){
	$arr = array( "" => 'Please Select ','Active' => 'Active', 'Inactive' => 'Inactive');
	return array_dropdown($arr, $sel_value, $name);
}

function yes_no_dropdown($name,$sel_value){
	$arr = array( ''=>'Please select','Yes' => 'Yes', 'No' => 'No');
	return array_dropdown($arr, $sel_value, $name);
}
function join_mode_dropdown($name,$sel_value,$extra){
	$arr = array(''=>'Please select', 'Direct' => 'Direct', 'Spill' => 'Spill');
	return array_dropdown($arr, $sel_value, $name,$extra);
}

function left_right_dropdown($name,$sel_value,$extra){
	$arr = array( ''=>'Please select','A' => 'Left', 'B' => 'Right');
	return array_dropdown($arr, $sel_value, $name,$extra);
}
function u_gender_dropdown($selected,$extra) {
  	
	$arr_gender = array( "male" => 'Male', 'female' => 'Female');
	return array_dropdown($arr_gender,$selected,'u_gender',$extra);
}
 						
function package_dropdown($sel_value,$extra){
	$sql ="select utype_id , utype_name from ngo_users_type where utype_status='Active'    order by utype_id";  
	return make_dropdown($sql, 'package', $sel_value,  'class="txtbox" alt="select"  style="width:200px;"','Please select');
 }

function week_dropdown($sel_value,$extra){
 	global $ARR_WEEK;
	return array_dropdown($ARR_WEEK, $sel_value, 'dia_day',$extra);
}

function weekday_dropdown($sel_value,$extra){
 	global $ARR_WEEK_DAYS;
	return array_dropdown($ARR_WEEK_DAYS, $sel_value, 'dia_week',$extra);
}


function cal_days($dateFrom,$dateto){
 	$dateFrom = date("d-m-Y H:i:s",strtotime($dateFrom));
	$dateTo = date("d-m-Y H:i:s", strtotime($dateto));
	$diffd = getDateDifference($dateFrom, $dateTo, 'd');
	$diffh = getDateDifference($dateFrom, $dateTo, 'h');
	$diffm = getDateDifference($dateFrom, $dateTo, 'm');
	$diffs = getDateDifference($dateFrom, $dateTo, 's');
	$diffa = getDateDifference($dateFrom, $dateTo, 'a');
 	return $diffd+0;
 } 
   
function cal_lastlogin($dateFrom){
#sb-- calculate login time in hrs and days   	
	#$dateFrom = "07-11-2006 06:00:00";
	$dateFrom = date("d-m-Y H:i:s",strtotime($dateFrom));
	$dateTo = date("d-m-Y H:i:s", strtotime('now'));
	$diffd = getDateDifference($dateFrom, $dateTo, 'd');
	$diffh = getDateDifference($dateFrom, $dateTo, 'h');
	$diffm = getDateDifference($dateFrom, $dateTo, 'm');
	$diffs = getDateDifference($dateFrom, $dateTo, 's');
	$diffa = getDateDifference($dateFrom, $dateTo, 'a');
	
	if ($diffd <=1) {
		if ($diffh<=1) { $logintext = 'Online Now';} 
		else { 	$logintext = 'Offline';}
	} else {
		$logintext = 'Offline';	 
	}
	return $logintext;
	/*
	echo 'Calculating difference between ' . $dateFrom . ' and ' . $dateTo . ' <br /><br />';
	echo $diffd . ' days.<br />';
	echo $diffh . ' hours.<br />';
	echo $diffm . ' minutes.<br />';
	echo $diffs . ' seconds.<br />';
	echo '<br />In other words, the difference is ' . $diffa['days'] . ' days, ' . $diffa['hours'] . ' hours, ' . $diffa['minutes'] . ' minutes and ' . $diffa['seconds'] . ' seconds.
	';
*/
}

function getDateDifference($dateFrom, $dateTo, $unit = 'd') {
	$difference = null;
	$dateFromElements = explode(' ', $dateFrom);
	$dateToElements = explode(' ', $dateTo);
	$dateFromDateElements = explode('-', $dateFromElements[0]);
	$dateFromTimeElements = explode(':', $dateFromElements[1]);
	$dateToDateElements = explode('-', $dateToElements[0]);
	$dateToTimeElements = explode(':', $dateToElements[1]);
	// Get unix timestamp for both dates
	$date1 = mktime($dateFromTimeElements[0], $dateFromTimeElements[1], $dateFromTimeElements[2], $dateFromDateElements[1], $dateFromDateElements[0], $dateFromDateElements[2]);
	$date2 = mktime($dateToTimeElements[0], $dateToTimeElements[1], $dateToTimeElements[2], $dateToDateElements[1], $dateToDateElements[0], $dateToDateElements[2]);
	if( $date1 > $date2 )
	{
		return null;
	}
	$diff = $date2 - $date1;
	$days = 0;
	$hours = 0;
	$minutes = 0;
	$seconds = 0;
	if ($diff % 86400 <= 0)  // there are 86,400 seconds in a day
	{
		$days = $diff / 86400;
	}
	if($diff % 86400 > 0)
	{
		$rest = ($diff % 86400);
		$days = ($diff - $rest) / 86400;
		if( $rest % 3600 > 0 )
		{
			$rest1 = ($rest % 3600);
			$hours = ($rest - $rest1) / 3600;
			if( $rest1 % 60 > 0 )
			{
				$rest2 = ($rest1 % 60);
				$minutes = ($rest1 - $rest2) / 60;
				$seconds = $rest2;
			}
			else
			{
				$minutes = $rest1 / 60;
			}
		}
		else
		{
		$hours = $rest / 3600;
		}
	}
	switch($unit)
	{
	case 'd':
	case 'D':
		$partialDays = 0;
		$partialDays += ($seconds / 86400);
		$partialDays += ($minutes / 1440);
		$partialDays += ($hours / 24);
		$difference = $days + $partialDays;
		break;
	case 'h':
	case 'H':
		$partialHours = 0;
		$partialHours += ($seconds / 3600);
		$partialHours += ($minutes / 60);
		$difference = $hours + ($days * 24) + $partialHours;
		break;
	case 'm':
	case 'M':
		$partialMinutes = 0;
		$partialMinutes += ($seconds / 60);
		$difference = $minutes + ($days * 1440) + ($hours * 60) + $partialMinutes;
		break;
	case 's':
	case 'S':
		$difference = $seconds + ($days * 86400) + ($hours * 3600) + ($minutes * 60);
		break;
	case 'a':
	case 'A':
	$difference = array (
	"days" => $days,
	"hours" => $hours,
	"minutes" => $minutes,
	"seconds" => $seconds
	);
	break;
	}
	return $difference;
}

function pacific_date2(){
	//Monday, November 06, 2006 
	$pst_date = gmdate("Y-m-d", mktime(date("H")-0, date("i"), date("s"), date("m"), date("d"), date("Y")));
	return $pst_date;
}
function pacific_time2(){
//10:44:39 PM 
	$pst_time = gmdate("H:i:s A", mktime(date("H")-12, date("i"), date("s"), date("m"), date("d"), date("Y")));
	return $pst_time;
}


function pacific_time(){
//10:44:39 PM 
	$pst_time = gmdate("H:i:s A", mktime(date("H")-8, date("i"), date("s"), date("m"), date("d"), date("Y")));
	return $pst_time;
}
 
function pacific_date(){
	//Monday, November 06, 2006 
	$pst_date = gmdate("l F m Y", mktime(date("H")-8, date("i"), date("s"), date("m"), date("d"), date("Y")));
	return $pst_date;
} 
 


function smile($content){
	//global $arr_smile;
	$sql_smile	= "select * from ngo_smilies";
	$res_sql_smile=db_query($sql_smile); 
	if(mysqli_num_rows($res_sql_smile)>0){
	 $arr_smile	=	array();
	 while($row_smile=mysqli_fetch_array($res_sql_smile)){
		@extract($row_smile);
	 	$arr_smile[$smile_url]	=	$code;		
	 }
	}
	if(is_array($arr_smile)){
		foreach($arr_smile as $key=>$value){
			if(strpos($content,$value)!=-1){
				$content	=	str_replace($value,'<img src="'.SITE_WS_PATH.'/images/smiles/'.$key.'" border=0>',$content);
			 }
		}
	}
	
	return $content;
}

function rating($table_name,$column_name,$id,$column_rating) {
  $sql_rating = "select avg($column_rating) from $table_name where $column_name='$id'";
  $result_rating=db_scalar($sql_rating);
 return ceil($result_rating);
}

function banner($page,$width,$count,$rand='rand')
 {
  if($rand){
  $query="select * from ngo_banner where banner_page = '$page' and  banner_start_date <= curdate() and banner_end_date >= curdate() and banner_status='Active' order by rand() limit $count";
 
  } else {
  $query="select * from ngo_banner where banner_page = '$page' and banner_start_date <= curdate() and banner_end_date >= curdate() and banner_status='Active' order by banner_id limit $count";
 
  }
//echo $query;

  $result=db_query($query);
  if($result){
	  while($res=mysqli_fetch_array($result))
	   { 
	  if($res['banner_name']){
			if($res['banner_link']){
			$str="<a href=".$res['banner_link']." target='_blank'><img src=".UP_FILES_WS_PATH.'/banner/'.$res['banner_name']." align='center' style='margin-right:5px;' class='border_image'/></a>";
	       } else {
	  		$str="<img src=".UP_FILES_WS_PATH.'/banner/'.$res['banner_name']." align='center' style='margin-right:5px;' class='border_image'/>";
	   		  }
   } else {
	    if($res['banner_link']){
	  	$str="<a href=".$res['banner_link']." target='_blank'>".$res['banner_text']."</a>";
        } else {
		$str=$res['banner_text'];
        }   
      }
	  $str2[]=$str;
	} 
   return $str2;
 }
}






function convert_number($number) 
{ 
    if (($number < 0) || ($number > 999999999)) 
    { 
    throw new Exception("Number is out of range");
    } 

    $Gn = floor($number / 000000);  /* Millions (giga) */ 
    $number -= $Gn * 000000; 
    $kn = floor($number / 1000);     /* Thousands (kilo) */ 
    $number -= $kn * 1000; 
    $Hn = floor($number / 100);      /* Hundreds (hecto) */ 
    $number -= $Hn * 100; 
    $Dn = floor($number / 10);       /* Tens (deca) */ 
    $n = $number % 10;               /* Ones */ 

    $res = ""; 

    if ($Gn) 
    { 
        $res .= convert_number($Gn) . " Million"; 
    } 

    if ($kn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($kn) . " Thousand"; 
    } 

    if ($Hn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($Hn) . " Hundred"; 
    } 

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
        "Nineteen"); 
    $tens = array("", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", 
        "Seventy", "Eigthy", "Ninety"); 

    if ($Dn || $n) 
    { 
        if (!empty($res)) 
        { 
            $res .= " and "; 
        } 

        if ($Dn < 2) 
        { 
            $res .= $ones[$Dn * 10 + $n]; 
        } 
        else 
        { 
            $res .= $tens[$Dn]; 

            if ($n) 
            { 
                $res .= "-" . $ones[$n]; 
            } 
        } 
    } 

    if (empty($res)) 
    { 
        $res = "zero"; 
    } 

    return $res; 
} 




/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name,$tables = '*')
{
	
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysqli_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table)
	{
		$result = mysqli_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysqli_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file
	$handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
}

function direct_total_business_date_range($userid ,$sql_part){
 	if ($userid!=''){
 	$id = array();
	$id[]=$userid;
 	while ($sb!='stop'){
	if ($referid=='') {$referid=$userid;}
	$sql_test = "select u_id  from ngo_users  where u_ref_userid in ($referid) ";
	$result_test = db_query($sql_test);
	$count = mysqli_num_rows($result_test);
		if ($count>0) {
			//print "<br> $count = ".$ctr++;
			$refid = array();
			while ($line_test= mysqli_fetch_array($result_test)){
				$id[]=$line_test['u_id'];
				$refid[]=$line_test['u_id'];
			}
			 $refid = array_unique($refid); 
			 $referid = implode(",",$refid);
		} else {
			$sb='stop';
		}
	 } 
	 $id = array_unique($id); 
	$id_in = implode(",",$id); 
 	 #print  "<br> select sum(topup_amount)  from ngo_users_recharge  where  topup_userid in ($id_in) $sql_part ";
	$total_business = db_scalar("select sum(topup_amount)  from ngo_users_recharge  where topup_status='Paid' and  topup_userid in ($id_in) $sql_part ")+0; 
	return $total_business;
}
}



function get_username_details($name='username_details',$username) {
	//check uesrname availability
	 
	if ($username!='') { $sql_part = " and u_username= '$username' ";} else {$sql_part = " and u_id= '$_SESSION[sess_uid]' ";}
	$sql_you  = "select u_id,u_fname from ngo_users where 1 $sql_part ";
	$result_you  = db_query($sql_you);
	$line_you   = mysqli_fetch_array($result_you );
	 //return "OK" .$line_you['u_id'];
	if ($line_you['u_id']!='') {
		return 'Username <span class="error">(Not Available)</span>';
	} else {
		return 'Username <span class="error">(Available)</span>';
	}
  	
}
function get_sponsor_details($name='sponsor_details',$ref_userid) {
	//check uesrname availability
	
	if ($ref_userid!='') { $sql_part = " and u_username= '$ref_userid' ";} else {$sql_part = " and u_id= '$_SESSION[sess_uid]' ";}
	$sql_you  = "select u_id ,u_fname from ngo_users where 1 $sql_part ";
	$result_you  = db_query($sql_you);
	$line_you   = mysqli_fetch_array($result_you );
	 //return "OK" .$line_you['u_id'];
	if ($line_you['u_id']!='') {
		return "<span class='error'>Referral  : $line_you[u_fname] </span>" ;
	} else {
		return '<span class="error">Wrong Referral Information</span>';
	}
  	
}



// url increation/decreaption 
function encryptor($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    
    $secret_key = 'Tech Area';
    $secret_iv = 'tech@12345678';
   
    $key = hash('sha256', $secret_key);    
   
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    
    if( $action == 'encrypt' ) 
    {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' )
    {
    	
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0,      $iv);
    }

    return $output;
}

 
?>