<?php $this->display('inc_daohang1.php'); ?>
<script type="text/javascript" src="/js/nsc_m/res.js?v=1.16.12.4"></script>
<script type="text/javascript">
$(function(){
	$('.search select').change(function(){
		//this.form.submit();
		$(this).closest('form').submit();
	});
	$('.chazhao').click(function(){
		$(this).closest('form').submit();
	});
	
	$('.search input[name=username]')
	.focus(function(){
		if(this.value=='用户名') this.value='';
	})
	.blur(function(){
		if(this.value=='') this.value='用户名';
	})
	.keypress(function(e){
		if(e.keyCode==13) $(this).closest('form').submit();
	});
	
	$('.bottompage a[href], .caozuo').live('click', function(){
		$('.biao-cont').load($(this).attr('href'));
		return false;
	});
	
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
function teamBeforeSearchMember(){}
function teamSearchMember(err, data){
	if(err){
		alert(err);
	}else{
		$('.biao-cont').html(data);
	}
}
</script>
<section class="wraper-page">
<div class="ibox-title">
                        <h5>用户列表 <small></small></h5>
                        
                    </div>
    <form action="/index.php/team/searchMember" dataType="html" target="ajax" method="get" onajax="teamBeforeSearchMember" call="teamSearchMember">
      
	  
	  
	          <div id="searchBox" class="re">
        	<div class="input-append input-group" "="">					
			<span class="input-group-btn">	
			<button class="btn btn-white" type="button">下级帐号</button>	
			</span>				
		  <input type="text" class="input-large form-control" placeholder="请输入需要查找的用户名" name="username"/>  
			</div>
          <div class="input-append input-group" "="">					
			<span class="input-group-btn">				
			 
			<button class="btn btn-white" type="button">查找类型</button>	
			</span>				
			 <select class="input-large form-control" name="type">
              <option value="0" selected>所有人</option>
            <option value="1">我自己</option>
            <option value="2">直属下线</option>
            <option value="3">所有下线</option>
        </select>
			</div>
          
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
    	<!--下注列表-->
        <?php $this->display('team/member-search-list.php'); ?>
        <!--下注列表 end -->
    </div>
