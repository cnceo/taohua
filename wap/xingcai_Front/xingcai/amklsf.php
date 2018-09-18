<?php
$lastNo=$this->getGameLastNo(71);
$zddata = $this->getGameZdData(71,$lastNo['actionNo']);
$opencode =$zddata?$zddata:randKeys(8);

header('Content-type: application/xml');
echo'<?xml version="1.0" encoding="utf-8"?>';
echo '<xml><row expect="'.$lastNo['actionNo'].'" opencode="'.$opencode.'" opentime="'.$lastNo['actionTime'].'"/></xml>';

/* 生成随机数 */
function randKeys($len){
    $array=array("01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20");
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
		
					 $k= $array[mt_rand(0, $charsLen)];
		while($k==$a||$k==$b||$k==$c||$k==$d||$k==$e||$k==$f||$k==$g||$k==$h||$k==$i||$k==$j)
		{
			$k= $array[mt_rand(0, $charsLen)];
		}
		
					 $l= $array[mt_rand(0, $charsLen)];
		while($l==$a||$l==$b||$l==$c||$l==$d||$l==$e||$l==$f||$l==$g||$l==$h||$l==$i||$l==$j||$l==$k)
		{
			$l= $array[mt_rand(0, $charsLen)];
		}
		
					 $m= $array[mt_rand(0, $charsLen)];
		while($m==$a||$m==$b||$m==$c||$m==$d||$m==$e||$m==$f||$m==$g||$m==$h||$m==$i||$m==$j||$m==$k||$m==$l)
		{
			$m= $array[mt_rand(0, $charsLen)];
		}
		
					 $n= $array[mt_rand(0, $charsLen)];
		while($n==$a||$n==$b||$n==$c||$n==$d||$n==$e||$n==$f||$n==$g||$n==$h||$n==$i||$n==$j||$n==$k||$n==$l||$n==$m)
		{
			$n= $array[mt_rand(0, $charsLen)];
		}
		
					 $o= $array[mt_rand(0, $charsLen)];
		while($o==$a||$o==$b||$o==$c||$o==$d||$o==$e||$o==$f||$o==$g||$o==$h||$o==$i||$o==$j||$o==$k||$o==$l||$o==$m||$o==$n)
		{
			$o= $array[mt_rand(0, $charsLen)];
		}
		
					 $p= $array[mt_rand(0, $charsLen)];
		while($p==$a||$p==$b||$p==$c||$p==$d||$p==$e||$p==$f||$p==$g||$p==$h||$p==$i||$p==$j||$p==$k||$p==$l||$p==$m||$p==$n||$p==$o)
		{
			$p= $array[mt_rand(0, $charsLen)];
		}
		
					 $q= $array[mt_rand(0, $charsLen)];
		while($q==$a||$q==$b||$q==$c||$q==$d||$q==$e||$q==$f||$q==$g||$q==$h||$q==$i||$q==$j||$q==$k||$q==$l||$q==$m||$q==$n||$q==$o||$q==$p)
		{
			$q= $array[mt_rand(0, $charsLen)];
		}
		
					 $r= $array[mt_rand(0, $charsLen)];
		while($r==$a||$r==$b||$r==$c||$r==$d||$r==$e||$r==$f||$r==$g||$r==$h||$r==$i||$r==$j||$r==$k||$r==$l||$r==$m||$r==$n||$r==$o||$r==$p||$r==$q)
		{
			$r= $array[mt_rand(0, $charsLen)];
		}
		
					 $s= $array[mt_rand(0, $charsLen)];
		while($s==$a||$s==$b||$s==$c||$s==$d||$s==$e||$s==$f||$s==$g||$s==$h||$s==$i||$s==$j||$s==$k||$s==$l||$s==$m||$s==$n||$s==$o||$s==$p||$s==$q||$s==$r)
		{
			$s= $array[mt_rand(0, $charsLen)];
		}
		
					 $t= $array[mt_rand(0, $charsLen)];
		while($t==$a||$t==$b||$t==$c||$t==$d||$t==$e||$t==$f||$t==$g||$t==$h||$t==$i||$t==$j||$t==$k||$t==$l||$t==$m||$t==$n||$t==$o||$t==$p||$t==$q||$t==$r||$t==$s)
		{
			$t= $array[mt_rand(0, $charsLen)];
		}
		
       //$output .= $array[mt_rand(0, $charsLen)].",";  客服QQ:113438373
  //  }  
	 return $outpuet=$a.','.$b.','.$c.','.$d.','.$e.','.$f.','.$g.','.$h;
   // return rtrim($output, ',');
}
?>