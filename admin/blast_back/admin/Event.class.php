<?php
class  Event extends AdminBase{
	public $pageSize=15;
	

    public final function index()
    {
        $this->display('event/index.php',0,null);

    }

	public final function eventModal($id){

		$this->display('event/modal.php',0,$id);
	}

	public final function updateEvent(){

        $params = $_POST;
        $sql ='';
        $tplMain = <<<TPL
            每日首次充值 %s 元以上可在平台页面上点击
                    参与活动自由选择参与（最高可以领取 %s ）<br/>
                    %s

TPL;
        $tplTip = <<<TIP
        %s：%s 倍流水可领取首次充值金额 %s ％的活动礼金;<br/>
TIP;
        if($params['rate_type']=='1' && $params['condition'])
        {
            $condition = explode('|', $params['condition']);
            $rate = explode('|', $params['rate']);
            if(count($condition) == count($rate))
            {
                $t = '';
                for($i=0;$i<count($condition);$i++){
                    $t .= sprintf($tplTip, $i+1, $condition[$i],$rate[$i]);
                }
                $content = sprintf($tplMain, $params['coin'], $params['max_rebate'], $t);
            } else {
                throw new Exception('参数出错');
            }
            $params['content'] = $content;
        }

        if($params['start_time']){
            $params['start_time']=strtotime($params['start_time']);
        }else{
            $params['start_time']=$this->time;
        }
        if($params['end_time']){
            $params['end_time']=strtotime($params['end_time']);
        }else{
            $params['end_time']=0;
        }
        if($params['end_time'] < $params['start_time'])
            $params['end_time']=0;

        $params['c_time'] =$this->time;
        $sql="insert into {$this->prename}events set";
        foreach($params as $field=>$var){
            $sql.=" `$field`='$var',";
        }
        $sql=rtrim($sql,',');
        $sql.=" on duplicate key update `title`='{$params['title']}', `tips`='{$params['tips']}', `content`='{$params['content']}', `coin`='{$params['coin']}', `condition`='{$params['condition']}', `rate`='{$params['rate']}', `rebate`='{$params['rebate']}', `rate_type`='{$params['rate_type']}', `max_rebate`='{$params['max_rebate']}',  `start_time`='{$params['start_time']}', `end_time`='{$params['end_time']}', `c_time`='{$params['c_time']}', `enable`='{$params['enable']}'";
	    if($this->insert($sql, $params)){
            $this->addLog(16, $this->adminLogType[16]."[修改ID：{$params['id']}]" , $params['id'], $params['title']);
			$fun='success';
			$msg='操作成功';
			//echo $msg;
		}else{
			$fun='error';
			$msg='未知错误';
//			echo $msg;
		}
        echo '<script type="text/javascript">top.eventUpdateCompile("', $fun, '", ', json_encode($msg), ')</script>';
	}
	
	public final function eventOnoff($id,$state){
		if(!$id=intval($id)) throw new Exception('参数出错');
		if($state){
			$state=0;
		}else{
			$state=1;
		}
		$sql="update {$this->prename}events set enable=$state where id=$id";
		if($this->update($sql)){
			$this->addLog(16,$this->adminLogType[16].'[开关ID:'.$id.']',$id,$this->getValue("select title from {$this->prename}score_events where id=?",$id));
			return '操作成功！';
		}else{
			throw new Exception('未知错误');
		}
	}
	public final function deleteEvent($id){
		if(!$id=intval($id)) throw new Exception('参数出错');
		$sql="update {$this->prename}events set isdelete=1 where id=$id";
        //echo $sql;
		if($this->update($sql)){
			$this->addLog(16,$this->adminLogType[16].'[删除ID:'.$id.']',$id,$this->getValue("select title from {$this->prename}events where id=?",$id));
			return '操作成功！';
		}else{
			throw new Exception('未知错误');
		}
	}


    public final function signList(){
        $this->display('event/sign-list.php');
    }

    public final function signDel($id)
    {
        if(!$id=intval($id)) throw new Exception('参数出错');
        $sql="update {$this->prename}event_sign set `isdelete`=1 where id={$id}";
        if($this->update($sql, $id)){
            $userData=$this->getRow("select u.uid uid,u.username username from {$this->prename}members u,{$this->prename}event_sign s where s.uid=u.uid and s.id=?",$id);
            $this->addLog(15,$this->adminLogType[15].'[删除ID:'.$id.']',$userData['uid'],$userData['username']);
            return '订单已经删除';
        }else{
            throw new Exception('未知出错');
        }
    }
	
}