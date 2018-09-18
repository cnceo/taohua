$(function(){
	$('a[target=ajax]').live('click', function(){
		var $this	= $(this),
		self		= this,
		onajax		= window[$this.attr('onajax')],
		title		= $this.attr('title'),
		call		= window[$this.attr('call')];
		if(title && !confirm(title))
		 return false;
		if(typeof call!='function'){
			call=function(){}
		}
		if('function'==typeof onajax){
			try{
				if(onajax.call(this)===false) return false;
			}catch(err){
				call.call(self, err);
				return false;
			}
		}
		$.ajax({
			url:$this.attr('href'),
			async:true,
			data:$this.data(),
			type:$this.attr('method')||'get',
			dataType:$this.attr('dataType')||'html',
			error:function(xhr, textStatus, errThrow){
				call.call(self, errThrow||textStatus);
			},
			success:function(data, textStatus, xhr, headers){
				var errorMessage=xhr.getResponseHeader('X-Error-Message');
				if(errorMessage){
					call.call(self, decodeURIComponent(errorMessage), data);
				}else{
					call.call(self, null, data);
				}
			}
		});
		return false;
	});
	$('a[target=modal]').live('click', function(){
		var self=this,
		$self=$(self),
		title=$self.attr('title')||'',
		width=$self.attr('width')||'auto',
		heigth=$self.attr('heigth')||'auto',
		modal=($self.attr('modal')),
		method=$self.attr('method')||'get',
		buttons=$self.attr('button')||null;
		if(buttons) buttons=buttons.split('|').map(function(b){
			b=b.split(':');
			return {text:b[0], click:window[b[1]]};
		});
		$[method]($self.attr('href'), function(html){
			$(html).dialog({
				title:title,
				width:width,
				height:heigth,
				modal:modal,
				buttons:buttons
			});
		});
		
		return false;
	});
	$('form[target=ajax]').live('submit', function(){
		var data	= [], 
		$this		= $(this),
		self		= this,
		onajax		= window[$this.attr('onajax')],
		call		= window[$this.attr('call')];
		
		if(typeof call!='function'){
			call=function(){}
		}
		if('function'==typeof onajax){
			try{
				if(onajax.call(this)===false) return false;
			}catch(err){
				call.call(self, err);
				return false;
			}
		}
		$(':input[name]', this).each(function(){
			var $this=$(this),
			value=$this.data('value'),
			name=$this.attr('name');
			if($this.is(':radio, :checkbox') && this.checked==false) return true;
			if(value===undefined) value=this.value;
			data.push({name:name, value:value});
		});
		$.ajax({
			url:$this.attr('action'),
			async:true,
			data:data,
			type:$this.attr('method')||'get',
			dataType:$this.attr('dataType')||'json',
			headers:{"x-form-call":1},
			error:function(xhr, textStatus, errThrow){
				call.call(self, errThrow||textStatus);
			},
			success:function(data, textStatus, xhr, headers){
				var errorMessage=xhr.getResponseHeader('X-Error-Message');
				if(errorMessage){
					call.call(self, decodeURIComponent(errorMessage), data);
				}else{
					call.call(self, null, data);
				}
			}
		});
		return false;
	});
	if($.datepicker){
		$(".datainput").datepicker({ onSelect: function(dateText, inst) {$(this).val(dateText);} });
	} 
	if(!$.browser.opera && !$.browser.mozilla){
		$('input[name=vcode]').live('keypress', function(event){
			if(event.keyCode==13){
				$(this.form).trigger('submit');
			}
		});
	}
	$('.ui-dialog .bottompage a').live('click', function(){
		var $this=$(this);
		$this.closest('.ui-dialog-content').load($this.attr('href'));
		return false;
	});

	if(typeof(TIP)!='undefined' && TIP){
	setInterval(function(){
		reloadMemberInfo();
		$.getJSON('/Tip/getTKTip', function(tip){
			if(tip){
				if(!tip.flag) return;
				$("<div>").append(tip.message).dialog({
						position:['right','bottom'],
						minHeight:40,
						title:'系统提示',
						buttons:''
					});
			}
		})
	}, 15000);
	setInterval(function(){
		reloadMemberInfo();
		$.getJSON('/Tip/getCZTip', function(tip){
			if(tip){
				if(!tip.flag) return;
				$("<div>").append(tip.message).dialog({
						position:['right','bottom'],
						minHeight:40,
						title:'系统提示',
						buttons:''
					});
			}
		})
	}, 15000);
	}
});
Number.prototype.round=Number.prototype.toFixed;
function registerBeforSubmit(){
	var type=$('[name=type]:checked',this).val();
	if(!this.username.value) throw('没有输入用户名');
	if(!/^\w{4,16}$/.test(this.username.value)) throw('用户名由4到16位的字母、数字及下划线组成');
	if(!this.nickname.value) throw('请输入昵称');
	if(!this.password.value) throw('请输入密码');
	if(this.password.value.length<6) throw('密码至少6位');
	if(!this.cpasswd.value) throw('请输入确认密码');
	if(this.cpasswd.value!=this.password.value) throw('两次输入密码不一样');
}
function registerSubmit(err,data){
	if(err){
		alert(err);
	}else{
		alert(data);
		location='/user/login';
	}
	$("#vcode").trigger("click");
}
function userBeforeLogin(){
	var u=this.username.value;
	var v=this.vcode.value;
	if(!u || u=='帐号'){alert("请输入用户名");}
	else if(!v || v=='验证码'){alert("请输入验证码");}
	else{return true;}
	return false;
}
function userLogin(err, data){
	if(err){
		alert(err);
		$('input[name=vcode]')
		.val('')
		.closest('div')
		.find('.ico-code img')
		.click();
	}else{
		location='/';
		//location='/index.php/user/loginto';
	}
}
function userBeforLoginto(){
        var u=this.username.value;
	var p=this.password.value;
	if(!u || u=='帐号'){alert("请输入用户名");}
	else if(!p || p=='xx@x@x.x'){alert("请输入密码");}
	else{return true;}
	return false;
}
function userLoginto(err, data){
	if(err){
		layer.alert((err),{icon: 2,title :'消息提示'});
		
	}else{
		location='/user/login';
	}
}
Number.prototype.round=Number.prototype.toFixed;


