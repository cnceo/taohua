<?php
class vipxf extends AdminBase{
	public $pageSize=15;
	
	//vip奖励记录
	public final function vipxflog(){
		$this->display('vipxf/vipxiaofei-log.php');
	}
	//记录删除
	public final function vipxfLogDelete($id){
		if(!$id=intval($id)) throw new Exception('参数出错');
		$sql="delete from blast_hytzjl_log where id=?";
		$bonusStatus = $this->getValue($sql, $id);

		if($bonusStatus == 1){
			$this->exec($this->prename .'yj_log', array('type'=>0), 'id='.$id);
			echo '操作成功';
		}
	}
		public final function bonusLogDelete($id){
		if(!$id=intval($id)) throw new Exception('参数出错');
		$sql="select bonusStatus from {$this->prename}bonus_log where id=?";
		$bonusStatus = $this->getValue($sql, $id);

		if($bonusStatus == 1){
			$this->updateRows($this->prename .'bonus_log', array('isDelete'=>1), 'id='.$id);
			echo '操作成功';
		}
	}
	//vip消费活动
	public final function vipxiaofei(){
		$sql="select * from blast_hytzjlrule";
		$this->jlrules=$this->getRows($sql);
		$this->display('vipxf/vipxiaofei.php');
	}
	
	//投主奖励
	public final function setjj(){
		$m=$_POST[rule0][money];$yi=$_POST[rule0][yi];$er=$_POST[rule0][er];$san=$_POST[rule0][san];$si=$_POST[rule0][si];$wu=$_POST[rule0][wu];$liu=$_POST[rule0][liu];$qi=$_POST[rule0][qi];$ba=$_POST[rule0][ba];$jiu=$_POST[rule0][jiu];
		$sql="update blast_hytzjlrule set money=$m,yi=$yi,er=$er,san=$san,si=$si,wu=$wu,liu=$liu,qi=$qi,ba=$ba,jiu=$jiu where id=1";
		
		$this->exec($sql);
		$m=$_POST[rule1][money];$yi=$_POST[rule1][yi];$er=$_POST[rule1][er];$san=$_POST[rule1][san];$si=$_POST[rule1][si];$wu=$_POST[rule1][wu];$liu=$_POST[rule1][liu];$qi=$_POST[rule1][qi];$ba=$_POST[rule1][ba];$jiu=$_POST[rule1][jiu];
		$sql="update blast_hytzjlrule set money=$m,yi=$yi,er=$er,san=$san,si=$si,wu=$wu,liu=$liu,qi=$qi,ba=$ba,jiu=$jiu where id=2";
		$this->exec($sql);
		$m=$_POST[rule2][money];$yi=$_POST[rule2][yi];$er=$_POST[rule2][er];$san=$_POST[rule2][san];$si=$_POST[rule2][si];$wu=$_POST[rule2][wu];$liu=$_POST[rule2][liu];$qi=$_POST[rule2][qi];$ba=$_POST[rule2][ba];$jiu=$_POST[rule2][jiu];
		$sql="update blast_hytzjlrule set money=$m,yi=$yi,er=$er,san=$san,si=$si,wu=$wu,liu=$liu,qi=$qi,ba=$ba,jiu=$jiu where id=3";
		$this->exec($sql);
		$m=$_POST[rule3][money];$yi=$_POST[rule3][yi];$er=$_POST[rule3][er];$san=$_POST[rule3][san];$si=$_POST[rule3][si];$wu=$_POST[rule3][wu];$liu=$_POST[rule3][liu];$qi=$_POST[rule3][qi];$ba=$_POST[rule3][ba];$jiu=$_POST[rule3][jiu];
		$sql="update blast_hytzjlrule set money=$m,yi=$yi,er=$er,san=$san,si=$si,wu=$wu,liu=$liu,qi=$qi,ba=$ba,jiu=$jiu where id=4";
		$this->exec($sql);
		$m=$_POST[rule4][money];$yi=$_POST[rule4][yi];$er=$_POST[rule4][er];$san=$_POST[rule4][san];$si=$_POST[rule4][si];$wu=$_POST[rule4][wu];$liu=$_POST[rule4][liu];$qi=$_POST[rule4][qi];$ba=$_POST[rule4][ba];$jiu=$_POST[rule4][jiu];
		$sql="update blast_hytzjlrule set money=$m,yi=$yi,er=$er,san=$san,si=$si,wu=$wu,liu=$liu,qi=$qi,ba=$ba,jiu=$jiu where id=5";
		$this->exec($sql);
		$m=$_POST[rule5][money];$yi=$_POST[rule5][yi];$er=$_POST[rule5][er];$san=$_POST[rule5][san];$si=$_POST[rule5][si];$wu=$_POST[rule5][wu];$liu=$_POST[rule5][liu];$qi=$_POST[rule5][qi];$ba=$_POST[rule5][ba];$jiu=$_POST[rule5][jiu];
		$sql="update blast_hytzjlrule set money=$m,yi=$yi,er=$er,san=$san,si=$si,wu=$wu,liu=$liu,qi=$qi,ba=$ba,jiu=$jiu where id=6";
		$this->exec($sql);
		$m=$_POST[rule6][money];$yi=$_POST[rule6][yi];$er=$_POST[rule6][er];$san=$_POST[rule6][san];$si=$_POST[rule6][si];$wu=$_POST[rule6][wu];$liu=$_POST[rule6][liu];$qi=$_POST[rule6][qi];$ba=$_POST[rule6][ba];$jiu=$_POST[rule6][jiu];
		$sql="update blast_hytzjlrule set money=$m,yi=$yi,er=$er,san=$san,si=$si,wu=$wu,liu=$liu,qi=$qi,ba=$ba,jiu=$jiu where id=7";
		$this->exec($sql);
		echo "y";
		exit;
	}
}