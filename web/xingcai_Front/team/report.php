<?php $this->display('inc_daohang.php'); ?>


<div id="nsc_subContent" style="border:0">
<script type="text/javascript">

	$(function() {
		$( ".menus-li li").click(function(){
            $( ".menus-li li").removeClass("on");
            $(this).addClass("on");
            $("#tabs-1,#tabs-2").hide();
            $("#tabs-"+($(this).index()+1)).show();
        });
	})
</script>

<div id="siderbar">
<ul class="list clearfix">
<li ><a href="/index.php/team/addlink" >推广设定</a></li>
<li ><a href="/index.php/team/addMember" >开户管理</a></li>
<li ><a href="/index.php/team/memberList" >会员列表</a></li>
<li ><a href="/index.php/team/linkList" >推广链接</a></li>
<li ><a href="/index.php/team/gameRecord" >团队记录</a></li>
<li ><a href="/index.php/team/coin" >团队帐变</a></li>
<li class="current"><a href="/index.php/team/report" >团队盈亏</a></li>
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

<style>
    .task_div{right:50px;}
</style>
<script type="text/javascript">
$(function(){
	$('.search form input[name=username]')
	.focus(function(){
		if(this.value=='用户名') this.value='';
	})
	.blur(function(){
		if(this.value=='') this.value='用户名';
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
function searchData(err, data){
	if(err){
		alert(err);
	}else{
		$('.biao-cont').html(data);
	}
}
</script>
<div id="contentBox">
		<form action="/index.php/team/searchReport" target="ajax" call="searchData" dataType="html">
      
        <div id="searchBox" class="re">
        	<div class="inlineBlock">
            	<label>盈亏时间：</label><input type="text" class="input150" value="<?= $this->iff($_REQUEST['fromTime'], $_REQUEST['fromTime'], date('Y-m-d H:i', $GLOBALS['fromTime'])) ?>" name="fromTime" id="datetimepicker" /> <span class="image"></span>
            </div>
            <label>至</label>
            <div class="inlineBlock">
            	<input type="text" class="input150" value="<?= $this->iff($_REQUEST['toTime'], $_REQUEST['toTime'], date('Y-m-d H:i', $GLOBALS['toTime'])) ?>" id="datetimepicker4" name="toTime" /> <span class="image" ></span>
            </div>
            <input type="button" value="查询" class="formCheck chazhao" /></div>
    </form>
    </div>
  <div class="display biao-cont">
    	<!--下注列表-->
        <?php $this->display('team/report-list.php'); ?>
        <!--下注列表 end -->
    </div>
<?php $this->display('inc_root.php'); ?>
<div class="list_page">
   
    <div class="pageinfo"></div>
</div>
</div></div></div></div></div>
<?php $this->display('inc_che.php'); ?>

 </body>
 </html>