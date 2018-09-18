
<link href="/css/nsc/plugin/dialogUI/dialogUI.css" media="all" type="text/css" rel="stylesheet" />

<script type="text/javascript" src="/js/nsc/coreDesign.js"></script>
<script type="text/javascript" src="/js/nsc/common.js"></script>
<script type="text/javascript" src="/js/nsc/dialogUI/jquery.dialogUI.js"></script>
<script type="text/javascript" src="/skin/js/jqueryui/jquery-ui-1.8.23.custom.min.js"></script>

<!-- 切换背景功能 -->
<link rel="stylesheet" href="/css/nsc/bg_skin.css" rel="stylesheet" type="text/css">
<div class="skin-mask"></div>
<div class="skin-box">
    <span class="close_box"></span>
    <div class="skin_tit"><i></i>更换背景</div>
    <div class="skin_main">
        <div class="skin_div">
        <ul class="skin_ulbox clerafix">
            <li data="nsc_background01"><a href="javascript:(0);"><img src="/images/nsc/skin_bg/skin-img01.jpg"></a><span>默认</span></li>
            <li data="nsc_background02"><a href="javascript:(0);"><img src="/images/nsc/skin_bg/skin-img02_small.jpg"></a><span>云樱</span></li>
            <li data="nsc_background03"><a href="javascript:(0);"><img src="/images/nsc/skin_bg/skin-img03_small.jpg"></a><span>春桃</span></li>
            <li data="nsc_background04"><a href="javascript:(0);"><img src="/images/nsc/skin_bg/skin-img04_small.jpg"></a><span>都市</span></li>
            <li data="nsc_background05"><a href="javascript:(0);"><img src="/images/nsc/skin_bg/skin-img05_small.jpg"></a><span>歌剧魅影</span></li>
            <li data="nsc_background06"><a href="javascript:(0);"><img src="/images/nsc/skin_bg/skin-img06_small.jpg"></a><span>梦幻</span></li>
            <li data="nsc_background07"><a href="javascript:(0);"><img src="/images/nsc/skin_bg/skin-img07_small.jpg"></a><span>魔境</span></li>
            <li data="nsc_background08"><a href="javascript:(0);"><img src="/images/nsc/skin_bg/skin-img08_small.jpg"></a><span>蔚蓝</span></li>
            <li data="nsc_background09"><a href="javascript:(0);"><img src="/images/nsc/skin_bg/skin-img09_small.jpg"></a><span>午夜</span></li>
            <li data="nsc_background10"><a href="javascript:(0);"><img src="/images/nsc/skin_bg/skin-img10_small.jpg"></a><span>足球宝贝</span></li>
        </ul>
        </div>
        <div class="skin_page"><a href="javascript:(0);" class="btn_default"><i class="ic-hfmr"></i>恢复默认</a><a href="javascript:(0);" class="btn_cancel">取 消</a><a href="javascript:(0);" class="btn_set"><i class="ic-bcsz"></i>保存设置</a></div>
    </div>
</div>






