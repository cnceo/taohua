<?php

/**
 * 与开奖数据有关
 */
class Data extends AdminBase{
	public $pageSize=15;
	private $encrypt_key='QQ:123-CMK;pt`4Wg;*$+G<EWhZ~I+@l,k$y5r75Q/)GL;pt`4Wg;*$+G<EWhZ~I+@l,k$y5r75Q/)t#20BO(,u=PHsGr@NI*N/On?u8v(^Pa~Gl;pt`4Wg;*$+G<EWhZ~I+@l,k$y5r75Q/)#n=0w:%o5G$8QCOsdFf2(yz1Fz:ZB#uAR';	// 256位随便密码
	private $dataPort=8800;
	
	public final function index($type){
		$this->type=$type;
		$this->display('data/index.php');
	}
	
	public final function add($type, $actionNo, $actionTime){
		$para=array(
			'type'=>$type,
			'actionNo'=>$actionNo,
			'actionTime'=>$actionTime
		);
		$this->display('data/add-modal.php', 0, $para);
	}

    public final function updatedata($type, $actionNo, $actionTime){
		$para=array(
			'type'=>$type,
			'actionNo'=>$actionNo,
			'actionTime'=>$actionTime
		);
		$this->display('data/update-modal.php', 0, $para);
	}
	
	public final function kj(){
		$para=$_GET;
		$para['key']=$this->encrypt_key;
		$url=$GLOBALS['conf']['node']['access'] . '/data/kj';
		echo $this->http_post($url, $para);
	}
//添加开奖号
	public final function added(){
		$para=$_POST;
		$para['type']=intval($para['type']);
		$para['key']=$this->encrypt_key;

		$sql ="insert into {$this->prename}data(type, time, number, data)values({$para['type']},0,'{$para['number']}','{$para['data']}')";
		$return =$this->getRow($sql);
		
	}

	public final function updatedataed(){
		$id=intval($_POST['id']);
		$para['data']=$_POST['data'];
		$sql="update {$this->prename}data set data='{$para['data']}' where id={$id}";
		if($this->update($sql)){
			echo '修改成功';
		}
	}
	
	public function http_post($url, $data) {
		$data_url = http_build_query ($data);
		$data_len = strlen ($data_url);
	
		return file_get_contents ($url, false, stream_context_create (array ('http'=>array ('method'=>'POST'
				, 'header'=>"Connection: close\r\nContent-Length: $data_len\r\n"
				, 'content'=>$data_url
				))));
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	// /*****開始/
	
	//添加号码
	public final function add2($type, $actionNo, $actionTime){
		$para=array(
			'type'=>$type,
			'actionNo'=>$actionNo,
			'actionTime'=>$actionTime
		);
		$this->display('data/add-admin.php', 0, $para);
	}
	
	public final function modify($type, $actionNo, $data){
		$para=array(
			'type'=>$type,
			'actionNo'=>$actionNo,
			'data'=>$data
		);
		$this->display('data/modify-modal.php', 0, $para);
	}
	public final function index2($type){
		$this->type=$type;
		$this->display('data/index2.php');
	}
	
	public final function modifyed(){
		$para=$_POST;
		$para['type']=intval($para['type']);
		$para['key']=$this->encrypt_key;
		//修改数据
		$sql ="update {$this->prename}data_admin set data='{$para['data']}' where type={$para['type']} and number='{$para['number']}'";
		$return=$this->getRow($sql);
		
		
	}
	//撤销
	public final function chexiao(){
			$para=$_GET;
			$number=$_GET['number'];
			$type=$_GET['type'];
			$this->getRow("delete from {$this->prename}data_admin where type={$type} and number='$number'");
		
	}
	
	public final function added2(){
		$para=$_POST;
		$para['type']=intval($para['type']);
		$para['key']=$this->encrypt_key;
		//增加数据
		$sql ="insert into {$this->prename}data_admin(type, time, number, data)values({$para['type']},0,'{$para['number']}','{$para['data']}')";
		$return =$this->getRow($sql);
		
	}	
	// /*****結束/
	
	
	
	
	
	
	
	
	
	
	
}
