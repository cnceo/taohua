<?php
@session_start();
class lottery extends WebLoginBase{
	public $pageSize=10;
	private $vcodeSessionName='blast_vcode_session_name';
	/**
	 * 用户信息页面
	 */


	public final function combine_buy(){
		
		$this->getTypes();
		$this->getPlayeds();
//		$this->action='searchGameRecord';
		$this->display('lottery/combine_list.php');
	}
	
	//合买中心
    public final  function hemai(){
            $this->getTypes();
		$this->getPlayeds();
		$this->action='combine_buy';
		$this->display('lottery/hemai.php');
        }	
	//合买详情
    public final function comInfo($id){
            $this->getTypes();
		$this->getPlayeds();
		$this->display('lottery/com-info.php', 0 , intval($id));
        }	
	//合买记录
	public final function search(){
		
		$this->getTypes();
		$this->getPlayeds();
		$this->action='searchGameRecord';
		$this->display('lottery/search.php');
	}      
        
	public final function searchGameRecord(){
		$this->getTypes();
		$this->getPlayeds();
		$this->display('lottery/search-list.php');
	}
	
	
	
	
	
}