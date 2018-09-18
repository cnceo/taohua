<script type="text/javascript">
$(document).ready(function(){
    $("ul.nav li").click(function(){
		  $(this).find("div").slideToggle(100);
          $(this).toggleClass("navtionhover");
		  $(this).siblings("li").removeClass("navtionhover").find(".subnav").hide();
	});
});
</script>
<script type="text/javascript">
$(document).ready(function(){
	jQuery.navlevel2 = function(level1,dytime) {
	  $(level1).mouseenter(function(){
		  varthis = $(this);
		  delytime=setTimeout(function(){
			varthis.find('div').slideDown();
		},dytime);		
	  });
	  $(level1).mouseleave(function(){
		 clearTimeout(delytime);
		 $(this).find('div').slideUp();
	  });
	};
  $.navlevel2("li.mainlevel",100);
});
</script>
</div>
</div>
<div class="clear"></div>                           
</div>
<script type='text/javascript'>
 function zxkf(){
	 <?php if($this->settings['kefuStatus']){ ?>
	layer.open({
	  type: 2,
	  area: ['800px', '550px'],
	  zIndex:1999,
	  //fixed: false, //不固定
	  title:'在线客服',
	  scrollbar: false,//屏蔽滚动条
	  //maxmin: true,
	  content:'<?=$this->settings['kefuGG']?>'
	});
	<?php }else{?>
	$.alert("客服系统维护中");
	<?php }?>
	return false;
}
function qqkf(){
	<?php if($this->settings['qqkefuStatus']){ ?>
	layer.open({
	  type: 2,
	  area: ['800px', '550px'],
	  zIndex:1999,
	  //fixed: false, //不固定
	  title:'在线客服',
	  scrollbar: false,//屏蔽滚动条
	  //maxmin: true,
	  content:'http://wpa.qq.com/msgrd?uin=<?=$this->settings['qqkefuGG']?>'
	});
	<?php }else{?>
	$.alert("客服系统维护中");
	<?php }?>
	return false;
}
</script> 
