<?php
	$sql="select * from blast_member_prize order by add_time desc";
	
	$data=$this->getPage($sql, $this->page, $this->pageSize);
?>
<input type="hidden" value="<?=$this->user['username']?>" />
<table class="tablesorter" cellspacing="0"> 
<thead> 
    <tr> 
        <th>id</th>  
        <th>充值金额</th>
		<th>中奖时间</th>
		<th>状态</th>
        <th>用户名称</th>   
        <th>类型</th>   
        <th>中奖金额</th>   
        <th>充值抽奖区间ID</th>   
        
        <!-- <th>操作</th>  -->
    </tr> 
</thead> 
<tbody id="nav01"> 
<?php
	if($data['data']) foreach($data['data'] as $var){ ?>
    <tr> 
        <td><?=$var['id']?></td> 
        <td><?=$var['amount']?></td> 
        <td><?=date("Y-m-d H:i:s",$var['add_time'])?></td> 
        <td><?php if($var['status'] == 1){echo '已结束';}else{echo '未抽奖';}?></td> 
        <td><?php echo $this->getValue("select username from {$this->prename}members where uid={$var['uid']}")?></td> 
        <td><?php if($var['type']==1){echo '充值抽奖';}else{echo '余额抽奖';}?></td> 
        <td><?=$var['money']?></td> 

        <td><?=$var['leval_id']?></td> 
        <!-- <td><a href="/admin778899.php/system/deleteLeavl/<?=$var['id']?>" target="ajax" call="memberReloadLeavl">删除</a></td>  -->
    </tr>
   <?php } ?>
</tbody> 
</table>
<footer>
	<?php
		$rel=get_class($this).'/lucky-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'defaultReplacePageAction');
	?>
</footer>
<script type="text/javascript">  
ghhs("nav01","tr");  
</script>