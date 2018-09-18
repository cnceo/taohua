//Flash调用方法
function addNewSwf(swfUrl,objID,swfID,width,height,ifAlpha,ifScript,varStr){
	var addcountsflash=new SWFObject(swfUrl,swfID,width,height,"9");
	
	if(ifAlpha == 1){
		addcountsflash.addParam("wmode","transparent");
	}
	
	if(ifScript == 1){
		addcountsflash.addParam("allowScriptAccess","always");
	}
	
	addcountsflash.addParam("flashvars",varStr);
	addcountsflash.write(objID);	
}
//设置cookie
function setCookie(name,value,expire,path) {
	var curdate=new Date();
	var cookie=name+"="+encodeURIComponent(value)+"; ";
	if(expire!=undefined||expire==0){
		if(expire==-1){
			expire=366*86400*1000;//保存一年
		}else{
			expire=parseInt(expire);
		}
		curdate.setTime(curdate.getTime()+expire);
		cookie+="expires="+curdate.toUTCString()+"; ";
	}
	path = path || "/";
	cookie += "path=" + path;
	document.cookie=cookie;
}
//获取cookie
function getCookie(name) {
    var re = "(?:; )?" + encodeURIComponent(name) + "=([^;]*);?";
    re = new RegExp(re);
    if (re.test(document.cookie)) {
        return decodeURIComponent(RegExp.$1);
    }
    return '';
}
/*声音播放插件*/
(function($){
     $.fn.soundBox = function(options){
          var defaults = {
				audioId : "chatAudio",//播放插件id
				bgType : ['ogg','mp3','wav'],//音频格式
				bgDir : '',//背景音乐路径
				swfDir : '',//flash文件路径
				swfId : '',//flashID
				isAir : '0',//是否是客户端
				soundOn : true,//默认声音是否打开
				checkCookie : function(){//验证cookie的有效性
					if(getCookie("sound") == "" || getCookie("sound") == "on"){
						setCookie("sound","on");
					}else{
						setCookie("sound","off");
					}
					return getCookie("sound") == "on" ? true : false;
				}
          };
		  
		  //配置文件
		  var opt = {
				soundType : {
					ogg : "audio/ogg",
					mp3 : "audio/mpeg",
					wav : "audio/wav"
				}
		  };
		  var options = $.extend({},defaults,options);
		  var isSafari = navigator.userAgent.indexOf("Safari") > 0 ? true : false;
		  var isChrome = navigator.userAgent.indexOf("Chrome") > 0 ? true : false;
		  options.isAir = getCookie("isclient") || defaults.isAir;
		  options.soundOn = options.checkCookie();
          this.each(function(){
				//配置项检查
			  	$.each(options,function(i,v){
					if(v === ''){
						alert("请检查defaults." + i + "的配置...");
						return false;
					}
				});
				
				var _html = '<audio id="' + options.audioId + '">';
				$.each(options.bgType,function(i,v){
					_html += '<source src="' + options.bgDir + '.' + v + '" type="' + opt.soundType[v] + '">';
				});
				_html += '</audio>';
				
				//播放器绑定
				if(options.isAir != "1"){
					$(this).empty();
					if(!!document.all){//ie浏览器
						addNewSwf(options.swfDir,this.id,options.swfId,1,1,1,1,"");	
					}else{//非ie浏览器
						if(isSafari && !isChrome){//Safari浏览器
							addNewSwf(options.swfDir,this.id,options.swfId,1,1,1,1,"");	
						}else{
							$(_html).appendTo($(this));	
						}
					}
				}
          });
		  
		  //声音播放
		  this._soundCtl = function(){
			  if(options.soundOn == true){
				  setCookie("sound","off");
				  options.soundOn = false; 
			  }else{
				  setCookie("sound","on");
			  	  options.soundOn = true; 	
			  }
		  }

		  //音乐播放方法
		  this._mPlay = function(){
			  //flash绑定
			  if(options.soundOn){
				  if(options.isAir != "1"){
					  if(!!document.all){//ie浏览器
							document.getElementById(options.swfId).mPlay(options.bgDir + '.mp3');
					  }else{//非ie浏览器
							if(isSafari && !isChrome){//Safari浏览器
								document.getElementById(options.swfId).mPlay(options.bgDir + '.mp3');
							}else{
								$('#' + options.audioId)[0].play();
							}
					  } 
				  }else{
					  document.getElementById(options.swfId).mPlay(options.bgDir + '.mp3');
				  }
			  }
		  }
		  
		  this._checkCookie = options.checkCookie;
		  return this;

     };
})(jQuery);

