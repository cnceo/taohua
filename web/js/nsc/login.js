/**
 * Created with JetBrains WebStorm.
 * User: Robin
 * Date: 13-5-7
 * Time: 下午3:34
 * 整理登录 js 文件
 */

var jsonParse = (function () {
    var number
        = '(?:-?\\b(?:0|[1-9][0-9]*)(?:\\.[0-9]+)?(?:[eE][+-]?[0-9]+)?\\b)';
    var oneChar = '(?:[^\\0-\\x08\\x0a-\\x1f\"\\\\]'
        + '|\\\\(?:[\"/\\\\bfnrt]|u[0-9A-Fa-f]{4}))';
    var string = '(?:\"' + oneChar + '*\")';

    // Will match a value in a well-formed JSON file.
    // If the input is not well-formed, may match strangely, but not in an unsafe
    // way.
    // Since this only matches value tokens, it does not match whitespace, colons,
    // or commas.
    var jsonToken = new RegExp(
        '(?:false|true|null|[\\{\\}\\[\\]]'
            + '|' + number
            + '|' + string
            + ')', 'g');

    // Matches escape sequences in a string literal
    var escapeSequence = new RegExp('\\\\(?:([^u])|u(.{4}))', 'g');

    // Decodes escape sequences in object literals
    var escapes = {
        '"': '"',
        '/': '/',
        '\\': '\\',
        'b': '\b',
        'f': '\f',
        'n': '\n',
        'r': '\r',
        't': '\t'
    };
    function unescapeOne(_, ch, hex) {
        return ch ? escapes[ch] : String.fromCharCode(parseInt(hex, 16));
    }

    // A non-falsy value that coerces to the empty string when used as a key.
    var EMPTY_STRING = new String('');
    var SLASH = '\\';

    // Constructor to use based on an open token.
    var firstTokenCtors = { '{': Object, '[': Array };

    var hop = Object.hasOwnProperty;

    return function (json, opt_reviver) {
        // Split into tokens
        var toks = json.match(jsonToken);
        // Construct the object to return
        var result;
        var tok = toks[0];
        var topLevelPrimitive = false;
        if ('{' === tok) {
            result = {};
        } else if ('[' === tok) {
            result = [];
        } else {
            // The RFC only allows arrays or objects at the top level, but the JSON.parse
            // defined by the EcmaScript 5 draft does allow strings, booleans, numbers, and null
            // at the top level.
            result = [];
            topLevelPrimitive = true;
        }

        // If undefined, the key in an object key/value record to use for the next
        // value parsed.
        var key;
        // Loop over remaining tokens maintaining a stack of uncompleted objects and
        // arrays.
        var stack = [result];
        for (var i = 1 - topLevelPrimitive, n = toks.length; i < n; ++i) {
            tok = toks[i];

            var cont;
            switch (tok.charCodeAt(0)) {
                default:  // sign or digit
                    cont = stack[0];
                    cont[key || cont.length] = +(tok);
                    key = void 0;
                    break;
                case 0x22:  // '"'
                    tok = tok.substring(1, tok.length - 1);
                    if (tok.indexOf(SLASH) !== -1) {
                        tok = tok.replace(escapeSequence, unescapeOne);
                    }
                    cont = stack[0];
                    if (!key) {
                        if (cont instanceof Array) {
                            key = cont.length;
                        } else {
                            key = tok || EMPTY_STRING;  // Use as key for next value seen.
                            break;
                        }
                    }
                    cont[key] = tok;
                    key = void 0;
                    break;
                case 0x5b:  // '['
                    cont = stack[0];
                    stack.unshift(cont[key || cont.length] = []);
                    key = void 0;
                    break;
                case 0x5d:  // ']'
                    stack.shift();
                    break;
                case 0x66:  // 'f'
                    cont = stack[0];
                    cont[key || cont.length] = false;
                    key = void 0;
                    break;
                case 0x6e:  // 'n'
                    cont = stack[0];
                    cont[key || cont.length] = null;
                    key = void 0;
                    break;
                case 0x74:  // 't'
                    cont = stack[0];
                    cont[key || cont.length] = true;
                    key = void 0;
                    break;
                case 0x7b:  // '{'
                    cont = stack[0];
                    stack.unshift(cont[key || cont.length] = {});
                    key = void 0;
                    break;
                case 0x7d:  // '}'
                    stack.shift();
                    break;
            }
        }
        // Fail if we've got an uncompleted object.
        if (topLevelPrimitive) {
            if (stack.length !== 1) { throw new Error(); }
            result = result[0];
        } else {
            if (stack.length) { throw new Error(); }
        }

        if (opt_reviver) {
            var walk = function (holder, key) {
                var value = holder[key];
                if (value && typeof value === 'object') {
                    var toDelete = null;
                    for (var k in value) {
                        if (hop.call(value, k) && value !== holder) {
                            var v = walk(value, k);
                            if (v !== void 0) {
                                value[k] = v;
                            } else {
                                // Deleting properties inside the loop has vaguely defined
                                // semantics in ES3 and ES3.1.
                                if (!toDelete) { toDelete = []; }
                                toDelete.push(k);
                            }
                        }
                    }
                    if (toDelete) {
                        for (var i = toDelete.length; --i >= 0;) {
                            delete value[toDelete[i]];
                        }
                    }
                }
                return opt_reviver.call(holder, key, value);
            };
            result = walk({ '': result }, '');
        }

        return result;
    };
})();

