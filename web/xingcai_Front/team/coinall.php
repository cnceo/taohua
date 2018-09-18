<?php $this->display('inc_daohang.php'); 
$teamAll=$this->getRow("select sum(u.coin) coin, count(u.uid) count from {$this->prename}members u where u.isDelete=0 and concat(',', u.parents, ',') like '%,{$this->user['uid']},%'");
  $teamAll2=$this->getRow("select count(u.uid) count from {$this->prename}members u where u.isDelete=0 and u.parentId={$this->user['uid']}");
?>

<?php
	$home_uid=$this->user['uid'];
	$childrenarr=$this->getRows("SELECT username,coin,parents,uid FROM {$this->prename}members where concat(',',parents,',') like '%,{$home_uid},%' and uid!=?",$home_uid);
?>

<div id="nsc_subContent" style="border:0">
<script type="text/javascript">

	$(function() {
		$( ".menus-li li").click(function(){
            $( ".menus-li li").removeClass("on");
            $(this).addClass("on");
            $("#tabs-1,#tabs-2").hide();
            $("#tabs-"+($(this).index()+1)).show();
        });
	})
</script>

<div id="siderbar">
<ul class="list clearfix">
<li ><a href="/index.php/team/addlink" >推广设定</a></li>
<li ><a href="/index.php/team/addMember" >开户管理</a></li>
<li ><a href="/index.php/team/memberList" >会员列表</a></li>
<li ><a href="/index.php/team/linkList" >推广链接</a></li>
<li ><a href="/index.php/team/gameRecord" >团队记录</a></li>
<li ><a href="/index.php/team/coin" >团队帐变</a></li>
<li ><a href="/index.php/team/report" >团队盈亏</a></li>
<li ><a href="/index.php/team/cashRecord" >团队提现</a></li>
<li class="current"><a href="/index.php/team/coinall" >团队统计</a></li>
</ul>
</div>

<link rel="stylesheet" href="/css/nsc/reset.css?v=1.16.11.5" />
<link rel="stylesheet" href="/css/nsc/list.css?v=1.16.11.5" />
<link rel="stylesheet" href="/css/nsc/activity.css?v=1.16.11.5" />
</head>
<body>
<div id="subContent_bet_re">

<div class="right_02 d5d8de">
<div class="right_02_28"></div>
<div class="right_02_29"></div>
</div>
 <table class="grayTable" width="100%" border="0" cellspacing="1" cellpadding="4">
  <tr>
    <td class="tdz_left">我的账号：</td>
    <td class="tdz_right"><?=$this->user['username']?></td>
  </tr>
  <tr>
    <td class="tdz_left">账号类型：</td>
    <td class="tdz_right"><?=$this->iff($this->user['type'], '代理', '会员')?></td>
  </tr>
  <tr>
    <td class="tdz_left">用户昵称：</td>
    <td class="tdz_right"><?=$this->user['nickname']?></td>
  </tr>
  <tr>
    <td class="tdz_left">可用余额：</td>
    <td class="tdz_right"><?=$this->user['coin']?> 元</td>
  </tr>
  <tr>
    <td class="tdz_left">团队余额：</td>
    <td class="tdz_right"><?=$teamAll['coin']?> 元</td>
  </tr>
    <tr>
    <td class="tdz_left">直属下级：</td>
    <td class="tdz_right"><?=$teamAll2['count']?> 个</td>
  </tr>
    <tr>
    <td class="tdz_left">所有下级：</td>
    <td class="tdz_right"><?=($teamAll['count']-1)?> 个</td>
  </tr>
<?php 
		$onlineNum = 0;
		foreach($childrenarr as $var){ 
			$login=$this->getRow("select * from {$this->prename}member_session where uid=? order by id desc limit 1", $var['uid']);
		if($login['isOnLine'] && ($this->time-$login['accessTime']<900)){
			$parents = explode(',',$var['parents']);
			rsort($parents);
			$index = 1;
			foreach($parents as $key=>$var2){
				$index++;
			}
	?>
	<?php 
		$onlineNum++;
		} } 
	?>
	</tr>
    <tr>
    <td class="tdz_left">在线总数：</td>
    <td class="tdz_right"><?=$onlineNum?> 人</td>
  </tr>
</table>
<?php $this->display('inc_root.php'); ?>
<div class="list_page">
   
    <div class="pageinfo"></div>
</div>
</div></div></div></div></div>
<?php $this->display('inc_che.php'); ?>

 </body>
 </html>