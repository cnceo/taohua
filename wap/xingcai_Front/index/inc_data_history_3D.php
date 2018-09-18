<div class="recentCon">
<dd>
<?php
$sql="select time, number, data from {$this->prename}data where type={$this->type} order by number desc,time desc limit {$args[0]}";
if($data=$this->getRows($sql)) foreach($data as $var){
if($this->type==9 || $this->type==10 || $this->type==69 || $this->type==70){ 
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
