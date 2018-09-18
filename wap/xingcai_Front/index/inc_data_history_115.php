<div class="recentCon">
<dd>
<?php
$sql="select time, number, data from {$this->prename}data where type={$this->type} order by number desc,time desc limit {$args[0]}";
if($data=$this->getRows($sql)) foreach($data as $var){
if($this->type==6 || $this->type==7 || $this->type==15 || $this->type==16 || $this->type==67 || $this->type==68){ 
$splitD=explode(",",$var['data']);
?>
        <li class="" data="<?=$var['data']?>">
		<span class="issue_11"><?=$var['number']?>期</span>
		<span class="num_11"><?=$var['data']?></span>
		</li>
<?php 
$a=array(0=>$splitD[0],1=>$splitD[1],2=>$splitD[2],3=>$splitD[3],4=>$splitD[4]); 
//echo array_sum($a); 和值
?>

<?php } } ?>

</dd>	
</div>
 <script type="text/javascript">
 $(function(){
 $("dd").each(function(){
 $(this).children().first().css("color","red"); 
 });
 });
 </script>
