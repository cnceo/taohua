<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>桃花彩-官方网站</title>
<meta name="keywords" content="">
<meta nam="description" content="">
<meta name="renderer" content="webkit">
<link rel="stylesheet" href="/css/nsc/home/reset.css?v=1.17.1.13">
<link rel="stylesheet" href="/css/nsc/home/theme.css?v=1.17.1.13">
<link href="/css/nsc/plugin/dialogUI/dialogUI.css?v=1.17.1.13" media="all" type="text/css" rel="stylesheet">
<script>var TIP=true;</script>
<script type="text/javascript" src="/skin/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/skin/main/onload.js"></script>
<script type="text/javascript" src="/newskin/js/function.js"></script>
<script type="text/javascript" src="/skin/layer/layer.js"></script>
<script type='text/javascript'>
function zxkf(){
	 <?php if($this->settings['kefuStatus']){ ?>
	layer.open({
	  type: 2,
	  area: ['800px', '550px'],
	  zIndex:1999,
	  //fixed: false, //不固定
	  title:'在线客服',
	  scrollbar: false,//屏蔽滚动条
	  //maxmin: true,
	  content:'<?=$this->settings['kefuGG']?>'
	});
	<?php }else{?>
	$.alert("客服系统维护中");
	<?php }?>
	return false;
}
function qqkf(){
	<?php if($this->settings['qqkefuStatus']){ ?>
	layer.open({
	  type: 2,
	  area: ['800px', '550px'],
	  zIndex:1999,
	  //fixed: false, //不固定
	  title:'在线客服',
	  scrollbar: false,//屏蔽滚动条
	  //maxmin: true,
	  content:'http://wpa.qq.com/msgrd?uin=<?=$this->settings['qqkefuGG']?>'
	});
	<?php }else{?>
	$.alert("客服系统维护中");
	<?php }?>
	return false;
}
</script>
</head>
    <body class="nsc_background01">
        <div class="header">
    <div class="top">
        <div class="content">
            <div class="fl logo">
                <a href="/index.php" title="返回首页">
                    <img src="/images/nsc/logo.png?v=1.17.1.13">
                </a>
            </div>
            <div class="fr t_menu">
            <div class="ftop user_info">
				尊贵的：
				<span class="ui_yuliu" title="">VIP<?=htmlspecialchars($this->user['grade'])?></span>
				欢迎您，
                <span class="username" title=""><?=$this->user['username']?></span>
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
                    <span class="t_money rounded">
                        <div class="show-money">￥<span id="refff">0.0000</span></div>
                        <div class="hide-money" style="display: none;">￥<span><b>************</b></span></div>
                    </span>
                </div>
                <a href="javascript:void(0);" class="shuaxin" id="refreshmoney" title="刷新余额">
                    <i class="ic-refresh" style="display: inline-block;"></i>
                </a>
                <a href="javascript:;" title="隐藏余额">
                    <i class="ic-unlook" title="隐藏余额"></i>
                </a>
                <a href="javascript:void(0);" onclick="czpay();" class="t_btn">充值</a>
                <a href="javascript:void(0);" onclick="topay();" class="t_btn">提款</a>
                <a href="javascript:void(0)" onclick="zxkf();"  title="在线客服" class="t_kefu">
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
        <div class="banner">
            <ul class="rslides f980x240 rslides1" style="max-width: 980px;">
                        <li id="rslides1_s0" class="" style="display: none; float: none; position: absolute;">
                            <a href="/?nav=jssm&amp;flaglot=jssm#">
                                <img src="/images/uploads/1/1.jpg">
                            </a>
                        </li>
                                            <li id="rslides1_s1" class="" style="display: none; float: none; position: absolute;">
                            <a href="/?nav=activity&amp;tag=viewactivity&amp;template=1#">
                                <img src="/images/uploads/1/2.jpg">
                            </a>
                        </li>
                        <li id="rslides1_s2" class="" style="display: none; float: none; position: absolute;">
                            <a href="/?controller=promotions&amp;action=main&amp;tag=extremepoints#">
                                <img src="/images/uploads/1/3.jpg">
                            </a>
                        </li>
                        <li id="rslides1_s3" class="" style="display: none; float: none; position: absolute;">
                            <a href=" /?nav=pk10&amp;flaglot=pk10#">
                                <img src="/images/uploads/1/4.jpg">
                            </a>
                        </li>
                                            <li id="rslides1_s4" style="display: none; float: none; position: absolute;">
                            <a href="/?nav=activity&amp;tag=viewactivity&amp;template=4#">
                                <img src="/images/uploads/1/5.jpg">
                            </a>
                        </li>

             </ul>
				<a href="#" class="rslides_nav rslides1_nav prev">&lt;</a><a href="#" class="rslides_nav rslides1_nav next">&gt;</a>
        </div>
        <div class="hall_cont">
            <div class="cp_game">
                <div class="cp_title">
                    <h1 class="fl"><i class="ic-tt8game"></i> 彩票游戏</h1>
                    <div class="clear"></div>
                </div>
                <div class="cp_g_list">
                    <ul>
                       <li class="cp_list_01" id="lottery_L-25">
                        	<span class="index_icon_new"></span>
                            <em class="cp_l_alpha"></em>
                            <a href="/index.php/index/game/20/27/北京PK拾">
                                <span class="pk10_logo"></span>
                            	<!--<div class="mmc_ggtit">全新彩种 即将上线</div>-->
                                <p>距<span class="issue">下一期</span>销售截止</p>
                                <div class="cp_time_01">
                                   <?php $this->display('cai_pk10.php'); ?>
                                </div>
                                <span class="cp_g_xh">立即投注</span>
                            </a>
                        </li>
                        <li class="cp_list_02" id="lottery_L-1">
                            <em class="cp_l_alpha"></em>
                            <a href="/index.php/index/game/1/2/12/重庆时时彩">
                                <span class="cqssc_logo"></span>
                                <p>距<span class="issue">下一期</span>销售截止</p>
                                <div class="cp_time_01">
								<?php $this->display('cai_cq.php'); ?>
                                </div>
                                <span class="cp_g_xh">立即投注</span>
                            </a>
                        </li>
                        <li class="cp_list_03" id="lottery_L-19">
                            <em class="cp_l_alpha"></em>
                            <a href="/index.php/index/game/14/59/193/河内5分彩">
                                <span class="hnquick5_logo"></span>
                                <p>距<span class="issue">下一期</span>销售截止</p>
                                <div class="cp_time_01">
                                <?php $this->display('cai_5fc.php'); ?>
                                </div>
                                <span class="cp_g_xh">立即投注</span>
                            </a>
                        </li>
                        <li class="cp_list_04" id="lottery_L-23">
                            <em class="cp_l_alpha"></em>
                            <a href="/index.php/index/game/5/59/193/河内1分彩"><span class="hnffc_logo"></span></a>
                        </li>
                        <li class="cp_list_05" id="lottery_L-24">
                            <em class="cp_l_alpha"></em>
                            <a href="/index.php/index/game/60/2/12/天津时时彩"><span class="tjssc_logo"></span></a>
                        </li>
                        <li class="cp_list_06">
                            <em class="cp_l_alpha"></em>
                            <a href="/index.php/index/game/12/2/12/新疆时时彩"><span class="xjssc_logo"></span></a>
                        </li>
                        <li class="cp_list_07">
                            <em class="cp_l_alpha"></em>
                            <a href="/index.php/index/game/79/39/江苏快三"><span class="jsk3_logo"></span></a>
                        </li>
                        <li class="cp_list_08">
                            <em class="cp_l_alpha"></em>
                            <a href="/index.php/index/game/6/广东11选5"><span class="gd11x5_logo"></span></a>
                        </li>
                        <li class="cp_list_09">
                            <em class="cp_l_alpha"></em>
                            <a href="/index.php/index/game/9/3D福彩"><span class="sdfc_logo"></span></a>
                        </li>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="activity">
                <div class="cp_title">
                    <h1 class="fl">
                        <i class="ic-ttHot"></i> 热门活动
                        <a href="/index.php/score/rotate">/ 更多</a>
                    </h1>
                    <div class="clear"></div>
                </div>
                <div class="ac_cont">
				  <a href="/index.php/score/rotate">
                        <img src="/images/timg.jpg?v=1.17.1.13" width="420" height="215">
                    </a>
                 </div>
            </div>
            <div class="gongao">
                <div class="cp_title">
                    <h1 class="fl">
                        <i class="ic-ttNotice"></i> 平台公告
                        <a class="notice" href="javascript:void(0)" url="/index.php/notice/info">/ 更多</a>
                    </h1>
                    <div class="clear"></div>
                </div>
                <div class="gg_list">
					<ul >
						<?php
							$bool = true;
							foreach ($args[0]['data'] as $var) {
							if ($bool) {
							$bool = false;
							$val  = $var;
							}
							$cout += 1;
							$mod = $cout % 2;
						?>

						<li>
							<a title="系统公告" href="javascript:void(0)" class="notice" url="/index.php/notice/view/<?= $var['id'] ?>"><?= $var['title'] ?></a>
							<span><?=date('Y-m-d H:i:s', $var['addTime'])?></span>
						</li>
						<?php
						}
						?>
					</ul>
                </div>
            </div>
            <div class="xc_game">
                <div class="cp_title">
                    <h1 class="fl">
                        <i class="ic-ttGame"></i> PT游戏
                        <a href="#">/ 更多</a>
                    </h1>
                    <div class="clear"></div>
                </div>
                <input type="hidden" value="5" class="count">
                <a href="javascript:;" class="xcbtn xc_prev"></a>
                <a href="javascript:;" class="xcbtn xc_next"></a>
                <div class="xc_g_list">
                   <ul class="xc_menu">
                                                <li class="xc_list">
                            <a href="javascript:void(0)" onclick="jjtc()" title="7座百家乐" target="_blank" class="xc_l_img">
                            <em class="xc_opacity"></em>
                                <img src="/images/ptgamepic/20160505121322_870.jpg" width="160" height="240" />
                            </a>
                            <h2><a href="./?controller=ptgame&action=play&id=23" title="7座百家乐">7座百家乐</a></h2>
                        </li>
                                                <li class="xc_list">
                            <a href="javascript:void(0)" onclick="jjtc();" title="迷你百家乐" target="_blank" class="xc_l_img">
                            <em class="xc_opacity"></em>
                                <img src="/images/ptgamepic/20160505121455_870.jpg" width="160" height="240" />
                            </a>
                            <h2><a href="javascript:void(0)" onclick="jjtc();" title="迷你百家乐">迷你百家乐</a></h2>
                        </li>
                                                <li class="xc_list">
                            <a href="javascript:void(0)" onclick="jjtc();" title="累积百家乐（现场）" target="_blank" class="xc_l_img">
                            <em class="xc_opacity"></em>
                                <img src="/images/ptgamepic/20160505121757_870.jpg" width="160" height="240" />
                            </a>
                            <h2><a href="javascript:void(0)" onclick="jjtc();" title="累积百家乐（现场）">累积百家乐（现场）</a></h2>
                        </li>
                                                <li class="xc_list">
                            <a href="javascript:void(0)" onclick="jjtc();" title="在线骰宝" target="_blank" class="xc_l_img">
                            <em class="xc_opacity"></em>
                                <img src="/images/ptgamepic/20160505121809_870.jpg" width="160" height="240" />
                            </a>
                            <h2><a href="javascript:void(0)" onclick="jjtc();" title="在线骰宝">在线骰宝</a></h2>
                        </li>
                                                <li class="xc_list">
                            <a href="javascript:void(0)" onclick="jjtc();" title="蔚蓝海岸" target="_blank" class="xc_l_img">
                            <em class="xc_opacity"></em>
                                <img src="/images/ptgamepic/20160505121510_870.jpg" width="160" height="240" />
                            </a>
                            <h2><a href="javascript:void(0)" onclick="jjtc();" title="蔚蓝海岸">蔚蓝海岸</a></h2>
                        </li>
                                                <li class="xc_list">
                            <a href="javascript:void(0)" onclick="jjtc();" title="疯狂之七" target="_blank" class="xc_l_img">
                            <em class="xc_opacity"></em>
                                <img src="/images/ptgamepic/20160505121640_870.jpg" width="160" height="240" />
                            </a>
                            <h2><a href="javascript:void(0)" onclick="jjtc();" title="疯狂之七">疯狂之七</a></h2>
                        </li>
                                                <li class="xc_list">
                            <a href="javascript:void(0)" onclick="jjtc();" title="炙热宝石" target="_blank" class="xc_l_img">
                            <em class="xc_opacity"></em>
                                <img src="/images/ptgamepic/20160505121729_870.jpg" width="160" height="240" />
                            </a>
                            <h2><a href="javascript:void(0)" onclick="jjtc();" title="炙热宝石">炙热宝石</a></h2>
                        </li>
                                                <li class="xc_list">
                            <a href="javascript:void(0)" onclick="jjtc();" title="公路之王" target="_blank" class="xc_l_img">
                            <em class="xc_opacity"></em>
                                <img src="/images/ptgamepic/20160505121743_870.jpg" width="160" height="240" />
                            </a>
                            <h2><a href="javascript:void(0)" onclick="jjtc();" title="公路之王">公路之王</a></h2>
                        </li>
                                                <li class="xc_list">
                            <a href="javascript:void(0)" onclick="jjtc();" title="21 Duel Blackjack Multihand" target="_blank" class="xc_l_img">
                            <em class="xc_opacity"></em>
                                <img src="/images/ptgamepic/20141104143453_130.jpg" width="160" height="240" />
                            </a>
                            <h2><a href="javascript:void(0)" onclick="jjtc();" title="21 Duel Blackjack Multihand">21 Duel Blackjack Multihand</a></h2>
                        </li>
                                                <li class="xc_list">
                            <a href="javascript:void(0)" onclick="jjtc();" title="赌场德州扑克" target="_blank" class="xc_l_img">
                            <em class="xc_opacity"></em>
                                <img src="/images/ptgamepic/20160505121715_870.jpg" width="160" height="240" />
                            </a>
                            <h2><a href="javascript:void(0)" onclick="jjtc();" title="赌场德州扑克">赌场德州扑克</a></h2>
                        </li>
                                            </ul>
                </div>
            </div>


            <div class="clear"></div>
        </div>
