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
<li class="current"><a href="/index.php/cash/card" >点卡充值</a></li>
</ul>
</div>
<link rel="stylesheet" href="/css/nsc/reset.css?v=1.16.11.5" />
<link rel="stylesheet" href="/css/nsc/list.css?v=1.16.11.5" />
<link rel="stylesheet" href="/css/nsc/activity.css?v=1.16.11.5" />


</head>
<body>
<script type="text/javascript">
$(function(){
	$('form').trigger('reset');
});

function checkRecharge(){
	if(!this.amount.value) throw('请填写卡密');
}
function userAddCard(err, data){
	if(err){
		xingcai(err);
	}else{
		xingcai('充值成功');
		this.reset();
	}
}
</script>
<div id="subContent_bet_re">
<!--消息框代码开始-->

<form action="/index.php/cash/yanzheng" method="post" target="ajax" onajax="checkRecharge" dataType="html" call="userAddCard">
<div class="commonality_drawings_password">
    <div class="pd_left">
    <h5>请输入充值的卡密：</h5>
    <div class="commonality_drawings_password_input">
	<input type="text" name="amount" id="amount" class="password hasKeypad">
    </div>
    </div>
    <div class="list_btn_box"><input name="" type="submit" value="提交" onclick="" class="formSubmit">
        <input name="" type="reset" value="重置" class="formReset" onclick="this.form.reset()"></div>
</div>

</form>


</div>
</div>

<?php $this->display('inc_che.php'); ?>
 </body>
 </html>