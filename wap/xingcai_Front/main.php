<html xmlns="http://www.w3.org/1999/xhtml" style="font-size: 12px;"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,user-scalable=no,maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<meta name="screen-orientation" content="portrait">
<meta name="x5-orientation" content="portrait">
<title><?= $this->settings['webName'] ?></title>
<meta name="keywords" content="">
<meta nam="description" content="">
<!--导航栏-->
<?php
if ($this->type) {
    $row = $this->getRow("select enable,title from {$this->prename}type where id={$this->type}");
    if (!$row['enable']) {
        echo $row['title'] . '已经关闭';
        exit;
    }
} else {
    $this->type    = 1;
    $this->groupId = 2;
    $this->played  = 10;
}
if ($_COOKIE['mode']) {
    $mode = $_COOKIE['mode'];
} else {
    $mode = 2.000;
}

$row1 = $this->getRows("select * from {$this->prename}content where enable=1 and nodeId=1");
$row2 = $this->getRows("select * from {$this->prename}message_receiver where to_uid={$this->user['uid']}");
?>

<link href="/css/newcss/style.css" rel="stylesheet" type="text/css"/>
<link href="/css/newcss/add.css" type="text/css" rel="stylesheet"/>
<link type="text/css" rel="stylesheet" href="/skin/js/jqueryui/jquery-ui-1.8.23.custom.css" />

<link rel="stylesheet" href="/css/nsc_m/res.css?v=1.16.12.12">
<link href="/css/nsc_m/m-reset.css?v=1.16.12.12" rel="stylesheet" type="text/css">
<link href="/css/nsc_m/m-warp.css?v=1.16.12.12" rel="stylesheet" type="text/css">
<link href="/css/nsc_m/m-lottery.css?v=1.16.12.12" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/js/nsc/jquery-1.7.min.js?v=1.16.12.12"></script>
<script type="text/javascript" src="/js/nsc_m/layer.js?v=1.16.12.12"></script>
<link href="/js/nsc_m/need/layer.css?2.0" type="text/css" rel="styleSheet" id="layermcss">
<script type="text/javascript" src="/js/nsc/common.js?v=1.16.12.12"></script>
<script type="text/javascript" src="/skin/js/jquery.cookie.js"></script>


<script>var TIP=true;</script>
<!--script type="text/javascript" src="/skin/js/jquery.cookie.js"></script-->
<!--script type="text/javascript" src="/skin/js/Array.ext.js"></script-->
<!--script type="text/javascript" src="/skin/js/jquery.simplemodal.src.js"></script-->
<script type="text/javascript" src="/skin/js/jquery.SuperSlide.2.1.1.js"></script>
<script type="text/javascript" src="/skin/js/onload.js"></script>
<script type="text/javascript" src="/skin/js/function.js"></script>
<script type="text/javascript" src="/skin/js/jqueryui/jquery-ui-1.8.23.custom.min.js"></script>
<script type="text/javascript" src="/skin/js/game.js?v5.0"></script>



</head>
<body >
<!--导航栏-->

<div id="body">
			 <?php
$lastNo = $this->getGameLastNo($this->type);
$kjHao  = $this->getValue("select data from {$this->prename}data where type={$this->type} and number='{$lastNo['actionNo']}'");
if ($kjHao)
    $kjHao = explode(',', $kjHao);

$actionNo   = $this->getGameNo($this->type);
$types      = $this->getTypes();
//print_r($types);
$kjdTime    = $types[$this->type]['data_ftime'];
$diffTime   = strtotime($actionNo['actionTime']) - $this->time - $kjdTime;
$kjDiffTime = strtotime($lastNo['actionTime']) - $this->time;
?>
<header class="header wjkjData">
<!-- javascript:window.history.back(); -->
	<a class="m-return-home" href="/index.php">返回大厅</a>
	<span class="btn-slide-bar"></span>
	<div class="m-nav-lott-date">
		<ul id="kaijiang"  style="width:100%" type="<?= $this->type ?>">
	
		<span class="m-n-data"><span class="thisno"><?= $actionNo['actionNo'] ?></span> 期 </span>
		<span class="m-n-countdown" id="sur-times"> -- : -- : -- </span>
		</ul>
	</div>
	<!-- <h1 class="page-title">header</h1> -->
</header>

<!--侧导航 -->
    <?php include 'include/daohan.php'; ?>
		<div class="shady"></div>
		<section class="wraper-page">
		<!-- <a href="#" id="rece_lott_btn">开奖历史</a> -->
<!--用户信息及彩种-->


 
  <div class="block_three">
<?php
$this->display('index/inc_data_current_new.php');
?>
</div>

	
<!--玩法-->
   <div class="tz_change">
<?php $this->display('game_line.php');?>
  </div>  
<!--玩法选择-->
<div class="tz_change">
  <div class="tz_work" id="playList">
  <div class="tz_xz">
<?php
$sql= "select groupName from {$this->prename}played_group where id=?";
$groupName = $this->getValue($sql, $this->groupId);

$sql= "select id, name, playedTpl, enable  from {$this->prename}played where enable=1 and groupId=? order by sort";
$playeds = $this->getRows($sql, $this->groupId);
if (!$playeds) {
    echo '<td colspan="7" align="center">暂无玩法</td>';
    return;
}
if (!$this->played)
    $this->played = $playeds[0]['id'];
?>
<?php
if ($playeds)
    foreach ($playeds as $played) {
        if ($this->played == $played['id'])
            $tpl = $played['playedTpl'];
        if ($played['enable']) {
?>
	<a data_id="<?= $played['id'] ?>" href="#" tourl="/index.php/index/played_new/<?= $this->type ?>/<?= $played['id'] ?>" <?= ($played['id'] == $this->played) ? ' class="tag"' : '' ?> style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><?= $played['name'] ?></a>
	<?php
        }
    }
