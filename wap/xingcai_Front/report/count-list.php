<?php
	$para=$_GET;
	
	// 时间限制
	if($para['fromTime'] && $para['toTime']){
		$fromTime=strtotime($para['fromTime']);
		$toTime=strtotime($para['toTime']);
		$betTimeWhere="and actionTime between $fromTime and $toTime";
		$cashTimeWhere="and c.actionTime between $fromTime and $toTime";
		$rechargeTimeWhere="and r.actionTime between $fromTime and $toTime";
		$fanDiaTimeWhere="and actionTime between $fromTime and $toTime";
		$fanDiaTimeWhere2="and l.actionTime between $fromTime and $toTime";
		$brokerageTimeWhere=$fanDiaTimeWhere2;
	}elseif($para['fromTime']){
		$fromTime=strtotime($para['fromTime']);
		$betTimeWhere="and b.actionTime >=$fromTime";
		$cashTimeWhere="and c.actionTime >=$fromTime";
		$rechargeTimeWhere="and r.actionTime >=$fromTime";
		$fanDiaTimeWhere="and actionTime >= $fromTime";
		$fanDiaTimeWhere2="and l.actionTime >= $fromTime";
		$brokerageTimeWhere=$fanDiaTimeWhere2;
	}elseif($para['toTime']){
		$toTime=strtotime($para['toTime']);
		$betTimeWhere="and b.actionTime < $toTime";
		$cashTimeWhere="and c.actionTime < $toTime";
		$rechargeTimeWhere="and r.actionTime < $toTime";
		$fanDiaTimeWhere="and actionTime < $toTime";
		$fanDiaTimeWhere2="and l.actionTime < $toTime";
		$brokerageTimeWhere=$fanDiaTimeWhere2;
	}else{
		if($GLOBALS['fromTime'] && $GLOBALS['toTime']){
		$betTimeWhere="and actionTime between {$GLOBALS['fromTime']} and {$GLOBALS['toTime']}";
		$cashTimeWhere="and c.actionTime between {$GLOBALS['fromTime']} and {$GLOBALS['toTime']}";
		$rechargeTimeWhere="and r.actionTime between {$GLOBALS['fromTime']} and {$GLOBALS['toTime']}";
		$fanDiaTimeWhere="and actionTime between {$GLOBALS['fromTime']} and {$GLOBALS['toTime']}";
		$fanDiaTimeWhere2="and l.actionTime between {$GLOBALS['fromTime']} and {$GLOBALS['toTime']}";
		$brokerageTimeWhere=$fanDiaTimeWhere2;
		}
	}
	
	// 用户限制
	$uid=$this->user['uid'];
	$userWhere="and u.uid=$uid";
	$userWhere3="and concat(',', u.parents, ',') like '%,$uid,%'";
	
	$sql="select u.username, u.coin, u.uid, u.parentId, sum(b.mode * b.beiShu * b.actionNum) betAmount, sum(b.bonus) zjAmount, (select sum(c.amount) from {$this->prename}member_cash c where c.`uid`=u.`uid` and c.state=0 $cashTimeWhere) cashAmount,(select sum(r.amount) from {$this->prename}member_recharge r where r.`uid`=u.`uid` and r.state in(1,2,9) $rechargeTimeWhere) rechargeAmount, (select sum(l.coin) from {$this->prename}coin_log l where l.`uid`=u.`uid` and l.liqType in(50,51,52,53,56) $brokerageTimeWhere) brokerageAmount from {$this->prename}members u left join {$this->prename}bets b on u.uid=b.uid and b.isDelete=0 $betTimeWhere where 1 $userWhere";
	//echo $sql;exit;
	
	$this->pageSize-=1;
	if($this->action!='countSearch') $this->action='countSearch';
	$list=$this->getPage($sql .' group by u.uid', $this->page, $this->pageSize);
	if(!$list['total']) {
		$uParentId2=$this->getValue("select parentId from {$this->prename}members where uid=?",intval($para['parentId']));
		$list=array(
			'total' => 1,
			'data'=>array(array(
				'parentId'=>$uParentId2,
				'uid'=>$para['parentId'],
				'username'=>'没有用户'
			))
		);
		$noChildren=true;
	}$params=http_build_query($_REQUEST, '', '&');
	$count=array();
	$sql="select sum(coin) from {$this->prename}coin_log where uid=? and liqType in(2,3) $fanDiaTimeWhere";
	
	$rel="/index.php/{$this->controller}/{$this->action}";

?>

<div>
<div class="row">
                 <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>盈亏报表 <small>备注:盈亏计算为，中奖总额-投注总额+总返点+佣金=总盈亏</small></h5>
                        
                    </div>
                    <div class="ibox-content">

                        <table width="100%" border="0" cellspacing="1" cellpadding="0" class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
							<?php
		if($list['data']) foreach($list['data'] as $var){
		
		if($var['username']!='没有用户'){
			$var['fanDianAmount']=$this->getValue($sql, $var['uid']);
			//echo $sql.$var['uid'];
			$pId=$var['uid'];
		}
		$count['betAmount']+=$var['betAmount'];
		$count['zjAmount']+=$var['zjAmount'];
		$count['fanDianAmount']+=$var['fanDianAmount'];
		$count['brokerageAmount']+=$var['brokerageAmount'];
		$count['cashAmount']+=$var['cashAmount'];
		$count['coin']+=$var['coin'];
		$count['rechargeAmount']+=$var['rechargeAmount'];
		
	?>
	  <tbody class="table_b_tr">
                                <tr>
                                    <th>充值总额</th>
									<td><?=$this->ifs($var['rechargeAmount'], '--')?></td>
									  </tr>
									  <tr>
                                    <th>提现总额</th>
									<td><?=$this->ifs($var['cashAmount'], '--')?></td>
									</tr>
									  <tr>
                                    <th>投注总额</th>
									<td><?=$this->ifs($var['betAmount'], '--')?></td>
									</tr>
									  <tr>
                                    <th>中奖总额</th>
									<td><?=$this->ifs($var['zjAmount'], '--')?></td>
									</tr>
									 <tr>
									<th>总返点</th>
									<td><?=$this->ifs($var['fanDianAmount'], '--')?></td>
									</tr>
									 <tr>
									<th>佣金</th>
									<td><?=$this->ifs($var['brokerageAmount'], '--')?></td>
									</tr>
									 <tr>
									<th>总盈亏</th>
									<td><?=$this->ifs($var['zjAmount']-$var['betAmount']+$var['fanDianAmount']+$var['brokerageAmount'], '--')?></td>
									</tr>
								   </tbody>
                            </thead>
                       
						
                            
   
    <?php } ?>
                                
                         
                        
                        </table>
</div>
</div>
</div>
<!--div class="search_br">
    <span class="l_message">备注:盈亏计算为，中奖总额-投注总额+总返点+佣金=总盈亏</span>
    <div class="pageinfo"></div>
</div-->
</body>
</html>