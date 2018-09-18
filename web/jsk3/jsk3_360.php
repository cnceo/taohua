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
$url='http://chart.cp.360.cn/zst/qkj/?lotId=255903';
$content=file_get_contents($url);
$start='Issue":"';
$end='","WinNumber';
$expect=cut($start,$end,$content);
$expect = substr($expect,0,8).'0'.substr($expect,8);
$start='WinNumber":"';
$end='","EndTime';
$codes=cut($start,$end,$content);

$start='EndTime":"';
$end='"},"preIssue';
$opentime=cut($start,$end,$content);

$opencode='';
$i = 0;
$len = strlen($codes)-1;
while ($i<=$len){
if($i<>$len) $str=',';else $str='';
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