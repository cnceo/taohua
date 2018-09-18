
		
<div class="game-main" style="/*width:760px;*/margin-top:-21px;/*margin-right: 10px;*/">

<div id="bet-game">

	<div class="game-btn">
	
	<?php
		if($_COOKIE['mode']){
			$mode=$_COOKIE['mode'];
		}else{
			$mode=2.00;
		}
		$this->getSystemSettings();
		$this->getTypes();
		$sql="select id, groupName, enable from {$this->prename}played_group where enable=1 and type=? order by sort";
		$groups=$this->getObject($sql, 'id', $this->types[$this->type]['type']);
		if($this->groupId && !$groups[$this->groupId]) unset($this->groupId);
		
		if($groups) foreach($groups as $key=>$group){
			if(!$this->groupId) $this->groupId=$group['id'];
	?>
		<div class="ul-li<?=($this->groupId==$group['id'])?' current':''?>">
        	<a class="cai" href="/index.php/index/group/<?=$this->type .'/'.$group['id']?>"><span class="content"><?=$group['groupName']?></span></a>
		</div>
	<?php } ?>
	
    <div class="clear"></div>
	</div>
	
	<div class="game-cont">
		<?php $this->display('index/inc_game_played.php'); ?>
	
		
		<div class="num-table" style="height:auto;" id="game-dom">
			<div class="fandian">
				<div class="fandian-k">
					<span class="spn8">奖金/返点：</span>
					
					
					
						<span id="fandian-value" class="fdmoney" ><?=$maxPl?></span>
					<div class="fandian-box">
					<div id='basic_slider'  value="<?=$this->ifs($_COOKIE['fanDian'], 0)?>" data-bet-count="<?=$this->settings['betMaxCount']?>" data-bet-zj-amount="<?=$this->settings['betMaxZjAmount']?>" max="<?=$this->user['fanDian']?>" game-fan-dian="<?=$this->settings['fanDianMax']?>" fan-dian="<?=$this->user['fanDian']?>" game-fan-dian-bdw="<?=$this->settings['fanDianBdwMax']?>" fan-dian-bdw="<?=$this->user['fanDianBdw']?>" min="0" step="0.1"></div>
					
					</div>
					<span id="fandian-value2" class="fdmoney2">/0%</span>
				</div>
	
		 <script>
		 var flag=false;
			slider=noUiSlider.create($("#basic_slider")[0], {
				start: 0,
				animate: true,
				range: {
					min: 0,
					max: <?=(int)$this->user['fanDian']?>
				},
			});
			slider.on('update',function(value){
				flag&&gameSetFanDian(parseFloat(value[0]));
				flag=true
			});
		 </script>			
				
				
				
				
				<div class="fl">
			
					<?php if($this->settings['yuanmosi']==1){?>
					<b value="1.000" data-max-fan-dian="<?=$this->settings['betModeMaxFanDian0']?>" class="danwei dwon">元</b><?}?>
					<?php if($this->settings['jiaomosi']==1){?>
					<b value="0.100" data-max-fan-dian="<?=$this->settings['betModeMaxFanDian1']?>" class="danwei">角</b><?}?>
					<?php if($this->settings['fenmosi']==1){?>
					<b value="0.010" data-max-fan-dian="<?=$this->settings['betModeMaxFanDian2']?>" class="danwei">分</b><?}?>
					<?php if($this->settings['limosi']==1){?>
					<b value="0.001" data-max-fan-dian="<?=$this->settings['betModeMaxFanDian2']?>" class="danwei">厘</b><?}?>
				</div>
				
				
				
				
				<div class="beishu">
				<span class="spn8">倍数：</span>
				<input type="button" class="surbeishu" value="-"/><input id="beishu" value="<?=$this->ifs($_COOKIE['beishu'],1)?>" class="txt"/><input type="button" class="addbeishu" value="+"/>
				
		</div>	
		
				<div class="addOrderBox">
				  <div class="prompt" id="game-tip-dom">请选择号码</div>
				<input type="button" class="addBtn" onclick="gameActionAddCode()" value="添加投注">
				
				</div>

		
		</div>
		</div>
        </div>
		</div>
		</div>
		

		<div class="touzhu">
			<div class="lotteryBottom">
           <div class="addList">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tbody><tr>    
                    <td width="100%">
                        <div class="lotteryList">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="lt_cf_content">
								<tbody><tr class="cleanall">
                                    <th>玩法与投注号码</th>
                                    <th>模式</th>
                                    <th>资金模式</th>
                                    <th>注数</th>
                                    <th>倍投</th>
                                    <th>金额</th>
                                    <th><a href="javascript:void(0);" onclick="gameActionRemoveCode()" class="deleteAll cleanall">全删</a></th>
                                </tr>
							</tbody></table>
                        </div>
                    </td>
                    <td>
                        <div class="jixuan" id="lt_random_area"></div>
                    </td>
                </tr>
            </tbody></table>
        </div>

          
			<div class="touzhu-bottom">
			
				<div class="tz-tongji">
				<p>已选 <span id="lt_cf_count" class="num">0</span> 单，</p>
                <p>共计 <span id="lt_cf_nums" class="num">0</span> 注</p>
			  <p>总金额 <span id="lt_cf_money" class="num orange">0</span> 元</p>
				<div class="tz-buytype"></div></div>
				
				<label class="zh_title tz-buytype fqzhBox" name="lt_trace_if" style="padding: 3px 14px 3px 14px;line-height: 42px; /* height: 42px; */width: 132px;text-align: center;background: url(/images/nsc/lottery/tz.png) no-repeat;/* margin-left: -13px; */font-size: 20px; display: inline-block;
				color: #FFF; cursor: pointer;/* margin-top: -53px;*//*  margin-left: 230px;*/border-radius: 4px;float: right;">
			<input name="zhuiHao" id="lt_trace_if" style="display:none" value="yes" type="checkbox">追号</span> 
	  </label>
	 
	   <div class="sendChoose"><a href="javascript:void(0);" class="sendBtn" id="btnPostBet">立即投注</a></div>
					<div class="hemai" style="
    margin: 17px 15px 0 0;
    float: right;
    display: inline;
">
				 <input type="checkbox" class="is_combine" value="1" id="cannel_chckbox" style="
    display: inline;
    margin-top: 3px;
    width: 18px;
    height: 17px;
    float: left;
    margin-right: 2px;
    cursor: pointer;
"/><b class="fq" style="
    height: 22px;
    color: #ff632c;
    font-size: 13px;
">发起合买</b>
				 </div>
				</div>

		

			<!-----------投注记录----------------->		
		<?php if($this->settings['tzjl']==1){?>
	</div>




<img  width="100%" height="100%">
<div id="znz-game" style="display:none;"></div>
</div>
<div class="warp lotteryHistory">
        <div class="lotteryHistoryBody">
     
        </div>
     
           		
				   <div class="line">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
					    <th>单号</th>
						<th>投注时间</th>
						<th>彩种</th>
						<th>玩法</th>
						<th>期号</th>
						<th>投注号码(点击查看)</th>
						<th>倍数</th>
						<th>金额(元)</th>
						<th>奖金(元)</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody id="order-history"><?php $this->display('index/inc_game_order_history.php'); ?></tbody>
				

			</table>
	

<div class="getMore"><a class="sqlist" href="/index.php/record/search" title="查看更多投注记录" target="_blank">查看更多</a></div></div>
	<?}?>
	

	<div class="clear"></div>