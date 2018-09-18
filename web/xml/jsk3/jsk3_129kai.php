<?
$api = 'http://129kai.net/index.php?c=api&a=updateinfo&cp=jsk3&uptime=1488046306&chtime=37625&catid=7&modelid=14';
$resource = file_get_contents( $api );  
$data = json_decode( $resource , 1 );

$ct = $data['c_t'];

$cd = $data['c_d'];

$cr = $data['l_r'];

header('Content-Type: text/xml;charset=utf8');
$limit=strlen($ct)-3;

$ct=substr($ct,0,$limit).''.substr($ct,$limit,$limit+3);

echo '<xml>
<row expect="'.$ct.'" opencode="'.$cr.'" opentime="'.str_replace('/','-',$cd).'"/>
</xml>';