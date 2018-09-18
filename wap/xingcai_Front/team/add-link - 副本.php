<?php $this->display('inc_daohang1.php'); ?>
<link rel="stylesheet" href="/css/nsc_m/m-list.css?v=1.17.1.23">
<script type="text/javascript" src="/js/nsc_m/res.js?v=1.16.12.4"></script>

</head>
<body>
  <section class="wraper-page">
<div class="tab-first clearfix">
<ul class="list_menus-li">
	<li class="on"><a href="/index.php/team/addlink">推广设定</a></li>
	<li><a href="/index.php/team/linkList">链接管理</a></li>
</ul>
</div>
<div class="form_switch_main">
<form action="/index.php/team/insertLink" method="post" target="ajax" onajax="teamBeforeAddLink" call="teamAddLink">
<input name="uid" type="hidden" id="uid" value="<?=$this->user['uid']?>" />
<div class="form_switch_head switch_head">
	<div class="form_item1 clearfix">
		<span class="item_left">温馨提示：</span>
		<div class="item_right entry_two">
		<p>★推广链接注册用户返点最大为<?=$this->iff(($this->user['fanDian']-$this->settings['fanDianDiff'])<=0,0,$this->user['fanDian']-$this->settings['fanDianDiff'])?>%</p>
	
		</div>
	</div>
	<div class="form_item clearfix">
		<span class="item_left">用户类型: </span>
		<div class="item_right">
			<div class="switch_choose">
							<input type="radio" name="usertype" id="utype1" value="1" checked="checked">
				<label class="bk_l actived" for="utype1">代理</label>
				<input type="radio" name="usertype" id="utype2" value="0">
				<label class="bk_r" for="utype2">会员</label>
						</div>
		</div>
	</div>
	<div class="form_item clearfix">
		<span class="item_left">返点设置: </span>
		<div class="item_right entry_one">
		<input type="text" name="fanDian" max="<?=$this->user['fanDian']?>" max="<?=$this->user['fanDian']?>"  fanDianDiff=<?=$this->settings['fanDianDiff']?> maxlength="5" placeholder="请设置返点">
		<span id="rebate_fp" class="rebate_fp1">返点区间(0%-<?=$this->iff(($this->user['fanDian']-$this->settings['fanDianDiff'])<=0,0,$this->user['fanDian']-$this->settings['fanDianDiff'])?>%)</span>
		</div>
	</div>
	<!--div class="form_item clearfix" style="padding-top:0.5rem">
		<div class="item_right" style="float:right">
			<span class="rebate_zs">您的下级返点为: <b id="subPoint">4.9%</b></span>
			<span class="rebate_zs">您的返点：<b>5.0%</b></span>
		</div>
	</div-->
	<div class="form_submit_box">
		<input class="button" id="addlink" type="submit" value="生成链接">
	</div>
</div>
</form>



<script type="text/javascript">

	//radio选择样式
    $(".switch_choose input[type=radio]").click(function(){
        if($(".switch_choose input[type=radio]:checked").val()){
       		$(this).next('label').addClass('actived').siblings().removeClass('actived');
       	}
    })

</script>
<div class="m_footer_annotation">
                        未满18周岁禁止购买<br>
                Copyright © SinCai  2010-2020 版权所有
                <!-- <a href="#" class="m_f_top"></a> -->
</div>
<div class="padding_fot_b20 "></div>



</div>


</div></body></html>