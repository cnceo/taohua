<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=9">
<title>杏彩游戏平台  - 公告列表 </title>
<link href='/skin/main/bl_gg.css' rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/css/nsc/reset.css?v=1.16.11.8">
<link rel="stylesheet" href="/css/nsc/list.css?v=1.16.11.8">
<link rel="stylesheet" href="/css/nsc/activity.css?v=1.16.11.8">
<script type="text/javascript" src="/js/nsc/jquery-1.7.min.js?v=1.16.11.8"></script>
<script type="text/javascript" src="/js/nsc/main.js?v=1.16.11.8"></script>

<!--//日历-->
</head>
<body>
 <?php
$cout   = 0;
$styles = array(
    'tr_line_2_a',
    'tr_line_2_b'
);
if ($args[0]['data']) {
?>
<div class="mask_list">
<div>加载中，请稍后...</div>
</div>
<div id="subContent_bet_re">
<div class="help_notice">
        <div class="help_notice_r">
        	<h2><span></span>系统公告</h2>
			
            <div class="notice_sidebar_box">
			
            <ul id="newsList">
				<?php
    
    $bool = true;
    foreach ($args[0]['data'] as $var) {
        if ($bool) {
            $bool = false;
            $val  = $var;
        }
        $cout += 1;
        $mod = $cout % 2;
?>
         <li><a href="/index.php/notice/view/<?= $var['id'] ?>" target="main_Frame">
	<font class="text"><?= $var['title'] ?></font><span class="st">[<?=date('Y-m-d', $var['addTime'])?>]</span></a></li>
                           <?php
    }
?>
                        </ul>    
   <div class="newsPages">        
   <?php $this->display('inc_page.php', 0, $args[0]['total'], $this->pageSize, "/index.php/notice/info-{page}", 0); ?>
</div>
 <?php
} else {
?>
		<center>暂时没有相关没有记录</center>
 <?php
}
?>		
				
         
          </div>
          
        </div>
        
        <div class="help_notice_l">
        <ul>
            <li>
                            <iframe src="/index.php/notice/view/<?= $var['id'] ?>" allowtransparency="true" name="main_Frame" id="main_Frame" width="100%" scrolling="no" frameborder="0" border="0" noresize="noresize" framespacing="0" class="scroll_bar" style="height: 594px;"></iframe>
                         </li>
        </ul>
        </div>
</div>
</div>
<script>
$(function(){
//    location.href='/?controller=help&action=notice&nid=';
    $("#newsList a").click(function(){
        $("#main_Frame").contents().find(".mask_list").show();
        $("#newsList li").removeClass();
        $(this).parent().addClass("li_avtie");
    });
    var _h=parseInt($("body").height())>480?$("body").height():480;

    $("#main_Frame").height(_h);
})
</script>

&#65279;</div>
<div style="clear: both"></div>
<script type="text/javascript" src="/js/nsc/soundBox.js?v=1.16.11.8"></script>
<script type="text/javascript" src="/js/nsc/base.js?v=1.16.11.8"></script>
<script>
	$(function(){
		$(".noticeL a")	.live("click",function(){
			var tourl=$(this).attr("tourl");
			$('#noticeV').load(tourl);
			return false;
		})
	})
</script>
</body></html>