//声音控件----------------------------------------------------------------------------------
//声音控件初始化
var _sound = $("#soundBox").soundBox({
	bgDir : './fl/music/ring',
	swfDir : './fl/source/soundBox.swf',
	swfId : 'boardcastBox',
	bgType : ['ogg','mp3','wav']
});
//声音调用
//_sound._mPlay();

function changeClass(){
	if(_sound._checkCookie()){
		$(".soundClickEvent").removeClass('soundoff').addClass('soundon');
	}else{
		$(".soundClickEvent").removeClass('soundon').addClass('soundoff');
	}
}

$(function(){//页面加载完毕以后绑定事件
	//声音开关事件绑定
	$(".soundClickEvent").click(function(){
		_sound._soundCtl();
		changeClass();
	});

	//根据cookie设置class
	changeClass();//初始化
})
//声音控件----------------------------------------------------------------------------------
function playVoice(src, domId){
	if(getVoiceStatus()=='off') return;
	var $dom=$('#'+domId)
	if($.browser.msie){
		if($dom.length){
			$dom[0].src=src;
		}else{
			$('<bgsound>',{src:src, id:domId}).appendTo('body');
		}
	}else{
		if($dom.length){
			$dom[0].play();
		}else{
			$('<audio>',{src:src, id:domId}).appendTo('body')[0].play();
		}
	}
}
function setVoiceStatus(flag){
	var session=(typeof sessionStorage!='undefined');
	var key='voiceStatus';
	if(session){
		if(!flag){
			sessionStorage.setItem(key,'off');
		}else{
			sessionStorage.removeItem(key);
		}
	}else{
		if(!flag){
			$.cookie(key, 'off');
		}else{
			$.cookie(key, null);
		}
	}
}
function getVoiceStatus(){
	var key='voiceStatus';
	if(typeof sessionStorage!='undefined'){
		return sessionStorage.getItem(key);
	}else{
		return $.cookie(key);
	}
}
function voiceKJ(){
	var $dom=$('#voice');
	if(getVoiceStatus()!='off'){
		setVoiceStatus(false);
		$dom.attr('class','voice-off').attr('title', '声音关闭，点击开启');
	}else{
		setVoiceStatus(true);
		$dom.attr('class','voice-on').attr('title', '声音开启，点击关闭');
	}
}

$(function(){
	(function(){
		var $this = $("#refff"),
			money = $("#refff").text();
		var formatMoney = moneyFormat(money).substr(0,14);
		$this.text(formatMoney);
	})();
	(function(){
		var $ref = $("#refff"),$refresh = $(".ic-refresh"),$showMoney = $(".show-money"),$hideMoney = $(".hide-money");
			$hide = $(".ic-unlook");
		var cvis = getCookie("hide");
		if(cvis === "true"){
			$showMoney.hide();
			$hideMoney.show();
			$refresh.css("display","none");
			$hide.addClass("hide");
			$hide.attr("title","显示余额");
		}else{
			$refresh.css("display","inline-block");
			$hide.attr("title","隐藏余额");
			$showMoney.show();
			$hideMoney.hide();
		}
		$hide.on("click",function(){ 
			var vis = $showMoney.css("display");
			if(vis == "none"){
				setCookie("hide","false");
				$showMoney.show();
				$hideMoney.hide();
				$refresh.css("display","inline-block");
				$hide.removeClass("hide");
				$hide.attr("title","隐藏余额");        
				autoRefreshMoney();
			}else{
				setCookie("hide","true");
				$showMoney.hide();
				$hideMoney.show();  
				$refresh.css("display","none");
				$hide.addClass("hide");
				$hide.attr("title","显示余额");
			}
		});
	})();
	(function(){
		var $uname = $(".username");
		var name = $uname.text().replace(/\s/g,"")
			,len = name.length;
		if(len >8){
			name = name.substr(0,8)+"...";
			$uname.text(name);
		}
	})();
	$("#guide-user").on("click",function(){
		$(".guide_new").fadeIn();
	});
	$('.cb_top a').click(function(){ 
		$('body,html').animate({scrollTop:0},600);
	});
	$(window).scroll(function(){
		var _top = $(this).scrollTop();
		if(_top >= 240){
			$('.cb_top').fadeIn(300);
		}else{
			$('.cb_top').fadeOut(300);
		}
	});
	$(".cb_downloads a").each(function(i){
		var $this = $(this);
		$this.on("click",function(){
			var _top = $(document).height() - $(window).height();
			$("html,body").animate({scrollTop:_top},1000);
		});
	});
	$("#refreshmoney").click(function(){
		$("#refff").text("000,000,000");
		refreshMoney();
		return false;
	});
	$(".chongzhi").on("click",function(){
		$(this).layer({height:"605"});
	});
	
	$(".nav li").hover(function(){
		$(this).addClass("active");
	},function(){
		$(this).removeClass("active");	
	});
});
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
function refreshMoney() {
	$.ajax({
		type : 'GET',
		url  : '/index.php/safe/userInfo',
		timeout : 10000,
		success : function(data){
			autoRefresh = true;
			if(data == "error") {
				$("#refff").html("正在读取资金");
				return false;
			}else{
				if(isNaN(data)){
					alert("获取余额失败，您的登录可能已经过期，请重新登录");
					location.href="/";
					return false;
				}else{
					$("#refff").html(moneyFormat(data).substr(0,14)).attr("title",moneyFormat(data));
					return true;
				}
			}
		},
		error: function() {
			$("#refff").html("正在读取资金");
		},
		complete:function(XHR,textStatus){
			XHR = null;
		}
	});  
}

