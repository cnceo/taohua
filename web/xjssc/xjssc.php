<?php

ob_start();
function cut($start,$end,$file){
$content=explode($start,$file);
$content=explode($end,$content[1]);
return  $content[0];
}
function getcode($str){
$str=trim(preg_replace("[^0-9]","",$str));
return $str;
}
$url='http://www.xjflcp.com/game/sscAnnounce';
$content=file_get_contents($url);
$start='<div class="con_left con_left2" style="position:relative;">';
$end='<div class="kj_code_top">';
$content1=cut($start,$end,$content);
$content1=preg_replace("/\r\n\s*/i","",$content1);
$start='<p>第<span> ';
$end=' </span>';
$num=getcode(cut($start,$end,$content1));
$expect=substr($num,2,6).''.substr($num,-2);
$expect = '20'.$expect;
$expect = substr($expect,0,8).'-'.substr($expect,8);
$content1=preg_replace(array('/<\/i><i>/','/<\/i>/','/<i>/'),array(',','',''),$content1);
$start='<div class="kj_ball kj_ball_new">';
$end='</div>';
$opencode=cut($start,$end,$content1);

$opentime=date('Y-m-d H:i:s');
$time=substr(date('Y-m-d H:i',time()),0,15);
$opentime=$time.$e.'0:01';
header("Content-type: application/xml");
echo'<?xml version="1.0" encoding="utf-8"?>';
echo '<xml><row expect="'."$expect".'" opencode="'."$opencode".'" opentime="'."$opentime".'" /></xml>';
ob_end_flush();
;echo '
'
?>