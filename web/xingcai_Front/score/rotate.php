<?php $this->display('inc_daohang.php'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/skin/css/dzp.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="/css/nsc/huodong.css?v=1.16.11.6" />
    </head>
    <body>

        <div id="contentBox" class="activity_main">
            <div class="right_meun" id="siderbar">
                <div class="r_tit-bg">
				<h3 class="r_tit">热门活动</h3>
				</div>
                <ul>
			        	<li class="current">
			                <a href="/index.php/score/rotate">幸运大转盘</a>
			            </li>
						<li >
			                <a href="/index.php/score/zadan">幸运砸蛋</a>
			            </li>
						<li >
			                <a href="/index.php/score/dodzyh">投资理财</a>
			            </li>
						<li >
			                <a href="/index.php/score/goods/current">积分兑换</a>
			            </li>
						<li >
			                <a href="/index.php/event/index">充值福利</a>
			            </li>
						<li >
			                <a href="/index.php/score/yongjin">新至尊佣金活动</a>
			            </li>
			            <li >
			                <a href="/index.php/score/chuangguan">VIP返利活动</a>
			            </li>
			    </ul>
            </div>
            <div class="left_activity">

<div id="subContent_bet_re">
<div class="activity_content">

    <!--div class="activity_banner" style="background:url(/images/nsc/activity/activity_banner02.jpg) no-repeat center top;"></div-->
    <div class="activity_title">
    	<h2>幸运大转盘</h2>
        		
		    </div>

			</div>
			
			
			
			
<div class="content3 wjcont">
 <div class="body" style="background:#e53030;">
    <!--main content start-->
    <div style="width:880px; margin:0 auto; overflow:hidden;">
    <div class="con_chouj">
        <div class="con_width chouj_content clearfix" id="lottery_content_box">
            <div class="chou_box" id="start"><div class="cj_zhuan" id="startbtn" tit="使用 <?=$this->dzpsettings['score']?> 积分兑换一次抽奖，是否确定继续抽奖？"></div></div>
            <div class="win_open">
                     <!-- 中奖列表begin -->
                    <div class="win_box">
                        <h2 class="win_tit">最新中奖名单</h2>
                        <div class="win_cont">
                            <div class="win_scroll" id="lottery_list_container_0">
                                <div class="win_height">
                                <marquee direction="up" scrolldelay="0" scrollamount="3" loop="-1" height="340">
						<?php 
								         $data=$this->getRows("select s.*,u.username from {$this->prename}dzp_swap s, {$this->prename}members u where s.uid=u.uid order by s.swapTime desc");
										 foreach($data as $var){
                                            echo '<li><span style="color: #fff;font-family: Microsoft YaHei;">恭喜用户【'.preg_replace('/^(\w{2}).*(\w{2})$/','\1***\2',htmlspecialchars($var['username'])).'】，喜中</span><em style="color: #FFFF00;font-family: Microsoft YaHei;font-size: 20px;">'.$var['coin'].'</em><em style="color: #fff;">元现金</em></li>';
								         }
								   ?>
												</marquee>
                                    <div id="lottery_list_container_2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 中奖列表end -->
					<div class="win_caption">
 	               <h3 style="font-size:15px">&nbsp&nbsp抽奖活动说明：</h3>
                     <ul>
                        <span class="scoreinfo"><?php $this->display('score/reloadscore.php');?></span>
                        <li>3、积分不足不能参与抽奖活动，抽奖次数不限；</li>
                     
                       
                   </ul>
		</div>
			</div>
		</div></div></div></div></div></div>	

<script type="text/javascript" src="/skin/js/jQueryRotate.2.2.js"></script>
<script type="text/javascript" src="/skin/js/jquery.easing.min.js"></script>

<script type="text/javascript">
$(function(){ 
     $("#startbtn").live("click",function(){ 
	    var title=$(this).attr("tit");
		if(confirm(title)){ 
			lottery(); 
		}
    }); 

}); 
function lottery(){ 
    $.ajax({ 
        type: 'POST', 
        url: '/index.php/score/rotateEvent', 
        dataType: 'json', 
        cache: false, 
        error: function(){ 
            $.alert('出错了！'); 
        }, 
        success:function(json){
			$('.scoreinfo').load('/index.php/score/scoreInfo');
            $("#startbtn").unbind('click').css("cursor","default");
            var a = json.angle; //角度
            var p = json.prize; //奖项 
			if(parseInt(a)==0){
				$.alert(p);
			}else{
            $("#startbtn").rotate({ 
                duration:3000, //转动时间 
                angle: 0, 
                animateTo:1800+a, //转动角度 
                easing: $.easing.easeOutSine, 
                callback: function(){ 
					if(p=='谢谢参与' || p=='再接再厉'){
						$.alert(p+'！'); 
					}else if(p=='再来一次'){
						if(confirm('再来一次！')){ 
							lottery(); 
						}else{ 
							//return false; 
						} 
					}else{
						$.alert('恭喜你，中得'+p+'！'); 
						parent.reloadMemberInfo();
					}
                } 
            });
		   }
        } 
    });
} 
</script>			
	</div></div>
<?php $this->display('inc_che.php'); ?>

</body>
</html>
