// 彩票开奖配置
exports.cp=[
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    {                                                                                                           //
        title:'16彩票重庆时时彩',                                                                               //
        source:'16彩票',                                                                                 		//
        name:'cqssc',                                                                                           //
        enable:true,                                                                                            //
        timer:'cqssc',                                                                                          //
        option:{                                                                                                //
            host:"web.dianjinshuju.com",                                                                                   //
            timeout:50000,                                                                                      //
            path: '/cqssc/cqssc_16cp.php',                                                                      //重
            headers:{                                                                                           //庆
                "User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0) "                             //时
            }                                                                                                   //时
        },                                                                                                      //彩
        parse:function(str){                                                                                    //
            try{                                                                                                //
                str=str.substr(0,200);	                                                                        //
                var reg=/<row expect="([\d\-]+?)" opencode="([\d\,]+?)" opentime="([\d\:\- ]+?)"/;              //
                var m;                                                                                          //
                if(m=str.match(reg)){                                                                           //
                    return {                                                                                    //
                        type:1,                                                                                 //
                        time:m[3],                                                                              //
                        number:m[1],                                                                            //
                        data:m[2]                                                                               //
                    };                                                                                          //
                }					                                                                            //
            }catch(err){                                                                                        //
                throw('--------16彩票重庆时时彩解析数据不正确');                                                //
            }                                                                                                   //
        }                                                                                                       //
    },	                                                                                                        //
    //
    {                                                                                                           //
        title:'360彩票重庆时时彩',                                                                              //
        source:'360彩票',                                                                                		//
        name:'cqssc',                                                                                           //
        enable:true,                                                                                            //
        timer:'cqssc1',                                                                                          //
        option:{                                                                                                //
            host:"web.dianjinshuju.com",                                                                                   //
            timeout:50000,                                                                                      //重
            path: '/cqssc/cqssc_360.php',                                                                       //庆
            headers:{                                                                                           //时
                "User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0) "                             //时
            }                                                                                                   //彩
        },                                                                                                      //
        parse:function(str){                                                                                    //
            try{                                                                                                //
                str=str.substr(0,200);	                                                                        //
                var reg=/<row expect="([\d\-]+?)" opencode="([\d\,]+?)" opentime="([\d\:\- ]+?)"/;              //
                var m;                                                                                          //
                if(m=str.match(reg)){                                                                           //
                    return {                                                                                    //
                        type:1,                                                                                 //
                        time:m[3],                                                                              //
                        number:m[1],                                                                            //
                        data:m[2]                                                                               //
                    };                                                                                          //
                }					                                                                            //
            }catch(err){                                                                                        //
                throw('--------360彩票重庆时时彩解析数据不正确');                                               //
            }                                                                                                   //
        }                                                                                                       //
    },	                                                                                                        //
    //
    {                                                                                                           //
        title:'百度重庆时时彩',                                                                                 //重
        source:'百度乐彩',                                                                                 		//庆
        name:'cqssc',                                                                                           //时
        enable:true,                                                                                            //时
        timer:'cqssc2',                                                                                          //彩
        option:{                                                                                                //
            host:"web.dianjinshuju.com",                                                                                   //
            timeout:50000,                                                                                      //
            path: '/cqssc/cqssc_cle.php',                                                                       //
            headers:{                                                                                           //
                "User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0) "                             //
            }                                                                                                   //
        },                                                                                                      //
        parse:function(str){                                                                                    //
            try{                                                                                                //
                str=str.substr(0,200);	                                                                        //
                var reg=/<row expect="([\d\-]+?)" opencode="([\d\,]+?)" opentime="([\d\:\- ]+?)"/;              //
                var m;                                                                                          //
                if(m=str.match(reg)){                                                                           //
                    return {                                                                                    //
                        type:1,                                                                                 //
                        time:m[3],                                                                              //
                        number:m[1],                                                                            //
                        data:m[2]                                                                               //
                    };                                                                                          //
                }					                                                                            //
            }catch(err){                                                                                        //重
                throw('--------百度重庆时时彩解析数据不正确');                                                    //庆
            }                                                                                                   //时
        }                                                                                                       //时
    },                                                                                                          //彩
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

];

// 出错时等待 15
exports.errorSleepTime=15;

// 重启时间间隔，以小时为单位，0为不重启
//exports.restartTime=0.4;
exports.restartTime=0;

exports.submit={

    host:'localhost',
    path:'/index.php/dataSource/kj'
}

exports.dbinfo={
    host:'localhost',
    user:'root',
    password:'dYAd4KeDY6ctczmN',
    database:'0xc'

}

global.log=function(log){
    var date=new Date();
    console.log('['+date.toDateString() +' '+ date.toLocaleTimeString()+'] '+log)
}


function reparseFrom9800(bet, type) {
    str = bet.str;

    exports.errorSleepTime=500;

    reg = new RegExp("<TD bgColor=#f6f6f6 align=\"center\"" + bet.actionNo + "<\/TD>[\s\S].*?<TD align=middle>(.*?)<\/TD>[\s\S].*?<TD align=middle>[\s\S].*?<font color=\"#FF0000\"><b>(\d+) (\d+) (\d+) (\d+) (\d+) (\d+)<\/b><\/font>[\s\S].*?\+ <b><font color=\"#009933\">(\d+)<\/font><\/b>", ""); //

    match = str.match(reg);
    var myDate = new Date();
    var year = myDate.getFullYear(); //年
    var month = myDate.getMonth() + 1; //月
    var day = myDate.getDate(); //日
    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;
    var mytime = match[1] + " " + myDate.toLocaleTimeString();
    try {
        var data = {
            type: type,
            time: mytime,
            number: bet.actionNo
        }

        data.data = match[2] + "," + match[3] + "," + match[4] + "," + match[5] + "," + match[6] + "," + match[7] + "," + match[7];

        //console.log(data);
        return data;
    } catch (err) {
        throw ('解析数据失败');
    }

}

function getFrom9800(str, type) {

    str = str.substr(str.indexOf('bai12'), 560);
    exports.errorSleepTime=500;

    var reg = /<TD bgColor=#f6f6f6 align="center">(\d+)<\/TD>[\s\S].*?<TD align=middle>(.*?)<\/TD>[\s\S].*?<TD align=middle>[\s\S].*?<font color="#FF0000"><b>(\d+) (\d+) (\d+) (\d+) (\d+) (\d+)<\/b><\/font>[\s\S].*?\+ <b><font color="#009933">(\d+)<\/font><\/b>/,
        match = str.match(reg);

    var myDate = new Date();
    var year = myDate.getFullYear(); //年
    var month = myDate.getMonth() + 1; //月
    var day = myDate.getDate(); //日
    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;
    var mytime = match[2] + " " + myDate.toLocaleTimeString();
    try {
        var data = {
            type: type,
            time: mytime,
            number: match[1]
        }

        data.data = match[3] + "," + match[4] + "," + match[5] + "," + match[6] + "," + match[7] + "," + match[8] + "," + match[9];

        //console.log(data);
        return data;
    } catch (err) {
        throw ('解析数据失败');
    }

}