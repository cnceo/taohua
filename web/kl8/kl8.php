<?php
$headers["User-Agent"] = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/24.0.1271.64 Safari/537.11";
$headerArr = array(); 
foreach($headers as $n => $v){
	$headerArr[] = $n.':'.$v;  
}
$ch = curl_init('http://www.bwlc.gov.cn/bulletin/keno.html');
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
$start='<table class="tb" width="100%">';
$end='</table>';
$conta=cut($start,$end,$content);
$conta=preg_replace(array('/[\r\n]| class=".*?"|	/','/<tr><td>(\d{6})<\/td><td>([\d\,]{59})<\/td><td>(\d{2})<\/td><td>([\d\-\: ]{16})<\/td><\/tr>/','/<tr>.*?<\/tr>/'),array('','<row expect="$1" opencode="$2" opentime="$4:00" />',''),$conta);

header("Content-type: application/xml");
echo '<?xml version="1.0" encoding="utf-8"?>';
echo '<xml>'.$conta.'</xml>';
ob_end_flush();
;echo '
'
?>