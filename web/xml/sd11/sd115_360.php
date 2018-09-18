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
$url='http://chart.cp.360.cn/zst/qkj/?lotId=166406';
$content=file_get_contents($url);
$start='Issue":"';
$end='","WinNumber';
$num=cut($start,$end,$content);
$expect=substr($num,2,6).''.substr($num,-2);
$start='WinNumber":"';
$end='","EndTime';
$codes=cut($start,$end,$content);
$opencode=str_replace(' ',',',$codes);
//$start='EndTime":"';
//$end='"},"preIssue';
//$opentime=cut($start,$end,$content);
$opentime= date('Y-m-d H:i:s',time());
header("Content-type: application/xml");
echo'<?xml version="1.0" encoding="utf-8"?>';
echo '<xml><row expect="'."$expect".'" opencode="'."$opencode".'" opentime="'."$opentime".'" /></xml>';
ob_end_flush();
;echo '
'
?>