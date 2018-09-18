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
<div>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="grayTable">
	<thead>
		<tr class="table_b_th">
			<td>单号</td>
            <td>发起人</td>
			<td>彩种</td>
			<td>期号</td>
			<td>玩法</td>
			<td>倍数 | 模式</td>
			<td>金额</td>
			<td>认购倍数</td>
            <td>操作</td>
		</tr>
	</thead>
	<tbody class="table_b_tr">
	<?php if($data['data']){foreach($data['data'] as $var){ ?>
		<tr>
			<td>
				<?=$var['wjorderId']?>
			</td>
            <td>
                <?=$this->iff($var['username']==$this->user['username'], $var['username'], preg_replace('/^(\w).*(\w{2})$/', '\1***\2', $var['username']))?>
		
            </td>
			<!--<td><?=date('m-d H:i:s', $var['actionTime'])?></td>-->
			<td><?=$this->ifs($this->types[$var['type']]['shortName'],$this->types[$var['type']]['title'])?></td>
			<td><?=$var['actionNo']?></td>
			<td><?=$this->playeds[$var['playedId']]['name']?></td>
			<td><?=$var['beiShu']?>倍 [<?=$modeName[$var['mode']]?>]</td>
			<td><?=$var['mode']*$var['beiShu']*$var['actionNum']?>元</td>
<!--			<td><?=$this->iff($var['lotteryNo'], number_format($var['bonus'], 2), '0.00')?></td>
			<td style="text-align: center;"><?=$this->ifs($this->CsubStr($var['lotteryNo'],0,6), '--')?></td>-->
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
                          
			?>
                  
                            
                        </td>
            <td>
            <?php if($var['isDelete']==0 && empty($var['lotteryNo']) && $var['kjTime']>time()){ ?>
				<a  href="/index.php/game/follow_order/<?=$var['id']?>" dataType="json" call="deleteBet" title="是否确定跟买？" target="ajax" class="combine_buy buy" style="color: #F8F8F8;">购买</a>
                                
			<?php }else{ ?>
				
			<?php } ?>
               <a class="xq" onclick="hmxq(<?=$var['id']?>);" href="javascript:void(0)">详情</a>
            </td>
		</tr>
	<?php } }else{ ?>
    <tr><td colspan="12">暂无投注信息</td></tr>
    <?php } ?>
			

	</tbody>
</table>
<script type="text/javascript">
    $('.combine_buy').click(function(){
//       alert($(this).parent().parent().find('input[name=beishu]').val());
        var beishu = $(this).parent().parent().find('input[name=beishu]').val();
        if(parseInt(beishu)>0){
             var href = $(this).attr('href')+'/'+$(this).parent().parent().find('input[name=beishu]').val();
        $(this).attr('href',href);
        }
       
    })

function hmxq(num){
	layer.open({
	  type: 2,
	  area: ['800px', '600px'],
	  zIndex:1888,
	  //fixed: false, //不固定
	  title:'订单详情',
	  scrollbar: false,//屏蔽滚动条
	  //maxmin: true,
	  content:'/index.php/lottery/comInfo/'+num
	});
	return false;
}	
</script>
<?php 
	$this->display('inc_page.php',0,$data['total'],$this->pageSize, "/index.php/{$this->controller}/{$this->action}-{page}/?$params");
?>
</div>