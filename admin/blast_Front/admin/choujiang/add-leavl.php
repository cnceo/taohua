<article class="module width_full">
<header><h3 class="tabs_involved">新增奖金区间</h3></header>
<table>
<tr><td width="360">
	<form action="" method="post" target="ajax">
		<table class="tablesorter table2" cellspacing="0" width="100%">

			<tr>
				<td><span class="aq-txt">抽奖类型</span></td>
			<td><select id='type'  onchange="gradeChange()"><option value='1' selected>充值抽奖</option><option  value='2'>余额抽奖</option></select></td>
			</tr>
			<tr>
				<td><span class="aq-txt" id='min_money'>最小充值金额</span></td>
				<td><input type="text" id="min_cz_money" class="t-c" value="" /></td>
			</tr>
			<tr  id='max_money'>
				<td><span class="aq-txt">最大充值金额</span></td>
				<td><input id="max_cz_money" type="text" class="t-c" value="" /></td>
			</tr>
			<tr>
				<td><span class="aq-txt">最低中奖金额</span></td>
				<td><input id="min_prize_money" type="text" class="t-c" value="" /></td>
			</tr>
			<tr>
				<td><span class="aq-txt">最高中奖金额</span></td>
				<td><input type="text" id="max_prize_money" class="t-c" value="" /></td>
			</tr>
			<tr style="margin-top:20px;">
				<td></td>
				<td><input type="button" class="alt_btn" value="增加区间"/></td>
			</tr>
		</table>
	</form>
	</td>
</tr>
</table>
</article>
<script type="text/javascript">
	$('.alt_btn').click(function(){
		var min_cz_money = $('#min_cz_money').val();
		var max_cz_money = $('#max_cz_money').val();
		var min_prize_money = $('#min_prize_money').val();
		var max_prize_money = $('#max_prize_money').val();
		var type = $('#type').val();
		if (type == 1) {
			if (min_cz_money == '' || max_cz_money == '' || min_prize_money== '' || max_prize_money == '') {
				alert('以上都是必填项,请填完，谢谢');return false;
			}
			if (parseFloat(min_cz_money) > parseFloat(max_cz_money)) {
				alert('最小充值金额不能大于最大充值金额');return false;
			}
		} else {
			if (min_cz_money  == '' || min_prize_money== '' || max_prize_money == '') {
				alert('以上都是必填项,请填完，谢谢');return false;
			}
		}
		if (parseFloat(min_prize_money) > parseFloat(max_prize_money)) {
				alert('最低中奖金额不能大于最高中奖金额');return false;
			}
		$.ajax({
			url:'/index.php/choujiang/add_leavls',
			type:'post',
			dataType:'json',
			data:{'min_cz_money':min_cz_money,'max_cz_money':max_cz_money,'min_prize_money':min_prize_money,'max_prize_money':max_prize_money,'type':type},
			success:function(res){
				if (res == 1) {
					alert('新增区间成功');
					$('#min_cz_money').val('');
					$('#max_cz_money').val('');
					$('#min_prize_money').val('');
					$('#max_prize_money').val('');
				}else {
					alert('新增区间成失败');
				}
			}
		})
	})

function gradeChange(){
	type = $("#type").val();
	if (type == 2) {
		$('#min_money').html('使用余额');
		$('#max_money').slideToggle();
	} else {
		$('#min_money').html('最小充值金额');
		$('#max_money').show();
	}
}
</script>