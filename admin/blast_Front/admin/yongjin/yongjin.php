<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
	<header><h3 class="tabs_involved">佣金设置</h3></header>
	<form id="myform" name="system_install"  method="post" >
	<table class="tablesorter left" cellspacing="0" width="100%">
		<thead>
			<tr>
				<td width="160" style="text-align:left;">配置项目</td>
				<td style="text-align:left;">配置值</td>
			</tr>
		</thead>
		<tbody>
			
			<tr>
				<td>佣金开关</td>
				<td>
					<label><input type="radio" value="1" name="type" <?=$this->iff($this->yjs['type'],'checked="checked"')?>/>开启</label>
					<label><input type="radio" value="0" name="type" <?=$this->iff(!$this->yjs['type'],'checked="checked"')?>/>关闭</label>
				</td>
			</tr>
			<tr>
				<td>领取时间</td>
				<td><input type="text" style='width:50px;' value="<?=$this->yjs['startime']?>" name="startime"/>---
				<input type="text" style='width:50px;' value="<?=$this->yjs['endtime']?>" name="endtime"/></td>
			</tr>
            <tr>
				<td>类型</td>
				<td>
					<label><select id='tselect'>
						<option value="t1" checked>类型1</option>
						<option value="t2">类型2</option>
						<option value="t3">类型3</option>
						<option value="t4">类型4</option>
						<option value="t5">类型5</option>
						</select> </label>
				</td>

			</tr>
			<thead class='t1' >
				<tr>
					<td>金定</td>
					<td><input type="text" value="<?=$this->yj1['endtime']?>" name="yjs1[money]"/></td>
				</tr>
				<tr>
					<td>类型1开关</td>
					<td>
					<label><input type="radio" value="1" name="yjs1[type]" <?=$this->iff($this->yj1['type'],'checked="checked"')?>/>开启</label>
					<label><input type="radio" value="0" name="yjs1[type]" <?=$this->iff(!$this->yj1['type'],'checked="checked"')?>/>关闭</label>
					</td>
				</tr>
				<tr>
					<td>上级</td>
					<td><input type="text" name="yjs1[lvone]" value="<?=$this->yj1['lvone']?>" /></td>
				</tr>
				<tr>
					<td>上上级</td>
					<td><input type="text" value="<?=$this->yj1['lvtwo']?>" name="yjs1[lvtwo]"/></td>
				</tr>
				<tr>
					<td>上上上级</td>
					<td><input type="text" value="<?=$this->yj1['lvtress']?>" name="yjs1[lvtress]"/></td>
				</tr>
				<tr>
					<td>上上上上级</td>
					<td><input type="text" value="<?=$this->yj1['lvfour']?>" name="yjs1[lvfour]"/></td>
				</tr>
				
			</thead>
			<thead class='t2' style="display:none;">
				<tr>
					<td>金额限定</td>
					<td><input type="text" value="<?=$this->yj2['endtime']?>" name="yjs2[money]"/></td>
				</tr>
				<tr>
					<td>类型2开关</td>
					<td>
					<label><input type="radio" value="1" name="yjs2[type]" <?=$this->iff($this->yj2['type'],'checked="checked"')?>/>开启</label>
					<label><input type="radio" value="0" name="yjs2[type]" <?=$this->iff(!$this->yj2['type'],'checked="checked"')?>/>关闭</label>
					</td>
				</tr>
				<tr>
					<td>上级</td>
					<td><input type="text" value="<?=$this->yj2['lvone']?>" name="yjs2[lvone]"/></td>
				</tr>
				<tr>
					<td>上上级</td>
					<td><input type="text" value="<?=$this->yj2['lvtwo']?>" name="yjs2[lvtwo]"/></td>
				</tr>
				<tr>
					<td>上上上级</td>
					<td><input type="text" value="<?=$this->yj2['lvtress']?>" name="yjs2[lvtress]"/></td>
				</tr>
				<tr>
					<td>上上上上级</td>
					<td><input type="text" value="<?=$this->yj2['lvfour']?>" name="yjs2[lvfour]"/></td>
				</tr>
				
			</thead>
			<thead class='t3' style="display:none;">
				<tr>
					<td>金额限定</td>
					<td><input type="text" value="<?=$this->yj3['endtime']?>" name="yjs3[money]"/></td>
				</tr>
				<tr>
					<td>类型3开关</td>
					<td>
					<label><input type="radio" value="1" name="yjs3[type]" <?=$this->iff($this->yj3['type'],'checked="checked"')?>/>开启</label>
					<label><input type="radio" value="0" name="yjs3[type]" <?=$this->iff(!$this->yj3['type'],'checked="checked"')?>/>关闭</label>
					</td>
				</tr>
				<tr>
					<td>上级</td>
					<td><input type="text" value="<?=$this->yj3['lvone']?>" name="yjs3[lvone]"/></td>
				</tr>
				<tr>
					<td>上上级</td>
					<td><input type="text" value="<?=$this->yj3['lvtwo']?>" name="yjs3[lvtwo]"/></td>
				</tr>
				<tr>
					<td>上上上级</td>
					<td><input type="text" value="<?=$this->yj3['lvtress']?>" name="yjs3[lvtress]"/></td>
				</tr>
				<tr>
					<td>上上上上级</td>
					<td><input type="text" value="<?=$this->yj3['lvfour']?>" name="yjs3[lvfour]"/></td>
				</tr>
				
			</thead>
			<thead class='t4' style="display:none;">
				<tr>
					<td>金额限定</td>
					<td><input type="text" value="<?=$this->yj4['endtime']?>" name="yjs4[money]"/></td>
				</tr>
				<tr>
					<td>类型4开关</td>
					<td>
					<label><input type="radio" value="1" name="yjs4[type]" <?=$this->iff($this->yj4['type'],'checked="checked"')?>/>开启</label>
					<label><input type="radio" value="0" name="yjs4[type]" <?=$this->iff(!$this->yj4['type'],'checked="checked"')?>/>关闭</label>
					</td>
				</tr>
				<tr>
					<td>上级</td>
					<td><input type="text" value="<?=$this->yj4['lvone']?>" name="yjs4[lvone]"/></td>
				</tr>
				<tr>
					<td>上上级</td>
					<td><input type="text" value="<?=$this->yj4['lvtwo']?>" name="yjs4[lvtwo]"/></td>
				</tr>
				<tr>
					<td>上上上级</td>
					<td><input type="text" value="<?=$this->yj4['lvtress']?>" name="yjs4[lvtress]"/></td>
				</tr>
				<tr>
					<td>上上上上级</td>
					<td><input type="text" value="<?=$this->yj4['lvfour']?>" name="yjs4[lvfour]"/></td>
				</tr>
				
			</thead>
			<thead class='t5' style="display:none;">
				<tr>
					<td>金额限定</td>
					<td><input type="text" value="<?=$this->yj5['endtime']?>" name="yjs5[money]"/></td>
				</tr>
				<tr>
					<td>类型5开关</td>
					<td>
					<label><input type="radio" value="1" name="yjs5[type]" <?=$this->iff($this->yj5['type'],'checked="checked"')?>/>开启</label>
					<label><input type="radio" value="0" name="yjs5[type]" <?=$this->iff(!$this->yj5['type'],'checked="checked"')?>/>关闭</label>
					</td>
				</tr>
				<tr>
					<td>上级</td>
					<td><input type="text" value="<?=$this->yj5['lvone']?>" name="yjs5[lvone]"/></td>
				</tr>
				<tr>
					<td>上上级</td>
					<td><input type="text" value="<?=$this->yj5['lvtwo']?>" name="yjs5[lvtwo]"/></td>
				</tr>
				<tr>
					<td>上上上级</td>
					<td><input type="text" value="<?=$this->yj5['lvtress']?>" name="yjs5[lvtress]"/></td>
				</tr>
				<tr>
					<td>上上上上级</td>
					<td><input type="text" value="<?=$this->yj5['lvfour']?>" name="yjs5[lvfour]"/></td>
				</tr>
				
			</thead>
			
			
		</tbody>
	</table>
	<footer>
		<div class="submit_link">
			<input type="submit" value="保存修改设置" onclick="return setyj()" title="保存设置" >
		</div>
	</footer>
	</form>
