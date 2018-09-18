<?php $this->display('inc_daohang1.php'); ?>
<script type="text/javascript" src="/js/nsc_m/res.js?v=1.16.12.4"></script>
<link rel="stylesheet" href="/css/nsc/list.css?v=1.16.11.5" />
   <section class="wraper-page">
</head>
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
		xingcai(err);
		$("#vcode").trigger("click");
	}else{
		xingcai(data);
		this.reset();
	}
}
</script>

<style type="text/css"> 
.wraper-page {
    padding-top: 1.5rem;
}
.ibox-content {
    background-color: #ffffff;
    color: inherit;
    padding:0; 
    border-color: #e7eaec;
    -webkit-border-image: none;
    -o-border-image: none;
    border-image: none;
    border-style: solid solid none;
    border-width: 1px 0px;
}
.ibox {
    clear: both;
   margin-bottom: 0px; 
    margin-top: 0;
    padding: 0;
}
.huiyuan ul li {
    height: 25px;
    line-height: 25px;
    float: left;
    display: inline;
    width: 150px;
	
}
</style> 
	
		

<section class="wraper-page">


        <div class="row">
		   <form action="/index.php/box/dowrite" method="post" target="ajax" onajax="boxBeforSend" call="boxSend">
            <div class="col-sm-3">
               <div class="col-sm-9 animated fadeInRight">
                <div class="mail-box-header">
                    <div class="pull-right tooltip-demo">
                       
                        <a class="btn btn-danger btn-sm" onclick="checkbackspace();" title="放弃"><i class="fa fa-times"></i> 放弃</a>
                    </div>
                    <h2>写信</h2>
                </div>
                <div class="mail-box">


                    <div class="mail-body">

                     
                            <div class="form-group">
                                <label class="col-sm-2 control-label">发送给：</label>

                                <div class="col-sm-10">
                                  <div class="item_right">
							<div class="switch_choose" style="padding-bottom:25px;">
											<input type="radio" name="touser" id="utype1" value="parent" checked="checked" title="上级代理">
											<label class="bk_l active1" for="utype1">上级代理</label>
											<input type="radio" name="touser" id="utype2" value="children" title="下级会员">
											<label class="bk_r" for="utype2">下级会员</label>
											</div>
							</div>
							<div class="form_item clearfix">
							<div class="item_right entry_two">
								<input name="users" id="users" value="" type="hidden">
							</div>
							<div class="huiyuan" id="memberList" style="display:none;background:#FFF; width:342px;height:100px; overflow:auto">
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
									</div>
                          
						  </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">主题：</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" value="">
                                </div>
                            </div>
                      

                    </div>
	<label class="col-sm-2 control-label">内容：</label>
                    <div class="mail-text h-200">
				
                    <textarea name="content" class="note-editable" style="width:100%;height:200px;"></textarea> 
					</div>
				
                        <div class="clearfix"></div>
						
                    </div>
				<div class="form_item clearfix">
		
		<div class="item_right entry_two" style="margin-bottom: 10px;margin-top: -10px;text-align: center;">
		<span class="item_left">验证码：</span>
		<input name="vcode" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9]/,'');}).call(this)" onblur="this.v();" maxlength="4" type="text" class="text" style="ime-mode: disabled; width: 120px;" placeholder="请输入验证码">
		<img width="60" height="30" border="0" id="vcode" align="absmiddle" src="/index.php/user/vcode/<?=$this->time?>" onclick="this.src='/index.php/user/vcode/'+(new Date()).getTime()"/>
		</div>
	</div>
                    <div class="mail-body text-right tooltip-demo">
					<input class="btn btn-sm btn-primary" id="addmenber" type="submit" value="发送">
                    
                    </div>
					  
                    <div class="clearfix"></div>
                </div>
            </div>
			</form>
			</div>
<script type="text/javascript">
		//radio选择样式
        $(".switch_choose input[type=radio]").click(function(){
	        if($(".switch_choose input[type=radio]:checked").val()){
	       		$(this).next('label').addClass('active1').siblings().removeClass('active1');
	       	}
        })
</script>