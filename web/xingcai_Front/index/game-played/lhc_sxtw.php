<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<div class="dGameStatus hklhc lotteryView_sxtw" action="tzlhcSelect" length="1">
                <div class="Contentbox" id="Contentbox_0">
        <div class="sxtwBox" >
		<dl>
			<dt>
		<span>生肖</span><span style="margin-left:50px;">号码</span><span style="margin-left:111px;">赔率</span><span>金额</span>
			</dt>
		<dd>
		<span class="sGameStatusItem">鼠</span><span style="margin-left: 30px;" class="blue">10</span><span class="green">22</span><span class="green">34</span><span class="red">46</span><span style="margin-left:60px;" class="num"><?=$this->getLHCRte('RteSPA01',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPA01" name="SPANM" acno="鼠" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">牛</span><span style="margin-left: 30px;" class="red">09</span><span class="blue">21</span><span class="green">33</span><span class="green">45</span><span style="margin-left:60px;" class="num"><?=$this->getLHCRte('RteSPA02',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPA02" name="SPANM" acno="牛" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">虎</span><span style="margin-left: 30px;" class="red">08</span><span class="red">20</span><span class="blue">32</span><span class="green">44</span><span style="margin-left:60px;" class="num"><?=$this->getLHCRte('RteSPA03',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPA03" name="SPANM" acno="虎" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">兔</span><span style="margin-left: 30px;" class="green">07</span><span class="red">19</span><span class="red">31</span><span class="blue">43</span><span style="margin-left:60px;" class="num"><?=$this->getLHCRte('RteSPA04',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPA04" name="SPANM" acno="兔" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">龙</span><span style="margin-left: 30px;" class="green">06</span><span class="green">18</span><span class="red">30</span><span class="blue">42</span><span style="margin-left:60px;" class="num"><?=$this->getLHCRte('RteSPA05',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPA05" name="SPANM" acno="龙" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">蛇</span><span style="margin-left: 30px;" class="blue">05</span><span class="green">17</span><span class="green">29</span><span class="red">41</span><span style="margin-left:60px;" class="num"><?=$this->getLHCRte('RteSPA06',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPA06" name="SPANM" acno="蛇" type="text"></span>
		</dd>
		</dl>
		<dl>
			<dt>
		<span>生肖</span><span style="margin-left:50px;">号码</span><span style="margin-left:111px;">赔率</span><span>金额</span>
			</dt>
		<dd>
		<span class="sGameStatusItem">马</span><span style="margin-left: 30px;" class="blue">04</span><span class="blue">16</span><span class="green">28</span><span class="green">40</span><span style="margin-left:60px;" class="num"><?=$this->getLHCRte('RteSPA07',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPA07" name="SPANM" acno="马" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">羊</span><span style="margin-left: 30px;" class="red">03</span><span class="blue">15</span><span class="blue">27</span><span class="green">39</span><span style="margin-left:60px;" class="num"><?=$this->getLHCRte('RteSPA08',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPA08" name="SPANM" acno="羊" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">鸡</span><span style="margin-left: 30px;" class="red">01</span><span class="red">13</span><span class="blue">25</span><span class="blue">37</span><span class="green">49</span><span style="margin-left:27px;" class="num"><?=$this->getLHCRte('RteSPA09',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPA09" name="SPANM" acno="鸡" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">猴</span><span style="margin-left: 30px;" class="red">2</span><span class="red">14</span><span class="blue">26</span><span class="blue">38</span><span style="margin-left:60px;" class="num"><?=$this->getLHCRte('RteSPA10',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPA10" name="SPANM" acno="猴" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">狗</span><span style="margin-left: 30px;" class="green">12</span><span class="red">24</span><span class="red">36</span><span class="blue">48</span><span style="margin-left:60px;" class="num"><?=$this->getLHCRte('RteSPA11',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPA11" name="SPANM" acno="狗" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">猪</span><span style="margin-left: 30px;" class="blue">11</span><span class="green">23</span><span class="red">35</span><span class="red">47</span><span style="margin-left:60px;" class="num"><?=$this->getLHCRte('RteSPA12',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPA12" name="SPANM" acno="猪" type="text"></span>
		</dd>
		</dl>
		<div class="dGameStatus hklhc lotteryView_lhc1" action="tzlhcSelect" length="1">
                <div class="Contentbox" id="Contentbox_0">
        <div class="lhcBox1" >
		<dl style="width:311px;">
			<dt>
		<span style="width:100px;">特别号头数</span><span style="margin-left:85px;">赔率</span><span style="margin-left:-7px;">金额</span>
			</dt>
		<dd>
		<span class="sGameStatusItem">0头</span><span style="margin-left:135px;" class="num"><?=$this->getLHCRte('RteSPTD0',$this->played)?></span>
		<span class="input"><input  maxlength="5" id="CdtSPTD0" name="SPTD" acno="0头" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">1头</span><span style="margin-left:135px;" class="num"><?=$this->getLHCRte('RteSPTD1',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPTD1" name="SPTD" acno="1头" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">2头</span><span style="margin-left:135px;" class="num"><?=$this->getLHCRte('RteSPTD2',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPTD2" name="SPTD" acno="2头" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">3头</span><span style="margin-left:135px;" class="num"><?=$this->getLHCRte('RteSPTD3',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPTD3" name="SPTD" acno="3头" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">4头</span><span style="margin-left:135px;" class="num"><?=$this->getLHCRte('RteSPTD4',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPTD4" name="SPTD" acno="4头" type="text"></span>
		</dd>
		</dl>	
		
		<dl style="width:311px;">
			<dt>
		<span style="width:100px;">特别号尾数</span><span style="margin-left:85px;">赔率</span><span style="margin-left:-7px;">金额</span>
			</dt>
		<dd>
		<span class="sGameStatusItem">0尾</span><span style="margin-left:135px;" class="num"><?=$this->getLHCRte('RteSPSD0',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPSD0" name="SPSD" acno="0尾" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">1尾</span><span style="margin-left:135px;"  class="num"><?=$this->getLHCRte('RteSPSD1',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPSD1" name="SPSD" acno="1尾" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">2尾</span><span style="margin-left:135px;" class="num"><?=$this->getLHCRte('RteSPSD2',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPSD2" name="SPSD" acno="2尾" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">3尾</span><span style="margin-left:135px;" class="num"><?=$this->getLHCRte('RteSPSD3',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPSD3" name="SPSD" acno="3尾" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">4尾</span><span style="margin-left:135px;" class="num"><?=$this->getLHCRte('RteSPSD4',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPSD4" name="SPSD" acno="4尾" type="text"></span>
		</dd>
		</dl>
		
 		<dl style="width:312px;">
			<dt>
		<span style="width:100px;">特别号头数</span><span style="margin-left:85px;">赔率</span><span style="margin-left:-7px;">金额</span>
			</dt>
		<dd>
		<span class="sGameStatusItem">5尾</span><span style="margin-left:135px;" class="num"><?=$this->getLHCRte('RteSPSD5',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPSD5" name="SPSD" acno="5尾" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">6尾</span><span style="margin-left:135px;" class="num"><?=$this->getLHCRte('RteSPSD6',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPSD6" name="SPSD" acno="6尾" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">7尾</span><span style="margin-left:135px;" class="num"><?=$this->getLHCRte('RteSPSD7',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPSD7" name="SPSD" acno="7尾" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">8尾</span><span style="margin-left:135px;" class="num"><?=$this->getLHCRte('RteSPSD8',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPSD8" name="SPSD" acno="8尾" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">9尾</span><span style="margin-left:135px;" class="num"><?=$this->getLHCRte('RteSPSD9',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSPSD9" name="SPSD" acno="9尾" type="text"></span>
		</dd>
		</dl>   
		    
		</div>
                 
         </div>
              </div>    
			  </div>  
			  </div>
            </div>
		
				<div class="addOrderBox" >
                <div class="addOrderLeft addOrderLeftsxtw">
                                   
                   <input type="button" class="addBtn" onclick="bringRte();" value="添加投注">
                    <div class="chooseMsg">
                        <p>总金额共 <span id="sTotalCredit">0</span> 元</p>
                    </div>
                </div>
           
            </div>