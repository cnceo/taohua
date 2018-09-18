<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
<header><h3 class="tabs_involved">新增奖金区间</h3></header>
<table>
<tr><td width="360">
	<form action="/admin778899.php/member/added" method="post" target="ajax" onajax="beforeAddMember" call="addMember">
		<table class="tablesorter table2" cellspacing="0" width="100%">
			<tr>
				<td><span class="aq-txt">最小充值金额</span></td>
				<td><input type="text" name="min_cz_money" class="t-c" value="" /></td>
			</tr>
			<tr>
				<td><span class="aq-txt">最大充值金额</span></td>
				<td><input name="password" type="password" class="t-c" value="" /></td>
			</tr>
			<tr>
				<td><span class="aq-txt">最低中奖金额</span></td>
				<td><input id="cpasswd" type="password" class="t-c" value="" /></td>
			</tr>
			<tr>
				<td><span class="aq-txt">最高中奖金额</span></td>
				<td><input type="text" name="qq" class="t-c" value="" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="alt_btn" value="增加成员"/></td>
			</tr>
		</table>
	</form>
	</td>
	<td>
		<table class="tablesorter table2" cellspacing="0"  width="100%" style="border:#ccc solid 1px;">
			<thead>
			<tr>
				<td colspan="3"><strong>新增会员成功</strong></td>
			</tr>
			</thead>
			<tr>
				<td><span class="aq-txt">用户名：</span></td>
				<td><input type="text" id="username" class="t-c" value="" /></td>
				<td><input type="button" class="copy" src="#username" value="复制"/></td>
			</tr>
			<tr>
				<td><span class="aq-txt">密码：</span></td>
				<td><input type="text" id="password" class="t-c" value="" /></td>
				<td><input type="button" class="copy" src="#password" value="复制"/></td>
			</tr>
		</table>
	</td>
</tr>
</table>
</article>