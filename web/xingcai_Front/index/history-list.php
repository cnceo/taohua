<?php
	$sql="select type, time, number, data from blast_data where type={$args[0]}";
	$sql=$sql." order by number desc";
	$data=$this->getPage($sql, 1, true);
    $typename=$this->getValue("select title from blast_type where id=?",$args[0]);
	
	foreach($data['data'] as $k=>$t){
		$data['data'][$k]['time']=date('Y-m-d H:i', $t['time']);
		
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
      <th>彩种</th>
      <th>期号</th>
      <th>开奖号码</th>
      <th>开奖时间</th>
    </tr> 
  </thead>
<?php if($data['data']) foreach($data['data'] as $var){ ?>
  <tbody>
    <tr>
      <td><?=$typename?></td>
      <td><?=$var['number']?></td>
      <td><?=$var['data']?></td>
      <td><?= $var['time']?></td>
    </tr>
<?php } ?>
  </tbody>
</table>
<?php 
	$this->display('inc_page1.php',0,$data['total'],$this->pageSize, '/index.php/index/historyList-{page}/'.$args[0],$data,$typename);
?>