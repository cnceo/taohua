$(function(){
	$.globelData.init();
})

//获取数据
$.globelData = {
    "bigJson" : { 
    /*"lottery_12" : {"lotteryid":12,"uType":"ssc","runTime":"1160","issue":"20140928-018","lotteryName":"12天天时时彩","code":"80652","totalTime":"300"},
    "lottery_23" : {"lotteryid":23,"uType":"ssc","runTime":"862","issue":"20140928-018","lotteryName":"23天天时时彩","code":"80652","totalTime":"300"}*/
    },
    //是否已经渲染过页面
    "reviewStatus" : false,
    //获Bigjson的方法
    "getBigJson" : function(_type){
      var _this = this;
      var v = Math.random();
      if(pushServiceObj.pushStatus == "1"){//如果开启了推送
        if(_type == "init"){//初始化
          $.ajax({
            type:'GET',
            url:'./?controller=default&action=getalllotteryjson&v=' + v,
            dataType:'json',
            success:function(json){
              if(typeof json.data.lottery_list == "object"){
                //赋值数据给大json
                $.globelData.bigJson = json.data.lottery_list;
                //开启定时器
                $.globelTimer.init();
                $.globelData.reviewStatus = true;
                return false;
              }

              alert("bigJson异常");
            }
          })
        }
        if(_type == "update"){
          //赋值数据给大json
          //$.globelData.bigJson = json.data.lottery_list;
          //定时器重置
          //$.globelTimer.reSet();
          return false;
        }
      }else{//轮训过程
        $.ajax({
          type:'GET',
          url:'./?controller=default&action=getalllotteryjson&v=' + v,
          dataType:'json',
          success:function(json){
            if(json.errno == "0"){//没有出错
              if(json.data.push_enabled == "1" && (pushServiceObj.pushServerStatus == "good" || pushServiceObj.pushServerStatus == "warning")){//如果再次开启推送,并且推送服务器是正常工作的情况下
                pushServiceObj.pushStatus = "1";
                if(json.data.push_server_host != pushServiceObj.pushServerHost){
                  pushServiceObj.pushServerHost = json.data.push_server_host;
                  pushInit(pushServiceObj.pushServerHost);
                }else{
                  if(typeof pushstream === 'object'){
                    pushstream.connect();
                  }
                }
              }else{
                if(typeof json.data.lottery_list == "object"){
                  if(_type == "init"){//初始化
                    //赋值数据给大json
                    $.globelData.bigJson = json.data.lottery_list;
                    //开启定时器
                    $.globelTimer.init();
                    $.globelData.reviewStatus = true;
                  }
                  if(_type == "update"){//初始化
                    //赋值数据给大json
                    $.globelData.bigJson = json.data.lottery_list;
                    //定时器重置
                    $.globelTimer.reSet();
                  }
                }else{
                  alert("bigJson异常");
                }
              }
            }else{//出错 打印出错信息
              alert(json.error);
            }
            
          }
        })
      }

      
    },
    init : function(){
      var _this = this;
      _this.getBigJson("init");
    }
  }

  $.caipiaoGame = {
	'sideBarFun' : function(){
		var _sideBar = ['24','1','19','25'],
			_time,
			_minute,
			_second,
      _issue,
      is_sale;
		/*sideBar处理*/
		$.each(_sideBar,function(index,value){
			if(typeof $.globelData.bigJson['lottery_' + value] === 'object'){
				_time = $.globelTimer.getLotteryTime('L-' + value);
        _issue = $.globelData.bigJson['lottery_' + value]['issue'];
        is_sale = $.globelData.bigJson['lottery_' + value]['is_sale'];
        _hour = _time.split($.globelFun.spCode)[0];
				_minute = _time.split($.globelFun.spCode)[1];
				_second = _time.split($.globelFun.spCode)[2];
        if(value == 1){
          if(_hour != "00"){
            $("#lottery_L-" + value + " .hour").html(_hour+":");
          }
        }
				$("#lottery_L-" + value + " .minute").html(_minute);
				$("#lottery_L-" + value + " .second").html(_second);
        //$("#lottery_L-" + value + " .issue").html(_issue);
        if(is_sale === false){
          $("#lottery_L-" + value + " .issue").closest("p").html("<span class='issue'>未到销售时间</span>");
        }else{
          $("#lottery_L-" + value + " .issue").closest("p").html("<span class='issue'>本期</span>销售截止");
        }
			};
		});
	}
  }

  //定时器
  $.globelTimer = {
    runSecond : 0,
    cycle : 60,//60秒为一个周期
    lotteryName : "",//记录当前选择的彩种
    reSet : function(){
      var _this = this;
      $.globelTimer.runSecond = 0;
      _this.init();
    },
    setLotteryName : function(name){
      if(name.indexOf("L") != -1){
        this.lotteryName = name;
      }else{
        this.lotteryName = "";
      }
    },
    timer : null,
    //定时器发送数据控制
    postDataFun : function(){
      var _this = this;
      $.globelTimer.runSecond++;
      $.globelTimer.timeDoFun($.globelTimer.cycle,$.globelData.getBigJson,"update");
      //写入倒计时
      $.caipiaoGame.sideBarFun();
    },
    getLotteryTime : function(str){
      var ID = str.split("-")[1];
      var tag = "lottery_" + ID;
      var runTime = parseInt($.globelData.bigJson[tag].runTime);
      var totalTime = parseInt($.globelData.bigJson[tag].totalTime);
      var second = 0;
      second = runTime - $.globelTimer.runSecond;
      //console.log(totalTime);
      if( second < 0){
        second = (runTime + totalTime - ($.globelTimer.runSecond%totalTime))%totalTime;
      }
      //console.log(second);
      return $.globelFun.showTime(second);
    },
    getLotterySecond : function(str){
      var ID = str.split("-")[1];
      var tag = "lottery_" + ID;
      var runTime = parseInt($.globelData.bigJson[tag].runTime);
      var totalTime = parseInt($.globelData.bigJson[tag].totalTime);
      var second = 0;
      second = runTime - $.globelTimer.runSecond;
      //console.log(totalTime);
      if( second < 0){
        second = (runTime + totalTime - ($.globelTimer.runSecond%totalTime))%totalTime;
      }
      //console.log(second);
      return second;
    },
    timeDoFun : function(second,fun,arguments){
      //在指定的时间内做相关操作
      if(typeof fun != "function" || second < 0){
        alert("参数非法");
        return false;
      }
      //alert(typeof fun);
      if($.globelTimer.runSecond % second == 0){
        if(typeof arguments == "string"){
          fun(arguments);
        }else{
          fun();
        }
      }
    },
    init : function(){
      window.clearInterval($.globelTimer.timer);
      $.globelTimer.timer = window.setInterval($.globelTimer.postDataFun,1000);
    }
  };

  //页面全局方法管理---------------------------------------------------------------------------------------
  $.globelFun = {
    spCode : ":",
    //倒计时时间返回
    showTime : function(second){
      var second = isNaN(second)?0:parseInt(second);
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
      //}
      minute = (minute == 0) ? "00" : minute;
      minute = (minute > 0 && minute < 10 && minute != "00") ? "0" + minute + this.spCode : minute + this.spCode;
      sec = (sec == 0) ? "00" : sec;
      sec = (sec > 0 && sec < 10 && sec != "00") ? "0" + sec : sec;
      //return day + hour + minute + sec;
      return hour + minute + sec;
      //return minute + sec;  
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