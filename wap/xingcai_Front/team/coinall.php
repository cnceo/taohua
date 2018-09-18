<?php $this->display('inc_daohang1.php'); 
$teamAll=$this->getRow("select sum(u.coin) coin, count(u.uid) count from {$this->prename}members u where u.isDelete=0 and concat(',', u.parents, ',') like '%,{$this->user['uid']},%'");
  $teamAll2=$this->getRow("select count(u.uid) count from {$this->prename}members u where u.isDelete=0 and u.parentId={$this->user['uid']}");
?>

<?php
	$home_uid=$this->user['uid'];
	$childrenarr=$this->getRows("SELECT username,coin,parents,uid FROM {$this->prename}members where concat(',',parents,',') like '%,{$home_uid},%' and uid!=?",$home_uid);
?>
<script type="text/javascript" src="/js/nsc_m/res.js?v=1.16.12.4"></script>
<section class="wraper-page">
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>团队统计 <small></small></h5>
			</div>
            <div class="ibox-content">
				<table width="100%" border="0" cellspacing="1" cellpadding="0" class="table table-striped table-bordered table-hover dataTables-example">
					<thead>
					
						<tbody class="table_b_tr">
							<tr>
								<th>我的账号</th>
								<td><?=$this->user['username']?></td>
							</tr>
							<tr>
								<th>账号类型</th>
								<td><?=$this->iff($this->user['type'], '代理', '会员')?></td>
							</tr>
							<tr>
								<th>用户昵称</th>
								<td><?=$this->user['nickname']?></td>
							</tr>
							<tr>
								<th>可用余额</th>
								<td><?=$this->user['coin']?> 元</td>
							</tr>
							<tr>
								<th>团队余额</th>
								<td><?=$teamAll['coin']?> 元</td>
							</tr>
							<tr>
								<th>直属下级</th>
								<td><?=$teamAll2['count']?> 位</td>
							</tr>
							<tr>
								<th>所有下级</th>
								<td><?=($teamAll['count']-1)?> 位</td>
							</tr>
									<?php 
										$onlineNum = 0;
										foreach($childrenarr as $var){ 
											$login=$this->getRow("select * from {$this->prename}member_session where uid=? order by id desc limit 1", $var['uid']);
										if($login['isOnLine'] && ($this->time-$login['accessTime']<900)){
											$parents = explode(',',$var['parents']);
											rsort($parents);
											$index = 1;
											foreach($parents as $key=>$var2){
												$index++;
											}
									?>
										<?php 
											$onlineNum++;
											} } 
										?>
							<tr>
								<th>在线总数</th>
								<td><?=$onlineNum?> 人</td>
							</tr>
						</tbody>
					</thead>
				</table>
			</div>			
		</div>
	</div>
</div>