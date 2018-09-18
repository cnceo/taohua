<?php $this->display('inc_daohang.php'); ?>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>官方网站</title>
        <link rel="stylesheet" type="text/css" href="/css/nsc/home/reset.css?v=1.16.11.6" />
		<link rel="stylesheet" href="/css/nsc/dzyh.css?v=1.16.11.9" />
		<link rel="stylesheet" href="/css/nsc/huodong.css?v=1.16.11.6" />
        <script type="text/javascript" src="/js/nsc/jquery-1.7.min.js?v=1.16.11.6"></script>
        <script type="text/javascript" src="/js/nsc/base.js?v=1.16.11.6"></script>
        <script type="text/javascript" src="/js/nsc/jquery-1.7.min.js?v=1.16.11.6"></script>
			
        <script type="text/javascript" src="/js/nsc/dialogUI/jquery.dialogUI.js?v=1.16.11.6"></script>
        <script type="text/javascript" src="/js/nsc/main.js?v=1.16.11.6"></script>

        <link href="/css/nsc/plugin/dialogUI/dialogUI.css?v=1.16.11.6" media="all" type="text/css" rel="stylesheet" />
<script>
function indexdzyh(err, data){
	if(err){
		$.alert(err);
	}else{
		reloadMemberInfo();
		$.alert(data);
	}
}
function indexdzyhed(err, data){
	if(err){
		$.alert(err);
		$("#vcode").trigger("click");
	}else{
		window.parent.reloadMemberInfo();
		$.alert(data);
		reload();
	}
} 
function indexdzyhtked(err, data){
	if(err){
		$.alert(err);
		$("#vcode").trigger("click");
	}else{
		window.parent.reloadMemberInfo();
		$.alert(data);
		reload();
	}
}
</script>

        <div id="contentBox" class="activity_main">
            <div class="right_meun" id="siderbar">
                <div class="r_tit-bg"><h3 class="r_tit">热门活动</h3></div>
                <ul>
			        	
						<li >
			                <a href="/index.php/score/rotate">幸运大转盘</a>
			            </li>
						<li >
			                <a href="/index.php/score/zadan">幸运砸蛋</a>
			            </li>
						<li class="current">
			                <a href="/index.php/score/dodzyh">投资理财</a>
			            </li>
						<li >
			                <a href="/index.php/score/goods/current">积分兑换</a>
			            </li>
						<li >
			                <a href="/index.php/event/index">充值福利</a>
			            </li>
						<li >
			                <a href="/index.php/score/yongjin">新至尊佣金活动</a>
			            </li>
			            <li >
			                <a href="/index.php/score/chuangguan">至尊闯关活动</a>
			            </li>
			            <li >
			                <a href="/index.php/score/qiandao">签到有你</a>
			            </li>
			    </ul>
            </div>
            <div class="left_activity">

<div id="subContent_bet_re">
<div class="activity_content">
     <?php
			     $ckdate1=$this->dzyhsettings['ckdate1']*24;$cklv1=$this->dzyhsettings['cklv1'];
				 $ckdate2=$this->dzyhsettings['ckdate2']*24;$cklv2=$this->dzyhsettings['cklv2'];
				 $ckdate3=$this->dzyhsettings['ckdate3']*24;$cklv3=$this->dzyhsettings['cklv3'];
				 $ckdate4=$this->dzyhsettings['ckdate4']*24*30;$cklv4=$this->dzyhsettings['cklv4'];
				 $ckdate5=$this->dzyhsettings['ckdate5']*24*30*12;$cklv5=$this->dzyhsettings['cklv5'];

			     $cktime=array($ckdate1,$ckdate2,$ckdate3,$ckdate4,$ckdate5);sort($cktime);
				 $cklv=array($cklv1,$cklv2,$cklv3,$cklv4,$cklv5);sort($cklv);
                  
			     $sql="select ck_money,time from {$this->prename}dzyh_ck_swap where uid={$this->user['uid']} and isdelete=0 and state=0";
				 if($data=$this->getRow($sql)){$time=($this->time-$data['time'])/3600;}else{$time=0;$data['ck_money']=0;}
				 if($time<$this->dzyhsettings['ckzdsj']){
					 $lv=0;$lx=0;
				 }else if($time>$this->dzyhsettings['ckzdsj'] && $time>=$cktime[0] && $time<$cktime[1]){
					 $lv=$cklv[0];$lx=$data['ck_money']*$cklv[0]/100*$cktime[0]/24;
				 }else if($time>=$cktime[1] && $time<$cktime[2]){
					 $lv=$cklv[1];$lx=$data['ck_money']*$cklv[1]/100*$cktime[1]/24;
				 }else if($time>=$cktime[2] && $time<$cktime[3]){
					 $lv=$cklv[2];$lx=$data['ck_money']*$cklv[2]/100*$cktime[2]/24;
				 }else if($time>=$cktime[3] && $time<$cktime[4]){
					 $lv=$cklv[3];$lx=$data['ck_money']*$cklv[3]/100*$cktime[3]/24;
				 }else if($time>=$cktime[4]){
					 $lv=$cklv[4];$lx=$data['ck_money']*$cklv[4]/100*$cktime[4]/24;
				 }
			 ?>
    <div class="activity_banner" style="background:url(/images/nsc/activity/touzhi.jpg) no-repeat center top;"></div>
   <div class="activity_title">
    	
			<p class="countdown">当前投资存款为<span id="days"><?=$this->iff($data['ck_money'],$data['ck_money'],0)?></span>元 ，共存了
				&nbsp;<?php if($time<24){echo intval($time) ."&nbsp小时";}else if($time>=24 && $time<30*24){echo intval($time/24) ."&nbsp天";}else if($time>=30*24 && $time<30*24*12){echo intval($time/24/30) ."&nbsp月";}else if($time>=30*24*12){echo intval($time/30/24/12) ."&nbsp年";}?>，利率为：<?=$this->iff($lv,$lv,0)?>&nbsp;%，所得利息&nbsp;<?=$this->iff($lx,$lx,0)?>&nbsp;元</font></p>
			
			<a href="/index.php/score/dzyhck" target="modal" width="500px" height="300px" title="投资理财转入" modal="true" button="" class="check_btn_signIn">存款</a> 
			<a href="/index.php/score/dzyhtk" target="modal" width="500px" height="300px" title="投资理财转出" modal="true" button="" class="check_btn">提款</a>
    </div>
		 <div class="activity_nr">
        <h4 class="x-title">投资规则</h4>
        <div class="x-text"><div>
