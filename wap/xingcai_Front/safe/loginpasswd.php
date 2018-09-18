<?php $this->display('inc_daohang1.php'); ?>
<link rel="stylesheet" href="/css/nsc_m/m-list.css?v=1.17.1.23">
<script type="text/javascript" src="/js/nsc_m/res.js?v=1.16.12.4"></script>
       <section class="wraper-page">
	<div id="changeloginpass">
<div class="tab-first clearfix">
<ul class="list_menus-li">
	<li class="on"><a href="/index.php/safe/loginpasswd">修改登入密码</a></li>
	  <?php if($args[0]){ ?>
    <li><a href="/index.php/safe/passwd">修改提款密码</a></li>
	<?php }else{?>
	  <li><a href="/index.php/safe/passwd">设置提款密码</a></li>
	  <?php }?>
    </ul>
<div id="tabs-1">
<form action="/index.php/safe/setPasswd" method="post" target="ajax" onajax="safeBeforSetPwd" call="safeSetPwd">
<ul class="form_enter_ul">
<li><label class="w1">输入旧登入密码：</label>
<div class="form_li-r w_r1">
<div class="enter_input_kuang1">
<input type="password" name="oldpassword" type="password" class="password " maxlength="13">
</div>
</div>
</li>
<li><label class="w1">输入新登入密码：</label>
<div class="form_li-r w_r1">
<div class="enter_input_kuang1">
<input type="password" name="newpassword" class="password " maxlength="13">
</div>
</div></li>
<li><label class="w1">确认新登入密码：</label>
<div class="form_li-r w_r1">
<div class="enter_input_kuang1">
<input type="password" name="qrpassword" class="password confirm" maxlength="13">
</div>
</div>
</li>
</ul>
	    
<div class="list_btn_box">
<input id="resetcoinP2" type="reset" value="重置" onClick="this.form.reset()" class="formReset">
<input id="setcoinP2" type="submit" value="修改" class="formChange">
</div>
<div class="list_page">备注：请妥善保管好您的登入密码，如遗忘请联系在线客服处理</div>
</form>
</div>
	    
		
</div>
</div>
<div class="m_footer_annotation">
                        未满18周岁禁止购买<br>
                Copyright © SycPt   2010-2020  版权所有
</div>
<div class="padding_fot_b20 "></div>


</div>
</body></html>