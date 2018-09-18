<form action="/index.php/score/dzyhtked" method="post" target="ajax" onajax="Beforindexdzyh" call="indexdzyhtked" onkeydown="if(event.keyCode==13)return false;">
      
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="grayTable">
                <!---->
                	                                              <tr>
              <td class="u_add_zl">提款人：</td>
              <td class="u_add_zr" >
              <label><?=$this->user['username']?></span></label>
              </td>
              </tr>
              <tr>
                <td class="u_add_zl">存款时间：</td>
                <td class="u_add_zr" ><?=date('Y-m-d H:i',$args[0]['time'])?></td>
              </tr>
              <tr>
                <td class="u_add_zl">提款时间：</td>
                <td class="u_add_zr" ><?=date('Y-m-d H:i',$this->time)?></td>
              </tr>
              <tr>
                <td class="u_add_zl">本息+利息总额：</td>
                <td class="u_add_zr" ><?=$args[0]['ck_money']?>&nbsp+<?=$args[0]['lx']?>&nbsp=&nbsp<?=$args[0]['ck_money']+$args[0]['lx']?>&nbsp元</td>
              </tr>
			  <tr>
                <td class="u_add_zl">资金密码：</td>
                <td class="u_add_zr" ><input type="password" name="coinpassword" id="coinpassword" value=""/></td>
              </tr>
			  <tr>
                <td class="u_add_zl">验证码：</td>
                <td class="u_add_zr" ><input type="text" name="vcode" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9]/,'');}).call(this)" onblur="this.v();" maxlength="4"/><p class="hint_p"></p><img width="58" height="32" border="0" style="cursor:pointer;margin-bottom:0px;" id="vcode" alt="看不清？点击更换" align="absmiddle" src="/index.php/user/vcode/<?=$this->time?>" title="看不清楚，换一张图片" onclick="this.src='/index.php/user/vcode/'+(new Date()).getTime()"/></td>
              </tr>
			  <tr>
			   <td class="u_add_zl"></td>
			   <td class="u_add_zl"><input type="submit" class="formWord" value="确认存款">
			   </td>
			  </tr>
            
		
	
</form>
