<?php $this->display('inc_daohang.php'); ?>

<div id="nsc_subContent" style="border:0">

<div id="siderbar">
<ul class="list clearfix">
<li class="current"><a href="/index.php/team/addlink" >推广设定</a></li>
<li ><a href="/index.php/team/addMember" >开户管理</a></li>
<li ><a href="/index.php/team/memberList" >会员列表</a></li>
<li ><a href="/index.php/team/linkList" >推广链接</a></li>
<li ><a href="/index.php/team/gameRecord" >团队记录</a></li>
<li ><a href="/index.php/team/coin" >团队帐变</a></li>
<li ><a href="/index.php/team/report" >团队盈亏</a></li>
<li ><a href="/index.php/cash/rechargeLog" >充值记录</a></li>
<li ><a href="/index.php/team/cashRecord" >团队提现</a></li>
<li ><a href="/index.php/team/coinall" >团队统计</a></li>
</ul>
</div>
<link rel="stylesheet" href="/css/nsc/reset.css?v=1.16.11.5" />
<link rel="stylesheet" href="/css/nsc/list.css?v=1.16.11.5" />
<link rel="stylesheet" href="/css/nsc/activity.css?v=1.16.11.5" />


</head>
<body>
<div id="subContent_bet_re">


<div class="form_switch_main">
<form action="/index.php/team/insertLink" method="post" target="ajax" onajax="teamBeforeAddLink" call="teamAddLink">
<input name="uid" type="hidden" id="uid" value="<?=$this->user['uid']?>" />
<div class="form_switch_head">
	<div class="form_item clearfix">
		<span class="item_left">用户类型：</span>
		<div class="item_right">
			<div class="switch_choose">
			<input type="radio" name="type" id="utype1" value="1" checked="checked" title="代理">
			<label class="bk_l active" for="utype1">代理</label>
			<input type="radio" name="type" id="utype2" value="0" title="会员">
			<label class="bk_r" for="utype2">会员</label>
			</div>
		</div>
	</div>
		<div class="form_item clearfix">
		<span class="item_left">返点：</span>
		<div class="item_right entry_two">
		<input type="text" name="fanDian" max="<?=$this->user['fanDian']?>" max="<?=$this->user['fanDian']?>"  fanDianDiff=<?=$this->settings['fanDianDiff']?> maxlength="5" placeholder="请设置返点">
		<span id="rebate_fp" class="rebate_fp">返点为(0%-<?=$this->user['fanDian']?>%)</span>
		</div>
	</div>


<div class="form_submit_box">
	<input class="button"  type="submit" value="生成链接">

</div>
</div>
</form>


</div>
<script type="text/javascript">
		//radio选择样式
        $(".switch_choose input[type=radio]").click(function(){
	        if($(".switch_choose input[type=radio]:checked").val()){
	       		$(this).next('label').addClass('active').siblings().removeClass('active');
	       	}
        })
</script>
</div></div></div></div></div>
<?php $this->display('inc_che.php'); ?>
 </body>
 </html>