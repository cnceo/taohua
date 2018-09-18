// 收缩展开效果
$(document).ready(function(){
  // $(".box h1").toggle(function(){
  //   $(this).next(".text").animate({height: 'toggle', opacity: 'toggle'}, "slow");
 //  },function(){
//$(this).next(".text").animate({height: 'toggle', opacity: 'toggle'}, "slow");
   //});
	$("div.text").hide();//默认隐藏div，或者在样式表中添加.text{display:none}，推荐使用后者
	$(".box h1").click(function(){
		$(this).next(".text").slideToggle("slow");
	})
});
<!-- 收缩展开效果 -->

//代理日薪
function changeMoney(){
		if($("#checkGet").val()!==""){winjinAlert("活动未开启");return;}
		$uid=$('#uid').val();
		$coin= $('#coin').val();
		$val=parseFloat($('#salemoney').html());	
		//$val= 12000;
		var addmoney=0;
		if($val>=1000000000 && $val<30000){
			addmoney=100;
		}else if($val>=30000 && $val<50000){
			addmoney=300;
		}else if($val>=50000 && $val<100000){
			addmoney=500;
		}else if($val>=100000 && $val<200000){
			addmoney=1000;
		}else if($val>=200000 && $val<300000){
			addmoney=2000;
		}else if($val>=300000 && $val<500000){
			addmoney=3000;
		}else if($val>=500000 && $val<1000000){
			addmoney=5000;
		}else if($val>=1000000 && $val<2000000){
			addmoney=10000;
		}else if($val>=2000000 && $val<5000000){
			addmoney=20000;
		}else if($val>=5000000){
		    addmoney=40000;	
		}else{
			winjinAlert('活动未开启');return;
		}
		//alert(addmoney);
		$.ajax({
       //  url:"/activity.php", 
         type: "POST",
         data:{money:""+addmoney+"",uid:$uid,addmoney:""+$coin+""} , 
         success: function(data){	 
	        	if(data=='0'){
	        		winjinAlert('活动未开启');
	        	 }else{
				 	$("#checkGet").val('yes');
	        		winjinAlert('活动未开启');   
	        	 } 	  	 
         }
      });

	}
	
	//会员日薪
	function changeMoney1(){
		if($("#checkGet1").val()!=""){winjinAlert("活动未开启");return;}
		$uid=$('#uid').val();
		$coin= $('#coin').val();
		$val=parseFloat($('#salemoney2').html());	
		//$val= 12000;
		var addmoney=0;
		if($val>=100000000 && $val<3000){
			addmoney=18;
		}else if($val>=3000 && $val<6000){
			addmoney=28;
		}else if($val>=6000 && $val<8000){
			addmoney=38;
		}else if($val>=8000 && $val<10000){
			addmoney=58;
		}else if($val>=10000 && $val<20000){
			addmoney=88;
		}else if($val>=20000 && $val<30000){
			addmoney=118;
		}else if($val>=30000 && $val<50000){
			addmoney=188;
		}else if($val>=50000 && $val<100000){
			addmoney=288;
		}else if($val>=100000 && $val<200000){
			addmoney=588;
		}else if($val>=200000 && $val<300000){
			addmoney=1088;
		}else if($val>=300000){
		    addmoney=1688;	
		}else{
			winjinAlert('活动未开启');return;
		}
		//alert(addmoney);
		$.ajax({
         //url:"/ajaxMoney.php", 
         type: "POST",
         data:{money:""+addmoney+"",uid:$uid,addmoney:""+$coin+""}, 
         success: function(data){	 
	        	if(data=='0'){
	        		winjinAlert('活动未开启');
	        	 }else{
				 $("#checkGet1").val("yes");
	        		winjinAlert('活动未开启');   
	        	 } 	  	 
         }
      });

	}