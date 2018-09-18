<?php $this->display('inc_daohang.php'); ?>

<div id="nsc_subContent" style="border:0">


<div id="siderbar">
<ul class="list clearfix">
<li ><a href="/index.php/safe/info" >绑定卡号</a></li>
<li ><a href="/index.php/safe/passwd" >密码修改</a></li>
<li ><a href="/index.php/record/search" >投注记录</a></li>
<li ><a href="/index.php/report/coin" >帐变记录</a></li>
<li ><a href="/index.php/report/count" >盈亏报表</a></li>
<li ><a href="/index.php/cash/rechargeLog" >充值记录</a></li>
<li ><a href="/index.php/cash/toCashLog" >提现记录</a></li>
<li class="current"><a href="/index.php/user/nickname" >更改称昵</a></li>
<li ><a href="/index.php/box/receive" >消息管理</a></li>
</ul>
</div>
<link rel="stylesheet" href="/css/nsc/reset.css?v=1.16.11.5" />
<link rel="stylesheet" href="/css/nsc/list.css?v=1.16.11.5" />
<link rel="stylesheet" href="/css/nsc/activity.css?v=1.16.11.5" />
<script type="text/javascript" src="/js/nsc/jquery-1.7.min.js?v=1.16.11.5"></script>
<script type="text/javascript" src="/js/nsc/main.js?v=1.16.11.5"></script>
<script type="text/javascript" src="/js/nsc/dialogUI/jquery.dialogUI.js?v=1.16.11.5"></script>
<link href="/css/nsc/plugin/dialogUI/dialogUI.css?v=1.16.11.5" media="all" type="text/css" rel="stylesheet" />

</head>
<body>

<div id="subContent_bet_re">
<!--消息框代码开始-->
<script src="/js/jqueryui/ui/jquery.ui.core.js?v=1.16.11.5"></script>
<script src="/js/jqueryui/ui/jquery.ui.widget.js?v=1.16.11.5"></script>
<script src="/js/jqueryui/ui/jquery.ui.tabs.js?v=1.16.11.5"></script>
<script language="javascript" type="text/javascript" src="/js/common/jquery.md5.js?v=1.16.11.5"></script>
<script type="text/javascript" src="/js/keypad/jquery.keypad.js?v=1.16.11.5"></script>
<link rel="stylesheet" type="text/css" media="all" href="/js/keypad/keypad.css?v=1.16.11.5"  />
<!--消息框代码结束-->
<div id="subContent_bet_re">
<!--消息框代码开始-->
<script type="text/javascript" src="/js/nsc/dialogUI/jquery.dialogUI.js?v=1.16.11.5"></script>
<script type="text/javascript" src="/js/nsc/dialogUI/jquery.dragdrop.js?v=1.16.11.5"></script>
<link href="/css/nsc/plugin/dialogUI/dialogUI.css?v=1.16.11.5" media="all" type="text/css" rel="stylesheet">
<!--消息框代码结束-->

<form action="/index.php/safe/nickname" method="post" target="ajax" onajax="safeBefornickname" call="safeSetnickname">
<div class="organizing-data_box">
<table width="100%" border="0" cellspacing="1" cellpadding="10">
    <tr>
    <td class="tdz3_left">用户昵称：</td>
    <td class="tdz3_right"><input type="text" maxlength="6" name="nickname" value="<?=$this->user['nickname']?>"/> <span class="text_hint">由2至6个字符组成</span></td>
    </tr>
</table>
<div class="list_btn_box">
<input type="submit" value="修改" class="formChange" />
<input name="" type="reset" value="重置" class="formReset"  onclick="form.reset()"/>
</div>
</div>
        </form>
<form action="/index.php/safe/care" method="post" target="ajax" onajax="safeBeforcare" call="safeSetcare">
<div class="organizing-data_box">
<table width="100%" border="0" cellspacing="1" cellpadding="10">
    <tr>
    <td class="tdz3_left">预留信息：</td>
    <td class="tdz3_right"><input type="text" maxlength="18" name="care" value="<?=$this->user['care']?>"/><span class="text_hint text_hint-c">为防止钓鱼网站骗取您的钱财，请务必填写此信息<br />由1至6个汉字组成</span></td>
    </tr>
</table>
<div class="list_btn_box">
<input type="submit" value="修改" class="formChange" />
<input name="" type="reset" value="重置" class="formReset"  onclick="form.reset()"/>
</div>
</div>
        </form>
</div></div></div></div></div>
<?php $this->display('inc_che.php'); ?>

 </body>
 </html>