<?php
	// 帐号限制
	if($_REQUEST['username']&&$_REQUEST['username']!="用户名"){
		$_REQUEST['username']=wjStrFilter($_REQUEST['username']);
		if(!ctype_alnum($_REQUEST['username'])) throw new Exception('用户名包含非法字符,请重新输入');
		$userWhere="and username like '%{$_REQUEST['username']}%'";
	}
	
	if($_REQUEST['card_str']){
		$card_str="and card_str like '%{$_REQUEST['card_str']}%'";
	}
	
	// 时间限制
	if($_REQUEST['fromTime'] && $_REQUEST['toTime']){
		$fromTime=strtotime($_REQUEST['fromTime']);
		$toTime=strtotime($_REQUEST['toTime'])+24*3600;
		$timeWhere="and use_time between $fromTime and $toTime";
	}elseif($_REQUEST['fromTime']){
		$fromTime=strtotime($_REQUEST['fromTime']);
		$timeWhere="and use_time>=$fromTime";
	}elseif($_REQUEST['toTime']){
		$toTime=strtotime($_REQUEST['toTime'])+24*3600;
		$timeWhere="and use_time<$fromTime";
	}
	
	$sql="select * from {$this->prename}card where status=1 $userWhere $timeWhere $card_str order by use_time desc";
	//echo $sql;
	$data=$this->getPage($sql, $this->page, $this->pageSize);
?>

<script type="text/javascript">
$(function(){
	$('.tabs_involved input[name=username]')
	.focus(function(){
		if(this.value=='用户名') this.value='';
	})
	.blur(function(){
		if(this.value=='') this.value='用户名';
	})
	.keypress(function(e){
		if(e.keyCode==13) $(this).closest('form').submit();
	});
	
});
</script>

<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
    <header>
    	<h3 class="tabs_involved">兑换记录
            <div class="submit_link wz">
            	<form action="/index.php/Card/record" target="ajax" call="defaultSearch" dataType="html">
				 卡密：<input name="card_str" type="text" style="width:100px;" value="卡密"/>&nbsp;&nbsp;
				 
                会员：<input name="username" type="text" style="width:100px;" value="用户名"/>&nbsp;&nbsp;
                时间：从 <input type="date" style="width:75px;" name="fromTime"/> 到 <input type="date" style="width:75px;" name="toTime"/>&nbsp;&nbsp;
                <input type="submit" value="查找" class="alt_btn">
                <input type="reset" value="重置条件">
                </form>
            </div>
        </h3>
    </header>
    <div class="tab_content">
	<table class="tablesorter" cellspacing="0"> 
	<thead> 
		<tr> 
			<th>卡密</th> 
			<th>用户</th> 
            <th>面值(元)</th> 
			<th>兑换日期</th> 
			<th>操作</th> 
		</tr> 
	</thead> 
	<tbody> 
		<?php if($data['data']) foreach($data['data'] as $var){
		?>
		<tr> 
			<td><?=$var['card_str']?></td> 
			<td><?=$var['username']?></td>
            <td><?=$var['price']?></td> 
			<td><?=date('Y-m-d H:i:s',$var['use_time'])?></td> 
			<td>
			<a href="/index.php/Card/recordDel/<?=$var['id']?>" target="ajax" call="pointHandle" dataType="json">删除</a>
            </td> 
		</tr>
		<?php }else{ ?>
			<tr>
				<td colspan="5">暂时没有兑换记录</td>
			</tr>
		<?php } ?>
	</tbody> 
    </table>
	<footer>
	<?php
		$rel=get_class($this).'/record-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'betLogSearchPageAction'); 
	?>
	</footer>
    </div><!-- end of .tab_container -->
</article><!-- end of content manager article -->
