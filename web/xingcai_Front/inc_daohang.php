<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $this->display('inc_skin.php'); ?>
<meta name="keywords" content="" />
<meta nam ="description" content="" />
<meta name="renderer" content="webkit">
<link rel="stylesheet" href="/css/nsc/home/reset.css?v=1.16.11.5">
<link rel="stylesheet" href="/css/nsc/home/theme.css?v=1.16.11.5">
<link href="/css/nsc/plugin/dialogUI/dialogUI.css?v=1.16.11.5" media="all" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/js/nsc/dialogUI/jquery.dialogUI.js?v=1.16.11.5"></script>

</head>
    <body>
        <div class="header">
    <div class="top">
        <div class="content">
            <div class="fl logo">
                <a href="/index.php" title="返回首页">
                    <img src="/images/nsc/logo.png?v=1.16.11.5" />
                </a>
            </div>
            <div class="fr t_menu">
                <div class="ftop user_info">
                欢迎您，
                <span class="username" title=""><?=$this->user['nickname']?></span>
                <a href="/index.php/box/receive" class="ui_message">
                    <i class="ic-message"></i>
                    <span class="ui_msgnum">(<?php $this->display('index/inc_msg.php');?>)</span>
                </a>
                预留信息：
                <span class="ui_yuliu"><?=$this->user['care']?>
                    </span>
                    <a class="edit" href="/index.php/user/nickname">
                </a>
                <a href="javascript:loginout()" class="logout ui_logout">
                    退出
                </a>
            </div>
            <div class="fbottom">
                <div class="money-left">
                    <span>余额：</span>
                    <span class="t_money rounded" title="可用余额：<?=$this->user['coin']?>">
                        <div class="show-money">￥<span id="refff"><?=$this->user['coin']?></span></div>
                        <div class="hide-money">￥<span><b>************</b></span></div>
                    </span>
                </div>
                <a href="javascript:void(0);" class="shuaxin" id="refreshmoney" title="刷新余额">
                    <i class="ic-refresh"></i>
                </a>
                <a href="javascript:;" title="隐藏余额">
                    <i class="ic-unlook"></i>
                </a>
                <a href="javascript:void(0);" onclick="czpay();" class="t_btn">充值</a>
                <a href="javascript:void(0);" onclick="topay();" class="t_btn">提款</a>
                <a href="javascript:void(0)" onclick="zxkf();" title="在线客服" class="t_kefu">
                    <i class="ic-kefu"></i><span>客服</span></a>
                <a href="javascript:void(0)" title="更换背景" class="t_skin"><i class="ic-skin"></i><span>背景</span></a>
            </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="navbar navChoose">
        <div class="content">
            <div class="nav navList">
                <ul>
                    <li><a href="/index.php"><i class="i_icon-home"></i><b>首页</b><sup>Home</sup></a></li>
                    <li>
                        <a href="javascript:void(0);"><i class="i_icon-cpyx"></i><b>彩票游戏</b><sup>Lottery</sup></a>
                        <div class="nav_child">
                            <dl>
                                <dt>高频彩</dt>
                                 <dd><a data="L-1" href="/index.php/index/game/1/2/12/重庆时时彩">重庆时时彩<span class="hot"></span></a></dd>
                                <dd><a data="L-6" href="/index.php/index/game/12/2/12/新疆时时彩">新疆时时彩</a></dd>
                                <dd><a data="L-13" href="/index.php/index/game/60/2/12/天津时时彩">天津时时彩</a></dd>
								<dd><a data="L-24" href="/index.php/index/game/20/27/北京PK拾">北京PK拾<span class="new"></span></a></dd>
								<!--<dd><a data="L-13" href="/index.php/index/game/61/59/193/澳门时时彩">澳门时时彩<span class="hot"></span></a></dd>-->
								<!--<dd><a data="L-13" href="/index.php/index/game/62/59/193/台湾时时彩">台湾时时彩<span class="hot"></span></a></dd>-->
								<!--<dd><a data="L-14" href="/index.php/index/game/14/59/193/河内5分彩">河内5分彩</span></a></dd>-->
								<!--<dd><a data="L-19" href="/index.php/index/game/26/59/193/河内2分彩">河内2分彩</a></dd>-->
                               <!-- <dd><a data="L-19" href="/index.php/index/game/5/59/193/河内1分彩">河内1分彩</a></dd>-->
								<!--<dd><a data="L-19" href="/index.php/index/game/75/59/193/巴西快乐彩">巴西快乐彩</a></dd>-->
                                <dd><a data="L-25" href="/index.php/index/game/80/59/193/腾讯分分彩">腾讯分分彩<span style="margin-left: 10px;" class="new"></span></a></dd>
								<!--<dd><a data="L-19" href="/index.php/index/game/69/澳门3D">澳门3D</a></dd>-->
								<!--<dd><a data="L-19" href="/index.php/index/game/70/台湾3D">台湾3D</a></dd>-->
								<!--<dd><a data="L-13" href="/index.php/index/game/77/高速六合彩">高速六合彩<span class="hot"></span></a></dd>-->
                            </dl>
							<!--<dl>
                                <dt >快乐八&PK拾</dt>
                                <dd><a data="L-9" href="/index.php/index/game/78/北京快乐8">北京快乐8</a></dd>
								<dd><a data="L-9" href="/index.php/index/game/73/澳门快乐8">澳门快乐8</a></dd>
								<dd><a data="L-9" href="/index.php/index/game/74/韩国快乐8">韩国快乐8</a></dd>
								<dd><a data="L-24" href="/index.php/index/game/20/27/北京PK拾">北京PK拾<span class="new"></span></a></dd>
								<dd><a data="L-23" href="/index.php/index/game/66/27/台湾PK拾">台湾PK拾<span class="new"></span></a></dd>
								<dd><a data="L-23" href="/index.php/index/game/65/27/澳门PK拾">澳门PK拾<span class="new"></span></a></dd>
                            </dl>-->
							<!--<dl>
                                <dt>乐透彩</dt>
                                <dd><a data="L-8" href="/index.php/index/game/15/上海11选5">上海11选5</a></dd>
                                <dd><a data="L-8" href="/index.php/index/game/6/广东11选5">广东11选5</a></dd>
                                <dd><a data="L-7" href="/index.php/index/game/16/江西11选5">江西11选5</a></dd>
                                <dd><a data="L-5" href="/index.php/index/game/7/山东11选5">山东11选5</a></dd>
								<dd><a data="L-5" href="/index.php/index/game/67/澳门11选5">澳门11选5</a></dd>
								<dd><a data="L-5" href="/index.php/index/game/68/台湾11选5">台湾11选5</a></dd>
                            </dl>-->
							<!--<dl>
                                <dt>低频彩</dt>
                                <dd><a data="L-11" href="/index.php/index/game/9/3D福彩">3D福彩</a></dd>
                                <dd><a data="L-12" href="/index.php/index/game/10/排列3">排列3</a></dd>
								<dd><a data="L-20" href="/index.php/index/game/34/香港六合彩">香港六合彩</a></dd>
                            </dl>-->
                            <!--<dl>
                                <dt>快三&幸运农场</dt>
                                <dd><a data="L-15" href="/index.php/index/game/79/江苏快三">江苏快三</a></dd>
                                <dd><a data="L-11" href="/index.php/index/game/63/澳门快三">澳门快三</a></dd>
                                <dd><a data="L-12" href="/index.php/index/game/64/台湾快三">台湾快三</a></dd>
								<dd><a data="L-12" href="/index.php/index/game/71/澳门幸运农场">澳门幸运农场</a></dd>
								<dd><a data="L-12" href="/index.php/index/game/72/台湾幸运农场">台湾幸运农场</a></dd>
                            </dl>-->
                        </div>
                    </li>
                  
                   <li>
                        <a href="javascript:;" class="v-NoDagin"><i class="i_icon-dzyx"></i><b>电子游艺</b><sup>Games</sup></a>
                    </li>
                   <li>
                        <a href="/index.php/lottery/hemai"><i class="i_icon-tyjj"></i><em class="i_icon-new"></em><b>合买中心</b><sup>Sports</sup></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><i class="i_icon-account"></i><b>账户管理</b><sup>Account</sup></a>
                        <div class="nav_child nav_child2">
                            <p><a href="/index.php/record/search" icon="yxbb">投注记录</a></p>
                            <p><a href="/index.php/report/coin" data="T-bdkh" icon="bdkh">帐变记录</a></p>
                            <p><a href="/index.php/report/count" data="T-czxx" icon="czxx">盈亏报表</a></p>
							<p><a href="/index.php/safe/passwd" data="T-mmaq" icon="mmaq">密码安全</a></p>
							<p><a href="/index.php/safe/info" data="T-bdkh" icon="bdkh">绑定卡号</a></p>
                        </div>
                    </li>
					<?php if($this->user['type']){?>
                    <li>
                        <a href="javascript:void(0);"><i class="i_icon-group"></i><b>团队管理</b><sup>Team</sup></a>
                        <div class="nav_child nav_child2">
                            <p><a href="/index.php/team/memberList" data="T-tdbb" icon="tdbb">会员列表</a></p>
							<p><a href="/index.php/team/gameRecord" data="T-zcgl" icon="zcgl">团队记录</a></p>
							<p><a href="/index.php/team/coin" data="T-bdkh" icon="bdkh">团队帐变</a></p>
                            <p><a href="/index.php/team/report" data="T-yhlb" icon="yhlb">团队盈亏</a></p>
                            <p><a href="/index.php/team/addlink" data="T-tgsd" icon="tgsd">推广设定</a></p>
                        </div>
                    </li>
					<?}?>
                    <li>
                        <a href="javascript:void(0);"><i class="i_icon-activities"></i><b>优惠活动</b><sup>Discount</sup></a>
                        <div class="nav_child nav_child2">
                            <p><a href="/index.php/score/rotate">热门活动</a></p>
							<p><a href="/index.php/cash/card">点卡充值</a></p>
                            <p><a class="notice" href="javascript:void(0)" url="/index.php/notice/info">系统公告</a></p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="fr"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div id="v-dalog" class="v-dalog">
	<div class="v-bg"></div>
	<span class="v-cn">近期开放，敬请期待
	</span>
</div>

<script type="text/javascript">
$(document).ready(function(){
    //没有开放导航弹窗提示
    var NoDagin = true;
    $(".v-NoDagin").click(function(){
   		if(NoDagin){
	    	NoDagin = false;
	    	$("#v-dalog").fadeIn(200,function(){
	    	}).delay(2000).fadeOut(200,function(){
	    		NoDagin = true;
	    	});
    	}
    });
 
});
</script>