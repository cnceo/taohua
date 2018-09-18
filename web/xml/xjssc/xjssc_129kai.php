<?php
$api = 'http://129kai.net/index.php?c=api&a=updateinfo&cp=xjssc&uptime=1488040736&chtime=36005&catid=126&modelid=1';
$resource = file_get_contents( $api );
$data = json_decode( $resource , 1 );

$ct = $data['c_t'];

$cd = $data['c_d'];

$cr = $data['l_r'];

header('Content-Type: text/xml;charset=utf8');
$limit=strlen($ct)-3;

$ct=substr($ct,0,$limit).'-'.substr($ct,$limit+1,$limit+3);

echo '<xml>
<row expect="'.$ct.'" opencode="'.$cr.'" opentime="'.str_replace('/','-',$cd).'"/>
</xml>';
