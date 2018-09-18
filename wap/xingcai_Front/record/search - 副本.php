<div id="datePlugin"></div>
<link href="/newskin/riqi/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/newskin/riqi/js/jquery-1.9.1.js" ></script>
<script type="text/javascript" src="/newskin/riqi/js/date.js" ></script>
<script type="text/javascript" src="/newskin/riqi/js/iscroll.js" ></script>
<script type="text/javascript">
$(function(){
	
	$('.search form input[name=betId]')
	.focus(function(){
		if(this.value=='输入单号') this.value='';
	})
	.blur(function(){
		if(this.value=='') this.value='输入单号';
	})
	.keypress(function(e){
		if(e.keyCode==13) $(this).closest('form').submit();
	});
	
	$('.chazhao').click(function(){
		$(this).closest('form').submit();
	});
	
	$('.bottompage a[href]').live('click', function(){
		$('.ibox-content').load($(this).attr('href'));
		return false;
	});

});
function recordSearch(err, data){
	if(err){
		$.alert(err);
	}else{
		$('.ibox-content').html(data);
	}
}
function recodeRefresh(){
	$('.ibox-content').load(
		$('.bottompage .pagecurrent').attr('href')
	);
}

function deleteBet(err, code){
	if(err){
		$.alert(err);
	}else{
		recodeRefresh();
	}
}
</script>
<div id="contentBox">
    <form action="/index.php/record/searchGameRecord/<?=$this->userType?>" dataType="html" call="recordSearch" target="ajax">
      
        <div id="searchBox" class="re">
        	<div class="inlineBlock">
            	<label>投注时间：</label><input type="text" class="input150" value="<?= $this->iff($_REQUEST['fromTime'], $_REQUEST['fromTime'], date('Y-m-d H:i', $GLOBALS['fromTime'])) ?>" name="fromTime" id="startTime" /> <span class="image"></span>
            </div>
            <label>至</label>
            <div class="inlineBlock">
            	<input type="text" class="input150" value="<?= $this->iff($_REQUEST['toTime'], $_REQUEST['toTime'], date('Y-m-d H:i', $GLOBALS['toTime'])) ?>" id="endTime" name="toTime" /> <span class="image" ></span>
            </div>
            <div class="inlineBlock">
                <label>彩种名称：</label>
                <select class="team" name="lotteryid" id="lotteryid">
                 <option value="0" <?=$this->iff($_REQUEST['type']=='', 'selected="selected"')?>>全部彩种</option>
            <?php
                if($this->types) foreach($this->types as $var){ 
                    if($var['enable']){
            ?>
            <option value="<?=$var['id']?>" <?=$this->iff($_REQUEST['type']==$var['id'], 'selected="selected"')?>><?=$this->iff($var['shortName'], $var['shortName'], $var['title'])?></option>

            <?php }} ?>
        </select>
            </div>
            <div class="inlineBlock">
            	<label>彩种状态：</label><select id="methodid"  name="methodid"  class="team">
				 <option value="0" selected>所有状态</option>
            <option value="1">已派奖</option>
            <option value="2">未中奖</option>
            <option value="3">未开奖</option>
            <option value="4">追号</option>
            <option value="5">撤单</option>
        </select>
		 <!--select name="mode" class="text5">
            <option value="" selected>全部模式</option>
            <option value="1.000">1元</option>
            <option value="2.000">元</option>
            <option value="0.200">角</option>
            <option value="0.020">分</option>
            <option value="0.002">厘</option>
        </select-->
            </div>            
       
        </div>
        <div class="search_br"><input type="button" value="查询" class="formCheck chazhao" /></div>
    </form>
    </div>


<?php $this->display('record/search-list.php'); ?>
 </div>

<div id="datePlugin"></div>
<script type="text/javascript">
$(function(){
	$('#startTime').date({theme:"datetime"});
	$('#endTime').date({theme:"datetime"});
});
</script>