<script type="text/javascript">
$(document).ready(function(){
    var bgCssConfig = {"cssName" : "" , "cssNameTemp" : ""};
    function initBgCss(){//初始化背景cookie
    	var _localdata;
    	_localdata = localStorage.getItem("bgCss");
        if(_localdata === ""){
            localStorage.setItem("bgCss","nsc_background01");
            bgCssConfig["cssName"] = "nsc_background01";
            $("body").removeClass().addClass("nsc_background01");
        }else{
            bgCssConfig["cssName"] = _localdata;
            $("body").removeClass().addClass(bgCssConfig["cssName"]);
        }
        $(".skin_div li[data='" + bgCssConfig["cssName"] + "']").find("a").addClass("active");
    }
    initBgCss();
	
	
	
	$(".navList").find("li").mouseover(function(){
		
		$(this).addClass("active");
		})
	$(".navList").find("li").mouseout(function(){
		
		$(this).removeClass("active");
		})
	
	

    //弹出选择界面
    $(".t_skin").click(function(){
        $(".skin-mask").show();
        $(".skin-box").show();
        $(".skin_div li a").removeClass();
        $(".skin_div li[data='" + bgCssConfig["cssName"] + "']").find("a").addClass("active");
    });

    //关闭弹层
    $(".close_box").click(function(){
        $(".skin-mask").hide();
        $(".skin-box").hide();
        
        $(".skin_div li a").removeClass();
        $(".skin_div li[data='" + bgCssConfig["cssName"] + "']").find("a").addClass("active");
        $("body").removeClass().addClass(bgCssConfig["cssName"]);
        return false;
    });

    //选择皮肤
    $(".skin_div li a").click(function(){
        var inx=$(this).parent("li").index();
        var bg_css = $(this).parent("li").attr("data");
        bgCssConfig["cssNameTemp"] = bg_css;
        /*修改点击区域背景*/
        $(".skin_div ul li").find("a").removeClass("active");
        $(".skin_div ul li").eq(inx).find("a").addClass("active");
        /*修改body背景*/
        $("body").removeClass().addClass(bg_css);
        $(".btn_save").animate({bottom:'5px'});
        return false;
    });

    //恢复默认值
    $(".btn_default").click(function(){
        localStorage.setItem("bgCss","nsc_background01");
        bgCssConfig["cssName"] = "nsc_background01";
        bgCssConfig["cssNameTemp"] = "nsc_background01";

        $(".skin_div li a").removeClass();
        $(".skin_div li[data='" + bgCssConfig["cssName"] + "']").find("a").addClass("active");
        $("body").removeClass().addClass("nsc_background01");
        $(".close_box").trigger("click");
        return false;
    });

    //保存设置
    $(".btn_set").click(function(){
        if(bgCssConfig["cssNameTemp"] == ""){
           bgCssConfig["cssNameTemp"] = bgCssConfig["cssName"];
        }
        localStorage.setItem("bgCss",bgCssConfig["cssNameTemp"]);
        bgCssConfig["cssName"] = bgCssConfig["cssNameTemp"];
        $(".close_box").trigger("click");
        return false;
    });

    //取消
    $(".btn_cancel").click(function(){
    	localStorage.setItem("bgCss",bgCssConfig["cssName"]);
        $(".close_box").trigger("click");
        return false;
    });


});
</script>
<!-- -->
<!-- 声音控件-->
<div id="soundBox" style="width:1px; height:1px; position:absolute;">
<embed id="boardcastBox"  loop="false" menu="false" quality="best" width="1" height="1" name="boardcastBox" style="position:absolute; top:-10px;" allowscriptaccess="always" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="Ctext=1a3f677c" wmode="window">
</div>

<script type="text/javascript">
  var pushServiceObj = {
	    pushServerHost : "wap.sycpt.com",
	    pubChannelId  : "5aee97bd871ff195414811eccb9a2a0c",
	    pubToken  : "2cf841a4a8f15fcee816d7a3aec48a12",
	    userChannelId : "",
	    pushStatus : "1",
	    pushServerStatus : "good",     //推送服务器状态 good默认服务器正常 warning服务器轮循警告状态 dead服务器挂了
	    pushDelayNum : 0,              //推送重启次数
	    pushDelayMaxNum : 3,           //推送重启最大次数
	    pushDelayTime : "60,120,180"   //每次重启的间隔时间
  };
  var lottery_key = "L-11";
  var sidebar_hover = "3dfc";
</script>
<script type="text/javascript" src="/js/nsc/pushstream.js?v=1.16.11.5"></script>

