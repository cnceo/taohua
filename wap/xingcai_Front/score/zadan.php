<?php $this->display('inc_daohang.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>官方网站</title>
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
    
	<head>
	
		<style>
			.noborder,img{border:0}body,dd,dl,dt,fieldset,form,h1,h2,h3,h4,h5,h6,input,legend,ol,p,select,td,textarea,th,ul{margin:0;padding:0}body{font:12px "Microsoft Yahei","Arial Narrow",HELVETICA;-webkit-text-size-adjust:100%}a{text-decoration:none}a:hover{color:#F59316;text-decoration:underline}em{font-style:normal}li{list-style:none}img{vertical-align:middle}table{border-collapse:collapse;border-spacing:0}p{word-wrap:break-word}.fl{float:left}.fr{float:right}.undis{display:none}.dis{display:block}.yello{color:#ffe400}.clearfix:after{visibility:hidden;display:block;font-size:0;content:" ";clear:both;height:0}.clearfix{zoom:1}
			.container{width:820px;margin:0;background:url(/images/nsc/activity/beijin.png) no-repeat;position:relative;}
			.container .act-title{position:absolute;left:0;top:0;text-align:center;width:100%;}
			.container .act-title h2{color:#fff;font-weight:normal;font-size:30px;line-height:85px;}
			.container .eggs-area{width:820px;height:330px;padding-top:130px;margin:0 auto;position:relative;}
			.container .eggs-area ul.eggs-con{width:548px;margin:0 auto;overflow:hidden;}
			.container .eggs-area ul.eggs-con li{width:274px;height:300px;float:left;background:url(/images/nsc/activity/eggs.png) center center no-repeat;cursor:pointer;}
			.container .eggs-area ul.eggs-con li span{display:block;width:178px;height:216px;margin:42px auto;}
			.container .eggs-area ul.track-eggs-type{width:548px;height:35px;color:#fff;font-size:20px;position:absolute;left:50%;bottom:15px;margin-left:-274px;}
			.container .eggs-area ul.track-eggs-type li{width:274px;float:left;text-align:center;}
			.container .eggs-area ul.track-eggs-type li span{display:block;width:160px;height:37px;line-height:37px;margin:0 auto;background:url(/images/nsc/activity/crack_eggs_icon.png) -168px -10px no-repeat;}
			.container .eggs-area .hammer{width:160px;height:140px;display:block;background:url(/images/nsc/activity/crack_eggs_icon.png) -13px -85px no-repeat;position:absolute;left:650px;top:125px;}
			.container .eggs-area .hammer-animation{animation:hammer-bounce linear 2s infinite;-webkit-animation:hammer-bounce linear 2s infinite;-moz-animation:hammer-bounce linear 2s infinite;cursor:pointer;}
			.container .eggs-area .hammer-animation1{animation:hammer-bounce1 linear 2s infinite;-webkit-animation:hammer-bounce1 linear 2s infinite;-moz-animation:hammer-bounce1 linear 2s infinite;cursor:pointer;}
			/*一个蛋的情况begin*/
			.single-egg .eggs-area ul.eggs-con{width:274px;}		
			.single-egg .eggs-area ul.track-eggs-type{width:274px;margin-left:-137px;}
			.single-egg .eggs-area .hammer{width:160px;height:140px;display:block;background:url(/images/nsc/activity/crack_eggs_icon.png) -13px -85px no-repeat;position:absolute;left:520px;top:125px;}
			.single-egg .eggs-area .hammer-animation{animation:hammer-bounce2 linear 2s infinite;-webkit-animation:hammer-bounce2 linear 2s infinite;-moz-animation:hammer-bounce2 linear 2s infinite;cursor:pointer;}
			/*一个蛋的情况end*/ 
			.container .prompts-area{height:250px;background:#e53030;margin:0 auto;color:#fff;}
			.container .prompts-area .crack-rules{width:450px;height:230px; margin:10px 10px 10px 0;float:left;overflow:auto;}
			.container .prompts-area .crack-rules::-webkit-scrollbar{width:8px;background:#ea5959;border-radius:5px;-webkit-border-radius:5px;-moz-border-radius:5px;}
			.container .prompts-area .crack-rules::-webkit-scrollbar-thumb{background:#ffbf0a;border-radius:5px;-webkit-border-radius:5px;-moz-border-radius:5px;}
			.container .prompts-area .crack-rules h2{font-size:24px;padding:15px 20px 10px;font-weight:normal;}
			.container .prompts-area .crack-rules p{padding:0 10px 0 20px;line-height:24px;font-size:14px;}
			.container .prompts-area .crack-awards{width:358px;float:left; height:250px;border-left:1px solid #ea5959;}
			.container .crack-awards .dynamit-awards{padding:22px 0 25px 97px; height:21px;border-bottom:1px solid #ea5959;font-size:16px;position:relative;}
			.container .crack-awards .dynamit-awards li span{margin-left:25px;}
			.container .crack-awards .dynamit-awards .awards-icon{display:block;width:63px;height:60px;background:url(/images/nsc/activity/crack_eggs_icon.png) -16px -15px no-repeat;position:absolute;top:-2px;left:20px;}
			.container .crack-awards dl{overflow:hidden;width:240px;margin:0 auto;}
			.container .crack-awards dt{font-size:24px;text-align:center;padding:10px 0;}
			.container .crack-awards dd{font-size:14px;line-height:24px;}
			.container .crack-awards dd span{margin-left:22px;}
			.container .prize-tip{position:fixed;width:900px;height:680px;top:0;left:50%;margin-left:-450px;z-index:900;display:none;}
			.container .prize-tip-mask{width:100%;height:100%;background:#000;opacity:0.5;filter:alpha(opacity=50);z-index:999;}
			.container .prize-tip .prize-tip-detail{width:644px;height:360px;background:url(/images/nsc/activity/eggs_prize_bg.jpg) no-repeat;position:absolute;top:50%;left:50%;margin:-180px 0 0 -322px;transform:scale(0);-webkit-transform:scale(0);-moz-transform:scale(0);transition:transform .5s;-webkit-transition:transform .5s;-moz-transition:transform .5s;}
			.container .prize-tip .prize-tip-detail.open{transform:scale(1);-webkit-transform:scale(1);-moz-transform:scale(1);}
			.container .prize-tip .prize-close{width:40px;height:40px;display:block;position:absolute;top:0;right:-38px;background:url(/images/nsc/activity/crack_eggs_icon.png) -111px -14px;cursor:pointer;}
			.container .prize-tip .prize-text{color:#fff;position:absolute;left:350px;top:120px;}
			.container .prize-tip .prize-text h2{font-size:30px;padding-bottom:15px;}
			.container .prize-tip .prize-text p{font-size:24px;}
			.container .prize-tip .prize-text b{color:#fbf6b8;margin-left:5px;font-size:26px;}
			/*1024及以下分辨率*/
			.container .prompts-area .crack-awards-zoom dl{width:240px;}
			@keyframes hammer-bounce{
				0,100%{
					top:90px;
					left:650px;
				}
				50%{
					top:85px;
					left:680px;
				}
			}
			@-webkit-keyframes hammer-bounce{
				0,100%{
					top:90px;
					left:650px;
				}
				50%{
					top:85px;
					left:680px;
				}
			}
			@-moz-keyframes hammer-bounce{
				0,100%{
					top:90px;
					left:650px;
				}
				50%{
					top:85px;
					left:680px;
				}
			}
			@keyframes hammer-bounce1{
				0,100%{
					top:90px;
					left:380px;
				}
				50%{
					top:85px;
					left:410px;
				}
			}
			@-webkit-keyframes hammer-bounce1{
				0,100%{
					top:90px;
					left:380px;
				}
				50%{
					top:85px;
					left:410px;
				}
			}
			@-moz-keyframes hammer-bounce1{
				0,100%{
					top:90px;
					left:380px;
				}
				50%{
					top:85px;
					left:410px;
				}
			}
			@keyframes hammer-bounce2{
				0,100%{
					top:125px;
					left:520px;
				}
				50%{
					top:100px;
					left:550px;
				}
			}
			@-webkit-keyframes hammer-bounce2{
				0,100%{
					top:125px;
					left:520px;
				}
				50%{
					top:100px;
					left:550px;
				}
			}
			@-moz-keyframes hammer-bounce2{
				0,100%{
					top:125px;
					left:520px;
				}
				50%{
					top:100px;
					left:550px;
				}
			}
		</style>
		
	</head>
	<body>
		<!--<div class="container ">-->
		<div class="container single-egg">
			<div class="act-title">
				<h2>幸运砸蛋活动</h2>
			</div>
			<div class="eggs-area">
				<ul class="eggs-con" >
					<li mode="2"><span mode="2"></span></li>
									</ul>
				<ul class="track-eggs-type">
					<li><span><a href="/index.php/score/dbqbed" dataType="json" call="indexdbqb" target="ajax" style="color:#FFF;">立即砸蛋</a></span></li>
									</ul>
				<span id="hammer" class="hammer hammer-animation"></span>
			</div>
			<div class="prompts-area">
				<div class="crack-rules">
					<h2>砸金蛋规则</h2>
					
<p class="MsoNormal" align="left"><span style="font-size: small;"><font face="微软雅黑, sans-serif">1, 每天<?=$this->dbqbsettings['allnum']?>个金蛋，砸完为止，每个用户一天只能砸一次。</font></span></p>
<p class="MsoNormal" align="left"><span style="font-size: small;"><font face="微软雅黑, sans-serif">2, 当天消费必须满元，否则无法参加活动！！</font></span></p>
<p class="MsoNormal" align="left"><span style="font-size: small;"><font face="微软雅黑, sans-serif">3, 参与活动的账户，帐户余额达到<?=$this->dbqbsettings['scoin']?>元以上(包含&nbsp<?=$this->dbqbsettings['scoin']?>&nbsp元)</font></span></p>

<p class="MsoNormal" align="left"><span style="font-size: small;"><font face="微软雅黑, sans-serif">注意事项：</font></span></p>
<p class="MsoNormal" align="left"><span style="font-size: small;"><font face="微软雅黑, sans-serif">3、每次当您投注量达到<?=$this->dbqbsettings['xcoin']?>元时，即可获得一次砸金蛋机会，最高奖金888元。</font></span></p>
<p class="MsoNormal" align="left"><span style="font-size: small;"><font face="微软雅黑, sans-serif">4、活动需要在当天（23:59之前）完成领取，隔天无效。</font></span></p>
<p class="MsoNormal" align="left"><span style="font-size: small;"><font face="微软雅黑, sans-serif">6、任何的无风险投注，对冲，对打均不计算有效投注。有效投注定义：玩法投注不得超过该玩法投注最大注数的70%，
即定位胆不得超过7注，二星不得超过70注，三星不得超过700注，四星不得超过7000注，五星不得超过70000注。如发现利用活动存在对冲等恶意套利行为，平台有权扣除违规所得。</font></span>
</p>
<p class="MsoNormal" align="left"><span style="font-size: small;"><font face="微软雅黑, sans-serif">7、平台保有修改活动以及解释活动之权利。</font></span></p>
<div> </div>					</p>
				</div>
				<div class="crack-awards">
					
					<div class="dynamit-awards">
                    							
                        						<em class="awards-icon"></em>
					</div>
					
					<dl>
						<dt>幸运榜</dt>
						<marquee direction="up" scrolldelay="50" scrollamount="1" height="110">
						<?php 
	$data=$this->getRows("select s.*,u.username from {$this->prename}dbqb_swap s, {$this->prename}members u where s.uid=u.uid order by s.swapTime desc");
	foreach($data as $var){?>
												<dd><?=preg_replace('/^(\w{2}).*(\w{2})$/','\1***\2',htmlspecialchars($var['username']))?><span style="float:right;">获得<?=$var['coin']?>元大奖</span></dd>
												
												<?}?>
												</marquee>
					</dl>
				</div>
			</div>
		</div></div></div></div></div></div>	
<?php $this->display('inc_che.php'); ?>

</body>
</html>
