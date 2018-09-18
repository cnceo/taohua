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
$url='http://pub.icaile.com/sh11x5kjjg.php?action=chart&id=522&async=true';
$content=file_get_contents($url);
$start='dateNumber":"';
$end='","id';
$num=getcode(cut($start,$end,$content));
$expect=substr($num,0,6).''.substr($num,-2);

$start='dateTime":"';
$end='","list';
$opentime=cut($start,$end,$content);

$start='list":["';
$end='"]},{"dateNumber';
$codes=cut($start,$end,$content);
$opencode=str_replace('","',',',$codes);
header("Content-type: application/xml");
echo'<?xml version="1.0" encoding="utf-8"?>';
echo '<xml><row expect="'."$expect".'" opencode="'."$opencode".'" opentime="'."$opentime".'" /></xml>';
ob_end_flush();
;echo '
'
?>