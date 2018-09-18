<?php $this->display('inc_daohang.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>官方网站</title>
        <link rel="stylesheet" type="text/css" href="/css/nsc/home/reset.css?v=1.16.11.6" />
<link href="/skin/css/dzp.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="/js/nsc/jquery-1.7.min.js?v=1.16.11.6"></script>
        <script type="text/javascript" src="/js/nsc/base.js?v=1.16.11.6"></script>
        <script type="text/javascript" src="/js/nsc/jquery-1.7.min.js?v=1.16.11.6"></script>
			<link rel="stylesheet" href="/css/nsc/huodong.css?v=1.16.11.6" />
        <script type="text/javascript" src="/js/nsc/dialogUI/jquery.dialogUI.js?v=1.16.11.6"></script>
        <script type="text/javascript" src="/js/nsc/main.js?v=1.16.11.6"></script>

        <link href="/css/nsc/plugin/dialogUI/dialogUI.css?v=1.16.11.6" media="all" type="text/css" rel="stylesheet" />
		<script>
function indexdbqb(err, data){
	if(err){
		$.alert(err);
	}else{
		reloadMemberInfo();
		$.alert(data);
	}
} 
</script>
    </head>
    <body>

        <div id="contentBox" class="activity_main">
            <div class="right_meun" id="siderbar">
                <div class="r_tit-bg"><h3 class="r_tit">热门活动</h3></div>
                <ul>
			        	<li >
			                <a href="/index.php/score/rotate">幸运大转盘</a>
			            </li>
						<li class="current">
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

    <div class="activity_banner" style="background:url(/images/nsc/activity/activity_banner02.jpg) no-repeat center top;"></div>
    <div class="activity_title">
    	<h2>幸运砸蛋</h2>
        		
		    </div>

			
			
			
			
	<div class="content3 wjcont">
 <div class="body">
    <!--main content start-->

<script type="text/javascript">
$(function(){ 
	$('#lottery_list_container_1').vTicker({
		speed:1000, 
		pause:0,
		showItems:8,
		animation:'fade',
		mousePause:true,
		height:300,
		direction:'up' 
    });
});
</script>
</head>
<body onbeforeunload="checkLeave()">
<div class="nxgkt2" id="nxgkt2">
<div class="nxgK">
<div class="xiugaiK" id="contect0">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ct2">
<tbody>


<tr>
<td align="right"><strong style="font-size:15px">活动内容说明:</strong></td>
<td style="color:green;padding-left:10px;">
1, 每天一次抢宝活动，开启<font color="red">&nbsp<?=$this->dbqbsettings['allnum']?>&nbsp</font>个宝箱,抢完为止。<br>
2, <font color="blue">今日消费</font> 必须满<font color="red">&nbsp<?=$this->dbqbsettings['xcoin']?>&nbsp</font>元，否则无法参加！！<br>
3, 参与活动的账户， <font color="blue">帐户余额</font> 达到<font color="red">&nbsp<?=$this->dbqbsettings['scoin']?>&nbsp</font>元以上(包含&nbsp<?=$this->dbqbsettings['scoin']?>&nbsp元)，方可参加。<br>
4, 抢宝时间：<font color="red"><?=$this->dbqbsettings['FromTime']?>-<?=$this->dbqbsettings['ToTime']?></font>。<br>
5, 通过下方<font color="#0086A8">【点我开抢】</font>，自助抢宝。<br>
6, 每个IP，只允许一个帐户参加每场活动。<br>
7, 平台将对本次活动全程监控，活动禁止违规操作，如有发现，一律严惩！<br>
</td></tr><tr></tr><tr><td class="info" style="" colspan="2" align="center"><img alt="" src="/images/dbqb.jpg" width="780" height="168"></td>
</tr>
<tr><td style="padding-left:10px;" colspan="2" align="center">
<div style="background:url(/images/subbtn.gif) no-repeat;background-position:center;"><a href="/index.php/score/dbqbed" dataType="json" call="indexdbqb" target="ajax" style="color:#FFF;">点我开抢</a></div></td></tr>
<td align="right">
<strong style="font-size:15px">最近夺宝排行:</strong></td>
<td style="font-size:12px;line-height:25px;">
<div style="overflow: hidden; position: relative;" id="lottery_list_container_1">
<ul id="lottery_list_container" style="margin-left:20px">
<?php 
	$data=$this->getRows("select s.*,u.username from {$this->prename}dbqb_swap s, {$this->prename}members u where s.uid=u.uid order by s.swapTime desc");
	foreach($data as $var){?>
        <li style='color:#000'>恭喜 【<span class="c1"><?=preg_replace('/^(\w{2}).*(\w{2})$/','\1***\2',htmlspecialchars($var['username']))?></span>】，喜夺 <span style='color:red;'><?=$var['coin']?>元</span> 的宝箱!</li>
<?}?>
</ul>
</div>
</td>
</tr>
</tbody>
</table>
</div></div></div>
<div id="wanjinDialog"></div>

<script type="text/javascript" src="/skin/js/jQueryRotate.2.2.js"></script>
<script type="text/javascript" src="/skin/js/jquery.easing.min.js"></script>
<script type="text/javascript" src="/skin/js/jquery.vticker.js"></script>
<script type="text/javascript">
$(function(){ 
     $("#startbtn").live("click",function(){ 
	    var title=$(this).attr("tit");
		if(confirm(title)){ 
			lottery(); 
		}
    }); 
	$('#lottery_list_container_1').vTicker({
		speed:1000, 
		pause:0,
		showItems:8,
		animation:'fade',
		mousePause:true,
		height:330,
		direction:'up' 
    });
}); 
function lottery(){ 
    $.ajax({ 
        type: 'POST', 
        url: '/index.php/score/rotateEvent', 
        dataType: 'json', 
        cache: false, 
        error: function(){ 
            alert('出错了！'); 
        }, 
        success:function(json){
			$('.scoreinfo').load('/index.php/score/scoreInfo');
            $("#startbtn").unbind('click').css("cursor","default");
            var a = json.angle; //角度
            var p = json.prize; //奖项 
			if(parseInt(a)==0){
				alert(p);
			}else{
            $("#startbtn").rotate({ 
                duration:3000, //转动时间 
                angle: 0, 
                animateTo:1800+a, //转动角度 
                easing: $.easing.easeOutSine, 
                callback: function(){ 
					if(p=='谢谢参与' || p=='再接再厉'){
						alert(p+'！'); 
					}else if(p=='再来一次'){
						if(confirm('再来一次！')){ 
							lottery(); 
						}else{ 
							//return false; 
						} 
					}else{
						alert('恭喜你，中得'+p+'！'); 
						parent.reloadMemberInfo();
					}
                } 
            });
		   }
        } 
    });
} 
</script>			
			
			
			
</div>
﻿</div>
﻿</div>
<div style="clear: both"></div>
<script type="text/javascript" src="/js/nsc/soundBox.js?v=1.16.11.6"></script>
<script type="text/javascript" src="/js/nsc/base.js?v=1.16.11.6"></script>
﻿</div>﻿</div>﻿</div>﻿</div>﻿</div>
<?php $this->display('inc_che.php'); ?>

</body>
</html>
