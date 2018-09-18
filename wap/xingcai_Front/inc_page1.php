<?php
	//print_r($args);exit;
	$pageSize=$args[1];
	$pageurl=$args[2];
	if(isset($args[0])){
		if($args[0]>1){
			$recordCount=$args[0];
		}else{
			$recordCount=1;
		}
	}else{
		$recordCount=1;
	}
	$pageCount=ceil($recordCount/$pageSize);
	
	if($args[3]==1){
		// 只有多页时才显示
		if($pageCount<=1) return;
	}elseif($args[3]==2){
		// 只有有列表时才显示
		if($recordCount<=1) return;
	}
	
	$listPageSize=5;
	$startPage=$this->page-floor($listPageSize/2);
	if($startPage<1) $startPage=1;
	$prePage=$this->page-1;
	if($prePage<1) $prePage=1;
	$nextPage=$this->page+1;
	if($nextPage>$pageCount) $nextPage=$pageCount;
	
	if(!function_exists('set_page_url')){
		function set_page_url($page, $urlString, $flag='{page}'){
			return str_replace($flag, $page, $urlString);
		}
	}
?>
<div class="btn-group">
	
	<?php if($this->page==1){ ?>
		
	<?php }else{ ?>
	<a class="btn btn-white" href="<?=set_page_url(1, $pageurl)?>">首页</a>
    <a class="btn btn-white" href="<?=set_page_url($prePage, $pageurl)?>">上页</a>
	<?php }
		
		for($page=$startPage; $page<=$startPage+$listPageSize; $page++){
			if($page>$pageCount) break;
	?>
	
	<a class="btn btn-white" href="<?=set_page_url($page, $pageurl)?>"<?=($page==$this->page?' class="pagecurrent"':'')?>><?=$page?></a>

	
	<?php
		}
		if($page>$pageCount) $page=$pageCount;
	
		if($this->page==$pageCount){
	?>
	
	<?php }else{ ?>
	<a class="btn btn-white" href="<?=set_page_url($nextPage, $pageurl)?>">下页</a>
	<a class="btn btn-white" href="<?=set_page_url($pageCount, $pageurl)?>">尾页</a>
	<?php } ?>
<span class="btn btn-white ">当前第<?=$this->page?>页/共<?=$pageCount?>页</span>
</div>
