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
<div id="contentBox" style="PADDING-TOP: 6;">
    <form action="/index.php/lottery/combine_buy/<?=$this->userType?>" dataType="html" call="recordSearch" target="ajax">
     <div class="ibox-title">
                        <h5>合买中心 <small>备注：查看详细信息，请点击详情</small></h5>
      </div>
        <div id="searchBox" class="re">
        	<div class="input-append input-group" "="">					
			<span class="input-group-btn">	
			<button class="btn btn-white" type="button">彩种名称</button>	
			</span>				
			 <select class="input-large form-control" class="team" name="type">
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
			 <select class="input-large form-control" name="state">
               <option value="0" selected>所有状态</option>
            <option value="1">已派奖</option>
            <option value="2">未中奖</option>
            <option value="3">未开奖</option>
            <option value="4">追号</option>
            <option value="5">撤单</option>
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
<?php $this->display('lottery/combine_list.php'); ?>
 </div>
