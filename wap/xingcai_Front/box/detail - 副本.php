<?php $this->display('inc_daohang1.php'); ?>
<script type="text/javascript" src="/js/nsc_m/res.js?v=1.16.12.4"></script>
   <section class="wraper-page">
</head>
<script type="text/javascript">
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
                    <!--div class="pull-right tooltip-demo">
                        <a href="/index.php/box/delete/<?=$var['mid']?>" dataType="json" class="btn btn-white btn-sm" onajax="recordBeforeDelete1" call="deleteBet" target="ajax" ><i class="fa fa-trash-o"></i> </a>
                    </div-->
                    <h2>查看邮件</h2>
                    <div class="mail-tools tooltip-demo m-t-md">
						<h3><span class="font-noraml">主题： </span><?=$args[0]['title']?></h3>
                        <h5>
                        <!--span class="pull-right font-noraml"><?=date("Y-m-d H:i",$var['time'])?></span-->
                        <span class="font-noraml">发件人： </span><?=$args[0]['from_username']?>
						</h5>
                    </div>
                </div>
                <div class="mail-box">
                    <div class="mail-body">
                        <h4>信息内容：</h4>
                        <p><?=$args[0]['content']?></p>
                        <!--p class="text-right">
                           官方网站
                        </p-->
                    </div>
                <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
