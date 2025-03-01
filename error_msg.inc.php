<?
@extract($_SESSION);
if(is_array($_SESSION['arr_error_msgs']) && count($_SESSION['arr_error_msgs'])>0) {?>

<!--<div class=" " style="color:#00ff49; text-shadow:#333333 1px 1px 1px; font-size:14px;"> -->
 <div class="col-xxl-12">
<? foreach($_SESSION['arr_error_msgs'] as $err_msg){?>
<div class="alert alert-danger" role="alert"> <?=$err_msg?> </div>  
<? }?>
 
 </div>


<? } $_SESSION['arr_error_msgs']='';  ?>

<?
//@extract($_SESSION);
if(is_array($_SESSION['arr_success_msgs']) && count($_SESSION['arr_success_msgs'])>0) {?>

<!--<div class=" " style="color:#00ff49; text-shadow:#333333 1px 1px 1px; font-size:14px;"> -->
 <div class="col-xxl-12">
<? foreach($_SESSION['arr_success_msgs'] as $err_msg2){?>
<div class="alert alert-success" role="alert"> <?=$err_msg2?> </div>  
<? }?>
 
 </div>


<? } $_SESSION['arr_success_msgs']='';  ?>