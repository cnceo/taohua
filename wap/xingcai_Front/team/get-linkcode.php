<div>
	<table cellpadding="2" cellspacing="2" class="form-tips" style="width:100%;margin-top: -5px;">
	<?php 
		$sql="select * from {$this->prename}links where lid=?";
		if(!$linkData=$this->getRow($sql, $args[0])){
	?>
		<tr>
        	<td align="center" colspan="2" class="title">该注册链接不存在，或者已经失效！</td>
        </tr>	
	<?php  
		}else{
			$pd = "select * from {$this->prename}members where uid=?";
			$parentData = $this->getRow($pd, $linkData['uid']);
	?>
         <tr>
        	<td class="title">上级会员：</td>
			<td><?=$parentData['username']?></td>
        </tr>
		<tr>
			<td class="title">返点：</td>
			<td><?=$linkData['fanDian']?>%</td>
		</tr>
        <tr>
        	<td class="title">推广链接1：</td>
			<td><input class="t-c t-c-w1" style="width:310px" id="biao1" readonly="readonly" value="http://<?=$_SERVER['HTTP_HOST']?>/index.php/user/r/<?=$this->strToHex($this->myxor($linkData['lid']));?>" /></td>
        </tr>
     
        <tr>
        	<td class="title">操作：</td>
			<td><input type="button" onClick="copyUrl1()" value="复制" /></td>
        </tr>	

		<tr>
        	<td class="title">推广链接2：</td>
			<td><input class="t-c t-c-w1" style="width:310px" id="biao2" readonly="readonly" value="http://<?=$_SERVER['HTTP_HOST']?>/index.php/user/_api/<?=$this->strToHex($this->myxor($linkData['lid']));?>" /></td>
        </tr>
     
        <tr>
        	<td class="title">操作：</td>
			<td><input type="button" onClick="copyUrl2()" value="复制" /></td>
        </tr>				
     <?php }?>   
        
	</table>
 <style type="text/css"> 
 table input{    vertical-align: middle;
    position: relative;
    border: 1px solid #bbb;
    background: #fff;
    width: 100px;
    height: 35px;
    /* line-height: 24px; */
    border-radius: 3px;
    color: #666;
    font-family: 'Microsoft Yahei';}
 </style>
</div>
