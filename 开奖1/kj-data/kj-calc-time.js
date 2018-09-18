exports.cqssc=function(data){
	var actionNo=data.number.substr(9,3)-(-1);
	
	if(actionNo>120) actionNo=120;
	
	var conf=createTimeProcess();
	
	if(actionNo>=120) actionNo=1;
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000;  //重庆时时彩
}

function createTimeProcess(ht,mt,st){

   ht=ht||23; mt=mt||59; st=st||59;

   var timeTmp='',result=[];

    for(var h=0;h<=ht;h++)
      for(var m=0;m<=mt;m++)
        for(var s=0;s<=st;s++)
          timeTmp+=(h>9?h:'0'+h)+':'+(m>9?m:'0'+m)+':'+(s>9?s:'0'+s)+' '

    result=timeTmp.split(' ');

    result.pop();

   return result;

}

exports.cqssc1=function(data){
	var actionNo=data.number.substr(9,3)-(-1);
	
	if(actionNo>120) actionNo=120;
	//這下面呢 一樣
	var conf=createTimeProcess();
	
	if(actionNo>=120) actionNo=1;
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000;  //重庆时时彩1
}

exports.cqssc2=function(data){
	var actionNo=data.number.substr(9,3)-(-1);
	
	if(actionNo>120) actionNo=120;
	
	var conf=createTimeProcess();
	
	if(actionNo>=120) actionNo=1;
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000;  //重庆时时彩2
}

exports.xjssc=function(data){ //新疆时时彩
	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();

	if(actionNo>=96) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000;  //10ī۳
}

exports.tjssc=function(data){ //天津时时彩
	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();

	if(actionNo>=84) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000;  //天津时时彩
}


exports.gd11=function(data){ //广东11选5
	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();

	if(actionNo>=84) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000;  
}

exports.jx11=function(data){ //江西11选5
	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();

	if(actionNo>=84) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000;  
}

exports.sd11=function(data){ //山东11选5
	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();

	if(actionNo>=78) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000;  
}

exports.sh11=function(data){ //上海11选5
	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();

	if(actionNo>=90) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000;  
}


exports.fc3d=function(data){  //福彩3D
	var date=new Date(),
	time=date.getTime(),
	delay=100000;
	
	date.setSeconds(0);
	date.setHours(20);
	date.setMinutes(30);
	
	return date.getTime()-time+delay;
}
exports.pl3=function(data){  //排列3
	var date=new Date(),
	time=date.getTime(),
	delay=100000;
	
	date.setSeconds(0);
	date.setHours(20);
	date.setMinutes(30);
	
	return date.getTime()-time+delay;
}

exports.lhc=function(data){ //六合彩
	var date=new Date(),
	time=date.getTime(),
	delay=100000;
	
	date.setSeconds(0);
	date.setHours(21);
	date.setMinutes(40);
	
	return date.getTime()-time+delay;
	return 10000;  
}

exports.bjpk10=function(data){  //北京PK10
	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();

	if(actionNo>=179) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000;  
}

exports.bjkl8=function(data){  //北京快乐8
	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();

	if(actionNo>=179) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000;  
}

exports.jsk3=function(data){ //江苏快3
	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();

	if(actionNo>=82) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000;  
}

exports.qtllc=function(data){ //5分彩

	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();
	
	if(actionNo>=288) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000;  
}

exports.lfc=function(data){ //2分彩
	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();

	if(actionNo>=720) actionNo=1;
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000;  
}

exports.ffc=function(data){ //分分彩
	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();
	
	if(actionNo>=1440) actionNo=1;
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000; 
}

exports.bx15=function(data){ //巴西1.5分彩
	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();
	if(actionNo>=960) actionNo=1;
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000; 
}


exports.qt5fc=function(data){ //全天5分

	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();
	
	if(actionNo>=288) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000;  
}

exports.bxklc=function(data){ //巴西快乐彩

	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();
	
	if(actionNo>=288) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000; 
}

exports.gslhc=function(data){ //高速六合彩

	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();
	
	if(actionNo>=288) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000; 
}

exports.tw3d=function(data){ //台湾3D

	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();
	
	if(actionNo>=288) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000;  
}

exports.am3d=function(data){ //澳门3D

	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();
	
	if(actionNo>=288) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000; 
}

exports.twk3=function(data){ //台湾快3

	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();
	
	if(actionNo>=288) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000; 
}

exports.amk3=function(data){  //澳门快3

	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();
	
	if(actionNo>=288) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000; 
}

exports.twklsf=function(data){ //台湾快乐十分

	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();
	
	if(actionNo>=288) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000; 
}

exports.amklsf=function(data){ //澳门快乐十分

	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();
	
	if(actionNo>=288) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000;  
}

exports.tw11=function(data){ //台湾11选5

	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();
	
	if(actionNo>=288) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000;  
}

exports.am11=function(data){ //澳门11选5

	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();
	
	if(actionNo>=288) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000; 
}

exports.twpk10=function(data){ //台湾PK10

	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();
	
	if(actionNo>=288) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000;
}

exports.ampk10=function(data){ //澳门PK10

	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();
	
	if(actionNo>=288) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000; 
}

exports.hgkl8=function(data){ //韩国快乐8

	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();
	
	if(actionNo>=288) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000;  
}

exports.amkl8=function(data){ //澳门快乐8

	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();
	
	if(actionNo>=288) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000; 
}

exports.twssc=function(data){ //台湾时时彩

	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();
	
	if(actionNo>=288) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000; 
}

exports.amssc=function(data){ //澳门时时彩

	var actionNo=data.number.substr(9,3)-(-1);
	var conf=createTimeProcess();
	
	if(actionNo>=288) actionNo=1;
	//console.log(actionNo);
	var d=conf[actionNo-1].split(':');
	var date=new Date();
	var time=date.getTime();
	var delay=10000;
	date.setSeconds(0);
	date.setHours(d[0]);
	date.setMinutes(d[1]);
	return 10000;  
}