<?php
$sql="select time, number, data from {$this->prename}data where type={$this->type} order by number desc,time desc limit {$args[0]}";
if($data=$this->getRows($sql)) foreach($data as $var){
if($this->type==24){ 
$datan=explode("|",$var['data']);
?>

<tr>
<td><span><?=$var['number']?></span></td>
<td ><span style="width:113px; overflow:hidden;" title="<?=$datan[0]?>"><?=$datan[0]?></span></td>
<td><span style="background:#c00;-moz-border-radius:50%; -webkit-border-radius:50%; border-radius:50%; border:1px solid #c00;color:#fff;"><?=$datan[1]?></span></td>
</tr>


<?php }else if($this->type==6){ 
$splitD=explode(",",$var['data']);
?>
<tr>
<td><span title="<?=$var['number']?>"><?=substr($var['number'],4,6)?></span></span></td>
<td><span><?php foreach($splitD as $num){ echo "<strong style='padding:0px 4px;color:#e74c3c;font-size:14px;'>".$num."</strong>";} ?></span></td>
<td><span>
<?php 
$a=array(0=>$splitD[0],1=>$splitD[1],2=>$splitD[2],3=>$splitD[3],4=>$splitD[4]); 
echo array_sum($a); 
?>
</span></td>
</tr>


<?php }else if($this->type==17){ 
$splitD=explode(",",$var['data']);
?>
<tr>
<td><span><?=substr($var['number'],4,8)?></span></td>
<td><span><?php foreach($splitD as $num){ echo "<strong style='padding:0px 3px;color:#e74c3c;font-size:13px;'>".$num."</strong>";} ?></span></td>
</tr>

<?php }else if($this->type==1){ 
$splitD=explode(",",$var['data']);
?>
<tr>
<td><span><?=substr($var['number'],4,8)?></span></td>
<td><span><?php foreach($splitD as $num){ echo "<strong style='padding:0px 4px;color:#e74c3c;font-size:14px;'>".$num."</strong>";} ?></span></td>
<td>
<?php    
$arr0=$splitD[0]; 
$arr1=$splitD[1]; 
$arr2=$splitD[2]; 
$arr3=$splitD[3]; 
$arr4=$splitD[4]; 
if($arr4>=5){echo "<span style=\"background:#a7c503;-moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; border:1px solid #a7c503;color:#fff;\">大</span>";}
else{echo "<span style=\"background:#e3dc0f;-moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; border:1px solid #e3dc0f;color:#fff;\">小</span>";}   
?> 
</td>
<td>
<?php 
$a=array(0=>$splitD[0],1=>$splitD[1],2=>$splitD[2],3=>$splitD[3],4=>$splitD[4]); 
$d=$splitD[4];
if($d%2==1){
echo "<span style=\"background:#686ff6;-moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; border:1px solid #686ff6;color:#fff;\">单</span>";
}else if($i%2 == 0){
echo "<span style=\"background:#b49458;-moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; border:1px solid #b49458;color:#fff;\">双</span>";
}
?>
</td>
</tr>

<?php }else if($this->type==20){ 
$splitD=explode(",",$var['data']);
?>
<tr>
<td><span><?=$var['number']?></span></td>
<td><span><?php foreach($splitD as $num){ echo "<strong style='padding:0px 2px;color:#e74c3c;font-size:13px;'>".$num."</strong>";} ?></span></td>
</tr>


<?php }else if($this->type==63){ 
$splitD=explode(",",$var['data']);
?>
<tr>
<td><span title="<?=$var['number']?>"><?=$var['number']?></span></td>
<td><span><?php foreach($splitD as $num){ echo "<strong style='padding:0px 2px;color:#e74c3c;font-size:14px;'>".$num."</strong>";} ?></span></td>
<td><span>
<?php 
$a=array(0=>$splitD[0],1=>$splitD[1],2=>$splitD[2]); 
echo array_sum($a); 
?>
</span></td>
<td style="display:none"><span>
<?php    
$arr0=$splitD[0]; 
$arr1=$splitD[1]; 
$arr2=$splitD[2]; 
 if($arr0==$arr1||$arr1==$arr2){echo "二数相同";}
else if($arr0==$arr1&&$arr1==$arr2){echo "三数相同";}
else{echo "三数不同";}   
?> 

</span></td>
<td>
<?php    
$a=array(0=>$splitD[0],1=>$splitD[1],2=>$splitD[2]); 
if(array_sum($a)>10){echo "<span style=\"background:#a7c503;-moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; border:1px solid #a7c503;color:#fff;\">大</span>";}
else{echo "<span style=\"background:#e3dc0f;-moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; border:1px solid #e3dc0f;color:#fff;\">小</span>";}   
?> 
</td>
<td>
<?php 
$a=array(0=>$splitD[0],1=>$splitD[1],2=>$splitD[2]); 
$b=array_sum($a); 
if($b%2==1){
echo "<span style=\"background:#87c95f;-moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; border:1px solid #87c95f;color:#fff;\">单</span>";
}else if($i%2 == 0){
echo "<span style=\"background:#b49458;-moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; border:1px solid #b49458;color:#fff;\">双</span>";
}
?>
</td>
</tr>

<?php }else{ 
$splitD=explode(",",$var['data']);
?>
<tr>
<td><?=$var['number']?></td>
<td><span><?php foreach($splitD as $num){ echo "<strong style='padding:0px 3px;color:#e74c3c;font-size:14px;'>".$num."</strong>";} ?></span></td>
<td><span>
<?php 
$a=array(0=>$splitD[0],1=>$splitD[1],2=>$splitD[2]); 
echo array_sum($a); 
?>
</span></td>
<td style="display:none"><span>
<?php    
$arr0=$splitD[0]; 
$arr1=$splitD[1]; 
$arr2=$splitD[2]; 
 if($arr0==$arr1||$arr1==$arr2){echo "二数相同";}
else if($arr0==$arr1&&$arr1==$arr2){echo "三数相同";}
else{echo "三数不同";}   
?> 
</span></td>
<td>
<?php    
$a=array(0=>$splitD[0],1=>$splitD[1],2=>$splitD[2]); 
if(array_sum($a)>10){echo "<span style=\"background:#a7c503;-moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; border:1px solid #a7c503;color:#fff;\">大</span>";}
else{echo "<span style=\"background:#e3dc0f;-moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; border:1px solid #e3dc0f;color:#fff;\">小</span>";}   
?> 
</td>
<td>
<?php 
$a=array(0=>$splitD[0],1=>$splitD[1],2=>$splitD[2]); 
$b=array_sum($a); 
if($b%2==1){
echo "<span style=\"background:#87c95f;-moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; border:1px solid #87c95f;color:#fff;\">单</span>";
}else if($i%2 == 0){
echo "<span style=\"background:#b49458;-moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px; border:1px solid #b49458;color:#fff;\">双</span>";
}
?>
</td>
</tr>
<?php } } ?>