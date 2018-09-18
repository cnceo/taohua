<?php
	$sql="select count(id) from {$this->prename}message_receiver where to_uid=? and is_readed=0 and is_deleted=0";
	$num=$this->getValue($sql,$this->user['uid']);
?>
   <span id="msg" style="margin-left: -4px;"><?=$this->ifs($num,'0')?></span>