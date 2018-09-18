<?php
$lastNo=$this->getGameLastNo(65);
$zddata = $this->getGameZdData(65,$lastNo['actionNo']);
$opencode =$zddata?$zddata:randKeys(10);


header('Content-type: application/xml');
echo'<?xml version="1.0" encoding="utf-8"?>';
echo '<xml><row expect="'.$lastNo['actionNo'].'" opencode="'.$opencode.'" opentime="'.$lastNo['actionTime'].'"/></xml>';

/* 生成随机数 */
function randKeys($len){
    $array=array("01","02","03","04","05","06","07","08","09","10");
	$charsLen = count($array) - 1; 
    shuffle($array);
    $output = ""; 
  //  for ($i=0; $i<$len; $i++){ 
		
    $a= $array[mt_rand(0, $charsLen)];
		$b= $array[mt_rand(0, $charsLen)];
		while($a==$b)
		{
     $b= $array[mt_rand(0, $charsLen)];
		}
		$c=$array[mt_rand(0, $charsLen)];
		while($c==$a||$c==$b)
		{
      $c= $array[mt_rand(0, $charsLen)];
		}

		$d= $array[mt_rand(0, $charsLen)];
		while($d==$a||$d==$b||$d==$c)
		{
			$d= $array[mt_rand(0, $charsLen)];
		}
		$e= $array[mt_rand(0, $charsLen)];
		while($e==$a||$e==$b||$e==$c||$e==$d)
		{
			$e= $array[mt_rand(0, $charsLen)];
		}
				$f= $array[mt_rand(0, $charsLen)];
		while($f==$a||$f==$b||$f==$c||$f==$d||$f==$e)
		{
			$f= $array[mt_rand(0, $charsLen)];
		}
				$g= $array[mt_rand(0, $charsLen)];
		while($g==$a||$g==$b||$g==$c||$g==$d||$g==$e||$g==$f)
		{
			$g= $array[mt_rand(0, $charsLen)];
		}
			  $h= $array[mt_rand(0, $charsLen)];
		while($h==$a||$h==$b||$h==$c||$h==$d||$h==$e||$h==$f||$h==$g)
		{
			$h= $array[mt_rand(0, $charsLen)];
		}
			 $i= $array[mt_rand(0, $charsLen)];
		while($i==$a||$i==$b||$i==$c||$i==$d||$i==$e||$i==$f||$i==$g||$i==$h)
		{
			$i= $array[mt_rand(0, $charsLen)];
		}
					 $j= $array[mt_rand(0, $charsLen)];
		while($j==$a||$j==$b||$j==$c||$j==$d||$j==$e||$j==$f||$j==$g||$j==$h||$j==$i)
		{
			$j= $array[mt_rand(0, $charsLen)];
		}
       //$output .= $array[mt_rand(0, $charsLen)].",";  
  //  }  
	 return $outpuet=$a.','.$b.','.$c.','.$d.','.$e.','.$f.','.$g.','.$h.','.$i.','.$j;
   // return rtrim($output, ',');
}
?>