$(function(){

	//初始化方法
	$.funList = {
		'initTag' : true,
		'tzjlfn' : function(){//获取投注记录
			var v = Math.random();
	        
		},
		'fastBettingOpen' : true,//是否开启分辨率相关处理
		'fastBetting' : function(){//立即投注 根据屏幕分辨率变更投注方式
			var _width,_height,_html,isNull,_offsetTop,that = $.funList,pk10Height;
			_width = $(window).width();
			_height = $(window).height();

			pk10Height = $(".an-container").height();
			_offsetTop = that._offsetTop;
			that.fastBettingOpen = (pk10Height === 0 || pk10Height === null) ? true : false;//如果动画窗口隐藏,那么就开启分辨率处理

			if(!that.fastBettingOpen){//动画窗口存在情况下的处理
				isNull = $(".orderNow").children().html();
				if(isNull !== null){
					_html = $(".orderNow").children().clone(true);
					if(lottery_key !== "L-23")
			            $(".addOrderLeft").addClass("addOrderLeft625");
					//console.log(_html);
			        $(".addOrderRight").html(_html).addClass("addOrderRight625");
			        $(".orderNow").empty().hide();
				}
			}

			if(that.fastBettingOpen){//进行分辨率处理
				if(_height <= _offsetTop){
					isNull = $(".orderNow").children().html();
					if(isNull !== null){
						_html = $(".orderNow").children().clone(true);
						if(lottery_key !== "L-23")
				            $(".addOrderLeft").addClass("addOrderLeft625");
						//console.log(_html);
				        $(".addOrderRight").html(_html).addClass("addOrderRight625");
				        $(".orderNow").empty().hide();
					}
				}else{
					isNull = $(".addOrderRight").children().html();
					if(isNull !== null){
						_html = $(".addOrderRight").children().clone(true);
				        $(".addOrderLeft").removeClass("addOrderLeft625");
				        $(".addOrderRight").html("").removeClass("addOrderRight625");
				        $(".orderNow").html(_html).show();
					}
				}
			}
		},
		'sidebarNavMove' : function(){//侧栏移动
			var _node = $('.sidebarNav'),
				_sWidth = _node.width(),//侧栏宽度
				_measureWidth = ($(window).width() - $('.warp').width())/2,//屏幕左侧宽度
				_offset = 6,that = $.funList;
			_sWidth = _sWidth + _offset;
			if(!that.isHide){
				if(_measureWidth > _sWidth){//如果距离足够
					_node.stop().animate({'left' : _measureWidth - _sWidth + 'px'});
				}else{
					//_node.stop().animate({'left' : _offset + 'px'});
					$('.sidebar_hide').trigger('click');
				}
			}
		},
		'sidebarHide' : function(){//侧栏隐藏
			var _node = $('.sidebarNav'),
				_sWidth = _node.width(),//侧栏宽度
				_nodeshow = $('.sidebar_show'),
				_nodeshowWidth = _nodeshow.width(),//显示按钮宽度
				that = $.funList;
			$('.sidebar_hide').unbind().click(function(){
				that.isHide = true;
				_node.stop().animate({'left' : -_sWidth + 'px'},function(){
					_nodeshow.css({'left' : -_nodeshowWidth + 'px'}).show().stop().animate({'left' : 0 + 'px'});
				});
			});
		},
		'sidebarShow' : function(){//侧栏显示
			var _node = $('.sidebarNav'),
				_nodeshow = $('.sidebar_show'),
				that = $.funList;
			$('.sidebar_show').unbind().click(function(){
				var _sWidth = _node.width(),//侧栏宽度
				_measureWidth = ($(window).width() - $('.warp').width())/2,
				_nodeshowWidth = _nodeshow.width(),//显示按钮宽度
				_offset = 6,
				_sWidth = _sWidth + _offset;
				that.isHide = false;
				_nodeshow.stop().animate({'left' : -_nodeshowWidth + 'px'},function(){
					if(_measureWidth > _sWidth){//如果距离足够
						_node.css({'left' : -_sWidth + 'px'}).show().stop().animate({'left' : _measureWidth - _sWidth + 'px'});
					}else{
						_node.css({'left' : -_sWidth + 'px'}).show().stop().animate({'left' : _offset + 'px'});
					}
				});
			});
		},
		'showLotterys' : function(){
			$('.sidebar_lotteries a').toggle(function(){
				var node = $(this);
				$('.sidebar_allgames').stop().animate({'height' : '0px'},function(){
					node.addClass('hover');
				});
			},function(){
				var node = $(this);
				$('.sidebar_allgames').stop().animate({'height' : '376px'},function(){
					node.removeClass('hover');
				});
			});
		},
		'resize' : function(){//浏览器改变大小
			var that = $.funList;
			var timer_resize,timer_scroll;
			$(window).resize(function(){
				//window.clearTimeout(timer_resize);
				//timer_resize = setTimeout(function(){
					that.fastBetting();
					that.JS_blockPage();
					that.sidebarNavMove();
					that.hideTop();
					//filterHeight();
				//}, 200);
			});

			$(window).scroll(function(){
				window.clearTimeout(timer_scroll);
				timer_scroll = setTimeout(function(){
					that.fastBetting();
					that.JS_blockPage();
				}, 200);
				//that.sidebarNavMove();
			});
		},
		'hideTop' : function(){//高度少于535隐藏头部
			var _height = $(window).height();
			var _top = $('.top').height();
			if(_height <= 570){
				$(document).scrollTop(_top);
			}else{

			}
		},
		'hideLotteries' : function(){//隐藏左侧彩种集合
			var _height = $(window).height();
			if(_height <= 625 && $.funList.initTag){
				$('.sidebar_lotteries a').trigger('click');		
			}
		},
		'JS_blockPage' : function(){//如果有弹窗让他永远在屏幕的中间
			var _node = $("#JS_blockPage"),
			_height = $(window).height(),
			_blockPageHeight = _node.height(),
			_scrollTop = $(document).scrollTop(),
			_top = (_height - _blockPageHeight)/2 + _scrollTop;
			if(_node.length > 0){
				_node.css({'z-index': '2000', 'left': '50%', 'top': _top + 'px'});
			}
		},
		'init' : function(){
			var that = $.funList;
			that.isHide = false;
			if($('#lt_sendok').length == 1){
				that._offsetTop = $('#lt_sendok').offset().top + $('#lt_sendok').height();
			}

			if($(".an-container").length === 1){
				that._offsetTop -= $(".an-container").height();
			}

			that.sidebarHide();
			$.each(this,function(index,fun){
				if(index !== 'init' && typeof fun === 'function'){
					fun();
				}
			})

			that.initTag = false;
		}
	};
	$.funList.init();//初始化相关功能

	//页面全局方法管理---------------------------------------------------------------------------------------
	$.globelFun = {
		spCode : ":",
		//倒计时时间返回
		showTime : function(second){
			var second = parseInt(second);
			var day,hour,minute,sec;
			//day = parseInt(second/(3600*24));
			//hour = parseInt(second%(3600*24)/(3600));
			hour = parseInt(second/(3600));
			minute = parseInt(second%(3600*24)%3600/60);
			sec = parseInt(second%(3600*24*3600*60)%60);
			//day = (day == 0) ? "" : day;
			//day = (day > 0 && day < 10 && day != "") ? day + "天" : day;
			hour = (hour == 0) ? "" : hour;
			//if(day != ""){
				//hour = (hour > 0 && hour < 10) ? "0" + hour + ":" : hour + ":"	
			//}else{
				if(hour != ""){
					hour = (hour > 0 && hour < 10) ? "0" + hour + this.spCode : hour + this.spCode	
				}else{
					hour = "00" + this.spCode;
				}
			
			minute = (minute == 0) ? "00" : minute;
			minute = (minute > 0 && minute < 10 && minute != "00") ? "0" + minute + this.spCode : minute + this.spCode;
			sec = (sec == 0) ? "00" : sec;
			sec = (sec > 0 && sec < 10 && sec != "00") ? "0" + sec : sec;
			//return day + hour + minute + sec;
			if(!isNaN(second)){
				return hour + minute + sec;
			}else{
				return "-- : -- : --";
			}		
		},
		//获取cookie
		getCookie : function(name){
			var re = "(?:; )?" + encodeURIComponent(name) + "=([^;]*);?";
			re = new RegExp(re);
			if (re.test(document.cookie)) {
				return decodeURIComponent(RegExp.$1);
			}
			return '';
		},
		//设置cookie
		setCookie : function(name,value,expire,path){
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
		},
		//获取当前时间
		nowTime : function(){
			if(arguments.length > 1){
				alert("传值失败");
			}
			if(arguments.length == 0){
				var d = new Date();
			}
			if(arguments.length == 1){
				var d = new Date(arguments[0]);
			}
			var year,month,day,hour,minute,second,time;
			year = d.getFullYear();
			month = d.getMonth() + 1;
			day = d.getDate();
			hour = d.getHours();
			minute = d.getMinutes();
			second = d.getSeconds();
			year = (year < 10) ? "0" + year : year;
			month = (month < 10) ? "0" + month : month;
			day = (day < 10) ? "0" + day : day;
			hour = (hour < 10) ? "0" + hour : hour;
			minute = (minute < 10) ? "0" + minute : minute;
			second = (second < 10) ? "0" + second : second;
			time = year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;
			return time;
		},
		//获取秒数
		getSecond : function(date){
			var time = date;
			var d = new Date(time);
			var second = d.getTime();
			if(isNaN(second)){//ie8兼容
				if(typeof time == "undefined"){
					second = 0;
				}else{
					time = time.replace(/-/g,"\/");
					d = new Date(time);
					second = d.getTime();
				}
			}
			second = isNaN(second) ? 0 : second;
			return second;
		}
	};
});

