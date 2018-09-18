<?php
	$sql="select * from {$this->prename}card  order by add_time desc";
	//echo $sql;
	$data=$this->getPage($sql, $this->page, $this->pageSize);
?>


<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
    <header>
    <h3 class="tabs_involved">卡密列表
			<div class="submit_link wz"><input type="submit" value="添加卡密" onclick="addCards()" class="alt_btn"></div>
        </h3>
    </header>
    <div class="tab_content">
	<table class="tablesorter" cellspacing="0"> 
	<thead> 
		<tr> 
			<th>卡密</th> 
            <th>面值(元)</th> 
            <th>是否使用</th> 
			<th>添加日期</th> 
			<th>操作</th> 
		</tr> 
	</thead> 
	<tbody> 
		<?php if($data['data']) foreach($data['data'] as $var){
		?>
		<tr> 
			<td><?=$var['card_str']?></td> 
            <td><?=$var['price']?></td> 
			<td><?=date('Y-m-d H:i:s',$var['add_time'])?></td> 
			<td><? if($var['status']==1){?><span style="color:red">已使用</span><?}else{?><span style="color:green">未使用</span><?}?></td> 
			<td>
			<a href="/index.php/Card/recordDel/<?=$var['id']?>" target="ajax" call="pointHandle" dataType="json">删除</a>
            </td> 
		</tr>
		<?php }else{ ?>
			<tr>
				<td colspan="5">暂时没有卡密记录</td>
			</tr>
		<?php } ?>
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
