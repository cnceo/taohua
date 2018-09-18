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
require('../xingcai_config.php');
$id=array('6','7','15','16','67','68');
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml" xmlns:esun>
<title>双赢彩游戏平台  - 查看历史号码走势  </title>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<META http-equiv="Pragma" content="no-cache" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/line.css"  rel="stylesheet" type="text/css">

<script type="text/javascript" src="/js/nsc/jquery-1.7.min.js?v=1.17.1.23"></script>
<script language="javascript" type="text/javascript" src="js/line.js"></script>
<script type="text/javascript" src="js/layui.js"></script>
<script>
layui.use('laydate', function(){
  var laydate = layui.laydate;
  
  var start = {
    min: laydate.now()
    ,max: '2099-06-16 23:59:59'
    ,istoday: false
    ,choose: function(datas){
      end.min = datas; //开始日选好后，重置结束日的最小日期
      end.start = datas //将结束日的初始值设定为开始日
    }
  };
  
  var end = {
    min: laydate.now()
    ,max: '2099-06-16 23:59:59'
    ,istoday: false
    ,choose: function(datas){
      start.max = datas; //结束日选好后，重置开始日的最大日期
    }
  };
  
  document.getElementById('LAY_demorange_s').onclick = function(){
    start.elem = this;
    laydate(start);
  }
  document.getElementById('LAY_demorange_e').onclick = function(){
    end.elem = this
    laydate(end);
  }
  
});
</script>
<body style="background:none;">
<div id="searchBox" style="background: #f8f8f8; padding:10px 0;">
	<div class="lhfx_tit"><span><?=$shortName?></span><span class="showAll"></span>基本走势</div>
    <div class="secondary_tabs">
        <ul>
            <li data="num_30" class="hover"><a href="?typeid=<?=$typeid?>&pgs=30" class="ml10<?php if($pgs==30) echo ' on'?>" target="_self">最近30期</a></li>
            <li data="num_50"><a href="?typeid=<?=$typeid?>&pgs=50" class="ml10<?php if($pgs==50) echo ' on'?>" target="_self">最近50期</a></li>
            <li data="num_100"><a href="?typeid=<?=$typeid?>&pgs=80" class="ml10<?php if($pgs==80) echo ' on'?>" target="_self">最近80期</a></li>
			<li data="num_100"><a href="?typeid=<?=$typeid?>&pgs=200" class="ml10<?php if($pgs==200) echo ' on'?>" target="_self">最近200期</a></li>
			<li data="num_100"><a href="?typeid=<?=$typeid?>&pgs=300" class="ml10<?php if($pgs==300) echo ' on'?>" target="_self">最近300期</a></li>
        </ul>
    </div>
    	<div class="lhfx_search_time">
		<form action="" method="get">
		<input type="hidden" name="typeid" value="<?=$typeid?>" />
            <input type="hidden" name="pgs" value="<?=$pgs?>" />
		时间范围：
		<input type="text" value="<?=$fromTime?>" name="fromTime" onclick="layui.laydate({elem: this, festival: true})" class="time_input">
		<span class="image"></span>
		<label>至</label>
		<input type="text" value="<?=$toTime?>" onclick="layui.laydate({elem: this, festival: true})" name="toTime" class="time_input">
		<span class="image"></span>
		<input type="submit" value="查询" id="showissue1" class="time_btn">
		</form>
	</div>
	<div class="clearfix"></div>
</div>
<div class="wo_choose">
<span>标注形式选择</span><input type="checkbox" name="checkbox2" value="checkbox" id="has_line" class="no_bk-bg"><label for="has_line">显示走势折线</label>
    <input type="checkbox" name="checkbox" value="checkbox" id="no_miss" onclick="toggleMiss();" /><label for="has_line">不带遗漏数据</label> 
	</div>