<script type="text/javascript" src="/js/nsc/coreDesign.js?v=1.16.11.5"></script>
<link rel="stylesheet" href="/css/nsc/foot.css?v=1.16.11.5">
<script type="text/javascript" src="/images/down/swfobject.js?v=1.16.11.5"></script>
<div class="login_main clearfix">
	<div class="warp980">
		<div class="air_box">
			<div class="air_box_t">
				<div class="airflash" id="air_top">
    				<div id="flashcontent" style=" width:220px; height:140px; margin:0 auto;">
    				</div>
    				<script type="text/javascript">
    					//手机端隐藏功能栏目
					  	(function(){
					  		var ua = navigator.userAgent;
					  		var wid = screen.width;
					  		var isMobile = !!ua.match(/AppleWebKit.*Mobile.*/i);
					  		if(isMobile || wid < 500){
					  			setTimeout(function(){
					  				$(".sidebar").css("display","none");
									$(".zr-mobile-down").css("display","none");
					  			},0);
					  		}
					  	})();
    				</script>
    				<script type="text/javascript">

			            // version 9.0.115 or greater is required for launching AIR apps.var so = new SWFObject(swf, id, width, height, version, background-color[, quality, xiRedirectUrl, detectKey]);
			            var so = new SWFObject("/images/nsc/default/images/AIRInstallBadge.swf", "Badge", "220", "140", "9.0.115","");
			            so.useExpressInstall("/images/nsc/default/images/expressinstall.swf");
			            so.addParam("wmode", "transparent");
			            // these parameters are required for badge install:
			            so.addVariable("airversion", "1.0"); // version of AIR runtime required
			            so.addVariable("appname", " "); // application name to display to the user
			            so.addVariable("appurl", "http://dl3.enjoySycPt.net/download/Main.air"); // 在这里修改xxxxAIR客户端下载地址，air名称Main可以随意修改
			            // these parameters are required to support launching apps from the badge (but optional for install):
			            so.addVariable("appid", " "); // the qualified application ID (ex. com.gskinner.air.MyApplication)
			            so.addVariable("pubid", ""); // publisher id

			            // this parameter is required in addition to the above to support upgrading from the badge:
			            so.addVariable("appversion", ""); // AIR application version
			            // these parameters are optional:
			            so.addVariable("imageW", "336"); //图片宽
			            so.addVariable("imageH", "78");//图片高
						so.addVariable("imageX", "10"); //图片按钮位置X坐标
			            so.addVariable("imageY", "50");//图片按钮位置Y坐标
			            so.addVariable("image", "/images/nsc/default/sc_downloadbtn.png"); //图片路径
			            so.addVariable("appinstallarg", "installed from web"); // passed to the application when it is installed from the badge
			            so.addVariable("applauncharg", "launched from web"); // passed to the application when it is launched from the badge
			            so.addVariable("helpurl", "help.html"); // optional url to a page containing additional help, displayed in the badge's help screen
			            so.addVariable("hidehelp", "false"); // hides the help icon if "true"
			            // these parameters allow you to override the default text in the badge:
			            // supported strings: str_error, str_err_params, str_err_airunavailable, str_err_airswf, str_loading, str_install, str_launch, str_upgrade, str_close, str_launching, str_launchingtext, str_installing, str_installingtext, str_tryagain, str_beta3, str_beta3text, str_help, str_helptext
			            so.addVariable("str_err_airswf", "<u>Running locally?</u><br/><br/>The AIR proxy swf won't load properly when this demo is run from the local file system."); // overrides the error text when the AIR proxy swf fails to load

			            so.write("flashcontent");
			        </script>
    			</div>
    			<dl class="download-line">
			    	<dt>手动下载地址</dt>
			        <dd>
			        	<a href="http://dl3.enjoySycPt.net/download/Main.air" target="_blank">
			        		线路1
			        	</a>
			        </dd>
			        <dd>
			        	<a href="http://dl4.enjoySycPt.net/download/Main.air" target="_blank">
			        		线路2
			        	</a>
			        </dd>
			        <dd>
			        	<a href="http://dl5.enjoySycPt.net/download/Main.air" target="_blank">
			        		线路3
			        	</a>
			        </dd>
			    </dl>
			</div>
			<div class="air_box_b">
				<p class="line_hint">
					线路失效？请
					<a href="javascript:void(0);" onclick="return isclient('https://ngmm.livechatvalue.com/chat/chatClient/chatbox.jsp?companyID=12395&configID=66&jid=');" title="在线客服">
						联系客服
					</a>
				</p>
				<a href="http://get.adobe.com/cn/air/" target="_blank" class="adobe_download">
					下载Adobe Air
				</a>
			</div>
		</div>
		<div class="same_box phone_box">
			<div class="left">
	    		<h3>手机客户端</h3>
	    		<p>下载地址：</p>
	    		<a href="https://dn-scmobile.qbox.me/SycPt.apk" class="icon-Android" target="_blank">
	    			Android
	    		</a>
	    		<a href="https://dn-scmobile.qbox.me/olSycPt.ipa" class="icon-iPhone" target="_blank">
	    			iPhone
	    		</a>
    		</div>
    		<div class="img">
    			<img src="/images/nsc/login/nsc_login_tdc-phone.png?v=1.16.11.5" />
    		</div>
		</div>
		<div class="same_box pt_box">
			<div class="left">
			    <h3>PT客户端</h3>
			    <p>下载地址：</p>
			    <a href="/pt-down.html#down" class="icon-Android" target="_blank">
			    	Android
			    </a>
			    <a href="http://cdn.vbet.club/happyslots/d/setupglx.exe" class="icon-PC" target="_blank">
			    	PC端下载
			    </a>
		    </div>
		    <div class="img">
		    	<img src="/images/nsc/login/nsc_login_tdc-pt.png?v=1.16.11.5" />
		    </div>
		</div>
	</div>
