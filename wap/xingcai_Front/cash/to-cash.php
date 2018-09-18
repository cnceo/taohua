   <?php $this->display('inc_daohang.php'); ?>

 <?php $this->freshSession(); 
		//更新级别
		$ngrade=$this->getValue("select max(level) from {$this->prename}member_level where minScore <= {$this->user['scoreTotal']}");
		if($ngrade>$this->user['grade']){
			$sql="update blast_members set grade={$ngrade} where uid=?";
			$this->update($sql, $this->user['uid']);
		}else{$ngrade=$this->user['grade'];}
		
		$date=strtotime('00:00:00');
?>
<link rel="stylesheet" href="/css/nsc_m/list.css?v=1.16.11.16">
<script type="text/javascript" src="/js/nsc_m/res.js?v=1.16.12.4"></script>
<script type="text/javascript" src="/js/nsc/main.js?v=1.16.12.4"></script>
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
				if(!this.coinpwd.value) throw('请输入提款密码');
				if(this.coinpwd.value<6) throw('提款密码至少6位');
				showPaymentFee()
			}
			function toCash(err, data){
	if(err){
		xingcai(err)
	}else{
		$(':password').val('');
		$('input[name=amount]').val('');
		xingcai('申请提现成功，提现将在10分钟内到帐，如未到账请联系在线客服。')
	}
}
			</script>
 <section class="wraper-page">
 	<?php
	$bank=$this->getRow("select m.*,b.logo logo, b.name bankName from {$this->prename}member_bank m, {$this->prename}bank_list b where b.isDelete=0 and m.bankId=b.id and m.uid=? limit 1", $this->user['uid']);
?>			
<?php if($bank['bankId']){?>
       <form action="/index.php/cash/ajaxToCash" method="post" target="ajax" datatype="json" onajax="beforeToCash" call="toCash">
                    <span class="tab-front" id="general_tab_1">
                     <span id="notice2" style="color:red"> 
                    </span>
                    </span><!--
                    <span class="tab-back"  id="general_tab_0">
                      <span class="menu_01"></span>
                      <span class="menu_02" onclick="window.location.href='?controller=security&action=withdraw&check=651'">向上级提现</span>
                      <span class="menu_03"></span>
                    </span>
            -->
            <!--第一步-->
            <div class="dw_main1">
                	<li class="recharege-leibie"></li>
				
                <!--div class="warning">注意：每天限制提款<span>10</span>次，您已提款<span class="orange">0</span>次，提款时间为 02:01 至 02:00</div-->
                <table border="0" cellspacing="0" cellpadding="0" class="dw_list_table">
                <tbody><tr>
                <th><span class="x_line">用户名：</span></th>
                <td><span class="dw_name"><?=$this->user['username']?></span></td>
                </tr>
                <tr>
                <th><span class="x_line">可提款金额：</span></th>
                <td><span class="dw_amount orange"><?=$this->user['coin']?></span></td>
                </tr>
                <tr>
                <th><span class="x_line2">提款金额：</span></th>
                <td><div class="input_kuang1"><input type="text" name="amount" id="ContentPlaceHolder1_txtMoney" onkeyup="showPaymentFee();" placeholder="请输入提款金额"></div><p class="db_tips_txt">单笔最低提现金额：<?=$this->settings['cashMin']?>元，最高：<?=$this->settings['cashMax']?>元</p></td>
                </tr>
				 <tr>
                <th><span class="x_line2">提款密码：</span></th>
                <td><div class="input_kuang1"><input name="coinpwd" type="password" placeholder="请输入提款金额"></div></td>
                </tr>
                <tr>
                <th><span class="x_line2">收款银行卡：</span></th>
                <td>
                    <select name="bankinfo" id="bankinfo" class="input_kuang1">
					<option selected="selected" value="365863"><?=$bank['bankName']?>--<?=preg_replace('/^(\w{4}).*(\w{4})$/', '\1***********\2', htmlspecialchars($bank['account']))?></option>
				</select>
                </td>
                </tr>
                </tbody>
				</table>
              <div class="submit_area"><input type="button" id="put_button_pass" value="提交申请" class="btn btn_orange formNext" onclick="$(this).closest('form').submit()">
              <!-- <a class="btn_sqlist orange" href="./?controller=report&action=main&tag=bankreport" target="_blank" title="充提记录">提款申请列表</a> -->
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
			<font class="hint_red">您尚未绑定银行卡，请先进行卡号绑定！</font>
		</h3>
		<div class="yhlb_back"><a href="/index.php/safe/info" target="_top">卡号绑定页面</a></div>
						</div>

﻿</div>	
    <?php }?>
	 
        </section>