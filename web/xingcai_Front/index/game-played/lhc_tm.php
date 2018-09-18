<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<div class="dGameStatus hklhc lotteryView_lhc" action="tzlhcSelect" length="1">
                <div class="Contentbox" id="Contentbox_0">
        <div class="lhcBox" >
		<dl>
			<dt>
		<span>号码</span><span>赔率</span><span>金额</span>
			</dt>
		<dd>
		<span id="RteSP01" class="red">01</span><span class="num"><?=$this->getLHCRte('RteSP01',$this->played)?></span>
		<span class="input"><input id="CdtSP01" name="SP" maxlength="5" acno="01" type="text"></span>
		</dd>
		<dd>
		<span class="red">02</span><span class="num"><?=$this->getLHCRte('RteSP02',$this->played)?></span>
		<span class="input"><input id="CdtSP02" name="SP" maxlength="5" acno="02" type="text"></span>
		</dd><dd>
		<span class="blue">03</span><span class="num"><?=$this->getLHCRte('RteSP03',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP03" name="SP" acno="03" type="text"></span>
		</dd><dd>
		<span class="blue">04</span><span class="num"><?=$this->getLHCRte('RteSP04',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP04" name="SP" acno="04" type="text"></span>
		</dd><dd>
		<span class="green">05</span><span class="num"><?=$this->getLHCRte('RteSP05',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP05" name="SP" acno="05" type="text"></span>
		</dd><dd>
		<span class="green">06</span><span class="num"><?=$this->getLHCRte('RteSP06',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP06" name="SP" acno="06" type="text"></span>
		</dd><dd>
		<span class="red">07</span><span class="num"><?=$this->getLHCRte('RteSP07',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP07" name="SP"  acno="07" type="text"></span>
		</dd><dd>
		<span class="red">08</span><span class="num"><?=$this->getLHCRte('RteSP08',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP08" name="SP" acno="08" type="text"></span>
		</dd><dd>
		<span class="blue">09</span><span class="num"><?=$this->getLHCRte('RteSP09',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP09" name="SP" acno="09" type="text"></span>
		</dd><dd>
		<span class="blue">10</span><span class="num"><?=$this->getLHCRte('RteSP10',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP10" name="SP" acno="10" type="text"></span>
		</dd></dl>
		<dl>
			<dt>
		<span>号码</span><span>赔率</span><span>金额</span>
			</dt>
		<dd>
		<span class="green">11</span><span class="num"><?=$this->getLHCRte('RteSP11',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP11" name="SP"  acno="11" type="text"></span>
		</dd><dd>
		<span class="red">12</span><span class="num"><?=$this->getLHCRte('RteSP12',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP12" name="SP" acno="12" type="text"></span>
		</dd><dd>
		<span class="red">13</span><span class="num"><?=$this->getLHCRte('RteSP13',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP13" name="SP" acno="13" type="text"></span>
		</dd><dd>
		<span class="blue">14</span><span class="num"><?=$this->getLHCRte('RteSP14',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP14" name="SP" acno="14" type="text"></span>
		</dd><dd>
		<span class="blue">15</span><span class="num"><?=$this->getLHCRte('RteSP15',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP15" name="SP" acno="14" type="text"></span>
		</dd><dd>
		<span class="green">16</span><span class="num"><?=$this->getLHCRte('RteSP16',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP16" name="SP" acno="16" type="text"></span>
		</dd><dd>
		<span class="green">17</span><span class="num"><?=$this->getLHCRte('RteSP17',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP17" name="SP" acno="17" type="text"></span>
		</dd><dd>
		<span class="red">18</span><span class="num"><?=$this->getLHCRte('RteSP18',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP18" name="SP" acno="18" type="text"></span>
		</dd><dd>
		<span class="red">19</span><span class="num"><?=$this->getLHCRte('RteSP19',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP19" name="SP" acno="19" type="text"></span>
		</dd><dd>
		<span class="blue">20</span><span class="num"><?=$this->getLHCRte('RteSP20',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP20" name="SP" acno="20" type="text"></span>
		</dd></dl>
		<dl>
			<dt>
		<span>号码</span><span>赔率</span><span>金额</span>
			</dt>
		<dd>
		<span class="green">21</span><span class="num"><?=$this->getLHCRte('RteSP21',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP21" name="SP"  acno="21" type="text"></span>
		</dd><dd>
		<span class="green">22</span><span class="num"><?=$this->getLHCRte('RteSP22',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP22" name="SP"  acno="22" type="text"></span>
		</dd><dd>
		<span class="red">23</span><span class="num"><?=$this->getLHCRte('RteSP23',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP23" name="SP"  acno="23" type="text"></span>
		</dd><dd>
		<span class="red">24</span><span class="num"><?=$this->getLHCRte('RteSP24',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP24" name="SP"  acno="24" type="text"></span>
		</dd><dd>
		<span class="blue">25</span><span class="num"><?=$this->getLHCRte('RteSP25',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP25" name="SP"  acno="25" type="text"></span>
		</dd><dd>
		<span class="blue">26</span><span class="num"><?=$this->getLHCRte('RteSP26',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP26" name="SP"  acno="26" type="text"></span>
		</dd><dd>
		<span class="green">27</span><span class="num"><?=$this->getLHCRte('RteSP27',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP27" name="SP"  acno="27" type="text"></span>
		</dd><dd>
		<span class="green">28</span><span class="num"><?=$this->getLHCRte('RteSP28',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP28" name="SP"  acno="28" type="text"></span>
		</dd><dd>
		<span class="red">29</span><span class="num"><?=$this->getLHCRte('RteSP29',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP29" name="SP"  acno="29" type="text"></span>
		</dd><dd>
		<span class="red">30</span><span class="num"><?=$this->getLHCRte('RteSP30',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP30" name="SP"  acno="30" type="text"></span>
		</dd></dl>
		<dl>
			<dt>
		<span>号码</span><span>赔率</span><span>金额</span>
			</dt>
		<dd>
		<span class="blue">31</span><span class="num"><?=$this->getLHCRte('RteSP31',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP31" name="SP" acno="31" type="text"></span>
		</dd><dd>
		<span class="green">32</span><span class="num"><?=$this->getLHCRte('RteSP32',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP32" name="SP" acno="32" type="text"></span>
		</dd><dd>
		<span class="green">33</span><span class="num"><?=$this->getLHCRte('RteSP33',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP33" name="SP" acno="33" type="text"></span>
		</dd><dd>
		<span class="red">34</span><span class="num"><?=$this->getLHCRte('RteSP34',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP34" name="SP" acno="34" type="text"></span>
		</dd><dd>
		<span class="red">35</span><span class="num"><?=$this->getLHCRte('RteSP35',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP35" name="SP" acno="35" type="text"></span>
		</dd><dd>
		<span class="blue">36</span><span class="num"><?=$this->getLHCRte('RteSP36',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP36" name="SP" acno="36" type="text"></span>
		</dd><dd>
		<span class="blue">37</span><span class="num"><?=$this->getLHCRte('RteSP37',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP37" name="SP" acno="37" type="text"></span>
		</dd><dd>
		<span class="green">38</span><span class="num"><?=$this->getLHCRte('RteSP38',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP38" name="SP" acno="38" type="text"></span>
		</dd><dd>
		<span class="green">39</span><span class="num"><?=$this->getLHCRte('RteSP39',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP39" name="SP" acno="39" type="text"></span>
		</dd><dd>
		<span class="red">40</span><span class="num"><?=$this->getLHCRte('RteSP40',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP40" name="SP" acno="40" type="text"></span>
		</dd></dl>
		<dl>
			<dt>
		<span>号码</span><span>赔率</span><span>金额</span>
			</dt>
		<dd>
		<span class="blue">41</span><span class="num"><?=$this->getLHCRte('RteSP41',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP41" name="SP" acno="41" type="text"></span>
		</dd><dd>
		<span class="blue">42</span><span class="num"><?=$this->getLHCRte('RteSP42',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP42" name="SP" acno="42" type="text"></span>
		</dd><dd>
		<span class="green">43</span><span class="num"><?=$this->getLHCRte('RteSP43',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP43" name="SP" acno="43" type="text"></span>
		</dd><dd>
		<span class="green">44</span><span class="num"><?=$this->getLHCRte('RteSP44',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP44" name="SP" acno="44" type="text"></span>
		</dd><dd>
		<span class="red">45</span><span class="num"><?=$this->getLHCRte('RteSP45',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP45" name="SP" acno="45" type="text"></span>
		</dd><dd>
		<span class="red">46</span><span class="num"><?=$this->getLHCRte('RteSP46',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP46" name="SP" acno="46" type="text"></span>
		</dd><dd>
		<span class="blue">47</span><span class="num"><?=$this->getLHCRte('RteSP47',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP47" name="SP" acno="47" type="text"></span>
		</dd><dd>
		<span class="blue">48</span><span class="num"><?=$this->getLHCRte('RteSP48',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP48" name="SP" acno="48" type="text"></span>
		</dd>
		<dd>
		<span class="green">49</span><span class="num"><?=$this->getLHCRte('RteSP49',$this->played)?></span>
		<span class="input"><input maxlength="5" id="CdtSP49" name="SP" acno="49" type="text"></span>
		</dd><dd>
		</dd>
		</dl>
		
		
		<div class="dGameStatus hklhc lotteryView_lhc2" action="tzlhcSelect" length="1">
                <div class="Contentbox" id="Contentbox_0">
        <div class="lhcBox2" >
		<dl>
			<dt>
		<span>号码</span><span style="width:76px;">赔率</span><span style="width:28px;">金额</span>
			</dt>
		<dd>
		<span id="RteSPBSOED" class="sGameStatusItem">特大</span><span class="num" style="margin-left:12px;"><?=$this->getLHCRte('RteSPBSOED',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPBSD" name="SPBSOE" acno="特大" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPBSOES" class="sGameStatusItem">特小</span><span class="num" style="margin-left:12px;"><?=$this->getLHCRte('RteSPBSOES',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPBSS" name="SPBSOE" acno="特小" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPH2DO" class="sGameStatusItem">大单</span><span class="num" style="margin-left:12px;"><?=$this->getLHCRte('RteSPH2DO',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPDODO" name="SPH2" acno="大单" type="text"></span>
		</dd>
		</dl>
			<dl>
		<dt>
		<span>号码</span><span style="width:76px;">赔率</span><span style="width:28px;">金额</span>
			</dt>
		<dd>
		<span id="RteSPBSOEO" class="sGameStatusItem">特单</span><span class="num" style="margin-left:12px;"><?=$this->getLHCRte('RteSPBSOEO',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPOEO" name="SPBSOE" acno="特单" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPBSOEE" class="sGameStatusItem">特双</span><span class="num" style="margin-left:12px;"><?=$this->getLHCRte('RteSPBSOEE',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPOEE" name="SPBSOE" acno="特双" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPH2DE" class="sGameStatusItem">大双</span><span class="num" style="margin-left:12px;"><?=$this->getLHCRte('RteSPH2DE',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPDODO" name="SPH2" acno="大单" type="text"></span>
		</dd>
			</dl>
			<dl>
		<dt>
		<span>号码</span><span style="width:76px;">赔率</span><span style="width:28px;">金额</span>
			</dt>
		<dd>
		<span id="RteSPTBSOED" class="sGameStatusItem">合大</span><span class="num" style="margin-left:12px;"><?=$this->getLHCRte('RteSPTBSOED',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPTBSD" name="SPTBSOE" acno="合大" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPTBSOES" class="sGameStatusItem">合小</span><span class="num" style="margin-left:12px;"><?=$this->getLHCRte('RteSPTBSOES',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPTBSS" name="SPTBSOE" acno="合小" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPH2SO" class="sGameStatusItem">小单</span><span class="num" style="margin-left:12px;"><?=$this->getLHCRte('RteSPH2SO',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPSOSO" name="SPH2" acno="小单" type="text"></span>
		</dd>
			</dl>
			<dl>
		<dt>
		<span>号码</span><span style="width:76px;">赔率</span><span style="width:28px;">金额</span>
			</dt>
		<dd>
		<span id="RteSPTBSOEO" class="sGameStatusItem">合单</span><span class="num" style="margin-left:12px;"><?=$this->getLHCRte('RteSPTBSOEO',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPTOEO" name="SPTBSOE" acno="合单" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPTBSOEE" class="sGameStatusItem">合双</span><span class="num" style="margin-left:12px;"><?=$this->getLHCRte('RteSPTBSOEE',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPTOEE" name="SPTBSOE" acno="合双" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPH2SE" class="sGameStatusItem">小双</span><span class="num" style="margin-left:12px;"><?=$this->getLHCRte('RteSPH2SE',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPSESE" name="SPH2" acno="小双" type="text"></span>
		</dd>
			</dl>
			<dl>
		<dt>
		<span>号码</span><span style="width:76px;">赔率</span><span style="width:28px;">金额</span>
			</dt>
		<dd>
		<span id="RteSPSBSD" class="sGameStatusItem">特尾大</span><span class="num" style="margin-left:-3px;"><?=$this->getLHCRte('RteSPSBSD',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPSBSD" name="SPSBS" acno="特尾大" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPSBSS" class="sGameStatusItem">特尾小</span><span class="num" style="margin-left:-3px;"><?=$this->getLHCRte('RteSPSBSS',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPSBSS" name="SPSBS" acno="特尾小" type="text"></span>
		</dd>
			</dl>	

    
		</div>
                 
         </div>
              </div>    </div>    </div>
            </div>
		
				<div class="addOrderBox" >
                <div class="addOrderLeft addOrderLeft625">
                                   
                   <input type="button" class="addBtn" onclick="bringRte();" value="添加投注">
                    <div class="chooseMsg">
                        <p>总金额共 <span id="sTotalCredit">0</span> 元</p>
                    </div>
                </div>
           
            </div>