$(function(){
	(function(){
		var $this = $("#refff"),
			money = $("#refff").text();
		var formatMoney = moneyFormat(money).substr(0,14);
		$this.text(formatMoney);
	})();
	(function(){
		var $ref = $("#refff"),$refresh = $(".ic-refresh"),$showMoney = $(".show-money"),$hideMoney = $(".hide-money");
			$hide = $(".ic-unlook");
		var cvis = getCookie("hide");
		if(cvis === "true"){
			$showMoney.hide();
			$hideMoney.show();
			$refresh.css("display","none");
			$hide.addClass("hide");
			$hide.attr("title","显示余额");
		}else{
			$refresh.css("display","inline-block");
			$hide.attr("title","隐藏余额");
			$showMoney.show();
			$hideMoney.hide();
		}
		$hide.on("click",function(){ 
			var vis = $showMoney.css("display");
			if(vis == "none"){
				setCookie("hide","false");
				$showMoney.show();
				$hideMoney.hide();
				$refresh.css("display","inline-block");
				$hide.removeClass("hide");
				$hide.attr("title","隐藏余额");        
				autoRefreshMoney();
			}else{
				setCookie("hide","true");
				$showMoney.hide();
				$hideMoney.show();  
				$refresh.css("display","none");
				$hide.addClass("hide");
				$hide.attr("title","显示余额");
			}
		});
	})();
	(function(){
		var $uname = $(".username");
		var name = $uname.text().replace(/\s/g,"")
			,len = name.length;
		if(len >8){
			name = name.substr(0,8)+"...";
			$uname.text(name);
		}
	})();
	$("#guide-user").on("click",function(){
		$(".guide_new").fadeIn();
	});
	$('.cb_top a').click(function(){ 
		$('body,html').animate({scrollTop:0},600);
	});
	$(window).scroll(function(){
		var _top = $(this).scrollTop();
		if(_top >= 240){
			$('.cb_top').fadeIn(300);
		}else{
			$('.cb_top').fadeOut(300);
		}
	});
	$(".cb_downloads a").each(function(i){
		var $this = $(this);
		$this.on("click",function(){
			var _top = $(document).height() - $(window).height();
			$("html,body").animate({scrollTop:_top},1000);
		});
	});
	$("#refreshmoney").click(function(){
		$("#refff").text("000,000,000");
		refreshMoney();
		return false;
	});
	$(".chongzhi").on("click",function(){
		$(this).layer({height:"605"});
	});
	$(".notice,.sysMsgAlet").on("click",function(){
		$(this).layer({height:"567","scale":false});
	});
	$(".nav li").hover(function(){
		$(this).addClass("active");
	},function(){
		$(this).removeClass("active");	
	});
});
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
			var isAir = !!getCookie("isclient") && getCookie("kernel") == 2,
	             timedelay = isAir?300:0;

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
						if(!isAir){
							_scale_iframe = 1;
							cssText = "width:"+settings.width*_scale+"px;height:"+settings.height*_scale+"px;overflow:hidden;";
						}else{
							var url = settings.subUrl?settings.subUrl:$this.attr("url");
							if(url.indexOf('emaildeposit')>-1){
								_scale_iframe = 1;
								cssText = "width:"+settings.width*_scale+"px;height:"+settings.height*_scale+"px;overflow:hidden;";
							}
						}
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

			//$layer.find(".layer-content").append($(_iframe).fadeIn());
			//$("body").append($layer);
			setTimeout(function(){
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
			},timedelay);


		};

	})(window.jQuery);

	$(function(){
	  	//隐藏金额
	  	(function(){
		    var $ref = $("#refff"),$refresh = $(".ic-refresh"),$showMoney = $(".show-money"),$hideMoney = $(".hide-money");
		    	$hide = $(".ic-unlook");
		    var cvis = getCookie("hide");
		    var pushServiceStatus = "1";
		    var pushStatus = $.parseJSON("{\"push_issuetime\":\"1\",\"push_issuecode\":\"1\",\"push_notice\":\"1\",\"push_usermessage\":\"1\",\"push_userbalance\":\"1\",\"push_userwonprize\":\"1\"}");
		    if(cvis === "true"){
		    	$showMoney.hide();
		    	$hideMoney.show();
		      	$refresh.css("display","none");
		      	$hide.addClass("hide");
		      	$hide.attr("title","显示余额");
		    }else{
		    	$refresh.css("display","inline-block");
		    	$hide.attr("title","隐藏余额");
		    	$showMoney.show();
		    	$hideMoney.hide();
		    }

		    $hide.on("click",function(){
		      	var vis = $showMoney.css("display");
		      	if(vis == "none"){
			        setCookie("hide","false");
			        $showMoney.show();
		    		$hideMoney.hide();
			        $refresh.css("display","inline-block");
			        $hide.removeClass("hide");
			        $hide.attr("title","隐藏余额");
			        if(pushServiceStatus == "0" || pushStatus.push_userbalance == "0"){
			        	autoRefreshMoney();
			        }else{
			        	refreshMoney();
			        }
		      	}else{
			        setCookie("hide","true");
			        $showMoney.hide();
		    		$hideMoney.show();
			        $refresh.css("display","none");
			        $hide.addClass("hide");
			        $hide.attr("title","显示余额");
		      	}
		    });

	  	})
		();
})	