</article>
<script>
			
			function setyj(){
				  $.ajax({
                    type: "POST",
                    dataType: "html",
                    url: "./index.php/yongjin/updateyjSettings/",
                    data: $('#myform').serialize(),
                    success: function (res) {
                        if(res=='y'){
							alert("修改成功");
						}
                        //加载最大可退金额
                    },
                    error: function(data) {
                        alert("error:"+data.responseText);
                     }

                });

				return false;
			}
	
				$('#tselect').change(function(){
					var classname=$('#tselect').val();
					if(classname=='t1'){
						$('.t1').show();
						$('.t2').hide();
						$('.t3').hide();
						$('.t4').hide();
						$('.t5').hide();						
					}else if(classname=='t2'){
						$('.t2').show();
						$('.t1').hide();
						$('.t3').hide();
						$('.t4').hide();
						$('.t5').hide();
					}else if(classname=='t3'){
						$('.t3').show();
						$('.t1').hide();
						$('.t2').hide();
						$('.t4').hide();
						$('.t5').hide();
					}else if(classname=='t4'){
						$('.t4').show();
						$('.t1').hide();
						$('.t3').hide();
						$('.t2').hide();
						$('.t5').hide();
					}else{
						$('.t5').show();
						$('.t1').hide();
						$('.t3').hide();
						$('.t2').hide();
						$('.t4').hide();
						
					}
					
						
					
					
				});
			</script>