<div>
<div>1：存期按最少<?=$this->dzyhsettings['ckzdsj']?>小时计算，如果存款没有达到<?=$this->dzyhsettings['ckzdsj']?>小时就提款，那么只能取得本金，无利息。</div>
<div>2：存期<?=$this->dzyhsettings['ckdate1']?>日，日利息为为<?=$this->dzyhsettings['cklv1']?>%，例如，存款<?=$this->dzyhsettings['ckeg1']?>元，那么<?=$this->dzyhsettings['ckdate1']?>天后提出，可得到利息<?=$this->dzyhsettings['ckeg1']*$this->dzyhsettings['cklv1']/100?>*<?=$this->dzyhsettings['ckdate1']?>=<?=$this->dzyhsettings['ckeg1']*$this->dzyhsettings['cklv1']/100*$this->dzyhsettings['ckdate1']?>元。</div>
<div>3：存款<?=$this->dzyhsettings['ckdate2']?>日，日利息为<?=$this->dzyhsettings['cklv2']?>%，例如，存款<?=$this->dzyhsettings['ckeg2']?>元，那么<?=$this->dzyhsettings['ckdate2']?>天后提出，可得到利息<?=$this->dzyhsettings['ckeg2']*$this->dzyhsettings['cklv2']/100?>*<?=$this->dzyhsettings['ckdate2']?>=<?=$this->dzyhsettings['ckeg2']*$this->dzyhsettings['cklv2']/100*$this->dzyhsettings['ckdate2']?>元。</div>
<div>&nbsp;</div>
<div>4：存款<?=$this->dzyhsettings['ckdate3']?>日，日利息为<?=$this->dzyhsettings['cklv3']?>%，例如，存款<?=$this->dzyhsettings['ckeg3']?>元，那么<?=$this->dzyhsettings['ckdate3']?>天后提出，可得到利息<?=$this->dzyhsettings['ckeg3']*$this->dzyhsettings['cklv3']/100?>*<?=$this->dzyhsettings['ckdate3']?>=<?=$this->dzyhsettings['ckeg3']*$this->dzyhsettings['cklv3']/100*$this->dzyhsettings['ckdate3']?>元。</div>
<div> 5：存款<?=$this->dzyhsettings['ckdate4']?>个月（<?=$this->dzyhsettings['ckdate4']*30?>天），日利息为<?=$this->dzyhsettings['cklv4']?>%，例如，存款<?=$this->dzyhsettings['ckeg4']?>元，那么<?=$this->dzyhsettings['ckdate4']?>个月后提出，可得到利息<?=$this->dzyhsettings['ckeg4']*$this->dzyhsettings['cklv4']/100?>*<?=$this->dzyhsettings['ckdate4']*30?>=<?=$this->dzyhsettings['ckeg4']*$this->dzyhsettings['cklv4']/100*$this->dzyhsettings['ckdate4']*30?>元。</div>
<div> 6：存款<?=$this->dzyhsettings['ckdate5']?>年（<?=$this->dzyhsettings['ckdate5']*12*30?>天），日利息为<?=$this->dzyhsettings['cklv5']?>%，例如，存款<?=$this->dzyhsettings['ckeg5']?>元，那么<?=$this->dzyhsettings['ckdate5']?>年后提出，可得到利息<?=$this->dzyhsettings['ckeg5']*$this->dzyhsettings['cklv5']/100?>*<?=$this->dzyhsettings['ckdate5']*360?>=<?=$this->dzyhsettings['ckeg5']*$this->dzyhsettings['cklv5']/100*$this->dzyhsettings['ckdate5']*360?>元。</div>
</div>
</div></div>
        <h4 class="x-title">资金安全</h4>
<div class="x-text"><div>1、整个交易流程平台不触碰用户资金，交易资金完全由第三方支付机构监管；</div>
<div>2、存管银行依据专款专用原则，对每笔资金进出进行严格监控，确保用户账户资金安全；</div>
<div>3、因平台用户的交易账户被他人盗刷、盗用而导致的资金损失，由平台全额承保。</div></div>
    </div>
</div>
&#65279;</div>
</div></div>
	
	
	
<?php $this->display('inc_che.php'); ?>

</body>
</html>
