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
function userSortBeforeSubmit(){
	//alert(this.name);
}
function memberUserList(err, data){
	if(err){
		alert(err);
	}else{
		$('.tab_content').html(data);
	}
}
function changeFormAction(userSort){
	$('.submit_link input[name=paixu]').val($(userSort).attr('sort'));
	//$('.submit_link').attr('action','/admin.php/Member/listUser/'+$(userSort).attr('sort'));
}
</script>
<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
    <header>
    	<h3 class="tabs_involved">中奖列表
        </h3>
    </header>
    <div class="tab_content">
		<?php $this->display("choujiang/list-lucky.php") ?>
    </div>
</article>