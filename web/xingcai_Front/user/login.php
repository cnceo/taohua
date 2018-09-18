
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="renderer" content="webkit">
    <title>桃花彩-官方网站</title>
	
    <link rel="stylesheet" href="/css/nsc/reset.css?v=1.16.11.5" />
    <link rel="stylesheet" href="/css/nsc/plugin/dialogUI/dialogUI.css?v=1.16.11.5" media="all" type="text/css" >
    <link rel="stylesheet" type="text/css" media="all" href="/js/keypad/keypad.css?v=1.16.11.5" />
    <link rel="stylesheet" href="/css/nsc/login.css?v=1.16.11.5" />
    <script type="text/javascript" src="/js/nsc/jquery-1.7.min.js?v=1.16.11.5"></script>
	
    <script type="text/javascript" src="/js/common/jquery.md5.js?v=1.16.11.5"></script>
    <script type="text/javascript" src="/js/nsc/dialogUI/jquery.dialogUI.js?v=1.16.11.5"></script>
    <script type="text/javascript" src="/js/nsc/dialogUI/jquery.dragdrop.js?v=1.16.11.5"></script>
    <script language="javascript" type="text/javascript" src="/js/common/jquery.md5.js?v=1.16.11.5"></script>
	
    <script type="text/javascript" src="/js/keypad/jquery.keypad.js?v=1.16.11.5"></script>
	
    <script type="text/javascript" src="/js/nsc/login.js?v=1.16.11.5"></script>
	<script type="text/javascript" src="/images/down/swfobject.js?v=1.16.11.5"></script>
	
	<script type="text/javascript" src="/skin/main/onload.js"></script>
<script type="text/javascript" src="/skin/main/reglogin.js"></script>
<!--<script>alert('咨询QQ：925475');</script>-->
    <script>    	
        $(function() {
            $(".browser_box div").hover(function () {
                $(this).addClass($(this).attr("class") + "_curr").stop(true).animate({
                    right: "0px",
                    width: "100px"
                }).find(".text").show();
            }, function () {
                $(this).removeClass($(this).attr("class").split(' ')[0] + "_curr").stop(true).animate({
                    right: "0px",
                    width: "0px"
                }, function () {
                    $(this).find(".text").hide();
                })
            });

            /*如果可视区域小于960进行适配*/
            function checkWidth(){
                var _ww = $(window).width(),_dw = $(document).width(),_scrollLeft;
                _scrollLeft = _dw - _ww;
                if(_ww <= 960){
                    $(document).scrollLeft(_scrollLeft);
                }
            }
            //checkWidth();
            $(window).resize(function(){
                //checkWidth();
            });

            (function(){
        var html;
        var fnCheckIes = function(v){
            var broswer = navigator.userAgent;
            var ver = parseInt(broswer.substr(broswer.indexOf("MSIE")+5,3));
            if(broswer.indexOf("MSIE") != -1){
                if(ver <= v){
                    return 1;
                }else{
                    return 2;
                }
            }else if(broswer.indexOf("Firefox") != -1){
                return "firefox";
            }else if(broswer.indexOf("rv:11") != -1){
                return 11;
            }else{
                return 3;
            }

        }
       
    
    })();
        })    
    </script>

</head>

<body style="overflow-x: hidden;">

<div class="browser_box">
    <div class="gg"><span class="text"><a href="http://sw.bos.baidu.com/sw-search-sp/software/fc14f1545b7/ChromeStandalone_51.0.2704.106_Setup.exe
" target="_blank">Chrome浏览器</a></span></div>
    <div class="ie"><span class="text"><a href="http://dlsw.baidu.com/sw-search-sp/soft/41/23253/IE8-WindowsXP-x86-CHS.2728888507.exe" target="_blank">IE浏览器</a></span></div>
    <div class="hf"><span class="text"><a href="http://www.firefox.com.cn/" target="_blank">Firefox浏览器</a></span></div>
