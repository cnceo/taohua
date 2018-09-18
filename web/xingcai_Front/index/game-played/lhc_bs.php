<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<div class="dGameStatus hklhc lotteryView_bs" action="tzlhcSelect" length="1">
                <div class="Contentbox" id="Contentbox_0">
        <div class="bsBox" >
		
		<dl>
			<dt>
		<span>特别号半波</span><span style="width:76px;">赔率</span><span style="width:28px;">金额</span>
			</dt>
		<dd>
		<span class="sGameStatusItem">红大</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPHCRD',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPHCRD" name="SPHC" acno="红大" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">蓝大</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPHCBD',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPHCBD" name="SPHC" acno="蓝大" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">绿大</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPHCGD',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPHCGD" name="SPHC" acno="绿大" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">红小</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPHCRS',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPHCRS" name="SPHC" acno="红小" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">蓝小</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPHCBS',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPHCBS" name="SPHC" acno="蓝小" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">绿小</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPHCGS',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPHCGS" name="SPHC" acno="绿小" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">红单</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPHCRO',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPHCRO" name="SPHC" acno="红单" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">蓝单</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPHCBO',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPHCBO" name="SPHC" acno="蓝单" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">绿单</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPHCGO',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPHCGO" name="SPHC" acno="绿单" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">红双</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPHCRE',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPHCRE" name="SPHC" acno="红双" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">蓝双</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPHCBE',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPHCBE" name="SPHC" acno="蓝双" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">绿双</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPHCGE',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPHCGE" name="SPHC" acno="绿双" type="text"></span>
		</dd>
		</dl>
		
			<dl>
		<dt>
		<span>特别号半半波</span><span style="width:76px;">赔率</span><span style="width:28px;">金额</span>
			</dt>
		<dd>
		<span id="RteSPBSOED" class="sGameStatusItem">红大单</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPRDO',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPRDO" name="SPHHC" acno="红大单" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPBSOES" class="sGameStatusItem">蓝大单</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPBDO',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPBDO" name="SPHHC" acno="蓝大单" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPH2DO" class="sGameStatusItem">绿大单</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPGDO',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPGDO" name="SPHHC" acno="绿大单" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPH2DO" class="sGameStatusItem">红大双</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPRDE',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPRDE" name="SPHHC" acno="红大双" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPBSOED" class="sGameStatusItem">蓝大双</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPBDE',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPBDE" name="SPHHC" acno="蓝大双" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPBSOES" class="sGameStatusItem">绿大双</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPGDE',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPGDE" name="SPHHC" acno="绿大双" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPH2DO" class="sGameStatusItem">红小单</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPRSO',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPRSO" name="SPHHC" acno="红小单" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPH2DO" class="sGameStatusItem">蓝小单</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPBSO',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPBSO" name="SPHHC" acno="蓝小单" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPBSOED" class="sGameStatusItem">绿小单</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPGSO',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPGSO" name="SPHHC" acno="绿小单" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPBSOES" class="sGameStatusItem">红小双</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPRSE',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPRSE" name="SPHHC" acno="红小双" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPH2DO" class="sGameStatusItem">蓝小双</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPBSE',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPBSE" name="SPHHC" acno="蓝小双" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPH2DO" class="sGameStatusItem">绿小双</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPGSE',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPGSE" name="SPHHC" acno="绿小双" type="text"></span>
		</dd>
			</dl>
		
		
			<dl>
		<dt>
		<span>特别号色波</span><span style="width:76px;">赔率</span><span style="width:28px;">金额</span>
			</dt>
		<dd>
		<span class="sGameStatusItem">红波</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPRR',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPRR" name="SPCLR" acno="红波" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">蓝波</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPBB',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPBB" name="SPCLR" acno="蓝波" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">绿波</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPGG',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="CdtSPGG" name="SPCLR" acno="绿波" type="text"></span>
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