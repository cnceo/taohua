<?php
	if(!$this->types) $this->getTypes();
	if(!$this->playeds) $this->getPlayeds();
	$modes=array(
	    '0.001'=>'厘',
		'0.010'=>'分',
		'0.100'=>'角',
		'1.000'=>'元'
	);
	$toTime=strtotime('00:00:00');
	$sql="select id,wjorderId,actionNo,actionTime,playedId,type,actionData,beiShu,mode,actionNum,lotteryNo,bonus,isDelete,kjTime from {$this->prename}bets where  isDelete=0 and uid={$this->user['uid']} and actionTime>{$toTime} order by id desc limit 10";
	if($list=$this->getRows($sql, $actionNo['actionNo'])){
	foreach($list as $var){
?>
	<tr data-code='<?=json_encode($var)?>'>
		<td><a onclick="ddxq(<?=$var['id']?>);" href="javascript:void(0)" ><?=$var['wjorderId']?></a></td>
		<td><?=date('H:i:s', $var['actionTime'])?></td>
		<td><?=$this->types[$var['type']]['shortName']?></td>
		<td><?=$this->playeds[$var['playedId']]['name'].$this->iff($var['fpEnable'], ' 飞盘', '')?></td>
		<td><?=$var['actionNo']?></td>
		<td class="code-list" ><?=Object::CsubStr($var['actionData'],0,10)?></td>
		<td><?=$var['beiShu']?>倍</td>
		<!--td><?=$modes[$var['mode']]?></td-->
        <td><?=$var['beiShu']*$var['mode']*$var['actionNum']*(intval($this->iff($var['fpEnable'], '2', '1')))?></td>
		<td><?=$this->iff($var['lotteryNo'], number_format($var['bonus'], 2), '0.00')?></td>
		
		
		<!--td><?php if($var['isDelete']==1){echo '<font color="#999999">已撤单</font>';}elseif(!$var['lotteryNo']){echo '<font color="#009900">未开奖</font>';}elseif($var['zjCount']){echo '<font color="red">已派奖</font>';}else{echo '未中奖';} ?></td-->
			
            <td>
            <?php if($var['lotteryNo'] || $var['isDelete']==1 || $var['kjTime']<$this->time || $var['qz_uid']){ ?>
				--
			<?php }else{ ?>
			<a target="ajax" call="gameFreshOrdered" title="是否确定撤单" dataType="json" href="/index.php/game/deleteCode/<?=$var['id']?>">撤单</font></a>
			
        <?php } ?>
        </td>
	</tr>

<?php
    }
} else {
?>
<tr>
<td colspan="12" height="10">今日暂无投注数据</td>
</tr>
<?php
}
?>
<script type="text/javascript">
function ddxq(num){
	layer.open({
	  type: 2,
	  area: ['800px', '600px'],
	  zIndex:1888,
	  //fixed: false, //不固定
	  title:'订单详情',
	  scrollbar: false,//屏蔽滚动条
	  //maxmin: true,
	  content:'/index.php/record/betInfo/'+num
	});
	return false;
}
</script>