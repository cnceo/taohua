<?php

class Event extends WebLoginBase{

	/**
	 * 列表页
	 */
	public final function index(){
        //@todo events list
		$this->display('event/huodong.php',0,null);
	}

	/**
	 * sign
	 */
	public final function sign(){
        //@todo sign
        $data = array();
        $data['id'] = intval($_POST['id']);
        $data['uid'] = intval($_POST['uid']);
        $data['rate_value'] =  intval($_POST['type']);
        $today = date('Y-m-d',$this->time);
        $start = strtotime($today);
        $end = $start+3600*12*2;
        $ret = $this->getRow("select * from {$this->prename}event_sign where `uid`={$data['uid']} and `goodId`={$data['id']} and `state` IN(0,1) and `isdelete`=0 and `c_time` between {$start} and {$end}");
        if($ret)
            return array('status'=>'50001','info'=>'您已参加活动'.($ret['rate_value']+1).',请刷新页面','data'=>null);
        else{
            $sql ="insert into {$this->prename}event_sign set `uid`={$data['uid']},`goodId`={$data['id']},`rate_value`={$data['rate_value']}, `state`=0,`isdelete`=0,`c_time`={$this->time}";
            if($this->insert($sql))
                return array('status'=>'10000','info'=>'您已成功参加活动'.($data['rate_value']+1));
            else
                return array('status'=>'50001','info'=>'操作失败','data'=>null);
        }
	}

	/**
	 * 兑换
	 */
	public final function swap(){
        $id = intval($_POST['id']);
        $uid = intval($_POST['uid']);
        $rate_value =  intval($_POST['type']);
        $today = date('Y-m-d',$this->time);
        $start = strtotime($today);
        $end = $start+3600*12*2;
        $ret = $this->getRow("select * from {$this->prename}event_sign where `uid`={$uid} and `goodId`={$id} and `isdelete`=0 and `c_time` between {$start} and {$end}");
        if($ret['state'] !='0') return array('status'=>'50000','info'=>'领取失败，重复领取或已失效','data'=>null);
        if($ret['rate_value'] !=$rate_value) return array('status'=>'50001','info'=>'领取失败，您参加的是活动'.($ret['rate_value']+1),'data'=>null);
        $good = $this->getRow("select * from {$this->prename}events where `id`={$ret['goodId']} and  `enable`=1 and `state`=0");
        if(!$good) return array('status'=>'50001','info'=>'领取失败，活动已关闭','data'=>null);

        $condition = explode("|",$good['condition']);
        $rate = explode("|", $good['rate']);

        if($rate_value> count($condition)) return array('status'=>'50002','info'=>'非法操作','data'=>null);
        //获取用户当日首冲金额
        $recharge = $this->getRow("select * from {$this->prename}coin_log where `uid`={$uid} and `liqType`=1 and `actionTime` between {$start} and {$end} order by actionTime asc");
        if(!$recharge || $recharge['coin']<$good['coin']) return array('status'=>'50003','info'=>'领取失败,未满足每日首冲条件','data'=>null);

        //获取用户当日下注金额[未开奖不计算在内]
        $inCoin = $this->getRows("select * from {$this->prename}coin_log where `uid`={$uid} and `liqType`=101 and `actionTime` between {$start} and {$end} order by actionTime asc");
        if(!$inCoin) return array('status'=>'50001','info'=>'领取失败,未满足流水条件','data'=>null);
        $coin =0;
        foreach($inCoin as $vals){
            //统计下注金额[不含未开奖]
            $order = array();
            $order = $this->getRow("select * from {$this->prename}bets where id={$vals['extfield0']}");
            if(!$order || !$order['lotteryNo'])
                continue;
            $coin += $vals['coin'];
        }
        //获取用户当日撤单金额
		
        $reCoin = $this->getRows("select * from {$this->prename}coin_log where `uid`={$uid} and `liqType`=7 and `actionTime` between {$start} and {$end} order by actionTime asc");
        $_coin =0;
        if($reCoin){
            foreach($reCoin as $val)
            {
                $_coin += $val['coin'];
            }
        }
        //最终流水金额
        $coin = abs($coin) - abs($_coin);
		
        //领取记录
        //@TODO SS领取条件判断
        if($coin >0 && abs($coin) > $recharge['coin'] * $condition[$rate_value]){
            $reCoin = ($recharge['coin']*$rate[$rate_value])/100;

            //@todo SS封顶max_coin
            if($reCoin> $good['max_rebate'])
                $reCoin = ($reCoin> $good['max_rebate']) ? $good['max_rebate'] : $reCoin;
            $this->beginTransaction();
            try{
				
                $m=$this->update("update {$this->prename}event_sign set `state`=1,`g_time`={$this->time} where `id`={$ret['id']}");
				
				// 添加用户资金流动日志
                $this->addCoin(array(
                    'uid'=>$this->user['uid'],
                    'type'=>0,
                    'liqType'=>54,
                    'info'=>'活动奖金',
                    'extfield0'=>$this->lastInsertId(),
                    'extfield1'=>'',
                    'coin'=>$reCoin,
                ));
                $this->commit();
                return array('status'=>'10000','info'=>'领取成功','data'=>$reCoin);
            }catch (Exception $e){
                $this->rollBack();
            }
        } else {
            return array('status'=>'50001','info'=>'领取失败,不满足领取流水条件','data'=>$coin);
        }
    }

}