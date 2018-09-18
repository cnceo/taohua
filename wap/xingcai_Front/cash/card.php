<?php $this->display('inc_daohang1.php'); ?>
<link rel="stylesheet" href="/css/nsc_m/list.css?v=1.16.11.16">
<script type="text/javascript" src="/js/nsc_m/res.js?v=1.16.12.4"></script>
 <?php $this->freshSession(); 
		//更新级别
		$ngrade=$this->getValue("select max(level) from {$this->prename}member_level where minScore <= {$this->user['scoreTotal']}");
		if($ngrade>$this->user['grade']){
			$sql="update blast_members set grade={$ngrade} where uid=?";
			$this->update($sql, $this->user['uid']);
		}else{$ngrade=$this->user['grade'];}
		
		$date=strtotime('00:00:00');
?>

<script type="text/javascript">
$(function(){
	$('form').trigger('reset');
});

function checkRecharge(){
	if(!this.amount.value) throw('请填写卡密');
}
function userAddCard(err, data){
	if(err){
		xingcai(err,"err");
	}else{
		xingcai('充值成功',"ok");
		this.reset();
	}
}
</script>
 <section class="wraper-page">
<div id="changeloginpass">
<div id="tabs">
<ul class="list_menus-li">
	<li class="on">在线卡密充值</li>
</ul>
<div id="tabs-1">
<form action="/index.php/cash/yanzheng" method="post" target="ajax" onajax="checkRecharge" dataType="html" call="userAddCard">
<ul class="form_enter_ul">
<li>
<label class="w1">请输入卡密：</label>
<div class="form_li-r w_r1">
<div class="enter_input_kuang1">
<input type="text" name="amount" id="amount">
</div>
</div>
</li>
</ul>
	    
<div class="list_btn_box">
<input type="reset" id="resetcz" value="重置" class="formReset">
<input id="setcz" type="submit" value="充值" class="formChange">
</div>
<div class="list_page">备注：请输入需要充值的卡密，正确卡密为十位数！</div>
</form>
</div>

</div>
</div>
</section>
</body></html>