<script type="text/javascript" src="/js/nsc/jquery-1.7.min.js?v=1.17.1.13"></script>
<link rel="stylesheet" href="/css/nsc/foot.css?v=1.17.1.13">
<script type="text/javascript" src="/images/down/swfobject.js?v=1.17.1.13"></script>

<div class="login_footer">
	<div class="warp980">
		<div class="img"></div>
		<div class="clearfix">
			<p class="t-left">
				浏览器建议：首选为Google浏览器，其次为火狐和IE9或IE10浏览器<br>分辨率建议：使用1024×768以上的分辨率
			</p>
			<p class="t-right">
				未满18周岁禁止购买<br>
				Copyright © SinCai 2010-2020  桃花彩 版权所有
			</p>
		</div>
	</div>
</div>

<!--侧边栏-->
<div class="sidebar" id="sidebar">
	<a href="/index.php" class="sidebar-div home"><i class="ic-home"></i>回到首页</a>
	<a  href="javascript:void(0)" onclick="zxkf();" class="sidebar-div"><i class="ic-online"></i>在线客服</a>
	<a datatype="json" call="indexSign" target="ajax" href="/index.php/display/sign" class="sidebar-div"><i class="iconfont">&#xe64d;</i>天天签到</a>
	<a  href="javascript:void(0);" url="/index.php/liaotian/chat" class="sidebar-div chongzhi"><i class="iconfont">&#xe60b;</i>多人聊天</a>
	<a href="javascript:voiceKJ();" class="sidebar-div"><i class="ic-sound soundClickEvent"></i>声音控制</a>
	<a href="javascript:void(0);" class="sidebar-div" id="sidebarGoTop"><i class="ic-top"></i>返回顶部</a>
	<!--<div class="sidebar-div down" id="mdown-show">手机下载<i class="link"></i></div>-->