function changeMoneyToChinese( money )
{
var cnNums = new Array("零","壹","贰","叁","肆","伍","陆","柒","捌","玖"); //汉字的数字
var cnIntRadice = new Array("","拾","佰","仟"); //基本单位
var cnIntUnits = new Array("","万","亿","兆"); //对应整数部分扩展单位
var cnDecUnits = new Array("角","分","毫","厘"); //对应小数部分单位
var cnInteger = "整"; //整数金额时后面跟的字符
var cnIntLast = "元"; //整型完以后的单位
var maxNum = 999999999999999.9999; //最大处理的数字

var IntegerNum; //金额整数部分
var DecimalNum; //金额小数部分
var ChineseStr=""; //输出的中文金额字符串
var parts; //分离金额后用的数组，预定义

if( money == "" ){
return "";
}

money = parseFloat(money);
//alert(money);
if( money >= maxNum ){
$.alert('超出最大处理数字');
return "";
}
if( money == 0 ){
ChineseStr = cnNums[0]+cnIntLast+cnInteger;
//document.getElementById("show").value=ChineseStr;
return ChineseStr;
}
money = money.toString(); //转换为字符串
if( money.indexOf(".") == -1 ){
IntegerNum = money;
DecimalNum = '';
}else{
parts = money.split(".");
IntegerNum = parts[0];
DecimalNum = parts[1].substr(0,4);
}
if( parseInt(IntegerNum,10) > 0 ){//获取整型部分转换
zeroCount = 0;
IntLen = IntegerNum.length;
for( i=0;i<IntLen;i++ ){
n = IntegerNum.substr(i,1);
p = IntLen - i - 1;
q = p / 4;
m = p % 4;
if( n == "0" ){
zeroCount++;
}else{
if( zeroCount > 0 ){
ChineseStr += cnNums[0];
}
zeroCount = 0; //归零
ChineseStr += cnNums[parseInt(n)]+cnIntRadice[m];
}
if( m==0 && zeroCount<4 ){
ChineseStr += cnIntUnits[q];
}
}
ChineseStr += cnIntLast;
//整型部分处理完毕
}
if( DecimalNum!= '' ){//小数部分
decLen = DecimalNum.length;
for( i=0; i<decLen; i++ ){
n = DecimalNum.substr(i,1);
if( n != '0' ){
ChineseStr += cnNums[Number(n)]+cnDecUnits[i];
}
}
}
if( ChineseStr == '' ){
ChineseStr += cnNums[0]+cnIntLast+cnInteger;
}
else if( DecimalNum == '' ){
ChineseStr += cnInteger;
}
return ChineseStr;

}