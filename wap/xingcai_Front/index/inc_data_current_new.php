
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
	if($this->type==5){//河内1分彩
		$logcls = "icon_hn_1fc";
	}
	if($this->type==26){//河内2分彩
		$logcls = "icon_hn_2fc";
	}
	if($this->type==14){//河内5分彩
		$logcls = "icon_hn_5fc";
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
		$logcls = "icon_js_k3";
	}
	if($this->type==63){//江苏快3
		$logcls = "icon_am_k3";
	}
	if($this->type==64){//台湾快3
		$logcls = "icon_tw_k3";
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
		$logcls = "icon_bx_ssc";
	}	
	if($this->type==75){//巴西快乐彩
		$logcls = "icon_bx_klc";
	}	
	if($this->type==9){//福彩3D
		$logcls = "icon_fc_3d";
	}	
	if($this->type==10){//排列3
		$logcls = "icon_pl3";
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
		$logcls = "icon_cq_ffc";
	}	
	if($this->type==72){//台湾幸运农场
		$logcls = "icon_tw_xync";
	}		
	if($this->type==77 || $this->type==34){//六合彩
		$logcls = "icon_xglhc";
	}	
?>  

<div class="lottery_head">
	<div class="lottery_show">
		<div class="lottery_con wjkjData">
			<div class="lottery_type left">
			<div class="<?=$logcls?>"></div>
				
			</div>
			<div class="lottery_num left">
				<div class="m-t-lottery_numBox">
				
					<p class="lottery_history_issue"><?= $types[$this->type]['title'] ?><span><?=$lastNo['actionNo']?></span> 期</p>
										<div class="louhao" id="m_recen_v">
						<a href="#">近期开奖</a>
					</div>
															<style>
					.m_vico_title_timeLHC .lhc {text-align:right;}
					.lhc_num_box {margin:0 0 0.5rli 0!important;}
					.lhc_num_box .lhc {margin-top: 0!important;}
					</style>
										
				</div>
				
				
	
				
									<?php
if ($types[$this->type]['type'] == 4) { //快乐十分
?>
				<div class="lottery_num_box">
					<ul id="num" class="klsf" >
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
<?php }else if($types[$this->type]['type']==6) { //PK10?>
      
			
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
				
				<?php }else if($types[$this->type]['type']==8) { //快乐8?>
				<div class="lottery_num_box">
					<ul id="num" class="k8" >
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
				
                <?php } else if ($types[$this->type]['type'] == 9) { //快3 ?>
              	<div class="lottery_num_box">
					<ul id="num" >
                    <li><span style="top: 0px;"><?= intval($kjHao[0]) ?></span></li>
					<li><span style="top: 0px;"><?= intval($kjHao[1]) ?></span></li>
					<li><span style="top: 0px;"><?= intval($kjHao[2]) ?></span></li>
                </div>
   
		<?php }else if($types[$this->type]['type']==11) { //六合彩?>
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
		<?php } else if ($types[$this->type]['type'] == 3) { //3D ?>
				<div class="lottery_num_box">
					<ul id="num">
                    <li><span style="top: 0px;"><?= intval($kjHao[0]) ?></span></li>
					<li><span style="top: 0px;"><?= intval($kjHao[1]) ?></span></li>
					<li><span style="top: 0px;"><?= intval($kjHao[2]) ?></span></li>
					</ul>
                </div>
		<?php }else if($types[$this->type]['type']==2) { //11选5?>
				<div class="lottery_num_box">
					<ul id="num">
                    <li class="num_red_b ball_0"><?= intval($kjHao[0]) ?> </li>
                    <li class="num_red_b ball_1"><?= intval($kjHao[1]) ?> </li>
                    <li class="num_red_b ball_2"><?= intval($kjHao[2]) ?> </li>
                    <li class="num_red_b ball_3"><?= intval($kjHao[3]) ?> </li>
                    <li class="num_red_b ball_4"><?= intval($kjHao[4]) ?> </li>
					</ul>
                </div>
				
				<?php } else { ?>   
				
               <div class="lottery_num_box kj-hao" >
				<ul id="num">
                   <li><span style="top: 0px;"><?=$kjHao[0]?></span></li>
					<li><span style="top: 0px;"><?=$kjHao[1]?></span></li>
					<li><span style="top: 0px;"><?=$kjHao[2]?></span></li>
					<li><span style="top: 0px;"><?=$kjHao[3]?></span></li>
					<li><span style="top: 0px;"><?=$kjHao[4]?></span></li>
					</ul>
                </div>
                <?php
}
?>
					
				</div>
				
			</div>
		</div>
	</div>
	
<?php if($this->type==20 || $this->type==66 || $this->type==65) { ?><!--PK拾-->
  <div id="m_vi_recLott" style="display:none">
            <div class="recentBox">
                <h3><span>近期开奖</span></h3>
                <div class="recentCon">
                                        <ul>

<table border='0' cellspacing='0' cellpadding='0' width=100%>
<?php $this->display('index/inc_data_history_pk10.php', 0, 7); ?>
</table>
                    </ul>
                </div>
              
  <a id="m_more_lott_list" href="/zst/pk10.php?typeid=<?= $this->type ?>">查看更多</a>
                <a class="m_jqkj_close" href="#">关闭</a>
            </div>
    </div>
	<?php }?>
	
	
