<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<?php 	$codeNum=$this->getValue("select codeNum from {$this->prename}played where id={$this->played}"); ?>
<div maxlen="<?=$codeNum?>" class="pp" action="tz11x5WeiInput" length="2" >
	<div id="wei-shu" length="2" class="lotteryMember" >
	<dl id="poschoose"><dt>选择位置:</dt>
		<dd><input type="checkbox" class="posChoose" value="16">万位</dd>
		<dd><input type="checkbox" class="posChoose" value="8">千位</dd>
		<dd><input type="checkbox" class="posChoose" value="4">百位</dd>
		<dd><input type="checkbox" class="posChoose" value="2">十位</dd>
		<dd><input type="checkbox" class="posChoose" value="1">个位</dd>
	</dl>
	</div>
	<textarea id="textarea-code"></textarea>
</div>
<?php $maxPl=$this->getPl($this->type, $this->played); ?>
<script type="text/javascript">
$(function(){
	gameSetPl(<?=json_encode($maxPl)?>);
})
</script>
