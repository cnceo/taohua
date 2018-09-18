<?php $this->display('inc_daohang.php'); ?>

<div id="nsc_subContent" style="border:0">

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
<script type="text/javascript" src="/js/nsc/jquery-1.7.min.js?v=1.16.11.5"></script>
<script type="text/javascript" src="/js/nsc/main.js?v=1.16.11.5"></script>
<script type="text/javascript" src="/js/nsc/dialogUI/jquery.dialogUI.js?v=1.16.11.5"></script>
<link href="/css/nsc/plugin/dialogUI/dialogUI.css?v=1.16.11.5" media="all" type="text/css" rel="stylesheet" />

</head>
<body>

<div id="subContent_bet_re">
<!--消息框代码开始-->
<script src="/js/jqueryui/ui/jquery.ui.core.js?v=1.16.11.5"></script>
<script src="/js/jqueryui/ui/jquery.ui.widget.js?v=1.16.11.5"></script>
<script src="/js/jqueryui/ui/jquery.ui.tabs.js?v=1.16.11.5"></script>
<script language="javascript" type="text/javascript" src="/js/common/jquery.md5.js?v=1.16.11.5"></script>
<script type="text/javascript" src="/js/keypad/jquery.keypad.js?v=1.16.11.5"></script>
<link rel="stylesheet" type="text/css" media="all" href="/js/keypad/keypad.css?v=1.16.11.5"  />
<!--消息框代码结束-->
<script type="text/javascript">
$(function(){
	$('input[name=touser]').live("click",function(){
		var val=$(this).val();
		if(val=='children'){
			$("#memberList").show();
		}else{
			$("#memberList").hide();
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
function boxBeforSend(){
	var touser=$('[name=touser]:checked',this).val(),byid="",
	    a=document.getElementsByName("chk_only");
	for(var i=0,len=a.length;i<len;i++){
		if(a.item(i).checked){
		if(byid.length >0){
			byid=byid + "," + a.item(i).value;
			}
		else{
			byid=byid + a.item(i).value;
		   }
	   }
	}
	if(!touser)  throw('请选择收件人');
	if(touser=='children' && byid.length<1)  throw('请选择直属下级会员');
	if(!this.title.value) throw('请输入主题');
	if(!this.content.value) throw('请输入内容');
	if(!this.vcode.value) throw('请输入验证码');
	if(this.vcode.value<4) throw('验证码至少4位');
	this.users.value=byid;
}
function boxSend(err, data){
	if(err){
		$.alert(err);
		$("#vcode").trigger("click");
	}else{
		$.alert(data);
		this.reset();
	}
}
</script>
<div id="changeloginpass">
	
		<ul class="menus-li">
		
			<li class="on"><a href="/index.php/box/receive" style="color: #FFF;">已收信息</a></li>
			
	       <li class="on"><a href="/index.php/box/send" style="color: #FFF;">已发信息</a></li>
					
	        		</ul>
	<div class="form_switch_main">
		<form action="/index.php/box/dowrite" method="post" target="ajax" onajax="boxBeforSend" call="boxSend">

		<div class="form_switch_head">
	<div class="form_item clearfix">
		<span class="item_left">用户类型：</span>
		<div class="item_right">
			<div class="switch_choose">
			<input type="radio" name="touser" id="utype1" value="parent" checked="checked" title="上级代理">
			<label class="bk_l active" for="utype1">上级代理</label>
			<input type="radio" name="touser" id="utype2" value="children" title="下级会员">
			<label class="bk_r" for="utype2">下级会员</label>
			</div>
		</div>
	</div>
	
	
	
	<div class="form_item clearfix">
		
		<div class="item_right entry_two">
		
		       <input name="users" id="users" value="" type="hidden">
            </div>
            <div class="huiyuan" id="memberList" style="display:none;">
            	<h4><input id="chk_All" value="All" name="chk_All" type="checkbox"> 直属下级会员</h4>
            	<ul>
				<?php
                    $sql="select uid, username from {$this->prename}members where parentId=?";
	                $data=$this->getRows($sql,$this->user['uid']);
					$sql2="select * from blast_member_session where uid=? order by id desc limit 1";
					foreach($data as $var){ 
						$login=$this->getRow($sql2, $var['uid']);
					?>
					    <li><label><input value="<?=$var['uid']?>" name="chk_only" type="checkbox"><?=$var['username']?>[<?=$this->iff($login['isOnLine'] && ceil(strtotime(date('Y-m-d H:i:s', time()))-strtotime(date('Y-m-d H:i:s',$login['accessTime'])))<$GLOBALS['conf']['member']['sessionTime'], '<font color="#FF0000">在线</font>', '离线')?>]</label></li>
					<?}?>
                </ul>
            </div>
	
		</div>
	
	
	
	
	
	
	<div class="form_item clearfix">
		<span class="item_left">主题：</span>
		<div class="item_right entry_two">
		<input type="text" name="title" value=""  placeholder="主题" style="width: 500px;">
		</span>
		</div>
	</div>
	
	<div class="form_item clearfix">
		<span class="item_left">内容：</span>
		<div class="item_right entry_two">
		<textarea name="content" class="txt2"></textarea>
		</div>
	</div>
	<div class="form_item clearfix">
		<span class="item_left">验证码：</span>
		<div class="item_right entry_two">
		<input name="vcode" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9]/,'');}).call(this)" onblur="this.v();" maxlength="4" type="text" class="text4" style="ime-mode: disabled; width: 120px;" placeholder="请输入验证码"><img width="58" height="24" border="0" style="cursor:pointer;margin-bottom:0px;" id="vcode" alt="看不清？点击更换" align="absmiddle" src="/index.php/user/vcode/<?=$this->time?>" title="看不清楚，换一张图片" onclick="this.src='/index.php/user/vcode/'+(new Date()).getTime()"/>
		</div>
	</div>


<div class="form_submit_box">
	<input class="button" id="addmenber" type="submit" value="发送">
	<p id="linkTip" style="color:#f00; margin-top:5px; position:absolute; top:55px; left:333px;">恶意发短信将永久冻结帐号！</p>
</div>
</div>

</form>

		
		
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