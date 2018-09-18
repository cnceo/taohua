<?php $this->display('inc_daohang.php'); ?>


<div id="nsc_subContent" style="border:0">


<div id="siderbar">
<ul class="list clearfix">
<li ><a href="/index.php/lottery/hemai">合买中心</a></li>
<li class="current"><a href="/index.php/lottery/search">投注记录</a></li>
</ul>
</div>

<link rel="stylesheet" href="/css/nsc/reset.css?v=1.16.11.5" />
<link rel="stylesheet" href="/css/nsc/list.css?v=1.16.11.5" />
<link rel="stylesheet" href="/css/nsc/activity.css?v=1.16.11.5" />
<script type="text/javascript" src="/js/nsc/jquery-1.7.min.js?v=1.16.11.5"></script>
<script type="text/javascript" src="/js/nsc/main.js?v=1.16.11.5"></script>
<script type="text/javascript" src="/js/nsc/dialogUI/jquery.dialogUI.js?v=1.16.11.5"></script>
<link href="/css/nsc/plugin/dialogUI/dialogUI.css?v=1.16.11.5" media="all" type="text/css" rel="stylesheet" />

</head>
<body>
<div id="subContent_bet_re">

<style>
    .task_div{right:50px;}
</style>
<script type="text/javascript">
$(function(){
	
	$('.search form input[name=betId]')
	.focus(function(){
		if(this.value=='输入单号') this.value='';
	})
	.blur(function(){
		if(this.value=='') this.value='输入单号';
	})
	.keypress(function(e){
		if(e.keyCode==13) $(this).closest('form').submit();
	});
	
	$('.chazhao').click(function(){
		$(this).closest('form').submit();
	});
	
	$('.bottompage a[href]').live('click', function(){
		$('.biao-cont').load($(this).attr('href'));
		return false;
	});

});
function recordSearch(err, data){
	if(err){
		$.alert(err);
	}else{
		$('.biao-cont').html(data);
	}
}
function recodeRefresh(){
	$('.biao-cont').load(
		$('.bottompage .pagecurrent').attr('href')
	);
}

function deleteBet(err, code){
	if(err){
		$.alert(err);
	}else{
		recodeRefresh();
	}
}
</script>
<div id="contentBox">
    <form action="/index.php/record/searchGameRecord/<?=$this->userType?>" dataType="html" call="recordSearch" target="ajax">
      
        <div id="searchBox" class="re">
        	<div class="inlineBlock">
            	<label>投注时间：</label><input type="text" class="input150" value="<?= $this->iff($_REQUEST['fromTime'], $_REQUEST['fromTime'], date('Y-m-d H:i', $GLOBALS['fromTime'])) ?>" name="fromTime" id="datetimepicker" /> <span class="image"></span>
            </div>
            <label>至</label>
            <div class="inlineBlock">
            	<input type="text" class="input150" value="<?= $this->iff($_REQUEST['toTime'], $_REQUEST['toTime'], date('Y-m-d H:i', $GLOBALS['toTime'])) ?>" id="datetimepicker4" name="toTime" /> <span class="image" ></span>
            </div>
            <div class="inlineBlock">
                <label>彩种名称：</label>
                <select class="team" name="lotteryid" id="lotteryid">
                 <option value="0" <?=$this->iff($_REQUEST['type']=='', 'selected="selected"')?>>全部彩种</option>
            <?php
                if($this->types) foreach($this->types as $var){ 
                    if($var['enable']){
            ?>
            <option value="<?=$var['id']?>" <?=$this->iff($_REQUEST['type']==$var['id'], 'selected="selected"')?>><?=$this->iff($var['shortName'], $var['shortName'], $var['title'])?></option>

            <?php }} ?>
        </select>
            </div>
            <div class="inlineBlock">
            	<label>彩种状态：</label><select id="methodid"  name="methodid"  class="team">
				 <option value="0" selected>所有状态</option>
            <option value="1">已派奖</option>
            <option value="2">未中奖</option>
            <option value="3">未开奖</option>
            <option value="4">追号</option>
            <option value="5">撤单</option>
        </select>
		 <!--select name="mode" class="text5">
            <option value="" selected>全部模式</option>
            <option value="1.000">1元</option>
            <option value="2.000">元</option>
            <option value="0.200">角</option>
            <option value="0.020">分</option>
            <option value="0.002">厘</option>
        </select-->
            </div>            
       
        </div>
        <div class="search_br"><input type="button" value="查询" class="formCheck chazhao" /></div>
    </form>
    </div>
  <div class="display biao-cont">
    	<!--下注列表-->
        <?php $this->display('record/search-list.php'); ?>
        <!--下注列表 end -->
    </div>
<?php $this->display('inc_root.php'); ?>
<div class="list_page">
    <span class="l_message">备注:如需查看投注单详情，请点击单号</span>
    <div class="pageinfo"></div>
</div>
</div></div></div></div></div>
<?php $this->display('inc_che.php'); ?>

 </body>
 </html>