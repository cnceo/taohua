  <?php $this->display('inc_daohang1.php'); ?>
  <link type="text/css" rel="stylesheet" href="/skin/js/jqueryui/jquery-ui-1.8.23.custom.css" />
  
<script type="text/javascript" src="/js/nsc_m/layer.js?v=1.16.12.12"></script>
<link href="/js/nsc_m/need/layer.css?2.0" type="text/css" rel="styleSheet" id="layermcss">
<script type="text/javascript" src="/js/nsc_m/res.js?v=1.16.12.4"></script>
<script type="text/javascript" src="/js/nsc/main.js?v=1.16.12.4"></script>
<script type="text/javascript" src="/newskin/js/common.js"></script>
<script type="text/javascript" src="/skin/js/onload.js"></script>
<script type="text/javascript" src="/skin/js/function.js"></script>
<script type="text/javascript" src="/skin/js/jquery.simplemodal.src.js"></script>
<script type="text/javascript" src="/skin/js/jqueryui/jquery-ui-1.8.23.custom.min.js"></script>
 <link href="/hcss/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
 <link href="/hcss/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <!-- Data Tables -->
<link href="/hcss/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<link href="/hcss/css/animate.css" rel="stylesheet">
<link href="/hcss/css/style.css?v=4.1.0" rel="stylesheet">
 <?php 
		$sql1="select *  from {$this->prename}leavl where type = 1 order by id asc";
		$sql2="select *  from {$this->prename}leavl where type = 2 order by id asc";
		$chou1 = $this->getPage($sql1);	
		$chou2 = $this->getPage($sql2);
		$sql3="select coin from {$this->prename}members where uid={$this->user['uid']}";
		$coin = $this->getValue($sql3);
		$startTime = strtotime(date('Y-m-d 00:00:00',time()));
		$endTime = strtotime(date('Y-m-d 23:59:59',time()));
		$num = $this->getValue("select count(id) from {$this->prename}member_prize where uid={$this->user['uid']} and status=1 and add_time>{$startTime} and add_time<{$endTime};");
		$no_prize = $this->getValue("select count(id) from {$this->prename}member_prize where uid={$this->user['uid']} and status=0;");

		$sql4="select sum(amount) as amount from blast_member_recharge where uid=? and state!= 0 and rechargeTime between {$startTime} and {$endTime}";
		$recharge_money = $this->getRow($sql4, $this->user['uid']);
		if(!$recharge_money['amount'])$recharge_money['amount']=0;
 ?>
   <section class="wraper-page">
   
   <div class="col-sm-4" style="PADDING-TOP: 6;">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>幸运大抽奖<small>本活动百分百中奖，完全随机。全程无人工干预</small></h5>
                  
                </div>
                <div class="ibox-content">
                    <p>根据充值金额获得免费抽奖机会，免费抽奖剩余<code><?=$no_prize?></code>次。
                    </p>
<p>
                    <h3 class="font-bold">
						  您当日充值为<code><?=$recharge_money['amount']?></code>元。
                        </h3>
						</p>
                    <p>
                       <?php if($chou1['data']){ foreach ($chou1['data'] as $key => $value) {?>
		<span>当日充值<font color="red"><?=$value['min_cz_money']?>-<?=$value['max_cz_money']?></font>元，可免费抽奖1次，奖金<font color="red"><?=$value['min_prize_money']?>-<?=$value['max_prize_money']?></font>元</span>
		<?php if($this->getValue("select count(id) from {$this->prename}member_prize where uid={$this->user['uid']} and status=0 and leval_id={$value['id']};")>=1){?>
		   <button class="btn btn-primary btn-sm" onclick="getmoney(<?=$value['id']?>,<?=$this->getValue("select id from {$this->prename}member_prize where uid={$this->user['uid']} and status=0 and leval_id={$value['id']};")?>)">抽奖</button>
		<?php }?>
		</br>
		<?php }}?>
        
                </div>
            </div>
        </div>

    <div class="col-sm-4" style="PADDING-TOP: 6;">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>余额抽奖<small>本活动百分百中奖，完全随机。全程无人工干预</small></h5>
                  
                </div>
                <div class="ibox-content">
                    <p>将花费您相应的金额，每天有<code>25</code>次抽奖机会。
                    </p>
<p>
                    <h3 class="font-bold">
                        账户余额<span id='all_coin'><code><?=$coin?></code></span>元
                        </h3>
						 </p>
                    <p>
                   <?php if($chou2['data']){ foreach ($chou2['data'] as $key => $value) {?>
		<span >使用<font color="red"><?=$value['min_cz_money']?></font>元，可免费抽奖1次，奖金<font color="red"><?=$value['min_prize_money']?>-<?=$value['max_prize_money']?></font>元</span></br>
		<?php }}?>
		<span >使用&nbsp;&nbsp;<?php if($chou2['data']){ foreach ($chou2['data'] as $key => $value) {?><label><input name='money'  class="money" type="radio" value="<?=$value['min_cz_money']?>" leavl ="<?=$value['id']?>"/><?=$value['min_cz_money']?>元 </label><?php }}?> </span>
		<?php if($num<25){?>
	
		<button class="btn btn-primary btn-rounded btn-block" onclick="prize()">试试手气</button>
		<?php }else{?>
		<button class="btn btn-primary btn-rounded btn-block" onclick="stop()">明日再战</button>
		
		<?php }?>
        	<input type='hidden' id='coin' value="<?=$coin?>">
                </div>
            </div>
        </div>
<style type="text/css">
.ibox-content {
    background-color: #ffffff;
    color: inherit;
    padding: 15px 20px 0px 0px;
    border-color: #e7eaec;
    -webkit-border-image: none;
    -o-border-image: none;
    border-image: none;
    border-style: solid solid none;
    border-width: 1px 0px;
}
</style> 
<script type="text/javascript">
	function prize() {
		var money = $('input[name="money"]:checked').val();
		var leavl_id = $('input[name="money"]:checked').attr('leavl');
		var coin = $('#coin').val();
		if (money == null) {
			winjinAlert('请先选择使用金额');return;
		}
		if (parseFloat(coin)<parseFloat(money)) {
			winjinAlert('余额不足，请先充值');return;
		}
		if (confirm('确定要进行余额抽奖么？')){
			if (money) {
				$.ajax({
					url:'/index.php/score/lucky_prize',
					type:'post',
					dataType:'json',
					data:{'money':money,'leavl_id':leavl_id},
					success:function(res){
						winjinAlert(eval(res));
						window.location.href = '/index.php/score/lucky';
					}
				})
			}
		}
	}
	function stop (){
		winjinAlert('您今日已抽奖25次，请明日再战，谢谢！');
	}
	function getmoney(leval_id,prize_id) {
		if (confirm('确定要进行抽奖么1？')){
			$.ajax({
				url:'/index.php/score/get_money',
				type:'post',
				dataType:'json',
				data:{'leval_id':leval_id,'prize_id':prize_id},
				success:function(res){
					winjinAlert(eval(res));
					window.location.href = '/index.php/score/lucky';
				}
			})
		}
	}
</script>