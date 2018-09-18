<?php $this->display('inc_daohang.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>官方网站</title>
        <link rel="stylesheet" type="text/css" href="/css/nsc/home/reset.css?v=1.16.11.6" />

        <script type="text/javascript" src="/js/nsc/jquery-1.7.min.js?v=1.16.11.6"></script>
        <script type="text/javascript" src="/js/nsc/base.js?v=1.16.11.6"></script>
     
			<link rel="stylesheet" href="/css/nsc/huodong.css?v=1.16.11.6" />
        <script type="text/javascript" src="/js/nsc/dialogUI/jquery.dialogUI.js?v=1.16.11.6"></script>
        <script type="text/javascript" src="/js/nsc/main.js?v=1.16.11.6"></script>
        <link href="/css/nsc/plugin/dialogUI/dialogUI.css?v=1.16.11.6" media="all" type="text/css" rel="stylesheet" />
    </head>
<script>
	function getyj(){
		$.post("./getyj/",{},function(res){
				if(res=='o'){
					$.alert("您今天已经领取过了，请明天再来！");
				}else if(res=='g'){
					$.alert("您来晚了，活动已经结束啦！");
				}else if(res=='w'){
					$.alert("未到领取时间！");
				}else if(res=='y'){
					$.alert("领取成功！");
				}else if(res=='n'){
					$.alert("下级投注量没有达到要求！");
				}
		});	
	}
</script>
    <body>

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
						<li >
			                <a href="/index.php/score/dodzyh">投资理财</a>
			            </li>
						<li >
			                <a href="/index.php/score/goods/current">积分兑换</a>
			            </li>
						<li >
			                <a href="/index.php/event/index">充值福利</a>
			            </li>
						<li class="current">
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
<?php
	$rechargeTime=strtotime('00:00');
	$cashAmout=$this->getValue("select sum(mode*beiShu*actionNum) from {$this->prename}bets where actionTime>={$rechargeTime} and uid={$this->user['uid']} and isDelete=0");
?>
<div class="left_activity">
<div id="subContent_bet_re">
<div class="activity_content container">
    <div class="activity_banner"><img src="/images/nsc/activity/activity_banner01.jpg" /></div>
    <div class="activity_title">
    	<h2>至尊佣金大返利</h2>
			<p class="counyongjin">今日已消费<span id="days"><?=$this->iff($cashAmout,$cashAmout,0)?></span>元</p>
                    <a href="#" title="领取佣金" class="check_btn" onclick='getyj()'>领取佣金</a>
				
            </div>
    <div class="activity_nr">
        <h4 class="x-title">活动规则</h4>
        <div class="x-text"><div>
<div>
<div>平台隆重推出全新佣金返利系统, 前所未有的返利规则, 为平台所有代理用户带来全新福利!</div>
<div>只要您的团队中的下级在前一天的投注累计达到活动要求, 即可为您的上级累计可领取的福利, 达到要求的人数越多, 您能累计领取的福利也更多!</div>
<div> </div>
<?php  $ruleinfo=$this->dataa;
	for($i=0;$i<count($ruleinfo);$i++){
		$arr=$ruleinfo[$i];
		echo "<div>下级投注量达到$arr[endtime]元，上级可领取$arr[lvone]元，上上级可领取$arr[lvtwo]元，上上上级可领取$arr[lvtress]元，上上上上级可领取$arr[lvfour]元。</div>";
	}
	$open=$this->dataaa[0];
	echo "<div>领取时间为每天$open[startime]:00:00点后</div>";
?>
<!--结束时间$open[endtime]-->
</div>
</div></div>
        <h4 class="x-title">注意事项</h4>
        <div class="x-text"><div>1、活动结算时间为每天 00:00:00 至 23:59:59，每日代理需要自行领取前一日下级累计投注到的返利总额，逾期不候。</div>
<div>2、任何的对冲等刷量行为不计入有效投注，平台保留取消、收回赠送礼金的权利。</div>
<div>3、平台保留对此次活动作出更改、终止权利，并享有最终解释权。</div></div>
    </div>
</div>
﻿</div>
<div style="clear: both"></div>
<script type="text/javascript" src="/js/nsc/soundBox.js?v=1.16.11.6"></script>
<script type="text/javascript" src="/js/nsc/base.js?v=1.16.11.6"></script>
﻿</div>﻿</div>﻿</div>﻿</div>﻿</div>
<?php $this->display('inc_che.php'); ?>

</body>
</html>
