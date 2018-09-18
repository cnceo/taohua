<div class="recentCon">
<dd class="pk10_kjul" >
<?php

	$sql="select time, number, data from {$this->prename}data where type={$this->type} order by number desc,time desc limit {$args[0]}";
	
if($data=$this->getRows($sql)) foreach($data as $var){?>



  <li class="" data="<?=$var['data']?>">
                                <span class="issue_k8"><?=$var['number']?></span>
                                <span class="num_k8" ><?=preg_replace('/\,/', ' ', $var['data'])?></span>
                            </li>

             


	 
<? } ?>
  </dd>
   </div>

 <script type="text/javascript">

 //方案二
 $(function(){
 $("dd").each(function(){
 $(this).children().first().css("color","red"); 
 });
 });
 
 //方案三
 /*$(function(){
 $("ul li:nth-child(1)").css("background","red");
 });*/
 //方案四
 /*$(function(){
 $("ul li:first-child").css("background","red");
 });*/
 </script>
