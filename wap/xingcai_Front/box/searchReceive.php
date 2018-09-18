 <?php

	// 日期限制
	//if($_REQUEST['fromTime'] && $_REQUEST['toTime']){
	//	$timeWhere=' and s.time between '. strtotime($_REQUEST['fromTime']).' and '.strtotime($_REQUEST['toTime']);
	//}elseif($_REQUEST['fromTime']){
	//	$timeWhere=' and s.time >='. strtotime($_REQUEST['fromTime']);
	//}elseif($_REQUEST['toTime']){
	//	$timeWhere=' and s.time <'. strtotime($_REQUEST['toTime']);
	//}else{
	//	if($GLOBALS['fromTime'] && $GLOBALS['toTime']) $timeWhere=' and s.time between '.$GLOBALS['fromTime'].' and '.$GLOBALS['toTime'].' ';
	//}

	// 消息类型限制
	switch($_REQUEST['state']){
		    case 1:
				$stateWhere=' and r.is_readed=0';
			break;
			case 2:
				$stateWhere=' and r.is_readed=1';
			break;
			case 3:
				$stateWhere=' and r.is_readed between 0 and 1';
			break;
			default:
				$stateWhere=' and r.is_readed between 0 and 1';
		}

	$sql="select s.mid, r.is_readed, s.title, s.from_username, s.time from {$this->prename}message_sender s, {$this->prename}message_receiver r where r.to_uid={$this->user['uid']} and r.is_deleted=0 $timeWhere $stateWhere and r.mid=s.mid order by s.time DESC";
	$list=$this->getPage($sql, $this->page, $this->pageSize);
	$params=http_build_query($_REQUEST, '', '&');
?> 
<div class="mail-box">
			                   <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    
                    <div class="ibox-content" id="playList">

                        <table id="tbUserList" width="100%" border="0" cellspacing="1" cellpadding="0" class="table table-hover table-mail dataTables-example">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="SelectAll"  value="全选" onclick="selectAll();" /></th>
                                    <th>状态</th>
                                    <th>主题</th>
									<th>发件人</th>
                                    <th>查看</th>
                                </tr>
                            </thead>
                            <tbody class="table_b_tr" >
						<?php if($list['data']) foreach($list['data'] as $var){ ?>
                                <tr class="gradeX" tourl="/index.php/box/detail/<?=$var['mid']?>" dataid="<?=$var['mid']?>"  >
								
								
								
								 <td><input  type="checkbox" value="<?=$var['mid']?>" name="chk_only" ></td>
                                    <td><?if($var['is_readed']){echo '已读';}else{echo '<span style="color:#FF0000">未读</span>';}?></td>
									
                                    <td><?=$this->CsubStr(htmlspecialchars($var['title']),0,4)?></td>
									<td><?=htmlspecialchars($var['from_username'])?></td>
									<td><a  class="pull-right btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal6" href="/index.php/box/detail/<?=$var['mid']?>">查看</a></td>
									 
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
   $('#example').dataTable( {
    "processing": true
} );
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
	    <script language="javascript" type="text/javascript">
function selectAll(){  
    if ($("#SelectAll").attr("checked")) {  
        $(":checkbox").attr("checked", true);  
    } else {  
        $(":checkbox").attr("checked", false);  
    }  
}  
    </script>
	<div class="modal inmodal fade" id="myModal6" >
                              
				<div class="modal-content">	