$(document).ready(function(){
    var bgCssConfig = {"cssName" : "" , "cssNameTemp" : ""};
    var clientObj = {
    	"isclient" : null,
    	
    	setItem : function(name,value){
    		if(this.isclient == 1){
    			setCookie(name,value);
    		}else{
    			localStorage.setItem(name,value);
    		}
    	},
    	getItem : function(name){
    		if(this.isclient == 1){
    			return getCookie(name);
    		}else{
    			return localStorage.getItem(name);
    		}
    	}
    };
    //没有开放导航弹窗提示
    var NoDagin = true;
    $(".v-NoDagin").click(function(){
   		
   		if(NoDagin){
	    	NoDagin = false;
	    	$("#v-dalog").fadeIn(200,function(){
	    	}).delay(2000).fadeOut(200,function(){
	    		NoDagin = true;
	    	});
    	}
    });
    //-----end导航弹窗提示
    function initBgCss(){//初始化背景cookie
    	var _localdata;

    	_localdata = clientObj.getItem("bgCss");
        if(_localdata === "" || _localdata === null){
            clientObj.setItem("bgCss","nsc_background01");
            bgCssConfig["cssName"] = "nsc_background01";
            $("body").removeClass().addClass("nsc_background01");
        }else{
            bgCssConfig["cssName"] = _localdata;
            $("body").removeClass().addClass(bgCssConfig["cssName"]);
        }
        $(".skin_div li[data='" + bgCssConfig["cssName"] + "']").find("a").addClass("active");
    }
    initBgCss();

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
        clientObj.setItem("bgCss","nsc_background01");
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
        clientObj.setItem("bgCss",bgCssConfig["cssNameTemp"]);
        bgCssConfig["cssName"] = bgCssConfig["cssNameTemp"];
        $(".close_box").trigger("click");
        return false;
    });

    //取消
    $(".btn_cancel").click(function(){
    	clientObj.setItem("bgCss",bgCssConfig["cssName"]);
        $(".close_box").trigger("click");
        return false;
    });
});