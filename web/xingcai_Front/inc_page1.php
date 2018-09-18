<?php
	//print_r($args);exit;
	
	
	$data=$args[3]['data'];
	
	$dataLen=count($data);
	
	$pages=$args[1];
	$pageurl=$args[2];
	
	if(isset($args[0])){
		if($args[0]>1){
			//...
			$recordCount=$args[0];
		}else{
			$recordCount=1;
		}
	}else{
		//这两个是什么关系 哪2个
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
<script type="text/javascript" src="/skin/js/jquery-1.8.3.min.js"></script>

<script type="text/javascript" src="/css/layui/layui.js"></script>

<div id="demo1" style="text-align:center;"></div>

<script>

layui.use(['laypage', 'layer'], function(){
  var laypage = layui.laypage
  ,layer = layui.layer;

  var nums = 10,data=eval(<?=json_encode($data)?>); //每页出现的数据量
  
  //模拟渲染
  var render = function(curr){
    var str = '', last = curr*nums - 1;
    last = last >=data.length ? (data.length-1) : last;
    for(var i = (curr*nums - nums); i <= last; i++){
		//console.log(data[i]['time'])
      str += '<tbody> <tr><td> <?=$args[4]?></td><td>'+ data[i]['number'] +'</td><td>'+  data[i]['data'] +'</td><td>'+data[i]['time']+'</td></tr></tbody>';
	  
    }
    return str;
  };
  
  //调用分页
  laypage({
    cont: 'demo1'
	//这两个什么情况
    ,pages: Math.ceil(data.length/nums) //得到总页数
    ,jump: function(obj){
		//console.log(render(obj.curr))
		$('.layui-table tbody').remove()
		$('.layui-table').append(render(obj.curr));
    }
  });
  
});
</script>
