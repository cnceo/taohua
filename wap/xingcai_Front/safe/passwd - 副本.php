<?php $this->display('inc_daohang1.php'); ?>
<link rel="stylesheet" href="/css/nsc_m/m-list.css?v=1.17.1.23">
<script type="text/javascript" src="/js/nsc_m/res.js?v=1.16.12.4"></script>
       <section class="wraper-page">
	   <?php if($args[0]){ ?>
	   <div id="changeloginpass">
<div class="tab-first clearfix">
<ul class="list_menus-li">
	<li><a href="/index.php/safe/loginpasswd">修改登入密码</a></li>
    <li class="on"><a href="/index.php/safe/passwd">修改提款密码</a></li>
    </ul>
<div id="tabs-1">
<form action="/index.php/safe/setCoinPwd2" method="post" target="ajax" onajax="safeBeforSetCoinPwd2" call="safeSetPwd">
<ul class="form_enter_ul">
<li><label class="w1">输入旧登入密码：</label>
<div class="form_li-r w_r1">
<div class="enter_input_kuang1">
<input type="password" name="oldpassword" onkeyup="value=value.replace(/[^\d]/g,'')" maxlength="13" class="password">
</div>
</div>
</li>
<li><label class="w1">输入新登入密码：</label>
<div class="form_li-r w_r1">
<div class="enter_input_kuang1">
<input type="password" name="newpassword" onkeyup="value=value.replace(/[^\d]/g,'')" maxlength="13" class="password">
</div>
</div></li>
<li><label class="w1">确认新登入密码：</label>
<div class="form_li-r w_r1">
<div class="enter_input_kuang1">
<input type="password" name="qrpassword" onkeyup="value=value.replace(/[^\d]/g,'')" maxlength="13" class="password confirm">
</div>
</div>
</li>
</ul>
	    
<div class="list_btn_box">
<input id="resetcoinP2" type="reset" value="重置" onClick="this.form.reset()" class="formReset">
<input id="setcoinP2" type="submit" value="修改" class="formChange">
</div>
<div class="list_page">备注：请妥善保管好您的提款密码，如遗忘请联系在线客服处理</div>
</form>
</div>
	    
		
</div>
</div>
<?php }else{?>
	   <div id="changeloginpass">
<div class="tab-first clearfix">
<ul class="list_menus-li">
	<li><a href="/index.php/safe/loginpasswd">修改登入密码</a></li>
    <li class="on"><a href="/index.php/safe/passwd">设置提款密码</a></li>
    </ul>
<div id="tabs-1">
<form action="/index.php/safe/setCoinPwd" method="post" target="ajax" onajax="safeBeforSetCoinPwd" call="safeSetPwd">
<ul class="form_enter_ul">

<li><label class="w1">输入新登入密码：</label>
<div class="form_li-r w_r1">
<div class="enter_input_kuang1">
<input type="password" name="newpassword" onkeyup="value=value.replace(/[^\d]/g,'')" maxlength="13" class="password">
</div>
</div></li>
</ul>
	    
<div class="list_btn_box">
<input id="resetcoinP2" type="reset" value="重置" onClick="this.form.reset()" class="formReset">
<input id="setcoinP2" type="submit" value="设置" class="formChange">
</div>
<div class="list_page">备注：由纯数字组成6-13个数字，不能和登陆密码相同</div>
</form>
</div>
<?php }?>	    
	<div class="m_footer_annotation">
                        未满18周岁禁止购买<br>
                Copyright © SinCai  2010-2020 版权所有
</div>	
</div>
</div>
</body></html>