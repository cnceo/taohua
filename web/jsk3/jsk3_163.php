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
$url='http://caipiao.163.com/order/preBet_oldkuai3PeriodTime.html';
$content=file_get_contents($url);
$start=',"time":';
$end=',"timezoneOffset":';
$opentime=cut($start,$end,$content);
$start='","period":"';
$end='","sum';
$expect=cut($start,$end,$content);
$expect = '20'.$expect;
$expect = substr($expect,0,9).''.substr($expect,9);
$start='winningNumber":"';
$end='","winningNumberForm';
$codes=cut($start,$end,$content);
$opencode=str_replace(' ',',',$codes);
$opentime=date('Y-m-d H:i:m');
header("Content-type: application/xml");
echo'<?xml version="1.0" encoding="utf-8"?>';
echo '<xml><row expect="'."$expect".'" opencode="'."$opencode".'" opentime="'."$opentime".'" /></xml>';
ob_end_flush();
;echo '
'
?>