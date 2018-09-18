;(function($){//start
    //选号区动态插入函数，可能是手动编辑
    $.fn.lt_selectarea = function( opts ){
        var ps = {//默认参数
                type   : 'digital', //选号，'input':输入型,'digital':数字选号型,'dxds':大小单双类型
                layout : [
                           {title:'百位', no:'0|1|2|3|4|5|6|7|8|9', place:0, cols:1},
                           {title:'十位', no:'0|1|2|3|4|5|6|7|8|9', place:1, cols:1},
                           {title:'个位', no:'0|1|2|3|4|5|6|7|8|9', place:2, cols:1}
                          ],//数字型的号码排列
                noBigIndex : 5,    //前面多少个号码是小号,即大号是从多少个以后开始的
                isButton   : true,  //是否需要全大小奇偶清按钮
                imagedir   : './js/lottery/image/' //按钮图片文件夹位置
            };
        opts = $.extend( {}, ps, opts || {} ); //根据参数初始化默认配置
        var data_sel = [];//用户已选择或者已输入的数据
		var random_bets = false;//是否机选
		var minchosen = [];
        var max_place= 0; //总共的选择型排列数
        var otype = opts.type.toLowerCase();    //类型全部转换为小写
        var methodname = $.lt_method[$.lt_method_data.methodid];//玩法的简写,如:'ZX3'
		var defaultposition = $.lt_method_data.defaultposition;//获取任选复选框初始化参数
        var menuid = $.lt_method_data.menuid;
		//记录复选万千百十个的数组
		//alert($.lt_id_data.id_poschoose);
		$.lt_position_sel = [];
		$("input[name='poschoose']").val("");
		if(opts.selPosition == 'true'){
			defaultposition = defaultposition.split("");
            var phtml = '<dt>' + lot_lang.dec_s30 + '</dt>';
			$.each(defaultposition,function(i,v){
				if(v == 1){
					$.lt_position_sel.push(i);
					phtml += '<dd><input type="checkbox" name="pos[]" class="posChoose" value="' + (i+1) + '" checked>' + lot_lang.dec_s31[i] + '</dd>';
				}else{
					phtml += '<dd><input type="checkbox" name="pos[]" class="posChoose" value="' + (i+1) + '">' + lot_lang.dec_s31[i] + '</dd>';
				}
			});

		}else{
			var phtml = '';
		}
		$($.lt_id_data.id_poschoose).html(phtml);

        $(".posChoose").click(function(event) {
            $.lt_position_sel = [];
            $.each($(".posChoose"),function(i,v){
                if($(this).prop("checked") === true) {
                    $.lt_position_sel.push(i);
                }
            });
            checkNum();
            event.stopPropagation();
        });

        $("#poschoose dd").click(function(event){
        	var node = $(this).find(".posChoose");
            if(node.prop("checked") === true){
                node.prop("checked",false);
            }else{
                node.prop("checked",true);
            }

            $.lt_position_sel = [];
            $.each($(".posChoose"),function(i,v){
                if($(this).prop("checked") === true) {
                    $.lt_position_sel.push(i);
                }
            });
            checkNum();
        	event.stopPropagation();
        });

        switch(methodname)
        {
            case 'BJRX1':
            case 'BJRX2':
            case 'BJRX3':
            case 'BJRX4':
            case 'BJRX5':
            case 'BJRX6':
            case 'BJRX7':
				var html  = '';
                break;
            case 'PK10JS'://pk10竞速
            	var html = '<div class="pk10_left">';
            	break;
            default:
				var html  = '';
                break;
        }

		//代码开始

		if(1){
			if( otype == 'input' ){//输入型，则载入输入型的数据
				//var html  = '<div class="grayContent" id="right_05_input">';
				var tempdes    = '';
				switch( methodname ){
					case 'SDZX3' :
					case 'SDZU3' :
					case 'SDZX2' :
					case 'SDRX1' :
					case 'SDRX2' :
					case 'SDRX3' :
					case 'SDRX4' :
					case 'SDRX5' :
					case 'SDRX6' :
					case 'SDRX7' :
					case 'SDRX8' :
					case 'PK10ZX2' :
					case 'PK10ZX3' :
					case 'PK10ZX4' :
					case 'PK10ZX5' :
					case 'PK10ZX6' :
					case 'SDZU2' : tempdes = lot_lang.dec_s26; break;
					default      : tempdes = lot_lang.dec_s4; break;
				}

				html += '<div class="grayTop"></div><div class="grayContent clearfix">';
				html += '<textarea id="lt_write_box" class="textareaLong floatL"></textarea>';
				html += '<div class="floatL">';
				html += '<p class="marginb5px"><input id="lt_write_del" type="button" value="删除重复号" class="formWord" /></p><p class="marginb5px"><input id="lt_write_import" type="button" value="导入文件" class="formWord" /></p><p class="marginb5px"><input id="lt_write_empty" type="button" value="清空" class="formWord" /></p>';
				html += '</div>';
				html += '</div>';
				html += '<div class="yellow">'+tempdes+'</div><div class="grayBottom"></div>';
				data_sel[0] = []; //初始数据
				tempdes = null;
			}else if( otype == 'digital' ){//数字选号型
				$.each(opts.layout, function(i,n){
					if(typeof(n)=='object'){
						n.place  = parseInt(n.place,10);
						max_place = n.place > max_place ? n.place : max_place;
						data_sel[n.place] = [];//初始数据
						minchosen[n.place] = (typeof(n.minchosen) == 'undefined') ? 0 : n.minchosen;

							switch(methodname){
								case 'BJRX1':
								case 'BJRX2':
								case 'BJRX3':
								case 'BJRX4':
								case 'BJRX5':
								case 'BJRX6':
								case 'BJRX7':
									html += '<div class="each_k8">';
								break;
								case 'PK10JS'://pk10竞速
									if(n.className !== ""){
										html += '<div class="each ' + n.className + '">';
									}else{
										html += '<div class="each">';
									}

								break;
								default:
									html += '<div class="each">';
								break;
							}
							if( n.cols > 0 ){//有标题
								if( n.title.length > 0 ){
									var tmptitle = n.title;
									html += '<h3>'+tmptitle+'</h3>';
								}else{
									html += '<h3 class="noname"></h3>';
								}
							}else{
								html += '';
							}
							html += '<ul class="nList">';
							numbers = n.no.split("|");
							//$.isNumeric(parseInt(numbers[0]));
							if(methodname !== 'PK10JS'){
								for( i=0; i<numbers.length; i++ ){
									html += '<li name="lt_place_'+n.place+'">'+numbers[i]+'</li>';
								}
							}else{
								if($.isNumeric(parseInt(numbers[0]))){
									for( i=0; i<numbers.length; i++ ){
										html += '<li name="lt_place_'+n.place+'" class="car_' + numbers[i] + '">'+numbers[i]+'</li>';
									}
								}else if($.isNumeric(parseInt(numbers[0])) === false && numbers[0] !== "-"){
									for( i=0; i<numbers.length; i++ ){
										html += '<li name="lt_place_'+n.place+'">'+numbers[i]+'</li>';
									}
								}else{
									for( i=0; i<numbers.length; i++ ){
										html += '<li>'+numbers[i]+'</li>';
									}
								}
							}

							html += '</ul>';

							if(lotterytype==3){//北京快乐8
								html += '';
							}else{
								if( opts.isButton == true ){
									html += '<ul class="cList">';
										html += '<li name="all">'+lot_lang.bt_sel_all+'</li>' +
												'<li name="big">'+lot_lang.bt_sel_big+'</li>' +
												'<li name="small">'+lot_lang.bt_sel_small+'</li>' +
												'<li name="odd">'+lot_lang.bt_sel_odd+'</li>' +
												'<li name="even">'+lot_lang.bt_sel_even+'</li>' +
												'<li name="clean">'+lot_lang.bt_sel_clean+'</li>';
									html += '</ul>';
								}
							}
							html += '</div>';
					}
				});
			}else if( otype == 'dxds' ){//大小单双类型(北京快乐吧)
				$.each(opts.layout, function(i,n){
					if(n){
						n.place  = parseInt(n.place,10);
						max_place = n.place > max_place ? n.place : max_place;
						data_sel[n.place] = [];//初始数据
						html += '<div class="each">';
						if( n.cols > 0 ){//有标题
							if( n.title.length > 0 ){
								var tmptitle = n.title;
								html += '<h3>'+tmptitle+'</h3>';
							}else{
								html += '<h3 class="noname"></h3>';
							}
						}else{
							html += '';
						}
						if(lotterytype==0||lotterytype==2){
							html += '<ul class="nList">';
						}else if(lotterytype==3){
							if(n.no.indexOf('codedesc')==-1){
								html += '<ul class="nList sp">';
							}else{
								html += '<ul class="nList sp sp2">';
							}
						}
						numbers = n.no.split("|");
						for( i=0; i<numbers.length; i++ ){
							html += '<li name="lt_place_'+n.place+'">'+numbers[i]+'</li>';
						}
						html += '</ul><ul class="cList">';
						html += '<li name="all">'+lot_lang.bt_sel_all+'</li>' +
								'<li class="selectType" name="clean">'+lot_lang.bt_sel_clean+'</li>' +
								'</ul>'
						html += '</div>';
					}
				});
			}else if( otype == 'dds' ){//<=-----[趣味型]
				$.each(opts.layout, function(i,n){
					n.place  = parseInt(n.place,10);
					max_place = n.place > max_place ? n.place : max_place;
					data_sel[n.place] = [];//初始数据
					html += '<div class="each">';
					if( n.cols > 0 ){//有标题
						if( n.title.length > 0 ){
							var tmptitle = n.title;
							html += '<h3>'+tmptitle+'</h3>';
						}else{
							html += '<h3 class="noname"></h3>';
						}
					}else{
						html += '';
					}
					//==========趣味型按钮输出===============
					html += '<ul class="nList quwei">';
					numbers = n.no.split("|");
					temphtml= '';
					if( n.prize ){
						tmpprize = n.prize.split(",");
					}
					for( i=0; i<numbers.length; i++ ){
						html += '<li name="lt_place_'+n.place+'">'+numbers[i]+'</li>';
					}
					html += '</ul></div>';//去掉了【<td></tr>】
				});
			}
		}

		if(methodname === 'PK10JS'){
			html += '</div>';
			html += '<div class="pk10_right">';
			html += '<a class="cAll">全清</a>';
			html += '</div>';
		}

		//代码结束
        $($.lt_id_data.id_selector).empty();
		$($.lt_id_data.id_selector).prepend(html);

		if(methodname === 'PK10JS'){
			$(".pk10_ball .nList").empty();
         $(".jssm_ball .nList").empty();
			$(".pk10_right .cAll").unbind().click(function(){
				data_sel[1] = [];
				data_sel[2] = [];
				$(".pk10_fast .nList").empty();
				$(".pk10_slow .nList").empty();
				$(".pk10_car .nList li").removeClass("disable");
				checkNum();
			});
		}

        var me = this;
        if($.lt_lottid == 15)
        {
				var _SortNum = function(a,b){//数字大小排序
                if( otype != 'input' ){
                    a = a.replace(/5单0双/g,0).replace(/4单1双/g,1).replace(/3单2双/g,2).replace(/2单3双/g,3).replace(/1单4双/g,4).replace(/0单5双/g,5);
                    if (methodname != "KSHZ" && methodname != "SBTHHZ") {
                        a = a.replace(/11/gi, 1).replace(/22/gi, 2).replace(/33/gi, 3).replace(/44/gi, 4).replace(/55/gi, 5).replace(/66/gi, 6)
                    }
                    a = a.replace(/大/g,0).replace(/小/g,1).replace(/单/g,2).replace(/双/g,3).replace(/\s/g,"");
                    b = b.replace(/5单0双/g,0).replace(/4单1双/g,1).replace(/3单2双/g,2).replace(/2单3双/g,3).replace(/1单4双/g,4).replace(/0单5双/g,5);
                    b = b.replace(/111/gi, 1).replace(/222/gi, 2).replace(/333/gi, 3).replace(/444/gi, 4).replace(/555/gi, 5).replace(/666/gi, 6);
                    if (methodname != "KSHZ" && methodname != "SBTHHZ") {
                        b = b.replace(/11/gi, 1).replace(/22/gi, 2).replace(/33/gi, 3).replace(/44/gi, 4).replace(/55/gi, 5).replace(/66/gi, 6)
                    }
                    b = b.replace(/大/g,0).replace(/小/g,1).replace(/单/g,2).replace(/双/g,3).replace(/\s/g,"");
                }
                a = parseInt(a,10);
                b = parseInt(b,10);
                if( isNaN(a) || isNaN(b) ){
                    return true;
                }
                return (a-b);
            };
        } else {
			var _SortNum = function(a,b){//数字大小排序
			if( otype != 'input' ){
					a = a.replace(/5单0双/g,0).replace(/4单1双/g,1).replace(/3单2双/g,2).replace(/2单3双/g,3).replace(/1单4双/g,4).replace(/0单5双/g,5);
					a = a.replace(/大/g,0).replace(/小/g,1).replace(/单/g,2).replace(/双/g,3).replace(/\s/g,"");
					b = b.replace(/5单0双/g,0).replace(/4单1双/g,1).replace(/3单2双/g,2).replace(/2单3双/g,3).replace(/1单4双/g,4).replace(/0单5双/g,5);
					b = b.replace(/大/g,0).replace(/小/g,1).replace(/单/g,2).replace(/双/g,3).replace(/\s/g,"");
				}
				a = parseInt(a,10);
				b = parseInt(b,10);
				if( isNaN(a) || isNaN(b) ){
					return true;
				}
				return (a-b);
			};
		}

        /************************ 验证号码合法性以及计算单笔投注注数以及金额 ***********************/
        //===================输入型检测
        var _HHZXcheck = function(n,len){//混合组选合法号码检测，合法返回TRUE，非法返回FALSE,n号码，len号码长度
            if( len == 2 ){//两位
                var a = ['00','11','22','33','44','55','66','77','88','99'];
            }else{//三位[默认]
                var a = ['000','111','222','333','444','555','666','777','888','999'];
            }
            n     = n.toString();
            if( $.inArray(n,a) == -1 ){//不在非法列表中
                return true;
            }
            return false;
        };
        var _SDinputCheck = function(n,len){//山东十一运的手动输入型的检测[不能重复，只能是01-11的数字]
            t = n.split(" ");
            l = t.length;
            for( i=0; i<l; i++ ){
                if( Number(t[i]) > 11 || Number(t[i]) < 1 ){//超过指定范围
                    return false;
                }
                for( j=i+1; j<l; j++ ){
                    if( Number(t[i]) == Number(t[j]) ){//重复的号码
                        return false;
                    }
                }
            }
            return true;
        };

		 var _EBTHDScheck = function(n, len) {
            if (len != 2) {
                return false
            }
            var first = "";
            var second = "";
            var i = 0;
            for (i = 0; i < len; i++) {
                if (i == 0) {
                    first = n.substr(i, 1)
                }
                if (i == 1) {
                    second = n.substr(i, 1)
                }
            }
            if (first == second) {
                return false
            }
            return true
        };

		 var _SBTHDScheck = function(n, len) {
            if (len != 3) {
                return false
            }
            var first = "";
            var second = "";
            var third = "";
            var i = 0;
            for (i = 0; i < len; i++) {
                if (i == 0) {
                    first = n.substr(i, 1)
                }
                if (i == 1) {
                    second = n.substr(i, 1)
                }
                if (i == 2) {
                    third = n.substr(i, 1)
                }
            }
            if (first == second || second == third || third == first) {
                return false
            } else {
                return true
            }
            return false
        };


        var _ETHDXcheck = function(n, len) {
            if (len != 3) {
                return false
            }
            var first = "";
            var second = "";
            var third = "";
            var i = 0;
            for (i = 0; i < len; i++) {
                if (i == 0) {
                    first = n.substr(i, 1)
                }
                if (i == 1) {
                    second = n.substr(i, 1)
                }
                if (i == 2) {
                    third = n.substr(i, 1)
                }
            }

            if (first == second && second == third) {
                return false
            }
            if (first == second || second == third || third == first) {
                return true
            }
            return false
        };



        //号码检测,l:号码长度,e是否返回非法号码，true是,false返回合法注数,fun对每个号码的附加检测,sort:是否对每个号码排序
        var _inputCheck_Num = function(l,e,fun,sort){
            var nums = data_sel[0].length;
            var error= [];
            var newsel=[];
            var partn= "";
            l = parseInt(l,10);
			if($.lt_lottid == 15){
                switch(l){
                    case 2 : partn= /^[1-6]{2}$/;break;
                    case 3 : partn = /^[1-6]{3}$/;break;
                    default: partn= /^[1-6]{3}$/;break;
                }
            }else{
				switch(l){
					case 2 : partn= /^[0-9]{2}$/;break;
					case 4 : partn= /^[0-9\s]{4}$/;break;
					case 5 : partn= /^[0-9\s]{5}$/;break;
					case 8 : partn= /^[0-9\s]{8}$/;break;
					case 11 : partn= /^[0-9\s]{11}$/;break;
					case 14 : partn= /^[0-9\s]{14}$/;break;
					case 17 : partn= /^[0-9\s]{17}$/;break;
					case 20 : partn= /^[0-9\s]{20}$/;break;
					case 23 : partn= /^[0-9\s]{23}$/;break;
					default: partn= /^[0-9]{3}$/;break;
				}
            }
            fun = $.isFunction(fun) ? fun : function(s){return true;};
            $.each(data_sel[0],function(i,n){
                n = $.trim(n);
                if( partn.test(n) && fun(n,l) ){//合格号码
                    if( sort ){
                        if( n.indexOf(" ") == -1 ){
                            n = n.split("");
                            n.sort(_SortNum);
                            n = n.join("");
                        }else{
                            n = n.split(" ");
                            n.sort(_SortNum);
                            n = n.join(" ");
                        }
                    }
                    data_sel[0][i] = n;
                    newsel.push(n);
                }else{//不合格则注数减
                    if( n.length>0 ){
                        error.push(n);
                    }
                    nums = nums - 1;
                }
            });
            if( e == true ){
                data_sel[0] = newsel;
                return error;
            }
            return nums;
        };
		//记录万千百十个的选择
		function recordPoschoose(){
			var str = "";
			$("input[name='pos[]']:checked").each(function () {
				if ($(this).attr("checked")) {
					str += $(this).val() + ",";
				}
			})
			$("input[name='poschoose']").val(str.slice(0, -1));
		}
        function checkNum(){//实时计算投注注数与金额等
            var nums  = 0, mname = $.lt_method[$.lt_method_data.methodid];//玩法的简写,如:'ZX3'
            //var modes = parseInt($("#lt_project_modes").val(),10);//投注模式
			var modes = parseInt($("input[name='lt_project_modes']:checked").val(),10);//投注模式
			// alert(modes+'----'+mname);1----RXZUSANFFC3
            //01:验证号码合法性并计算注数
            if( otype == 'input' ){//输入框形式的检测
                if( data_sel[0].length > 0 ){//如果输入的有值
                    switch(mname){
                        case 'ZX3'  : nums = _inputCheck_Num(3,false); break;
                        case 'ZX4'  : nums = _inputCheck_Num(4,false); break;
                        case 'ZX5'  : nums = _inputCheck_Num(5,false); break;
						//任选三混合组选
                        case 'RXZUWFC3HH' :
                        case 'RXZUFFC3HH' :
						case 'RXZUSSC3HH' :
                        case 'HHZX' :
                            nums = _inputCheck_Num(3,false,_HHZXcheck,true);
                            if( mname == 'RXZUSSC3HH'||mname == 'RXZUWFC3HH'||mname == 'RXZUFFC3HH'){
                                    nums *= $.lt_position_sel.length == 0 ? 0 : Combination($.lt_position_sel.length, 3);
                                    recordPoschoose();
                            }
                            break;
                        case 'ZX2'  : nums = _inputCheck_Num(2,false); break;
                        case 'ZU2'  : nums = _inputCheck_Num(2,false,_HHZXcheck,true); break;
                        case 'SDZX3': nums = _inputCheck_Num(8,false,_SDinputCheck,false); break;
                        case 'SDZU3': nums = _inputCheck_Num(8,false,_SDinputCheck,true); break;
                        case 'SDZX2': nums = _inputCheck_Num(5,false,_SDinputCheck,false); break;
                        case 'SDZU2': nums = _inputCheck_Num(5,false,_SDinputCheck,true); break;
                        case 'SDRX1': nums = _inputCheck_Num(2,false,_SDinputCheck,false); break;
                        case 'SDRX2': nums = _inputCheck_Num(5,false,_SDinputCheck,true); break;
                        case 'SDRX3': nums = _inputCheck_Num(8,false,_SDinputCheck,true); break;
                        case 'SDRX4': nums = _inputCheck_Num(11,false,_SDinputCheck,true); break;
                        case 'SDRX5': nums = _inputCheck_Num(14,false,_SDinputCheck,true); break;
                        case 'SDRX6': nums = _inputCheck_Num(17,false,_SDinputCheck,true); break;
                        case 'SDRX7': nums = _inputCheck_Num(20,false,_SDinputCheck,true); break;
                        case 'SDRX8': nums = _inputCheck_Num(23,false,_SDinputCheck,true); break;
                        case 'ETHDX': nums = _inputCheck_Num(3,false,_ETHDXcheck,true); break;
                        case"SBTH":nums = _inputCheck_Num(3, false, _SBTHDScheck, true);break;
                        case"EBTH":nums = _inputCheck_Num(2, false, _EBTHDScheck, true);break;
						//任选二-直选单式
						case "RXZXSSC2DS":
                        case "RXZXWFC2DS":
                        case "RXZXFFC2DS":
							nums = _inputCheck_Num(2, false);
							nums *= $.lt_position_sel.length == 0 ? 0 : Combination($.lt_position_sel.length, 2);
							recordPoschoose();
							break;
						//任选二-组选单式
                        case "RXZUSSC2DS":
                        case "RXZUWFC2DS":
                        case "RXZUFFC2DS":
							nums = _inputCheck_Num(2, false, _HHZXcheck, true);


							nums *= $.lt_position_sel.length == 0 ? 0 : Combination($.lt_position_sel.length, 2);
							recordPoschoose();
                            break;
						//任选三 直选 直选单式
                        case "RXZXSSC3DS":
                        case "RXZXFFC3DS":
                        case "RXZXWFC3DS":
                            nums = _inputCheck_Num(3, false);
                            nums *= $.lt_position_sel.length == 0 ? 0 : Combination($.lt_position_sel.length, 3);
							recordPoschoose();
                        	break;
						//任选四 任四直选 直选单式
                        case "RXZXSSC4DS":
                        case "RXZXWFC4DS":
                        case "RXZXFFC4DS":
                            nums = _inputCheck_Num(4, false);
                            nums *= $.lt_position_sel.length == 0 ? 0 : Combination($.lt_position_sel.length, 4);
							recordPoschoose();
                            break;
                    	//pk10单式
                    	case "PK10ZX2":
                        case "PK10ZX3":
                        case "PK10ZX4":
                        case "PK10ZX5":
                        case "PK10ZX6":
                        	var baseLen = parseInt(methodname.substr(6,1));
                        	data_sel[0][0]=$.trim(data_sel[0][0]);
                        	data_sel[0][data_sel[0].length-1]=$.trim(data_sel[0][data_sel[0].length-1]);
                        	nums = play.calculateInputNumbersLength(play.checkInputNumbersArray(data_sel[0],baseLen).length);
                        break;
                        default   : break;
                    }
                }
            }else{//其他选择号码形式[暂时就数字型和大小单双]
                var tmp_nums = 1;
                switch(mname){//根据玩法分类不同做不同处理
					case"SBTH":
                        if (data_sel[0].length >= 3) {
                            nums += Combination(data_sel[0].length, 3)
                        }
                        break;
                    case"SBTHDT":
                        var danlen = data_sel[0].length;
                        var tuolen = data_sel[1].length;
                        if (danlen < 1 || tuolen < 1 || danlen >= 3) {
                            nums = 0
                        } else {
                            nums = Combination(tuolen, 3 - danlen)
                        }
                        break;
                    case"SBTHHZ":
                        var cc = {6: 1, 7: 1, 8: 2, 9: 3, 10: 3, 11: 3, 12: 3, 13: 2, 14: 1, 15: 1};
                        var s = data_sel[0].length;
                        if (s > 0) {
                            for (j = 0; j < s; j++) {
                                nums += cc[parseInt(data_sel[0][j], 10)]
                            }
                        }
                        break;
                    case"EBTH":
                        if (data_sel[0].length >= 2) {
                            nums += Combination(data_sel[0].length, 2)
                        }
                        break;
                    case"WXZU120":
                                var s=data_sel[0].length;if(s>4){
                                    nums+=Combination(s,5)
                                }break;
                    case"WXZU60":
                    case"WXZU30":
                    case"WXZU20":
                    case"WXZU10":
                    case"WXZU5":
                                if(data_sel[0].length>=minchosen[0]&&data_sel[1].length>=minchosen[1]){
                                    var h=Array.intersect(data_sel[0],data_sel[1]).length;
                                    tmp_nums=Combination(data_sel[0].length,minchosen[0])*Combination(data_sel[1].length,minchosen[1]);
                                    if(h>0){
                                        if(mname=="WXZU60"){
                                            tmp_nums-=Combination(h,1)*Combination(data_sel[1].length-1,2)
                                        }else{
                                            if(mname=="WXZU30"){
                                                tmp_nums-=Combination(h,2)*Combination(2,1);
                                                if(data_sel[0].length-h>0){
                                                    tmp_nums-=Combination(h,1)*Combination(data_sel[0].length-h,1)
                                                }}else{
                                                if(mname=="WXZU20"){
                                                    tmp_nums-=Combination(h,1)*Combination(data_sel[1].length-1,1)
                                                }else{
                                                    if(mname=="WXZU10"||mname=="WXZU5"){
                                                        tmp_nums-=Combination(h,1)
                                                    }
                                                }
                                            }}}
                                        nums+=tmp_nums
                                    }
                                    break;
                    case 'ZXHZ' :   //直选和值特殊算法
                    case 'RXZXWFC3HZ' :
                    case 'RXZXFFC3HZ' :
					case 'RXZXSSC3HZ' :	//任选三直选和值
                                    var cc = {0:1,1:3,2:6,3:10,4:15,5:21,6:28,7:36,8:45,9:55,10:63,11:69,12:73,13:75,14:75,15:73,16:69,17:63,18:55,19:45,20:36,21:28,22:21,23:15,24:10,25:6,26:3,27:1};
                    case 'ZUHZ' :   //混合组选特殊算法
                    case 'RXZUWFC3HZ' :
                    case 'RXZUFFC3HZ' :
					case 'RXZUSSC3HZ' :
                        if( mname == 'ZUHZ' || mname == 'RXZUSSC3HZ'|| mname == 'RXZUWFC3HZ' || mname == 'RXZUFFC3HZ'){//任选三组选和值
                            cc = {1:1,2:2,3:2,4:4,5:5,6:6,7:8,8:10,9:11,10:13,11:14,12:14,13:15,14:15,15:14,16:14,17:13,18:11,19:10,20:8,21:6,22:5,23:4,24:2,25:2,26:1};
                        }
                        for( i=0; i<=max_place; i++ ){
                            var s = data_sel[i].length;
                            for( j=0; j<s; j++ ){
                                nums += cc[parseInt(data_sel[i][j],10)];
                            }
                        };
                        if( mname == 'RXZXSSC3HZ' || mname == 'RXZUSSC3HZ'||mname == 'RXZXWFC3HZ' || mname == 'RXZUWFC3HZ'||mname == 'RXZXFFC3HZ' || mname == 'RXZUFFC3HZ' ){//任选三直选和值,任选三组选和值
                            nums *= $.lt_position_sel.length == 0 ? 0 : Combination($.lt_position_sel.length, 3);
                            recordPoschoose();
                        }
                        break;
                    case 'ZUS'  :   //组三
                    case 'RXZUSANWFC3'  :
                    case 'RXZUSANFFC3'  :
					case 'RXZUSANSSC3'  :
                                    for( i=0; i<=max_place; i++ ){
                                        var s = data_sel[i].length;
                                        if( s > 1 ){//组三必须选两位或者以上
                                            nums += s*(s-1);
                                        }

                                    };
									if (mname == 'RXZUSANSSC3'||mname == 'RXZUSANWFC3'||mname == 'RXZUSANFFC3') {
										nums *= $.lt_position_sel.length == 0 ? 0 : Combination($.lt_position_sel.length, 3);
										recordPoschoose();
									}
									break;
                    case 'ZUL'  :   //组六
                    case 'RXZUSIXWFC3'  :
                    case 'RXZUSIXFFC3'  :
					case 'RXZUSIXSSC3'  :
                        for( i=0; i<=max_place; i++ ){
                            var s = data_sel[i].length;
                            if( s > 2 ){//组六必须选三位或者以上
                                nums += s*(s-1)*(s-2)/6;
                            }

                        };
						if (mname == 'RXZUSIXSSC3' || mname == 'RXZUSIXWFC3' || mname == 'RXZUSIXFFC3') {
							nums *= $.lt_position_sel.length == 0 ? 0 : Combination($.lt_position_sel.length, 3);
							recordPoschoose();
						}
						break;
                    case 'ZH5':
                    case 'ZH4'  :   //组合4
                    case 'ZH3'  :
                        for( i=0; i<=max_place; i++ )
                        {
                            if( data_sel[i].length == 0 )
                            {//有位置上没有选择
                                tmp_nums = 0;
                                break;
                            }
                            tmp_nums *= data_sel[i].length;
                        }
                        nums = tmp_nums*parseInt(mname.charAt(mname.length-1));
                        break;
                    case "SXZU24":
                        var s=data_sel[0].length;if(s>3){nums+=Combination(s,4)}
                        break;
                    case 'SXZU6':
                        if( data_sel[0].length >= minchosen[0] )
                        {
                            //C(n,2)
                            nums += Combination(data_sel[0].length, minchosen[0]);
                        }
                        break;
                    case"SXZU12":
                    case"SXZU4":
                        if(data_sel[0].length>=minchosen[0]&&data_sel[1].length>=minchosen[1]){
                            var h=Array.intersect(data_sel[0],data_sel[1]).length;
                            tmp_nums=Combination(data_sel[0].length,minchosen[0])*Combination(data_sel[1].length,minchosen[1]);
                            if(h>0){
                                if(mname=="SXZU12"){
                                        tmp_nums-=Combination(h,1)*Combination(data_sel[1].length-1,1)
                                    }
                                    else{
                                        if(mname=="SXZU4"){
                                                tmp_nums-=Combination(h,1)
                                        }
                                        }
                            }
                            nums+=tmp_nums
                        }
                        break;
                    case 'BDW2'  :  //二码不定位
                    case 'ZU2'   :  //2位组选
                                    for( i=0; i<=max_place; i++ ){
                                        var s = data_sel[i].length;
                                        if( s > 1 ){//二码不定位必须选两位或者以上
                                            nums += s*(s-1)/2;
                                        }
                                    };break;

                    case 'ZXHZ2':	//直选和值2

                        cc = {
                            0:1,
                            1:2,
                            2:3,
                            3:4,
                            4:5,
                            5:6,
                            6:7,
                            7:8,
                            8:9,
                            9:10,
                            10:9,
                            11:8,
                            12:7,
                            13:6,
                            14:5,
                            15:4,
                            16:3,
                            17:2,
                            18:1
                        };
                        for( i=0; i<=max_place; i++ ){
                            var s = data_sel[i].length;
                            for( j=0; j<s; j++ ){
                                nums += cc[parseInt(data_sel[i][j],10)];
                            }
                        };

                        break;
                    case 'PK10HZ2':	//PK10两位和值
                    case 'PK10HZ3':	//PK10 三位和值
                        for( i=0; i<=max_place; i++ ){
                             nums += data_sel[i].length;
                        };

                        break;
                    case 'ZUHZ2':	//组选和值2
                        cc = {
                            0:0,
                            1:1,
                            2:1,
                            3:2,
                            4:2,
                            5:3,
                            6:3,
                            7:4,
                            8:4,
                            9:5,
                            10:4,
                            11:4,
                            12:3,
                            13:3,
                            14:2,
                            15:2,
                            16:1,
                            17:1,
                            18:0
                        };
                        for( i=0; i<=max_place; i++ ){
                            var s = data_sel[i].length;
                            for( j=0; j<s; j++ ){
                                nums += cc[parseInt(data_sel[i][j],10)];
                            }
                        };
                        break;
                    case 'DWD'  :   //定位胆所有在一起特殊处理
                                    for( i=0; i<=max_place; i++ ){
                                        nums += data_sel[i].length;
                                    };break;
                    case 'SDZX3': //山东11运前三直选
                                    nums = 0;
                                    if( data_sel[0].length > 0 && data_sel[1].length > 0 && data_sel[2].length > 0 ){
                                        for( i=0; i<data_sel[0].length; i++ ){
                                            for( j=0; j<data_sel[1].length; j++ ){
                                                for( k=0; k<data_sel[2].length; k++ ){
                                                    if( data_sel[0][i] != data_sel[1][j] && data_sel[0][i] != data_sel[2][k] && data_sel[1][j] != data_sel[2][k] ){
                                                        nums++;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    break;
                    case 'SDZU3': //山东11运前三组选
                                    for( i=0; i<=max_place; i++ ){
                                        var s = data_sel[i].length;
                                        if( s > 2 ){//组六必须选三位或者以上
                                            nums += s*(s-1)*(s-2)/6;
                                        }
                                    };break;
                    case 'SDZX2': //山动十一运前二直选
                                  nums = 0;
                                    if( data_sel[0].length > 0 && data_sel[1].length > 0 ){
                                        for( i=0; i<data_sel[0].length; i++ ){
                                            for( j=0; j<data_sel[1].length; j++ ){
                                                if( data_sel[0][i] != data_sel[1][j]){
                                                    nums++;
                                                }
                                            }
                                        }
                                    }
                                    break;
                    case 'SDZU2': //山东十一运前二组选
                                    for( i=0; i<=max_place; i++ ){
                                        var s = data_sel[i].length;
                                        if( s > 1 ){//组六必须选三位或者以上
                                            nums += s*(s-1)/2;
                                        }
                                    };break;
                    case 'SDBDW':
                    case 'SDDWD':
                    case 'SDDDS':
                    case 'SDCZW':
                    case 'SDRX1': //任选1中1
                                    for( i=0; i<=max_place; i++ ){
                                        nums += data_sel[i].length;
                                    };break;
                    case 'SDRX2': //任选2中2
                                    for( i=0; i<=max_place; i++ ){
                                        var s = data_sel[i].length;
                                        if( s > 1 ){//二码不定位必须选两位或者以上
                                            nums += s*(s-1)/2;
                                        }
                                    };break;
                    case 'SDRX3': //任选3中3
                                    for( i=0; i<=max_place; i++ ){
                                        var s = data_sel[i].length;
                                        if( s > 2 ){//必须选三位或者以上
                                            nums += s*(s-1)*(s-2)/6;
                                        }
                                    };break;
                    case 'SDRX4': //任选4中4
                                    for( i=0; i<=max_place; i++ ){
                                        var s = data_sel[i].length;
                                        if( s > 3 ){//必须选四位或者以上
                                            nums += s*(s-1)*(s-2)*(s-3)/24;
                                        }
                                    };break;
                    case 'SDRX5': //任选5中5
                                    for( i=0; i<=max_place; i++ ){
                                        var s = data_sel[i].length;
                                        if( s > 4 ){//必须选四位或者以上
                                            nums += s*(s-1)*(s-2)*(s-3)*(s-4)/120;
                                        }
                                    };break;
                    case 'SDRX6': //任选6中6
                                    for( i=0; i<=max_place; i++ ){
                                        var s = data_sel[i].length;
                                        if( s > 5 ){//必须选四位或者以上
                                            nums += s*(s-1)*(s-2)*(s-3)*(s-4)*(s-5)/720;
                                        }
                                    };break;
                    case 'SDRX7': //任选7中7
                                    for( i=0; i<=max_place; i++ ){
                                        var s = data_sel[i].length;
                                        if( s > 6 ){//必须选四位或者以上
                                            nums += s*(s-1)*(s-2)*(s-3)*(s-4)*(s-5)*(s-6)/5040;
                                        }
                                    };break;
                    case 'SDRX8': //任选8中8
                                    for( i=0; i<=max_place; i++ ){
                                        var s = data_sel[i].length;
                                        if( s > 7 ){//必须选四位或者以上
                                            nums += s*(s-1)*(s-2)*(s-3)*(s-4)*(s-5)*(s-6)*(s-7)/40320;
                                        }
                                    };break;
//下面是北京快乐吧
                    case 'BJRX2': //北京快乐8 任选2
                                    for( i=0; i<=max_place; i++ ){
                                        var s = data_sel[i].length;
                                        if( s > 1 ){//必须选 两位到八位
                                            nums += s*(s-1)/2;
                                        }
                                    };break;
                    case 'BJRX3': //北京快乐8 任选3
                                    for( i=0; i<=max_place; i++ ){
                                        var s = data_sel[i].length;
                                        if( s > 2 ){//必须选 三位到八位
                                            nums += s*(s-1)*(s-2)/6;
                                        }
                                    };break;
                    case 'BJRX4': //北京快乐8 任选4
                                    for( i=0; i<=max_place; i++ ){
                                        var s = data_sel[i].length;
                                        if( s > 3 ){//必须选 四位到八位
                                            nums += s*(s-1)*(s-2)*(s-3)/24;
                                        }
                                    };break;
                    case 'BJRX5': //北京快乐8 任选5
                                    for( i=0; i<=max_place; i++ ){
                                        var s = data_sel[i].length;
                                        if( s > 4 ){//必须选 五位到八位
                                            nums += s*(s-1)*(s-2)*(s-3)*(s-4)/120;
                                        }
                                    };break;
                    case 'BJRX6': //北京快乐8 任选6
                                    for( i=0; i<=max_place; i++ ){
                                        var s = data_sel[i].length;
                                        if( s > 5 ){//必须选 六位到八位
                                            nums += s*(s-1)*(s-2)*(s-3)*(s-4)*(s-5)/720;
                                        }
                                    };break;
                    case 'BJRX7': //北京快乐8 任选7
                                    for( i=0; i<=max_place; i++ ){
                                        var s = data_sel[i].length;
                                        if( s > 6 ){//必须选 七位到八位
                                            nums += s*(s-1)*(s-2)*(s-3)*(s-4)*(s-5)*(s-6)/5040;
                                        }
                                    };break;
                    case "RXZXWFC2":
                    case "RXZXFFC2":
                    case "RXZXSSC2": //任选二直选
                        var wan = data_sel[0].length;
                        var qian = data_sel[1].length;
                        var bai = data_sel[2].length;
                        var shi = data_sel[3].length;
                        var ge = data_sel[4].length;
                        //万*千 + 万*百 + 万*十 + 万*个 + 千*百 + 千*十 + 千*个 + 百*十 + 百*个 + 十*个
                        nums += wan * qian + wan * bai + wan * shi + wan * ge + qian * bai + qian * shi + qian * ge + bai * shi + bai * ge + shi * ge;
                        break;
                    case "RXZUWFC2":
                    case "RXZUFFC2":
                    case "RXZUSSC2": //任选二组选
                        for (i = 0; i <= max_place; i++) {
                            var s = data_sel[i].length;
                            if (s > 1) {
                                nums += s * (s - 1) / 2;
                            }
                        };
                        var select_num = $("input[name='pos[]']:checked").length;
                        var multi = 0;
                        switch (select_num) {
                            case 0:multi = 0;break;
                            case 1:multi = 0;break;
                            case 2:multi = 1;break;
                            case 3:multi = 3;break;
                            case 4:multi = 6;break;
                            case 5:multi = 10;break;
                        }
                        nums = nums * multi;
                        recordPoschoose();
                        break;
                    //任选二-直选和值
                    case "RXZXWFC2HZ":
                    case "RXZXFFC2HZ":
                    case "RXZXSSC2HZ":
                        cc = {0: 1,1: 2,2: 3,3: 4,4: 5,5: 6,6: 7,7: 8,8: 9,9: 10,10: 9,11: 8,12: 7,13: 6,14: 5,15: 4,16: 3,17: 2,18: 1};
                        for (i = 0; i <= max_place; i++) {
                            var s = data_sel[i].length;
                            for (j = 0; j < s; j++) {
                                nums += cc[parseInt(data_sel[i][j], 10)];
                            }
                        }
                        nums *= $.lt_position_sel.length == 0 ? 0 : Combination($.lt_position_sel.length, 2);
                        recordPoschoose();
                        break;
                    //任选二-组选和值
                    case "RXZUWFC2HZ":
                    case "RXZUFFC2HZ":
                    case "RXZUSSC2HZ":
                        cc = {0: 0,1: 1,2: 1,3: 2,4: 2,5: 3,6: 3,7: 4,8: 4,9: 5,10: 4,11: 4,12: 3,13: 3,14: 2,15: 2,16: 1,17: 1,18: 0};
                        for (i = 0; i <= max_place; i++) {
                            var s = data_sel[i].length;
                            for (j = 0; j < s; j++) {
                                nums += cc[parseInt(data_sel[i][j], 10)];
                            }
                        }
                        nums *= $.lt_position_sel.length == 0 ? 0 : Combination($.lt_position_sel.length, 2);
                        recordPoschoose();
                        break;
                    //任选三-直选复式
                    case "RXZXWFC3":
                    case "RXZXFFC3":
                    case "RXZXSSC3":
                        var aCodePosition = [];
                        for (i = 0; i <= max_place; i++) {
                            var codelen = data_sel[i].length;
                            if (codelen > 0) {
                                aCodePosition.push(i);
                            }
                        }
                        var aPositionCombo = getCombination(aCodePosition, 3);
                        var iComboLen = aPositionCombo.length;
                        var aCombo = [];
                        var iLen = 0;
                        var tmpNums = 1;
                        for (j = 0; j < iComboLen; j++) {
                            aCombo = aPositionCombo[j].split(",");
                            iLen = aCombo.length;
                            tmpNums = 1;
                            for (h = 0; h < iLen; h++) {
                                tmpNums *= data_sel[aCombo[h]].length;
                            }
                            nums += tmpNums;
                        }
                        break;
                    //任选四-直选复式
                    case "RXZXWFC4":
                    case "RXZXFFC4":
                    case "RXZXSSC4":
                        var aCodePosition = [];
                        for (i = 0; i <= max_place; i++) {
                            var codelen = data_sel[i].length;
                            if (codelen > 0) {
                                aCodePosition.push(i);
                            }
                        }
                        var aPositionCombo = getCombination(aCodePosition, 4);
                        var iComboLen = aPositionCombo.length;
                        var aCombo = [];
                        var iLen = 0;
                        var tmpNums = 1;
                        for (j = 0; j < iComboLen; j++) {
                            aCombo = aPositionCombo[j].split(",");
                            iLen = aCombo.length;
                            tmpNums = 1;
                            for (h = 0; h < iLen; h++) {
                                tmpNums *= data_sel[aCombo[h]].length;
                            }
                            nums += tmpNums;
                        }
                        break;
                    //任选四-组选-组选24
                    case "RXZU24SSC4":
                    case "RXZU24WFC4":
                    case "RXZU24FFC4":
                        var s = data_sel[0].length;
                        if (s > 3) {
                            nums += Combination(s, 4);
                        }
                        nums *= $.lt_position_sel.length == 0 ? 0 : Combination($.lt_position_sel.length, 4);
                        recordPoschoose();
                        break;
                    //任选四-组选-组选12
                    case "RXZU12WFC4" :
                    case "RXZU4WFC4"  :
                    case "RXZU12FFC4" :
                    case "RXZU4FFC4"  :
                    case "RXZU12SSC4" :
                    case "RXZU4SSC4"  :
                        if (data_sel[0].length >= minchosen[0] && data_sel[1].length >= minchosen[1]) {
                            var h = Array.intersect(data_sel[0], data_sel[1]).length;
                            tmp_nums = Combination(data_sel[0].length, minchosen[0]) * Combination(data_sel[1].length, minchosen[1]);
                            if (h > 0) {
                                if (mname == "RXZU12SSC4" || mname == "RXZU12WFC4" || mname == "RXZU12FFC4") {
                                    tmp_nums -= Combination(h, 1) * Combination(data_sel[1].length - 1, 1);
                                } else {
                                    if (mname == "RXZU4SSC4" || mname == "RXZU4WFC4" || mname == "RXZU4FFC4") {
                                        tmp_nums -= Combination(h, 1);
                                    }
                                }
                            }
                            nums += tmp_nums;
                        }
                        nums *= $.lt_position_sel.length == 0 ? 0 : Combination($.lt_position_sel.length, 4);
                        recordPoschoose();
                        break;
                    //任选四-组选-组选6
                    case "RXZU6WFC4":
                    case "RXZU6FFC4":
                    case "RXZU6SSC4":
                        if (data_sel[0].length >= minchosen[0]) {
                            nums += Combination(data_sel[0].length, minchosen[0]);
                        }
                        nums *= $.lt_position_sel.length == 0 ? 0 : Combination($.lt_position_sel.length, 4);
						recordPoschoose();
                        break;
                  	//pk10
                    case "PK10ZX2":
                    	nums = 0;
                        if( data_sel[0].length > 0 && data_sel[1].length > 0 ){
                            for( i=0; i<data_sel[0].length; i++ ){
                                for( j=0; j<data_sel[1].length; j++ ){
                                    if( data_sel[0][i] != data_sel[1][j]){
                                        nums++;
                                    }
                                }
                            }
                        }
                    break;
                    case "PK10ZX3":
                    	nums = 0;
                        if( data_sel[0].length > 0 && data_sel[1].length > 0 && data_sel[2].length > 0 ){
                            for( i=0; i<data_sel[0].length; i++ ){
                                for( j=0; j<data_sel[1].length; j++ ){
                                    for( k=0; k<data_sel[2].length; k++ ){
                                        if( data_sel[0][i] != data_sel[1][j] && data_sel[0][i] != data_sel[2][k] && data_sel[1][j] != data_sel[2][k] ){
                                            nums++;
                                        }
                                    }
                                }
                            }
                        }
                    break;
                    case "PK10ZX4":
                    	nums = 0;
                        if( data_sel[0].length > 0 && data_sel[1].length > 0 && data_sel[2].length > 0 && data_sel[3].length > 0){
                            for( i=0; i<data_sel[0].length; i++ ){
                                for( j=0; j<data_sel[1].length; j++ ){
                                    for( k=0; k<data_sel[2].length; k++ ){
                                    	for( l=0; l<data_sel[3].length; l++ ){
                                    		if( data_sel[0][i] != data_sel[1][j] && data_sel[0][i] != data_sel[2][k] && data_sel[1][j] != data_sel[2][k])
                                    		//增加第四位数字不等的判断
                                    		if( data_sel[3][l] != data_sel[0][i] && data_sel[3][l] != data_sel[1][j] && data_sel[3][l] != data_sel[2][k]){
	                                            nums++;
                                             }
	                                    }
                                    }
                                }
                            }
                        }
                    break;
                    case "PK10ZX5":
                    	nums = 0;
                        if( data_sel[0].length > 0 && data_sel[1].length > 0 && data_sel[2].length > 0 && data_sel[3].length > 0 && data_sel[4].length > 0){
                            for( i=0; i<data_sel[0].length; i++ ){
                                for( j=0; j<data_sel[1].length; j++ ){
                                    for( k=0; k<data_sel[2].length; k++ ){
                                    	for( l=0; l<data_sel[3].length; l++ ){
                                    		for( m=0; m<data_sel[4].length; m++ ){
                                        		if( data_sel[0][i] != data_sel[1][j] && data_sel[0][i] != data_sel[2][k] && data_sel[1][j] != data_sel[2][k])
                                            	//增加第四位数字不等的判断
                                            	if( data_sel[3][l] != data_sel[0][i] && data_sel[3][l] != data_sel[1][j] && data_sel[3][l] != data_sel[2][k])
                                            	//增加第五位数字不等的判断
                                            	if( data_sel[4][m] != data_sel[0][i] && data_sel[4][m] != data_sel[1][j] && data_sel[4][m] != data_sel[2][k] && data_sel[4][m] != data_sel[3][l]){
		                                            nums++;
		                                        }
                                    		}
	                                    }
                                    }
                                }
                            }
                        }
                    break;
                    case "PK10ZX6":
                    	nums = 0;
                        if( data_sel[0].length > 0 && data_sel[1].length > 0 && data_sel[2].length > 0 && data_sel[3].length > 0 && data_sel[4].length > 0){
                            for( i=0; i<data_sel[0].length; i++ ){
                                for( j=0; j<data_sel[1].length; j++ ){
                                    for( k=0; k<data_sel[2].length; k++ ){
                                    	for( l=0; l<data_sel[3].length; l++ ){
                                    		for( m=0; m<data_sel[4].length; m++ ){
                                    			for( n=0; n<data_sel[5].length; n++ ){
	                                        		if( data_sel[0][i] != data_sel[1][j] && data_sel[0][i] != data_sel[2][k] && data_sel[1][j] != data_sel[2][k])
	                                            	//增加第四位数字不等的判断
	                                            	if( data_sel[3][l] != data_sel[0][i] && data_sel[3][l] != data_sel[1][j] && data_sel[3][l] != data_sel[2][k])
	                                            	//增加第五位数字不等的判断
	                                            	if( data_sel[4][m] != data_sel[0][i] && data_sel[4][m] != data_sel[1][j] && data_sel[4][m] != data_sel[2][k] && data_sel[4][m] != data_sel[3][l])
	                                            	//增加第六位数字不等的判断
	                                            	if( data_sel[5][n] != data_sel[0][i] && data_sel[5][n] != data_sel[1][j] && data_sel[5][n] != data_sel[2][k] && data_sel[5][n] != data_sel[3][l]&& data_sel[5][n] != data_sel[4][m]){
			                                            nums++;
			                                        }
                                    			}
                                    		}
	                                    }
                                    }
                                }
                            }
                        }
                    break;
                    case "PK10DWD":
                    	for( i=0; i<=max_place; i++ ){
                            nums += data_sel[i].length;
                        };
                    break;
                    case "PK10JS":
                          nums += data_sel[1].length>data_sel[2].length?data_sel[2].length:data_sel[1].length;
                    break;
                    default     : //默认情况
						for( i=0; i<=max_place; i++ ){
							if( data_sel[i].length == 0 ){//有位置上没有选择
								tmp_nums = 0;
								break;break;
							}
							tmp_nums *= data_sel[i].length;
						}
						nums = tmp_nums;
					break;
                }
            }
            //03:计算金额
            var times = parseInt($($.lt_id_data.id_sel_times).val(),10);
            if( isNaN(times) )
            {
                times = 1;
                $($.lt_id_data.id_sel_times).val(1);
            }
            var money = Math.round(times * nums * 2 * ($.lt_method_data.modes[modes].rate * 1000))/1000;//倍数*注数*单价 * 模式
            money = isNaN(money) ? 0 : money;
            $($.lt_id_data.id_sel_num).html(nums);   //写入临时的注数
            $($.lt_id_data.id_sel_money).html(money);//写临时单笔价格
            $.gameBtn();
        };
        //重复号处理
        //10万数据性能问题 stank
        function dumpNum(isdeal){

            var errs = {},arry=data_sel[0] ,len = arry.length;
            var tmperrs=[];
            var i=0;
            for(; i < len; i++)  {
                var tmp = arry[i];
                if(!errs.hasOwnProperty(tmp)) {
                    errs[arry[i]] ="";
                }else{
                    tmperrs.push(arry[i]);
                }
            }
            len = 0;
            var news=[];
            for(var i in errs) {
                news[len++] = i;
            }

            if( isdeal ){
                //如果是做删除重复号的处理
                data_sel[0] = news;
            }
            return tmperrs;
        };

        //输入框的字符串处理
        function _inptu_deal(){
            var s = $.trim($("#lt_write_box",$(me)).val());
            s     = $.trim(s.replace(/[^\s\r,;，；　０１２３４５６７８９0-9]/g,""));
            var m = s;
            switch( methodname ){
                case 'SDZX3' :
                case 'SDZU3' :
                case 'SDZX2' :
                case 'SDRX1' :
                case 'SDRX2' :
                case 'SDRX3' :
                case 'SDRX4' :
                case 'SDRX5' :
                case 'SDRX6' :
                case 'SDRX7' :
                case 'SDRX8' :
                case 'SDZU2' : s = s.replace(/[\r\n,;，；]/g,"|").replace(/(\|)+/g,"|"); break;
                case 'PK10ZX2':
                case 'PK10ZX3':
                case 'PK10ZX4':
                case 'PK10ZX5':
                case 'PK10ZX6':
                	s = play.formatInputNumbers();
                	data_sel[0] = s;
                break;
                default      : s = s.replace(/[\s\r,;，；　]/g,"|").replace(/(\|)+/g,"|"); break;
            }
            if(methodname.indexOf("PK10ZX") === -1){
            	s = s.replace(/０/g,"0").replace(/１/g,"1").replace(/２/g,"2").replace(/３/g,"3").replace(/４/g,"4").replace(/５/g,"5").replace(/６/g,"6").replace(/７/g,"7").replace(/８/g,"8").replace(/９/g,"9");
	            if( s == "" ){
	            	  data_sel[0] = []; //清空数据
	            }else{
	            	  data_sel[0] = s.split("|");
	            }
            }
            return m;
        };
        /************************ 事件触发处理 ****************************/
        if( otype == 'input' ){//手动输入型处理
            $("#lt_write_del",$(me)).click(function(){//删除重复号
                var err = dumpNum(true);
                if(methodname.indexOf('PK10ZX') !== -1){
                	var lt_elem = $(this);
	                var error_num = lt_elem.data("error_num");
	                var repeat_num = lt_elem.data('repeat_num');
	                if (error_num.length > 0 || repeat_num.length > 0) {
	                    play.showErrorNumbers(lt_elem,error_num,repeat_num);
	                } else {
	                    $.alert("没有重复及错误号码！");
	                }
                	return false;
            	}
                if( err.length > 0 ){//如果有重复号码
                    checkNum();
                    switch( methodname ){
                        case 'SDZX3' :
                        case 'SDZU3' :
                        case 'SDZX2' :
                        case 'SDRX1' :
				                case 'SDRX2' :
				                case 'SDRX3' :
				                case 'SDRX4' :
				                case 'SDRX5' :
				                case 'SDRX6' :
				                case 'SDRX7' :
				                case 'SDRX8' :
                        case 'SDZU2' : $("#lt_write_box",$(me)).val(data_sel[0].join(";"));
                                       $.alert(lot_lang.am_s3+'\r\n'+err.join(";"));
                                       break;
                        default      : $("#lt_write_box",$(me)).val(data_sel[0].join(" "));
                                       $.alert(lot_lang.am_s3+'\r\n'+err.join(" "));
                                       break;
                    }
                }else{
                	$.alert(lot_lang.am_s4);
                }
            });
            $("#lt_write_import",$(me)).click(function(){//载入文件处理
                $.ajaxUploadUI({
              title    : lot_lang.dec_s27,
        			url      : './?dialogUI=fileupload.php',//服务端处理的文件
        			loadok   : lot_lang.dec_s28,
        			filetype : ['txt','csv'],//允许载入的文件类型
        			success  : function(data){ $("#lt_write_box",$(me)).val(data).change(); },//数据处理
        			onfinish : function(){$("#lt_write_box",$(me)).focus();}
        		});
            });
            $("#lt_write_box",$(me)).change(function(){//输入框时时变动处理
                var s = _inptu_deal();
                $(this).val(s);
                checkNum();
             }).keyup(function(){
                _inptu_deal();
                checkNum();
            });
            $("#lt_write_empty",$(me)).click(function(){//清空处理
                data_sel[0] = []; //清空数据
                $("#lt_write_box",$(me)).val("");
                checkNum();
            });

        }

        var play = {
            //文本框输入计算
            calculateInputNumbersLength: function (num_len) {
                return num_len;
            },
            //格式化文本域的值
            formatInputNumbers:function(){
                var val = $("#lt_write_box").val();
                return play.replaceInputNumbers(val," ");
            },
            //删除文本域中的重复和长度不符合玩法的号码,参数（该玩法的号码长度，需要验证的数组）
            checkInputNumbersArray:function(num_arr,baseLen){
                var base_len = baseLen;
                var num_separator = " ";
                var check_type = 1;
                return play.getCheckedInputNumbersArray(num_arr,base_len,num_separator,check_type);
            },
            replaceInputNumbers:function(val,num_separator){
                val = val.replace(/[^\n\S]+/g," ");
                if (num_separator == ' ') {
                    val = val.replace(/[^\d\s]+|\n+/g, ",").replace(/(^[,]*)|([,]*$)/g, "")
                        .replace(/\s+[,]+\s+|\s+[,]+|[,]+\s+/g, ",");
                }
                else {
                    val = val.replace(/\D+/g, ",").replace(/(^[,]*)|([,]*$)/g, "");
                }
                //val = val.replace(/\s+|;+/g,",").replace(/\D+/g,",").replace(/(^[,]*)|([,]*$)/g,"");
                return val.split(",");
            },
            getCheckedInputNumbersArray:function (num_arr,base_len,num_separator,check_type){
                var lt_elem = $("#lt_write_del");
                lt_elem.removeData("error_num").removeData('repeat_num').removeData('no_repeat_num');
                var error_num = [], repeat_num = [], no_repeat_num = [];
                var max = 10;
                var min = 1;
                var arr_len = num_arr.length;
                var num_dict = {};
                for(var i = 0;i < arr_len;i++) {
                    var _n = num_arr[i];
                    var num = _n.split(num_separator == '' ? /\D*/g : num_separator);
                    //var num = _n.split(" ");
                    var flag = num.length == base_len;
                    if(flag) {
                        for(var j=0;j<num.length;j++){
                        	flag = num[j] <= max && num[j] >= min && num[j].indexOf("0")!== -1 && num[j].length<3;
                        	if(!flag)break;
                        }
                    }
                    if(flag) {
                        if(check_type == 1){
                            flag = play.checkNumberNorepeat(num);
                        }else if(check_type == 2){
                            flag = play.check_input_num_repeat(num);
                        }else if (check_type == 3){
                            // TODO 号码排序
                            num.sort(function(a,b){
                                return a > b ? 1 : -1;
                            });
                            flag = play.check_input_num_no_all_repeat(num);
                            if(flag){
                                _n = num.join("");
                                if(_n in num_dict) flag = false;
                                else {
                                    num_dict[_n] = '';
                                    num_arr[i] = _n;
                                }
                            }
                        }else if (check_type == 4){
                            flag = play.check_input_num_repeat(num);
                            if (flag) flag = play.check_input_num_no_all_repeat(num);
                        }
                    }
                    if(!flag){
                        error_num[error_num.length] = num.join(" ");
                        num_arr.splice(i, 1);
                        arr_len--;
                        i--;
                    }else{
                        if(_n in num_dict){
                            repeat_num[repeat_num.length] = ''+_n;
                        }
                        else{
                            num_dict[_n] = '';
                            no_repeat_num[no_repeat_num.length] = ''+_n;
                        }
                    }
                }
                lt_elem.data("error_num", error_num).data('repeat_num', repeat_num).data('no_repeat_num', no_repeat_num).data('right_num', num_arr);
                return num_arr;
            },
            //号码验证:不允许重复
            checkNumberNorepeat:function(num){
                var flag = false;
                var num_len = num.length;
                for (var i = 0; i < num_len - 1; i++) {
                    for (var j = i + 1; j < num_len; j++) {
                        flag = num[i] != num[j];
                        if (!flag) break;
                    }
                    if (!flag) break;
                }
                return flag;
            },
            //显示删除的重复号
            showErrorNumbers:function(lt_elem,error_num,repeat_num){
                var content = "已删除以下重复或错误号码：<br/>";
                var no_repeat_num = lt_elem.data('no_repeat_num');
                lt_elem.data('right_num',no_repeat_num).data('repeat_num',[]).data('error_num',[]);
                $("#lt_write_box").val(no_repeat_num.join(','));
                content += (error_num.length > 0 ? (error_num.join() + '\n') : '') + repeat_num.join();
                $.alert(content);
                //$("#lt_sel_nums").html(play.calculateInputNumbersLength(no_repeat_num.length));
                checkNum();
            }
        };

        //选中号码处理
        function selectNum( obj, isButton ){
            if($(obj).hasClass("hover")){//如果本身是已选中，则不做任何处理
                return;
            }

            $(obj).addClass("hover");//样式改变为选中
            place = Number($(obj).attr("name").replace("lt_place_",""));
            var number = $.trim($(obj).html());
			number=number.toLowerCase();
			number = number.replace(/\<div.*\<\/div>/g,"").replace(/\r\n/g,"");
			if($.lt_lottid == 15)
            {

                number = number.replace(/111/gi, 1).replace(/222/gi, 2).replace(/333/gi, 3).replace(/444/gi, 4).replace(/555/gi, 5).replace(/666/gi, 6);
                if (methodname != "KSHZ" && methodname != "SBTHHZ") {
                    number = number.replace(/11/gi, 1).replace(/22/gi, 2).replace(/33/gi, 3).replace(/44/gi, 4).replace(/55/gi, 5).replace(/66/gi, 6)
                }
                number = number.replace(/\*/gi, "");
                if (methodname == "EBTHDT" || methodname == "SBTHDT") {
                    var danlen = 1;
                    if (methodname == "SBTHDT") {
                        danlen = 2
                    }
                    if (data_sel[0].length + 1 > danlen && place == 0) {
                        var lastnumber = data_sel[0][data_sel[0].length - 1];
                        $.each($('li[name="lt_place_0"][class="selected"]'), function(i, n) {
                            if ($(this).html() == lastnumber) {
                                $(this).attr("class", "");
                                data_sel[0] = $.grep(data_sel[0], function(n, i) {
                                    return n == lastnumber
                                }, true)
                            }
                        })
                    }
                }
                if (methodname == "ETHDX" || methodname == "EBTHDT" || methodname == "SBTHDT") {

                    var unplace = 1 - place;

                    if (data_sel[unplace].contains(number)) {
                        $.each($('li[name="lt_place_' + unplace + '"][class="selected"]'), function(i, n) {
                            var tmphtml = $(this).html();
                            if (methodname == "ETHDX") {
                                tmphtml = tmphtml.replace(/11/gi, 1).replace(/22/gi, 2).replace(/33/gi, 3).replace(/44/gi, 4).replace(/55/gi, 5).replace(/66/gi, 6)
                            }
                            if (tmphtml == number) {
                                $(this).attr("class", "");
                                data_sel[unplace] = $.grep(data_sel[unplace], function(n, i) {
                                    return n == number
                                }, true)
                            }
                        })
                    }
                }
            }

            data_sel[place].push(number);//加入到数组中

            if( !isButton ){//如果不是按钮触发则进行统计，按钮的统一进行统计

				var numlimit = parseInt($.lt_method_data.maxcodecount);
				if( numlimit > 0 )
				{
					if( data_sel[place].length > numlimit )
					{
						$.alert(lot_lang.am_s35.replace('%s',numlimit));
						unSelectNum(obj,false);
					}
				}
                checkNum();
            }
        };


        //取消选中号码处理
        function unSelectNum( obj, isButton ){
            if(!$(obj).hasClass("hover")){//如果本身是未选中，则不做任何处理
                return;
            }

			$(obj).removeClass("hover");//样式改变为未选中
            place = Number($(obj).attr("name").replace("lt_place_",""));
            var number = $.trim($(obj).html());
			number=number.toLowerCase();
			number = number.replace(/\<div.*\<\/div>/g,"").replace(/\r\n/g,"");

            if($.lt_lottid == 15)
            {
                number = number.replace(/111/gi, 1).replace(/222/gi, 2).replace(/333/gi, 3).replace(/444/gi, 4).replace(/555/gi, 5).replace(/666/gi, 6);
                if (methodname != "KSHZ" && methodname != "SBTHHZ") {
                    number = number.replace(/11/gi, 1).replace(/22/gi, 2).replace(/33/gi, 3).replace(/44/gi, 4).replace(/55/gi, 5).replace(/66/gi, 6)
                }
                number = number.replace(/\*/gi, "");
            }

            data_sel[place] = $.grep(data_sel[place],function(n,i){//从选中数组中删除取消的号码
				return n == number;
            },true);

            if( !isButton ){//如果不是按钮触发则进行统计，按钮的统一进行统计
                checkNum();
            }
        };


        function dealPK10(obj){
            var place = Number($(obj).attr("name").replace("lt_place_",""));//第几行
            var number = $.trim($(obj).html());
			number = number.toLowerCase();
			number = number.replace(/\<div.*\<\/div>/g,"").replace(/\r\n/g,"");
			var index;

			if($(obj).hasClass("disable")){
				return false;
			}

			if(place === 0){//选择操作
				if(data_sel[1].length === data_sel[2].length && data_sel[1].length === 10){//已经是最大选择
					$.alert(lot_lang.am_s39);
					return false;
				}

				$(".pk10_car .nList li").removeClass("disable");
				if(data_sel[1].length === data_sel[2].length){
					data_sel[1].push(number);
					showPK10_ball(data_sel[1].length - 1,number,".pk10_fast .nList");
					$(".pk10_car .nList li[class='car_" + number + "']").addClass("disable");

				}else{
					if(number === data_sel[1][data_sel[1].length - 1]){//选慢的时候不能和当前的那个快相同
						$.alert(lot_lang.am_s38);
						return false;
					}else{
						data_sel[2].push(number);
						showPK10_ball(data_sel[2].length - 1,number,".pk10_slow .nList");
					}
				}
			}

			if(place === 3){//删除操作
				index = $(".pk10_clean ul li").index(obj);
				actionPK10_ball(index,".pk10_fast .nList");
				actionPK10_ball(index,".pk10_slow .nList");

				if(typeof data_sel[1][index] !== 'undefined' || typeof data_sel[2][index] !== 'undefined'){
					data_sel[1] = $.grep(data_sel[1],function(n,i){//从选中数组中删除取消的号码
						return i === index;
		            },true);
		            data_sel[2] = $.grep(data_sel[2],function(n,i){//从选中数组中删除取消的号码
						return i === index;
		            },true);
				}

				if(data_sel[1].length === data_sel[2].length){
					$(".pk10_car .nList li").removeClass("disable");
				}

			}
			checkNum();
        }

        //pk10显示快慢的球
        function showPK10_ball(index,num,className){
        	$(className).append('<li class="num_' + num + '"></li>');
        	$(className + " li").eq(index).css({"left" : index*61 + 12 + "px"}).fadeIn();
        }

        //pk10快慢球动画
        function actionPK10_ball(index,className){
        	var nodes;
        	$(className + " li").eq(index).remove();
        	nodes = $(className + " li");
        	$.each(nodes,function(index,node){
        		$(node).animate({"left" : index*61 + 12 + "px"})
        	})
        }

        //选择与取消号码选择交替变化
        function changeNoCss(obj){
        	if(methodname == "PK10JS"){
        		dealPK10(obj);
        	}else{
	            if($(obj).hasClass("hover")){//如果本身是已选中，则做取消
	                unSelectNum(obj,false);
	            }else{
	                selectNum(obj,false);
	            }
        	}
        };
        //选择奇数号码
        function selectOdd(obj){
            if( Number($(obj).html()) % 2 == 1 ){
                 selectNum(obj,true);
            }else{
                 unSelectNum(obj,true);
            }
        };
        //选择偶数号码
        function selectEven(obj){
            if( Number($(obj).html()) % 2 == 0 ){
                 selectNum(obj,true);
            }else{
                 unSelectNum(obj,true);
            }
        };
        //选则大号
        function selectBig(i,obj){
            if( i >= opts.noBigIndex ){
                selectNum(obj,true);
            }else{
                unSelectNum(obj,true);
            }
        };
        //选择小号
        function selectSmall(i,obj){
            if( i < opts.noBigIndex ){
                selectNum(obj,true);
            }else{
                unSelectNum(obj,true);
            }
        };
        //设置号码事件
        $($.lt_id_data.id_selector).find("li[name^='lt_place_']").click(function(){
            changeNoCss(this);
        });
		$(".posChoose").change(function(){
			checkNum();
		});
        //全大小单双清按钮的动作行为处理
		//if( opts.isButton == true ){//如果有这几个按钮才做处理
		if( 1 ){
            $(".cList li",$(this)).click(function(){//清除处理
            	var td = $(this).parent().parent().children('ul')[0];
            	td = $(td);
                if($(this).attr('name') !== "clean"){
                    $(this).addClass("hover").siblings().removeClass("hover");
                }else{
                    $(this).siblings().removeClass("hover");
                }
                switch( $(this).attr('name') ){
                    case 'all'   :
						$.each(td.children(),function(i,n){
							//alert(i+"|"+$(n).html());
							selectNum(n,true);
						});
					break;
                    case 'big'   :
						 $.each(td.children(),function(i,n){
							selectBig(i,n);
						 });
					break;
                    case 'small' :
						 $.each(td.children(),function(i,n){
							selectSmall(i,n);
						 });
					break;
                    case 'odd'   :
						 $.each(td.children(),function(i,n){
							selectOdd(n);
						 });
					break;
                    case 'even'  :
						 $.each(td.children(),function(i,n){
							selectEven(n);
						 });
					break;
                    case 'clean'  :
						$.each(td.children(),function(i,n){
							unSelectNum(n,true);
						});
					break;
                    default : break;
                }
                checkNum();
            });
        }else if( otype == 'dxds' ){//或者玩法为大小单双即有清按钮的处理
            $("div[class='selcleanbutton']",$(this)).click(function(){
                $.each($(this).parent().children(":first").children(),function(i,n){
                    unSelectNum(n,true);
                });
                checkNum();
            });
        }

        //倍数键盘处理事件
        $($.lt_id_data.id_sel_times).keyup(function(){
			checkTimes();
        });

		//倍数修改以后的计算
		function checkTimes(){
            var times = $($.lt_id_data.id_sel_times).val().replace(/[^0-9]/g,"").substring(0,5);
            $($.lt_id_data.id_sel_times).val( times );
            if( times == "" ){
                times = 1;
                $($.lt_id_data.id_sel_times).val(times);
            }else{
                times = parseInt(times,10);//取整倍数
            }
            if(times === 0){
            	times = 1;
            	$.alert("倍数不能输入0");
            	$($.lt_id_data.id_sel_times).val(times);
            };
            var nums  = parseInt($($.lt_id_data.id_sel_num).html(),10);//投注注数取整
            //var modes = parseInt($("#lt_project_modes").val(),10);//投注模式
			var modes = parseInt($("input[name='lt_project_modes']:checked").val(),10);//投注模式
			//倍数x注数x单价x模式
            var money = Math.round(times * nums * 2 * ($.lt_method_data.modes[modes].rate * 1000))/1000;
            money = isNaN(money) ? 0 : money;
            $($.lt_id_data.id_sel_money).html(money);
		}

		//倍数加减按钮点击处理
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

		//直接点击元角分控制span
		$($.lt_id_data.id_funding + " span").unbind("click").click(function(){
			var data = $(this).attr("data");
			$($.lt_id_data.id_funding + " span").removeClass("hover");
			$(this).addClass("hover");
			$("input[name='lt_project_modes']").prop("checked", false);
			$("input.radio_" + data).prop("checked", true);

			var nums  = parseInt($($.lt_id_data.id_sel_num).html(),10);//投注注数取整
			var times = parseInt($($.lt_id_data.id_sel_times).val(),10);//投注倍数取整
			//var modes = parseInt($("#lt_project_modes").val(),10);//投注模式
			var modes = parseInt($("input[name='lt_project_modes']:checked").val(),10);//投注模式
			var money = Math.round(times * nums * 2 * ($.lt_method_data.modes[modes].rate * 1000))/1000;//倍数*注数*单价 * 模式
			money = isNaN(money) ? 0 : money;
			$($.lt_id_data.id_sel_money).html(money);
		});

		function newNumber(start,end){
			return Math.round(Math.random()*(end-start)+start);//生成在[start,end]范围内的随机数值，只支持不小于0的合法范围
		}
		function isHaveThisNumber(para,num){
			if(typeof(para) == "object")
			{
				if(para.length==0)
			    {
			        return false;
			    }
			}
			for(var i=0;i<para.length;i++){
				if(para[i]==num){
					return true;//与目标数组有重复
				}
			}
			return false;
		}
		function newRandomNumbersWithNoRepeat(start,end,size){
			var para=new Array();//目标随机数组
			var rnum;//当前随机数
			var currentIndex=0;//当前随机数组的索引
			if(start>end||start<0||end<0||size<0){
			    return;
			}
			if(end-start+1<size){//验证随机数个数是否超出随机数范围
			    return;
			}
			for(var i=0;i<size;i++){//生成 size 个不重复的随机数
				rnum=newNumber(start,end);//获取随机数
				if(isHaveThisNumber(para,rnum)){//是否已经存在
					while(isHaveThisNumber(para,rnum)){//获取新的随机数 直到不重复
			            rnum=newNumber(start,end);//重新获取随机数
			        }
				}
				para[currentIndex++]=rnum;//添加到现有数字集合中
			}
			return para;
		}
		//随机选N注
			$(".lt_random_bets_10,.lt_random_bets_5,.lt_random_bets_1").unbind("mouseover").mouseover(function(){
				random_bets = true;//当前为机选sam
			});

			$(".lt_random_bets_10,.lt_random_bets_5,.lt_random_bets_1").unbind("mouseout").mouseout(function(){
				random_bets = false;//当前不为机选sam
			});

			$(".lt_random_bets_10").unbind("click").click(function(){
				for (var i=0; i<10; i++) {
					$(".lt_random_bets_1").trigger("click");
				}
			});
			$(".lt_random_bets_5").unbind("click").click(function(){
				for (var i=0; i<5; i++) {
					$(".lt_random_bets_1").trigger("click");
				}
			});
			$(".lt_random_bets_1").unbind("click").click(function() {
				//当前为机选sam
				if(random_bets){
					for( i=0; i<data_sel.length; i++ ){//清空已选择数据
						data_sel[i] = [];
					}
					if( otype == 'input' ){//清空所有显示的数据
						$("#lt_write_box",$(me)).val("");
					}
					else if( otype == 'digital' || otype == 'dxds' || otype == 'dds' ){
						$.each($(".nList li",$(me)).filter(".hover"),function(i,n){
							$(this).removeClass("hover");
						});
					}
				}

				var randomcos = $("#randomcos").val(); //行数3
				var randomcosvalue=$("#randomcosvalue").val(); //每行最少选择个数用|分割
				var totalnum=0;
				var minsize = randomcosvalue.split('|'); //每行最少选择个数分割后的数组1|1|1
				for (var i=0; i<minsize.length; i++) {
					if (minsize[i]>0) {
						totalnum += parseInt(minsize[i]);//得到一共最少选择号码个数
					}
				}
				var end = $("li[name^='lt_place_0']").length;
				var para=newRandomNumbersWithNoRepeat(0,end-1,totalnum); //随机得到一个不重复的数字组成的数组
				var randomcos_arr = [];
				randomcos_arr.length = randomcos;
				$.each(randomcos_arr,function(i,v1){
					var minsize_arr = [];
					minsize_arr.length = minsize[i];
					$.each(minsize_arr,function(j,v2){
						$.each($("li[name^='lt_place_"+i+"']"), function(n, val){
							if (n == para[j]) {
								$(this).trigger("click");
							}
						});
					});
					para.shift();
				});
				para=[];

				$($.lt_id_data.id_sel_insert).trigger("click");
			});
        //添加按钮
        $($.lt_id_data.id_sel_insert).unbind("click").click(function(){
            var nums  = parseInt($($.lt_id_data.id_sel_num).html(),10);//投注注数取整
            var times = parseInt($($.lt_id_data.id_sel_times).val(),10);//投注倍数取整
            //var modes = parseInt($("#lt_project_modes").val(),10);//投注模式
			var modes = parseInt($("input[name='lt_project_modes']:checked").val(),10);//投注模式
            var money = Math.round(times * nums * 2 * ($.lt_method_data.modes[modes].rate * 1000))/1000;//倍数*注数*单价 * 模式
            var mid   = $.lt_method_data.methodid;
			var current_positionsel = $.lt_position_sel;
            var cur_position = 0;

            if($(this).hasClass('addBtnDisabled')){//没有选注不让操作
            	return false;
            }

            if (current_positionsel.length > 0) {
                $.each(current_positionsel, function(i, n) {
                    cur_position += Math.pow(2, 4 - parseInt(n, 10))
                })
            }

            if( isNaN(nums) || isNaN(times) || isNaN(money) || money <= 0 ){//如果没有任何投注内容
				//当前为机选sam
				if(random_bets){
					for( i=0; i<data_sel.length; i++ ){//清空已选择数据
						data_sel[i] = [];
					}
					if( otype == 'input' ){//清空所有显示的数据
						$("#lt_write_box",$(me)).val("");
					}
					else if( otype == 'digital' || otype == 'dxds' || otype == 'dds' ){
						$.each($(".nList li",$(me)).filter(".hover"),function(i,n){
							$(this).removeClass("hover");
						});
					}
					checkNum();
				}else{
					checkNum();
					$.alert(otype == 'input' ? lot_lang.am_s29 : lot_lang.am_s19);
				}
                return;
            }
            if( otype == 'input' ){//如果是输入型，则检测号码合法性，以及是否存在重复号
                var mname = $.lt_method[mid];//玩法的简写,如:'ZX3'

                var error = [];
                var edump = [];
                var ermsg = "";
                //检测重复号，并除去重复号
                edump = dumpNum(true);
                if( edump.length >0 ){//有重复号
                    ermsg += lot_lang.em_s2+'\n'+edump.join(", ")+"\n";
                    checkNum();//重新统计
                    nums  = parseInt($($.lt_id_data.id_sel_num).html(),10);//投注注数取整
                    money = Math.round(times * nums * 2 * ($.lt_method_data.modes[modes].rate * 1000))/1000;//倍数*注数*单价*模式
                }
                switch(mname){//根据类型不同做不同检测
                    //任三 直选 直选单式
                    case 'RXZXSSC3DS':
                    case 'RXZXWFC3DS':
                    case 'RXZXFFC3DS':
                    case 'ZX3'  : error = _inputCheck_Num(3,true); break;
					case 'RXZUSSC3HH':
                    case 'HHZX' : error = _inputCheck_Num(3,true,_HHZXcheck,true); break;
					//任选二-直选单式
					case "RXZXSSC2DS":
                    case "RXZXWFC2DS":
                    case "RXZXFFC2DS":
                    case 'ZX2'  : error = _inputCheck_Num(2,true); break;

					//任选二组选单式
					case 'RXZUSSC2DS'  :
                    case 'RXZUWFC2DS'  :
                    case 'RXZUFFC2DS'  :
                    case 'ZU2'  : error = _inputCheck_Num(2,true,_HHZXcheck,true); break;
                    case 'ZX5'  : error = _inputCheck_Num(5,true); break;
                    case 'ZX4'  : error = _inputCheck_Num(4,true); break;
                    case 'ZUS'  : error = _inputCheck_Num(3,true, _ZUSDScheck, true); break;
                    case 'ZUL'  : error = _inputCheck_Num(3,true, _ZULDScheck, true); break;
                    case 'SDZX3': error = _inputCheck_Num(8,true,_SDinputCheck,false); break;
                    case 'SDZU3': error = _inputCheck_Num(8,true,_SDinputCheck,true); break;
                    case 'SDZX2': error = _inputCheck_Num(5,true,_SDinputCheck,false); break;
                    case 'SDZU2': error = _inputCheck_Num(5,true,_SDinputCheck,true); break;
                    case 'SDRX1': error = _inputCheck_Num(2,true,_SDinputCheck,false); break;
                    case 'SDRX2': error = _inputCheck_Num(5,true,_SDinputCheck,true); break;
                    case 'SDRX3': error = _inputCheck_Num(8,true,_SDinputCheck,true); break;
                    case 'SDRX4': error = _inputCheck_Num(11,true,_SDinputCheck,true); break;
                    case 'SDRX5': error = _inputCheck_Num(14,true,_SDinputCheck,true); break;
                    case 'SDRX6': error = _inputCheck_Num(17,true,_SDinputCheck,true); break;
                    case 'SDRX7': error = _inputCheck_Num(20,true,_SDinputCheck,true); break;
                    case 'SDRX8': error = _inputCheck_Num(23,true,_SDinputCheck,true); break;
                    case 'ETHDX': error = _inputCheck_Num(3, true,_ETHDXcheck, true); break;
                    case 'SBTH':error = _inputCheck_Num(3, true, _SBTHDScheck, true);break;
                    case 'EBTH':error = _inputCheck_Num(2, true, _EBTHDScheck, true);break;
                    //任选四 直选 直选单式
                    case "RXZXWFC4DS":
                    case "RXZXFFC4DS":
                    case "RXZXSSC4DS": error = _inputCheck_Num(4, true); break;
                    case "PK10ZX2":
                    case "PK10ZX3":
                    case "PK10ZX4":
                    case "PK10ZX5":
                    case 'PK10ZX6':
                	    //$("#lt_write_del").trigger("click");
                	    var lt_elem = $("#lt_write_del");
		                var error_num = lt_elem.data("error_num");
		                var repeat_num = lt_elem.data('repeat_num');
		                if(error_num.length > 0 || repeat_num.length > 0){
		                    play.showErrorNumbers(lt_elem, error_num, repeat_num);
		                }
                    break;
                    default     : break;
                }
                if( error.length > 0 ){//如果存在错误的号码，则提示
                    ermsg += lot_lang.em_s1+'\n'+error.join(", ")+"\n";
                }

                if( ermsg.length > 1 ){
                    $.alert(ermsg);
                }
            }
            var nos = $.lt_method_data.str;

            var serverdata = "{'type':'"+otype+"','methodid':"+mid+",'codes':'";

            var temp = [];
            if(methodname == "PK10JS"){
            	if(data_sel[1].length !== data_sel[2].length){
            		$.alert(lot_lang.am_s37);
                	return false;
            	}
                for( i=0; i<data_sel[1].length; i++ ){
	                temp.push(data_sel[1][i]+"&"+data_sel[2][i]);
	                nos = nos.replace('X',data_sel[1][i]+$.lt_method_data.sp+data_sel[2][i]);
                }
            }else{
	            for( i=0; i<data_sel.length; i++ ){
	            	nos = nos.replace('X',data_sel[i].sort(_SortNum).join($.lt_method_data.sp));
	            	temp.push( data_sel[i].sort(_SortNum).join("&") );
	            }
            }

            /*修改定位胆在玩法与投注号码处空号没有显示"-"的问题*/
            var nos_temp = [];
            $.each(nos.split(","),function(index,value){
            	if(value == ""){
            		nos_temp.push("-");
            	}else{
            		nos_temp.push(value);
            	}
            })
            nos = nos_temp.join();
            /*修改定位胆在玩法与投注号码处空号没有显示"-"的问题*/

            if( nos.length > 40 ){
				var rand=~~(Math.random()*89999999+10000000).toString();
                var nohtml = '['+$.lt_method_data.title+'_'+$.lt_method_data.name+'] ' + nos.substring(0,37)+' ......<a href="#" onclick="div_slow_show('+rand+');return(false);" class="orange">'+lot_lang.dec_s5+'</a>';
				nohtml+='<div id="div_slow_id_'+rand+'" class="more" style="display:none;"><a class="close" href="#" onclick="div_slow_hide('+rand+');return(false);">['+lot_lang.dec_s6+']</a><textarea class="code" readonly="readonly">'+nos+'</textarea></div>';
            }else{
                var nohtml = '['+$.lt_method_data.title+'_'+$.lt_method_data.name+'] ' + nos;
            }
			var pmodel = $("#pmode").val();//投注奖金模式

			if(typeof(pmodel) != "undefined"){
				switch(pmodel){
					case '2':
						stemp = $.lt_method_data.nfdprize.levs;
					break;
					default:
						stemp = $.lt_method_data.nfdprize.defaultprize;
				}
				stemp =  '模式:'+stemp

			}
			else{
					stemp = "" ;
					pmodel = 1;
			}

		//	pmodel = stemp;
            //判断是否有重复相同的单
            if( $.lt_same_code[mid] != undefined && $.lt_same_code[mid][modes] != undefined && $.lt_same_code[mid][modes].length > 0 && $.lt_same_code[mid][modes][cur_position] != undefined && $.lt_same_code[mid][modes][cur_position].length > 0){
                    if( $.inArray(temp.join("|"),$.lt_same_code[mid][modes][cur_position]) != -1 ){//存在相同的
						//当前为机选sam
						if(random_bets){
							for( i=0; i<data_sel.length; i++ ){//清空已选择数据
								data_sel[i] = [];
							}
							if( otype == 'input' ){//清空所有显示的数据
								$("#lt_write_box",$(me)).val("");
							}
							else if( otype == 'digital' || otype == 'dxds' || otype == 'dds' ){
								$.each($(".nList li",$(me)).filter(".hover"),function(i,n){
									$(this).removeClass("hover");
								});
							}
						}
						checkNum();
                        $.alert(lot_lang.am_s28);
                        return false;
                    }
            }
            //nohtml  = '['+$.lt_method_data.title+'_'+$.lt_method_data.name+'] '+nohtml;
            //noshtml = '['+$.lt_method_data.title+'_'+$.lt_method_data.name+'] '+nos.substring(0,37);
            var noshtml;
            if( nos.length > 40 ){
            	noshtml = '['+$.lt_method_data.title+'_'+$.lt_method_data.name+'] '+ nos.substring(0,37) + '......';
            }else{
            	noshtml = '['+$.lt_method_data.title+'_'+$.lt_method_data.name+'] '+ nohtml;
            }
            //serverdata += temp.join("|")+"','nums':"+nums+",'omodel':"+pmodel+",'times':"+times+",'money':"+money+",'mode':"+modes+",'desc':'"+noshtml+"'}";
			if($("input[name='poschoose']").val()){
                serverdata += temp.join("|")+"','menuid':"+menuid+",'nums':"+nums+",'omodel':"+pmodel+",'times':"+times+",'money':"+money+",'mode':"+modes+",'desc':'"+noshtml+"','poschoose':'" + $("input[name='poschoose']").val() + "'}";
            } else {
                serverdata += temp.join("|")+"','menuid':"+menuid+",'nums':"+nums+",'omodel':"+pmodel+",'times':"+times+",'money':"+money+",'mode':"+modes+",'desc':'"+noshtml+"'}";
            }

            var cfhtml = '<tr class="lottery lotteryBg" style="display:none;">' +
							'<th>' + nohtml + '</th>' +
							'<td>'+stemp+'</td>' +
							'<td class="orange">['+$.lt_method_data.modes[modes].name+']</td>' +
							'<td>'+nums+lot_lang.dec_s1+'</td>' +
							'<td>'+times+lot_lang.dec_s2+'</td>' +
							'<td class="orange">'+money+lot_lang.dec_s3+'</td>' +
							'<td class="del"><a href="javascript:void(0);" class="del"></a><input type="hidden" name="lt_project[]" value="'+serverdata+'" /></td>' +
						 '</tr>';

            var $cfhtml = $(cfhtml);
			$($.lt_id_data.id_cf_content + " tr.cleanall").after($cfhtml);
			$($.lt_id_data.id_cf_content + " tr.lottery:first").fadeIn(100,function(){
				var node = $(this);
				window.setTimeout(function(){
					node.removeClass('lotteryBg');
				}, 400);
			});
            //详情查看

            $.lt_total_nums  += nums;//总注数增加
            $.lt_total_money += money;//总金额增加
            $.lt_total_money  = Math.round($.lt_total_money*1000)/1000;
            basemoney         = Math.round(nums * 2 * ($.lt_method_data.modes[modes].rate * 1000))/1000;//注数*单价 * 模式
            $.lt_trace_base   = Math.round(($.lt_trace_base+basemoney)*1000)/1000;
            $($.lt_id_data.id_cf_num).html($.lt_total_nums);//更新总注数显示
            $($.lt_id_data.id_cf_money).html($.lt_total_money);//更新总金额显示
            $($.lt_id_data.id_cf_count).html(parseInt($($.lt_id_data.id_cf_count).html(),10)+1);//总投注项加1
            //计算奖金，并且判断是否支持利润率追号
            var pc = 0;
            var pz = 0;
            $.each($.lt_method_data.prize,function(i,n){
                n = isNaN(Number(n)) ? 0 : Number(n);
                pz = pz > n ? pz : n;
                pc++;
            });
            if( pc != 1 ){
                pz = 0;
            }
            pz = Math.round( pz * ($.lt_method_data.modes[modes].rate * 1000))/1000;
            $cfhtml.data('data',{methodid:mid,nums:nums,money:money,modes:modes,poschoose:cur_position,basemoney:basemoney,prize:pz,code:temp.join("|")});
            //把投注内容记录到临时数组中，用于判断是否有重复
            if( $.lt_same_code[mid] == undefined ){
                    $.lt_same_code[mid] = [];
            }
            if( $.lt_same_code[mid][modes] == undefined ){
                    $.lt_same_code[mid][modes] = [];
            }
            if ($.lt_same_code[mid][modes][cur_position] == undefined) {
                $.lt_same_code[mid][modes][cur_position] = []
            }
            $.lt_same_code[mid][modes][cur_position].push(temp.join("|"));
            $('td',$cfhtml).filter(".del").find("a.del").click(function(){
                var n = $cfhtml.data('data').nums;
                var m = $cfhtml.data('data').money;
                var b = $cfhtml.data('data').basemoney;
                var c = $cfhtml.data('data').code;
                var d = $cfhtml.data('data').methodid;
                var f = $cfhtml.data('data').modes;
				var p = $cfhtml.data("data").poschoose;
                var i = null;
                //移除临时数组中该投注内容，用于判断是否有重复
                $.each($.lt_same_code[d][f][p],function(k,code){
                    if( code == c ){
                        i = k;
                    }
                });
                if( i != null ){
                    $.lt_same_code[d][f][p].splice(i,1);
                }else{
                    $.alert(lot_lang.am_s27);
                    return;
                }
                $.lt_total_nums  -= n;//总注数减少
                $.lt_total_money -= m;//总金额减少
                $.lt_total_money = Math.round($.lt_total_money*1000)/1000;
                $.lt_trace_base  = Math.round(($.lt_trace_base-b)*1000)/1000;
                $(this).parent().parent().remove();
                $($.lt_id_data.id_cf_num).html($.lt_total_nums);//更新总注数显示
                $($.lt_id_data.id_cf_money).html($.lt_total_money);//更新总金额显示
                $($.lt_id_data.id_cf_count).html(parseInt($($.lt_id_data.id_cf_count).html(),10)-1);//总投注项减1
                cleanTraceIssue();//清空追号区数据
				//追号相关
				$(".fqzhBox span").removeClass().addClass("uncheck");
				$(".fqzhBox span").siblings("input[type='checkbox']").prop("checked",false);
				$(".tzzhBox span").removeClass().addClass("uncheck");
				$(".tzzhBox span").siblings("input[type='checkbox']").prop("checked",false);

				/*全清功能*/
				showClearAll();
            });
            //把所选模式存入cookie里面
            setCookie('modes',modes,86400);
            //成功添加以后清空选号区数据
            for( i=0; i<data_sel.length; i++ ){//清空已选择数据
                data_sel[i] = [];
            }
            if( otype == 'input' ){//清空所有显示的数据
                $("#lt_write_box",$(me)).val("");
            }
            else if( otype == 'digital' || otype == 'dxds' || otype == 'dds' ){
				if(methodname === 'PK10JS'){
					$(".pk10_fast .nList").empty();
					$(".pk10_slow .nList").empty();
            	}else{
	                $.each($(".nList li",$(me)).filter(".hover"),function(i,n){
	                	$(this).removeClass("hover");
					});
            	}
            }
            //还原倍数为1倍
            //$($.lt_id_data.id_sel_times).val(1);sean倍数
			select_init();
            checkNum();
            //清空追号区数据
            cleanTraceIssue();
			//追号相关
			$(".fqzhBox span").removeClass().addClass("uncheck");
			$(".fqzhBox span").siblings("input[type='checkbox']").prop("checked",false);
			$(".tzzhBox span").removeClass().addClass("uncheck");
			$(".tzzhBox span").siblings("input[type='checkbox']").prop("checked",false);

			/*全清功能*/
			showClearAll();
        });
		//select_init();
    };
	function select_init(){
		if(is_select){
			$($.lt_id_data.id_beishuselect)[0].selectedIndex=0;
		}else{
			//$("input[name='lt_project_modes']:eq(0)").attr("checked",'checked');
		}
	}

	/*全清功能*/
	function showClearAll(){
		var numtotal = $($.lt_id_data.id_cf_count).text();
		if(numtotal > 0){
			//$(".lotteryList tr.cleanall").show();
			$(".lotteryList a.cleanall").click(function(){
				var num = $($.lt_id_data.id_cf_content + " tr.lottery a.del").length;
				if(num > 0){
					$.each($($.lt_id_data.id_cf_content + " tr.lottery a.del"),function(i,v){
						$(v).trigger('click');
					});
				}
			});
		}else{
			//$(".lotteryList tr.cleanall").hide();
		}
        $(".cList li").removeClass("hover");
		$.gameBtn();
	}

    $(document).click(function(){
        var sid = window.showid;
        var $this = $("#div_slow_id_"+sid);
        var isHidden = $this.is(":hidden");
        if(!isHidden){
            $this.css("display","none");
        }
    });
    $(".code").live("click",function(e){
        e = e || window.event || arguments.callee.caller.arguments[0];
        e.stopPropagation();
    });
})(jQuery);
function div_slow_show(showslow_id){
    var e = window.event || arguments.callee.caller.arguments[0];
    e.stopPropagation();
    window.showid = showslow_id;
    var $this= $("#div_slow_id_"+showslow_id);
    var _top = 5 - $(".lotteryList").scrollTop();
	$('.lotteryList table tr.lottery th .more').hide();
    $this.css("margin-top",_top);
	$this.show();
}
function div_slow_hide(showslow_id){
	$("#div_slow_id_"+showslow_id).hide();
}
