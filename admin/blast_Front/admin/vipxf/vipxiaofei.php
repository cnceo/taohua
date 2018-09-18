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
			<th>当日游戏流水</th><th>VIP1</th><th>VIP2</th><th>VIP3</th><th>VIP4</th><th>VIP5</th><th>VIP6</th><th>VIP7</th><th>VIP8</th><th>VIP9</th>
			<?php
				for($i=0;$i<count($this->jlrules);$i++){
					$rule=$this->jlrules[$i];
					$str="rule".$i;
					echo "<tr><td><input type='text' value='$rule[money]' name='$str"."[money]' style='width:100px;'/></td><td><input type='text' value='$rule[yi]' name='$str"."[yi]' style='width:60px;'/></td><td><input type='text' value='$rule[er]' name='$str"."[er]' style='width:60px;'/></td><td><input type='text' value='$rule[san]' name='$str"."[san]' style='width:60px;'/></td><td><input type='text' value='$rule[si]' name='$str"."[si]' style='width:60px;'/></td><td><input type='text' value='$rule[wu]' name='$str"."[wu]' style='width:60px;'/></td><td><input type='text' value='$rule[liu]' name='$str"."[liu]' style='width:60px;'/></td><td><input type='text' value='$rule[qi]' name='$str"."[qi]' style='width:60px;'/></td><td><input type='text' value='$rule[ba]' name='$str"."[ba]' style='width:60px;'/></td><td><input type='text' value='$rule[jiu]' name='$str"."[jiu]' style='width:60px;'/></td></tr>";
				}
			?>
			
				
				
			
			
			
		</tbody>
	</table>
	<footer>
		<div class="submit_link">
			<input type="submit" value="保存修改设置" onclick="return setjj()" title="保存设置" >
		</div>
	</footer>
	</form>
</article>
<script>
			
			function setjj(){
				  $.ajax({
                    type: "POST",
                    dataType: "html",
                    url: "./index.php/vipxf/setjj/",
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