<?php
	$bet=$this->getRow("select * from {$this->prename}bets where id=?", $args[0]);
	if(!$bet) throw new Exception('单号不存在');
	$modeName=array('1.000'=>'元', '0.100'=>'角', '0.010'=>'分', '0.001'=>'厘','1.000'=>'1元');
	$weiShu=$bet['weiShu'];
	if($weiShu){
		$w=array(16=>'万', 8=>'千', 4=>'百', 2=>'十',1=>'个');
		foreach($w as $p=>$v){
			if($weiShu & $p) $wei.=$v;
		}
		$wei.=':';
	}
	$betCont=$bet['mode'] * $bet['beiShu'] * $bet['actionNum'] * ($bet['fpEnable']+1);
?>
 <link rel="stylesheet" href="/css/layui/css/layui.css"  media="all">
 <table class="layui-table">
  <colgroup>
    <col width="150">
    <col width="150">
    <col width="200">
    <col>
  </colgroup>
  <thead>
    <tr>
      <th>发起人</th>
      <th>彩种</th>
      <th>购买倍数</th>
      <th>订单状态</th>
    </tr> 
  </thead>
  <tbody>
    <tr>
      <td><span style="color: #F00;"><?=$this->iff($bet['username']==$this->user['username'], $bet['username'], preg_replace('/^(\w).*(\w{2})$/', '\1***\2', $bet['username']))?></span></td>
      <td><span style="color: #F00;"><?=$this->types[$bet['type']]['title']?></span></td>
      <td><span style="color: #F00;"><?=$bet['beiShu'].'倍'?></span></td>
      <td><?php
//                            var_dump($bet['kjTime'],time());
				if($bet['isDelete']==1){
					echo '<font color="#999999">已撤单</font>';
				}elseif($bet['zjCount']){
					echo '<font color="red">已派奖</font>';
				}elseif(!$bet['lotteryNo'] && $bet['kjTime']>time()){
					echo '<font color="#009900">未开奖</font>';
				}elseif($bet['lotteryNo']){
					echo '<font color="#00CC00">未中奖</font>';
				}else{
					echo '<font color="#013da0">已过期</font>';
				}
			?></td>
    </tr>
  </tbody>
</table>

  <table class="layui-table">
  <colgroup>
    <col width="150">
    <col width="150">
    <col width="200">
    <col>
  </colgroup>
  <thead>
    <tr>
      <th>订单编号</th>
      <th>玩法</th>
      <th>购买模式</th>
      <th>投注期号</th>
    </tr> 
  </thead>
  <tbody>
    <tr>
      <td><span style="color: #F00;"><?=$bet['wjorderId']?></span></td>
      <td><span style="color: #F00;"><?=$this->playeds[$bet['playedId']]['name']?></span></td>
      <td><span style="color: #F00;"><?=$modeName[$bet['mode']]?></span></td>
      <td><span style="color: #F00;"><?=$bet['actionNo']?></span></td>
    </tr>
  </tbody>
</table>

  <table class="layui-table">
  <colgroup>
    <col width="150">
    <col width="150">
    <col width="200">
    <col>
  </colgroup>
  <thead>
    <tr>
      <th>奖金返点</th>
      <th>返点金额</th>
      <th>中奖注数</th>
      <th>投注时间</th>
    </tr> 
  </thead>
  <tbody>
    <tr>
      <td><span style="color: #F00;"><?=number_format($bet['bonusProp'], 2)?>－<?=number_format($bet['fanDian'],1)?>%</span></td>
      <td><span style="color: #F00;"><?=$this->iff($bet['lotteryNo'], number_format(($bet['fanDian']/100)*$betCont, 3). '元', '－')?></span></td>
      <td><span style="color: #F00;"><?=$this->iff($bet['lotteryNo'], $bet['bonus']/$bet['bonusProp'].'注', '－')?></span></td>
      <td><span style="color: #F00;"><?=date('m-d H:i:s',$bet['actionTime'])?></span></td>
    </tr>
  </tbody>
</table>

  <table class="layui-table">
  <colgroup>
    <col width="150">
    <col width="150">
    <col width="200">
    <col>
  </colgroup>
  <thead>
    <tr>
      <th>购买盈亏</th>
      <th>购买金额</th>
      <th>中奖金额</th>
      <th>开奖时间</th>
    </tr> 
  </thead>
  <tbody>
    <tr>
      <td><span style="color: #F00;"><?=$this->iff($bet['lotteryNo'], number_format($bet['bonus'] - $betCont + ($bet['fanDian']/100)*$betCont, 3), '－')?></span></td>
      <td><span style="color: #F00;"><?=number_format($betCont, 3)?></span></td>
      <td><span style="color: #F00;"><?=$this->iff($bet['lotteryNo'], number_format($bet['bonus'], 3) .'元', '－')?></span></td>
      <td><span class="red"><?=$this->iff($bet['lotteryNo'], date('m-d H:i:s',$bet['kjTime']), '－')?></span></td>
    </tr>
  </tbody>
</table>
  
  <table class="layui-table">
  <colgroup>
    <col width="150">
    <col width="150">
    <col width="200">
    <col>
  </colgroup>
  <thead>
    <tr>
      <th>开奖号码</th>
    </tr> 
  </thead>
  <tbody>
    <tr>
      <td><span style="color: #828282;font-size: 21px;"><?=$this->ifs($bet['lotteryNo'], '－')?></span></td>
    </tr>
  </tbody>
</table>  

  <table class="layui-table">
  <colgroup>
    <col width="150">
    <col width="150">
    <col width="200">
    <col>
  </colgroup>
  <thead>
    <tr>
      <th>方案内容</th>
    </tr> 
  </thead>
  <tbody>
    <tr>
      <td style="position:inherit; overflow:auto;word-wrap:break-word;word-break:break-all;"><span style="color: #828282;font-size: 21px;"><?=$wei.$bet['actionData']?></span></td>
    </tr>
  </tbody>
</table>  