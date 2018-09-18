var ZR={}

ZR.TopBannerMove=function(){
	var lastY          = 0;
	var	lastX          = 0;
	var $light         = $(".zr-banner-move");
	var oldmTop  = parseInt($light.css("margin-top"));
	var oldmLeft = parseInt($light.css("margin-left"));

	/**
	 * 还原数据
	 */
	function restore(event){
		if((window.event || event).relatedTarget){ return; }
		minus ={ "left" : 0, "top"  : 0 }
	    $light.stop(true).velocity({"margin-top": oldmTop},100).velocity({"margin-left": oldmLeft},100);
	}

	document.onmouseout  = restore;
	//window.onresize      = layout;

	var lastLeft = 0;
	var lastTop  = 0;
	var minus    = { "left" : 0, "top"  : 0 }
	document.onmousemove=function (ev)
	{
	    var oEvent = ev||event;

	   	var coefficientLeft = parseInt(oEvent.clientX*0.02);
	   	var coefficientTop  = parseInt(oEvent.clientY*0.02);

	    var newMLeft = coefficientLeft+oldmLeft;
	    var newMTop  = coefficientTop+oldmTop;

	    ////console.log("mLeft="+newMLeft+" oldmLeft="+oldmLeft+" mTop="+newMTop + " oldmTop="+oldmTop + " coefficientTop="+coefficientTop);

		if(lastTop != newMTop){

			if(minus.top == 0)
			{
				minus.top = coefficientTop;
			}

			$light.css("margin-top",newMTop-minus.top);
		}

		if(newMLeft != lastLeft){

			if(minus.left == 0)
			{
				minus.left = coefficientLeft;
			}

			$light.css("margin-left",newMLeft-minus.left);
		}


	    lastLeft = newMLeft;
	    lastTop  = newMTop;
	};
};

/**
 * 内容滚动
 */
ZR.BodyScroll=function()
{
	var $zrBody       = $(".zr-top");
	var BodyScrollEle = document.getElementById("BodyScroll");
	var topHeight     = $("#HeadFixed").innerHeight();

	window.onscroll = function(){
	    var t = document.documentElement.scrollTop || document.body.scrollTop;
	    BodyScrollEle.style.top = (topHeight-t)+"px";

	    $zrBody.css("background-position-y",-t*0.07);
	}
};

/**
 * 右侧侧边栏
 */
ZR.Sidebar=function(){
	var sidebarEle = document.getElementById("sidebar");

	function getRight(){
		//return ((document.documentElement.clientWidth || document.body.clientWidth)-980)*0.5 - 94;
		return 0;
	}

	function setRight(){
		sidebarEle.style.right = getRight()+"px";
	}

	setRight();
	$(window).resize(function(){ setRight(); })

	var $body = $('body,html');
	$("#sidebarGoTop").click(function(){
		$body.animate({scrollTop:0},1000);
	})
}

/**
 * 手机端下载效果
 */
ZR.MobileDown=function(){

	function effect()
	{
		this.width             = 80;
		this.height            = 90;
		this.displayMobileBtn  = "hide"; // show || hide

		this.$container        = $(".zr-mobile-down");
		this.$mdownShowBtn     = $("#mdown-show");
		this.$sidebarDiv       = $("#sidebar");
		this.$contentContainer = this.$container.children(".zr-container");

		this.init();
	}

	effect.prototype={

		/**
		 * 初始化
		 */
		init:function(){
			this.event();
		},

		/**
		 * 注册交互事件
		 */
		event:function(){
			var self = this,
				xyPoint = self.getPoint();
			var isLotteryPage = location.href.indexOf("flaglot") > -1;

			if(isLotteryPage){
				self.$contentContainer.css("display","none");
				self.$mdownShowBtn.css("display","block");
				self.$container.css({right:0, bottom:xyPoint.b, width:self.width, height: self.height});
				self.showBtn();
				self.displayMobileBtn="show";
			}
			$("#mdown-close").click(function() { self.hideBar(); });
			this.$mdownShowBtn.click(function(){ self.showBar(); });

			//窗口大小变更，重新计算相应坐标
			$(window).resize(function(){
				self.onresize();
			})
		},

		/**
		 * 窗口变更
		 */
		onresize:function(){
			if(this.displayMobileBtn == "show")
			{
				var xyPoint = this.getPoint();

				this.$container.css("left", xyPoint.x).css("bottom", xyPoint.b);
			}
		},

		/**
		 * 显示下载按钮
		 */
		showBtn:function(){
			this.$contentContainer.css("display","none");
			this.$container.addClass("btn");
			this.$mdownShowBtn.fadeIn();
		},

		/**
		 * 隐藏下载按钮
		 */
		hideBtn:function(){
			this.$container.removeClass("btn");
			this.$contentContainer.css("display","block");
			this.$mdownShowBtn.fadeOut();
		},

		/**
		 * 显示底部下载栏
		 */
		showBar:function(){
			var self = this;
			//console.log(this.height);
			self.hideBtn();
			self.$container.velocity({left:0, bottom:0, width:$(window).width(), height: 145},300, function(){
				self.displayMobileBtn="hide";
			});
		},

		/**
		 * 隐藏底部下载栏
		 */
		hideBar:function(){
			var self    = this,
				xyPoint = self.getPoint();
			self.$container.velocity({left:xyPoint.x, bottom:xyPoint.b, width:self.width, height: self.height},300, function(){
				self.showBtn();
				self.displayMobileBtn="show";
			});
		},

		/**
		 * 坐标点
		 */
		getPoint:function(){
			var x = this.$sidebarDiv.offset().left;
			var y = this.$sidebarDiv.offset().top+this.$sidebarDiv.innerHeight() + 115 - this.getScrollTop();
			return {x:x, y:y, b:(this.getBodyHeight()-y)};
		},

		/**
		 * 页面垂直滚动值
		 */
		getScrollTop:function(){
			return document.documentElement.scrollTop || document.body.scrollTop;
		},

		/**
		 * 取得显示内容高度
		 */
		getBodyHeight:function(){
			if(window.innerHeight!= undefined){
		        return window.innerHeight;
		    }
		    else{
		        return document.documentElement.clientHeight;
		    }
		}
	}

	new effect();
};

$(function(){
	new ZR.TopBannerMove();
	//new ZR.BodyScroll();
	new ZR.Sidebar();
	new ZR.MobileDown();
})
