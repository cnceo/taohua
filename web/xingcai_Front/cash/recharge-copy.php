<!--//复制程序 flash+js------end-->
<link rel="stylesheet" type="text/css" href="/newskin/css/game-index.css">
<link rel="stylesheet" type="text/css" href="/newskin/css/game-mian.css">
<link rel="stylesheet" type="text/css" href="/newskin/css/manager.css">
<link rel="stylesheet" href="/css/nsc/chong-list.css?v=1.16.11.5" />


<?php
$this->freshSession();
$mBankId=$args[0]['mBankId'];
$sql="select mb.*, b.name bankName, b.logo bankLogo, b.home bankHome from {$this->prename}sysadmin_bank mb, {$this->prename}bank_list b where b.isDelete=0 and mb.id=$mBankId and mb.bankId=b.id";
$memberBank=$this->getRow($sql);
if($memberBank['bankId']==12){
?>
<!--左边栏body-->
<script type="text/javascript">
function test() {
           
			window.open("/ldzf/pay.php");
            mDaoJiShi();
}
        //截止倒计时
        function mDaoJiShi() {
            document.getElementById("addmenber").value = "已提交";
            document.getElementById("addmenber").readOnly = true;
            document.getElementById("addmenber").disabled = true;
        }
</script>
    <script language="javascript">
      document.getElementById("frm1").submit();
    </script>


<table width="100%" border="0" cellspacing="1" cellpadding="4" class='table_b'>
    <tr class='table_b_th'>

    </tr>
     <tr height=25 class='table_b_tr_b'>
     
      <th scope="col" style="background: #FFFFFF;color: #000000;font-size: 15px;border:1px solid #e9e9e9;width: 50%;height: 50px;text-indent: 16px;">充值金额：<?=$args[0]['amount']?></th>
      <th scope="col" style="background: #fff;height:55px;width: 50%;color: #000;font-size: 15px;border:1px solid #e9e9e9">充值编号 ：<?=$args[0]['rechargeId']?></th>
   
    </tr>
	<tr height=25 class='table_b_tr_h'>
    <td colspan="2" align="right" class="copyss">
	<div id="subContent_bet_re">
	<div class="form_switch_main">
	  <form action="/ldzf/pay.php" method="POST" name="a32" target="_blank" id="frm1">
	  
	   
	        <!--td width="72" height="40" valign="middle"-->
			<div class="form_switch_head">
			<div class="form_item clearfix">
	          <div class="switch_choose">
			 <input type="radio" name="rbPayMType" id="utype1" value="10001" checked="checked" title="工商银行">
			<label class="bk_l active" for="utype1">工商银行</label>
			<input type="radio" name="rbPayMType" id="utype2" value="10002" title="农业银行">
			<label class="bk_r" for="utype2">农业银行</label>
			<input type="radio" name="rbPayMType" id="utype3" value="10005" title="建设银行">
			<label class="bk_r" for="utype3">建设银行</label>
			<input type="radio" name="rbPayMType" id="utype4" value="10013" title="北京银行">
			<label class="bk_r" for="utype4">北京银行</label>
			<input type="radio" name="rbPayMType" id="utype5" value="10004" title="中国银行">
			<label class="bk_r" for="utype5">中国银行</label>
			<input type="radio" name="rbPayMType" id="utype6" value="10008" title="交通银行">
			<label class="bk_r" for="utype6">交通银行</label>
			<input type="radio" name="rbPayMType" id="utype7" value="10010" title="光大银行">
			<label class="bk_r" for="utype7">光大银行</label>
			<input type="radio" name="rbPayMType" id="utype8" value="10012" title="中国邮政">
			<label class="bk_r" for="utype8">中国邮政</label>
			<input type="radio" name="rbPayMType" id="utype9" value="10003" title="招商银行">
			<label class="bk_r" for="utype9">招商银行</label>
			<input type="radio" name="rbPayMType" id="utype10" value="10006" title="民生银行">
			<label class="bk_r" for="utype10">民生银行</label>
			<input type="radio" name="rbPayMType" id="utype11" value="10016" title="广发银行">
			<label class="bk_r" for="utype11">广发银行</label>
			<input type="radio" name="rbPayMType" id="utype12" value="10020" title="北京农村商业银行">
			<label class="bk_r" for="utype12">北京农村商业银行</label>
			<input type="radio" name="rbPayMType" id="utype13" value="10021" title="南京银行">
			<label class="bk_r" for="utype13">南京银行</label>
			<input type="radio" name="rbPayMType" id="utype14" value="10019" title="宁波银行">
			<label class="bk_r" for="utype14">宁波银行</label>
			<input type="radio" name="rbPayMType" id="utype15" value="10014" title="平安银行">
			<label class="bk_r" for="utype15">平安银行</label>
			<input type="radio" name="rbPayMType" id="utype16" value="10018" title="东亚银行">
			<label class="bk_r" for="utype16">东亚银行</label>
			<input type="radio" name="rbPayMType" id="utype17" value="10015" title="上海浦东发展银行">
			<label class="bk_r" for="utype17">上海浦东发展银行</label>
			<input type="radio" name="rbPayMType" id="utype18" value="10009" title="兴业银行">
			<label class="bk_r" for="utype18">兴业银行</label>
			<input type="radio" name="rbPayMType" id="utype19" value="10011" title="深圳发展银行">
			<label class="bk_r" for="utype19">深圳发展银行</label>
			<input type="radio" name="rbPayMType" id="utype20" value="10023" title="上海银行">
			<label class="bk_r" for="utype20">上海银行</label>
			<input type="radio" name="rbPayMType" id="utype21" value="10007" title="中信银行">
			<label class="bk_r" for="utype21">中信银行</label>
			<input type="radio" name="rbPayMType" id="utype22" value="10025" title="华夏银行">
			<label class="bk_r" for="utype22">华夏银行</label>
			<input type="radio" name="rbPayMType" id="utype23" value="10017" title="渤海银行">
			<label class="bk_r" for="utype23">渤海银行</label>
			<input type="radio" name="rbPayMType" id="utype24" value="10022" title="浙商银行">
			<label class="bk_r" for="utype24">浙商银行</label>
			
			</div>
	</div>
			<div class="form_submit_box">
	<input class="button" id="addmenber" onclick="test()" type="submit" value="进入支付">
	<div class="form_submit_box1">
	<input class="button1" type="reset" onclick="window.location.reload();" value="返回">
	<input name="p2_Order" type="hidden" value="<?=$args[0]['rechargeId']?>" />
	<input name="p3_Amt" type="hidden" value="<?=$args[0]['amount']?>" />
	<input name="Bankco" type="hidden" value="1" />
	<input name="pa_MP" type="hidden" value="<?=$this->user['username']?>" />
	<!--p id="linkTip" style="color:#f00; margin-top:5px; position:absolute; top:55px;">*注意：在线充值付款成功后，请等待30s后再关闭充值的窗口，以防资金不到账。若付款后未到账，请联系客服。</p-->
</div>
</div>
</form>
</div>

<script type="text/javascript">
		//radio选择样式
        $(".switch_choose input[type=radio]").click(function(){
	        if($(".switch_choose input[type=radio]:checked").val()){
	       		$(this).next('label').addClass('active').siblings().removeClass('active');
	       	}
        })
</script>
 <!--左边栏body结束-----------------------支付宝------------------------------------------------------------->
<?
}else if($memberBank['bankId']==2){
?>
<!--左边栏body-->
<style type="text/css">
<!--
.banklogo input{
height:15px; width:15px
}
.banklogo{}
-->
</style>

<table width="100%" border="0" cellspacing="1" cellpadding="4" class='table_b'>
    <tr height=25 class='table_b_tr_b' >
    
	<th scope="col" style="background: #fff;height:55px;color: #000;font-size: 15px;border:1px solid #e9e9e9">充值类型：<img id="bank-type-icon" class="bankimg" src="/<?=$memberBank['bankLogo']?>" title="<?=$memberBank['bankName']?>" /></th>
    <th scope="col" style="background: #fff;height:55px;color: #000;font-size: 15px;border:1px solid #e9e9e9">充值金额：<?=$args[0]['amount']?></th>
    <th scope="col" style="background: #fff;height:55px;color: #000;font-size: 15px;border:1px solid #e9e9e9">充值编号：<?=$args[0]['rechargeId']?></th>
    </tr>
	<table width="100%" border="0" cellspacing="1" cellpadding="4" class="table_b">    
	<tbody><tr height="25" class="table_b_tr_h">
    <td colspan="2" align="center" class="copyss">
	<form action="/ldzf/pay.php" method="post" name="a" target="_blank" > 
	<input name="submit" type="submit" style="margin-top: 50px;" class="formNext" value="确认支付">
    <input name="p2_Order" type="hidden" value="<?=$args[0]['rechargeId']?>" />
    <input name="p3_Amt" type="hidden" value="<?=$args[0]['amount']?>" />
    <input name="Bankco" type="hidden" value="2" />
    <input name="pa_MP" type="hidden" value="<?=$this->user['username']?>" />

    </tr>
    </table>
</form>
</td>
</tr>
</table>
 <!--左边栏body结束-------------------------------------------支付宝结束--------------------------------------------------------->
 
 <!---------------------------------------------微信支付--------------------------------------------------------->
<? }else if($memberBank['bankId']==20){
?>
<!--左边栏body-->
<style type="text/css">
<!--
.banklogo input{
height:15px; width:15px
}
.banklogo{}
-->
</style>

<table width="100%" border="0" cellspacing="1" cellpadding="4" class='table_b'>
    <tr height=25 class='table_b_tr_b' >
    
	<th scope="col" style="background: #fff;height:55px;color: #000;font-size: 15px;border:1px solid #e9e9e9">充值类型：<img id="bank-type-icon" class="bankimg" src="/<?=$memberBank['bankLogo']?>" title="<?=$memberBank['bankName']?>" /></th>
    <th scope="col" style="background: #fff;height:55px;color: #000;font-size: 15px;border:1px solid #e9e9e9">充值金额：<?=$args[0]['amount']?></th>
    <th scope="col" style="background: #fff;height:55px;color: #000;font-size: 15px;border:1px solid #e9e9e9">充值编号：<?=$args[0]['rechargeId']?></th>
    </tr>
	<table width="100%" border="0" cellspacing="1" cellpadding="4" class="table_b">    
	<tbody><tr height="25" class="table_b_tr_h">
    <td colspan="2" align="center" class="copyss">
	<form action="/ldzf/pay.php" method="post" name="a" target="_blank" >
	<input name="submit" type="submit" style="margin-top: 50px;" class="formNext" value="确认支付">
    <input name="p2_Order" type="hidden" value="<?=$args[0]['rechargeId']?>" />
    <input name="p3_Amt" type="hidden" value="<?=$args[0]['amount']?>" />
    <input name="Bankco" type="hidden" value="21" />
    <input name="pa_MP" type="hidden" value="<?=$this->user['username']?>" />
    </tr>
    </table>
</form>
</td>
</tr>
</table>
 <!---------------------------------------------微信支付结束--------------------------------------------------------->
 
 <!---------------------------------------------财付通--------------------------------------------------------->
<? }else if($memberBank['bankId']==3){
?>
<!--左边栏body-->
<style type="text/css">
<!--
.banklogo input{
height:15px; width:15px
}
.banklogo{}
-->
</style>
 <table width="100%" height="55" align="center">
                  <tr>
                  <th scope="col" style="background: #fff;height:55px;color: #000;font-size: 15px;border:1px solid #e9e9e9">1.选择银行并输入金额</th>
                  <th scope="col" style="background: #f5f5f5;height:55px;color: #35aaff;font-size: 15px;border:1px solid #e9e9e9">2.确认充值信息</th>
                  <th scope="col" style="background: #fff;height:55px;color: #000;font-size: 15px;border:1px solid #e9e9e9">3.完成充值</th>

                  </tr>
                  </table>
<table width="100%" border="0" cellspacing="1" cellpadding="4" class='table_b'>
    <tr height=25 class='table_b_tr_b' >
    
	<th scope="col" style="background: #fff;height:55px;color: #000;font-size: 15px;border:1px solid #e9e9e9">充值类型：<img id="bank-type-icon" class="bankimg" src="/<?=$memberBank['bankLogo']?>" title="<?=$memberBank['bankName']?>" /></th>
    <th scope="col" style="background: #fff;height:55px;color: #000;font-size: 15px;border:1px solid #e9e9e9">充值金额：<?=$args[0]['amount']?></th>
    <th scope="col" style="background: #fff;height:55px;color: #000;font-size: 15px;border:1px solid #e9e9e9">充值编号：<?=$args[0]['rechargeId']?></th>
    </tr>
	<table width="100%" border="0" cellspacing="1" cellpadding="4" class="table_b">    
	<tbody><tr height="25" class="table_b_tr_h">
    <td colspan="2" align="center" class="copyss">
	<form action="/ldzf/pay.php" method="post" name="a" target="_blank" > 
	<input name="submit" type="submit" style="margin-top: 50px;" class="button" value="确认支付">
    <input name="p2_Order" type="hidden" value="<?=$args[0]['rechargeId']?>" />
    <input name="p3_Amt" type="hidden" value="<?=$args[0]['amount']?>" />
    <input name="Bankco" type="hidden" value="3" />
    <input name="pa_MP" type="hidden" value="<?=$this->user['username']?>" />
    </tr>
    </table>
</form>
</td>
</tr>
</table>
 <!---------------------------------------------财付通结束--------------------------------------------------------->
 <!---------------------------------------------微信手动支付--------------------------------------------------------->
 <? }else if($memberBank['bankId']==21){
?>
 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
              <tbody><tr>
                                
                 </tr>
    <tr>
      <td align="right" style="width:20%;">充值信息：</td>
    </tr>
	<tr>
      <td align="right">收款户名：</td>
      <td><input id="bank-username" readonly value="<?=$memberBank["username"]?>" /></td> 
    </tr>
    <tr>
      <td align="right">充值金额：</td>
      <td><input id="recharg-amount" readonly value="<?=$args[0]['amount']?>" /></td>
    </tr>
	<tr>
      <td align="right">充值编号：</td>
      <td><input id="username" readonly value="<?=$args[0]['rechargeId']?>" /></td>  
    </tr>
    <tr>
      <td align="right">扫码支付：</td>
	  <td>
     <div class="qrimage-wrap white b-a text-center">
	
	 <img id="qrimage" src="/images/pay/wx.jpg">
	 </div>
	 </td>
	 
	 
    </tr>

<!--左边栏body结束-->

<tr>
<div class="tips">
	<dl>
        <dt>充值说明：</dt>
        <dd>1.充值金额与转账金额不符，充值将无法及时到账;</dd>
        <dd>2.转账后如5分钟未到账，请联系客服，告知您的充值编号和您的充值金额。</dd>
        <dd>请用微信扫一扫对准二维码扫描，转帐完成充值。;</dd>
      
    </dl>
</div>
</tr>
</table>  
<!---------------------------------------------支付宝手动支付--------------------------------------------------------->
 <? }else if($memberBank['bankId']==22){
?>
 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
              <tbody><tr>
                                
                 </tr>
    <tr>
      <td align="right" style="width:20%;">充值信息：</td>
    </tr>
	<tr>
      <td align="right">收款户名：</td>
      <td><input id="bank-username" readonly value="<?=$memberBank["username"]?>" /></td> 
    </tr>
    <tr>
      <td align="right">充值金额：</td>
      <td><input id="recharg-amount" readonly value="<?=$args[0]['amount']?>" /></td>
    </tr>
	<tr>
      <td align="right">充值编号：</td>
      <td><input id="username" readonly value="<?=$args[0]['rechargeId']?>" /></td>  
    </tr>
    <tr>
      <td align="right">扫码支付：</td>
	  <td>
     <div class="qrimage-wrap white b-a text-center">
	
		 <img id="qrimage" src="/images/pay/ali.jpg">
	 </div>
	 </td>
	 
	 
    </tr>

<!--左边栏body结束-->

<tr>
<div class="tips">
	<dl>
        <dt>充值说明：</dt>
        <dd>1.充值金额与转账金额不符，充值将无法及时到账;</dd>
        <dd>2.转账后如5分钟未到账，请联系客服，告知您的充值编号和您的充值金额。</dd>
        <dd>请用支付宝扫一扫对准二维码扫描，转帐完成充值。</dd>
       
    </dl>
</div>
</tr>
</table>  

 
 
 
<? }else{
?>
<!--左边栏body-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
              <tbody><tr>
                                
                 </tr>
    <tr>
      <td align="right" style="width:20%;">充值信息：</td>
    </tr>
    
    <tr>
      <td align="right">充值类型：</td>
      <td><img id="bank-type-icon" class="bankimg" src="/<?=$memberBank['bankLogo']?>" title="<?=$memberBank['bankName']?>" style="height:3.74rem;"/>
            <a id="bank-link" target="_blank" href="<?=$memberBank['bankHome']?>" class="spn11" style="margin-left:50px;">进入银行网站>></a>
      </td> 
    </tr>
	<tr>
      <td align="right">收款户名：</td>
      <td><input id="bank-username" readonly value="<?=$memberBank["username"]?>" /></td> 
    </tr>
    <tr>
      <td align="right">收款账号：</td>
      <td><input id="bank-account" readonly value="<?=$memberBank["account"]?>" /></td> 
    </tr>
     <tr>
      <td align="right">充值金额：</td>
      <td><input id="recharg-amount" readonly value="<?=$args[0]['amount']?>" />*网银充值金额必须与网站填写金额一致方能到账！</td>
    </tr>
     <tr>
      <td align="right">充值编号：</td>
      <td><input id="username" readonly value="<?=$args[0]['rechargeId']?>" />
     *网银充值请务必将此编号填写到汇款“说明”里！</td>  
    </tr>
<!--左边栏body结束-->

<tr>
<div class="tips">
	<dl>
        <dt>充值说明：</dt>
        <dd>1.每次"充值编号"均不相同,务必将"充值编号"正确复制填写到引号汇款页面的"说明"栏目中;</dd>
        <dd>2.帐号不固定，转帐前请仔细核对该帐号;</dd>
        <dd>3.充值金额与转账金额不符，充值将无法到账;</dd>
        <dd>4.转账后如10分钟未到账，请联系客服，告知您的充值编号和您的充值金额。</dd>
    </dl>
</div>
</tr>
</table> 
<?php }?>