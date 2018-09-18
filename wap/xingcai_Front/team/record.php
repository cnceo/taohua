<?php $this->display('inc_daohang1.php'); ?>
<script type="text/javascript" src="/js/nsc_m/res.js?v=1.16.12.4"></script>
<script type="text/javascript">
function recordSearch(err, data){
	if(err){
		xingcai(err);
	}else{
		$('.biao-cont').html(data);
	}
}
</script>
   <section class="wraper-page">
 <div class="ibox-title">
                        <h5>投注记录 <small></small></h5>
                        
                    </div>
     <form action="/index.php/team/searchGameRecord/<?=$this->userType?>" dataType="html" call="recordSearch" target="ajax">
      <div class="input-daterange input-group" style="PADDING-TOP: 6;">
                                <input type="text" class="input-sm form-control" value="<?= $this->iff($_REQUEST['fromTime'], $_REQUEST['fromTime'], date('Y-m-d H:i', $GLOBALS['fromTime'])) ?>" name="fromTime" id="startTime">
                                <span class="input-group-addon">到</span>
                                <input type="text" class="input-sm form-control" value="<?= $this->iff($_REQUEST['toTime'], $_REQUEST['toTime'], date('Y-m-d H:i', $GLOBALS['toTime'])) ?>" name="toTime" id="endTime">
                            </div>
        <div id="searchBox" class="re">
        	<div class="input-append input-group" "="">					
			<span class="input-group-btn">	
			<button class="btn btn-white" type="button">彩种名称</button>	
			</span>				
			 <select class="input-large form-control"  name="state">
                 <option value="0" <?=$this->iff($_REQUEST['type']=='', 'selected="selected"')?>>全部彩种</option>
            <?php
                if($this->types) foreach($this->types as $var){ 
                    if($var['enable']){
            ?>
            <option value="<?=$var['id']?>" <?=$this->iff($_REQUEST['type']==$var['id'], 'selected="selected"')?>><?=$this->iff($var['shortName'], $var['shortName'], $var['title'])?></option>

            <?php }} ?>
        </select>
			</div>
          <div class="input-append input-group" "="">					
			<span class="input-group-btn">				
			 
			<button class="btn btn-white" type="button">彩种状态</button>	
			</span>				
			 <select class="input-large form-control"  name="state" style="width:50%;">
               <option value="0" selected>所有状态</option>
            <option value="1">已派奖</option>
            <option value="2">未中奖</option>
            <option value="3">未开奖</option>
            <option value="4">追号</option>
            <option value="5">撤单</option>
        </select>
		<select class="input-large form-control" name="utype" style="width:50%;">
            <option value="0" selected>所有人</option>
            <option value="1">我自己</option>
            <option value="2">直属下线</option>
            <option value="3" >所有下线</option>
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
<?php $this->display('team/record-list.php'); ?>
 </div>
