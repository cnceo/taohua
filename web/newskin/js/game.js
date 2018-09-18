$(function(){
	$('input.code').live('click', function(){
		var $this=$(this);
		if($this.is('.checked')){
			$this.removeClass('checked');
		}else{
			$this.addClass('checked');
		}
		gameMsgAutoTip();
	});
	if($.browser.msie){
		$('a, :button, :radio, :checkbox').live('focus', function(){
			this.blur();
		});
	}
	$('li.action').live('click', function(){
		var $this=$(this),
		call=$this.attr('action'),
		pp=$this.parent().parent();
		$this.addClass("hover").siblings(".action").removeClass("hover");
		if(call && $.isFunction(call=window[call])){
			call.call(this, pp);
		}else if($this.is('.all')){
			$('input.code',pp).addClass('checked');
		}else if($this.is('.big')){
			$('input.code.max',pp).addClass('checked');
			$('input.code.min',pp).removeClass('checked');
		}else if($this.is('.small')){
			$('input.code.min',pp).addClass('checked');
			$('input.code.max',pp).removeClass('checked');
		}else if($this.is('.odd')){
			$('input.code.d',pp).addClass('checked');
			$('input.code.s',pp).removeClass('checked');
		}else if($this.is('.even')){
			$('input.code.s',pp).addClass('checked');
			$('input.code.d',pp).removeClass('checked');
		}else if($this.is('.clean')){
			$('input.code',pp).removeClass('checked');
		}
		gameMsgAutoTip();
	});
	$("#lt_funding span").unbind("click").click(function(){
		var data = $(this).attr("data");
		$("#lt_funding span").removeClass("hover");
		$(this).addClass("hover");
		$("input[name='lt_project_modes']").prop("checked", false);
		$("input.radio_" + data).prop("checked", true);
		mosiselect($("input[name='lt_project_modes']:checked").val());
		gameMsgAutoTip();
	});
	$(".multipleBox .reduce").unbind("click").click(function(){
		var input = $(this).parent().find("input");
		var v = $(input).val();
		v--;
		if(v<=0){
			v = 1;
		}
		$(input).val(v);
		checkTimes();
		return false
	});
	$(".multipleBox .add").unbind("click").click(function(){
		var input = $(this).parent().find("input");
		var v = $(input).val();
		v++;
		$(input).val(v);
		checkTimes();
		return false
	});
	$('#lt_sel_times').keyup(function(){
		checkTimes();
	});
	$('#lt_cf_content .del').live('click', function(){
		$(this).closest('tr').remove();
		$('.fqzhBox :checkbox[name=zhuiHao]').removeData()[0].checked=false;
		if($('#lt_cf_content tr.lottery').length==0){
			$('.fqzhBox :checkbox[name=zhuiHao]').removeData()[0].checked=false;
			$('#ischeck').removeClass('check').addClass('uncheck');
		}
		sendok();
		gameCalcAmount();
	});
	$(".lotteryList a.cleanall").click(function(){
		var num = $("#lt_cf_content tr.lottery a.del").length;
		if(num > 0){
			$.each($("#lt_cf_content tr.lottery a.del"),function(i,v){
				$(v).trigger('click');
			});
		}
		$('.fqzhBox :checkbox[name=zhuiHao]').removeData()[0].checked=false;
		$('#ischeck').removeClass('check').addClass('uncheck');
	});
	$('#lt_sendok').unbind("click").click(function(){
		if($(this).hasClass('sendBtnDisabled')){
			return false;
		}
	});
	$('#textarea-code').live('keypress', function(event){
		event.keyCode=event.keyCode||event.charCode;
		return !!(
			event.ctrlKey
			|| event.altKey
			|| event.shiftKey
			|| event.keyCode==13
			|| event.keyCode==8
			|| (event.keyCode>=48
			&& event.keyCode<=57)
		);
	}).live('keyup', gameMsgAutoTip);
	$('#textarea-code').live('change', function(){
		var str=$(this).val();
		if(/[a-zA-Z]+/.test(str)){
			winjinAlert('投注号码不能含有字母字符',"alert");
			$(this).val('');
		}
	});
	$(".fqzhBox b").unbind().click(function(){
		$(".fqzhBox span").trigger('click');
	});
	$('.fqzhBox span').click(function(){
		$(".fqzhBox :checkbox[name=zhuiHao]").trigger('click');
		var bet=$('#lt_cf_content tr.lottery'),
		zhlen=bet.length
		if(zhlen==0){
			$.alert('请先添加投注内容');
			return false;
		}else if(zhlen>1){
			$.alert('只能针对一个方案发起追号！');
			return false;
		}
		setGameZhuiHao(bet.data('code'));
		return false;
	});
	$(".qxzhBox").bind().click(function(){
		$('.fqzhBox :checkbox[name=zhuiHao]').removeData()[0].checked=false;
		$('#ischeck').removeClass('check').addClass('uncheck');
		$( this ).dialog( "destroy" );
		gameCalcAmount();
	});
	$('#zhuihaodiv thead :checkbox').live('change', function(){
		$(this).closest('table').find('tbody :checkbox').prop('checked', this.checked).trigger('change');
	});
	$('#zhuihaodiv tbody :checkbox').live('change', function(){
		var $this=$(this),
		$ui=$this.closest('div[rel]'),
		data=$ui.data(),
		amount=$ui.attr('rel') * Math.abs($this.closest('tr').find('.beishu').val());
		if(!data.count){
			data.count=0;
			data.amount=0;
		}
		if(this.checked){
			data.count++;
			data.amount+=amount;
		}else{
			data.count--;
			data.amount-=amount;
		}
		$('.zqs').text(data.count);
		$('.zamount').text(Math.round(data.amount*100)/100);
		$this.closest('tr').find('.amount').text(Math.round(amount*100)/100);
		$this.data('amount', amount);
	});
	$('#zhuihaodiv tbody .beishu').live('change', function(e){
		var $this=$(this);
		var re=/^[1-9][0-9]*$/;
		if(!re.test($this.val())){$.alert('倍数只能为正整数');$this.val(1);return false;}
		if(!$this.closest('tr').find(':checkbox')[0].checked) return false;
		var $ui=$this.closest('div[rel]'),
		data=$ui.data(),
		$checkbox=$this.closest('tr').find(':checkbox'),
		_amount=Math.abs($checkbox.data('amount'));
		amount=$ui.attr('rel') * Math.abs($this.val()),
		data.amount+=amount-_amount;
		$checkbox.data('amount', amount);
		$('.zqs').text(data.count);
		$('.zamount').text(Math.round(data.amount*1000)/1000);
		$this.closest('tr').find('.amount').text(Math.round(amount*1000)/1000);
	});
	$('.lotteryGroup li[data]').live('click', function(){
		initialize();
		var $this=$(this);
		if($this.is('.hover')) return false;
		$('#updategroup').load($this.attr('data'), function(){
			$this.closest('.lotteryGroup').find('.hover').removeClass('hover');
			$this.closest('li').addClass('hover');
			$('#lt_small_label li[href]:first').trigger('click');
			filterHeight();
		});
		return false;
	});
	$('#lt_small_label dd[data]').live('click', function(){
		initialize();
		var $this=$(this);
		loadPlayTips($this.attr('data_id'));
		$('#lt_selector').load($this.attr('data'), function(){
			$this.closest('#lt_small_label').find('.hover').removeClass('hover');
			$this.closest('dd').addClass('hover');
			filterHeight();
		});
		return false;
	});
	$('#lt_example').live("mouseover",function(){
		var $action=$(this).attr('action');
		var ps = $(this).position();
		$('#'+$action+'_div').siblings('#lt_example_div').hide();
		$('#'+$action+'_div').css({top:ps.top + 20,left:ps.left + 20}).fadeIn(100);
	});
	$('#lt_example').live("mouseout",function(){
		$('.playf_dl').find('#lt_example_div').hide();
	});
	$('#lt_help').live("mouseover",function(){
		var $action=$(this).attr('action');
		var ps = $(this).position();
		$('#'+$action+'_div').siblings('#lt_example_div').hide();
		$('#'+$action+'_div').css({top:ps.top + 20,left:ps.left + 20}).fadeIn(100);
	});
	$('#lt_help').live("mouseout",function(){
		$('.playf_dl').find('#lt_help_div').hide();
	});
	$('.kjabtn').live('click', function(){
		var $this=$(this);
		$this.closest('.kaijiangall').find('ul').load($this.attr('src'), function(){
			$('.kjabtn.current').removeClass('current');
			$this.addClass('current');
		});
	});
	$('.jiang').live('click', function(){
		var $this=$(this);
		if($this.is('.current')) return true;
		$('.jiang.current').removeClass('current');
		$this.addClass('current');
		return true;
	}).find('select').live('change', function(){
		$('.zj-cont tbody').load(this.value);
	});
	$('.zhixu115 :input.code').live('click',function(event){
		var $this=$(this);
		if(!$this.is('.checked')) return false;
		var $dom=$this.closest('.zhixu115');
		$('.code.checked[value=' + this.value +']', $dom).removeClass('checked');
		$this.addClass('checked');
	});
	$("span .more").live("click",function(event){
		var index = $("span.more").index($(this));
		var li = $(this).parent().parent("li");
		var data = li.attr("data");
		var arr = data.split(" ");
		var html = "";
		$.each(arr,function(i,n){
			html += "<span>" + n + "</span>"
		});
		$(".seeMore").html(html).css({"top" : index*29 + 62 + "px"}).show();
		event.stopPropagation();
		event.preventDefault();
	});

});
var MaxZjCount={
	ds:function(){
		var zjCount=0,t=1,s;
		$.each(this.split('|').sort(), function(){
			if(s==String(this)){
				t++;
			}else{
				s=this;
				if(t>zjCount) zjCount=t;
				t=1;
			}
		});
		if(t>zjCount) zjCount=t;
		return zjCount;
	},
	fs:function(){
		return 1;
	},
	dxds:function(){
		var d=this.split(',').map(function(v){
			return v
			.replace('单','双')
			.replace('大', '小')
			.split("").sort().join('')
			.replace(/双{2,}/,'双')
			.replace(/小{2,}/,'小')
			.length;
		});
		return d[0] * d[1];
	},
	dd5x:function(){
		return this.split(',').filter(function(v){return v!='-'}).length;
	},
	bdd:function(){
		return this.length>3?3:this.length;
	}
}
function loadPlayTips(playedid){
	$('#game-helptips').load('/index/playTips/'+playedid);
}
function Countdown(Time, type){
	var d1 = new Date();
	var d2 = new Date(Date.parse(Time));
	var value=(d2 - d1) / 1000;
	var theTime = parseInt(value);
	if(theTime<=0){
		if(type==1){
			clearInterval(int1);
		}else if(type==20){
			clearInterval(int20);
		}else if(type==14){
			clearInterval(int14);
		}
	}
	var theTime1 = 0;
	var theTime2 = 0;
	if(theTime > 60) {
		theTime1 = parseInt(theTime/60);
		theTime = parseInt(theTime%60);
	}
	if(theTime<10){
	   theTime="0"+theTime;
	}
	if(theTime1 >= 0) {
	   if(theTime1<10){
		   theTime1="0"+theTime1;
	   }
	}
	if(type==1){
		$("#cqMin").html(theTime1);
		$("#cqSec").html(theTime);
	}else if(type==20){
		$("#pk10Min").html(theTime1);
		$("#pk10Sec").html(theTime);
	}else if(type==14){
		$("#ffcMin").html(theTime1);
		$("#ffcSec").html(theTime);
	}
}
function initialize(){
	$('#lt_sel_nums').text(0);
	$('#lt_sel_money').text(0);
	$('#btnaddBet').addClass('addBtnDisabled');
	$('#btnaddBet').unbind('click');
}
function checkTimes(){
	var times = $('#lt_sel_times').val().replace(/[^0-9]/g,"").substring(0,5);
	$('#lt_sel_times').val( times );
	if( times == "" ){
		times = 1;
		$('#lt_sel_times').val(times);
	}else{
		times = parseInt(times,10);
	}
	if(times === 0){
		times = 1;
		$.alert("倍数不能输入0");
		$('#lt_sel_times').val(times);
	};
	gameMsgAutoTip();
}