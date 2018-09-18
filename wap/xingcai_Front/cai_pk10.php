<?php
    @session_start();
	
	$lastNo=$this->getGameLastNo(20);
	$kjHao=$this->getValue("select data from {$this->prename}data where type=20 and number='{$lastNo['actionNo']}'");
	if($kjHao) $kjHao=explode(',', $kjHao);
	$actionNo=$this->getGameNo(20);
	$types=$this->getTypes();
	$kjdTime=$types[20]['data_ftime'];
	$diffTime=strtotime($actionNo['actionTime'])-$this->time-$kjdTime;
	$kjDiffTime=strtotime($lastNo['actionTime'])-$this->time;
	$user=$this->user['username'];
	$sql="select type from {$this->prename}members where username='$user'";
	$data=$this->getRow($sql);
	$type=$data['type'];
?>  

<script type="text/javascript">
$(function(){
	//window.S=<?=json_encode($diffTime>0)?>;
	window.KS=<?=json_encode($kjDiffTime>0)?>;
	window.kjTime=parseInt(<?=json_encode($kjdTime)?>);
	
	if($.browser.msie){
	
		setTimeout(function(){
			gameKanJiangDataCpk(<?=$diffTime?>);
		}, 1000);
	}else{
		setTimeout(gameKanJiangDataCpk, 1000, <?=$diffTime?>);
	}
});
</script>


<span class="hour"></span><span id="pk-kanjiang" class="minute"></span><span class="second"></span>
