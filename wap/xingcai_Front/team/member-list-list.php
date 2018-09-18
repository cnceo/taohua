 <?php
	$sql="select * from {$this->prename}links where enable=1 and uid={$this->user['uid']}";
	if($_GET['uid']=$this->user['uid']) unset($_GET['uid']);
	$data=$this->getPage($sql, $this->page, $this->pageSize);
	?>

<div>
<div class="row">
                 <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="tab-first clearfix">
<ul class="list_menus-li">
	<li><a href="/index.php/team/addlink">推广设定</a></li>
	<li class="on"><a href="/index.php/team/linkList">链接管理</a></li>
</ul>
</div>
                    <div class="ibox-content">

                        <table width="100%" border="0" cellspacing="1" cellpadding="0" class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
									<th>编号</th>
                                    <th>类型</th>
                                    <th>返点</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody class="table_b_tr">
						<?php if($data['data']) foreach($data['data'] as $var){ ?>
                                <tr class="gradeX">
								 <td><?=$var['lid']?></td>
                                    <td><?php if($var['type']){echo'代理';}else{echo '会员';}?></td>
									<td><?=$var['fanDian']?>%</td>
                                    <td><a href="/index.php/team/linkUpdate/<?=$var['lid']?>" style="color:#333;" target="modal"  width="95%" title="修改注册链接" modal="true" button="确定:dataAddCode|取消:defaultCloseModal">修改</a> 
									
									| <a href="/index.php/team/getLinkCode/<?=$var['lid']?>" style="color:#333;" target="modal" width="95%"  title="获取链接" modal="true" button="取消:defaultCloseModal">获取链接</a> 
									
									| <a  href="/index.php/team/linkDelete/<?=$var['lid']?>" button="确定删除:dataAddCode" modal="true" title="删除注册链接" width="95%" target="modal"  style="color:#333;">删除</a></td>

								</tr>
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