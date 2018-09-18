<?php
	$para=$_GET;
	
	// 用户限制
	if($para['username'] && $para['username']!="用户名"){
		$userWhere="and username like '%{$para['username']}%'";
	}

	// 时间限制
	if($para['fromTime'] && $para['toTime']){
		$fromTime=strtotime($para['fromTime']);
		$toTime=strtotime($para['toTime'])+24*3600;
		$timeWhere="and actionTime between $fromTime and $toTime";
	}elseif($para['fromTime']){
		$fromTime=strtotime($para['fromTime']);
		$timeWhere="and actionTime>=$fromTime";
	}elseif($para['toTime']){
		$toTime=strtotime($para['toTime'])+24*3600;
		$timeWhere="and actionTime<$fromTime";
	}

	$sql="select * from blast_yj_log where 1 $timeWhere $userWhere and type=1 order by id desc";
	
	//echo $sql;
	$data=$this->getPage($sql, $this->page, $this->pageSize);
?>
<article class="module width_full">
    <header>
		<h3 class="tabs_involved">分红记录列表
		<form action="/index.php/bonus/bonusLog" target="ajax" datatype="html" call="defaultSearch" class="submit_link wz">
                用户名：<input type="text" class="alt_btn" style="width:60px;" name="username">&nbsp;&nbsp;
                时间：从 <input type="date" class="alt_btn" name="fromTime"> 到 <input type="date" class="alt_btn hasDatepicker" name="toTime">&nbsp;&nbsp;
                <input type="submit" value="查找" class="alt_btn">
        </form>
		</h3>
    </header>
<table class="tablesorter" cellspacing="0">
<thead>
    <tr>
        <th>UserID</th>
        <th>用户名</th>
        <th>金额</th>
        <th>领取时间</th>
        <th>操作</th>
    </tr>
</thead>
<tbody>
<?php if($data['data']) foreach($data['data'] as $var){ ?>
    <tr>
        <td><?=$var['uid']?></td>
        <td><?=$var['username']?></td>
        <td><?=$var['amount']?></td>
        <td><?=date("m-d H:m:s", $var['actionTime'])?></td>
        <td align="center">
        
            <a href="/index.php/bonus/bonusyjLogDelete/<?=$var['id']?>" target="ajax" call="bonusLogDelete" dataType="html">删除</a>
        
        </td>
    </tr>
<?php }else{ ?>
    <tr>
        <td colspan="8" align="center">暂时没有分红记录。</td>
    </tr>
<?php } ?>
</tbody>
</table>
<footer>
<?php
		$rel=get_class($this).'/bonusYj-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'defaultReplacePageAction');
?>
</footer>
</article>
