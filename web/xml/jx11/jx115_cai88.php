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
$url='http://cai88.com/api/getgame.action?type=106';
$content=file_get_contents($url);
$start='list":[{"';
$end='}]';
$content0=cut($start,$end,$content);
$start='issue":"';
$end='","code';
$num=cut($start,$end,$content0);
$expect=substr($num,0,8).''.substr($num,-2);
$expect = substr($expect,0,8).'-'.substr($expect,8);
$start='code":"';
$end='","sCode';
$opentime= date('Y-m-d H:i:s',time());
$opencode=cut($start,$end,$content0);
header("Content-type: application/xml");
echo'<?xml version="1.0" encoding="utf-8"?>';
echo '<xml><row expect="'."$expect".'" opencode="'."$opencode".'" opentime="'."$opentime".'" /></xml>';
ob_end_flush();
;echo '
'
?>