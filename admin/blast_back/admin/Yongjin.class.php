<?php
class yongjin extends AdminBase{
	public $pageSize=15;
	
	//佣金记录
	public final function yongjinlog(){
		$this->display('yongjin/yongjin-log.php');
	}
	
	//删除
	public final function bonusyjLogDelete($id){
		if(!$id=intval($id)) throw new Exception('参数出错');
		$sql="delete from blast_yj_log where id=?";
		$bonusStatus = $this->getValue($sql, $id);

		if($bonusStatus == 1){
			$this->exec($this->prename .'yj_log', array('type'=>0), 'id='.$id);
			echo '操作成功';
		}
	}
	//至尊佣金
	public final function setyongjin(){
		$sql="select * from blast_yongjin order by id";
		$yjsinfo=$this->getRows($sql);
		$this->yjs=$yjsinfo[0];
		$this->yj1=$yjsinfo[1];
		$this->yj2=$yjsinfo[2];
		$this->yj3=$yjsinfo[3];
		$this->yj4=$yjsinfo[4];
		$this->yj5=$yjsinfo[5];
		$this->display('yongjin/yongjin.php');
		
	}
	public final function updateyjSettings(){
		$sql="update blast_yongjin set startime=$_POST[startime],endtime=$_POST[endtime],type=$_POST[type] where id=1";
		$this->exec($sql);
		
		$yjs1=$_POST['yjs1'];
		$sql="update blast_yongjin set endtime=$yjs1[money],lvone=$yjs1[lvone],lvtwo=$yjs1[lvtwo],lvtress=$yjs1[lvtress],lvfour=$yjs1[lvfour],type=$yjs1[type] where id=2";
		
		$this->exec($sql);
		$yjs1=$_POST['yjs2'];
		$sql="update blast_yongjin set endtime=$yjs1[money],lvone=$yjs1[lvone],lvtwo=$yjs1[lvtwo],lvtress=$yjs1[lvtress],lvfour=$yjs1[lvfour],type=$yjs1[type] where id=3";
		$this->exec($sql);
		$yjs1=$_POST['yjs3'];
		$sql="update blast_yongjin set endtime=$yjs1[money],lvone=$yjs1[lvone],lvtwo=$yjs1[lvtwo],lvtress=$yjs1[lvtress],lvfour=$yjs1[lvfour],type=$yjs1[type] where id=4";
		$this->exec($sql);
		$yjs1=$_POST['yjs4'];
		$sql="update blast_yongjin set endtime=$yjs1[money],lvone=$yjs1[lvone],lvtwo=$yjs1[lvtwo],lvtress=$yjs1[lvtress],lvfour=$yjs1[lvfour],type=$yjs1[type] where id=5";
		$this->exec($sql);
		$yjs1=$_POST['yjs5'];
		$sql="update blast_yongjin set endtime=$yjs1[money],lvone=$yjs1[lvone],lvtwo=$yjs1[lvtwo],lvtress=$yjs1[lvtress],lvfour=$yjs1[lvfour],type=$yjs1[type] where id=6";
		$this->exec($sql);
		echo "y";
	}
	
	
}