var T,S,KT,KS;


function gameKanJiangDataC(diffTime, actionNo){
	
	var $dom=$('#pre-kanjiang');
	
		
	var m=Math.floor(diffTime % 60),
	s=(diffTime---m)/60,
	h=0;
	if(s<10){
		s="0"+s;
	}
	if(m<10){
		m="0"+m;
	}
	if(s>60){
		h=Math.floor(s/60);
		s=s-h*60;
		$dom.text((h<10?"0"+h:h)+":"+(s<10?"0"+s:s)+":"+m);
	}else{
		h=0;
		$dom.text("00:"+s+":"+m);
	}
	

}

function gameKanJiangDataCq(diffTime, actionNo){
	var $dom=$('#kanjiang');

	if(diffTime<=0){

	$dom.text('00:00:00');
		
	}else{
	
	var m=Math.floor(diffTime % 60),
	s=(diffTime---m)/60,
	h=0;
	if(s<10){
		s="0"+s;
	}
	if(m<10){
		m="0"+m;
	}
	if(s>60){
		h=Math.floor(s/60);
		s=s-h*60;
		$dom.text((h<10?"0"+h:h)+":"+(s<10?"0"+s:s)+":"+m);
	}else{
		h=0;
		$dom.text("00:"+s+":"+m);
	}
	if(S && h==0 && m==0 && s==0){
		
	}
	if(h==0 && m==0 && s==0){
		loadKjData();
	}else{
		if($.browser.msie){
			T=setTimeout(function(){
				gameKanJiangDataCq(diffTime);
			}, 1000);
		}else{
			T=setTimeout(gameKanJiangDataCq, 1000, diffTime);
		}
	}
  }
}

function gameKanJiangDataCpk(diffTime, actionNo){
	var $dom=$('#pk-kanjiang');

	if(diffTime<=0){

	$dom.text('00:00:00');
		
	}else{
	
	var m=Math.floor(diffTime % 60),
	s=(diffTime---m)/60,
	h=0;
	if(s<10){
		s="0"+s;
	}
	if(m<10){
		m="0"+m;
	}
	if(s>60){
		h=Math.floor(s/60);
		s=s-h*60;
		$dom.text((h<10?"0"+h:h)+":"+(s<10?"0"+s:s)+":"+m);
	}else{
		h=0;
		$dom.text("00:"+s+":"+m);
	}
	if(S && h==0 && m==0 && s==0){
		
	}
	if(h==0 && m==0 && s==0){
		loadKjData();
	}else{
		if($.browser.msie){
			T=setTimeout(function(){
				gameKanJiangDataCpk(diffTime);
			}, 1000);
		}else{
			T=setTimeout(gameKanJiangDataCpk, 1000, diffTime);
		}
	}
  }
}

function reloadMemberInfo(){
	$('.userinfo').load('/index.php/index/userInfo');
}
function msg(){
	$('.msg-num').load('/index.php/index/msg');
}
//{{{签到

function indexSign(err, data){
	$('#sign').css('display','none');
	if(err){
		$.alert(err);
	}else{
		reloadMemberInfo();
		$.alert(data);
	}
}