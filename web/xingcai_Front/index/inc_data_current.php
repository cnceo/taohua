<?php
    @session_start();
	if($this->type==34 || $this->type==77){
	$mode=1.00;
	$lastNo=$this->getGameLastNo($this->type);
	$kjHao=$this->getValue("select data from {$this->prename}data where type={$this->type} and number='{$lastNo['actionNo']}'");
	if($kjHao) $kjHao=explode(',', $kjHao);
	
	$actionNo=$this->getGameNo($this->type);
	$types=$this->getTypes();
	$kjdTime=$types[$this->type]['data_ftime'];
	$diffTime=strtotime($actionNo['actionTime'])-$this->time;
	}else{
	$lastNo=$this->getGameLastNo($this->type);
	$kjHao=$this->getValue("select data from {$this->prename}data where type={$this->type} and number='{$lastNo['actionNo']}'");
	if($kjHao) $kjHao=explode(',', $kjHao);
	$actionNo=$this->getGameNo($this->type);
	$types=$this->getTypes();
	$kjdTime=$types[$this->type]['data_ftime'];
	$diffTime=strtotime($actionNo['actionTime'])-$this->time-$kjdTime;
	$kjDiffTime=strtotime($lastNo['actionTime'])-$this->time;
	}
	
	$logcls = "icon_pk10";
	if($this->type==35){//天津时时彩
		$logcls = "icon_tj_ssc";
	}
	
	if($this->type==14){//河内5分彩
		$logcls = "icon_hn_5fc";
	}
	if($this->type==5){//河内1分彩
		$logcls = "icon_hn_ffc";
	}
	if($this->type==80){//腾讯分彩
		$logcls = "icon_tx_ffc";
	}
	if($this->type==26){//河内2分彩
		$logcls = "icon_hn_2fc";
	}
	if($this->type==1){//重庆时时彩
		$logcls = "icon_cq_ssc";
	}
	if($this->type==12){//新疆时时彩
		$logcls = "icon_xj_ssc";
	}
	if($this->type==60){//天津时时彩
		$logcls = "icon_tj_ssc";
	}		
	if($this->type==61){//澳门时时彩
		$logcls = "icon_am_ssc";
	}	
	if($this->type==62){//台湾时时彩
		$logcls = "icon_tw_ssc";
	}
	if($this->type==20){//北京pk10
		$logcls = "icon_bj_pk10";
	}	
	if($this->type==65){//澳门PK10
		$logcls = "icon_am_pk10";
	}
	if($this->type==66){//台湾PK10
		$logcls = "icon_tw_pk10";
	}
	if($this->type==79){//江苏快3
		$logcls = "icon_js_ks";
	}
	if($this->type==63){//澳门快3
		$logcls = "icon_am_ks";
	}
	if($this->type==64){//台湾快3
		$logcls = "icon_tw_ks";
	}	
	if($this->type==69){//澳门3D
		$logcls = "icon_am_3d";
	}
	if($this->type==70){//台湾3D
		$logcls = "icon_tw_3d";
	}	
	if($this->type==67){//澳门11选5
		$logcls = "icon_am_11x5";
	}		
	if($this->type==68){//台湾11选5
		$logcls = "icon_tw_11x5";
	}	
	if($this->type==6){//广东11选5
		$logcls = "icon_gd_11x5";
	}
	if($this->type==15){//上海11选5
		$logcls = "icon_sh_11x5";
	}		
	if($this->type==16){//江西11选5
		$logcls = "icon_jx_11x5";
	}
	if($this->type==7){//山东11选5
		$logcls = "icon_sd_11x5";
	}
	if($this->type==76){//巴西1.5分彩
		$logcls = "icon_bx15";
	}	
	if($this->type==75){//巴西快乐彩
		$logcls = "icon_bxklc";
	}	
	if($this->type==9){//福彩3D
		$logcls = "icon_fc_3d";
	}	
	if($this->type==10){//排列3
		$logcls = "icon_tc_pl3";
	}	
	if($this->type==73){//澳门快乐8
		$logcls = "icon_amkl8";
	}	
	if($this->type==74){//韩国快乐8
		$logcls = "icon_hgkl8";
	}	
	if($this->type==78){//北京快乐8
		$logcls = "icon_bjkl8";
	}			
	if($this->type==71){//澳门幸运农场
		$logcls = "icon_am_xync";
	}	
	if($this->type==72){//台湾幸运农场
		$logcls = "icon_tw_xync";
	}		
	if($this->type==77 || $this->type==34){//六合彩
		$logcls = "icon_xglhc";
	}	
