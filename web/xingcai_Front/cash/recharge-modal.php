<?php
	$sql="select r.* from {$this->prename}member_recharge r where r.id={$args[0]}";
	$rechargeInfo=$this->getRow($sql, $args[0]);
	if($rechargeInfo['mBankId']){
		$sql="select mb.username accountName, mb.account account, b.name bankName from {$this->prename}members u,{$this->prename}member_bank mb, {$this->prename}bank_list b where b.isDelete=0 and u.uid={$rechargeInfo['uid']} and mb.id={$rechargeInfo['mBankId']} and mb.bankId=b.id";
		$bankInfo=$this->getRow($sql);
	}
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
      <th>用户</th>
    </tr> 
  </thead>
  <tbody>
    <tr>
      <td><span style="color: #F00;"><?=$rechargeInfo['username']?></span></td>
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
      <th>充值金额</th>
    </tr> 
  </thead>
  <tbody>
    <tr>
      <td><span style="color: #F00;"><?=$rechargeInfo['amount']?>元</span></td>
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
      <th>充值前资金</th>
    </tr> 
  </thead>
  <tbody>
    <tr>
      <td><span style="color: #F00;"><?=number_format($rechargeInfo['coin'],3)?>元</span></td>
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
      <th>充值银行</th>
    </tr> 
  </thead>
  <tbody>
    <tr>
      <td><span style="color: #F00;"><?=$this->ifs($bankInfo['bankName'], '--')?></span></td>
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
      <th>充值时间</th>
    </tr> 
  </thead>
  <tbody>
    <tr>
      <td><span style="color: #F00;"><?=date("Y-m-d H:i:s",$rechargeInfo['rechargeTime'])?></span></td>
    </tr>
  </tbody>
</table>