<div style="position: relative; height: 756px;" id="container">
<table id="chartsTable" width="100%" cellpadding="0" cellspacing="0" border="0" style="position:absolute; top:0; left:0;">
      <tbody><tr id="title">
             <td rowspan="2"><strong>期号</strong></td>
             <td rowspan="2" colspan="5" class="redtext"><strong>开奖号码</strong></td>
                          <td colspan="11"><strong>万位</strong></td>
                          <td colspan="11"><strong>千位</strong></td>
                          <td colspan="11"><strong>百位</strong></td>
                          <td colspan="11"><strong>十位</strong></td>
                          <td colspan="11"><strong>个位</strong></td>
                 </tr>
                    <tr id="head">
                        
                        <td class="wdh" align="center"><strong>1</strong></td>
                        <td class="wdh" align="center"><strong>2</strong></td>
                        <td class="wdh" align="center"><strong>3</strong></td>
                        <td class="wdh" align="center"><strong>4</strong></td>
                        <td class="wdh" align="center"><strong>5</strong></td>
                        <td class="wdh" align="center"><strong>6</strong></td>
                        <td class="wdh" align="center"><strong>7</strong></td>
                        <td class="wdh" align="center"><strong>8</strong></td>
                        <td class="wdh" align="center"><strong>9</strong></td>
						<td class="wdh" align="center"><strong>10</strong></td>
						<td class="wdh" align="center"><strong>11</strong></td>
						
                        <td class="wdh" align="center"><strong>1</strong></td>
                        <td class="wdh" align="center"><strong>2</strong></td>
                        <td class="wdh" align="center"><strong>3</strong></td>
                        <td class="wdh" align="center"><strong>4</strong></td>
                        <td class="wdh" align="center"><strong>5</strong></td>
                        <td class="wdh" align="center"><strong>6</strong></td>
                        <td class="wdh" align="center"><strong>7</strong></td>
                        <td class="wdh" align="center"><strong>8</strong></td>
                        <td class="wdh" align="center"><strong>9</strong></td>
						<td class="wdh" align="center"><strong>10</strong></td>
						<td class="wdh" align="center"><strong>11</strong></td>
						
						<td class="wdh" align="center"><strong>1</strong></td>
                        <td class="wdh" align="center"><strong>2</strong></td>
                        <td class="wdh" align="center"><strong>3</strong></td>
                        <td class="wdh" align="center"><strong>4</strong></td>
                        <td class="wdh" align="center"><strong>5</strong></td>
                        <td class="wdh" align="center"><strong>6</strong></td>
                        <td class="wdh" align="center"><strong>7</strong></td>
                        <td class="wdh" align="center"><strong>8</strong></td>
                        <td class="wdh" align="center"><strong>9</strong></td>
						<td class="wdh" align="center"><strong>10</strong></td>
						<td class="wdh" align="center"><strong>11</strong></td>
						
						<td class="wdh" align="center"><strong>1</strong></td>
                        <td class="wdh" align="center"><strong>2</strong></td>
                        <td class="wdh" align="center"><strong>3</strong></td>
                        <td class="wdh" align="center"><strong>4</strong></td>
                        <td class="wdh" align="center"><strong>5</strong></td>
                        <td class="wdh" align="center"><strong>6</strong></td>
                        <td class="wdh" align="center"><strong>7</strong></td>
                        <td class="wdh" align="center"><strong>8</strong></td>
                        <td class="wdh" align="center"><strong>9</strong></td>
						<td class="wdh" align="center"><strong>10</strong></td>
						<td class="wdh" align="center"><strong>11</strong></td>
						
						<td class="wdh" align="center"><strong>1</strong></td>
                        <td class="wdh" align="center"><strong>2</strong></td>
                        <td class="wdh" align="center"><strong>3</strong></td>
                        <td class="wdh" align="center"><strong>4</strong></td>
                        <td class="wdh" align="center"><strong>5</strong></td>
                        <td class="wdh" align="center"><strong>6</strong></td>
                        <td class="wdh" align="center"><strong>7</strong></td>
                        <td class="wdh" align="center"><strong>8</strong></td>
                        <td class="wdh" align="center"><strong>9</strong></td>
						<td class="wdh" align="center"><strong>10</strong></td>
						<td class="wdh" align="center"><strong>11</strong></td>
                    </tr>
          		<?php
				if($fromTime) $fromTime=strtotime($fromTime);
				if($toTime) $toTime=strtotime($toTime)+24*3600;
				
				$pg=trim($_REQUEST["page"]);
				if(!$pg){$pg=1;}
				if(!$pgs){$pgs=30;}
				$tableStr=$conf['db']['prename']."data";
				$tableStr2=$conf['db']['prename']."data a";
				$fieldsStr="time, number, data";
				
				$fieldsStr2="a.time, a.number, a.data";
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
				$orderStr=" order by a.id desc";
	
				$totalNumber = $mydb->row_count($tableStr,$whereStr);

				if ($totalNumber>0){
			 
                $countcount=0;
				$perNumber=$pgs; //每页显示的记录数
				$page=$pg; //获得当前的页面值
				if (!isset($page)) $page=1;
				
				$totalPage=ceil($totalNumber/$perNumber); //计算出总页数
				$startCount=($page-1)*$perNumber; //分页开始,根据此方法计算出开始的记录
				$data = $mydb->row($tableStr2,$fieldsStr2,$whereStr2.' '.$orderStr." limit $startCount,$perNumber");
				
				if($data) foreach($data as $var){
					
				$dArry=explode(",",$var[2]);
				$var['d1']=$dArry[0];
				$var['d2']=$dArry[1];
				$var['d3']=$dArry[2];
				$var['d4']=$dArry[3];
				$var['d5']=$dArry[4];
				
				echo '<tr>';
				echo '<td id="title">'.$var[1].'</td>';
				echo '<td class="wdh" align="center"><div class="ball02">'.$var['d1'].'</div></td>';
				echo '<td class="wdh" align="center"><div class="ball02">'.$var['d2'].'</div></td>';
				echo '<td class="wdh" align="center"><div class="ball02">'.$var['d3'].'</div></td>';
				echo '<td class="wdh" align="center"><div class="ball02">'.$var['d4'].'</div></td>';
				echo '<td class="wdh" align="center"><div class="ball02">'.$var['d5'].'</div></td>';
	
				for($i=1;$i<12;$i++) //万位
				{
					if($i==intval($var['d1'])){
						echo '<td class="charball" align="center"><div class="ball01">'.$var['d1'].'</div></td>';
						$five['LW'.$i]=0;  //遗漏
						if($five['SW'.$i]){$five['SW'.$i]++;}else{$five['SW'.$i]=1;} //出现总次数
						if($five['LCW'.$i]){$five['LCW'.$i]++;}else{$five['LCW'.$i]=1;} //最大连出值
					}else{
						if($five['LW'.$i]){$five['LW'.$i]++;}else{$five['LW'.$i]=1;}
						echo '<td class="wdh" align="center"><div class="ball03">'.$five['LW'.$i].'</div></td>';
						$five['LCW'.$i]=0;
					}
					//遗漏总计
					if($five['ZW'.$i]){$five['ZW'.$i]+=$five['LW'.$i];}else{$five['ZW'.$i]=$five['LW'.$i];}
					//最大遗漏值
					if($five['MW'.$i]<$five['LW'.$i]){$five['MW'.$i]=$five['LW'.$i];}
					//最大连出值
					if($five['MLCW'.$i]<$five['LCW'.$i]){$five['MLCW'.$i]=$five['LCW'.$i];}
					
				}
				
				for($i=1;$i<12;$i++) //千位
				{
					if($i==intval($var['d2'])){
						echo '<td class="charball" align="center"><div class="ball02">'.$var['d2'].'</div></td>';
						$five['LQ'.$i]=0;
						if($five['SQ'.$i]){$five['SQ'.$i]++;}else{$five['SQ'.$i]=1;}
						if($five['LCQ'.$i]){$five['LCQ'.$i]++;}else{$five['LCQ'.$i]=1;}
					}else{
						if($five['LQ'.$i]){$five['LQ'.$i]++;}else{$five['LQ'.$i]=1;}
						echo '<td class="wdh" align="center"><div class="ball04">'.$five['LQ'.$i].'</div></td>';
						$five['LCQ'.$i]=0;
					}
					if($five['ZQ'.$i]){$five['ZQ'.$i]+=$five['LQ'.$i];}else{$five['ZQ'.$i]=$five['LQ'.$i];}
					if($five['MQ'.$i]<$five['LQ'.$i]){$five['MQ'.$i]=$five['LQ'.$i];}
					if($five['MLCQ'.$i]<$five['LCQ'.$i]){$five['MLCQ'.$i]=$five['LCQ'.$i];}
		
				}
				for($i=1;$i<12;$i++) //百位
				{
					if($i==intval($var['d3'])){
						echo '<td class="charball" align="center"><div class="ball01">'.$var['d3'].'</div></td>';
						$five['LB'.$i]=0;
						if($five['SB'.$i]){$five['SB'.$i]++;}else{$five['SB'.$i]=1;}
						if($five['LCB'.$i]){$five['LCB'.$i]++;}else{$five['LCB'.$i]=1;}
					}else{
						if($five['LB'.$i]){$five['LB'.$i]++;}else{$five['LB'.$i]=1;}
						echo '<td class="wdh" align="center"><div class="ball03">'.$five['LB'.$i].'</div></td>';
						$five['LCB'.$i]=0;
					}
					if($five['ZB'.$i]){$five['ZB'.$i]+=$five['LB'.$i];}else{$five['ZB'.$i]=$five['LB'.$i];}
					if($five['MB'.$i]<$five['LB'.$i]){$five['MB'.$i]=$five['LB'.$i];}
					if($five['MLCB'.$i]<$five['LCB'.$i]){$five['MLCB'.$i]=$five['LCB'.$i];}
				
				}

				for($i=1;$i<12;$i++) //十位
				{
					if($i==intval($var['d4'])){
						echo '<td class="charball" align="center"><div class="ball02">'.$var['d4'].'</div></td>';
						$five['LS'.$i]=0;
						if($five['SS'.$i]){$five['SS'.$i]++;}else{$five['SS'.$i]=1;}
						if($five['LCS'.$i]){$five['LCS'.$i]++;}else{$five['LCS'.$i]=1;}
					}else{
						if($five['LS'.$i]){$five['LS'.$i]++;}else{$five['LS'.$i]=1;}
						echo '<td class="wdh" align="center"><div class="ball04">'.$five['LS'.$i].'</div></td>';
						$five['LCS'.$i]=0;
					}
					if($five['ZS'.$i]){$five['ZS'.$i]+=$five['LS'.$i];}else{$five['ZS'.$i]=$five['LS'.$i];}
					if($five['MS'.$i]<$five['LS'.$i]){$five['MS'.$i]=$five['LS'.$i];}
					if($five['MLCS'.$i]<$five['LCS'.$i]){$five['MLCS'.$i]=$five['LCS'.$i];}
			
				}
				
				for($i=1;$i<12;$i++)  //个位
				{
					if($i==intval($var['d5'])){
						echo '<td class="charball" align="center"><div class="ball01">'.$var['d5'].'</div></td>';
						$five['LG'.$i]=0;
						if($five['SG'.$i]){$five['SG'.$i]++;}else{$five['SG'.$i]=1;}
						if($five['LCG'.$i]){$five['LCG'.$i]++;}else{$five['LCG'.$i]=1;}
					}else{
						if($five['LG'.$i]){$five['LG'.$i]++;}else{$five['LG'.$i]=1;}
						echo '<td class="wdh" align="center"><div class="ball03">'.$five['LG'.$i].'</div></td>';
						$five['LCG'.$i]=0;
					}
					if($five['ZG'.$i]){$five['ZG'.$i]+=$five['LG'.$i];}else{$five['ZG'.$i]=$five['LG'.$i];}
					if($five['MG'.$i]<$five['LG'.$i]){$five['MG'.$i]=$five['LG'.$i];}
					if($five['MLCG'.$i]<$five['LCG'.$i]){$five['MLCG'.$i]=$five['LCG'.$i];}
				}
			
			echo '</tr>';	
			
            } 
			
			
		?>                          
    <tr>
    <td nowrap="">出现总次数</td>
    <td align="center" colspan="5">&nbsp;</td>
    <?php 
	foreach(array('W','Q','B','S','G') as $var){
		for($i=1;$i<12;$i++)
		{
			if($five['S'.$var.$i]){
				$five['D'.$var.$i]=$five['S'.$var.$i];
			}else{
				$five['D'.$var.$i]=0;
			}
			echo '<td align="center">'.$five['D'.$var.$i].'</td>';
		}
	}
	?>  
    </tr>
    <tr>
    <td nowrap="">平均遗漏值</td>
    <td align="center" colspan="5">&nbsp;</td>
    <?php 
	foreach(array('W','Q','B','S','G') as $var){
		for($i=1;$i<12;$i++)
		{
			$five['P'.$var.$i]=intval($pgs/($five['D'.$var.$i]+1));
			echo '<td align="center">'.$five['P'.$var.$i].'</td>';
		}
	}
	?>
    </tr>
    <tr>
    <td nowrap>最大遗漏值</td>
    <td align="center" colspan="5">&nbsp;</td>
    <?php 
	foreach(array('W','Q','B','S','G') as $var){
		for($i=1;$i<12;$i++)
		{
			if($five['M'.$var.$i]){
				$five['Max'.$var.$i]=$five['M'.$var.$i];
			}else{
				$five['Max'.$var.$i]=0;
			}
			echo '<td align="center">'.$five['Max'.$var.$i].'</td>';
		}
	}
	?>
    </tr>
    <tr>
    <td nowrap>最大连出值</td>
    <td align="center" colspan="5">&nbsp;</td>
    <?php 
	foreach(array('W','Q','B','S','G') as $var){
		for($i=1;$i<12;$i++)
		{
			if($five['MLC'.$var.$i]){
				$five['MaxLC'.$var.$i]=$five['MLC'.$var.$i];
			}else{
				$five['MaxLC'.$var.$i]=0;
			}
			echo '<td align="center">'.$five['MaxLC'.$var.$i].'</td>';
		}
	}
	?>
    </tr>
    <tr id="head">
        <td rowspan="2" align="center"><strong>期号</strong></td>
        <td rowspan="2" align="center" colspan="5"><strong>开奖号码</strong></td>
       
        <td align="center"><strong>1</strong></td>
        <td align="center"><strong>2</strong></td>
        <td align="center"><strong>3</strong></td>
        <td align="center"><strong>4</strong></td>
        <td align="center"><strong>5</strong></td>
        <td align="center"><strong>6</strong></td>
        <td align="center"><strong>7</strong></td>
        <td align="center"><strong>8</strong></td>
        <td align="center"><strong>9</strong></td>
		<td align="center"><strong>10</strong></td>
		<td align="center"><strong>11</strong></td>
		
        <td align="center"><strong>1</strong></td>
        <td align="center"><strong>2</strong></td>
        <td align="center"><strong>3</strong></td>
        <td align="center"><strong>4</strong></td>
        <td align="center"><strong>5</strong></td>
        <td align="center"><strong>6</strong></td>
        <td align="center"><strong>7</strong></td>
        <td align="center"><strong>8</strong></td>
        <td align="center"><strong>9</strong></td>
		<td align="center"><strong>10</strong></td>
		<td align="center"><strong>11</strong></td>
		
        <td align="center"><strong>1</strong></td>
        <td align="center"><strong>2</strong></td>
        <td align="center"><strong>3</strong></td>
        <td align="center"><strong>4</strong></td>
        <td align="center"><strong>5</strong></td>
        <td align="center"><strong>6</strong></td>
        <td align="center"><strong>7</strong></td>
        <td align="center"><strong>8</strong></td>
        <td align="center"><strong>9</strong></td>
		<td align="center"><strong>10</strong></td>
		<td align="center"><strong>11</strong></td>
		
        <td align="center"><strong>1</strong></td>
        <td align="center"><strong>2</strong></td>
        <td align="center"><strong>3</strong></td>
        <td align="center"><strong>4</strong></td>
        <td align="center"><strong>5</strong></td>
        <td align="center"><strong>6</strong></td>
        <td align="center"><strong>7</strong></td>
        <td align="center"><strong>8</strong></td>
        <td align="center"><strong>9</strong></td>
		<td align="center"><strong>10</strong></td>
		<td align="center"><strong>11</strong></td>
		
        <td align="center"><strong>1</strong></td>
        <td align="center"><strong>2</strong></td>
        <td align="center"><strong>3</strong></td>
        <td align="center"><strong>4</strong></td>
        <td align="center"><strong>5</strong></td>
        <td align="center"><strong>6</strong></td>
        <td align="center"><strong>7</strong></td>
        <td align="center"><strong>8</strong></td>
        <td align="center"><strong>9</strong></td>
		<td align="center"><strong>10</strong></td>
		<td align="center"><strong>11</strong></td>
    </tr>
    <tr id="title">
      <td colspan="11"><strong>万位</strong></td>
      <td colspan="11"><strong>千位</strong></td>
      <td colspan="11"><strong>百位</strong></td>
      <td colspan="11"><strong>十位</strong></td>
      <td colspan="11"><strong>个位</strong></td>
    </tr>
    <?php	  
			  
		}
	?>
