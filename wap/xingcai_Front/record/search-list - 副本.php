  <?php $this->display('inc_daohang1.php'); ?>
  <link type="text/css" rel="stylesheet" href="/skin/js/jqueryui/jquery-ui-1.8.23.custom.css" />
  
<script type="text/javascript" src="/js/nsc_m/layer.js?v=1.16.12.12"></script>
<link href="/js/nsc_m/need/layer.css?2.0" type="text/css" rel="styleSheet" id="layermcss">
<script type="text/javascript" src="/js/nsc_m/res.js?v=1.16.12.4"></script>
<script type="text/javascript" src="/js/nsc/main.js?v=1.16.12.4"></script>
<script type="text/javascript" src="/newskin/js/common.js"></script>
<script type="text/javascript" src="/skin/js/onload.js"></script>
<script type="text/javascript" src="/skin/js/function.js"></script>
<script type="text/javascript" src="/skin/js/jquery.simplemodal.src.js"></script>
<script type="text/javascript" src="/skin/js/jqueryui/jquery-ui-1.8.23.custom.min.js"></script>
 <link href="/hcss/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
 <link href="/hcss/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <!-- Data Tables -->
<link href="/hcss/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<link href="/hcss/css/animate.css" rel="stylesheet">
<link href="/hcss/css/style.css?v=4.1.0" rel="stylesheet">



<div id="datePlugin"></div>
<link href="/newskin/riqi/css/common.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="/newskin/riqi/js/date.js" ></script>
<script type="text/javascript" src="/newskin/riqi/js/iscroll.js" ></script>
<?php
	//echo $this->userType;
	$para=$_GET;
	
	if($para['state']==5){
		$whereStr = " and b.isDelete=1 ";
	}else{
		$whereStr = " and  b.isDelete=0 ";	
	}
	// 彩种限制
	if($para['type']){
		$para['type']=intval($para['type']);
		$whereStr .= " and b.type={$para['type']}";
	}
	
	// 时间限制
	if($para['fromTime'] && $para['toTime']){
		$whereStr .= ' and b.actionTime between '.strtotime($para['fromTime']).' and '.strtotime($para['toTime']);
	}elseif($para['fromTime']){
		$whereStr .= ' and b.actionTime>='.strtotime($para['fromTime']);
	}elseif($para['toTime']){
		$whereStr .= ' and b.actionTime<'.strtotime($para['toTime']);
	}else{
		
		if($GLOBALS['fromTime'] && $GLOBALS['toTime']){
			$whereStr .= ' and b.actionTime between '.$GLOBALS['fromTime'].' and '.$GLOBALS['toTime'].' ';
		}
	}
	
	// 投注状态限制
	if($para['state']){
	switch($para['state']){
		case 1:
			// 已派奖
			$whereStr .= ' and b.zjCount>0';
		break;
		case 2:
			// 未中奖
			$whereStr .= " and b.zjCount=0 and b.lotteryNo!='' and b.isDelete=0";
		break;
		case 3:
			// 未开奖
			$whereStr .= " and b.lotteryNo=''";
		break;
		case 4:
			// 追号
			$whereStr .= ' and b.zhuiHao=1';
		break;
		case 5:
			// 撤单
			$whereStr .= ' and b.isDelete=1';
		break;
		}
	}
	
	// 模式限制
	$para['mode']=floatval($para['mode']);
	if($para['mode']) $whereStr .= " and b.mode={$para['mode']}";
	
   //单号
   $para['betId']=wjStrFilter($para['betId']);
   if($para['betId'] && $para['betId']!='输入单号'){
	   if(!ctype_alnum($para['betId'])) throw new Exception('单号包含非法字符,请重新输入');
	   $whereStr .= " and b.wjorderId='{$para['betId']}'";
   }
   
   //用户限制
   $whereStr .= " and b.uid={$this->user['uid']}";

	$sql="select b.*, u.username from {$this->prename}bets b, {$this->prename}members u where b.uid=u.uid";
	$sql.=$whereStr;
	$sql.=' order by id desc, actionTime desc';
	
	$data=$this->getPage($sql, $this->page, $this->pageSize);
	//print_r($data);
	$params=http_build_query($para, '', '&');
	
	$modeName=array('2.000'=>'元', '0.200'=>'角', '0.020'=>'分', '0.002'=>'厘','1.000'=>'1元');
?>

<div>
                 <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>投注记录 <small></small></h5>
                        
                    </div>
                    <div class="ibox-content">

                        <table width="100%" border="0" cellspacing="1" cellpadding="0" class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>单号</th>
                                    <th>彩种</th>
									<!--th>期号</th-->
                                    <th>金额</th>
									<!--th>状态</th-->
									<td>下注时间</td>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody class="table_b_tr">
						<?php if($data['data']){foreach($data['data'] as $var){ ?>
                                <tr class="gradeX">
                                    <td><a href="/index.php/record/betInfo/<?=$var['id']?>" width="80%" title="投注信息" button="关闭:defaultModalCloase" target="modal"><?=$var['wjorderId']?></td>
                                    <td><?=$this->ifs($this->types[$var['type']]['shortName'],$this->types[$var['type']]['title'])?></td>
									<!--td><?=$var['actionNo']?></td-->
                                    <td><a title="<?=$this->ifs($this->CsubStr($var['lotteryNo'],0,255), '--')?>" ><?=$this->ifs($this->CsubStr($var['lotteryNo'],0,8), '--')?></td>
                                 
									
			<!--td>
			<?php
				if($var['isDelete']==1){
					echo '<font color="#999999">已撤单</font>';
				}elseif(!$var['lotteryNo']){
					echo '<font color="#009900">未开奖</font>';
				}elseif($var['zjCount']){
					echo '<font color="red">已派奖</font>';
				}else{
					echo '未中奖';
				}
			?></td-->
				<td><?=date('m-d H:i:s', $var['actionTime'])?></td>
     <td>
			 <?php if($var['lotteryNo'] || $var['isDelete']==1 || $var['kjTime']<$this->time || $var['type']==34 || $var['type']==77){ ?>
				--
			<?php }else{ ?>
				<a href="/index.php/game/deleteCode/<?=$var['id']?>" dataType="json" call="deleteBet" title="是否确定撤单" target="ajax">撤单</a>
			<?php } ?></td>
		</tr>
		
   	<?php } }else{ ?>
   
    <?php } ?>
                                
                            </tbody>
                        
                        </table>

                    </div>
 <script src="/hcss/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/hcss/js/plugins/dataTables/dataTables.bootstrap.js"></script>
	<script type="text/javascript">
$(function(){
	$('#beginTime').date();
	$('#endTime').date({theme:"datetime"});
});
</script>
   <script>
        $(document).ready(function () {
            $('.dataTables-example').dataTable();

            /* Init DataTables */
            var oTable = $('#editable').dataTable();

            /* Apply the jEditable handlers to the table */
        });
        function fnClickAddRow() {
            $('#editable').dataTable().fnAddData([
                "Custom row",
                "New row",
                "New row",
                "New row",
                "New row"]);
        }
    </script>
	<?php $this->display('inc_root.php'); ?>
</body>
</html>