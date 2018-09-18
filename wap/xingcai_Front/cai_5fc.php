<?php
    @session_start();
	
	$lastNo=$this->getGameLastNo(1);
	$kjHao=$this->getValue("select data from {$this->prename}data where type=1 and number='{$lastNo['actionNo']}'");
	if($kjHao) $kjHao=explode(',', $kjHao);
	$actionNo=$this->getGameNo(14);
	//$types=$this->getTypes(5);
	//$kjdTime=$types[5]['data_ftime'];
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
			//gameKanJiangDataC(<?=$diffTime?>);
		}, 1000);
	}else{
		setTimeout(gameKanJiangDataC, 1000, <?=$diffTime?>);
	}
});
</script>


<span class="hour"></span><span id="pre-kanjiang" class="minute"></span><span class="second"></span>
<!--script>
setInterval(function() {
    $("#pre-kanjiang").load(location.href+" #pre-kanjiang>*","");
}, 10000);
</script-->