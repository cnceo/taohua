<?php

	//$lastNo=$this->getGameLastNo(1);
	
	//你應該把這個寫入一個文件裏，然後ajax每秒去請求最新的時間
	$actionNo=$this->getGameNo(5);
	//$types=$this->getTypes(5);
	//$kjdTime=$types[5]['data_ftime'];
	$diffTime=strtotime($actionNo['actionTime'])-$this->time-$kjdTime;
//	$kjDiffTime=strtotime($lastNo['actionTime'])-$this->time;
	//$user=$this->user['username'];
	//$sql="select type from {$this->prename}members where username='$user'";
//	$data=$this->getRow($sql);
	//$type=$data['type'];
?>  
<kanjiang style="display:none"><?=$diffTime?></kanjiang>
<script type="text/javascript">

$(function(diffTime){
	
	S=true;
					if(T) clearTimeout(T);
					KS=true;
					if(KT) clearTimeout(KT);
					
					TIME_CACHE={}
					
	setInterval(function(){
		
		$.get(location.href,function(r){
			
			var $dom=$('#kanjiang'),diffTime=parseInt($(r).find('kanjiang1').text());
		
			
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
			
			var $dom=$('#pre-kanjiang'),diffTime=parseInt($(r).find('kanjiang').text());
		
			
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
			
			
			var $dom=$('#pk-kanjiang'),diffTime=parseInt($(r).find('kanjiangpk').text());
		
			
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
	
		})
	}, 1000 );
	
	//倒計時結束後從這個時間從新開

});
</script>


<span class="hour wjtips"></span><span id="pre-kanjiang" class="minute"></span><span class="second"></span>
