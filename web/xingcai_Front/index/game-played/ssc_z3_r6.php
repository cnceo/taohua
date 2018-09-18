<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<div class="pp" action="ssc_z3_r6"  length="3" random="combineRandom">
<div id="wei-shu" length="3" class="lotteryMember" >
	<dl id="poschoose"><dt>选择位置:</dt>
		<dd><input type="checkbox" class="posChoose" value="16">万位</dd>
		<dd><input type="checkbox" class="posChoose" value="8">千位</dd>
		<dd><input type="checkbox" class="posChoose" value="4">百位</dd>
		<dd><input type="checkbox" class="posChoose" value="2">十位</dd>
		<dd><input type="checkbox" class="posChoose" value="1">个位</dd>
	</dl>
	</div>
	<div class="title"><H3>任三组六</H3></div>
	<input type="button" name="kk" value="0" class="code min s" />
	<input type="button" name="kk" value="1" class="code min d" />
	<input type="button" name="kk" value="2" class="code min s" />
	<input type="button" name="kk" value="3" class="code min d" />
	<input type="button" name="kk" value="4" class="code min s" />
	<input type="button" name="kk" value="5" class="code max d" />
	<input type="button" name="kk" value="6" class="code max s" />
	<input type="button" name="kk" value="7" class="code max d" />
	<input type="button" name="kk" value="8" class="code max s" />
	<input type="button" name="kk" value="9" class="code max d" />
	<input type="button" value="清" class="action none" />
    <input type="button" value="双" class="action even" />
    <input type="button" value="单" class="action odd" />
    <input type="button" value="小" class="action small" />
    <input type="button" value="大" class="action large" />
    <input type="button" value="全" class="action all" />
</div>
<?php $maxPl=$this->getPl($this->type, $this->played); ?>
<script type="text/javascript">
$(function(){
	gameSetPl(<?=json_encode($maxPl)?>);
})
</script>
<script type="text/javascript">  
   var m=$("input:checkbox:checked").length;
   $("#select").html(m);
   $("#nums").html(Combination(m, 3));
   $("input:checkbox").click(function(){
       var m=$("input:checkbox:checked").length;
       $("#select").html(m); 
       $("#nums").html(Combination(m, 3));
   });
</script>