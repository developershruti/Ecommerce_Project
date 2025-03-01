<?
if($reccnt>$pagesize){
	
$num_pages=$reccnt/$pagesize;

 $PHP_SELF=$_SERVER['PHP_SELF'];
$qry_str=$_SERVER['argv'][0];

$m=$_GET;
unset($m['start']);

$qry_str=qry_str($m);

//echo "$qry_str : $p<br>";

//$j=abs($num_pages/10)-1;
$j=$start/$pagesize-5;
//echo("<br>$j");
if($j<0) {
	$j=0;
}
$k=$j+10;
if($k>$num_pages)	{
	$k=$num_pages;
}
$j=intval($j);
?>

<nav aria-label="Page navigation example " style="border:solid 1px #eee;">
 
  <ul class="pagination justify-content-center " style="margin-top:10px;">
    <!--<li class="page-item disabled"><a class="page-link" href="javascript: void(0);">Previous</a></li>-->
	<li class="page-item"><a class="page-link" href="<?=$PHP_SELF?><?=$qry_str?>&amp;start=0">First</a></li>
	
	
	 <?
		if($start!=0)
		{

?>
<li class="page-item"><a class="page-link" href="<?=$PHP_SELF?><?=$qry_str?>&amp;start=<?=$start-$pagesize?>" >&laquo;&nbsp;Previous&nbsp;<?=$pagesize?> </a> </li>
 <?
		}
?>


<?
			
			for($i=$j;$i<$k;$i++)
			{
				//if($i==$j)echo "Page:";
				
				if($i==$j);
			   if(($pagesize*($i))!=$start)
				  {
	  ?>
	  <li class="page-item"><a class="page-link" href="<?=$PHP_SELF?><?=$qry_str?>&amp;start=<?=$pagesize*($i)?>"><?=$i+1?></a></li>
      
      <?
				  }
	  else{
	  ?>
	  <li class="page-item active "><a class="page-link" href="javascript: void(0);"><?=$i+1?></a></li>
      
      <?
	  }
 }?>
 
 
 <?
	if($start+$pagesize < $reccnt){
		?>
		
		
     
		<li class="page-item"><a class="page-link" href="<?=$PHP_SELF?><?=$qry_str?>&amp;start=<?=$start+$pagesize?>">Next  <? //echo("$reccnt,$start,$pagesize");
	 if($start+($pagesize*2)>$reccnt){ echo($reccnt-($start+$pagesize));}else{echo($pagesize);}?> &raquo;</a></li>
 <?
		}
  ?>
  
  
  
  <? $mod=$reccnt%$pagesize; if($mod==0){$mod=$pagesize;}?>
  
   <li class="page-item"><a class="page-link" href="<?=$PHP_SELF?><?=$qry_str?>&amp;start=<?=$reccnt-$mod?>">Last</a></li>
    
	
	<? }
?>
	
	
	<?php /*?><li class="page-item active"><a class="page-link" href="javascript: void(0);">1</a></li>
    <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
    <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li><?php */?>
    
  </ul>
</nav>
 