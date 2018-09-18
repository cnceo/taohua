<?php
ob_start();
function cut($start,$end,$file){
$content=explode($start,$file);
$content=explode($end,$content[1]);
return  $content[0];
}
function getcode($str){
$str=trim(eregi_replace("[^0-9]","",$str));
return $str;
}
$url='http://www.16cp.com/Game/GetNum.aspx?iType=3';
$content=str_replace("'","",file_get_contents($url));
$start='<ul class=openul bgF0F9FE>';
$end='</ul>';
$num=getcode(cut($start,$end,$content));

$expect=substr($num,1,9);
$expect = '20'.$expect;
$expect = substr($expect,0,8).'-'.substr($expect,8);
if(substr($num,11,15)!="255255255255255"){
	$codes=substr($num,11,5);
	$opencode='';

	$i = 0;
	while ($i<=4){
		if($i<>4) $str=',';else $str='';
		$opencode.=substr($codes,$i,1).$str;
		$i+=1;
	}
}else{
	$opencode='255,255,255,255,255';
}

$m=date('i',time());
$n=substr($m,-1);
$time=substr(date('Y-m-d H:i',time()),0,15);
if($n < 5){$e=0;}else{$e=5;}
$opentime=$time.$e.':01';

header("Content-type: application/xml");
echo'<?xml version="1.0" encoding="utf-8"?>';
echo '<xml><row expect="'.$expect.'" opencode="'.$opencode.'" opentime="'.$opentime.'" /></xml>';
ob_end_flush();
;echo '
'
?>