function refreshimg(){
	var url = "/?useValid=true&rand=" + Math.random();
	$(".validate").attr("src",url);
}

$(function(){
	/* 监听回车键 */
	$(document).keydown(function(event){
		if (!$("#JS_blockPage").is(":visible")) {
			if(event.keyCode == 13){
			
			}
		}
	});
	
	jQuery("input.password").keypad({
		layout: [
				$.keypad.SPACE + $.keypad.SPACE + $.keypad.SPACE + '1234567890',
				'cdefghijklmab', 
								"stuvwxyznopqr"/*+ $.keypad.CLEAR*/,
								$.keypad.SPACE + $.keypad.SPACE + $.keypad.SHIFT + $.keypad.CLEAR + $.keypad.BACK + $.keypad.CLOSE
				],
		 // 软键盘按键布局 
		buttonImage:'/js/keypad/kb.png',	// 弹出(关闭)软键盘按钮图片地址
		buttonImageOnly: true,	// True 表示已图片形式显示, false 表示已按钮形式显示
		buttonStatus: '打开/关闭软键盘', // 打开/关闭软键盘按钮说明文字
		showOn: 'button', // 'focus'表示已输入框焦点弹出, 
			// 'button'通过按钮点击弹出,或者 'both' 表示两者都可以弹出 
			
		keypadOnly: false, // True 表示只接受软件盘输入, false 表示可以通过键盘和软键盘输入
			
		randomiseNumeric: true, // True 表示对所以数字位置进行随机排列, false 不随机排列
		randomiseAlphabetic: true, // True 表示对字母进行随机排列, false 不随机排列 
		
				clearText: '清空', // Display text for clear link 
				clearStatus: '', // Status text for clear l
				
		shiftText: '大小写', // SHIFT 按键功能的键的显示文字 
		shiftStatus: '转换字母大小写', // SHIFT按键功能的TITLE说明文字 
		
		closeText: '关闭', // 关闭按键功能的显示文字 
		closeStatus: '关闭软键盘', // 关闭按键功能的TITLE说明文字 
		
		backText: '退格', // 退格功能键的显示文字 
		backStatus: '退格', // 退格功能键的说明文字
			   
		onClose: null	// 点击软键盘关闭是调用的函数
	});


    $(".inputbox div").click(function(){
        $(this).hide();
        $(this).siblings('input').focus();
    });

    $(".inputbox input").blur(function(){
        var v = $(this).val();
        if(v === ''){
            $(this).siblings('div').show();
        }else{

        }
    });

    $(".inputbox input").focus(function(){
        $(this).siblings('div').hide();
    });


    /*缩放处理*/
    function zoomFun(){
        var _w = $(window).width();
        if(_w <= 980){
            $(".warp980").addClass('warp760');
            $(".browser_box").hide();
        }
        if(_w > 980 && _w <= 1100){
            $(".warp980").addClass('warp880');
        }
    }
    zoomFun();
    /*缩放处理*/
});

function checkclient(){
    setCookie('isclient','1');
}

var setCookie=function(name,value,expire,path){
    //expire=expire||30*24*60*60*1000;
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
    path=path||"/";
    cookie+="path="+path;
    document.cookie=cookie;
};

function cIsclient(sUrl){
    openweb(sUrl);
};

function isclient(Csurl){
    if(getCookie('isclient')){
        cIsclient(Csurl);
    }else{
        window.open(Csurl,'在线客服','width=590,height=550');
    }
};

var getCookie=function(name) {
	var re = "(?:; )?" + encodeURIComponent(name) + "=([^;]*);?";
	re = new RegExp(re);
	if (re.test(document.cookie)) {
	return decodeURIComponent(RegExp.$1);
	}
	return '';
};
function jjtc(){
	$.alert('即将推出，敬请期待');
}
function FavHisCookie(name){
	var u = getCookie("u");
	if(u == "" || u == name){
		setCookie("u",name);
	}else{//和上一次登录的账号不同
		setCookie("u",name);
		setCookie("recGame","");
		setCookie("recTime","");
		setCookie("favGame","");
		setCookie("favTime","");
	}
}

