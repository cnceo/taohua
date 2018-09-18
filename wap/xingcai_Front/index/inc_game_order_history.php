<?php
if (!$this->types)
    $this->getTypes();
if (!$this->playeds)
    $this->getPlayeds();
$modes  = array(
    '0.001' => '厘',
    '0.010' => '分',
    '0.100' => '角',
    '1.000' => '元'
);

$toTime = strtotime('00:00:00');
$sql="select id,wjorderId,actionNo,actionTime,fpEnable,playedId,type,left(actionData,15) as shows,beiShu,mode,actionNum,lotteryNo,bonus,isDelete,kjTime,zjCount from {$this->prename}bets where  isDelete=0 and uid={$this->user['uid']} and actionTime>{$toTime} order by id desc limit 10";

if ($list = $this->getRows($sql, $actionNo['actionNo'])) {
    foreach ($list as $var) {
?>
	<tr data-code="<?= json_encode($var) ?>">
		<td><a href="/index.php/record/betInfo/<?= $var['id'] ?>" title="投注信息" button="关闭:defaultModalCloase" width="95%"  target="modal"><?= $var['wjorderId'] ?></a></td>

		<td> <?= $var['actionNo'] ?></li>

	<td><?= $var['beiShu'] ?>倍</li>
		<td><?= $modes[$var['mode']] ?></li>


	
		<td>
		<?php
				if($var['isDelete']==1){
					echo '<font color="#999999">已撤单</font>';
				}elseif(!$var['lotteryNo']){
					echo '<font color="#009900">未开奖</font>';
				}elseif($var['zjCount']){
					echo '<font color="red">已派奖</font>';
				}else{
					echo '未中奖';
				}
			?>
			</td>

		<td>

		<?php
        if ($var['lotteryNo'] || $var['isDelete'] == 1 || $var['kjTime'] < $this->time) {
?>
            --
        <?php
        } else {
?>
            <a target="ajax" call="gameFreshOrdered"  onajax="confirmCancel" dataType="json" href="/index.php/game/deleteCode/<?= $var['id'] ?>">撤单</a>
        <?php
        }
?>
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