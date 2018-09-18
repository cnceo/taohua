<?php 
	$sql="select * from {$this->prename}leavl where id=?";
	$userData=$this->getRow($sql, $args[0]);
?>

 
<div>
<input type="hidden" value="<?=$this->user['username']?>" />
<form action="/index.php/system/leavlUpdateed" method="post" enctype="multipart/form-data">
	
	<input type="hidden" name="id" value="<?=$args[0]?>"/>
	<table cellpadding="2" cellspacing="2" class="popupModal">
		<tr>
			<td class="title" width="180"><?php if ($userData['type'] == 1){?>最小充值金额<?php }else{?>最低余额<?php }?></td>
			<td><input type="text" name="min_cz_money" value="<?=$userData['min_cz_money']?>"/></td>
		</tr>
		<?php if ($userData['type'] == 1){?>
		<tr>
			<td class="title" width="180">最大充值金额</td>
			<td><input type="text" name="max_cz_money" value="<?=$userData['max_cz_money']?>"/></td>
		</tr>
		<?php }?>
		<tr>
			<td class="title" width="180">最低中奖金额</td>
			<td><input type="text" name="min_prize_money" value="<?=$userData['min_prize_money']?>"/></td>
		</tr>
		<tr>
			<td class="title" width="180">最高中奖金额</td>
			<td><input type="text" name="max_prize_money" value="<?=$userData['max_prize_money']?>"/></td>
		</tr>
		<tr>
			<td class="title" width="180">类型</td>
			<td><select name='type'><option value='1' <?php if ($userData['type'] == 1){?>selected<?php }?>>充值抽奖</option><option  value='2'  <?php if ($userData['type'] == 2){?>selected<?php }?>>余额抽奖</option></select></td>
		</tr>
	</table>
</form>
</div>