<?php if($this->type==78 || $this->type==74 || $this->type==73) { ?><!--快乐8-->
  <div id="m_vi_recLott" style="display:none">
            <div class="recentBox">
                <h3><span>近期开奖</span></h3>
                <div class="recentCon">
                                        <ul>

<table border='0' cellspacing='0' cellpadding='0' width=100%>
<?php $this->display('index/inc_data_history_k8.php', 0, 5); ?>
</table>
                    </ul>
                </div>          
  <a id="m_more_lott_list" href="/zst/kl8.php?typeid=<?= $this->type ?>">查看更多</a>
                <a class="m_jqkj_close" href="#">关闭</a>
            </div>
    </div>	
<?php }?>

<?php if($this->type==63 || $this->type==64 || $this->type==79) { ?><!--快3-->
  <div id="m_vi_recLott" style="display:none">
            <div class="recentBox">
                <h3><span>近期开奖</span></h3>
                <div class="recentCon">
            <ul>
				<table border='0' cellspacing='0' cellpadding='0' width=100%>
				<tr><th>期号</a></th><th>号码</th><th>和值</th><th>大小</th><th>单双</th></tr>
				<?php $this->display('index/inc_data_history_k3.php', 0, 7); ?>
				</table>
            </ul>
                </div>          
  <a id="m_more_lott_list" href="/zst/k3.php?typeid=<?= $this->type ?>">查看更多</a>
                <a class="m_jqkj_close" href="#">关闭</a>
            </div>
    </div>	
<?php }?>

<?php if($this->type==9 || $this->type==10 || $this->type==69 || $this->type==70) { ?><!--3D排列3-->
  <div id="m_vi_recLott" style="display:none">
            <div class="recentBox">
                <h3><span>近期开奖</span></h3>
                <div class="recentCon">
                    <ul>
						<table border='0' cellspacing='0' cellpadding='0' width=100%>
							<?php $this->display('index/inc_data_history_3d.php', 0, 7); ?>
						</table>
                    </ul>
                </div>         
				<a id="m_more_lott_list" href="/zst/3dp3.php?typeid=<?= $this->type ?>">查看更多</a>
                <a class="m_jqkj_close" href="#">关闭</a>
            </div>
    </div>	
<?php }?>

<?php if($this->type==6 || $this->type==7 || $this->type==15 || $this->type==16 || $this->type==67 || $this->type==68) { ?> <!--11选5-->
	<div id="m_vi_recLott" style="display:none">
            <div class="recentBox">
                <h3><span>近期开奖</span></h3>
                <div class="recentCon">
                    <ul>
						<table border='0' cellspacing='0' cellpadding='0' width=100%>
							<?php $this->display('index/inc_data_history_115.php', 0, 7); ?>
						</table>
                    </ul>
                </div>         
				<a id="m_more_lott_list" href="/zst/11x5.php?typeid=<?= $this->type ?>">查看更多</a>
                <a class="m_jqkj_close" href="#">关闭</a>
            </div>
    </div>
	
	<?php }else{ ?>
	<div id="m_vi_recLott" style="display:none">
            <div class="recentBox">
                <h3><span>近期开奖</span></h3>
                <div class="recentCon">
            <ul>
				<table border='0' cellspacing='0' cellpadding='0' width=100%>
					<tr><th>期号</a></th><th>号码</th><th>后二</th><th>后三</th></tr>
					<?php $this->display('index/inc_data_history_get.php', 0, 7); ?>
				</table>
            </ul>
                </div>              
				<a id="m_more_lott_list" href="/zst?typeid=<?= $this->type ?>">查看更多</a>
                <a class="m_jqkj_close" href="#">关闭</a>
            </div>
    </div>	
<?php }?>
<script type="text/javascript">
$(function(){
	window.S=<?= json_encode($diffTime > 0) ?>;
	window.KS=<?= json_encode($kjDiffTime > 0) ?>;
	window.kjTime=parseInt(<?= json_encode($kjdTime) ?>);
	
	if($.browser.msie){
		window.diffTime=<?= $diffTime ?>;
		setTimeout(function(){
			gameKanJiangDataC(<?= $diffTime ?>);
		}, 1000);
	}else{
		setTimeout(gameKanJiangDataC, 1000, <?= $diffTime ?>);
	}
	<?php
if ($kjDiffTime > 0) {
?> 
		if($.browser.msie){
		setTimeout(function(){
			setKJWaiting(<?= $kjDiffTime ?>);
		}, 1000);
		}else{
			setTimeout(setKJWaiting, 1000, <?= $kjDiffTime ?>);
		}
	<?php
}
?> 
	
	<?php
if (!$kjHao) {
?> 
		loadKjData();
	<?php
}
?> 
});
</script>
<script type="text/javascript">
$(function(){
    //切换近期开奖
      $('#m_recen_v').click(function(e){
        var e = window.event || arguments.callee.caller.arguments[0];
          $('#m_vi_recLott').toggle();
          $(document).on('click',function(){
            $('#m_vi_recLott').hide();
          });
          e.stopPropagation();

  });
  $('#m_vi_recLott').on('click',function(e){
    e.stopPropagation();
  });

    $(".m_jqkj_close").click(function(){
        $('#m_vi_recLott').hide();
    });
}())
</script>