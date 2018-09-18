<?php $para=$args[0]; 
if($para['type']==1){
	$actionNo=date('Ymd-', strtotime($para['actionTime'])).substr($para['actionNo']+1000,1);
	if($para['actionNo']==120) $actionNo=date('Ymd-', strtotime($para['actionTime'])-24*3600).substr($para['actionNo']+1000,1);
}else if($para['type']==3||$para['type']==7||$para['type']==14){
	$actionNo=date('Ymd-', strtotime($para['actionTime'])).substr($para['actionNo']+1000,1);
}else if($para['type']==11){
	$actionNo=date('Ymd-', strtotime($para['actionTime'])).substr($para['actionNo']+100,1);
}else if($para['type']==12){
	$actionNo=date('Ymd-', strtotime($para['actionTime'])).substr($para['actionNo']+100,1);
}else if($para['type']==5){
	$actionNo=date('Ymd-', strtotime($para['actionTime'])).substr($para['actionNo']+10000,1);
	
}else if($para['type']==76){//巴西1.5分彩
	$actionNo=date('Ymd-', strtotime($para['actionTime'])).substr($para['actionNo']+1000,1);

}else if($para['type']==71){//澳门幸运农场
	$actionNo=date('16md', strtotime($para['actionTime'])).substr($para['actionNo']+1000,1);
}else if($para['type']==72){//台湾幸运农场
	$actionNo=date('16md', strtotime($para['actionTime'])).substr($para['actionNo']+1000,1);
	
	
}else if($para['type']==25){//江苏快3
	$actionNo=date('md', strtotime($para['actionTime'])).substr($para['actionNo']+100,1);
	
}else if($para['type']==6){//广东11选5
	$actionNo=date('16md', strtotime($para['actionTime'])).substr($para['actionNo']+100,1);
	
}else if($para['type']==15){//上海11选5
	$actionNo=date('16md', strtotime($para['actionTime'])).substr($para['actionNo']+100,1);
		
}else if($para['type']==63 || $para['type']==64){//快3
	$actionNo=date('Ymd', strtotime($para['actionTime'])).substr($para['actionNo']+1000,1);	
	
}else if($para['type']==60){
	$actionNo=date('16md', strtotime($para['actionTime'])).substr($para['actionNo']+1000,1);	
	
}else if($para['type']==14 || $para['type']==26 || $para['type']==18 || $para['type']==17 || $para['type']==67 || $para['type']==68 || $para['type']==61 || $para['type']==62){
	$actionNo=date('Ymd-', strtotime($para['actionTime'])).substr($para['actionNo']+1000,1);

}else if($para['type']==16){//江西11选5
	$actionNo=date('Ymd-', strtotime($para['actionTime'])).substr($para['actionNo']+100,1);
	
}else if($para['type']==34){//六合彩
	$actionNo=substr(date('Y'),0,4).substr(1000+$para['actionNo'],1);
	
}else if($para['type']==20){//北京PK10
	$actionNo = 179*(strtotime(date('Y-m-d', strtotime($para['actionTime'])))-strtotime('2007-11-11'))/3600/24+$para['actionNo']-2520;
	
}else if($para['type']==65){ //澳门pk拾
	$actionNo = 288*(strtotime(date('Y-m-d', strtotime($para['actionTime'])))-strtotime('2007-11-11'))/3600/24+$para['actionNo']-6789;

}else if($para['type']==66){ //台湾pk拾
	$actionNo = 288*(strtotime(date('Y-m-d', strtotime($para['actionTime'])))-strtotime('2007-11-11'))/3600/24+$para['actionNo']-4321;

	
}else if($para['type']==78){//北京快乐8
	$actionNo = 179*(strtotime(date('Y-m-d', strtotime($para['actionTime'])))-strtotime('2004-09-19'))/3600/24+$para['actionNo']-2584;
	
}else if($para['type']==73){//澳门快乐8
	$actionNo = 288*(strtotime(date('Y-m-d', strtotime($para['actionTime'])))-strtotime('2004-09-19'))/3600/24+$para['actionNo']-1234;	

}else if($para['type']==74){//韩国快乐8
	$actionNo = 288*(strtotime(date('Y-m-d', strtotime($para['actionTime'])))-strtotime('2004-09-19'))/3600/24+$para['actionNo']-4567;





	
}
?>
<div>
<input type="hidden" value="<?=$this->user['username']?>" />
<form action="/index.php/data/added2" target="ajax" method="post" call="dataSubmitCode" onajax="dataBeforeSubmitCode" dataType="html">
	<input type="hidden" name="type" value="<?=$para['type']?>"/>
	<table class="popupModal">
		<tr>
			<td class="title" width="180">期号：</td>
			<td><input type="text" name="number" value="<?=$actionNo?>"/></td>
		</tr>
		<tr>
			<td class="title">开奖时间：</td>
			<td><input type="text" name="time" value="<?=$para['actionTime']?>"/></td>
		</tr>
		<tr>
			<td class="title">开奖号码：</td>
			<td><input type="text" name="data"/></td>
		</tr>
		<tr>
			<td align="right"><span class="spn4">提示：</span></td>
			<td><span class="spn4">请确认【期号】和【开奖号码】正确<br/>号码格式如: 1,2,3,4,5</span></td>
		</tr>
	</table>
</form>
</div>