?>  
<div class="lottery_head" id="kaijiang" type="<?=$this->type?>" ctype="<?=$types[$this->type]['type']?>">
	<div class="lottery_show left">
		<div class="lottery_con">
			<div class="lottery_type left">
				<div class="<?=$logcls?>"></div>
			</div>
			<div class="lottery_timer left">
				<div class="lottery_issue left">
					<p>第 <span id="current_issue"><?=$actionNo['actionNo']?></span> 期</p>
					<p>投注剩余时间</p>
					<span class="soundBtn soundClickEvent" onclick="voiceKJ();"></span>
				</div>
				<div class="lottery_timeBox left">
				<div class="timeBox">
					<div class="time_line"></div>
					<div class="num_left">
						<div class="num num_t">
							<div id="s1s"></div>
						</div>
						<div class="num num_b">
							<div id="s1x"></div>
						</div>
					</div>
					<div class="num_right">
						<div class="num num_t">
							<div id="s2s"></div>
						</div>
						<div class="num num_b">
							<div id="s2x"></div>
						</div>
					</div>
				</div>
				<div class="dianBox"></div>
				<div class="timeBox">
					<div class="time_line"></div>
					<div class="num_left">
						<div class="num num_t">
							<div id="f1s"></div>
						</div>
						<div class="num num_b">
							<div id="f1x"></div>
						</div>
					</div>
					<div class="num_right">
						<div class="num num_t">
							<div id="f2s"></div>
						</div>
						<div class="num num_b">
							<div id="f2x"></div>
						</div>
					</div>
				</div>
				<div class="dianBox"></div>
				<div class="timeBox">
					<div class="time_line"></div>
					<div class="num_left">
						<div class="num num_t">
							<div id="m1s"></div>
						</div>
						<div class="num num_b">
							<div id="m1x"></div>
						</div>
					</div>
					<div class="num_right">
						<div class="num num_t">
							<div id="m2s"></div>
						</div>
						<div class="num num_b">
							<div id="m2x"></div>
							</div>
						</div>
					</div>
				</div>
			</div>

 <?php if($types[$this->type]['type']==3) { //3D?>
     <div class="lottery_num left">
				<p class="lottery_history_issue">第 <span><?=$lastNo['actionNo']?></span> 期</p>
				<div class="lottery_num_box">
					<ul id="num" style="width: 165px;">
					<li><span style="top: 0px;"><?=$kjHao[0]?></span></li>
					<li><span style="top: 0px;"><?=$kjHao[1]?></span></li>
					<li><span style="top: 0px;"><?=$kjHao[2]?></span></li>
					</ul>
				</div>
				<div class="louhao">
					<a class="wanfa" href="/zst/3d.php?typeid=<?= $this->type ?>"  target="_blank">走势分析</a>
				</div>
			</div>
			</div>
	</div>
			
	<div class="tools left">
		<div class="yu_e">
			<div class="toggle-money show-money">
				余额 <span id="refff" class="money"><?=$this->user['coin']?></span>元
			</div>
			<div class="toggle-money hide-money">
				余额 <span class="money"><b>************</b></span>元
			</div>
			<a href="javascript:void(0);" class="shuaxin" id="refreshmoney" title="刷新余额">
				<i class="ic-refresh"></i>
			</a> 
			<a href="javascript:;" title="隐藏余额">
				<i class="ic-unlook"></i>
			</a>
		</div>
		<div class="toolslist">
			<ul class="ctqc">
				<li><a class="recharge" href="javascript:void(0);" onclick="czpay();">充值</a></li>
				<li><a class="drawings" href="javascript:void(0);" onclick="topay();">提款</a></li>
			</ul>
			<ul class="twbb">
				<li><a class="touzhu" href="javascript:void(0);" onclick="kjjl();" >开奖记录</a></li>
				<li><a class="wanfa" href="/index.php/lottery/hemai" >合买中心</a></li>
			</ul>
		</div>
	
</div>

	  
	   <?php }else if($types[$this->type]['type']==9) { //快3?>
				<div class="lottery_num left">
				<p class="lottery_history_issue">第 <span><?=$lastNo['actionNo']?></span> 期</p>
				<div class="lottery_num_box">
					<ul id="num" style="width: 165px;">
					<li><span style="top: 0px;"><?=$kjHao[0]?></span></li>
					<li><span style="top: 0px;"><?=$kjHao[1]?></span></li>
					<li><span style="top: 0px;"><?=$kjHao[2]?></span></li>
				
					
					</ul>
				</div>
				<div class="louhao">
					<a class="wanfa" href="/zst/k3.php?typeid=<?= $this->type ?>"  target="_blank">走势分析</a>
				</div>
			</div>
	
	  </div>
	  	</div>
	<div class="tools left">
		<div class="yu_e">
			<div class="toggle-money show-money">
				余额 <span id="refff" class="money"><?=$this->user['coin']?></span>元
			</div>
			<div class="toggle-money hide-money">
				余额 <span class="money"><b>************</b></span>元
			</div>
			<a href="javascript:void(0);" class="shuaxin" id="refreshmoney" title="刷新余额">
				<i class="ic-refresh"></i>
			</a> 
			<a href="javascript:;" title="隐藏余额">
				<i class="ic-unlook"></i>
			</a>
		</div>
		<div class="toolslist">
			<ul class="ctqc">
				<li><a class="recharge" href="javascript:void(0);" onclick="czpay();">充值</a></li>
				<li><a class="drawings" href="javascript:void(0);" onclick="topay();">提款</a></li>
			</ul>
			<ul class="twbb">
				<li><a class="touzhu" href="javascript:void(0);" onclick="kjjl();" >开奖记录</a></li>
				<li><a class="wanfa" href="/index.php/lottery/hemai" >合买中心</a></li>
			</ul>
		</div>
	
</div>


<?php }else if($types[$this->type]['type']==11) { //六合彩?>
				<div class="lottery_num left">
				<p class="lottery_history_issue">第 <span><?=$lastNo['actionNo']?></span> 期</p>
				<div class="lottery_num_box">
					<ul id="num" class="lhc">
				<?php 
				$a = array('01','02','07','08','12','13','18','19','23','24','29','30','34','35','40','45','46');
				$b = array('03','04','09','10','14','15','20','25','26','31','36','37','41','42','47','48');
				$c = array('05','06','11','16','17','21','22','27','28','32','33','38','39','43','44','49');
				for($i = 0; $i < 7; $i++) {
					if(in_array($kjHao[$i], $a)) {
						$color = 'red';
					} elseif(in_array($kjHao[$i], $b)) {
						$color = 'blue';
					} elseif(in_array($kjHao[$i], $c)) {
						$color = 'green';
					} else {
						$color = 'and';
					}
					if($i == 6) {
						echo "<li class='and'><span>and</span></li>";
					}
					?>
							<li class="<?=$color?>"><span><?=$kjHao[$i]?></span></li>
					<?php } ?>
					
					
					</ul>
				</div>
				<div class="louhao">
					<a class="wanfa"  href="javascript:void(0)" onClick="future()" >走势分析</a>
				</div>
			</div>
	
	  </div>
	  	</div>
	<div class="tools left">
		<div class="yu_e">
			<div class="toggle-money show-money">
				余额 <span id="refff" class="money"><?=$this->user['coin']?></span>元
			</div>
			<div class="toggle-money hide-money">
				余额 <span class="money"><b>************</b></span>元
			</div>
			<a href="javascript:void(0);" class="shuaxin" id="refreshmoney" title="刷新余额">
				<i class="ic-refresh"></i>
			</a> 
			<a href="javascript:;" title="隐藏余额">
				<i class="ic-unlook"></i>
			</a>
		</div>
		<div class="toolslist">
			<ul class="ctqc">
				<li><a class="recharge" href="javascript:void(0);" onclick="czpay();">充值</a></li>
				<li><a class="drawings" href="javascript:void(0);" onclick="topay();">提款</a></li>
			</ul>
			<ul class="twbb">
				<li><a class="touzhu" href="javascript:void(0);" onclick="kjjl();" >开奖记录</a></li>
				<li><a class="wanfa" href="/index.php/lottery/hemai" >合买中心</a></li>
			</ul>
		</div>
	
</div>




 <?php }else if($types[$this->type]['type']==8) { //快乐8?>
				<div class="lottery_num left">
				<p class="lottery_history_issue">第 <span><?=$lastNo['actionNo']?></span> 期</p>
				<div class="lottery_num_box">
					<ul id="num" class="k8" style="width: 200px;">
					<li style="top: 0px;"><span><?=$kjHao[0]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[1]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[2]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[3]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[4]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[5]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[6]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[7]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[8]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[9]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[10]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[11]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[12]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[13]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[14]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[15]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[16]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[17]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[18]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[19]?></span></li>
					</ul>
				</div>
				<div class="louhao">
					<a class="wanfa"  href="javascript:void(0)" onClick="future()" >走势分析</a>
				</div>
			</div>
	
	  </div>
	  	</div>
	<div class="tools left">
		<div class="yu_e">
			<div class="toggle-money show-money">
				余额 <span id="refff" class="money"><?=$this->user['coin']?></span>元
			</div>
			<div class="toggle-money hide-money">
				余额 <span class="money"><b>************</b></span>元
			</div>
			<a href="javascript:void(0);" class="shuaxin" id="refreshmoney" title="刷新余额">
				<i class="ic-refresh"></i>
			</a> 
			<a href="javascript:;" title="隐藏余额">
				<i class="ic-unlook"></i>
			</a>
		</div>
		<div class="toolslist">
			<ul class="ctqc">
				<li><a class="recharge" href="javascript:void(0);" onclick="czpay();">充值</a></li>
				<li><a class="drawings" href="javascript:void(0);" onclick="topay();">提款</a></li>
			</ul>
			<ul class="twbb">
				<li><a class="touzhu" href="javascript:void(0);" onclick="bjkjjl();" >开奖记录</a></li>
				<li><a class="wanfa" href="/index.php/lottery/hemai" >合买中心</a></li>
			</ul>
		</div>
	
</div>

<?php }else if($types[$this->type]['type']==4) { //快乐十分?>
				<div class="lottery_num left">
				<p class="lottery_history_issue">第 <span><?=$lastNo['actionNo']?></span> 期</p>
				<div class="lottery_num_box">
					<ul id="num" class="klsf">
					<?php if (isset($kjHao[0])>0){?>
					<li style="top: 0px;"><span><?=$kjHao[0]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[1]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[2]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[3]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[4]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[5]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[6]?></span></li>
					<li style="top: 0px;"><span><?=$kjHao[7]?></span></li>
					<?php }?>
					</ul>
				</div>
				<div class="louhao">
					<a class="wanfa" href="/zst/klsf.php?typeid=<?= $this->type ?>"  target="_blank">走势分析</a>
				</div>
			</div>
	
	  </div>
	  	</div>
	<div class="tools left">
		<div class="yu_e">
			<div class="toggle-money show-money">
				余额 <span id="refff" class="money"><?=$this->user['coin']?></span>元
			</div>
			<div class="toggle-money hide-money">
				余额 <span class="money"><b>************</b></span>元
			</div>
			<a href="javascript:void(0);" class="shuaxin" id="refreshmoney" title="刷新余额">
				<i class="ic-refresh"></i>
			</a> 
			<a href="javascript:;" title="隐藏余额">
				<i class="ic-unlook"></i>
			</a>
		</div>
		<div class="toolslist">
			<ul class="ctqc">
				<li><a class="recharge" href="javascript:void(0);" onclick="czpay();">充值</a></li>
				<li><a class="drawings" href="javascript:void(0);" onclick="topay();">提款</a></li>
			</ul>
			<ul class="twbb">
				<li><a class="touzhu" href="javascript:void(0);" onclick="kjjl();" >开奖记录</a></li>
				<li><a class="wanfa" href="/index.php/lottery/hemai" >合买中心</a></li>
			</ul>
		</div>
	
</div>

	  <?php }else if($types[$this->type]['type']==6) { //PK10?>
      	<div class="lottery_num left">
				<p class="lottery_history_issue">第 <span><?=$lastNo['actionNo']?></span> 期</p>
				<div class="lottery_num_box">
					<ul id="num" class="pk10_ul">
					<?php if (isset($kjHao[0])>0){?>
					<li class="car<?=$kjHao[0]?>" ><span></span></li>
					<li class="car<?=$kjHao[1]?>" ><span></span></li>
					<li class="car<?=$kjHao[2]?>" ><span></span></li>
					<li class="car<?=$kjHao[3]?>" ><span></span></li>
					<li class="car<?=$kjHao[4]?>" ><span></span></li>
					<li class="car<?=$kjHao[5]?>" ><span></span></li>
					<li class="car<?=$kjHao[6]?>" ><span></span></li>
					<li class="car<?=$kjHao[7]?>" ><span></span></li>
					<li class="car<?=$kjHao[8]?>" ><span></span></li>
					<li class="car<?=$kjHao[9]?>" ><span></span></li>
					</ul>
					<?php }?>
				</div>
				<div class="louhao">
					<a class="wanfa"  href="javascript:void(0)" onClick="future()" >走势分析</a>
				</div>
			</div>
			</div>
	</div>
			
	<div class="tools left">
		<div class="yu_e">
			<div class="toggle-money show-money">
				余额 <span id="refff" class="money"><?=$this->user['coin']?></span>元
			</div>
			<div class="toggle-money hide-money">
				余额 <span class="money"><b>************</b></span>元
			</div>
			<a href="javascript:void(0);" class="shuaxin" id="refreshmoney" title="刷新余额">
				<i class="ic-refresh"></i>
			</a> 
			<a href="javascript:;" title="隐藏余额">
				<i class="ic-unlook"></i>
			</a>
		</div>
		<div class="toolslist">
			<ul class="ctqc">
				<li><a class="recharge" href="javascript:void(0);" onclick="czpay();">充值</a></li>
				<li><a class="drawings" href="javascript:void(0);" onclick="topay();">提款</a></li>
			</ul>
			<ul class="twbb">
				<li><a class="touzhu" href="javascript:void(0);" onclick="kjjl();" >开奖记录</a></li>
				<li><a class="wanfa" href="/index.php/lottery/hemai" >合买中心</a></li>
			</ul>
		</div>
	
</div>
      <?php }else if($types[$this->type]['type']==2) { //11选5?>
				<div class="lottery_num left">
				<p class="lottery_history_issue">第 <span><?=$lastNo['actionNo']?></span> 期</p>
				<div class="lottery_num_box">
					<ul id="num" style="width: 250px;">
					<li><span style="top: 0px;"><?=$kjHao[0]?></span></li>
					<li><span style="top: 0px;"><?=$kjHao[1]?></span></li>
					<li><span style="top: 0px;"><?=$kjHao[2]?></span></li>
					<li><span style="top: 0px;"><?=$kjHao[3]?></span></li>
					<li><span style="top: 0px;"><?=$kjHao[4]?></span></li>
					</ul>
				</div>
				<div class="louhao">
					<a class="wanfa" href="/zst/11x5.php?typeid=<?= $this->type ?>"  target="_blank">走势分析</a>
				</div>
			</div>
	
	  </div>
	  	</div>
	<div class="tools left">
		<div class="yu_e">
			<div class="toggle-money show-money">
				余额 <span id="refff" class="money"><?=$this->user['coin']?></span>元
			</div>
			<div class="toggle-money hide-money">
				余额 <span class="money"><b>************</b></span>元
			</div>
			<a href="javascript:void(0);" class="shuaxin" id="refreshmoney" title="刷新余额">
				<i class="ic-refresh"></i>
			</a> 
			<a href="javascript:;" title="隐藏余额">
				<i class="ic-unlook"></i>
			</a>
		</div>
		<div class="toolslist">
			<ul class="ctqc">
				<li><a class="recharge" href="javascript:void(0);" onclick="czpay();">充值</a></li>
				<li><a class="drawings" href="javascript:void(0);" onclick="topay();">提款</a></li>
			</ul>
			<ul class="twbb">
				<li><a class="touzhu" href="javascript:void(0);" onclick="kjjl();" >开奖记录</a></li>
				<li><a class="wanfa" href="/index.php/lottery/hemai" >合买中心</a></li>
			</ul>
		</div>
	
</div>
<?php }else{  ?>
	<div class="lottery_num left">
				<p class="lottery_history_issue">第 <span><?=$lastNo['actionNo']?></span> 期</p>
				<div class="lottery_num_box">
					<ul id="num" style="width: 250px;">
					<li><span style="top: 0px;"><?=$kjHao[0]?></span></li>
					<li><span style="top: 0px;"><?=$kjHao[1]?></span></li>
					<li><span style="top: 0px;"><?=$kjHao[2]?></span></li>
					<li><span style="top: 0px;"><?=$kjHao[3]?></span></li>
					<li><span style="top: 0px;"><?=$kjHao[4]?></span></li>
					</ul>
				</div>
				<div class="louhao">
					<a class="wanfa" href="/zst?typeid=<?= $this->type ?>"  target="_blank">走势分析</a>
				</div>
		</div>	
			</div>
	</div>
		<div class="tools left">
		<div class="yu_e">
			<div class="toggle-money show-money">
				余额 <span id="refff" class="money"><?=$this->user['coin']?></span>元
			</div>
			<div class="toggle-money hide-money">
				余额 <span class="money"><b>************</b></span>元
			</div>
			<a href="javascript:void(0);" class="shuaxin" id="refreshmoney" title="刷新余额">
				<i class="ic-refresh"></i>
			</a> 
			<a href="javascript:;" title="隐藏余额">
				<i class="ic-unlook"></i>
			</a>
		</div>
		<div class="toolslist">
			<ul class="ctqc">
				<li><a class="recharge" href="javascript:void(0);" onclick="czpay();">充值</a></li>
				<li><a class="drawings" href="javascript:void(0);" onclick="topay();">提款</a></li>
			</ul>
			<ul class="twbb">
				<li><a class="touzhu" href="javascript:void(0);" onclick="kjjl();" >开奖记录</a></li>
				<li><a class="wanfa" href="/index.php/lottery/hemai" >合买中心</a></li>
			</ul>
		</div>
	
</div>
<?php }?>
   			
	



			</div>
 	<!-- header end -->
