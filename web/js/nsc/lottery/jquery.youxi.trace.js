;(function($){//start
	//追号区
    $.fn.lt_trace = function(){
        var t_type  = 'margin';//追号形式[利润率:margin,同倍:same,翻倍:diff]
		if(lotterytype==3){
			t_type = 'same';//北京快乐吧默认同倍追号
		}
        $.extend({
            lt_trace_issue: 0,//总追号期数
            lt_trace_money: 0//总追号金额
            });
        var t_count = $.lt_issues.tomorrow.length;//可追号期数
        var t_nowpos= 0;//当前起始期在追号列表的位置[超过该位置的就不在处理,优化等待时间]
        //装载可追号期数
        $($.lt_id_data.id_tra_alct).html(t_count);
        //装载同倍、翻倍标签
        
        var htmllabel = '<ul><li class="hover"><a id="button111" href="javascript:void(0);">'+lot_lang.dec_s13+'</a></li><li><a id="button12" href="javascript:void(0);">'+lot_lang.dec_s10+'</a></li><li><a id="button13" href="javascript:void(0);">'+lot_lang.dec_s11+'</a></li></ul>';
        if(lotterytype==0||lotterytype==2){
        	var htmllabel = '<ul><li class="hover"><a id="button111" href="javascript:void(0);">'+lot_lang.dec_s13+'</a></li><li><a id="button12" href="javascript:void(0);">'+lot_lang.dec_s10+'</a></li><li><a id="button13" href="javascript:void(0);">'+lot_lang.dec_s11+'</a></li></ul>';
        }else if(lotterytype==3){
        	var htmllabel = '<ul><li class="hover"><a id="button12" href="javascript:void(0);">'+lot_lang.dec_s10+'</a></li><li><a id="button13" href="javascript:void(0);">'+lot_lang.dec_s11+'</a></li></ul>';
        }
		$(htmllabel).appendTo($.lt_id_data.id_tra_label);
		
		//lot_lang.dec_s14  起始倍数
		//lot_lang.dec_s15	追号期数
		//lot_lang.dec_s17  隔
		//lot_lang.dec_s18	期
		//lot_lang.dec_s2	倍
		//lot_lang.dec_s19	×
		//lot_lang.dec_s29	最低收益率
		/*
		<div class="group">
			<span>追号期数：</span>
			<div class="tools">
				<span class="reduce"></span><input type="text" /><span class="add"></span>
			</div>
		</div>
		*/
        var htmltext  = '<span id="lt_margin_html">' +
							'<div class="group">' + 
								'<span>' + lot_lang.dec_s14 + '：</span>' +
								'<div class="tools">' +
									'<span class="reduce"></span><input name="lt_trace_times_margin" type="text" id="lt_trace_times_margin" value="1" /><span class="add"></span>' +
								'</div>' +
							'</div>' +
							'<div class="group">' + 
								'<span>' + lot_lang.dec_s29 + '：</span>' +
								'<div class="tools">' +
									'<span class="reduce"></span><input name="lt_trace_margin" type="text" id="lt_trace_margin" value="50" /><span class="add"></span>' +
								'</div>' +
							'</div>' +
						'</span>';
		htmltext += '<span id="lt_sametime_html" style="display:none;">' +
						'<div class="group">' + 
							'<span>' + lot_lang.dec_s14 + '：</span>' +
							'<div class="tools">' +
								'<span class="reduce"></span><input name="lt_trace_times_same" type="text" id="lt_trace_times_same" value="1" /><span class="add"></span>' +
							'</div>' +
						'</div>' +
					'</span>';			

        htmltext += '<span id="lt_difftime_html" style="display:none;">' + 
						'<div class="group">' + 
							'<span>' + lot_lang.dec_s17 + '</span>' +
							'<div class="tools">' +
								'<span class="reduce"></span><input name="lt_trace_diff" type="text" id="lt_trace_diff" value="1" /><span class="add"></span>' +
							'</div>' +
							'<span>' + lot_lang.dec_s18 + '</span>' +
						'</div>' +
						'<div class="group">' + 
							'<span>' + lot_lang.dec_s2 + lot_lang.dec_s19 + '</span>' +
							'<div class="tools">' +
								'<span class="reduce"></span><input name="lt_trace_times_diff" type="text" id="lt_trace_times_diff" value="2" /><span class="add"></span>' +
							'</div>' +
						'</div>' +
					'</span>';
		htmltext += '<span>' + 
						'<div class="group">' + 
							'<span>' + lot_lang.dec_s15 + '：</span>' +
							'<div class="tools">' +
								'<span class="reduce"></span><input name="lt_trace_count_input" type="text" id="lt_trace_count_input" value="10" /><span class="add"></span>' +
							'</div>' +
							'<input type="hidden" id="lt_trace_money" name="lt_trace_money" value="0" />' + 
						'</div>' +
					'</span>';
        
        $(htmltext).appendTo($.lt_id_data.id_tra_lhtml);
		
		
		//追号加减号控制
		$(".group .reduce").unbind("click").click(function(){
			var input = $(this).parent().find("input");
			var v = $(input).val();
			v--;
			if(v<=0){
				v = 1;
			}
			$(input).val(v);
			return false
		});
		$(".group .add").unbind("click").click(function(){
			var input = $(this).parent().find("input");
			var v = $(input).val();
			v++;
			$(input).val(v);
			return false
		});
		
        $('#button111').click(function(){//利润率
                $('#lt_margin_html').show();
                $('#lt_sametime_html').hide();
                $('#lt_difftime_html').hide();
                t_type = 'margin';
				$(".zTab ul li").removeClass("hover");
				$(this).parent("li").addClass("hover");
        });
        $('#button12').click(function(){//同倍
                $('#lt_margin_html').hide();
                $('#lt_sametime_html').show();
                $('#lt_difftime_html').hide();
                t_type = 'same';
				$(".zTab ul li").removeClass("hover");
				$(this).parent("li").addClass("hover");
        });
		if(t_type == 'same'){
                $('#lt_margin_html').hide();
                $('#lt_sametime_html').show();
                $('#lt_difftime_html').hide();
		}
        $('#button13').click(function(){//翻倍
                $('#lt_margin_html').hide();
                $('#lt_sametime_html').hide();
                $('#lt_difftime_html').show();
                t_type = 'diff';
				$(".zTab ul li").removeClass("hover");
				$(this).parent("li").addClass("hover");
        });
        function upTraceCount(){//更新追号总期数和总金额
            $('#lt_trace_count').html($.lt_trace_issue);
            $('#lt_trace_hmoney').html(JsRound($.lt_trace_money,2,true));
            $('#lt_trace_money').val($.lt_trace_money);
        }
        
        //标签内的输入框键盘事件
        $("input",$($.lt_id_data.id_tra_lhtml)).keyup(function(){
            $(this).val( Number($(this).val().replace(/[^0-9]/g,"0")) );
        });

         $("#lt_trace_times_margin,#lt_trace_times_same,#lt_trace_times_diff").keydown(function(e){
            var times = parseInt($(this).val());
            if(times > 99999){
                e.preventDefault();
            }
        }).keyup(function(){
            var val = $(this).val().substr(0,5);
            $(this).val(val);
        });

        //追号期快捷选择事件
        $("#lt_trace_qissueno").change(function(){
            var t=0;
            if($(this).val() == 'all' ){//全部可追号奖期
                t = parseInt($($.lt_id_data.id_tra_alct).html(),10);
            }else{
                t = parseInt($(this).val(),10);
            }
            t = isNaN(t) ? 0 : t;
            $("#lt_trace_count_input").val(t);
        });
        
		
            /*<table cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <th></th>
                <th>追号</th>
                <th>奖期</th>
                <th>倍数</th>
                <th>金额</th>
                <th>开奖时间</th>
              </tr>
              <tr>
                <td><input type="checkbox" /></td>
                <td>1</td>
                <td>2014125-073</td>
                <td><input type="text" class="input"/>倍</td>
                <td><span class="red">¥ 8.00</span></td>
                <td>2014-11-25 18:09:05</td>
              </tr>
            </table>*/
        
        //装载追号的期号列表
        var issueshtml = '<table cellspacing="0" cellpadding="0" id="lt_trace_issues_today" width="100%">' +
						  '<tr>' +
							'<th></th>' +
							'<th>追号</th>' +
							'<th>奖期</th>' +
							'<th>倍数</th>' +
							'<th>金额</th>' +
							'<th>开奖时间</th>' +
						  '</tr>';
		
		var ii=0;
        $.each($.lt_issues.today,function(i,n){
			ii++;
            issueshtml += '<tr id="tr_trace_'+n.issue+'">' + 
							'<td>' + 
								'<input type="checkbox" name="lt_trace_issues[]" value="'+n.issue+'" />' + 
							'</td>' + 
							'<td>'+ii+'</td>' + 
							'<td>'+n.issue+'</td>' + 
							'<td><input name="lt_trace_times_'+n.issue+'" type="text" value="0" class="input" disabled/>'+lot_lang.dec_s2+'</td>' + 
							'<td><span class="red">'+lot_lang.dec_s20+'<span id="lt_trace_money_'+n.issue+'">0.00</span></span></td>' + 
							'<td>'+n.endtime+'</td>' + 
						 '</tr>';
        });
		//issueshtml += '</table><table border="0" cellspacing="0" cellpadding="0" id="lt_trace_issues_tom" class="formTable" width="100%">';
        var t = $.lt_issues.tomorrow.length-$.lt_issues.today.length;
		if($.lt_issues.today.length==0){
			$("#lottery_today_current").html('-');
			$("#lottery_today_surplus").html('-');
		}else{
			$("#lottery_today_current").html(t+1);
			$("#lottery_today_surplus").html($.lt_issues.today.length-1);
		}
		//alert($.lt_issues.today.length);
        $.each($.lt_issues.tomorrow,function(i,n){
        	if (i < t ){
				ii++;
				issueshtml += '<tr id="tr_trace_'+n.issue+'">' + 
								'<td>' + 
									'<input type="checkbox" name="lt_trace_issues[]" value="'+n.issue+'" />' + 
								'</td>' + 
								'<td>'+ii+'</td>' + 
								'<td>'+n.issue+'</td>' + 
								'<td><input name="lt_trace_times_'+n.issue+'" type="text" value="0" class="input" disabled/>'+lot_lang.dec_s2+'</td>' + 
								'<td><span class="red">'+lot_lang.dec_s20+'<span id="lt_trace_money_'+n.issue+'">0.00</span></span></td>' + 
								'<td>'+n.endtime+'</td>' + 
							  '</tr>';
        	}
        });
        issueshtml += '</table>';
        
        $(issueshtml).appendTo($.lt_id_data.id_tra_issues);
        function changeIssueCheck(obj){//选中或者取消某期
            var money = $.lt_trace_base;
            var $j = $(obj).closest("tr");
			//alert(obj);
			//alert($(obj).attr("checked"));
            if( $(obj).attr("checked") == 'checked' ){//选中
                $j.find("input[name^='lt_trace_times_']").val(1).attr("disabled",false).data("times",1);
                $j.find("span[id^='lt_trace_money_']").html(JsRound(money,2,true));
                $.lt_trace_issue++;
                $.lt_trace_money += money;
            }else{  //取消选中
                var t =$j.find("input[name^='lt_trace_times_']").val();
                $j.find("input[name^='lt_trace_times_']").val(0).attr("disabled",true).data("times",0);
                $j.find("span[id^='lt_trace_money_']").html('0.00');
                $.lt_trace_issue--;
                $.lt_trace_money -= money*parseInt(t,10);
            }
            $.lt_trace_money = JsRound($.lt_trace_money,2);
            upTraceCount();
        };
        $("input[name^='lt_trace_times_']",$($.lt_id_data.id_tra_issues)).keyup(function(){//每期的倍数变动
            var v = Number($(this).val().replace(/[^0-9]/g,"0"));
            $.lt_trace_money += $.lt_trace_base*(v-$(this).data('times'));
            upTraceCount();
            $(this).val(v).data("times",v);
            $(this).closest("tr").find("span[id^='lt_trace_money_']").html(JsRound($.lt_trace_base*v,2,true));
        });
        //$(":checkbox",$.lt_id_data.id_tra_issues).click(function(){//取消与选择某期
		$("input[type='checkbox'][name^='lt_trace_issues']").change(function(){//取消与选择某期
            changeIssueCheck(this);
        });
		
		
        var _initTraceByIssue = function(){//根据起始期的不同重新加载追号区
            var st_issue = $("#lt_issue_start").val();
            cleanTraceIssue();//清空追号方案
            var isshow   = false;//是否已经开始显示
            var acount   = 0;//不可追号期统计
            var loop     = 0;//循环次数
            var mins     = t_nowpos;//开始处理的位置[初始为上次变更的位置]
            var maxe     = t_nowpos;//结束处理的位置[初始为上次变更的位置]
            $.each($.lt_issues.today,function(i,n){
                loop++;
                if( isshow == false && st_issue == n.issue ){//如果选择的期数为当前期，则开始显示
                    isshow = true;
                    $($.lt_id_data.id_tra_today).click();
                }
                if( isshow == false ){
                    acount++;
                    maxe = Math.max(maxe,acount);//取最大的位置
                }else{
                    mins = Math.min(mins,acount);//取最小位置
                }
                if( loop >= mins && loop <= maxe ){//如果没有超过要处理的最大数，则继续处理
                    if( isshow == true ){//显示
                        $("#tr_trace_"+n.issue,$($.lt_id_data.id_tra_issues)).show();
                    }else{//隐藏
                        $("#tr_trace_"+n.issue,$($.lt_id_data.id_tra_issues)).hide();
                    }
                }
                if( loop > maxe ){//超过则退出不再处理
                    return false;
                }
            });
            $.each($.lt_issues.tomorrow,function(i,n){
                loop++;
                if( isshow == false && st_issue == n.issue ){//如果选择的期数为当前期，则开始显示
                    isshow = true;
                    $($.lt_id_data.id_tra_tom).click();
                }
                if( isshow == false ){
                    acount++;
                    maxe = Math.max(maxe,acount);
                }else{
                    mins = Math.min(mins,acount);//取最小位置
                }
                if( loop >= mins && loop <= maxe ){//如果没有超过要处理的最大数，则继续处理
                    if( isshow == true ){//显示
                        $("#tr_trace_"+n.issue,$($.lt_id_data.id_tra_issues)).show();
                    }else{//隐藏
                        $("#tr_trace_"+n.issue,$($.lt_id_data.id_tra_issues)).hide();
                    }
                }
                if( loop > maxe ){//超过则退出不再处理
                    return false;
                }
            });
            //更新可追号期数
            t_count = $.lt_issues.tomorrow.length - acount;
            if($("#lt_trace_qissueno").val()=='all'){
                $("#lt_trace_count_input").val(t_count);
            }
            t_nowpos = acount;
            $($.lt_id_data.id_tra_alct).html(t_count);
            //更新追号总期数和总金额
            $.lt_trace_issue = 0;
            $.lt_trace_money = 0;
            upTraceCount();
        };
        //起始期变动对追号区的影响
        $("#lt_issue_start").change(function(){
            if( $($.lt_id_data.id_tra_if).hasClass("clicked") == true ){//如果是选择了追号的情况才更新追号区
                _initTraceByIssue();
            }
        });

        $(".fqzhBox b").unbind().click(function(){
            $(".fqzhBox span").trigger('click');
        });
		
        //是否追号选择处理
        $(".fqzhBox span").unbind().click(function(){
            
            var blockOverlay = '<div class="blockOverlayBox" style="opacity: 0.8; z-index: 979; position: fixed; background-color: rgb(0, 0, 0);"></div>';

            if($(this).hasClass("uncheck")){//当前是未选中状态
                //检测是否有投注内容
                if( $.lt_total_nums <= 0 ){
                    $.alert(lot_lang.am_s7);
                    $(this).next("input[type='checkbox']").prop("checked",false);
                    return;
                }
                $("body").prepend(blockOverlay);

                //改变发起追号的样式
                $(this).removeClass().addClass("check");
                //改变发起追号的checkbox的选中状态
                $(this).next("input[type='checkbox']").prop("checked",true);
                
                //改变中奖后停止追号样式
                $(".tzzhBox").removeClass("disabled");
                $(".tzzhBox span").removeClass().addClass("check");
                $($.lt_id_data.id_tra_stop).prop("disabled",false).prop("checked",true);
                $($.lt_id_data.id_tra_box1).show();
                $($.lt_id_data.id_tra_ifb).prop("checked",true);
                _initTraceByIssue();
                $(window).scroll(function(){
                    zhBoxSet();
                })
                $(window).resize(function(){
                    zhBoxSet();
                })
            }else{
                //检测是否有投注内容
                var lt_trace_count_input = parseInt($("#lt_trace_count_input").val());
                if( lt_trace_count_input > 0 ){
                    $($.lt_id_data.id_tra_box1).show();
                    $("body").prepend(blockOverlay);
                    return;
                }
                $(this).removeClass().addClass("uncheck");
                $(this).next("input[type='checkbox']").prop("checked",false);
                
                //改变中奖后停止追号样式
                $(".tzzhBox").addClass("disabled");
                $(".tzzhBox span").removeClass().addClass("uncheck");
                $($.lt_id_data.id_tra_stop).prop("disabled",true).prop("checked",false);
                $($.lt_id_data.id_tra_box1).hide();
                $($.lt_id_data.id_tra_ifb).prop("checked",false);
            }
            //追号弹层修改
            $($.lt_id_data.id_tra_box1).show();
            zhBoxSet();
        });

        function zhBoxSet(){
            var topWidth ,zhBoxTop,windowWidth;
            topWidth = $($.lt_id_data.id_tra_box1).width();
            windowWidth = $("body").width();
            zhBoxTop = ($(window).height() - $('.zhBox').height())/2 + $(document).scrollTop();
            var left = (windowWidth-topWidth)/2;
            $($.lt_id_data.id_tra_box1).css({"position":"absolute","left": left + "px","top": zhBoxTop + "px","z-index":"980"});
        }
		//取消方案
		$(".cancel_zh,.qxzhBox").unbind().click(function(){
			zhCloseBox();
            //清空追号区数据
            cleanTraceIssue();
			//追号相关
			$(".fqzhBox span").removeClass().addClass("uncheck");
			$(".fqzhBox span").next("input[type='checkbox']").prop("checked",false);
			$(".tzzhBox").addClass("disabled");
			$(".tzzhBox span").removeClass().addClass("uncheck");
			$("#lt_trace_stop").prop("disabled",true).prop("checked",false);
			$($.lt_id_data.id_tra_ifb).prop("checked",false);
			//取消以后显示原先计算的金额
			$("#lt_cf_money").text($.lt_total_money);
            fnTraceAssert(false);
		});
		
		//关闭窗口
		$(".close_zhbox").unbind().click(function(){
			zhCloseBox();
            fnTraceAssert(false);
			//$(".fqzhBox span").trigger("click");
		});
		
		//保存方案
		$(".save_zh").unbind().click(function(){
			zhCloseBox();
			var lt_trace_hmoney = $("#lt_trace_hmoney").text();
			$("#lt_cf_money").text(lt_trace_hmoney);
            fnTraceAssert(true);
		});
		
		//关闭追号弹层
		function zhCloseBox(){
			$(".blockOverlayBox").remove();
			$($.lt_id_data.id_tra_box1).hide();
		}

        //追号判断非input
        function fnTraceAssert(type){
            if(type){
                $($.lt_id_data.id_tra_ifb).val("yes");
                $("#lt_trace_assert").val("yes");
            }else{
                $($.lt_id_data.id_tra_ifb).val("no");
                $("#lt_trace_assert").val("no");
            }
        }
		
		//中奖后停止追号处理
		$(".tzzhBox span").unbind().click(function(){
			if($(this).hasClass("uncheck") && $($.lt_id_data.id_tra_ifb).prop("checked") == true){//当前是未选中状态
				$(this).removeClass().addClass("check");
				$($.lt_id_data.id_tra_stop).prop("checked",true);
				return false;
			}
			if($(this).hasClass("check") && $($.lt_id_data.id_tra_ifb).prop("checked") == true){//当前是选中状态
				$(this).removeClass().addClass("uncheck");
				$($.lt_id_data.id_tra_stop).prop("checked",false);
				return false;
			}
		});
		
		

        //今天明天标签切换
        $($.lt_id_data.id_tra_today).click(function(){//今天
            if( $(this).attr("class") != "selected" ){
                $(this).attr("class","selected");
                $($.lt_id_data.id_tra_tom).attr("class","");
                $("#lt_trace_issues_today").show();
                $("#lt_trace_issues_tom").hide();
            }
        });
        $($.lt_id_data.id_tra_tom).click(function(){//明天
            if( $(this).attr("class") != "selected" ){
                $(this).attr("class","selected");
                $($.lt_id_data.id_tra_today).attr("class","");
                $("#lt_trace_issues_today").hide();
                $("#lt_trace_issues_tom").show();
            }
        });
        //根据利润率计算当期需要的倍数[起始倍数，利润率，单倍购买金额，历史购买金额，单倍奖金],返回倍数
        var computeByMargin = function(s,m,b,o,p){
            s = s ? parseInt(s,10) : 0;
            m = m ? parseInt(m,10) : 0;
            b = b ? Number(b) : 0;
            o = o ? Number(o) : 0;
            p = p ? Number(p) : 0;
            var t = 0;
            if( b > 0 ){
                if( m > 0 ){
                    t = Math.ceil( ((m/100+1)*o)/(p-(b*(m/100+1))) );
                }else{//无利润率
                    t = 1;
                }
                if( t < s ){//如果最小倍数小于起始倍数，则使用起始倍数
                    t = s;
                }
            }
            return t;
        };
        //立即生成按钮
        $($.lt_id_data.id_tra_ok).click(function(){
            var c = parseInt($.lt_total_nums,10);//总投注注数
            if( c <= 0 ){//无投注内容
                $.alert(lot_lang.am_s7);
                return false;
            }
            var p = 0;//奖金
            if( t_type == 'margin' ){//如果为利润率追号则首先检测是否支持
                var marmt = 0;
                var marmd = 0;
                var martype =0;//利润率支持情况，0:支持,1:玩法不支持，2:多玩法，3:多圆角模式
                $.each($('tr.lottery',$($.lt_id_data.id_cf_content)),function(i,n){
                    if( marmt != 0 && marmt != $(n).data('data').methodid ){
                        martype = 2;
                        return false;
                    }else{
                        marmt = $(n).data('data').methodid;
                    }
                    if( marmd != 0 && marmd != $(n).data('data').modes ){
                        martype = 3;
                        return false;
                    }else{
                        marmd = $(n).data('data').modes;
                    }
					//北京快乐吧：不支持利润率追号！
                    if( $(n).data('data').prize <= 0 || $.inArray($(n).data('data').methodid, [371,373,375,377,379,381,383]) > -1 ){
                        martype = 1;
                        return false;
                    }else{
                        p = $(n).data('data').prize;
                    }
                });
                if( martype == 1 ){
                    $.alert(lot_lang.am_s32);
                    return false;
                }else if( martype == 2 ){
                    $.alert(lot_lang.am_s31);
                    return false;
                }else if( martype == 3 ){
                    $.alert(lot_lang.am_s33);
                    return false;
                }
            }
            var ic = parseInt($("#lt_trace_count_input").val(),10);//追号总期数
            ic = isNaN(ic) ? 0 : ic;
            if( ic <= 0 ){//期数没有填
                $.alert(lot_lang.am_s8);
                return false;
            }
            if( ic > t_count ){//超过可追号期数
                $.alert(lot_lang.am_s9);
                $("#lt_trace_count_input").val(t_count);
                return false;
            }
            var times = parseInt($("#lt_trace_times_"+t_type).val(),10);//倍数，当前追号方式里的倍数
            times = isNaN(times) ? 0 : times;
            if( times <= 0 ){
                $.alert(lot_lang.am_s10);
                return false;
            }
            times = isNaN(times) ? 0 : times;
            var td = [];//根据用户填写的条件生成的每期数据
            var tm = 0;//生成后的总金额
            var msg='';//提示信息
            if( t_type == 'same' ){
                var m = $.lt_trace_base*times;//每期金额
                tm = m*ic;//总金额=每期金额*期数
                for( var i=0; i<ic; i++ ){
                    td.push({times:times,money:m});
                }
                msg = lot_lang.am_s12.replace("[times]",times);
            }else if( t_type == 'diff' ){
                var d = parseInt($("#lt_trace_diff").val(),10);//相隔期数
                d = isNaN(d) ? 0 : d;
                if( d <= 0 ){
                    $.alert(lot_lang.am_s11);
                    return false;
                }
                var m = $.lt_trace_base;//每期金额的初始值
                var t = 1;//起始倍数为1
                for( var i=0; i<ic; i++ ){
                    if( i!= 0 && (i%d) == 0  ){
                        t *= times;
                    }
                    td.push({times:t,money:m*t});
                    tm += m*t;
                }
                msg = lot_lang.am_s13.replace("[step]",d).replace("[times]",times);
            }else if( t_type == 'margin' ){//利润追号
                var e = parseInt($("#lt_trace_margin").val(),10);//最低利润率
                e = isNaN(e) ? 0 : e;
                if( e <= 0 ){
                    $.alert(lot_lang.am_s30);
                    return false;
                }
                var m = $.lt_trace_base;//每期金额的初始值
                if( e >= ((p*100/m)-100) ){
                    $.alert(lot_lang.am_s30);
                    return false;
                }
                var t = 0;//返回的倍数
                for( var i=0; i<ic; i++ ){
                    t = computeByMargin(times,e,m,tm,p);
                    td.push({times:t,money:m*t});
                    tm += m*t;
                }
                msg = lot_lang.am_s34.replace("[margin]",e).replace("[times]",times);
            }
            msg += lot_lang.am_s14.replace("[count]",ic);
            $.confirm(msg,function(){
                cleanTraceIssue();//清空以前的追号方案
                var $s = $("tr[id^='tr_trace_']",$($.lt_id_data.id_tra_issues));
                for( i=0; i<ic; i++ ){
                    $($s[i]).find(":checkbox").attr("checked",true);
                    $($s[i]).find("input[name^='lt_trace_times_']").val(td[i].times).attr("disabled",false).data("times",td[i].times);
                    $($s[i]).find("span[id^='lt_trace_money_']").html(JsRound(td[i].money,2,true));
                    $($s[i]).children().addClass("tmp");
                }
                $.lt_trace_issue = ic;
                $.lt_trace_money = tm;
                upTraceCount();
            },'','',300);
        });
    }
})(jQuery);