</tbody></table>
</div>

</div>

<script type="text/javascript">window.onerror=function(){return true;}</script>
<script language="javascript">
fw.onReady(function(){
	Chart.init();	
	DrawLine.bind("chartsTable","has_line");
	DrawLine.color('#499495');
	DrawLine.add((parseInt(0)*11+5+1),2,11,0);
	DrawLine.color('#E4A8A8');
	DrawLine.add((parseInt(1)*11+5+1),2,11,0);
	DrawLine.color('#499495');
	DrawLine.add((parseInt(2)*11+5+1),2,11,0);
	DrawLine.color('#E4A8A8');
	DrawLine.add((parseInt(3)*11+5+1),2,11,0);
	DrawLine.color('#499495');
	DrawLine.add((parseInt(4)*11+5+1),2,11,0);
	DrawLine.draw(Chart.ini.default_has_line);
	if($("#chartsTable").width()>$('body').width())
	{
	   $('body').width($("#chartsTable").width() + "px");
	}
	$("#container").height($("#chartsTable").height() + "px");
    resize();

	var nols = $(".ball04,.ball03");
	$("#no_miss").click(function(){
		
		var checked = $(this).attr("checked");
		$.each(nols,function(i,n){
			if(checked==true || checked=='checked'){
				n.style.display='none';
			}else{
				n.style.display='block';
			}
		});
	});
	//切换漏号分析
	$('.lhfx_tit').hover(function(){
		$('.lhfx_lotterylist').show();
		$('.lhfx_lotterylist').unbind().hover(function(){
		},function(){
			$(this).hide();
		});
	},function(){});
});
function resize(){
    window.onresize = func;
    function func(){
        window.location.href=window.location.href;
    }
}
$(function(){
	$(".datetxt").datepicker({ onSelect: function(dateText, inst) {$(this).val(dateText);} });	
})
</script>
<div class="lhfx_lotterylist">
  	<dl>
		<dt>时时彩</dt>
		<dd><a href="/zst/index.php?typeid=1 ">重庆时时彩</a></dd>
		<dd><a href="/zst/index.php?typeid=12">新疆时时彩</a></dd>
		<dd><a href="/zst/index.php?typeid=35">天津时时彩</a></dd>
		<dd><a href="/zst/index.php?typeid=61">澳门时时彩</a></dd>
		<dd><a href="/zst/index.php?typeid=62">台湾时时彩</a></dd>
		
		<dd><a href="/zst/index.php?typeid=14">河内5分彩</a></dd>
		<dd><a href="/zst/index.php?typeid=26">河内2分彩</a></dd>
		<dd><a href="/zst/index.php?typeid=5">河内1分彩</a></dd>
		<dd><a href="/zst/index.php?typeid=75">巴西快乐彩</a></dd>
		<dd><a href="/zst/index.php?typeid=76">巴西1.5分彩</a></dd>
  	</dl>
	<dl>
		<dt>11选5</dt>
		<dd><a href="/zst/11x5.php?typeid=7">山东11选5</a></dd>
		<dd><a href="/zst/11x5.php?typeid=16">江西11选5</a></dd>
		<dd><a href="/zst/11x5.php?typeid=6">广东11选5</a></dd>
		<dd><a href="/zst/11x5.php?typeid=15">上海11选5</a></dd>
		<dd><a href="/zst/11x5.php?typeid=67">澳门11选5</a></dd>
		<dd><a href="/zst/11x5.php?typeid=68">台湾11选5</a></dd>
	</dl>
	<dl>
		<dt>快3-3D-排3</dt>
      	<dd><a href="/zst/k3.php?typeid=79">江苏快三</a></dd>
      	<dd><a href="/zst/k3.php?typeid=63">澳门快三</a></dd>
		<dd><a href="/zst/k3.php?typeid=64">台湾快三</a></dd>
		<dd><a href="/zst/3d.php?typeid=69">澳门3D</a></dd>
		<dd><a href="/zst/3d.php?typeid=70">台湾3D</a></dd>
		<dd><a href="/zst/3d.php?typeid=9">福彩3D</a></dd>
		<dd><a href="/zst/3d.php?typeid=10">排列三</a></dd>
	</dl>
	<dl class="nopb">
		<dt>快乐十分</dt>
		<dd><a href="/zst/klsf.php?typeid=71">澳门幸运农场</a></dd>
		<dd><a href="/zst/klsf.php?typeid=72">台湾幸运农场</a></dd>
	</dl>
</div>
</body>
</html>