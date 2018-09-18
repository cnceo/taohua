<?php
    $this->getSystemSettings();
	$sql="select r.*,u.username username from {$this->prename}member_recharge r, {$this->prename}members u where r.uid=u.uid and r.id=?";
	$rechargeData=$this->getRow($sql, $args[0]);

    $sql="select u.* from {$this->prename}member_recharge r, {$this->prename}members u where r.uid=u.uid and r.id=?";
    $user=$this->getRow($sql, $args[0]);

    $sql2="select * from {$this->prename}member_level ";
    $levels=$this->getRows($sql2);
?>
<div>
<input type="hidden" value="<?=$this->user['username']?>" />
<form action="/index.php/business/rechargeHandle"  target="ajax" method="post" call="rechargeSubmitCode" onajax="rechargeBeforeSubmit" dataType="html">
	<input type="hidden" name="id" value="<?=$args[0]?>"/>
<table cellpadding="0" cellspacing="0" width="320" class="layout">
	<tr>
		<th>用户名：</th>
		<td><input type="text" value="<?=$rechargeData['username']?>" /></td>
	</tr>
	<tr>
		<th>充值金额：</th>
		<td><input type="text" name="amount" readonly="readonly" value="<?=$rechargeData['amount']?>" /></td>
	</tr>
    <tr>
        <th>会员等级：</th>
        <td>
            <select name="grade" >
                <?php foreach($levels as $level){ ?>
                <option <?=$this->iff($user['grade']==$level['id'], 'selected')?> value="<?=$level['id']?>"><?=$level['levelName']?></option>
                <?php } ?>
            </select>
        </td>
    </tr>
	<tr>
		<th>实际到账：</th>
		<td><input type="text" name="rechargeAmount" value="<?=$this->iff($this->settings['czzs'],number_format($rechargeData['amount']*(1+$this->settings['czzs']/100.00),2,'.',''),$rechargeData['amount'])?>"/></td>
	</tr>
    <tr>
        <th>会员到期日：</th>
        <td><input type="date" style="width:180px" class="alt_btn" name="endTime" value="<?=date("Y-m-d",$user['endTime']) ?>" /></td>
    </tr>
	<tr>
		<th><span class="spn9">提示：</span></th>
		<td><span class="spn9">赠送充值额的<?=$this->settings['czzs']?>%</span></td>
	</tr>
</table>
</form>
</div>