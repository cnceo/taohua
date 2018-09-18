<?php
ob_start('ob_output');
function ob_output($html) {
	// 一些用户喜欢使用windows笔记本编辑文件，因此在输出时需要检查是否包含BOM头
	if (ord(substr($html, 0, 1)) === 239 && ord(substr($html, 1, 2)) === 187 && ord(substr($html, 2, 1)) === 191) $html = substr($html, 3);
	// gzip输出
	if(
		!headers_sent() && // 如果页面头部信息还没有输出
		extension_loaded("zlib") && // 而且zlib扩展已经加载到PHP中
		array_key_exists('HTTP_ACCEPT_ENCODING', $_SERVER) &&
		stripos($_SERVER["HTTP_ACCEPT_ENCODING"], "gzip") !== false // 而且浏览器说它可以接受GZIP的页面 
	) {
		$html = gzencode($html, 3);
		header('Content-Encoding: gzip'); 
		header('Vary: Accept-Encoding');
	}
	header('Content-Length: '.strlen($html));
	return $html;
}

$id=array('1','5','12','14','26','60','61','62','75','76');
$pgsid=array('30','50','80','100','120','200','300','');
include(dirname(__FILE__)."/inc/comfunc.php");
//此处设置彩种id
$typeid=intval($_GET['typeid']);
if(!in_array($typeid,$id)) die("typeid error");
if(!$typeid) $typeid=14;
//每页默认显示
$pgs=intval($_GET['pgs']);
if(!in_array($pgs,$pgsid)) die("pgs error");
if(!$pgs) $pgs=30;
//当前页面
$page=intval($_GET['page']);
if(!$page) $page=1;
//传参
$toUrl="?page=";
$params=http_build_query($_REQUEST, '', '&');
if(!$mydb) $mydb = new MYSQL($dbconf);
$gRs = $mydb->row($conf['db']['prename']."type","shortName","id=".$typeid);
if($gRs){
	$shortName=$gRs[0][0];
}

$fromTime=$_GET['fromTime'];
$toTime=$_GET['toTime'];
?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:esun="" style="font-size: 15.525px;"><head>
<title>官方网站</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!--<meta http-equiv="refresh" content="5">-->
<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,user-scalable=no,maximum-scale=1.0">
<meta http-equiv="Pragma" content="no-cache">
<link rel="stylesheet" href="/css/nsc_m/list.css?v=1.17.2.1">
<link rel="stylesheet" href="css/line.css" type="text/css">
<link rel="stylesheet" href="/css/nsc_m/res.css?v=1.17.2.1">
<link href="/css/nsc_m/m-lottery.css?v=1.17.2.1" rel="stylesheet" type="text/css">

<script type="text/javascript" src="/js/nsc/jquery-1.7.min.js?v=1.17.2.1"></script>
<script language="javascript" type="text/javascript" src="js/line.js"></script>


<script type="text/javascript" src="/js/nsc_m/layer.js?v=1.17.2.1"></script><link href="/js/nsc_m/need/layer.css?2.0" type="text/css" rel="styleSheet" id="layermcss">
 <script type="text/javascript" src="/js/nsc/common.js?v=1.17.2.1"></script>
<link rel="stylesheet" href="/js/common/calendar/css/calendar-blue.css?v=1.17.2.1" type="text/css">
<style type="text/css">

html {overflow:-moz-scrollbars-vertical; overflow-y:scroll;}
</style>

<script type="text/javascript"> 
  $(function(){
    //切换漏号分析
      $('.lhfx_tit').click(function(e){
      $('.lhfx_lotterylist').toggle();
      $(document).on('click',function(){
        $('.lhfx_lotterylist').hide();
      });
      e.stopPropagation();

  });
  $('.lhfx_lotterylist').on('click',function(e){
    e.stopPropagation();
  });
})
  </script>

</head>
<body>
<div id="body">
<header class="header">
  <a class="m-return" href="javascript:window.history.back(-1);">返回</a>
  <div class="lhfx_tit"><span class="showAll"><?=$shortName?>--预测</span></div>
  <span class="btn-slide-bar"></span>
  <!-- <h1 class="page-title">header</h1> -->
</header>
<!--侧导航 -->
    <?php include 'include/daohan.php'; ?>
    <div class="shady"></div>
    <section class="wraper-page">
