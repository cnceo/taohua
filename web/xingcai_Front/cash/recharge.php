 <?php $this->freshSession(); 
		//更新级别
		$ngrade=$this->getValue("select max(level) from {$this->prename}member_level where minScore <= {$this->user['scoreTotal']}");
		if($ngrade>$this->user['grade']){
			$sql="update blast_members set grade={$ngrade} where uid=?";
			$this->update($sql, $this->user['uid']);
		}else{$ngrade=$this->user['grade'];}
		
		$date=strtotime('00:00:00');
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title><?=$this->iff($args[0], $args[0] . '-'). $this->settings['webName']?></title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/css/layui/css/layui.css"  media="all">
    <link rel="stylesheet" href="/skin/css/site.css" />
  <script type="text/javascript" src="/css/layui/layui.js"></script>
  <script type="text/javascript" src="/newskin/js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="/newskin/js/common.js"></script>
  <script type="text/javascript" src="/newskin/js/onload.js"></script>
  <script type="text/javascript" src="/js/nsc/dialogUI/jquery.dialogUI.js?v=1.16.11.5"></script>
<link href="/css/nsc/plugin/dialogUI/dialogUI.css?v=1.16.11.5" media="all" type="text/css" rel="stylesheet" />
</head>
<body>


<table class="topName" width="100%"><tbody><tr><td>
        <div class="bg clearfix">
        	<div id="siderbar">
                <ul class="list clearfix">
                    <li class="current"><a href="/index.php/cash/recharge" >在线充值</a></li>
				<!--	<li class=""><a href="/index.php/cash/recharge3">微信手动充值</a></li>
					<li class=""><a href="/index.php/cash/recharge4">支付宝手动充值</a></li>-->
                </ul>
            </div>

</div>

<div class="recharege-leibie" id="point">
	<?php
			$set=$this->getSystemSettings();
				$sql="select * from {$this->prename}bank_list b, {$this->prename}sysadmin_bank m where m.admin=1 and m.enable=1 and b.isDelete=0 and b.id=m.bankId and b.id not in(1,4,6,21,22)";
				$banks=$this->getRows($sql);	
				if($banks){
				if($this->user['coinPassword']){
				?>
        <div>
        在线充值一 注意事项：<br>
        点击下一步根据提示完成支付，支付成功后一定要等待跳转到商家页面或等待自动跳转，显示充值订单成功后再关闭网页，如未自动到账请复制订单编号联系在线客服核查！
    </div>
        
	<form action="/index.php/cash/inRecharge" method="post" target="ajax" onajax="checkRecharge" call="toCash" dataType="html">
                                
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
              <tbody><tr>
                                
                 </tr>
                <tr>
                <td align="right">充值金额：</td>
                <td><input type="text" name="amount" min="<?=$set['rechargeMin']?>" max="<?=$set['rechargeMax']?>" min1="<?=$set['rechargeMin1']?>" max1="<?=$set['rechargeMax1']?>" value="" id="ContentPlaceHolder1_txtMoney" onkeyup="showPaymentFee();" class="forminputT6"/>
				
				
			
                <span class="red">&nbsp;&nbsp;(单笔充值限额：最低 <span><?=$set['rechargeMin']?></span>,最高 <span><?=$set['rechargeMax']?></span>)
               </span></td>
              </tr>

              <tr>
                <td align="right">充值金额(大写)：</td>
                <td><span class="red" id="chineseMoney"></span></td>
              </tr>
			  
			   <tr>
                <td align="right">验证码：</td>
                <td><input name="vcode" type="text" style="/*ime-mode:disabled;margin-left:6px;width:200px;height:38px;*/" />&nbsp;&nbsp;<img width="80" height="29" id="vcode" alt="看不清？点击更换" align="absmiddle" src="/index.php/user/vcode/<?= $this->time ?>" title="看不清楚，换一张图片" onClick="this.src='/index.php/user/vcode/'+(new Date()).getTime()"/></td>
              </tr>
                          </tbody></table>

                        <style>
           
            </style>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
              <tbody><tr>
                  <td><h3>请选择支付银行</h3></td>
              </tr>
              <tr>
                <td>
                    <ul class="bank-list">
					 <?php	
							$idx = 0;
							if($banks) foreach($banks as $bank){
							if($idx == 0){
							$bnm = $bank['name'];
					} ?>
                       <label><input type="radio" class="xuan" name="mBankId" cname="<?=$bank['name'] ?>" value="<?=$bank['id']?>" <?=$this->iff($idx==0, 'checked', '') ?> data-bank='<?=json_encode($bank)?>'/><img src="/<?=$bank['logo']?>" alt="" style="height:4.74rem;"/></label>
					
                       <?php 
								$idx++;}
							?>
                    </ul>
                </td>
              </tr>
            </tbody></table>
                  
				<div id="2tips" data="0"></div>
		          <div align="center">
				  <input type="submit" name="submit" value="下一步" class="formNext">
				  <input name="" type="button" value="返回" class="formBack" onclick="Suke.common.goBack();">
				  </div>
       
        </form>
</div>
	<?php }else{?>
		<div class="container" style=" width: auto">
			<div id="error">
				<h3 class="title">	
					<font color="#ff0000">您还未设定提款密码，为了您的账户安全，请先设定好您的提款密码</font>
				</h3>
				 <p class="msg_buttom">
					 <a href="/index.php/safe/passwd" target="_top" class="btn btn-red">设定提款密码</a>
				 </p>
			</div>
        </div>
    <?php }?>
      <?php }else{ ?>
        <div class="container" style=" width: auto">
			<div id="error">
				<h3 class="title">	
				<font color="#ff0000">对不起，未开通该银行的充值权限，请使用在线充值或其它银行进行充值。</font>
				</h3>
			</div>
        </div>
     <?php }?>		







