<?php $this->display('inc_daohang.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>-官方网站</title>
        <link rel="stylesheet" type="text/css" href="/css/nsc/home/reset.css?v=1.16.11.6" />

        <script type="text/javascript" src="/js/nsc/jquery-1.7.min.js?v=1.16.11.6"></script>
        <script type="text/javascript" src="/js/nsc/base.js?v=1.16.11.6"></script>
        <script type="text/javascript" src="/js/nsc/jquery-1.7.min.js?v=1.16.11.6"></script>
			<link rel="stylesheet" href="/css/nsc/huodong.css?v=1.16.11.6" />
        <script type="text/javascript" src="/js/nsc/dialogUI/jquery.dialogUI.js?v=1.16.11.6"></script>
        <script type="text/javascript" src="/js/nsc/main.js?v=1.16.11.6"></script>
        <script type="text/javascript" src="/js/nsc/soundBox.js?v=1.16.11.6"></script>
        <link href="/css/nsc/plugin/dialogUI/dialogUI.css?v=1.16.11.6" media="all" type="text/css" rel="stylesheet" />
    </head>
		<?php
			$data = array();
			if($this->settings['huoDongRegister']){
				$data[] = 'huoDongRegister';
			}
			if($this->settings['rechargeCommissionAmount']){
				$data[] = 'rechargeCommissionAmount';
			}
			if($this->settings['conCommissionBase']){
				$data[] ='conCommissionBase';
			}
			//首冲充值活动
			$rdata = $this->getRows("select * from {$this->prename}events where enable=1 and isdelete=0 and state=0");
			if($rdata){
				//活动是否过期
				foreach($rdata as $k=>$val)
				{
					if($val['end_time'] && $val['end_time'] < $this->time){
						$this->update("update {$this->prename}events set `state`=1,`enabled`=0 where id={$val['id']}");
						unset($rdata[$k]);
					} else{
						$data[] = $rdata[$k];
					}
				}
			}
		?>
    <body>

        <div id="contentBox" class="activity_main">
            <div class="right_meun" id="siderbar">
                <div class="r_tit-bg"><h3 class="r_tit">热门活动</h3></div>
                <ul>
			        	<li >
			                <a href="/index.php/score/rotate">幸运大转盘</a>
			            </li>
						<li >
			                <a href="/index.php/score/zadan">幸运砸蛋</a>
			            </li>
						<li >
			                <a href="/index.php/score/dodzyh">投资理财</a>
			            </li>
						<li >
			                <a href="/index.php/score/goods/current">积分兑换</a>
			            </li>
						<li class="current">
			                <a href="/index.php/event/index">充值福利</a>
			            </li>
						<li >
			                <a href="/index.php/score/yongjin">新至尊佣金活动</a>
			            </li>
			            <li >
			                <a href="/index.php/score/chuangguan">至尊闯关活动</a>
			            </li>
			            <li >
			                <a href="/index.php/score/qiandao">签到有你</a>
			            </li>
			    </ul>
            </div>
			
            <div class="left_activity">
		<?php if($data){?>
        <?php foreach($data as $k=>$item){?>	
		<?php
            $today = date('Y-m-d',$this->time);
            $start = strtotime($today);
            $end = $start+3600*12*2;
            $ret = $this->getRow("select * from {$this->prename}event_sign where `uid`={$this->user['uid']} and `goodId`={$item['id']} and `state` IN (0,1) and `isdelete`=0 and `c_time` between {$start} and {$end} order by c_time desc");
        ?>
<div id="subContent_bet_re">
<div class="activity_content">
  
    <div class="activity_banner" style="background:url(/images/nsc/activity/activity_banner02.jpg) no-repeat center top;"></div>
    <div class="activity_title">
    	<h2>充值福利</h2>
 <?php
		$rechargeTime=strtotime('00:00');
		$gRs=$this->getRow("select sum(case when rechargeAmount>0 then rechargeAmount else amount end) as rechargeAmount from {$this->prename}member_recharge where  uid={$this->user['uid']} and state in (1,2,9) and isDelete=0 and rechargeTime>=".$rechargeTime);
		if($gRs){
		$rechargeAmount=$gRs["rechargeAmount"];
		}
?>
		<p class="counyongjin">今日已充值<span id="days"><?=$this->iff($rechargeAmount,$rechargeAmount,0)?></span>元</p>
		<?php
		if(!$ret){ ?>
        	<a href="#" onclick="hdSign(<?=$item['id']?>,<?=$this->user['uid']?>,'chose_<?=$item["id"]?>')" class="check_btn">领取充值任务</a>
		<?php }else{?>
			<a href="#" onclick="hdGet(<?=$item['id']?>,<?=$this->user['uid']?>,'chose_<?=$item["id"]?>')" class="check_btn">领取充值福利</a>
		<?php } ?>
		    </div>
    <div class="activity_nr">
    	<h4 class="x-title">充值规则</h4>
        <div class="x-text">
        	<p>每日消费达到流水要求即可领取相应首冲礼金。</p>
            <h6>充值福利规则如下：</h6>  
            <div class="r_txt">
			<p>
			<p> &nbsp;</p> 
		
			<p>
			<?php
                $condition = explode("|",$item['condition']);
                $rate = explode("|",$item['rate']);
                $tplMain = <<<TPL
				每日首次充值 %s 元以上（&nbsp;最高可以领取%s）<p></p> 
                %s
TPL;
                $tplTip = <<<TIP
				%s 活动%s&nbsp;&nbsp;&nbsp;(&nbsp;%s 倍流水可领取首次充值金额 %s ％的活动礼金&nbsp;)<p>&nbsp; </p> 
		
TIP;
                $radio = "<input type='radio' name='chose_".$item['id']."' %s value='%s'/>";
                $html ="";
                    for($i=0;$i<count($condition);$i++)
                    {
                        $checked = ($ret['rate_value']) ==$i ? "checked" : "";
						$input =sprintf($radio, $checked, $i);
                        $html .= sprintf($tplTip, $input, $i+1, $condition[$i],$rate[$i]);
                    }
                        $html = sprintf($tplMain, $item['coin'], $item['max_rebate'], $html);
					if(!$ret){?>
					<?=$html?>
                <?php }else{?>
                    <?=$html?>
            </p> 
				<?php } ?>
		
			<p></p> 
			<p></p>
			</p>
			</div>
			
     
		
            </div> 
      <h4 class="x-title">注意事项</h4>
        <div class="x-text"><p><p> </p> <p> </p> <p>1、当天首次充值满足活动要求，且当天消费达到流水要求即可领取对应的活动奖金。</p> <p>2、用户打开官网活动公告中的“热门活动”，点击“充值福利”页面上的“领取充值福利”即可完成奖金领取。</p> <p>3、奖金需在当天(23:59:59之前)完成领取，隔天无效。</p> <p>4、用户自身领取奖金后出款，要求满足对应奖金的流水要求。</p> <p>5、本次活动计算彩票投注，可与其他活动共享。</p> <p>6、同一账户、同一银行卡、同一IP每天只可参加一次活动。</p> <p>7、任何的无风险投注，对冲，对打均不计算有效投注。有效投注定义：玩法投注不得超过该玩法投注最大注数的70%，即定位胆不得超过7注，二星不得超过70注，三星不得超过700注，四星不得超过7000注，五星不得超过70000注。如发现利用活动存在对冲等恶意套利行为，平台有权扣除违规所得。</p> <p>8、平台有权对活动随时做出更改、终止，并享有最终解释权。</p> <p> </p> <p> </p> <p> </p> <p> </p> <p> </p> <p> </p> <p> </p> <p> </p> <p> </p> <p> </p> <p> </p> <p> </p></p></div>
    </div>
	<?php } ?>
        <?php } ?>
		
</div>
﻿</div>
﻿</div>
<div style="clear: both"></div>
<script type="text/javascript" src="/js/nsc/soundBox.js?v=1.16.11.6"></script>
<script type="text/javascript" src="/js/nsc/base.js?v=1.16.11.6"></script>
﻿</div>﻿</div>﻿</div>﻿</div>﻿</div>
<?php $this->display('inc_che.php'); ?>

</body>
</html>