<script type="text/javascript">
$(function(){
	window.S=<?=json_encode($diffTime>0)?>;
	window.KS=<?=json_encode($kjDiffTime>0)?>;
	window.kjTime=parseInt(<?=json_encode($kjdTime)?>);
	
	if($.browser.msie){
		//window.diffTime=<?=$diffTime?>;
		setTimeout(function(){
			gameKanJiangDataC(<?=$diffTime?>);
		}, 1000);
	}else{
		setTimeout(gameKanJiangDataC, 1000, <?=$diffTime?>);
	}
	<?php if($kjDiffTime>0){ ?> 
		if($.browser.msie){
		setTimeout(function(){
			setKJWaiting(<?=$kjDiffTime?>);
		}, 1000);
		}else{
			setTimeout(setKJWaiting, 1000, <?=$kjDiffTime?>);
		}
	<?php } ?> 
	
	<?php if(!$kjHao){ ?> 
		loadKjData();
	<?php } ?> 
});
function kjjl(){
	layer.open({
	  type: 2,
	  area: ['800px', '550px'],
	  zIndex:1999,
	  //fixed: false, //不固定
	  title:'开奖记录',
	  scrollbar: false,//屏蔽滚动条
	  //maxmin: true,
	  content:'/index.php/index/historyList/<?=$this->type?>'
	});
	return false;
}
function bjkjjl(){
	layer.open({
	  type: 2,
	  area: ['850px', '600px'],
	  zIndex:1999,
	  //fixed: false, //不固定
	  title:'开奖记录',
	  scrollbar: false,//屏蔽滚动条
	  //maxmin: true,
	  content:'/index.php/index/historyList/<?=$this->type?>'
	});
	return false;
}
</script>