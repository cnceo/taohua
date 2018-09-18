<?php $this->display('inc_daohang.php'); ?>

<link rel="stylesheet" type="text/css" href="/css/nsc/home/reset.css?v=1.16.11.6" />
<link rel="stylesheet" href="/css/nsc/huodong.css?v=1.16.11.6" />
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
			                <a href="/index.php/score/chuangguan">VIP返利活动</a>
			            </li>
			          
			    </ul>
            </div>
            <div class="left_activity">

<div id="subContent_bet_re">
<div class="activity_content">
    <div class="activity_banner"><img src="http://7xix3x.com1.z0.glb.clouddn.com/新闯关小图.jpg" height="150"></div>
    <div class="activity_title">
    	<h2>VIP返利活动</h2>
		<?php
	$rechargeTime=strtotime('00:00');
	$cashAmout=$this->getValue("select sum(mode*beiShu*actionNum) from {$this->prename}bets where actionTime>={$rechargeTime} and uid={$this->user['uid']} and isDelete=0");
?>
<p class="counyongjin">今日已消费<span id="days"><?=$this->iff($cashAmout,$cashAmout,0)?></span>元</p>
        <a href="#" title="领取奖金" class="check_btn" onclick='getvip()' class="check_btn">领取奖金</a>
    </div>
    <div class="activity_nr">
    	<h4 class="x-title">具体内容</h4>
<div class="activity_main_cont">
  	<dl>
		<dd>
            <ul>
                <li>
                    <div class="activity_txt">
                    	
                 
                         
                        <div class="activity_detail detal_li">
						<div><p>投注达到流水以后即可以领取对应档次的游戏彩金。</p> </div>
						<div><p>一天只能领取一次，所以建议用户在当天决定停止游戏的时候领取即可以领取到最高的彩金。</p></div>
						                           
						<div><p>平台保留对活动的解释权，有更改取消优惠的权利。</p></div>
								<div class="tabstyle">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tbody>
								<tr>
                                  <th>当日投注</th>
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
								<?php 
									for($i=0;$i<count($this->dataa);$i++){
										$row=$this->dataa[$i];
										if($row[yi]==0){
											$row[yi]='-';
										}
										if($row[er]==0){
											$row[er]='-';
										}
										if($row[san]==0){
											$row[san]='-';
										}
										if($row[si]==0){
											$row[si]='-';
										}
										if($row[wu]==0){
											$row[wu]='-';
										}
										if($row[liu]==0){
											$row[liu]='-';
										}
										if($row[qi]==0){
											$row[qi]='-';
										}
										if($row[ba]==0){
											$row[ba]='-';
										}
										if($row[jiu]==0){
											$row[jiu]='-';
										}
										
										echo "<tr><td>$row[money]</td><td>$row[yi]</td><td>$row[er]</td><td>$row[san]</td><td>$row[si]</td><td>$row[wu]</td><td>$row[liu]</td><td>$row[qi]</td><td>$row[ba]</td><td>$row[jiu]</td>";
									}
								?>
                     
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
<script>
function getvip(){
		
		$.post("./fanxianvip/",{},function(res){
				if(res=='o'){
					$.alert("您今天已经领取过了，请明天再来！");
				}else if(res=='y'){
					$.alert("领取成功！");
				}else if(res=='n'){
					$.alert("投注量未达到要求！");
				}
			
		});
		
	}
</script>
<div style="clear: both"></div>
﻿</div>﻿</div>﻿</div>﻿</div>﻿</div>
<?php $this->display('inc_che.php'); ?>

</body>
</html>
