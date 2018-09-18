<?php
    $headers["User-Agent"] = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/24.0.1271.64 Safari/537.11";
    $headerArr = array(); 
    foreach($headers as $n => $v){
        $headerArr[] = $n.':'.$v;  
    }
    $ch = curl_init("http://www.lecai.com/lottery/draw/view/543");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_HTTPHEADER , $headerArr);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
    $content = curl_exec($ch);

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
$start='var latest_draw_result';
$end='var phaseData';
$content0=cut($start,$end,$content);

$start='latest_draw_phase =';
$end=';';
$num=getcode(cut($start,$end,$content0));
$expect=substr($num,-9);

$start='"red":["';
$end='"],"blue"';
$codes=cut($start,$end,$content0);
$opencode=str_replace('","',',',$codes);

$start='latest_draw_time = ';
$end=';';
$time=str_replace("'","",$content0);
$opentime=cut($start,$end,$time);
//$opentime=date("Y-m-d H:i:s");

header("Content-type: application/xml");
echo '<?xml version="1.0" encoding="utf-8"?>';
echo '<xml><row expect="'.$expect.'" opencode="'.$opencode.'" opentime="'.$opentime.'" /></xml>';
ob_end_flush();
;echo '
'
?>