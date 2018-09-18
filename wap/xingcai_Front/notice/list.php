<?php $this->display('inc_daohang1.php'); ?>
<script src="/hcss/js/jquery.min.js?v=2.1.4"></script>
<script src="/hcss/js/bootstrap.min.js?v=3.3.6"></script>
<script type="text/javascript" src="/js/nsc_m/res.js?v=1.16.12.4"></script>

	<script>
	$(document).ready(function(){
		//改变element样式
		var arr = ['warning-element','success-element','info-element','danger-element'];
		var index2 = 0;
		$("#newlog").find("li").each(function(index){	
		
			if(index2 >= arr.length){
				index2 = 0;
			}
				
			
			$(this).removeClass().addClass(arr[index2]);
			index2++;
		});
		
		//触发modal窗口隐藏事件，清空数据
		$("#myModal6").on("hidden.bs.modal", function() {  
			$(this).removeData("bs.modal");  
		}); 
	});
			
	</script>
   <section class="wraper-page">
<div class="ibox-title">
                        <h5>公告列表 <small></small></h5>
                        
                    </div>

<div class="display biao-cont">



<div class="row">
                 <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    
                    <div class="ibox-content">

                        <ul id="newlog" class="sortable-list connectList agile-list ui-sortable">
                            		 <?php
			$cout=0;
            $styles=array('tr_line_2_a','tr_line_2_b');
			
            if($args[0]) foreach($args[0]['data'] as $var){
			$cout+=1;
			$mod=$cout%2;
        ?>
                            <li class="success-element">
                                <?= $var['title'] ?>
                                <div class="agile-detail">
                                    <a  class="pull-right btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal6" href="/index.php/notice/view/<?= $var['id'] ?>">查看</a>
                                    <i class="fa fa-clock-o"></i><?=date('Y-m-d H:i:s', $var['addTime'])?>
                                </div>
                            </li>
						
							 <?php
} else {
?>
		 <li class="success-element">
                                <?= $var['title'] ?>
                                <div class="agile-detail">
                                    <a  class="pull-right btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal6" href="/index.php/notice/view/<?= $var['id'] ?>">查看</a>
                                    <i class="fa fa-clock-o"></i> <?=date('Y-m-d', $var['addTime'])?>
                                </div>
                            </li>
 <?php
}
?>		
<div class="btn-group">
                           <?php $this->display('inc_page1.php', 0, $args[0]['total'], $this->pageSize, "/index.php/notice/info-{page}", 0); ?>
                            </div>
			
                           
                        </ul>
</div>
</div>
</div>
</div>
</div>
 <div class="modal inmodal fade" id="myModal6" >
                              
				<div class="modal-content">