<div id="right_01">
<div class="right_01_01"></div>
</div>
<script language="javascript">
fw.onReady(function(){
	Chart.init();	
	DrawLine.bind("chartsTable","has_line");

		DrawLine.color('#499495');
	DrawLine.add((parseInt(0)*10+5+1),2,10,0);
		DrawLine.color('#E4A8A8');
	DrawLine.add((parseInt(1)*10+5+1),2,10,0);
		DrawLine.color('#499495');
	DrawLine.add((parseInt(2)*10+5+1),2,10,0);
		DrawLine.color('#E4A8A8');
	DrawLine.add((parseInt(3)*10+5+1),2,10,0);
		DrawLine.color('#499495');
	DrawLine.add((parseInt(4)*10+5+1),2,10,0);
		DrawLine.draw(Chart.ini.default_has_line);
	// if($("#chartsTable").width()>$('body').width())
	{
	   // $('body').width($("#chartsTable").width() + "px");
	}
	// $("#container").height($("#chartsTable").height() + "px");
	// $("#missedTable").width($("#chartsTable").width() + "px");
    resize();
	

	
	//最近多少期高亮
	var _num = "",_href;
	_href = window.location.href;
	_num = _href.match(/issuecount=(\d+)/);


});
function resize(){
    window.onresize = func;
    function func(){
        window.location.href=window.location.href;
    }
}
function daysBetween(start, end){
   var startY = start.substring(0, start.indexOf('-'));
   var startM = start.substring(start.indexOf('-')+1, start.lastIndexOf('-'));
   var startD = start.substring(start.lastIndexOf('-')+1, start.length);
  
   var endY = end.substring(0, end.indexOf('-'));
   var endM = end.substring(end.indexOf('-')+1, end.lastIndexOf('-'));
   var endD = end.substring(end.lastIndexOf('-')+1, end.length);
  
   var val = (Date.parse(endY+'/'+endM+'/'+endD)-Date.parse(startY+'/'+startM+'/'+startD))/86400000;
   return Math.abs(val);
}
function toggleMiss(){
    $('#missedTable').toggle();
}
</script>
<style>
	esun\:*{behavior:url(#default#VML)}
</style>

<div id="searchBox" style="background: #f8f8f8; padding:10px 0;">

    <div class="secondary_tabs">
        <ul>
            <li data="num_30" class="hover"><a href="?typeid=<?=$typeid?>&pgs=30" class="ml10<?php if($pgs==30) echo ' on'?>" target="_self">最近30期</a></li>
            <li data="num_50"><a href="?typeid=<?=$typeid?>&pgs=50" class="ml10<?php if($pgs==50) echo ' on'?>" target="_self">最近50期</a></li>
            <li data="num_100"><a href="?typeid=<?=$typeid?>&pgs=100" class="ml10<?php if($pgs==100) echo ' on'?>" target="_self">最近110期</a></li>
        </ul>
    </div>
    	<!-- <div class="lhfx_search_time">
		<form method="POST">
		<input type="hidden" name="controller" value="game">
		<input type="hidden" name="action" value="bonuscode">时间范围：<input type="text" value="" name="starttime" id="starttime" class="time_input"><span class="image"></span><label>至</label><input type="text" value="" name="endtime" id="endtime" class="time_input">
		<span class="image"></span><input type="submit" value="查询" id="showissue1" class="time_btn">
		</form>
	</div> -->
	<div class="clearfix"></div>
</div>

<div class="wo_choose" style="display:none"><span>标注形式选择</span><input type="checkbox" name="checkbox2" value="checkbox" id="has_line" class="no_bk-bg"><label for="has_line">显示走势折线</label>
    <!--<input type="checkbox" name="checkbox" value="checkbox" id="no_miss" onclick="toggleMiss();" /><span><b><label for="no_miss">不带遗漏数据</label></b></span>--></div>

<div style=" min-height:430px;" id="container">
	<table id="chartsTable" width="100%" cellpadding="0" cellspacing="0" border="0" style="display: table;">
    
       	       		<tbody>
		<tr id="title">
             <td style="width:20%;"><strong>期号</strong></td>
             <td style="width:25%;" colspan="5" class="redtext"><strong>开奖号码</strong></td>
             <td  class="redtext"><strong>预测</strong></td>
             <td  class="redtext"><strong>投注金额</strong></td>
             <td  class="redtext"><strong>盈亏</strong></td>
             <td  class="redtext"><strong>当天总盈亏</strong></td>
    	</tr>
		
		<?php
				if($fromTime) $fromTime=strtotime($fromTime);
				if($toTime) $toTime=strtotime($toTime)+24*3600;

                $touzhu = 2*5;
				
				$pg=trim($_REQUEST["page"]);
				if(!$pg){$pg=1;}
				if(!$pgs){$pgs=30;}
				$tableStr=$conf['db']['prename']."data";
				$tableStr2=$conf['db']['prename']."data a";
				$fieldsStr="time, number, data,func_ext,profit";
				
				$fieldsStr2="a.time, a.number, a.data, a.func_ext,a.profit";
				$whereStr=" type=$typeid ";
				$whereStr2=" a.type=$typeid ";
				if($fromTime && $toTime){
					$whereStr.=" and time between $fromTime and $toTime";
					$whereStr2.=" and a.time between $fromTime and $toTime";
				}elseif($fromTime){
					$whereStr.=' and time>='.$fromTime;
					$whereStr2.=' and a.time>='.$fromTime;
				}elseif($toTime){
					$whereStr.=' and time<'.$toTime;
					$whereStr2.=' and a.time<'.$toTime;
				}else{}
				$orderStr=" order by a.number desc";
	
				$totalNumber = $mydb->row_count($tableStr,$whereStr);

				if ($totalNumber>0){
			 
                $countcount=0;
				$perNumber=$pgs; //每页显示的记录数
				$page=$pg; //获得当前的页面值
				if (!isset($page)) $page=1;
				
				$totalPage=ceil($totalNumber/$perNumber); //计算出总页数
				$startCount=($page-1)*$perNumber; //分页开始,根据此方法计算出开始的记录
				$data = $mydb->row($tableStr2,$fieldsStr2,$whereStr2.' '.$orderStr." limit $startCount,$perNumber");



                 $oj = json_decode($data[0][3]);


                if($oj->QIANSHAN->currResult==1){
                    $yucedata1 = $oj->QIANSHAN->nextData;
                    $yucebeishu1 = $oj->QIANSHAN->nextBeishu;
                    $yuceprofit1 = $oj->QIANSHAN->nextProfit;
                }else if($oj->HOUSHAN->currResult==1){
                    $yucedata1 = $oj->HOUSHAN->nextData;
                    $yucebeishu1 = $oj->HOUSHAN->nextBeishu;
                    $yuceprofit1 = $oj->HOUSHAN->nextProfit;
                }else if($oj->ZHONGHE->currResult==1){
                    $yucedata1 = $oj->ZHONGHE->nextData;
                    $yucebeishu1 = $oj->ZHONGHE->nextBeishu;
                    $yuceprofit1 = $oj->ZHONGHE->nextProfit;
                }else{
                    $yucedata1 = "等";
                    $yucebeishu1 = "";
                    $yuceprofit1 = "";
                }

                echo '<tr>';
                echo '<td id="title">下一期</td>';
                echo '<td class="wdh" align="center"><div class="ball02">等</div></td>';
                echo '<td class="wdh" align="center"><div class="ball02">待</div></td>';
                echo '<td class="wdh" align="center"><div class="ball02">开</div></td>';
                echo '<td class="wdh" align="center"><div class="ball02">奖</div></td>';
                echo '<td class="wdh" align="center"><div class="ball02">中</div></td>';
                echo '<td class="wdh" align="center"><div class="ball05">'.$yucedata1.'</div></td>';
                echo '<td class="wdh" align="center"><div class="">'.$yucebeishu1*$touzhu.'</div></td>';
                echo '<td class="wdh" align="center"><div class="">'.$yuceprofit1*$touzhu.'</div></td>';
                echo '<td class="wdh" align="center"><div class=""></div></td>';
                echo '</tr>';

				if($data) foreach($data as $index=>$var){
					
				$dArry=explode(",",$var[2]);
				$var['d1']=$dArry[0];
				$var['d2']=$dArry[1];
				$var['d3']=$dArry[2];
				$var['d4']=$dArry[3];
				$var['d5']=$dArry[4];

                $oj = json_decode($data[$index+1][3]);
                if($oj->QIANSHAN->currResult==1){
                    $yucedata = $oj->QIANSHAN->nextData;
                    $yucebeishu = $oj->QIANSHAN->nextBeishu;
                    $yuceprofit = $oj->QIANSHAN->nextProfit;
                }else if($oj->HOUSHAN->currResult==1){
                    $yucedata = $oj->HOUSHAN->nextData;
                    $yucebeishu = $oj->HOUSHAN->nextBeishu;
                    $yuceprofit = $oj->HOUSHAN->nextProfit;
                }else if($oj->ZHONGHE->currResult==1){
                    $yucedata = $oj->ZHONGHE->nextData;
                    $yucebeishu = $oj->ZHONGHE->nextBeishu;
                    $yuceprofit = $oj->ZHONGHE->nextProfit;
                }else{
                    $yucedata = '等';
                    $yucebeishu = 0;
                    $yuceprofit = 0;
                }

                $profit = $var[4];


                echo '<tr>';
				echo '<td id="title">'.$var[1].'</td>';


				if($var['d1']==$yucedata){
                    echo '<td class="wdh" align="center"><div class="ball06">'.$var['d1'].'</div></td>';
                }else{
                    echo '<td class="wdh" align="center"><div class="ball02">'.$var['d1'].'</div></td>';
                }
                if($var['d2']==$yucedata){
                    echo '<td class="wdh" align="center"><div class="ball06">'.$var['d2'].'</div></td>';
                }else{
                    echo '<td class="wdh" align="center"><div class="ball02">'.$var['d2'].'</div></td>';
                }
                if($var['d3']==$yucedata){
                    echo '<td class="wdh" align="center"><div class="ball06">'.$var['d3'].'</div></td>';
                }else{
                    echo '<td class="wdh" align="center"><div class="ball02">'.$var['d3'].'</div></td>';
                }
                if($var['d4']==$yucedata){
                    echo '<td class="wdh" align="center"><div class="ball06">'.$var['d4'].'</div></td>';
                }else{
                    echo '<td class="wdh" align="center"><div class="ball02">'.$var['d4'].'</div></td>';
                }
                if($var['d5']==$yucedata){
                    echo '<td class="wdh" align="center"><div class="ball06">'.$var['d5'].'</div></td>';
                }else{
                    echo '<td class="wdh" align="center"><div class="ball02">'.$var['d5'].'</div></td>';
                }


                echo '<td class="wdh" align="center"><div class="ball05">'.$yucedata.'</div></td>';
                echo '<td class="wdh" align="center"><div class="">'.$yucebeishu*$touzhu.'</div></td>';
                echo '<td class="wdh" align="center"><div class="">'.$yuceprofit*$touzhu.'</div></td>';
                echo '<td class="wdh" align="center"><div class="">'.$profit*$touzhu.'</div></td>';
				echo '</tr>';
				} ?>   
       	
      <?php } ?>
	</tbody></table>
</div>


<div class="m_footer_annotation">
                        未满18周岁禁止购买<br>
                Copyright © SycPt  2010-2020 版权所有
                <!-- <a href="#" class="m_f_top"></a> -->
</div>

</section>
</div>
<script type="text/javascript" src="/js/nsc_m/res.js?v=1.17.2.1"></script>
<script type="text/javascript">
$(function(){
    var riable=0;
    $(".nfdprize_text").click(function(){
        if(riable==0){
            riable=1;
            $(".m-lott-methodBox .nfdprize_text b").addClass('cur')
        }else{
            riable =0;
            $(".m-lott-methodBox .nfdprize_text b").removeClass('cur')
        }
        $(".m-lott-methodBox-list").toggle();
    });

    userLevel();

}());



//获取资金
function userLevel() {
    $.ajax({
        type : 'POST',
        url  : '/index.php/safe/userLevel',
        data : 'flag=getmoney',
        timeout : 10000,
        success : function(data){
            autoRefresh = true;
            if( data == "error" ) {//
                $("#refff").html("<b>正在读取会员信息</b>");
                return false;
            } else {
                if(isNaN(data)){
                    layer.open({
                        content:"您的登录可能已经过期，请重新登录!!!",
                        btn:'确定',
                        yes:function(index){
                            location.href="/";
                            layer.close(index)
                        }
                    })
                    return false;
                }else if(data<=1){
                    layer.open({
                        content:"您还不是会员，请先购买会员!!!",
                        btn:'确定',
                        yes:function(index){
                            location.href="/index.php/cash/recharge";
                            layer.close(index)
                        }
                    })
                }else{
                    return true;
                }
            }
        },
        error: function() {
            $("#refff").html("正在读取会员信息");
        },
        complete:function(XHR,textStatus){
            //console.log(XHR);
            XHR = null;
            //console.log(XHR);
        }
    });
}
    
</script>

</body>
</html>