</div>
<div class="main-inner"><div class="warp980">
    <div class="box_layer">
        <div class="logo"></div>
        <div class="login">
            <div class="sj_web_box">
                <span class="sj_web_ewm1"></span>
                <div class="sj_web_ewm2"><img src="/images/nsc/login/login_sj-web_ewmimg.png?v=1.16.11.5" /><p>新版手机WAP</p></div>
            </div>

        	<h2></h2>
			<form action="/index.php/user/logined" method="post" onajax="userBeforeLogin" enter="true" call="userLogin" target="ajax">
        	<div class="inputbox">
                <i class="icon-img1"></i><input name="username" type="text" class="input-username" id="username" maxlength="32" placeholder="输入用户名">
       	    </div>
            <div class="inputbox">
                <i class="icon-img2"></i><input name="password" type="password" class="input-password password" id="password" maxlength="28" placeholder="输入登录密码">
            </div> 
            <div class="yzmbox inputbox">
                <i class="icon-img3"></i><input name="vcode" type="text" class="input-code" id="vcode" maxlength="4" placeholder="输入验证码" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')">
							<img class="validate" width="80" height="25" border="0" id="dvcode" style="cursor:pointer;" src="/index.php/user/vcode/<?=$this->time?>" title="点击刷新"  onClick="this.src='/index.php/user/vcode/'+(new Date()).getTime()"/>
              <!--<p class="refresh_text"><span onclick="refreshimg()" style="cursor:pointer;">点击刷新</span></p>-->
            </div>
            <div class="submitbox">
			<input type="submit" onclick="$(this).closest('form').submit();return false;" class="submit-login">
			</div>
       
            <div class="servicebox">遇到问题? 联系<a href="javascript:void(0)" onclick="wjkf168();" title="在线客服">在线客服</a></div>
			</form> 
        </div>

    </div>
</div></div>







</div></div>
<div class="login_footer"><div class="warp980">
<div class="img"><img src="/images/nsc/login/nsc_login_footer-certificate.png?v=1.16.11.5" /></div>
<div class="clearfix"><p class="t-left">浏览器建议：首选为Google浏览器，其次为火狐和IE9或IE10浏览器<br />分辨率建议：使用1024×768以上的分辨率</p>
<p class="t-right">未满18周岁禁止购买<br />Copyright © SinCai 2010-2019  桃花彩 版权所有</p></div>
</div></div>




<script type="text/javascript">
$(function(){
    $(".sj_web_ewm1").hover(function(){
        $(this).hide();
        $(".sj_web_ewm2").show();
    },function(){

    });

    $(".sj_web_ewm2").hover(function(){

    },function(){
        $(this).hide();
        $(".sj_web_ewm1").show();
    });
})
</script>
<script type='text/javascript'>
 function wjkf168(){
	<?php if($this->settings['kefuStatus']){ ?>
	var newWin=window.open("<?=$this->settings['kefuGG']?>","","height=600, width=800, top=0, left=0,toolbar=no, menubar=no, scrollbars=no, resizable=no, location=n o, status=no");
	if(!newWin||!newWin.open||newWin.closed){newWin=window.open('about:blank');}else{return false;}
	<?php }else{?>
	$.alert("客服系统维护中");
	<?php }?>
	return false;
 }
function qqkf(){
	<?php if($this->settings['qqkefuStatus']){ ?>
	var newWin=window.open("http://wpa.qq.com/msgrd?uin=<?=$this->settings['qqkefuGG']?>&site=qq&menu=yes","","height=600, width=800, top=0, left=0,toolbar=no, menubar=no, scrollbars=no, resizable=no, location=n o, status=no");
	if(!newWin||!newWin.open||newWin.closed){newWin=window.open('about:blank');}else{return false;}
	<?php }else{?>
	$.alert("客服系统维护中");
	<?php }?>
	return false;
}
</script> 
</body>
</html>