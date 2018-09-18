<?php
	$sql="select * from {$this->prename}events where isdelete=0 order by id desc";
	//echo $sql;
	$data=$this->getPage($sql, $this->page, $this->pageSize);
	//print_r($this);
	//echo get_class($this);
?>
<article class="module width_full">
    <header>
    	<h3 class="tabs_involved">兑换商品列表
			<div class="submit_link wz"><input type="submit" value="添加商品" onclick="eventEditEvents()" class="alt_btn"></div>
        </h3>
    </header>
    <div class="tab_content">
	<table class="tablesorter" cellspacing="0"> 
	<thead> 
		<tr> 
			<th>ID</th> 
			<th>内容</th>
            <th>首冲</th>
            <th>流水倍数</th>
            <th>返还</th>
            <th>最高</th>
			<th>时间</th> 
			<th>状态</th><!--开启 关闭-->
			<th>操作</th> 
		</tr> 
	</thead> 
	<tbody>
    <?php foreach($data['data'] as $k=>$var){?>
		<tr>
			<td><?=$var['id']?></td>
			<td style="width:350px;text-align:left;"><?=$var['content']?></td>
			<td><?=$var['coin']?></td>
			<td><?=$var['condition']?></td>
			<td><?=$var['rate_type']=='1' ? $var['rate'].'%' : $var['rebate']?></td>
			<td><?=$var['max_rebate']?></td>
			<td><?=date('Y-m-d',$var['start_time'])?>-<?=$var['end_time'] ? date('Y-m-d', $var['end_time']) : '永久'?></td>
			<td><?=$var['enable'] ? '<font color="green">开启</font>' : '<font color="red">关闭</font>'?></td>
			<td>
                <a href="/index.php/Event/eventOnoff/<?=$var['id'].'/'.$var['enable']?>" target="ajax" call="eventsHandle" dataType="json"><?=$var['enable'] ? "关闭" :"开启"?></a> |
                <a href="#" onclick="eventEditEvents(<?=$var['id']?>)">修改</a> |
                <a href="/index.php/Event/deleteEvent/<?=$var['id']?>" target="ajax" call="eventsHandle" dataType="json">删</a>
            </td>
		</tr>
    <?php }?>
	</tbody>
    </table>
	<footer>
	<?php
		$rel=get_class($this).'/index-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'betLogSearchPageAction'); 
	?>
	</footer>
    </div><!-- end of .tab_container -->
</article><!-- end of content manager article -->
