<link rel="stylesheet" href="/css/layui/css/layui.css"  media="all">
<script type="text/javascript" src="/skin/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/skin/layer/layer.js"></script>
<?php 
	$sql="select * from {$this->prename}links where lid=?";
	$linkData=$this->getRow($sql, $args[0]);
	
	if($linkData['uid']){
		$parentData=$this->getRow("select fanDian, username from {$this->prename}members where uid=?", $linkData['uid']);
	}else{
		$this->getSystemSettings();
		$parentData['fanDian']=$this->settings['fanDianMax'];
	}

?>
<form action="/index.php/team/linkDeleteed" target="ajax" method="post" call="delLink" class="layui-form layui-form-pane" onajax="linkDataBeforeSubmitDelete" dataType="html">
	<input type="hidden" name="lid" value="<?=$args[0]?>"/>
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
    <label class="layui-form-label">加入时间：</label>
    <div class="layui-input-inline">
      <input type="text" name="username" readonly="readonly" value="<?=date("Y-m-d H:i:s",$linkData['regTime'])?>" readonly="readonly" class="layui-input">
    </div>
  </div>
        <div class="layui-form-mid layui-word-aux" style="text-align: center;">
		<input class="layui-btn layui-btn-danger" type="submit" value="删除" onClick="dataAddCode();return false"/>
		</div>
        

</form>

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
function dataAddCode(){
		layer.open({
                content:'注册链接删除成功',
                btn:['确定'],
                yes:function(){                 
				$.post('/index.php/team/linkDeleteed',{lid:<?=$args[0]?>})			
				window.parent.location.reload();
                }
            })
	}
</script>