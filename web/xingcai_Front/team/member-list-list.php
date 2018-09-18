 
 <?php
	$sql="select * from {$this->prename}links where enable=1 and uid={$this->user['uid']}";
	if($_GET['uid']=$this->user['uid']) unset($_GET['uid']);
	$data=$this->getPage($sql, $this->page, $this->pageSize);
	?>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="grayTable">
			<tr class="table_b_th">
			<td>编号</td>
            <td>类型</td>
			<td>返点</td>
			<td>操作</td>
		</tr>
	<?php if($data['data']) foreach($data['data'] as $var){ ?>
		<tr>
			<td><?=$var['lid']?></td>
			<td><?php if($var['type']){echo'代理';}else{echo '会员';}?></td>
			<td><?=$var['fanDian']?>%</td>
			<td><!--a href="/index.php/team/linkUpdate/<?=$var['lid']?>" style="color:#333;" target="modal"  width="420" title="修改注册链接" modal="true" button="确定:dataAddCode|取消:defaultCloseModal">修改</a> | -->
			<a onclick="hqlj(<?=$var['lid']?>);" href="javascript:void(0)">获取链接</a> | <a onclick="sclj(<?=$var['lid']?>);" href="javascript:void(0)">删除</a> </td>
           
		</tr>
		<?php }else{ ?>
            <tr>
                <td colspan="7" align="center">没有相关记录</td>
            </tr>
	<?php } ?>
</table>
	<?php 
        $this->display('inc_page.php',0,$data['total'],$this->pageSize, '/index.php/team/linkList-{page}');
    ?>
	
<script type="text/javascript">
function hqlj(num){
	layer.open({
	  type: 2,
	  area: ['460px', '300px'],
	  zIndex:1999,
	  //fixed: false, //不固定
	  title:'获取链接',
	  scrollbar: false,//屏蔽滚动条
	  content:'/index.php/team/getLinkCode/'+num
	});
	return false;
}
function sclj(num){
	layer.open({
	  type: 2,
	  area: ['460px', '300px'],
	  zIndex:1999,
	  //fixed: false, //不固定
	  title:'删除链接',
	  scrollbar: false,//屏蔽滚动条
	  content:'/index.php/team/linkDelete/'+num
	});
	return false;
}
</script>