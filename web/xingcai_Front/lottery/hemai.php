<?php $this->display('inc_daohang.php'); ?>


<div id="nsc_subContent" style="border:0">


<div id="siderbar">
<ul class="list clearfix">
<li class="current"><a href="/index.php/lottery/hemai">合买中心</a></li>
<li ><a href="/index.php/lottery/search">投注记录</a></li>
</ul>
</div>

<link rel="stylesheet" href="/css/nsc/reset.css?v=1.16.11.5" />
<link rel="stylesheet" href="/css/nsc/list.css?v=1.16.11.5" />
<link rel="stylesheet" href="/css/nsc/activity.css?v=1.16.11.5" />
<script type="text/javascript" src="/js/nsc/jquery-1.7.min.js?v=1.16.11.5"></script>
<script type="text/javascript" src="/js/nsc/dialogUI/jquery.dialogUI.js?v=1.16.11.5"></script>
<link href="/css/nsc/plugin/dialogUI/dialogUI.css?v=1.16.11.5" media="all" type="text/css" rel="stylesheet" />

</head>
<body>
<div id="subContent_bet_re">

<script type="text/javascript">
$(function(){
	
	$('.search form input[name=betId]')
	.focus(function(){
		if(this.value=='输入单号') this.value='';
	})
	.blur(function(){
		if(this.value=='') this.value='输入单号';
	})
	.keypress(function(e){
		if(e.keyCode==13) $(this).closest('form').submit();
	});
	
	$('.chazhao').click(function(){
		$(this).closest('form').submit();
	});
	
	$('.bottompage a[href]').live('click', function(){
		$('.biao-cont').load($(this).attr('href'));
		return false;
	});

});

function recordSearch(err, data){
	if(err){
		alert(err);
	}else{
		$('.biao-cont').html(data);
	}
}
function recodeRefresh(){
	$('.biao-cont').load(
		$('.bottompage .pagecurrent').attr('href')
	);
}

function deleteBet(err, code){
		$.alert(code);
	if(err){
		$.alert(err);
	}else{
            $('.pagemain').load('/index.php/lottery/search');
//		recodeRefresh();
	}
}
</script>
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

	  	
	
	  	

	  	//系统公告
	  	$(".notice,.sysMsgAlet").on("click",function(){
	  		$(this).layer({height:"567","scale":false});
	  	});

	  
	});

	
</script>
<div id="contentBox">
    <form action="/index.php/lottery/combine_buy/<?=$this->userType?>" dataType="html" call="recordSearch" target="ajax">
      
        <div id="searchBox" class="re">
        	
            <div class="inlineBlock">
                <label>彩种名称：</label>
                <select class="team" name="type">
                <option value="0" <?=$this->iff($_REQUEST['type']=='', 'selected="selected"')?>>全部彩种</option>
            <?php
                if($this->types) foreach($this->types as $var){ 
                    if($var['enable']){
            ?>
            <option value="<?=$var['id']?>" <?=$this->iff($_REQUEST['type']==$var['id'], 'selected="selected"')?>><?=$this->iff($var['shortName'], $var['shortName'], $var['title'])?></option>

            <?php }} ?>
        </select>
            </div>
            <div class="inlineBlock">
            	<label>彩种状态：</label><select name="state" class="team">
				<option value="0" selected>所有状态</option>
				<option value="1">已派奖</option>
				<option value="2">未中奖</option>
				<option value="3">未开奖</option>
				<option value="4">追号</option>
				<option value="5">撤单</option>
        </select>
            </div>            
        <input type="button" value="查询" class="formCheck chazhao" /></div>
  
       
    </form>
    </div>
  <div class="display biao-cont">
    	<!--下注列表-->
        <?php $this->display('lottery/combine_list.php'); ?>
        <!--下注列表 end -->
    </div>
<?php $this->display('inc_root.php'); ?>
<div class="list_page">
    <!--span class="l_message">备注:如需查看投注单详情，请点击单号</span-->
    <div class="pageinfo"></div>
</div>
</div></div></div></div></div>
<?php $this->display('inc_che.php'); ?>

 </body>
 </html>