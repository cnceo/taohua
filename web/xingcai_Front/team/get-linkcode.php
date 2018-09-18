<link rel="stylesheet" href="/css/layui/css/layui.css"  media="all">
<script type="text/javascript" src="/skin/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/skin/layer/layer.js"></script>

<div class="layui-form layui-form-pane">
  <?php 
		$sql="select * from {$this->prename}links where lid=?";
		if(!$linkData=$this->getRow($sql, $args[0])){
	?>
	<div class="layui-form-mid layui-word-aux" style="text-align: center;">该注册链接不存在，或者已经失效！</div>
	<?php  
		}else{
			$pd = "select * from {$this->prename}members where uid=?";
			$parentData = $this->getRow($pd, $linkData['uid']);
	?>
         
		<div class="layui-form-item" >
			<label class="layui-form-label">上级会员：</label>
			<div class="layui-input-inline">
			  <input type="text" name="username" readonly="readonly" value="<?=$parentData['username']?>"  class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
    <label class="layui-form-label">返点：</label>
    <div class="layui-input-inline">
      <input type="text" name="username" readonly="readonly" value="<?=$linkData['fanDian']?>%" readonly="readonly" class="layui-input">
    </div>
  </div>
		  <div class="layui-form-item">
			<label class="layui-form-label">推广链接1：</label>
			<div class="layui-input-inline">
			  <input id="biao1" readonly="readonly" value="http://<?=$_SERVER['HTTP_HOST']?>/index.php/user/r/<?=$this->strToHex($this->myxor($linkData['lid']));?>" class="layui-input">
			</div>
			<button class="layui-btn layui-btn-normal" type="button" onClick="copyUrl1()" >复制</button>
		  </div>
		 
		<div class="layui-form-item">
			<label class="layui-form-label">推广链接2：</label>
			<div class="layui-input-inline">
			  <input id="biao2" readonly="readonly" value="http://<?=$_SERVER['HTTP_HOST']?>/index.php/user/r/<?=$this->strToHex($this->myxor($linkData['lid']));?>" class="layui-input">
			</div>
			 <button class="layui-btn layui-btn-danger" type="button" onClick="copyUrl2()">复制</button>
		</div> 
		
      				
     <?php }?>   
</div> 
 


<script language="JavaScript">

function xingcai(tips) {			
	 layer.open({
		zIndex:1999,
		content: tips,
		timeout: 2,
		onyes: true,
		btn:"确定"
	});
		
}
//复制链接1
function copyUrl1(){
var Url2=document.getElementById("biao1");
Url2.select();
document.execCommand("Copy");
xingcai("推广链接1已复制。");
}
//复制链接2
function copyUrl2(){
var Url2=document.getElementById("biao2");
Url2.select();
document.execCommand("Copy");
xingcai("推广链接2已复制。");
}
</script>