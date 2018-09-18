<?php $good=$args[0]; ?>
<?php if($good['price']>0){ ?>

<form action="/index.php/score/swapGood" method="post" target="ajax" onajax="scoreBeforeSwapGood2" call="scoreSwapGood">
<input type="hidden" name="goodId" value="<?=$good['id']?>"/>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="grayTable">
       
              <tr>
              <td class="u_add_zl">此次兑换：</td>
              <td class="u_add_zr" >
              <label><span class="spn16"><?=$good['score']?></span> 积分= <span class="spn16"><?=$good['price']?></span> 元</label>
              </td>
              </tr>
              <tr>
                <td class="u_add_zl">此次兑换将扣除您：</td>
                <td class="u_add_zr" ><label><span class="spn16"><?=$good['score']?></span> 积分！</label></td>
              </tr>
              <tr>
                <td class="u_add_zl">兑换数量：</td>
                <td class="u_add_zr" ><input name="number" value="1" style="text-align: center;"/></td>
              </tr>
			  <tr>
                <td class="u_add_zl">资金密码：</td>
                <td class="u_add_zr" ><input type="password" name="coinpwd" value=""/></td>
              </tr>
			  <tr>
			   <td class="u_add_zl"><?=$this->settings['scoreRule']?></td>
			   <td class="u_add_zl"><input type="submit" id='put_button_pass' class="formWord" value="确认兑换"></td>
			  </tr>
           
		
	
</form>
<?php }?>  