</div>
<div class="login_footer">
	<div class="warp980">
		<div class="img"></div>
		<div class="clearfix">
			<p class="t-left">
				浏览器建议：首选为Google浏览器，其次为火狐和IE9或IE10浏览器<br />分辨率建议：使用1024×768以上的分辨率
			</p>
			<p class="t-right">
				未满18周岁禁止购买<br />
				Copyright © SycPt 2010-2019  桃花彩 版权所有
			</p>
		</div>
	</div>
</div>
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
<!--侧边栏-->
<script src="/js/nsc/velocity.min.js?v=1.16.11.5" charset="utf-8"></script>
<script src="/js/nsc/zr-script.js?v=1.16.11.5" charset="utf-8"></script>
<div class="sidebar" id="sidebar">
	<a href="/index.php" class="sidebar-div home"><i class="ic-home"></i>回到首页</a>
	<a  href="javascript:void(0)" onclick="wjkf168();" class="sidebar-div"><i class="ic-online"></i>在线客服</a>
	<a datatype="json" call="indexSign" target="ajax" href="/index.php/display/sign" class="sidebar-div"><i class="iconfont">&#xe64d;</i>天天签到</a>
	<a  href="javascript:void(0);" url="/index.php/liaotian/chat" class="sidebar-div chongzhi"><i class="iconfont">&#xe60b;</i>多人聊天</a>
	<!--a href="/?controller=help&action=main&tag=cjwt" class="sidebar-div"><i class="ic-help"></i>疑问解答</a-->
	<!-- <a href="javascript:void(0);" class="sidebar-div"><i class="ic-down"></i>专享下载</a> -->
	<a href="javascript:voiceKJ();" class="sidebar-div"><i class="ic-sound soundon soundClickEvent"></i>声音控制</a>
	<a href="javascript:void(0);" class="sidebar-div" id="sidebarGoTop"><i class="ic-top"></i>返回顶部</a>
	<!--<div class="sidebar-div down" id="mdown-show">手机下载<i class="link"></i></div>-->
</div>

<div class="zr-mobile-down" align="center">
	<div class="zr-container" align="left">
		<ul>
			<li class="log"></li>
			<li class="text">
				<p>手机移动端APP 真实娱乐更便捷</p>
				<p class="t2">扫码下载！随时随地，想玩就玩</p>
			</li>
			<li class="QR-code"><img src="/images/nsc/login/login_sj-web_ewmimg.png?v=1.16.11.5" width="98" height="98"/></li>
			<!-- <li>
				<a href="#" class="down-link-iphone"></a>
				<a href="#" class="down-link-android"></a>
			</li> -->
		</ul>
		<button class="close" id="mdown-close"></button>
	</div>
	<div id="mdown-show" style="display: block;">手机下载<i class="link"></i></div>
