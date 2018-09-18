<?php $this->display('inc_daohang1.php'); ?>
<link rel="stylesheet" href="/css/nsc_m/list.css?v=1.16.11.16">
<script type="text/javascript" src="/js/nsc_m/layer.js?v=1.16.12.4"></script>
<script type="text/javascript" src="/js/nsc_m/res.js?v=1.16.12.4"></script>
<script type="text/javascript" src="/js/nsc/main.js?v=1.16.12.4"></script>
<script type="text/javascript" src="/newskin/js/common.js"></script>
<script type="text/javascript" src="/skin/js/onload.js"></script>
<script type="text/javascript" src="/skin/js/function.js"></script>


<section class="wraper-page">
<form action="/index.php/safe/setCBAccount" method="post" target="ajax" onajax="safeBeforSetCBA" call="safeSetCBA">
<?php if($this->user['coinPassword']){ ?>
 <table width="100%" class="grayTable" border="0" cellspacing="1" cellpadding="4">
<tbody><tr>
  <td colspan="2"><b class="z_red_color">提示: *为必填信息　</b></td>
</tr>
  <tr>
    <td class="tdz3_left"><font class="star_color">*</font>开户银行：</td>
    <td class="tdz3_right">
     	<?php
            $myBank=$this->getRow("select * from {$this->prename}member_bank where uid=?", $this->user['uid']);
				$banks=$this->getRows("select * from {$this->prename}bank_list where isDelete=0 and id!=12 and id!=17 and id!=19 and id!=18 and id!=20 and id!=21 and id!=22 order by sort");
				
				$flag=($myBank['editEnable']!=1)&&($myBank);
			?>
			<select name="bankId" class="text" <?=$this->iff($flag, 'disabled')?>>
			<option value="">请选择...</option>
			<?php foreach($banks as $bank){ ?>
			<option value="<?=$bank['id']?>" <?=$this->iff($myBank['bankId']==$bank['id'], 'selected')?>><?=$bank['name']?></option>
			<?php } ?>
			</select>
    </td>
  </tr>

   <tr>
    <td class="tdz3_left"><font class="star_color">*</font>支行地址：</td>
    <td class="tdz3_right">
    <input type="text" name="countname" maxlength="20" value="<?=preg_replace('/^(\w{4}).*(\w{4})$/','\1***\2',htmlspecialchars($myBank['countname']))?>" <?=$this->iff($flag, 'readonly')?> /><br><span id="branch_msg" class="text_hint red">由1至20个字符或汉字组成，不能使用特殊字符</span>
    </td>
  </tr>
  <tr>
    <td class="tdz3_left"><font class="star_color">*</font><font id="khxm">开户姓名</font>：</td>
    <td class="tdz3_right">
    <input type="text" name="username" maxlength="5" value="<?=$this->iff($myBank['username'],mb_substr(htmlspecialchars($myBank['username']),0,1,'utf-8').'**')?>" <?=$this->iff($flag, 'readonly')?> /><br><span id="account_name_msg" class="text_hint red">请填写您的真实姓名，只能是中文字符，最长5个汉字，</span>
    </td>
  </tr>
  <tr>
    <td class="tdz3_left"><font class="star_color">*</font><font id="khzh">银行卡号</font>：</td>
    <td class="tdz3_right">
    <input type="text" name="account"  onpaste="return false" value="<?=preg_replace('/^(\w{4}).*(\w{4})$/', '\1***********\2',htmlspecialchars($myBank['account']))?>" onkeyup="value=value.replace(/[^\d]/g,'')" <?=$this->iff($flag, 'readonly')?>  maxlength="19"/><br><span id="account_msg" class="text_hint red">(银行卡卡号由16位或19位数字组成，只能手动输入，不能粘贴)</span>
    </td>
  </tr>
  <tr>
    <td class="tdz3_left"><font class="star_color">*</font><font id="khxm">提款密码</font>：</td>
    <td class="tdz3_right">
    <input type="password" name="coinPassword" value="<?=preg_replace('/^(\w{4}).*(\w{4})$/','\1***\2',htmlspecialchars($myBank['account']))?>"  class="text" <?=$this->iff($flag, 'readonly')?> /><br><span id="account_name_msg" class="text_hint red">为了你的资金安全，请验证提款密码。</span>
    </td>
  </tr>
</tbody></table>
    <div class="list_btn_box"><input type="submit" <?=$this->iff($flag, 'disabled')?> value="确认" class="buttonnormal">　
        <input type="button" value="返回" onclick="checkbackspace();" class="formReset"></div>

</form>


	<?php }else{?>	
		
	<div id="subContent_bet_re">
		<div id="error">
		<h3>
			<font class="hint_red">您还未设定提款密码，为了您的账户安全，请先设定好您的提款密码</font>
		</h3>
		<div class="yhlb_back"><a href="/index.php/safe/passwd">设置提款密码</a></div>
						</div>

﻿</div>	
		
<?php }?>
    </section> 
</body></html>