</div>

<!-- <div class="zr-mobile-down" align="center">
	<div class="zr-container" align="left">
		<ul>
			<li class="log"></li>
			<li class="text">
				<p>手机移动端APP 真实娱乐更便捷</p>
				<p class="t2">扫码下载！随时随地，想玩就玩</p>
			</li>
			<li class="QR-code"><img src="/images/nsc/login/login_sj-web_ewmimg.png?v=1.17.1.13" width="98" height="98"/></li>
			<li>
				<a href="#" class="down-link-iphone"></a>
				<a href="#" class="down-link-android"></a>
			</li>
		</ul>
		<button class="close" id="mdown-close"></button>
	</div>
	<div id="mdown-show">手机下载<i class="link"></i></div>
</div> -->
<link rel="stylesheet" type="text/css" href="/css/nsc/guide.css?v=1.17.1.13">

<div class="guide guide_new">
    <div class="guide-mask"></div>
    <div class="guide-container">
        <div class="guide-content">
            <div class="step step_00 active">

            </div>
            <div class="step step_01">
                <div class="line line-top"></div>
                <div class="line line-right"></div>
                <div class="line line-bottom"></div>
                <div class="line line-left"></div>
            </div>
            <div class="step step_02">
                <div class="line line-top"></div>
                <div class="line line-right"></div>
                <div class="line line-bottom"></div>
                <div class="line line-left"></div>
            </div>
            <div class="step step_03">
                <div class="line line-top"></div>
                <div class="line line-right"></div>
                <div class="line line-bottom"></div>
                <div class="line line-left"></div>
            </div>
            <div class="guide-close"></div>
            <div class="guide-btn"></div>
            <div class="guide-dots">
                <ul>
                    <li class="active"></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- 切换背景功能 -->
