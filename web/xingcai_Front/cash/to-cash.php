 <?php $this->freshSession(); 
		//更新级别
		$ngrade=$this->getValue("select max(level) from {$this->prename}member_level where minScore <= {$this->user['scoreTotal']}");
		if($ngrade>$this->user['grade']){
			$sql="update blast_members set grade={$ngrade} where uid=?";
			$this->update($sql, $this->user['uid']);
		}else{$ngrade=$this->user['grade'];}
		
		$date=strtotime('00:00:00');
?>

<link rel="stylesheet" type="text/css" href="/newskin/css/game-index.css">
<link rel="stylesheet" type="text/css" href="/newskin/css/game-mian.css">
<link rel="stylesheet" type="text/css" href="/newskin/css/manager.css">
<link rel="stylesheet" href="/css/nsc/chong-list.css?v=1.16.11.5" />
<script type="text/javascript" src="/newskin/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/newskin/js/common.js"></script>
<script type="text/javascript" src="/newskin/js/onload.js"></script>
<script type="text/javascript" src="/js/nsc/dialogUI/jquery.dialogUI.js?v=1.16.11.5"></script>
<link href="/css/nsc/plugin/dialogUI/dialogUI.css?v=1.16.11.5" media="all" type="text/css" rel="stylesheet" />
				 <script type="text/javascript">
			function beforeToCash(){
				if(!this.amount.value) throw('请填写提现金额');
				if(!this.amount.value.match(/^[0-9]*[1-9][0-9]*$/)) throw('提现金额错误');
				showPaymentFee()
				var amount=parseInt(this.amount.value);
				if($('input[name=bankId]').val()==2||$('input[name=bankId]').val()==3){
					if(amount<parseFloat(<?=json_encode($this->settings['cashMin1'])?>)) throw('支付宝/财付通提现最小限额为<?=$this->settings['cashMin1']?>元');
					if(amount>parseFloat(<?=json_encode($this->settings['cashMax1'])?>)) throw('支付宝/财付通提现最大限额为<?=$this->settings['cashMax1']?>元');
					showPaymentFee()
				}else{
					if(amount<parseFloat(<?=json_encode($this->settings['cashMin'])?>)) throw('提现最小限额为<?=$this->settings['cashMin']?>元');
					if(amount>parseFloat(<?=json_encode($this->settings['cashMax'])?>)) throw('提现最大限额为<?=$this->settings['cashMax']?>元');
					showPaymentFee()
				}
				if(!this.coinpwd.value) throw('请输入资金密码');
				if(this.coinpwd.value<6) throw('资金密码至少6位');
				showPaymentFee()
			}
			function toCash(err, data){
	//console.log(err);
	if(err){
		$.alert(err)
		$("#vcode").trigger("click");
	}else{
		$(':password').val('');
		$('input[name=amount]').val('');
		$.alert(data)
	}
}
			</script>
</head>
<body>

 	<?php
	$bank=$this->getRow("select m.*,b.logo logo, b.name bankName from {$this->prename}member_bank m, {$this->prename}bank_list b where b.isDelete=0 and m.bankId=b.id and m.uid=? limit 1", $this->user['uid']);
?>		
<!-- 中间部分开始 -->
	<div class="manager">
		<div class="page-container">

			
			<!-- 逻辑内容开始 -->
			<div data-init="content" class="content">
				<div class="wrapper">
					<div class="money-account-list">
						<div data-ajax-trigger="global" class="master-account">
							<div class="item first">账户余额：
							<span class="amount">¥<?=$this->user['coin']?>
							</span>
							</div>
							
						
						</div>
					
					</div>

           	<!-- 中间部分结束 -->	    
 <div class="pagemain">
    <div class="display biao-cont">
	 	<?php if($bank['bankId']){?>
 	<form action="/index.php/cash/ajaxToCash" method="post" target="ajax" datatype="json" onajax="beforeToCash" call="toCash">

	<div class="to-cash-mian">
	  <div class="to-cash-zj">提现金额：<input class="text"  name="amount" id="ContentPlaceHolder1_txtMoney" onkeyup="showPaymentFee();" style="width: 200px;height: 40px;"/>单笔限额为<?=$this->settings['cashMin']?>至<?=$this->settings['cashMax']?>元。</div>
      <div class="to-cash-zj">提现卡号：
      <div class="to-cash-bank"><img style="height:60px;margin-left:7px;position:relative;bottom:-6px;" src="/<?=$bank['logo']?>" title="<?=htmlspecialchars($bank['bankName'])?>" alt="" /></div>
      <div class="to-cash-text"><?=preg_replace('/^(\w{4}).*(\w{4})$/', '\1***********\2', htmlspecialchars($bank['account']))?></div>
      <div class="to-cash-name"><?=preg_replace('/^(\w).*$/', '\1**', htmlspecialchars($bank['username']))?></div>
      </div>
      <div class="to-cash-zj">资金密码：<input name="coinpwd" type="password" value="" style="width: 200px;height: 40px;"/></div>
      <div class="cz_btn_box">
	  <!--input type="button" id="put_button_pass" class="next" value="提交申请" onclick="$(this).closest('form').submit()"-->
	   <input type="submit" name="submit" value="提交申请" class="next">
	  </div>

    </div>
</form>
 <?php
	$bank=$this->getRow("select m.*,b.logo logo, b.name bankName from {$this->prename}member_bank m, {$this->prename}bank_list b where b.isDelete=0 and m.bankId=b.id and m.uid=? limit 1", $this->user['uid']);
	$this->freshSession(); 
    $date=strtotime('00:00:00');
	$date2=strtotime('00:00:00');
	$time=strtotime(date('Y-m-d', $this->time));
	$cashAmout=0;
		$rechargeAmount=0;
		$rechargeTime=strtotime('00:00');
		if($this->settings['cashMinAmount']){
			$cashMinAmount=$this->settings['cashMinAmount']/100;
			$gRs=$this->getRow("select sum(case when rechargeAmount>0 then rechargeAmount else amount end) as rechargeAmount from {$this->prename}member_recharge where  uid={$this->user['uid']} and state in (1,2,9) and isDelete=0 and rechargeTime>=".$rechargeTime);
			if($gRs){
				$rechargeAmount=$gRs["rechargeAmount"];
			}
		}
	$cashAmout=$this->getValue("select sum(mode*beiShu*actionNum) from {$this->prename}bets where isDelete=0 and actionTime>={$rechargeTime} and uid={$this->user['uid']}");
	$times=$this->getValue("select count(*) from {$this->prename}member_cash where actionTime>=$time and uid=?", $this->user['uid']);
?>

   		<?php }else{?>
     	<div id="subContent_bet_re">
		<div id="error">
		<h3>
			<font class="hint_red">您尚未绑定银行账户，请先绑定银行账户！</font>
		</h3>
		<div class="yhlb_back"><a href="/index.php/safe/info" target="_top">绑定银行账户</a></div>
						</div>

﻿</div>	
    <?php }?>
	 
		    <div class="recharege-leibie"></div>
  </div> </div> </div> </div>
</body></html>
  
   
 