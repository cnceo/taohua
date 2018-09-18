<?php $this->display('inc_daohang.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>官方网站</title>
        <link rel="stylesheet" type="text/css" href="/css/nsc/home/reset.css?v=1.16.11.6" />

        <script type="text/javascript" src="/js/nsc/jquery-1.7.min.js?v=1.16.11.6"></script>
        <script type="text/javascript" src="/js/nsc/base.js?v=1.16.11.6"></script>
        <script type="text/javascript" src="/js/nsc/jquery-1.7.min.js?v=1.16.11.6"></script>
			<link rel="stylesheet" href="/css/nsc/huodong.css?v=1.16.11.6" />
        <script type="text/javascript" src="/js/nsc/dialogUI/jquery.dialogUI.js?v=1.16.11.6"></script>
        <script type="text/javascript" src="/js/nsc/main.js?v=1.16.11.6"></script>

        <link href="/css/nsc/plugin/dialogUI/dialogUI.css?v=1.16.11.6" media="all" type="text/css" rel="stylesheet" />
    </head>
    <body>

        <div id="contentBox" class="activity_main">
            <div class="right_meun" id="siderbar">
                <div class="r_tit-bg"><h3 class="r_tit">热门活动</h3></div>
                <ul>
			        	<li >
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
			            <li class="current">
			                <a href="/index.php/score/chuangguan">至尊闯关活动</a>
			            </li>
			            <li >
			                <a href="/index.php/score/qiandao">签到有你</a>
			            </li>
			    </ul>
            </div>
            <div class="left_activity">

<div id="subContent_bet_re">
<div class="activity_content">
    <div class="activity_banner"><img src="http://7xix3x.com1.z0.glb.clouddn.com/新闯关小图.jpg" height="150"></div>
    <div class="activity_title">
    	<h2>至尊闯关活动</h2>
		<?php
	$rechargeTime=strtotime('00:00');
	$cashAmout=$this->getValue("select sum(mode*beiShu*actionNum) from {$this->prename}bets where actionTime>={$rechargeTime} and uid={$this->user['uid']} and isDelete=0");
?>
<p class="counyongjin">今日已消费<span id="days"><?=$this->iff($cashAmout,$cashAmout,0)?></span>元</p>
        <a href="#" title="领取奖金" class="check_btn">领取奖金</a>
    </div>
    <div class="activity_nr">
    	<h4 class="x-title">具体内容</h4>
<div class="activity_main_cont">
  	<dl>
		<dd>
            <ul>
                <li>
                    <div class="activity_txt">
                    	<span class="activi_status on">进行中</span>
               
                    	<h2><i class="time"></i>活动时间：2016-05-01到2016-11-30</h2>
                    <div class="activity_btn">
                         
                        <div class="activity_detail detal_li">
								<p>单日的结算时间为03:00到次日的03:00,只计算彩票投注。投注达到流水以后即可以领取对应档次的游戏彩金。</p>                            
								<p>一天只能领取一次，所以建议用户在当天决定停止游戏的时候领取即可以领取到最高的彩金，领取的彩金无流水要求可以直接提款。</p>                            
								<p>同一IP、同一绑定提款卡姓名只能领取一次优惠。平台保留对活动的解释权，有更改取消优惠的权利。</p>
								<div class="tabstyle">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
								<tr>
                                  <th>当日游戏投注</th>
                                  <th>VIP1</th>
                                  <th>VIP2</th>
                                  <th>VIP3</th>
                                  <th>VIP4</th>
                                  <th>VIP5</th>
                                  <th>VIP6</th>
                                  <th>VIP7</th>
								  <th>VIP8</th>
                                  <th>VIP9</th>
                                </tr>
                                <tr>
                                  <td>888</td>
                                  <td>8元</td>
                                  <td>8元</td>
                                  <td>8元</td>
                                  <td>8元</td>
                                  <td>8元</td>
                                  <td>8元</td>
                                  <td>8元</td>
                                  <td>8元</td>
                                  <td>8元</td>
                                </tr>
                                <tr>
                                  <td>8,888</td>
                                  <td>18元</td>
                                  <td>28元</td>
                                  <td>28元</td>
                                  <td>38元</td>
                                  <td>38元</td>
                                  <td>48元</td>
                                  <td>48元</td>
                                  <td>58元</td>
                                  <td>58元</td>
                                </tr>
                                <tr>
                                  <td>18,888</td>
                                  <td>38元</td>
                                  <td>48元</td>
                                  <td>48元</td>
                                  <td>58元</td>
                                  <td>58元</td>
                                  <td>68元</td>
                                  <td>68元</td>
                                  <td>78元</td>
                                  <td>78元</td>
                                </tr>
                                <tr>
                                  <td>58,888</td>
                                  <td>138元</td>
                                  <td>158元</td>
                                  <td>168元</td>
                                  <td>178元</td>
                                  <td>188元</td>
                                  <td>198元</td>
                                  <td>218元</td>
                                  <td>238元</td>
                                  <td>258元</td>
                                </tr>
                                <tr>
                                  <td>188,888</td>
                                  <td>-</td>
                                  <td>-</td>
                                  <td>558元</td>
                                  <td>588元</td>
                                  <td>628元</td>
                                  <td>658元</td>
                                  <td>688元</td>
                                  <td>728元</td>
                                  <td>758元</td>
                                </tr>
                                <tr>
                                  <td>388,888</td>
                                  <td>-</td>
                                  <td>-</td>
                                  <td>-</td>
                                  <td>-</td>
                                  <td>888元</td>
                                  <td>988元</td>
                                  <td>1088元</td>
                                  <td>1188元</td>
                                  <td>1288元</td>
                                </tr>
                                <tr>
                                  <td>588,888</td>
                                  <td>-</td>
                                  <td>-</td>
                                  <td>-</td>
                                  <td>-</td>
                                  <td>-</td>
                                  <td>-</td>
                                  <td>1588元</td>
                                  <td>1688元</td>
                                  <td>1888元</td>
                                </tr>
                            </tbody>
						</table>
                                </div>
                                                                                                                                                                                                                                                                                        
                        </div>
                    </div>
                </li>
            </ul>
        </dd>
    </dl>
    <input type="hidden" name="code" id="code" value="A482215A">
  </div>
    </div>
</div>
﻿</div>

<div style="clear: both"></div>
<script type="text/javascript" src="/js/nsc/soundBox.js?v=1.16.11.6"></script>
<script type="text/javascript" src="/js/nsc/base.js?v=1.16.11.6"></script>
﻿</div>﻿</div>﻿</div>﻿</div>﻿</div>
<?php $this->display('inc_che.php'); ?>

</body>
</html>
