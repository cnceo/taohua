<?php $this->display('inc_daohang1.php'); ?>
<script type="text/javascript" src="/js/nsc_m/res.js?v=1.16.12.4"></script>

<script type="text/javascript">

function boxSearch(err, data){
	if(err){
		xingcai(err);
	}else{
		$('.biao-cont').html(data);
		recodeRefresh();
	}
}
function recodeRefresh(){
	$('.biao-cont').load(
		$('.bottompage .on').attr('href')
	);
}
function deleteBet(err, data){
	if(err){
	xingcai(err);
	}else{
		xingcai('删除成功');
		recodeRefresh();
	}
}
/**
 * 批量撤销前调用
 */
function recordBeforeDelete(){
	//获取ID
	var byid="";
	var tourl="/index.php/box/senddeleteAll/";
	var a=document.getElementsByName("chk_only");
	for(var i=0,len=a.length;i<len;i++){
		if(a.item(i).checked){
		if(byid.length >0){
			byid=byid + "-" + a.item(i).value;
			}
		else{
			byid=byid + a.item(i).value;
		   }
	   }
	}
	if(byid.length>0){
		if(confirm('是否确定要删除？')){
			tourl+=byid;
			$(".removeAllRecord").attr("href",tourl);
		}
		
	}else{
		xingcai("请选择需要删除的消息！");	
		return false;
	}
}
</script>
   <section class="wraper-page">
<div class="ibox-title">
<h5>已发记录 <small></small></h5>
</div>
    <form action="/index.php/box/sendsearchReceive" datatype="html" call="boxSearch" target="ajax">
      <div class="input-daterange input-group" >
                                <input type="text" class="input-sm form-control" value="<?= $this->iff($_REQUEST['fromTime'], $_REQUEST['fromTime'], date('Y-m-d H:i', $GLOBALS['fromTime'])) ?>" name="fromTime" id="startTime">
                                <span class="input-group-addon">到</span>
                                <input type="text" class="input-sm form-control" value="<?= $this->iff($_REQUEST['toTime'], $_REQUEST['toTime'], date('Y-m-d H:i', $GLOBALS['toTime'])) ?>" name="toTime" id="endTime">
                            </div>
        <div id="searchBox" class="re">
        	
          <div class="input-append input-group" "="">					
			<span class="input-group-btn">				
			 
			<button class="btn btn-white" type="button">查询类型：</button>	
			</span>				
			 <select class="input-large form-control" id="methodid" name="state">
              <option value="3" selected>所有</option>
              <option value="2">已读</option>
              <option value="1">未读</option>
        </select>
			</div>
          
        </div>
		<div class="search_br">
		 <input type="submit" class="btn btn-primary btn-sm" value="查询"></input>
		 
		 <a href="/index.php/box/senddelete/" dataType="json" class="removeAllRecord" onajax="recordBeforeDelete" call="deleteBet" target="ajax"><input name="delall" class="btn btn-sm btn-primary" type="button" value="删 除" /></a>
		</div>
    </form>
<style type="text/css">
.search_br {padding-top:10px;height:45px;text-align: center;color: #666;}
</style> 
<div class="biao-cont">
<?php $this->display('box/sendsearchReceive.php'); ?>
 </div>
