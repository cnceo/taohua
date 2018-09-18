<?
$api = 'http://old.1680210.com/Open/CurrentOpen?code=1001';
$resource = file_get_contents( $api );  
$data = json_decode( $resource , 1 );

$ct = $data['c_t'];

$cd = $data['c_d'];

$cr = $data['l_r'];

header('Content-Type: text/xml;charset=utf8');
$limit=strlen($ct)-2;

$ct=substr($ct,0,$limit).'-'.substr($ct,$limit,$limit+2);

	function tmp($v){
		 return 10>$v?"0{$v}":$v;
	}
	$cr=implode(',',array_map('tmp',array_slice(explode(',',$cr),0,20)));
echo '<xml>
<row expect="'.$ct.'" opencode="'.$cr.'" opentime="'.str_replace('/','-',$cd).'"/>
</xml>';