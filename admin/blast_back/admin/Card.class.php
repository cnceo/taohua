<?php
class Card extends AdminBase{
	public $pageSize=15;
	
	public final function index(){
		$this->display('card/index.php');
	}
	
	public final function record(){
		$this->display('card/record.php');
	}
	
	public final function recordDel($id){
		if(!$id=intval($id)) throw new Exception('参数出错');
		$sql="delete from {$this->prename}card where id=?";
		if($this->delete($sql, $id)){
			return '记录已经删除';
		}else{
			throw new Exception('未知出错');
		}
	}
	public final function cardModal(){
		$this->display('card/card-modal.php');
	}
	public final function updateCards(){
		$total_num = $_POST['num'];
		$para['price'] = $_POST['price'];
		$para['uid'] = 0;
		$para['username'] = "";
		$para['add_time'] = time();
		$para['status'] = 0;
		$para['use_time'] = 0;
		for ($i=0;$i<$total_num;$i++){
			$para['card_str'] = $this->getCardStr();
			$sql="";
			$sql="insert into {$this->prename}card set";
			foreach($para as $field=>$var){
				$sql.=" `$field`='$var',";
			}
			$sql=rtrim($sql,',');
			$sql.=' on duplicate key update `price`=values(`price`), `uid`=values(`uid`), `username`=values(`username`), `add_time`=values(`add_time`), `status`=values(`status`), `use_time`=values(`use_time`), `card_str`=values(`card_str`)';
			if(!$this->insert($sql, $para)){
				break;	
			}
		}
		if($total_num == $i){
			$fun='success';
			$msg='操作成功';
		}else{
			$fun='error';
			$msg='未知错误';
		}
		echo '<script type="text/javascript">top.cardsUpdateCompile("',$fun,'",',json_encode($msg),')</script>';
	}
	public function getCardStr()
	{
		do
		{
			$str=$this->getRandomString();
			$sql="select * from {$this->prename}card where card_str = ".$str;
			$isIn=$this->getrows($sql);
		}while($isIn);
		return $str;
	}
	public function getRandomString()
	{
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$original=str_shuffle($chars);
		$str=substr($original,5,10);
		return $str;
	}
}