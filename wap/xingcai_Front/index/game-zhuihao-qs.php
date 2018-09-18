<?php
	if($list=$this->getGameNos($this->type, $args[1]))
	foreach($list as $var){
?>
<tr>
	<td><input type="checkbox" />
	<td><?=$var['actionNo']?></td>
	<td><input type="text" class="beishu" value="1" style="
    width: 2.5rem;
    height: 1.8rem;
    line-height: 1.8rem;
    text-align: center;
    border: 1px solid #dddddd;
    border-radius: 0.2rem;
    background: #f5f5f5;
    margin-right: 0.3rem;
"/></td>
	<td><span class="amount"><?=$args[0]?></span>元</td>
	<td><?=date('Y-m-d H:i:s', $var['actionTime'])?></td>
</tr>
<?php } ?>