<?php
	$sql="select * from {$this->prename}members where ";
	if($_GET['username'] && $_GET['username']!='用户名'){
		$_GET['username']=wjStrFilter($_GET['username']);
		if(!ctype_alnum($_GET['username'])) throw new Exception('用户名包含非法字符,请重新输入');
		// 按用户名查找时
		// 只要符合用户名且是自己所有下级的都可查询
		// 用户名用模糊方式查询
		$sql.="username like '%{$_GET['username']}%' and concat(',',parents,',') like '%,{$this->user['uid']},%'";
	}else{
		unset($_GET['username']);
		switch($_GET['type']){
			case 0:
				// 所有人
				$sql.="concat(',',parents,',') like '%,{$this->user['uid']},%'";
			break;
			case 1:
				// 我自己
				$sql.="uid={$this->user['uid']}";
			break;
			case 2:
				// 直属下级
				if(!$_GET['uid']) $_GET['uid']=$this->user['uid'];
				$sql.="parentId={$_GET['uid']}";
			break;
			case 3:
				// 所有下级
				$sql.="concat(',',parents,',') like '%,{$this->user['uid']},%' and uid!={$this->user['uid']}";
			break;
		}
	}
	
	if($_GET['uid']=$this->user['uid']) unset($_GET['uid']);
	$data=$this->getPage($sql, $this->page, $this->pageSize);
	$params=http_build_query($_GET, '', '&');
	//echo $params;
?>

                 
                    <div class="ibox-content">

                        <table width="100%" border="0" cellspacing="1" cellpadding="0" class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>用户名</th>
                                    <th>类型</th>
									<th>余额</th>
                                    <th>返点</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
						<?php if($data['data']) foreach($data['data'] as $var){ ?>
	 <?php $login=$this->getRow("select * from {$this->prename}member_session where uid=? order by id desc limit 1", $var['uid']);?>
                                <tr class="gradeX">
                                    <td><?=$var['username']?></td>
                                    <td><?=$this->iff($var['type'],'代理','会员')?></td>
									<td><?=$var['coin']?></td>
                                    <td><?=$var['fanDian']?>%</td>
                                 
									  <?php if($this->user['uid']!=$var['uid'] && $var['parentId']==$this->user['uid']){ ?>
			<td>
			<?php if($this->settings['recharge']==1){?>
			<a href="/index.php/team/userUpdate/<?=$var['uid']?>" style="color:#333;" target="modal"  width="420" title="修改用户" modal="true" button="确定:dataAddCode|取消:defaultCloseModal">修改</a>&nbsp;&nbsp;
			<a href="/index.php/team/userUpdate2/<?=$var['uid']?>" style="color:#333;" target="modal"  width="420" title="给下级充值" modal="true" button="确定:dataAddCode|取消:defaultCloseModal">充值</a>&nbsp;&nbsp;
            <?}?>
			<a class="caozuo" href="/index.php/team/searchMember?type=2&uid=<?=$var['uid']?>">下级</a></td>
            <?php }else{ ?>
            <td><a class="caozuo" href="/index.php/team/searchMember?type=2&uid=<?=$var['uid']?>">下级</a></td>
            <?php } ?>
		</tr>
		
	<?php } ?>
                                
                            </tbody>
                        
                        </table>

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