</div>
<link rel="stylesheet" type="text/css" href="/css/nsc/guide.css?v=1.16.11.5">
<script type="text/javascript">
	/**
	* 弹出框
	* @@
	*/
	;(function($){
		//默认参数
		var defaults = {
			width:"980",
			height:"870",
			anTime:350,
			subUrl:"",
			scale:true,
			scrolling:"no"
		};

		//判断浏览器是否为IE
		function fnCheckIe(){
			var broswer = navigator.userAgent;
			var ver = parseInt(broswer.substr(broswer.indexOf("MSIE")+5,3));
			//if(ver <= 8){
			if(broswer.indexOf("MSIE") != -1){
				return true;
			}else if(broswer.indexOf("Firefox") != -1){
				return "firefox";
			}else if(broswer.indexOf("rv:11") != -1){
				return "11";
			}else{
				return false;
			}
		}

		//窗口自适应
		function fnAutoSize(w,h,s){
			var _width=$(window).width();
				_height=$(window).height();
				_top=_height/2-h/2;
				_left=_width/2-w/2;
			if(s){
				_top=_height/2-h*s/2;
				_left=_width/2-w*s/2;
				if(fnCheckIe() === "firefox"){
					_top=_height/2-h/2;
					_left=_width/2-w/2;
				}
			}
			$(".layer-container").css({"top":_top,"left":_left});
		}

		$.fn.layer = function(options){
			var $this = $(this);
			var settings = $.extend({},defaults,options||{});
			var html=""
				,_width=$(window).width()
				,_height=$(window).height()
				,_top=_height/2-settings.height/2
				,_left=_width/2-settings.width/2
				,_scale
				,_scale_iframe
				,_anTime = parseFloat(settings.anTime/1000)
				,_animation = "animation:layer linear "+_anTime+"s 1;-webkit-animation:layer linear "+_anTime+"s 1;-moz-animation:layer linear "+_anTime+"s 1;"
				,closeText = "layer-close"
				,cssText = "";

			if(settings.scale){

				//弹出窗口高度如果大于浏览器高度
				//或者宽度大于浏览器宽度
				//或者分辨率小于1024时处理
				if(_height-100 < settings.height || _width-100 < settings.width || _width<1024){
					_scale = 0.78;
					_scale_iframe = _scale;
					_top = _height/2-settings.height*_scale/2;
					_left = _width/2-settings.width*_scale/2;

					//如果浏览器为ie
					if(fnCheckIe()){
						var _angle = 0
							,rad = _angle * (Math.PI / 180)
			            	,m11 = Math.cos(rad) * _scale
		                	,m12 = -1 * Math.sin(rad) * _scale
		                	,m21 = Math.sin(rad) * _scale
		                	,m22 = m11
							,_filter = "progid:DXImageTransform.Microsoft.Matrix(M11="+ m11 +",M12="+ m12 +",M21="+ m21 +",M22="+ m22 +",SizingMethod='auto expand')";
						closeText = "layer-closeie";
						//_scale_iframe = 1;
						//cssText = "transform:rotate("+ _angle +"deg) scale("+ _scale +");-webkit-transform:rotate("+ _angle +"deg) scale("+ _scale +");-moz-transform:rotate("+ _angle +"deg) scale("+ _scale +");filter:"+_filter;
						cssText = "width:"+settings.width*_scale+"px;height:"+settings.height*_scale+"px;overflow:hidden;";
					}
					if(fnCheckIe() === "11"){
						_scale_iframe = 1;
						cssText = "width:"+settings.width*_scale+"px;height:"+settings.height*_scale+"px;overflow:hidden;";
					}
					//火狐浏览器使用scale
					if(fnCheckIe() === "firefox"){
						//settings.height = +settings.height + 30;
						_top=_height/2-settings.height/2;
						_left=_width/2-settings.width/2;
						cssText = "transform:scale("+_scale+");-webkit-moz-transform:scale("+_scale+");moz-transform:scale("+_scale+");";
					}
				}
			}

			$(window).resize(function(){
				fnAutoSize(settings.width,settings.height,_scale);
			});

			//创建弹出层结构
			html+="<div id='layer' class='layer' zoom="+_scale+">";
			html+="<div class='mask'></div>";
			html+="<div class='layer-container' style='top:"+_top+"px;left:"+_left+"px;"+_animation+cssText+"'><h2></h2>";
			html+="<div class='layer-content'></div>";
			html+="<div class='"+closeText+"'></div>";
			html+="</div></div>";

			var $layer = $(html)
			    ,url = settings.subUrl?settings.subUrl:$this.attr("url")
				,_iframe = "<iframe id='layer-iframe' width='"+settings.width+"' height='"+settings.height+"' src='"+url+"' scrolling='"+settings.scrolling+"' frameborder=no style='zoom:"+_scale_iframe+"'></iframe>";

			//附加弹出窗口
			$layer.find(".layer-content").append($(_iframe).fadeIn());
			$("body").append($layer);
			$(".global-close").show();
			//关闭弹出窗口
			$(".layer-close,.layer-closeie,.global-close").on("click",function(){
				if(!fnCheckIe()){
					$(".layer .mask").css("display","none");
					$(".layer .layer-container").css({"transform":"scale(0)","-webkit-transform":"scale(0)","-moz-transform":"scale(0)"})
					.one("transitionend webkitTransitionEnd mozTransitionEnd",function(){
						$(".layer").detach();
					});
				}else{
					$(".layer").detach();
				}
				$(".global-close").hide();
			});

		};

	})(window.jQuery);

	$(function(){
	  	//用户名长度限制
	  	(function(){
		  	var $uname = $(".username");
		  	var name = $uname.text().replace(/\s/g,"")
		  		,len = name.length;
		  	if(len >8){
		  		name = name.substr(0,8)+"...";
		  		$uname.text(name);
		  	}
	  	})();

	  	//新手引导
        $("#guide-user").on("click",function(){
            $(".guide_new").fadeIn();
        });

	  	//返回顶部
	  	$('.cb_top a').click(function(){
	  		$('body,html').animate({scrollTop:0},600);
	  	});

	  	//滚动到一定位置显示回到顶部按钮
	  	$(window).scroll(function(){
	  		var _top = $(this).scrollTop();
	  		if(_top >= 240){
	  			$('.cb_top').fadeIn(300);
	  		}else{
	  			$('.cb_top').fadeOut(300);
	  		}
	  	});

	  	//跳到底部
	  	$(".cb_downloads a").each(function(i){
	  		var $this = $(this);
  			$this.on("click",function(){
		  		var _top = $(document).height() - $(window).height();
		  		$("html,body").animate({scrollTop:_top},1000);
		  	});
	  	});

	  	//点击获取资金
	  	$("#refreshmoney").click(function(){
			$("#refff").text("000,000,000");
			refreshMoney();
			return false;
	  	});

      	//充值
	  	$(".chongzhi,.recharge").on("click",function(){
	  		$(this).layer({height:"740"});
	  	});

	  	//系统公告
	  	$(".notice,.sysMsgAlet").on("click",function(){
	  		$(this).layer({height:"567","scale":false});
	  	});

	  	//导航菜单
	  	$(".nav li").hover(function(){
	  		$(this).addClass("active");
	  	},function(){
	  		$(this).removeClass("active");
	  	});

	  	$("a[title='查看注单详情']").live("click",function(e){
	  		e.preventDefault();
	  		e.stopPropagation();
	  		var url = $(this).attr("href");
			$(this).layer({height:"607",subUrl:url,scrolling:"auto"});
		});
	});

	var pushServiceStatus = "1";
	var pushStatus = $.parseJSON("{\"push_issuetime\":\"1\",\"push_issuecode\":\"1\",\"push_notice\":\"1\",\"push_usermessage\":\"1\",\"push_userbalance\":\"1\",\"push_userwonprize\":\"1\"}");
	if(pushServiceStatus == "0" || pushStatus.push_userbalance == "0"){
		//获取资金相关方法start
		var autoRefresh = true;
		autoRefreshMoney();
		function autoRefreshMoney() {
			var moneyDisplay = $(".show-money").css("display");
			if(autoRefresh && moneyDisplay != "none"){
				autoRefresh = false;
				refreshMoney();

				setTimeout('autoRefreshMoney()',10000);
			}
		}
	}
</script>
<div id="wanjinDialog"></div>