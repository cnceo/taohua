<div class="recentCon re m_li_K8">

<dd>
<?php

	$sql="select time, number, data from {$this->prename}data where type={$this->type} order by number desc,time desc limit {$args[0]}";
	
if($data=$this->getRows($sql)) foreach($data as $var){?>

  <li class="" data="<?=$var['data']?>">
                                <span class="issue_k8"><?=$var['number']?></span>
                                <span class="num_k8"><?=preg_replace('/\,/', ' ', $var['data'])?></span>
                            </li> 
<? } ?>
  </dd>
                </div>
 <script type="text/javascript">
 $(function(){
 $("dd").each(function(){
 $(this).children().first().css("color","red"); 
 });
 });
 </script>