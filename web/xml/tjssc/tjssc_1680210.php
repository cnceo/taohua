<?
$api = 'http://kj.1680api.com/Open/CurrentOpenOne?code=10021';
$resource = file_get_contents( $api );  
$data = json_decode( $resource , 1 );

$ct = $data['c_t'];

$cd = $data['c_d'];

$cr = $data['c_r'];

header('Content-Type: text/xml;charset=utf8');
$limit=strlen($ct)-0;

$ct=substr($ct,2,$limit).''.substr($ct,$limit,$limit+0);

echo '<xml>
<row expect="'.$ct.'" opencode="'.$cr.'" opentime="'.str_replace('/','-',$cd).'"/>
</xml>';