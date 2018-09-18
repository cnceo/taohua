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
	/*if($para['fromTime'] && $para['toTime']){
		$whereStr .= ' and b.actionTime between '.strtotime($para['fromTime']).' and '.strtotime($para['toTime']);
	}elseif($para['fromTime']){
		$whereStr .= ' and b.actionTime>='.strtotime($para['fromTime']);
	}elseif($para['toTime']){
		$whereStr .= ' and b.actionTime<'.strtotime($para['toTime']);
	}else{
		
		if($GLOBALS['fromTime'] && $GLOBALS['toTime']){
			$whereStr .= ' and b.actionTime between '.$GLOBALS['fromTime'].' and '.$GLOBALS['toTime'].' ';
		}
	}*/
	
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
   $whereStr .= " and b.hmEnable=1";

	$sql="select b.*, u.username from {$this->prename}bets b, {$this->prename}members u where b.uid=u.uid";
	$sql.=$whereStr;
	$sql.=' order by id desc, actionTime desc';
	
	$data=$this->getPage($sql, $this->page, $this->pageSize);
	//print_r($data);
	$params=http_build_query($para, '', '&');
	
	$modeName=array('1.000'=>'元', '0.100'=>'角', '0.010'=>'分', '0.001'=>'厘','1.000'=>'1元');
?>
<div>
<style>
    .buy-number .minus, .buy-number .add, .buy-number-1 .minus, .buy-number-1 .add {
	position: relative;
	z-index: 2;
	display: inline-block;
	height: 22px;
	width: 17px;
	background-image: url(../images/index.png);
	vertical-align: middle;
	cursor: pointer;
}
.buy-number .add {
	width: 17px;
	background-image: url(../images/index.png);
	background-position: 0px 74px;
}
.buy-number input, .buy-number-1 input {
	margin-right: -5px;
	margin-left: -5px;
	height: 17px;
	width: 60px;
	line-height: 20px;
	text-align: center;
	border: 1px solid #ABADB3;
	vertical-align: middle;
}

.buy {
    margin-right: 0px;
    padding: 4px 12px;
    color: #fff;
    background-color: #F13131;
    cursor: pointer;
}
.xq {
    margin-right: 10px;
    padding: 4px 12px;
    color: #fff;
    border: 1px solid #ccc;
    cursor: pointer;
}
.grayTable tr td a {
    color: #000;
}

</style>
<div class="row">
                 <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    
                    <div class="ibox-content">

                        <table width="100%" border="0" cellspacing="1" cellpadding="0" class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <!--th>单号</th-->
                                    <!--th>发起人</th-->
									<th>彩种</th>
                            
									<th>金额</th>
									<th>倍数</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody class="table_b_tr">
						<?php if($data['data']){foreach($data['data'] as $var){ ?>
                                <tr class="gradeX">
                                    <!--td><?=$var['wjorderId']?></td-->
                                    <!--td><?=$this->iff($var['username']==$this->user['username'], $var['username'], preg_replace('/^(\w).*(\w{2})$/', '\1***\2', $var['username']))?></td-->
									<td><?=$this->ifs($this->types[$var['type']]['shortName'],$this->types[$var['type']]['title'])?></td>
									<td><?=$var['mode']*$var['beiShu']*$var['actionNum']?>元</td>
                                
                                 
									
			<td>
			<?php
                                if(empty($var['lotteryNo']) && $var['kjTime']>time() && $var['isDelete']==0){
                                    echo '<input type="number" name="beishu" value="'.$var['beiShu'].'" style="width:40px"/>';
                                }elseif($var['isDelete']==1){
					echo '<font color="#999999">已撤单</font>';
				}elseif($var['zjCount']){
					echo '<font color="red">已派奖</font>';
				}elseif(!$var['lotteryNo'] && $var['kjTime']>time()){
					echo '<font color="#009900">未开奖</font>';
				}elseif($var['lotteryNo']){
					echo '未中奖';
				}elseif($var['kjTime']<time()){
					echo '<font color="#013da0">已过期</font>';
				}
                          
			?></td>
			
     <td>
			 <?php if($var['isDelete']==0 && empty($var['lotteryNo']) && $var['kjTime']>time()){ ?>
				<a  href="/index.php/game/follow_order/<?=$var['id']?>" dataType="json" call="deleteBet" title="是否确定跟买？" target="ajax" class="combine_buy btn btn-primary btn-xs " style="color: #F8F8F8;">购买</a>
                     
			<?php }else{ ?>
				
			<?php } ?>
                                <a class="btn btn-default btn-xs" href="/index.php/lottery/comInfo/<?=$var['id']?>" width="95%" title="投注信息" button="关闭:defaultModalCloase" target="modal">详情</a></td>
		</tr>
		
   	<?php } }else{ ?>
   
    <?php } ?>
                                
                            </tbody>
                        
                        </table>
</div>
</div>
</div>


                    </div>

    <script>
    $('.combine_buy').click(function(){
//       alert($(this).parent().parent().find('input[name=beishu]').val());
        var beishu = $(this).parent().parent().find('input[name=beishu]').val();
        if(parseInt(beishu)>0){
             var href = $(this).attr('href')+'/'+$(this).parent().parent().find('input[name=beishu]').val();
        $(this).attr('href',href);
        }
       
    })
    </script>
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