<link rel="stylesheet" href="/css/nsc/bg_skin.css?v=1.17.1.13" type="text/css">
<div class="skin-mask"></div>
<div class="skin-box">
    <span class="close_box"></span>
    <div class="skin_tit"><i></i>更换背景</div>
    <div class="skin_main">
        <div class="skin_div">
        <ul class="skin_ulbox clerafix">
            <li data="nsc_background01"><a href="javascript:(0);" class="active"><img src="/images/nsc/skin_bg/skin-img01.jpg?v=1.17.1.13"></a><span>默认</span></li>
            <li data="nsc_background02"><a href="javascript:(0);"><img src="/images/nsc/skin_bg/skin-img02_small.jpg?v=1.17.1.13"></a><span>云樱</span></li>
            <li data="nsc_background03"><a href="javascript:(0);"><img src="/images/nsc/skin_bg/skin-img03_small.jpg?v=1.17.1.13"></a><span>春桃</span></li>
            <li data="nsc_background04"><a href="javascript:(0);"><img src="/images/nsc/skin_bg/skin-img04_small.jpg?v=1.17.1.13"></a><span>都市</span></li>
            <li data="nsc_background05"><a href="javascript:(0);"><img src="/images/nsc/skin_bg/skin-img05_small.jpg?v=1.17.1.13"></a><span>歌剧魅影</span></li>
            <li data="nsc_background06"><a href="javascript:(0);"><img src="/images/nsc/skin_bg/skin-img06_small.jpg?v=1.17.1.13"></a><span>梦幻</span></li>
            <li data="nsc_background07"><a href="javascript:(0);"><img src="/images/nsc/skin_bg/skin-img07_small.jpg?v=1.17.1.13"></a><span>魔境</span></li>
            <li data="nsc_background08"><a href="javascript:(0);"><img src="/images/nsc/skin_bg/skin-img08_small.jpg?v=1.17.1.13"></a><span>蔚蓝</span></li>
            <li data="nsc_background09"><a href="javascript:(0);"><img src="/images/nsc/skin_bg/skin-img09_small.jpg?v=1.17.1.13"></a><span>午夜</span></li>
            <li data="nsc_background10"><a href="javascript:(0);"><img src="/images/nsc/skin_bg/skin-img10_small.jpg?v=1.17.1.13"></a><span>足球宝贝</span></li>
        </ul>
        </div>
        <div class="skin_page"><a href="javascript:(0);" class="btn_default"><i class="ic-hfmr"></i>恢复默认</a><a href="javascript:(0);" class="btn_cancel">取 消</a><a href="javascript:(0);" class="btn_set"><i class="ic-bcsz"></i>保存设置</a></div>
    </div>
