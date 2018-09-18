
<div class="row">
                 <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">

                        <table width="100%" border="0" cellspacing="1" cellpadding="0" class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>提款金额</th>
                                    <th>申请时间</th>
                                    <th>提款银行</th>
									<!--th>银行尾号</th-->
									<th>状态</th>
                                </tr>
                            </thead>
                            <tbody class="table_b_tr">
						<?php
                $sql="select c.*, b.name bankName from {$this->prename}member_cash c, {$this->prename}bank_list b where c.bankId=b.id and uid={$this->user['uid']} and b.isDelete=0 and c.isDelete=0";
                if($_GET['fromTime'] && $_GET['endTime']){
                    $fromTime=strtotime($_GET['fromTime']);
                    $endTime=strtotime($_GET['endTime']);
                    $sql.=" and actionTime between $fromTime and $endTime";
                }elseif($_GET['fromTime']){
                    $sql.=' and actionTime>='.strtotime($_GET['fromTime']);
                }elseif($_GET['endTime']){
                    $sql.=' and actionTime<'.(strtotime($_GET['endTime']));
                }else{
					
					if($GLOBALS['fromTime'] && $GLOBALS['toTime']) $sql.=' and actionTime between '.$GLOBALS['fromTime'].' and '.$GLOBALS['toTime'].' ';
				}
                
                $stateName=array('已到帐', '正在办理', '已取消', '已支付', '失败');
                
                $list=$this->getPage($sql, $this->page, $this->pageSize);
                if($list['data']) foreach($list['data'] as $var){
            ?>
                                <tr class="gradeX">
                                   <td><?=$var['amount']?></td>
                <td><?=date('m-d', $var['actionTime'])?></td>
                <td><?=$var['bankName']?></td>
                <!--td><?=preg_replace('/^.*(.{4})$/', "$1", $var['account'])?></td-->
                <td>
                <?php
                    if($var['state']==3){
                        echo '<div class="sure" id="', $var['id'], '"></div>';
                    }else if($var['state']==4){
                        echo '<span title="'.$var['info'].'" style="cursor:pointer; color:#f00;">'.$stateName[$var['state']].'</span>';
                    }else{
                        echo $stateName[$var['state']];
                    }
                ?>
                </td>
            </tr>
			<?php }else{ ?>
           
            <?php } ?>
                            </tbody>
                        
                        </table>
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