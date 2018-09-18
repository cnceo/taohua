<?php $this->display('inc_daohang1.php'); ?>
<script type="text/javascript" src="/js/nsc_m/res.js?v=1.16.12.4"></script>
<script type="text/javascript">
$(function(){
	$('.sure[id]').click(function(){
		var $this=$(this),
		cashId=$this.attr('id'),
		
		call=function(err, data){
			if(err){
				alert(err);
			}else{
				this.parent().text('已到帐');
			}
		}
		
		$.ajax('/index.php/cash/toCashSure/'+cashId,{
			dataType:'json',
			
			error:function(xhr, textStatus, errThrow){
				call.call($this, errThrow||textStatus);
			},
			
			success:function(data, textStatus, xhr){
				var errorMessage=xhr.getResponseHeader('X-Error-Message');
				if(errorMessage){
					call.call($this, decodeURIComponent(errorMessage), data);
				}else{
					call.call($this, null, data);
				}
			}
		});
	});
});
</script>
   <section class="wraper-page">
<div class="ibox-title">
                        <h5>提款记录 <small></small></h5>
                    </div>
  <form action="/index.php/cash/toCashLog" method="post">
      <div class="input-daterange input-group" style="PADDING-TOP: 6;">
                                <input type="text" class="input-sm form-control" value="<?= $this->iff($_REQUEST['fromTime'], $_REQUEST['fromTime'], date('Y-m-d H:i', $GLOBALS['fromTime'])) ?>" name="fromTime" id="startTime">
                                <span class="input-group-addon">到</span>
                                <input type="text" class="input-sm form-control" value="<?= $this->iff($_REQUEST['toTime'], $_REQUEST['toTime'], date('Y-m-d H:i', $GLOBALS['toTime'])) ?>" name="toTime" id="endTime">
                            </div>

		<div class="search_br">
		<input type="submit" class="btn btn-primary btn-sm" value="查询"></input>
        <!--div class="search_br"><input type="button" value="查询" class="formCheck chazhao" /></div-->
		</div>
    </form>
<style type="text/css">
.search_br {padding-top:10px;height:45px;text-align: center;color: #666;}
</style> 
<div class="display biao-cont">
<?php $this->display('cash/to-cash-list.php'); ?>
 </div>