</div>
<!-- 公共开放导航弹窗 -->
<div id="v-dalog" class="v-dalog">
	<div class="v-bg"></div>
	<span class="v-cn">近期开放，敬请期待
	</span>
</div>


<span class="global-close"></span>
<script type="text/javascript" src="/js/nsc/velocity.min.js?v=1.17.1.13"></script>
<script src="/js/nsc/zr-script.js?v=1.17.1.13" charset="utf-8"></script>

<script type="text/javascript" src="/js/nsc/jquery-slides.js?v=1.17.1.13"></script>
<script type="text/javascript" src="/js/nsc/dialogUI/jquery.dialogUI.js?v=1.17.1.13"></script>
<script type="text/javascript" src="/js/nsc/main.js?v=1.17.1.13"></script>
<script type="text/javascript" src="/js/nsc/soundBox.js?v=1.17.1.13"></script>
<script type="text/javascript">
            $(function(){
                var $content = $(".xc_menu");
                var i = 5;  //已知显示的li元素的个数
                var m = 5;  //用于计算的变量
                var count = $content.find("li").length;//总共的li元素的个数
                $(".xc_next").click(function(){
                    if( !$content.is(":animated")){
                        if(m<count){  //判断 i 是否小于总的个数
                          m++;
                          $content.animate({left: "-=186px"}, 600);
                        }
                    }
                });

                $(".xc_prev").click(function(){
                    if( !$content.is(":animated")){
                        if(m>i){ //判断 i 是否小于总的个数
                            m--;
                            $content.animate({left: "+=186px"}, 600);
                        }
                    }
                });
            });
</script>
</body>
</html>