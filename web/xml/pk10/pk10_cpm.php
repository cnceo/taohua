<?php




header('content-type:text/xml;charset=utf8');

$api = 'http://www.cpmao.com/cachefiles/bjpk10.js';



$resource = file_get_contents( $api ); 



$data = json_decode( $resource , 1 );



$data=$data['current'];




$limit=strlen($data['period'])-0;

$ct=substr($data['period'],0,$limit).''.substr($data['period'],$limit,$limit+0);

echo '<xml>
<row expect="'.$ct.'" opencode="'.$data['result'].'" opentime="'.$data['awardTime'].'"/>
</xml>';
