<html xmlns="http://www.w3.org/1999/xhtml" style="font-size: 16.3125px;" class="gwd_undefined"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,user-scalable=no,maximum-scale=1.0">
<title>桃花彩 </title>
<meta name="keywords" content="">
<meta nam="description" content="">
<link rel="stylesheet" href="/css/nsc_m/res1.css?v=1.16.11.16">
<!-- <link rel="stylesheet" href="/css/nsc/reset.css?v=1.16.11.16" /> -->
<link href="/js/nsc_m/need/layer.css?2.0" type="text/css" rel="styleSheet" id="layermcss"></div></head>
<link rel="stylesheet" type="text/css" media="all" href="/js/common/calendar/css/calendar-blue.css?v=1.16.11.16">

<script type="text/javascript" src="/js/nsc/jquery-1.7.min.js?v=1.16.11.16"></script>
<script>var TIP=true;</script>
<script type="text/javascript" src="/skin/js/onload.js"></script>
<script type="text/javascript" src="/skin/js/function.js"></script>
<script type="text/javascript" src="/js/nsc_m/layer.js?v=1.16.12.11"></script>
<script type="text/javascript" src="/js/nsc/common.js?v=1.16.11.16"></script>
<script type="text/javascript" src="/newskin/js/common.js?v=1.16.11.16"></script>







<script type="text/javascript" src="/js/nsc/main.js?v=1.16.12.4"></script>
 <script type="text/javascript" src="/skin/js/common.js"></script>
 <?php $this->freshSession(); 
		//更新级别
		$ngrade=$this->getValue("select max(level) from {$this->prename}member_level where minScore <= {$this->user['scoreTotal']}");
		if($ngrade>$this->user['grade']){
			$sql="update blast_members set grade={$ngrade} where uid=?";
			$this->update($sql, $this->user['uid']);
		}else{$ngrade=$this->user['grade'];}
		
		$date=strtotime('00:00:00');
?>