
<?
$api = 'http://www.cailele.com/static/ssc/newlyopenlist.xml';
$resource = file_get_contents( $api );  
$data = json_decode( $resource , 1 );

$expect = $data['c_t'];

$opencode = $data['c_d'];

$opentime = $data['l_r'];

header('Content-Type: text/xml;charset=utf8');
$limit=strlen($ct)-3;

$ct=substr($ct,0,$limit).'-'.substr($ct,$limit,$limit+3);

echo '<xml>
<row expect="'.$ct.'" opencode="'.$cr.'" opentime="'.str_replace('/','-',$cd).'"/>
</xml>';