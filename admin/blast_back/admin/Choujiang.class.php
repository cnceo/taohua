<?php
class choujiang extends AdminBase{
	public $pageSize=15;
	
	//幸运大抽奖
	public final function add_leavl(){
		$this->display('choujiang/add-leavl.php');
	}
	public final function lucky(){
		$this->display('choujiang/lucky.php');
	}
	public final function leavl(){
		$this->display('choujiang/leavl.php');
	}

    public final function add_leavls($passwordEncrypt=false){
		if(!$_POST) throw new Exception('提交数据出错');
		//过滤
		$update['min_cz_money']=floatval($_POST['min_cz_money']);
		$update['max_cz_money']=floatval($_POST['max_cz_money']);
		$update['min_prize_money']=floatval($_POST['min_prize_money']);
		$update['max_prize_money']=floatval($_POST['max_prize_money']);
		$update['type']=intval($_POST['type']);
		
		if($this->insertRow($this->prename .'leavl', $update)){
			$para['message']='添加区间成功';
			return json_encode(1);
		}else{
			return json_encode(2);
		}
	}
	/*编辑用户*/
	public final function leavlUpdate($id){
		$this->display('choujiang/leavl-update-modal.php', 0, $id);
	}
	public final function leavlUpdateed(){
		$para=$_POST;
		$id=intval($para['id']);
		
		if($this->updateRows($this->prename .'leavl', $para, "id=$id")){
			$msg =  '修改成功';
			$fun='success';
		}else{
			$msg = '未知出错';
			$fun='error';
		}
		echo '<script type="text/javascript">top.onUpdateCompile3("', $fun, '", ', json_encode($msg), ')</script>';
	}	
}