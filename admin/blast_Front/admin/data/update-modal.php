<?php $para=$args[0]; 
if($para['type']==1){
	$actionNo=date('Ymd-', strtotime($para['actionTime'])).substr($para['actionNo']+1000,1);
	if($para['actionNo']==120) $actionNo=date('Ymd-', strtotime($para['actionTime'])-24*3600).substr($para['actionNo']+1000,1);
}else if($para['type']==12){//新疆时时彩
	$actionNo=date('Ymd-', strtotime($para['actionTime'])).substr($para['actionNo']+100,1);
}else if($para['type']==60){//天津时时彩
	$actionNo=date('17md', strtotime($para['actionTime'])).substr($para['actionNo']+1000,1);
}else if($para['type']==61 || $para['type']==62 || $para['type']==75 || $para['type']==76){//系统时时彩
	$actionNo=date('Ymd-', strtotime($para['actionTime'])).substr($para['actionNo']+1000,1);
	

}else if($para['type']==25){
	$actionNo=date('md', strtotime($para['actionTime'])).substr($para['actionNo']+100,1);
	
}else if($para['type']==5){//分分彩
	$actionNo=date('Ymd-', strtotime($para['actionTime'])).substr($para['actionNo']+10000,1);	
}else if($para['type']==14 || $para['type']==26){//2分彩 5分彩
	$actionNo=date('Ymd-', strtotime($para['actionTime'])).substr($para['actionNo']+1000,1);

}else if($para['type']==6){//广东11选5
	$actionNo=date('17md', strtotime($para['actionTime'])).substr($para['actionNo']+100,1);
}else if($para['type']==7){//山东11选5
	$actionNo=date('17md', strtotime($para['actionTime'])).substr($para['actionNo']+100,1);	
}else if($para['type']==15){//上海11选5
	$actionNo=date('17md', strtotime($para['actionTime'])).substr($para['actionNo']+100,1);	
}else if($para['type']==16){//江西11选5
	$actionNo=date('Ymd-', strtotime($para['actionTime'])).substr($para['actionNo']+100,1);
}else if($para['type']==67 || $para['type']==68){//系统11选5
	$actionNo=date('Ymd-', strtotime($para['actionTime'])).substr($para['actionNo']+1000,1);

}else if($para['type']==9 || $para['type']==10){// 福彩3D 排列3
	$actionNo=date('Yz', $this->time)-7;
	$actionNo=substr($actionNo,0,4).substr(substr($actionNo,4)+1000,1);

}else if($para['type']==79){//江苏快3
	$actionNo=date('Ymd', strtotime($para['actionTime'])).substr($para['actionNo']+100,1);
}else if($para['type']==63 || $para['type']==64){//系统快3
	$actionNo=date('Ymd-', strtotime($para['actionTime'])).substr($para['actionNo']+1000,1);
	
}else if($para['type']==20){//北京PK10
	$actionNo = 179*(strtotime(date('Y-m-d', strtotime($para['actionTime'])))-strtotime('2007-11-11'))/3600/24+$para['actionNo']-3773;
}else if($para['type']==66){//台湾PK10
	$actionNo = 288*(strtotime(date('Y-m-d', strtotime($para['actionTime'])))-strtotime('2007-11-11'))/3600/24+$para['actionNo']-4321;	
}else if($para['type']==65){//澳门PK10
	$actionNo = 288*(strtotime(date('Y-m-d', strtotime($para['actionTime'])))-strtotime('2007-11-11'))/3600/24+$para['actionNo']-6789;	
	
}else if($para['type']==78){//北京快乐8
	$actionNo = 179*(strtotime(date('Y-m-d', strtotime($para['actionTime'])))-strtotime('2004-09-19'))/3600/24+$para['actionNo']-3837;	
}else if($para['type']==73){//澳门快乐8
	$actionNo = 288*(strtotime(date('Y-m-d', strtotime($para['actionTime'])))-strtotime('2004-09-19'))/3600/24+$para['actionNo']-1234;	
}else if($para['type']==74){//韩国快乐8
	$actionNo = 288*(strtotime(date('Y-m-d', strtotime($para['actionTime'])))-strtotime('2004-09-19'))/3600/24+$para['actionNo']-4567;	
	
}else if($para['type']==71 || $para['type']==72){//系统快乐十分
	$actionNo=date('17md', strtotime($para['actionTime'])).substr($para['actionNo']+1000,1);
	
}else if($para['type']==77){//系统六合彩
	$actionNo=date('Ymd-', strtotime($para['actionTime'])).substr($para['actionNo']+1000,1);

}


$id=$this->getValue("select id from blast_data where number=? and type={$para['type']}",$actionNo);
?>
<div>
<input type="hidden" value="<?=$this->user['username']?>" />
<form action="/index.php/data/updatedataed" target="ajax" method="post" call="dataSubmitCode" onajax="dataBeforeSubmitCode" dataType="html">
	<input type="hidden" name="id" value="<?=$id?>"/>
	<table class="popupModal">
		<tr>
			<td class="title" width="180">期号：</td>
			<td><?=$actionNo?></td>
		</tr>
		<tr>
			<td class="title">开奖时间：</td>
			<td><?=$para['actionTime']?></td>
		</tr>
		<tr>
			<td class="title">开奖号码：</td>
			<td><input type="text" name="data"/></td>
		</tr>
		<tr>
			<td align="right"><span class="spn4">提示：</span></td>
			<td><span class="spn4">号码格式如: 1,2,3,4,5</span></td>
		</tr>
	</table>
</form>
</div>