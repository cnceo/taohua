<?php
ob_start();
function cut($start,$end,$file){
$content=explode($start,$file);
$content=explode($end,$content[1]);
return  $content[0];
}
$url='http://www.tjflcpw.com/report/ssc_jiben_report.aspx';
$content=file_get_contents($url);
$start='table_add_one_tr("';
$end='")';
$dat=explode('", "', $content);
$expect=substr($dat[0],-9);
$opencode=str_replace('|0',',',substr($dat[1],1,13));
$opentime= date('Y-m-d H:i:s',time());

header("Content-type: application/xml");
echo'<?xml version="1.0" encoding="utf-8"?>';
echo '<xml><row expect="'.$expect.'" opencode="'.$opencode.'" opentime="'.$opentime.'" /></xml>';
ob_end_flush();
;echo '
'
?>