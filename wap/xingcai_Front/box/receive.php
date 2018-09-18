<?php $this->display('inc_daohang1.php'); ?>
<script type="text/javascript" src="/js/nsc_m/res.js?v=1.16.12.4"></script>
   <section class="wraper-page">
</head>

<script type="text/javascript">
function deleteBet(err, data){
	if(err){
		xingcai(err);
	}else{
		xingcai('删除成功');
	}
}
$.ajax({
type:'post',//可选get
url:'/index.php/box/searchReceive',//这里是接收数据的PHP程序
data:'data',//传给PHP的数据，多个参数用&连接
dataType:'text',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
success:function(msg){
//这里是ajax提交成功后，PHP程序返回的数据处理函数。msg是返回的数据，数据类型在dataType参数里定义！
},
error:function(){
}
})
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
		xingcai("请选择需要删除的消息！");	
		return false;
	}
}
function boxSend(err, data){
	if(err){
		xingcai(err);
		$("#vcode").trigger("click");
	}else{
		$.alert(data);
		this.reset();
		reload();
	}
}
</script>
<script type="text/javascript">
function boxSearch(err, data){
	if(err){
		xingcai(err);
	}else{
		$('.fadeInRight').html(data);
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
</style> 
<section class="wraper-page">
<div class="ibox-title">
<h5>消息管理 <small></small></h5>
</div>
<body class="gray-bg">
    <div class="wrapper wrapper-content">
	<form action="/index.php/box/searchReceive" datatype="html" call="boxSearch" target="ajax">
        <div class="row">
            <div class="mail-box-header">
                <div class="ibox float-e-margins">
                    <div class="ibox-content mailbox-content">
                        <div class="file-manager">
						  <?php if($this->settings['LetterStatus']==1 && $this->user['mLetterStatus']==1){ //总开关为1，用户配置为1则开启   ?> 
                            <a class="btn btn-block btn-primary compose-mail" href="/index.php/box/write">写信</a>
							  <?php } ?>
                            <div class="space-25"></div>
                            <h5>文件夹</h5>
                            <ul class="folder-list m-b-md" style="padding: 0">
                                <li>
                                    <a href="/index.php/box/receive"> <i class="fa fa-inbox "></i> 收件箱 <span class="label label-warning pull-right"><?php $this->display('index/inc_msg.php');?></span>
                                    </a>
                                </li>
								<?php if($this->settings['LetterStatus']==1 && $this->user['mLetterStatus']==1){ //总开关为1，用户配置为1则开启   ?> 
                                <li>
                                    <a href="/index.php/box/send"> <i class="fa fa-envelope-o"></i> 已发</a>
                                </li>
								<?php } ?>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="mail-box-header">
					<div class="input-group">
						<div class="input-append input-group">					
						<span class="input-group-btn">	
						<button class="btn btn-white" type="button">查询类型</button>	
						</span>				
					
					  <select id="methodid"  name="state" class="btn btn-white">
							<option value="3" selected>所有</option>
							<option value="2">已读</option>
							<option value="1">未读</option>
						</select>
						</div>         
							<div class="input-group-btn">
							 <input type="submit" value="查询" class="btn btn-sm btn-primary" style="margin-right:10px;"/>
							 
							  <a href="/index.php/box/delete/" dataType="json" class="removeAllRecord" onajax="recordBeforeDelete" call="deleteBet" target="ajax"><input name="delall" class="btn btn-sm btn-primary" type="button" value="删 除" /></a>
							</div>
    </form>
                    </div>
                </div>
				<div class="animated fadeInRight">
                <?php $this->display('box/searchReceive.php'); ?>
            </div>
        </div>
    </div>

</body>

</html>
