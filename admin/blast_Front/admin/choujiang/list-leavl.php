<?php
	$sql="select * from blast_leavl ";
	
	
	$data=$this->getPage($sql, $this->page, $this->pageSize);
?>
<input type="hidden" value="<?=$this->user['username']?>" />
<table class="tablesorter" cellspacing="0"> 
<thead> 
    <tr> 
        <th>id</th>  
        <th>最小充值金额/最低余额</th>
		<th>最大充值金额</th>
		<th>最低中奖金额</th>
        <th>最高中奖金额</th>   
        <th>类型</th>   
        <th>操作</th> 
    </tr> 
</thead> 
<tbody id="nav01"> 
<?php
	if($data['data']) foreach($data['data'] as $var){ ?>
    <tr> 
        <td><?=$var['id']?></td> 
        <td><?=$var['min_cz_money']?></td> 
        <td><?=$var['max_cz_money']?></td> 
        <td><?=$var['min_prize_money']?></td> 
        <td><?=$var['max_prize_money']?></td> 
        <td><?php if($var['type']==1){echo '充值抽奖';}else{echo '余额抽奖';}?></td> 
        <td><a href="#" onclick="memberEditLeavl(<?=$var['id']?>)"> 编辑</a> | <a href="/index.php/system/deleteLeavl/<?=$var['id']?>" target="ajax" call="memberReloadLeavl">删除</a></td> 
    </tr>
   <?php } ?>
</tbody> 
</table>
<footer>
	<?php
		$rel=get_class($this).'/index-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'defaultReplacePageAction');
	?>
</footer>
<script type="text/javascript">  
ghhs("nav01","tr");  
</script>