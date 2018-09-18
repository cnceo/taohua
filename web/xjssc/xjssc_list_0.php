<?php
if(strtotime(date('Y-m-d H:i:s')) < strtotime(date('Y-m-d 04:00:00')))
{
	$dat=date("ymd",strtotime("-1 day"));
	$time2=date("Y-m-d H:i:s",strtotime("-1 day"));
}else{
	$dat=date('ymd');
	$time2=date('Y-m-d H:i:s');
	}
$headers["User-Agent"] = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/24.0.1271.64 Safari/537.11";
$headerArr = array(); 
foreach($headers as $n => $v){
	$headerArr[] = $n.':'.$v;  
}
$ch = curl_init('http://www.xjflcp.com/game/sscAnnounce');
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
$start='<div class="kj_code_tab kj_code_tab2">';
$end='<div id="footer">';
$conta=cut($start,$end,$content);
$conta=preg_replace("/\r\n\s*/i","",$conta);

$conta=preg_replace(array('/<tr><td class="bold">20'.$dat.'/','/<\/td><td class="kj_codes">/','/<\/td><td>.*?<\/td><\/tr>/','/<tr><td class="bold">.*?" \/>/','/<table class=".*?" width="320" border="0">.*?<tbody id="list.*?">|<\/tbody>|<\/table>|<\/div>|<!--foot-->/'),array('<row expect="20'.$dat.'-','" opencode="','" opentime="'.$time2.'" />',''),$conta);
//var_dump($dat);var_dump($conta);die();
header("Content-type: application/xml");
echo '<?xml version="1.0" encoding="utf-8"?>';
echo '<xml>'.$conta.'</xml>';
ob_end_flush();
;echo '
'
?>