
<style type="text/css">
/*开奖记录*/
.todaykjdata{width:100%; overflow:hidden; margin:0 auto;border-top: 3px solid #C5AC08;border-bottom:3px solid #C5AC08;}
.buyleft-number {
    display: inline;
    width: 100%;
	margin:0 auto;

}
.buyleft-number p {
    background: none repeat scroll 0 0 #d0d291;
    border: 1px solid #b5aC08;
    height: 30px;
    width: 100%;
}
.buyleft-number p span {
    font-size: 14px;
    line-height: 30px;
    text-align: left;
    text-indent: 10px;
    width: 200px;
    color: #111;	padding: 10px;

}
.buyleft-number p a {
    background: url("/skin/images/about/ss.png") no-repeat scroll 35px 10px ;
    color: #1e50a2;
    float: right;
    line-height: 30px;
    padding-right: 10px;
    width: 50px;
}
.buyleft-number div {
    border-bottom: 1px solid #d0d291;
    overflow: hidden;
    width: 100%;
	background: none repeat scroll 0 0 #d0d291;
}
.buyleft-number table {
    border-left: 1px solid #d0d291;
    float: left;
    overflow: hidden;
    width: 250px;
	background: none repeat scroll 0 0 #d0d291;
}
.buyleft-number table thead tr {
    font-weight: bold;
}
.buyleft-number table tr {
    height: 25px;
    width: 100%;
}
.buyleft-number table tr td {
    border-top: 1px solid #C5AC08;
    height: 23px;
    line-height: 23px;padding: 4px;
    overflow: hidden;
    width: 20%;color: #111;
}
.buyleft-number table tbody td {
    color: #444;
}
.color32 {
    color: #9b5602;
}
.buyleft-number table tbody td.color32 {
    color: #ba2636;
}
.buyleft-number table tbody td.zs {
    color: #fa6705;
}</style>
<script type="text/javascript">
	function closeopen (argument) {
				var target=$(argument).attr('target');
				$('#'+target).slideToggle(400);
				return false;
	}
</script>
<?php
if($this->type==1 || $this->type==3 || $this->type==12 || $this->type==14){?>
<div class="todaykjdata"> 
<div class="buyleft-number ">
<p><span>今日开奖号码</span><a href="javascript:void(0);" target="todaykjdata" name="a-TodayNum" class="toggleOpen open"  onclick="closeopen(this)">展开收起</a></p>
<div style="display: block;"  id='todaykjdata'>
	<?php
		$typeNums=$this->getValue("select count(*) from {$this->prename}data_time where type={$this->type}");
		$date=strtotime('00:00');
		$perCunm=30;
		for($i=1;$i<=$typeNums;$i++){
			//序号
			$paixu=substr(1000+$i,1);
			$number=1000+$i;
			
			if($this->type==1){
				//$number2=date('Ymd-', strtotime(date('Y-m-d',$date - 1*24*60*60))).substr($number,1);
			}else if($this->type==3){
				$perCunm=21;
			}else if($this->type==12){
				$perCunm=24;
				$number=100+$i;
				//$number2=date('Ymd-', strtotime(date('Y-m-d',$date - 1*24*60*60))).substr($number,1);
				
			}else if($this->type==14){
				$perCunm=72;
			}
			
			$number=date('Ymd-', $date).substr($number,1);
			
			$sql="select data from {$this->prename}data where type={$this->type} and number='$number'";
			//$sql2="select data from {$this->prename}data where type={$this->type} and number='$number2'";
			$kjdata=$this->getValue($sql);
			//if(!$kjdata && $number2) $kjdata=$this->getValue($sql2);
			if(!$kjdata) $kjdata=",,,,";
			$dArry=explode(",",$kjdata);
			$var['d1']=$dArry[0];
			$var['d2']=$dArry[1];
			$var['d3']=$dArry[2];
			$var['d4']=$dArry[3];
			$var['d5']=$dArry[4];
			
			if($var['d1']>4){$d1dx="大";}else{$d1dx="小";}
			if($var['d1']%2){$d1ds="单";}else{$d1ds="双";}
			if($var['d2']>4){$d2dx="大";}else{$d2dx="小";}
			if($var['d2']%2){$d2ds="单";}else{$d2ds="双";}
			
			if(strlen($var['d3'])>0 && strlen($var['d4'])>0 && strlen($var['d5'])>0){
			
				if($var['d3']==$var['d4'] && $var['d4']==$var['d5']){
					$h3xt="豹子";
				}else if($var['d3']==$var['d4'] || $var['d4']==$var['d5'] || $var['d3']==$var['d5']){
					$h3xt="组三";
				}else{
					$h3xt="组六";
				}
			}else{
				$h3xt="---";	
			}
			
			if($i%$perCunm==1){
				echo "<table>";
				echo "<thead>";
				echo "<tr>";
				
				echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
				echo "<tr>";
				echo "<td>".$paixu."</td>";
				echo "<td class=\"color32\">".$this->iff(join("",$dArry),join("",$dArry),"-----")."</td>";
				echo "<td>".$d2dx.$d2ds."</td>";
				echo "<td>".$d1dx.$d1ds."</td>";
				echo "<td class=\"zs\">".$h3xt."</td>";
				echo "</tr>";
			}else if($i%$perCunm==0 || $i==$typeNums){
				echo "<tr>";
				echo "<td>".$paixu."</td>";
				echo "<td class=\"color32\">".$this->iff(join("",$dArry),join("",$dArry),"-----")."</td>";
				echo "<td>".$d2dx.$d2ds."</td>";
				echo "<td>".$d1dx.$d1ds."</td>";
				echo "<td class=\"zs\">".$h3xt."</td>";
				echo "</tr>";
				echo "</tbody>";
				echo "</table>";
				
			}else{
				echo "<tr>";
				echo "<td>".$paixu."</td>";
				echo "<td class=\"color32\">".$this->iff(join("",$dArry),join("",$dArry),"-----")."</td>";
				echo "<td>".$d2dx.$d2ds."</td>";
				echo "<td>".$d1dx.$d1ds."</td>";
				echo "<td class=\"zs\">".$h3xt."</td>";
				echo "</tr>";
	
			}

		}
	?>
	</div></div></div>
    <? }
	?>
     