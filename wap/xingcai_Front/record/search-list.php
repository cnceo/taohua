
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
	
	$modeName=array('1.000'=>'元', '0.100'=>'角', '0.010'=>'分', '0.001'=>'厘','1.000'=>'1元');
?>


<div class="row">
                 <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    
                    <div class="ibox-content">

                        <table width="100%" border="0" cellspacing="1" cellpadding="0" class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>单号</th>
                                    <th>彩种</th>
									<!--th>期号</th-->
                                    <th>奖金</th>
									<!--th>状态</th-->
									<!--td>下注时间</td-->
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody class="table_b_tr">
						<?php if($data['data']){foreach($data['data'] as $var){ ?>
                                <tr class="gradeX">
                                    <td><a href="/index.php/record/betInfo/<?=$var['id']?>" width="80%" title="投注信息" button="关闭:defaultModalCloase" target="modal"><?=$var['wjorderId']?></td>
                                    <td><?=$this->ifs($this->types[$var['type']]['shortName'],$this->types[$var['type']]['title'])?></td>
									<!--td><?=$var['actionNo']?></td-->
                                    <td><?=$this->iff($var['lotteryNo'], number_format($var['bonus'], 3), '0.000')?></td>
                                 
									
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
				<!--td><?=date('m-d H:i:s', $var['actionTime'])?></td-->	<!--td>下注时间</td-->
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
</div>
</div>
</div>
</div>



   <script>
    $(document).ready(function() {
              $('.dataTables-example').dataTable( {
              //跟数组下标一样，第一列从0开始，这里表格初始化时，第四列默认降序
                "order": [[ 3, "desc" ]]
              } );
            } );
        function fnClickAddRow() {
            $('#editable').dataTable().fnAddData([
                "Custom row",
                "New row",
                "New row",
                "New row",
                "New row"]);
        }
    </script>
</body>
</html>