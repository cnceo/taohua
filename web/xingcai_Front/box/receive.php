<?php $this->display('inc_daohang.php'); ?>

<div id="nsc_subContent">


<div id="siderbar">
<ul class="list clearfix">
<li ><a href="/index.php/safe/info" >绑定卡号</a></li>
<li ><a href="/index.php/safe/passwd" >密码修改</a></li>
<li ><a href="/index.php/record/search" >投注记录</a></li>
<li ><a href="/index.php/report/coin" >帐变记录</a></li>
<li ><a href="/index.php/report/count" >盈亏报表</a></li>
<li ><a href="/index.php/cash/rechargeLog" >充值记录</a></li>
<li ><a href="/index.php/cash/toCashLog" >提现记录</a></li>
<li ><a href="/index.php/user/nickname" >更改称昵</a></li>
<li class="current"><a href="/index.php/box/receive" >消息管理</a></li>
</ul>
</div>

<link rel="stylesheet" href="/css/nsc/reset.css?v=1.16.11.5" />
<link rel="stylesheet" href="/css/nsc/list.css?v=1.16.11.5" />
<link rel="stylesheet" href="/css/nsc/activity.css?v=1.16.11.5" />
</head>
<body>
<div id="subContent_bet_re">

<script type="text/javascript">
$(function(){
	$('.chazhao').click(function(){
		$(this).closest('form').submit();
	});
	$('.bottompage a[href]').live('click', function(){
		$('.biao-cont').load($(this).attr('href'));
		return false;
	});
	//查看
	$('.viewbox').live('click', function(){
		var tourl=$(this).attr("tourl");
		var dataid=$(this).attr("dataid");
		if(tourl){
			$('.boxdetail').load(tourl);
		}
	});
	//全选
$("input[name=chk_All]").live("click",function(){
	var item=$("input[name=chk_only]");
	 if( typeof(item.length) == "undefined" )
		{
			item.checked = !item.checked;
		}
		else
		{
			for(i=0;i<item.length;i++)
			{
				item[i].checked=$(this).attr("checked");
			}
		}
	 })	;
});
function boxSearch(err, data){
	if(err){
		$.alert(err);
	}else{
		$('.biao-cont').html(data);
		recodeRefresh();
	}
}
function recodeRefresh(){
	$('.biao-cont').load(
		$('.bottompage .on').attr('href')
	);
}
function deleteBet(err, data){
	if(err){
		$.alert(err);
	}else{
		$.alert('删除成功');
		recodeRefresh();
	}
}
/**
 * 批量撤销前调用
 */
function recordBeforeDelete(){
	//获取ID
	var byid="";
	var tourl="/index.php/box/deleteAll/";
	var a=document.getElementsByName("chk_only");
	for(var i=0,len=a.length;i<len;i++){
		if(a.item(i).checked){
		if(byid.length >0){
			byid=byid + "-" + a.item(i).value;
			}
		else{
			byid=byid + a.item(i).value;
		   }
	   }
	}
	if(byid.length>0){
		if(confirm('是否确定要删除？')){
			tourl+=byid;
			$(".removeAllRecord").attr("href",tourl);
		}else{return false;}
	}else{
		$.alert("请选择需要删除的消息！");	
		return false;
	}
}
function boxBeforSend(){
	if(!this.boxid.value)  throw('数据有误');
	if(!this.title.value) throw('请输入主题');
	if(!this.content.value) throw('请输入内容');
	if(!this.vcode.value) throw('请输入验证码');
	if(this.vcode.value<4) throw('验证码至少4位');
}
function boxSend(err, data){
	if(err){
		$.alert(err);
		$("#vcode").trigger("click");
	}else{
		$.alert(data);
		this.reset();
		reload();
	}
}
</script>

<div id="contentBox">
    <form action="/index.php/box/searchReceive" datatype="html" call="boxSearch" target="ajax">
      
        <div id="searchBox" class="re">
        	<!--div class="inlineBlock">
            	<label>信息时间：</label><input type="text" class="input150" value="<?= $this->iff($_REQUEST['fromTime'], $_REQUEST['fromTime'], date('Y-m-d H:i', $GLOBALS['fromTime'])) ?>" name="fromTime" id="datetimepicker" /> <span class="image"></span>
            </div>
            <label>至</label>
            <div class="inlineBlock">
            	<input type="text" class="input150" value="<?= $this->iff($_REQUEST['toTime'], $_REQUEST['toTime'], date('Y-m-d H:i', $GLOBALS['toTime'])) ?>" id="datetimepicker4" name="toTime" /> <span class="image" ></span>
            </div-->
			            <div class="inlineBlock">
            	<label>查询类型：</label><select id="methodid"  name="state"  class="team">
			<option value="3" selected>所有</option>
                <option value="2">已读</option>
                <option value="1">未读</option>
        </select>
		
            </div>  
          <input type="submit" value="查询" class="formCheck chazhao" />
		  <?php if($this->settings['LetterStatus']==1 && $this->user['mLetterStatus']==1){ //总开关为1，用户配置为1则开启   ?> 
		  <input type="button" value="已发" onclick="window.location.href='/index.php/box/send'" class="formCheck" />
		  <input type="button" value="发信息" onclick="window.location.href='/index.php/box/write'" class="formCheck" />
		  <?php } ?>
		  </div>
    </form>
    </div>
  <div class="biao-cont">
    	<!--下注列表-->
        <?php $this->display('box/searchReceive.php'); ?>
        <!--下注列表 end -->
    </div>
	<div class="boxdetail"> </div>
<?php $this->display('inc_root.php'); ?>

</div></div></div></div></div>
<?php $this->display('inc_che.php'); ?>