?>
                    </div>

					
<!--玩法end投注标签开始-->


<!--div class="tz_info" id="game-helptips">
<?php
$sql= "select simpleInfo, info, example  from {$this->prename}played where id=?";
$playeds = $this->getRows($sql, $this->played);
?>
<p class="wjhelps">说明：<?= $playeds[0]["simpleInfo"] ?><!--<a href="#"><em action="lt_example" class="ico_sl showeg"></em></a><a href="#"><i action="lt_help" class="ico_ques showeg"></i></a></p>
<div id="lt_example" class="game_eg" style="display:none;"><?= $playeds[0]["example"] ?></div>
<div id="lt_help" class="game_eg" style="display:none;"><?= $playeds[0]["info"] ?></div>
<div class="line2">
                    </div>
                  </div-->

<!--选号-->
<div class="ball_list" style="width:100%;">
<div class="num-table" id="num-select">
<?php
if (!$played['enable']) {
    echo '<td colspan="7" align="center">暂无玩法</td>';
    return;
}
$this->display("index/game-played/$tpl.php");
?>
                       </div>
                    </div>
                </div>
				
				
				<!------------------------------------------------------------------------------------->
		<div class="addOrderBox">
                <div class="addOrderLeft">
                    <div class="chooseMsg">
                        <span id="game-tip-dom">请选择号码</span>
                       
                    </div>
                    <div class="m_funding_box">
                        <div class="jiangjin" id="game-dom">
                            <?php
if ($this->settings['yuanmosi'] == 1) {
?>
                  <b value="1.000" data-max-fan-dian="<?= $this->settings['betModeMaxFanDian0'] ?>" class="danwei">元</b><?php
}
?>
                  <?php
if ($this->settings['jiaomosi'] == 1) {
?>
                  <b value="0.100" data-max-fan-dian="<?= $this->settings['betModeMaxFanDian1'] ?>" class="danwei">角</b><?php
}
?>
                  <?php
if ($this->settings['fenmosi'] == 1) {
?>
                  <b value="0.010" data-max-fan-dian="<?= $this->settings['betModeMaxFanDian2'] ?>" class="danwei dwon">分</b><?php
}
?>
                  <?php
if ($this->settings['limosi'] == 1) {
?>
                  <b value="0.001" data-max-fan-dian="<?= $this->settings['betModeMaxFanDian3'] ?>" class="danwei">厘</b><?php
}
?>
                        <div class="multipleBox">
                            <div class="multipleCon re"><!--i class="surbeishu">&#xe603;</i-->
                                <input  id="beishu" value="<?= $this->ifs($_COOKIE['beishu'], 1) ?>" class="text"/><!--i class="addbeishu">&#xe602;</i-->
                            </div>
                            <span class="bei">倍</span>
                        </div>
                        <input type="button" class="addBtn" id="lt_sel_insert" onClick="gameActionAddCode()" value="添加投注">
                    </div>
                    
                </div>
                <div class="addOrderRight">
                    
                </div>
            </div>		
				<!------------------------------------------------------------------------------------->	
				
				<div class="lotteryBottom">
       <div class="touzhu-cont" >
  <table width="100%" cellpadding="0" cellspacing="0" >
  </table>
</div>
        <div class="orderNow">
            <div class="chooseAllMsg">
                <p>总注数 <span id="all-count" class="num">0</span> 注</p>
				
				
                <div class="checkZhui fqzhBox">
				<label  name="lt_trace_if" >
                 <b class="fq">发起追号</b>
               <input name="zhuiHao" value="1" type="checkbox">
                </div>
				
               	<div class="hemai">
				 <input type="checkbox" class="is_combine" value="1" id="cannel_chckbox"/><b class="fq">发起合买</b>
				 </div>
            </div>
                <p class="m_total_amout">总金额 <span id="all-amount" class="num orange">0</span> 元</p>
                <div class="sendChoose"><input type="button" class="addtz" id="btnPostBet"  value="添加投注"></div>
               <!-- <a href="">121212</a> -->
            <!-- <a class="m_see_more" href="?controller=gameinfo&action=gamelistbyself">查看投注记录</a> -->
            <a class="m_see_more"  href="/index.php/index/yxjl" title="投注记录" button="关闭:defaultModalCloase" width="100%" target="modal">查看投注记录</a>
        </div>
    </div>
             </div>      
              
        <?php $this->display('inc_footer.php'); ?>
		
<!--首页游戏记录开始-->
</section>

</div>
<div id="wanjinDialog"></div>
<!--end 2016/3/9-->
<script type="text/javascript">
var game={
	check1:<?= json_encode($check1) ?>,
	check2:<?= json_encode($check2) ?>,
	type:<?= json_encode($this->type) ?>,
	played:<?= json_encode($this->played) ?>,
	groupId:<?= json_encode($this->groupId) ?>
},
user="<?= $this->user['username'] ?>",
aflag=<?= json_encode($this->user['admin'] == 1) ?>;
function showx(x){
	if(x==82){$('.ball_write').hide();}else{$('.ball_write').show();}
}
</script>




  
<script type="text/javascript" src="/js/nsc_m/res.js?v=1.16.12.4"></script>
<script type="text/javascript">
$(function(){
    var riable=0;
    $(".nfdprize_text").click(function(){
        if(riable==0){
            riable=1;
            $(".m-lott-methodBox .nfdprize_text b").addClass('cur')
        }else{
            riable =0;
            $(".m-lott-methodBox .nfdprize_text b").removeClass('cur')
        }
        $(".m-lott-methodBox-list").toggle();
    });
}())   
</script>
</body></html>