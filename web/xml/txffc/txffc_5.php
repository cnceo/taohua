<?php
date_default_timezone_set('PRC');//设置为中华人民共和国
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
$url='http://vip.manycai.com/K25adffc053011f/txffc-1.json';
$content=file_get_contents($url);
$start='issue":"';
$end='","opendate';
$expect=cut($start,$end,$content);

//$start='opendate":"';
//$end='","code';
//$expect=cut($start,$end,$content);
//$expect = substr($expect,0,4).substr($expect,5,2).substr($expect,8,2).substr($expect,11,2).substr($expect,14,2);
$start='code":"';
$end='","lotterycode';
$codes=cut($start,$end,$content);

$start='opendate":"';
$end='","code';
$opentime=cut($start,$end,$content);

$opencode='';
$i = 0;
while ($i<=8){
if($i<>8) $str='';else $str='';
$opencode.=substr($codes,$i,1).$str;
$i+=1;
}
header("Content-type: application/xml");
echo'<?xml version="1.0" encoding="utf-8"?>';
echo '<xml><row expect="'."$expect".'" opencode="'."$opencode".'" opentime="'."$opentime".'" /></xml>';
ob_end_flush();
;echo '
'
?>