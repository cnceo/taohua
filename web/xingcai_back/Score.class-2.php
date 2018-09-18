<?php
@session_start();
class Score extends WebLoginBase
{
    private $vcodeSessionName = "blast_vcode_session_name";
    public $scoretype = "current";
    public $limittype = "all";
    public $pageSize = 3;
    public $payout = 0.85;
    public final function zadan()
    {
        $this->display('score/zadan.php');
    }
    public final function qiandao()
    {
        $this->display('score/qiandao.php');
    }
    public final function chongzhi()
    {
        $this->display('score/chongzhi.php');
    }
    public final function yongjin()
    {
        $this->dataa  = $this->getRows($var_2);
        $this->dataaa = $this->getRows($var_2);
        $this->display('score/yongjin.php');
    }
    public final function getyj()
    {
        $var_4 = $this->user['uid'];
        $var_6 = $this->getRows($var_5);
        if ($var_6[0]['todayget'] == 1) {
            echo 'o';
            exit;
        }
        $var_7 = $this->getRows($var_5);
        if ($var_7[0]['type'] == 0) {
            echo 'g';
            exit;
        } else {
            $var_8 = (int) date('H');
            if ((int) $var_7[0]['startime'] <= $var_8) {
                if ($var_8 <= (int) $var_7[0]['endtime']) {
                    if (!$this->noeasy()) {
                        echo 'n';
                    } else {
                        $var_9 = $this->noeasy();
                        $this->exec($var_5);
                        $var_10 = $this->getRows($var_5);
                        $var_11 = $var_10[0]['coin'];
                        $var_12 = time();
                        $this->exec($var_5);
                        $var_13 = $this->user['username'];
                        $this->exec($var_5);
                        echo 'y';
                    }
                    exit;
                } else {
                    echo 'w';
                }
            } else {
                echo 'w';
            }
        }
        exit;
    }
    public final function noeasy()
    {
        $var_15 = $this->user['uid'];
        $var_17 = $this->getRows($var_16);
        $var_18 = 0;
        for ($var_20 = 0; $var_20 < count($var_17); $var_20++) {
            $var_21 = explode(',', $var_17[$var_20]['parents']);
            if (count($var_21) > 5) {
                for ($var_22 = 0; $var_22 < 5; $var_22++) {
                    if ($var_21[count($var_21) - $var_22 - 1] == $var_15) {
                        $var_23[$var_18]['uid'] = $var_17[$var_20]['uid'];
                        $var_23[$var_18]['lv']  = $var_22;
                        $var_18++;
                        $var_19 .= $var_17[$var_20]['uid'] . ',';
                        break;
                    }
                }
            } else {
                for ($var_22 = 0; $var_22 < count($var_21); $var_22++) {
                    if ($var_21[count($var_21) - $var_22 - 1] == $var_15) {
                        $var_23[$var_18]['uid'] = $var_17[$var_20]['uid'];
                        $var_23[$var_18]['lv']  = $var_22;
                        $var_19 .= $var_17[$var_20]['uid'] . ',';
                        $var_18++;
                        break;
                    }
                }
            }
        }
        $var_19 .= ')';
        $var_24 = date('Y-m-d H') . ':00:00';
        $var_25 = $this->getRows($var_16);
        for ($var_20 = 0; $var_20 < count($var_25); $var_20++) {
            for ($var_22 = 0; $var_22 < count($var_23); $var_22++) {
                if ($var_25[$var_20]['uid'] == $var_23[$var_22]['uid']) {
                    $var_25[$var_20]['lv'] = $var_23[$var_22]['lv'];
                }
            }
        }
        $var_26 = $this->getRows($var_16);
        for ($var_20 = 0; $var_20 < count($var_26); $var_20++) {
            if ($var_26[$var_20]['type'] == 1) {
            }
        }
        for ($var_20 = 0; $var_20 < count($var_25); $var_20++) {
            for ($var_22 = 0; $var_22 < count($var_27); $var_22++) {
                if ($var_25[$var_20]['allmoney'] >= $var_27[$var_22]['endtime']) {
                    if ($var_25[$var_20]['lv'] == 1) {
                        $var_25[$var_20]['getmoney'] = $var_27[$var_22]['lvone'];
                    } else if ($var_25[$var_20]['lv'] == 2) {
                        $var_25[$var_20]['getmoney'] = $var_27[$var_22]['lvtwo'];
                    } else if ($var_25[$var_20]['lv'] == 3) {
                        $var_25[$var_20]['getmoney'] = $var_27[$var_22]['lvtress'];
                    } else if ($var_25[$var_20]['lv'] == 4) {
                        $var_25[$var_20]['getmoney'] = $var_27[$var_22]['lvfour'];
                    }
                    break;
                } else {
                    $var_25[$var_20]['getmoney'] = 0;
                }
            }
        }
        $var_28 = 0;
        for ($var_20 = 0; $var_20 < count($var_25); $var_20++) {
            $var_28 += $var_25[$var_20]['getmoney'];
        }
        return $var_28;
    }
    public final function chuangguan()
    {
        $this->dataa = $this->getRows($var_30);
        $this->display('score/chuangguan.php');
    }
    public final function fanxianvip()
    {
        $var_32 = $this->user['uid'];
        $var_33 = $this->user['username'];
        $var_35 = $this->getRows($var_34);
        if ($var_35[0]['vipjjtoday'] == 1) {
            echo 'o';
            exit;
        }
        $var_36 = date('Y-m-d H') . ':00:00';
        $var_37 = $this->getRow($var_34);
        $var_38 = $var_37['allmoney'];
        $var_39 = $this->getRows($var_34);
        for ($var_40 = 0; $var_40 < count($var_39); $var_40++) {
            if ($var_41['money'] <= $var_38) {
                if ($this->user['grade'] == 1) {
                    if ($var_41['yi'] > $var_42)
                        $var_42 = $var_41['yi'];
                } else if ($this->user['grade'] == 2) {
                    if ($var_41['er'] > $var_42)
                        $var_42 = $var_41['er'];
                } else if ($this->user['grade'] == 3) {
                    if ($var_43['san'] > $var_42)
                        $var_42 = $var_41['san'];
                } else if ($this->user['grade'] == 4) {
                    if ($var_41['si'] > $var_42)
                        $var_42 = $var_41['si'];
                } else if ($this->user['grade'] == 5) {
                    if ($var_41['wu'] > $var_42)
                        $var_42 = $var_41['wu'];
                } else if ($this->user['grade'] == 6) {
                    if ($var_41['liu'] > $var_42)
                        $var_42 = $var_41['liu'];
                } else if ($this->user['grade'] == 7) {
                    if ($var_41['qi'] > $var_42)
                        $var_42 = $var_41['qi'];
                } else if ($this->user['grade'] == 8) {
                    if ($var_41['ba'] > $var_42)
                        $var_42 = $var_41['ba'];
                } else if ($this->user['grade'] >= 9) {
                    if ($var_41['jiu'] > $var_42)
                        $var_42 = $var_41['jiu'];
                }
            }
        }
        if (!$var_42) {
            echo 'n';
            exit;
        }
        $this->exec($var_34);
        $var_44 = $this->getRows($var_34);
        $var_45 = $var_44[0]['coin'];
        $var_46 = time();
        $this->exec($var_34);
        $this->exec($var_34);
        echo 'y';
        exit;
    }
    public final function goods($v_1 = null, $v_2 = null)
    {
        if ($v_1)
            $this->scoretype = $v_1;
        if ($v_2)
            $this->limittype = $v_2;
        $var_48 = "select * from {$this->prename}score_goods where enable=1 and startTime<={$this->time} and ";
        switch ($this->scoretype) {
            case current:
                switch ($this->limittype) {
                    case 'all':
                        $var_48 .= "(stopTime>{$this->time} or stopTime=0)";
                        break;
                    case time:
                        $var_48 .= "stopTime>{$this->time} and sum=0";
                        break;
                    case 'number':
                        $var_48 .= 'sum>0 and surplus>0 and stopTime=0';
                        break;
                    case 'both':
                        $var_48 .= "stopTime>{$this->time} and sum>0";
                        break;
                    case 'none':
                        $var_48 .= 'stopTime=0 and sum=0';
                        break;
                    default:
                        throw new Exception('参数出错');
                }
                break;
            case 'old':
                switch ($this->limittype) {
                    case 'all':
                        $var_48 .= "((stopTime<{$this->time} and stopTime<>0) or (sum>0 and surplus=0))";
                        break;
                    case time:
                        $var_48 .= "stopTime<{$this->time} and sum=0";
                        break;
                    case 'number':
                        $var_48 .= 'sum>0 and surplus=0';
                        break;
                    case 'both':
                        $var_48 .= "stopTime>0 and (stopTime<{$this->time} or (sum>0 and surplus=0))";
                        break;
                    default:
                        throw new Exception('参数出错');
                }
                break;
            case 'me':
                $var_48 = "select s.id swapId, s.state, g.* from {$this->prename}score_swap s, {$this->prename}score_goods g where s.goodId=g.id and s.uid={$this->user['uid']} and ";
                switch ($this->limittype) {
                    case current:
                        $var_48 .= 'state between 1 and 2';
                        break;
                    case 'history':
                        $var_48 .= 'state=0';
                        break;
                    default:
                        throw new Exception('参数出错');
                }
                break;
            default:
                throw new Exception('参数出错');
                break;
        }
        $var_48 .= ' order by price desc';
        $var_49 = $this->getPage($var_48, $this->page, $this->pageSize);
        $this->display('score/list.php', 0, $var_49);
    }
    public final function swap($v_3)
    {
        $v_3    = intval($v_3);
        $var_51 = $this->getRow("select * from {$this->prename}score_goods where id=?", $v_3);
        $this->display('score/swap.php', 0, $var_51);
    }
    public final function scoreinfo()
    {
        $this->display('score/reloadscore.php');
    }
    public final function swapGood()
    {
        if (!$_POST)
            throw new Exception('请求出错');
        $var_53['goodId']  = intval($_POST['goodId']);
        $var_53['number']  = $_POST['number'];
        $var_53['coinpwd'] = $_POST['coinpwd'];
        if (!$var_53['goodId'])
            throw new Exception('请求出错');
        if (!ctype_digit($var_53['number']))
            throw new Exception('兑换数量必须为整数');
        if ($var_53['number'] <= 0)
            throw new Exception('兑换数量需大于等于1');
        $this->beginTransaction();
        try {
            $var_54 = "select * from {$this->prename}score_goods where id=?";
            if (!$var_55 = $this->getRow($var_54, $var_53['goodId']))
                throw new Exception('兑换商品不存在');
            if ($var_55['stopTime'] > 0 && $var_55['stopTime'] < $this->time)
                throw new Exception('这活动已经过期了');
            if ($var_55['sum'] > 0 && $var_55['surplus'] == $var_55['sum'])
                throw new Exception('这礼品已经兑换完了');
            $var_55['score'] = $var_55['score'] * $var_53['number'];
            $this->freshSession();
            if ($var_55['score'] > $this->user['score'])
                throw new Exception('你拥有积分不足，不能兑换这礼品');
            if (!$this->user['coinPassword'])
                throw new Exception('你尚未设置资金密码!');
            if (md5($var_53['coinpwd']) != $this->user['coinPassword'])
                throw new Exception('资金密码不正确');
            unset($var_53['coinpwd']);
            $var_53['swapTime'] = $this->time;
            $var_53['swapIp']   = $this->ip(!0);
            $var_53['uid']      = $this->user['uid'];
            $var_53['score']    = $var_55['score'];
            if ($var_55['price'] > 0) {
                $var_53['state'] = 0;
            }
            if (!$this->insertRow($this->prename . 'score_swap', $var_53))
                throw new Exception('兑换礼品出错');
            $var_54 = "update {$this->prename}members set score=score-{$var_55['score']} where uid=?";
            if (!$this->update($var_54, $this->user['uid']))
                throw new Exception('兑换礼品出错');
            if ($var_55['sum'] > 0) {
                $var_54 = "update {$this->prename}score_goods set surplus=surplus+1,persons=persons+1 where id=?";
                if (!$this->update($var_54, $var_55['id']))
                    throw new Exception('兑换礼品出错');
            }
            if ($var_55['price'] > 0) {
                $var_56 = $var_55['price'] * $var_53['number'];
                $this->addCoin(array(
                    'uid' => $this->user['uid'],
                    'coin' => $var_56,
                    'liqType' => 57,
                    'extfield0' => 0,
                    'extfield1' => 0,
                    'info' => '积分兑换'
                ));
            }
            $this->commit();
            return '兑换礼品成功';
        }
        catch (Exception $var_57) {
            $this->rollBack();
            throw $var_57;
        }
    }
    public final function setSwapState($v_4)
    {
        if (!$v_4 = $var_58[74]($v_4))
            throw new Exception($var_58[77]);
        if (!$var_59 = $this->getRow("select * from {$this->prename}score_swap where id=$v_4"))
            throw new Exception($var_58[77]);
        if ($var_59[$var_58[68]] != $this->user[$var_58[68]])
            throw new Exception($var_58[109]);
        if ($var_59[$var_58[98]] == 0)
            throw new Exception($var_58[110]);
        if ($var_59[$var_58[98]] == 3)
            throw new Exception($var_58[111]);
        if ($var_59[$var_58[98]] == 1) {
            $var_60 = $var_58[112]($var_59[$var_58[89]] * $this->payout);
            $var_61 = "update {$this->prename}members u, {$this->prename}score_swap s set u.score=u.score+$var_60, s.state=3 where u.uid=s.uid and s.id=$v_4";
        } elseif ($var_59[$var_58[98]] == 2) {
            $var_61 = "update {$this->prename}score_swap set state=0 where id=$v_4";
        } else {
            throw new Exception($var_58[77]);
        }
        if ($this->update($var_61)) {
            return $var_58[113];
        } else {
            throw new Exception($var_58[77]);
        }
    }
    public function formatGoodTime($v_5, $v_6)
    {
        if ($this->time < $v_5)
            return '等待中';
        if ($v_6 && $v_6 < $this->time)
            return '已结束';
        if (!$v_6)
            return '';
        $var_63 = $v_6 - $this->time;
        if ($var_63 > 24 * 3600) {
            $var_64 = floor($var_63 / (24 * 3600)) . '天';
            $var_63 %= 24 * 3600;
        }
        if ($var_63 > 3600) {
            $var_64 .= floor($var_63 / 3600) . '时';
            $var_63 %= 3600;
        }
        $var_64 .= floor($var_63 / 60) . '分';
        return $this->CsubStr($var_64, 0, 6, '');
    }
    public final function rotate()
    {
        $this->display('score/rotate.php');
    }
    public final function rotateEvent()
    {
        $this->getdzpSettings;
        $var_66 = $this->dzpsettings['score'];
        $var_67 = array();
        $var_68 = array();
        if ($this->user['score'] < $var_66) {
            $var_69['angle'] = 0;
            return $var_69;
        }
        if (!$this->dzpsettings['switchWeb']) {
            $var_69['angle'] = 0;
            return $var_69;
        }
        $var_70 = array(
            '0' => array(
                'id' => 1,
                min => 289,
                max => 323,
                'prize' => $this->dzpsettings['goods289323'],
                'v' => $this->dzpsettings['chance289323'],
                'j' => $this->dzpsettings['coin289323'],
                'w' => $this->dzpsettings['shiwu289323']
            ),
            '1' => array(
                'id' => 2,
                min => 181,
                max => 215,
                'prize' => $this->dzpsettings['goods181215'],
                'v' => $this->dzpsettings['chance181215'],
                'j' => $this->dzpsettings['coin181215'],
                'w' => $this->dzpsettings['shiwu181215']
            ),
            '2' => array(
                'id' => 3,
                min => 37,
                max => 71,
                'prize' => $this->dzpsettings['goods3771'],
                'v' => $this->dzpsettings['chance3771'],
                'j' => $this->dzpsettings['coin3771'],
                'w' => $this->dzpsettings['shiwu3771']
            ),
            '3' => array(
                'id' => 4,
                min => 73,
                max => 107,
                'prize' => $this->dzpsettings['goods73107'],
                'v' => $this->dzpsettings['chance73107'],
                'j' => $this->dzpsettings['coin73107'],
                'w' => $this->dzpsettings['shiwu73107']
            ),
            '4' => array(
                'id' => 5,
                min => 253,
                max => 287,
                'prize' => $this->dzpsettings['goods253287'],
                'v' => $this->dzpsettings['chance253287'],
                'j' => $this->dzpsettings['coin253287'],
                'w' => $this->dzpsettings['shiwu253287']
            ),
            '5' => array(
                'id' => 6,
                min => 0,
                max => 35,
                'prize' => $this->dzpsettings['goods035'],
                'v' => $this->dzpsettings['chance035'],
                'j' => $this->dzpsettings['coin035'],
                'w' => $this->dzpsettings['shiwu035']
            ),
            '6' => array(
                'id' => 7,
                min => 145,
                max => 179,
                'prize' => $this->dzpsettings['goods145179'],
                'v' => $this->dzpsettings['chance145179'],
                'j' => $this->dzpsettings['coin145179'],
                'w' => $this->dzpsettings['shiwu145179']
            ),
            '7' => array(
                'id' => 8,
                min => 109,
                max => 143,
                'prize' => $this->dzpsettings['goods109143'],
                'v' => $this->dzpsettings['chance109143'],
                'j' => $this->dzpsettings['coin109143'],
                'w' => $this->dzpsettings['shiwu109143']
            ),
            '8' => array(
                'id' => 9,
                min => 217,
                max => 251,
                'prize' => $this->dzpsettings['goods217251'],
                'v' => $this->dzpsettings['chance217251'],
                'j' => $this->dzpsettings['coin217251'],
                'w' => $this->dzpsettings['shiwu217251']
            ),
            '9' => array(
                'id' => 10,
                min => 325,
                max => 359,
                'prize' => $this->dzpsettings['goods325359'],
                'v' => $this->dzpsettings['chance325359'],
                'j' => $this->dzpsettings['coin325359'],
                'w' => $this->dzpsettings['shiwu325359']
            )
        );
        foreach ($var_70 as $var_71 => $var_72) {
            $var_73[$var_72['id']] = $var_72['v'];
            if ($var_72['j'] > 0) {
                array_push($var_67, $var_72['id']);
            }
            if ($var_72['w'] > 0) {
                array_push($var_68, $var_72['id']);
            }
        }
        $var_74          = $this->getRand($var_73);
        $var_76          = $var_75[min];
        $var_77          = $var_75[max];
        $var_69['angle'] = mt_rand($var_76, $var_77);
        $this->beginTransaction();
        try {
            $var_78 = "update {$this->prename}members set score=score-{$var_66} where uid=?";
            if (!$this->update($var_78, $this->user['uid'])) {
                $var_69['angle'] = 0;
                return $var_69;
            }
            if (in_array($var_74, $var_67)) {
                $this->addCoin(array(
                    'uid' => $this->user['uid'],
                    'coin' => $var_75['j'],
                    'liqType' => 120,
                    'extfield0' => 0,
                    'extfield1' => 0,
                    'info' => '大转盘奖金'
                ));
                $var_79 = array(
                    'uid' => $this->user['uid'],
                    'info' => $var_75['prize'],
                    'state' => 0,
                    'swapTime' => $this->time,
                    'swapIp' => $this->ip(!0),
                    'coin' => $var_75['j'],
                    'score' => $this->user['score'] - $var_66,
                    'xscore' => $var_66,
                    'enable' => 1
                );
                if (!$this->insertRow($this->prename . 'dzp_swap', $var_79)) {
                    $var_69['angle'] = 0;
                    return $var_69;
                }
            } else if ($var_74 == 8) {
                $var_78 = "update {$this->prename}members set score=score+{$var_66} where uid=?";
                if (!$this->update($var_78, $this->user['uid'])) {
                    $var_69['angle'] = 0;
                    return $var_69;
                }
            } else if (in_array($var_74, $var_68)) {
                $var_79 = array(
                    'uid' => $this->user['uid'],
                    'info' => $var_75['prize'],
                    'state' => 1,
                    'swapTime' => $this->time,
                    'swapIp' => $this->ip(!0),
                    'coin' => $var_75['j'],
                    'score' => $this->user['score'] - $var_66,
                    'xscore' => $var_66,
                    'enable' => 1
                );
                if (!$this->insertRow($this->prename . 'dzp_swap', $var_79)) {
                    $var_69['angle'] = 0;
                    return $var_69;
                }
            }
            $this->commit();
            return $var_69;
        }
        catch (Exception $var_80) {
            $this->rollBack();
            throw $var_80;
        }
    }
    public final function dodbqb()
    {
        $this->display('score/dodbqb.php');
    }
    public final function dbqbed()
    {
        $var_82 = strtotime(date('Y-m-d 00:00:00', $this->time));
        $var_83 = strtotime(date('Y-m-d ', $this->time) . $this->dbqbsettings['FromTime'] . ':00');
        $var_84 = strtotime(date('Y-m-d ', $this->time) . $this->dbqbsettings['ToTime'] . ':00');
        if (!$this->dbqbsettings['switchWeb'])
            throw new Exception('幸运砸蛋活动已下线，敬请期待!');
        if ($this->time < $var_83 || $this->time > $var_84)
            throw new Exception('不在活动时间段内，无法参加!');
        if ($this->user['coin'] < $this->dbqbsettings['scoin'])
            throw new Exception('账户余额小于' . $this->dbqbsettings['scoin'] . '元，无法参加!');
        $var_85 = number_format($this->getValue("select sum(beiShu * mode * actionNum) from {$this->prename}bets where actionTime > ? and uid={$this->user['uid']} and isDelete=0", $var_82), 2);
        if ($var_85 < floatval($this->dbqbsettings['xcoin']))
            throw new Exception('今日消费不满' . $this->dbqbsettings['xcoin'] . '元，无法参加!');
        if ($this->dbqbsettings['num'] <= 0)
            throw new Exception('很遗憾！金蛋已被砸光，请等待下一场！');
        $var_86 = "update {$this->prename}dbqbparams SET value=value-1 where name='num'";
        $var_87 = "select state from {$this->prename}dbqb_swap where uid={$this->user['uid']} and  swapTime>{$var_82}";
        $var_88 = "select swapIp from {$this->prename}dbqb_swap where uid={$this->user['uid']} and  swapTime>{$var_82}";
        if ($this->getValue($var_87))
            throw new Exception('很遗憾！您今日已参加过活动，请等待下一场！');
        if ($this->ip(!0) == $this->getValue($var_88))
            throw new Exception('很遗憾！每个IP，每天只允许一个帐户参加活动！');
        $var_89 = explode('*', $this->dbqbsettings['value']);
        $var_90 = count($var_89);
        $var_91 = $var_89[mt_rand(0, $var_90)];
        $this->beginTransaction();
        try {
            $this->addCoin(array(
                'uid' => $this->user['uid'],
                'coin' => $var_91,
                'liqType' => 130,
                'extfield0' => 0,
                'extfield1' => 0,
                'info' => '幸运砸蛋奖金'
            ));
            $var_92 = array(
                'uid' => $this->user['uid'],
                'info' => $var_91 . '元奖金',
                'swapTime' => $this->time,
                'state' => 1,
                'swapIp' => $this->ip(!0),
                'coin' => $var_91,
                'enable' => 1
            );
            $this->query($var_86);
            $this->insertRow($this->prename . 'dbqb_swap', $var_92);
            $this->commit();
            return '恭喜你，砸到一个' . $var_91 . '元的金蛋';
        }
        catch (Exception $var_93) {
            $this->rollBack();
            throw $var_93;
        }
    }
    public final function dodzyh()
    {
        $this->display('score/dodzyh.php');
    }
    public final function dzyhck()
    {
        $this->display('score/dzyhck.php');
    }
    public final function dzyhtk()
    {
        $var_95  = $this->dzyhsettings['ckdate1'] * 24;
        $var_96  = $this->dzyhsettings['cklv1'];
        $var_97  = $this->dzyhsettings['ckdate2'] * 24;
        $var_98  = $this->dzyhsettings['cklv2'];
        $var_99  = $this->dzyhsettings['ckdate3'] * 24;
        $var_100 = $this->dzyhsettings['cklv3'];
        $var_101 = $this->dzyhsettings['ckdate4'] * 24 * 30;
        $var_102 = $this->dzyhsettings['cklv4'];
        $var_103 = $this->dzyhsettings['ckdate5'] * 24 * 30 * 12;
        $var_104 = $this->dzyhsettings['cklv5'];
        $var_105 = array(
            $var_95,
            $var_97,
            $var_99,
            $var_101,
            $var_103
        );
        sort($var_105);
        $var_106 = array(
            $var_96,
            $var_98,
            $var_100,
            $var_102,
            $var_104
        );
        sort($var_106);
        $var_107 = "select ck_money,time,username from {$this->prename}dzyh_ck_swap where uid={$this->user['uid']} and isdelete=0 and state=0";
        if ($var_108 = $this->getRow($var_107)) {
            $var_109 = ($this->time - $var_108[time]) / 3600;
        } else {
            $var_109             = 0;
            $var_108['ck_money'] = 0;
        }
        if ($var_109 < $this->dzyhsettings['ckzdsj']) {
            $var_111 = 0;
        } else if ($var_109 > $this->dzyhsettings['ckzdsj'] && $var_109 >= $var_105[0] && $var_109 < $var_105[1]) {
            $var_111 = $var_108['ck_money'] * $var_106[0] / 100 * $var_105[0] / 24;
        } else if ($var_109 >= $var_105[1] && $var_109 < $var_105[2]) {
            $var_111 = $var_108['ck_money'] * $var_106[1] / 100 * $var_105[1] / 24;
        } else if ($var_109 >= $var_105[2] && $var_109 < $var_105[3]) {
            $var_111 = $var_108['ck_money'] * $var_106[2] / 100 * $var_105[2] / 24;
        } else if ($var_109 >= $var_105[3] && $var_109 < $var_105[4]) {
            $var_111 = $var_108['ck_money'] * $var_106[3] / 100 * $var_105[3] / 24;
        } else if ($var_109 >= $var_105[4]) {
            $var_111 = $var_108['ck_money'] * $var_106[4] / 100 * $var_105[4] / 24;
        }
        $var_108['lx'] = $var_111;
        $this->display('score/dzyhtk.php', 0, $var_108);
    }
    public final function dzyhcked()
    {
        $var_113 = floatval($_POST['ckmoney']);
        if ($var_113 <= 0)
            throw new Exception('输入的存款金额错误，请重新输入！');
        if (md5($_POST['coinpassword']) != $this->user['coinPassword'])
            throw new Exception('资金密码错误,请核对后再操作!');
        if (strtolower($_POST['vcode']) != $_SESSION[$this->vcodeSessionName])
            throw new Exception('验证码不正确。');
        unset($_SESSION[$this->vcodeSessionName]);
        if (!$this->dzyhsettings['switchck'])
            throw new Exception('投资理财存款功能已关闭,详情请联系在线客服！');
        if ($this->getValue("select count(id) from {$this->prename}dzyh_ck_swap where uid={$this->user['uid']} and isdelete=0 and state=0;") >= 1)
            throw new Exception('对不起！每个用户只能存一笔，您已经有一笔存款,请先取出！');
        if ($this->user['coin'] == 0)
            throw new Exception('用户余额为零，请先充值！');
        if ($var_113 > $this->user['coin'])
            throw new Exception('很遗憾！存款金额大于当前账户余额，无法存款，请先充值！');
        $var_114 = array(
            'uid' => $this->user['uid'],
            'username' => $this->user['username'],
            'ck_money' => $var_113,
            time => $this->time,
            'ip' => $this->ip(!0),
            'enable' => 0,
            'state' => 0,
            'isdelete' => 0
        );
        if (!$this->insertRow($this->prename . 'dzyh_ck_swap', $var_114))
            throw new Exception('存款失败！请重试');
        $this->addCoin(array(
            'uid' => $this->user['uid'],
            'coin' => -$var_113,
            'liqType' => 140,
            'extfield0' => 0,
            'extfield1' => 0,
            'info' => '存入投资理财'
        ));
        return '存款成功!';
    }
    public final function dzyhtked()
    {
        if (md5($_POST['coinpassword']) != $this->user['coinPassword'])
            throw new Exception('资金密码错误,请核对后再操作!');
        if (strtolower($_POST['vcode']) != $_SESSION[$this->vcodeSessionName])
            throw new Exception('验证码不正确。');
        unset($_SESSION[$this->vcodeSessionName]);
        if (!$this->dzyhsettings['switchtk'])
            throw new Exception('投资理财提款功能已关闭,详情请联系在线客服！');
        if (!$this->getValue("select count(id) from {$this->prename}dzyh_ck_swap where uid={$this->user['uid']} and isdelete=0 and state=0;"))
            throw new Exception('对不起！您没有存款！');
        if ($this->getValue("select enable from {$this->prename}dzyh_ck_swap where uid={$this->user['uid']} and isdelete=0 and state=0;"))
            throw new Exception('对不起！您的存款已被冻结,详情请联系在线客服！');
        $var_116 = $this->dzyhsettings['ckdate1'] * 24;
        $var_117 = $this->dzyhsettings['cklv1'];
        $var_118 = $this->dzyhsettings['ckdate2'] * 24;
        $var_119 = $this->dzyhsettings['cklv2'];
        $var_120 = $this->dzyhsettings['ckdate3'] * 24;
        $var_121 = $this->dzyhsettings['cklv3'];
        $var_122 = $this->dzyhsettings['ckdate4'] * 24 * 30;
        $var_123 = $this->dzyhsettings['cklv4'];
        $var_124 = $this->dzyhsettings['ckdate5'] * 24 * 30 * 12;
        $var_125 = $this->dzyhsettings['cklv5'];
        $var_126 = array(
            $var_116,
            $var_118,
            $var_120,
            $var_122,
            $var_124
        );
        sort($var_126);
        $var_127 = array(
            $var_117,
            $var_119,
            $var_121,
            $var_123,
            $var_125
        );
        sort($var_127);
        $var_128 = "select ck_money,time,username from {$this->prename}dzyh_ck_swap where uid={$this->user['uid']} and isdelete=0 and state=0";
        if ($var_129 = $this->getRow($var_128)) {
            $var_130 = ($this->time - $var_129[time]) / 3600;
        } else {
            $var_130             = 0;
            $var_129['ck_money'] = 0;
        }
        if ($var_130 < $this->dzyhsettings['ckzdsj']) {
            $var_132 = 0;
        } else if ($var_130 > $this->dzyhsettings['ckzdsj'] && $var_130 >= $var_126[0] && $var_130 < $var_126[1]) {
            $var_132 = $var_129['ck_money'] * $var_127[0] / 100 * $var_126[0] / 24;
        } else if ($var_130 >= $var_126[1] && $var_130 < $var_126[2]) {
            $var_132 = $var_129['ck_money'] * $var_127[1] / 100 * $var_126[1] / 24;
        } else if ($var_130 >= $var_126[2] && $var_130 < $var_126[3]) {
            $var_132 = $var_129['ck_money'] * $var_127[2] / 100 * $var_126[2] / 24;
        } else if ($var_130 >= $var_126[3] && $var_130 < $var_126[4]) {
            $var_132 = $var_129['ck_money'] * $var_127[3] / 100 * $var_126[3] / 24;
        } else if ($var_130 >= $var_126[4]) {
            $var_132 = $var_129['ck_money'] * $var_127[4] / 100 * $var_126[4] / 24;
        }
        $var_133 = array(
            'uid' => $this->user['uid'],
            'username' => $var_129['username'],
            'tk_money' => $var_129['ck_money'],
            time => $var_129[time],
            'tktime' => $this->time,
            'lv' => $var_131,
            'lx' => $var_132,
            'ip' => $this->ip(!0),
            'isdelete' => 0
        );
        if (!$this->update("update {$this->prename}dzyh_ck_swap set state=1 where uid={$this->user['uid']}"))
            throw new Exception('提款失败！请重试');
        if (!$this->insertRow($this->prename . 'dzyh_tk_swap', $var_133))
            throw new Exception('提款失败！请重试');
        $this->addCoin(array(
            'uid' => $this->user['uid'],
            'coin' => $var_129['ck_money'] + $var_132,
            'liqType' => 150,
            'extfield0' => 0,
            'extfield1' => 0,
            'info' => '投资理财提款'
        ));
        return '提款成功!';
    }
}
?>