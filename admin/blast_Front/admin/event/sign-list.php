
<?php
	// 帐号限制
	if($_REQUEST['username']&&$_REQUEST['username']!="用户名"){
		$userWhere="and u.username like '%{$_REQUEST['username']}%'";
	}

	// 状态限制
	if($_REQUEST['state']){
		$typeWhere="and s.state={$_REQUEST['type']}";
	}

	// 时间限制
	if($_REQUEST['fromTime'] && $_REQUEST['toTime']){
		$fromTime=strtotime($_REQUEST['fromTime']);
		$toTime=strtotime($_REQUEST['toTime'])+24*3600;
		$timeWhere="and s.g_time between $fromTime and $toTime";
	}elseif($_REQUEST['fromTime']){
		$fromTime=strtotime($_REQUEST['fromTime']);
		$timeWhere="and s.g_time>=$fromTime";
	}elseif($_REQUEST['toTime']){
		$toTime=strtotime($_REQUEST['toTime'])+24*3600;
		$timeWhere="and s.g_time<$fromTime";
	}
	$sql="select s.*, u.username userName, e.title, e.content from {$this->prename}event_sign s, {$this->prename}events e, {$this->prename}members u where s.uid=u.uid and s.goodId=e.id $userWhere $typeWhere $timeWhere order by s.id desc";

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
    <header>
    	<h3 class="tabs_involved">兑换订单
            <div class="submit_link wz">
            	<form action="/index.php/Event/signList" target="ajax" call="defaultSearch" dataType="html">
                会员：<input name="username" type="text" style="width:75px;" value="用户名"/>&nbsp;&nbsp;
                时间：从 <input type="date" style="width:75px;" name="fromTime"/> 到 <input type="date" style="width:75px;" name="toTime"/>&nbsp;&nbsp;
                <select name="state" style="width:90px;">
                    <option value="">所有状态</option>
                    <option value="0">正常</option>
                    <option value="1">已派奖</option>
                    <option value="2">不可用</option>
                </select>&nbsp;&nbsp;
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
			<th>单号</th> 
			<th>用户</th>
            <th width="100">活动</th>
            <th width="65">活动编号</th>
			<th width="350px;">内容</th>
            <th width="65">报名时间</th>
			<th width="65">兑换日期</th>
			<th width="65">状态</th> <!--（删除/正常/领奖/不可用）-->
			<th>操作</th> 
		</tr> 
	</thead> 
	<tbody> 
		<?php if($data['data'])
            foreach($data['data'] as $var){
                $state = "";
                if($var['isdelete'])
                    $state ="<font color='red'>已删除</font>";
                else
                {
                    switch($var['state'])
                    {
                        case 0:
                            $state = "正常";
                            break;
                        case 1:
                            $state = "已派奖";
                            break;
                        case 2:
                            $state = "不可用";
                            break;
                    }
                }
		?>
		<tr> 
			<td><?=$var['id']?></td> 
			<td><?=$var['userName']?></td>
            <td><?=$var['title']?></td>
            <td><?=$var['rate_value']+1?></td>
			<td><?=$var['content']?></td>
			<td><?=date("Y-m-d H:i:s",$var['c_time'])?></td>
            <td><?=$var['g_time'] ? date("Y-m-d H:i:s",$var['g_time']) : ""?></td>
            <td><?=$state?></td>
			<td>
                <?php if(!$var['isdelete']){?>
                <a href="/index.php/Event/signDel/<?=$var['id']?>" target="ajax" call="eventsHandle" dataType="json">删除</a>
                <?php }?>
            </td> 
		</tr>
		<?php }else{ ?>
			<tr>
				<td colspan="5">暂时没有兑换订单</td>
			</tr>
		<?php } ?>
	</tbody> 
    </table>
	<footer>
	<?php
		$rel=get_class($this).'/signList-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'betLogSearchPageAction'); 
	?>
	</footer>
    </div><!-- end of .tab_container -->
</article><!-- end of content manager article -->
