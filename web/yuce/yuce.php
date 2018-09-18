<?php
ob_start('ob_output');
define("QIANSHAN", "QIANSHAN");
define("HOUSHAN", "HOUSHAN");
define("ZHONGHE", "ZHONGHE");

function ob_output($html) {
    // 一些用户喜欢使用windows笔记本编辑文件，因此在输出时需要检查是否包含BOM头
    if (ord(substr($html, 0, 1)) === 239 && ord(substr($html, 1, 2)) === 187 && ord(substr($html, 2, 1)) === 191) $html = substr($html, 3);
    // gzip输出
    if(
        !headers_sent() && // 如果页面头部信息还没有输出
        extension_loaded("zlib") && // 而且zlib扩展已经加载到PHP中
        array_key_exists('HTTP_ACCEPT_ENCODING', $_SERVER) &&
        stripos($_SERVER["HTTP_ACCEPT_ENCODING"], "gzip") !== false // 而且浏览器说它可以接受GZIP的页面
    ) {
        $html = gzencode($html, 3);
        header('Content-Encoding: gzip');
        header('Vary: Accept-Encoding');
    }
    header('Content-Length: '.strlen($html));
    return $html;
}
include(dirname(__FILE__)."/inc/comfunc.php");


//此处设置彩种id
$typeid=intval($_GET['typeid']);
$typeid = 1;
if(!$mydb) $mydb = new MYSQL($dbconf);

//$dateTime = date('Ymd',time());
$dateTime = "20180917";

$fieldsStr = "id,number,data,func_ext,beishu,round,profit";
$tableStr=$conf['db']['prename']."data";
$whereStr=" type=$typeid  and left(number,8) = $dateTime";
$orderStr = " order by number asc ";
$data = $mydb->row($tableStr,$fieldsStr,$whereStr.$orderStr);

$oldId = 0;
$oldData = array();
if($data) foreach($data as $index=>$var){
    echo '<td class="wdh" align="center"><div class="ball05">'.$var[0].'</div></td>';
    $oldData = clac($oldData,$var[0],$var[2],$oldId,$index+1,$mydb,$conf);
    $oldId = $var[0];
}


/**
 * 24期数据过来，预测25期，计算24期结果
 * 1、预测下期数据，2、计算上期预测结果
 * @param $thisFun 当前24期使用的方法
 * @param $oldData  23期funcext的预测数据
 * @param $newData 当前24期公彩数据
 * @return array
 */
function clac($oldData,$newId,$newData,$oldId,$qihao,$mydb,$conf){
    //$dateTime = date('Ymd',time());
    $dateTime = "20180917";
    $beishu=array('1','2','4','4','8','16','20','40','80');
    $yuceData = array();
    $yuceData[QIANSHAN] = array('currResult' => 1,'function'=>QIANSHAN, 'nextData' => 0, 'nextNum' => 0, 'nextProfit' => 0, 'nextRound' => 1, 'nextBeishu' => 1, 'beishuIndex' => 0);
    $yuceData[HOUSHAN] = array('currResult' => 1, 'function'=>HOUSHAN,'nextData' => 0, 'nextNum' => 0, 'nextProfit' => 0, 'nextRound' => 1, 'nextBeishu' => 1, 'beishuIndex' => 0);
    $yuceData[ZHONGHE] = array('currResult' => 1,'function'=>ZHONGHE, 'nextData' => 0, 'nextNum' => 0, 'nextProfit' => 0, 'nextRound' => 1, 'nextBeishu' => 1, 'beishuIndex' => 0);
    $tableStr=$conf['db']['prename']."data";
    $newDataArray = explode(",",$newData);
    if($oldId==0){
        $yuceData[HOUSHAN]['nextData'] = ($newDataArray[2]+$newDataArray[3]+$newDataArray[4])%10 ;
        $yuceData[QIANSHAN]['nextData'] = ($newDataArray[0]+$newDataArray[1]+$newDataArray[2])%10 ;
        $yuceData[ZHONGHE]['nextData'] = ($newDataArray[0]+$newDataArray[1]+$newDataArray[2]+$newDataArray[3]+$newDataArray[4])%10 ;
        $whereStr = " id=$newId";
        $mydb->update($tableStr,array('func_ext'=>json_encode($yuceData)),$whereStr);
        return $yuceData;
    }

    //修改23期func_ext数据
    $oldData[QIANSHAN] = calcOld($oldData[QIANSHAN],$newData);
    $oldData[HOUSHAN] = calcOld($oldData[HOUSHAN],$newData);
    $oldData[ZHONGHE] = calcOld($oldData[ZHONGHE],$newData);
    //update 23期funcext的预测数据
    $whereStr = " id=$oldId";
    $mydb->update($tableStr,array('func_ext'=>json_encode($oldData)),$whereStr);


    if($qihao==23){
        //统计1-22期所有预测结果的准确性
        $fieldsStr = "id,number,data,func_ext,beishu,round,profit";
        $whereStr=" type=1  and left(number,8) = $dateTime";
        $orderStr = " order by number asc ";
        $data23s = $mydb->row($tableStr,$fieldsStr,$whereStr.' '.$orderStr.' limit 22 ');

        $qianshantotal = 0;
        $houshantotal = 0;
        $zhongheshantotal = 0;
        foreach ($data23s as $data23){
            $func_ext = json_decode($data23[3],true);
            $qianshantotal += $func_ext[QIANSHAN]['nextProfit'];
            $houshantotal += $func_ext[HOUSHAN]['nextProfit'];
            $zhongheshantotal += $func_ext[ZHONGHE]['nextProfit'];
        }
        $all23Datas = array($qianshantotal=>QIANSHAN,$houshantotal=>HOUSHAN,$zhongheshantotal=>ZHONGHE);
        krsort($all23Datas);
        $index = 1;
        foreach ($all23Datas as $value){
          $oldData[$value]["currResult"] = $index;
          if($index==3){
              $oldData[$value]["currResult"] = 0;
          }
          $index++;
        }
        $whereStr = " id=$oldId";
        $mydb->update($tableStr,array('func_ext'=>json_encode($oldData)),$whereStr);
    }



    //预测的25期数据，放入24期func_ext数据
    $allOldData = [array($oldData[QIANSHAN],$yuceData[QIANSHAN]),array($oldData[HOUSHAN],$yuceData[HOUSHAN]),array($oldData[ZHONGHE],$yuceData[ZHONGHE])];

    foreach ($allOldData as &$data2){
        if($data2[0]['currResult']==1){
            $yuceData[$data2[1]['function']]['nextData']=$data2[0]['nextData'];
        }
        $yuceData[$data2[1]['function']]['currResult']=$data2[0]['currResult'];
    }

    foreach ($allOldData as &$data){
        $bIndex = $data[0]['beishuIndex'];
        if($bIndex>=count($beishu)){
            $bIndex=0;
        }

        if($qihao<=22){
            if($qihao==9){
                if(1==2);
            }
            if($data[0]['nextNum']>0){
                $yuceData[$data[1]['function']]['nextBeishu']=1;
                $yuceData[$data[1]['function']]['beishuIndex']=0;
                $yuceData[$data[1]['function']]['nextRound']=1;

                if(HOUSHAN == $data[0]['function']){
                    $yuceData[$data[1]['function']]['nextData'] = ($newDataArray[2]+$newDataArray[3]+$newDataArray[4])%10 ;
                }else if(QIANSHAN == $data[0]['function']){
                    $yuceData[$data[1]['function']]['nextData'] = ($newDataArray[0]+$newDataArray[1]+$newDataArray[2])%10 ;
                }else{
                    $yuceData[$data[1]['function']]['nextData'] = ($newDataArray[0]+$newDataArray[1]+$newDataArray[2]+$newDataArray[3]+$newDataArray[4])%10 ;
                }
            }else{
                if($data[0]['nextRound']>=3){
                    $yuceData[$data[1]['function']]['nextRound']=1;
                    $yuceData[$data[1]['function']]['nextBeishu']=$beishu[$bIndex+1];
                    $yuceData[$data[1]['function']]['beishuIndex']=$bIndex+1;
                    if(HOUSHAN == $data[0]['function']){
                        $yuceData[$data[1]['function']]['nextData'] = ($newDataArray[2]+$newDataArray[3]+$newDataArray[4])%10 ;
                    }else if(QIANSHAN == $data[0]['function']){
                        $yuceData[$data[1]['function']]['nextData'] = ($newDataArray[0]+$newDataArray[1]+$newDataArray[2])%10 ;
                    }else{
                        $yuceData[$data[1]['function']]['nextData'] = ($newDataArray[0]+$newDataArray[1]+$newDataArray[2]+$newDataArray[3]+$newDataArray[4])%10 ;
                    }
                }else{
                    $yuceData[$data[1]['function']]['nextRound']=$data[0]['nextRound']+1;
                    $yuceData[$data[1]['function']]['nextBeishu']=$beishu[$bIndex+1];
                    $yuceData[$data[1]['function']]['beishuIndex']=$bIndex+1;
                }

            }
        }else{
            if($data[0]['currResult']==1&&$data[0]['nextNum']>0){
                $yuceData[$data[1]['function']]['currResult']=1;
                $yuceData[$data[1]['function']]['nextBeishu']=1;
                $yuceData[$data[1]['function']]['beishuIndex']=0;
                $yuceData[$data[1]['function']]['nextRound']=1;

                if(HOUSHAN == $data[0]['function']){
                    $yuceData[$data[1]['function']]['nextData'] = ($newDataArray[2]+$newDataArray[3]+$newDataArray[4])%10 ;
                }else if(QIANSHAN == $data[0]['function']){
                    $yuceData[$data[1]['function']]['nextData'] = ($newDataArray[0]+$newDataArray[1]+$newDataArray[2])%10 ;
                }else{
                    $yuceData[$data[1]['function']]['nextData'] = ($newDataArray[0]+$newDataArray[1]+$newDataArray[2]+$newDataArray[3]+$newDataArray[4])%10 ;
                }

            }else if($data[0]['currResult']==1&&$data[0]['nextNum']<=0){

                if($data[0]['nextRound']>=3){  //如果没中，并且是三期后
                    $yuceData[$data[1]['function']]['nextBeishu']=1;
                    $yuceData[$data[1]['function']]['beishuIndex']=0;
                    $yuceData[$data[1]['function']]['nextRound']=1;

                    $yuceData[$data[1]['function']]['currResult']=2;

                    foreach ($allOldData as &$data2){
                        if($data2[0]['currResult']==2){
                            $yuceData[$data2[1]['function']]['nextBeishu']=1;
                            $yuceData[$data2[1]['function']]['beishuIndex']=0;
                            $yuceData[$data2[1]['function']]['nextRound']=1;
                            $yuceData[$data2[1]['function']]['currResult']=1;

                            if(HOUSHAN == $data2[0]['function']){
                                $yuceData[$data2[1]['function']]['nextData'] = ($newDataArray[2]+$newDataArray[3]+$newDataArray[4])%10 ;
                            }else if(QIANSHAN == $data2[0]['function']){
                                $yuceData[$data2[1]['function']]['nextData'] = ($newDataArray[0]+$newDataArray[1]+$newDataArray[2])%10 ;
                            }else{
                                $yuceData[$data2[1]['function']]['nextData'] = ($newDataArray[0]+$newDataArray[1]+$newDataArray[2]+$newDataArray[3]+$newDataArray[4])%10 ;
                            }
                            break;
                        }
                    }

                    if(HOUSHAN == $data[0]['function']){
                        $yuceData[$data[1]['function']]['nextData'] = ($newDataArray[2]+$newDataArray[3]+$newDataArray[4])%10 ;
                    }else if(QIANSHAN == $data[0]['function']){
                        $yuceData[$data[1]['function']]['nextData'] = ($newDataArray[0]+$newDataArray[1]+$newDataArray[2])%10 ;
                    }else{
                        $yuceData[$data[1]['function']]['nextData'] = ($newDataArray[0]+$newDataArray[1]+$newDataArray[2]+$newDataArray[3]+$newDataArray[4])%10 ;
                    }
                }else{  //如果没中，并且还没到三期
                    $yuceData[$data[1]['function']]['currResult']=1;
                    $yuceData[$data[1]['function']]['nextRound']=$data[0]['nextRound']+1;
                    $yuceData[$data[1]['function']]['nextBeishu']=$beishu[$bIndex+1];
                    $yuceData[$data[1]['function']]['beishuIndex']=$bIndex+1;
                }
            }


            if($qihao>23 && $data[0]['currResult']==1){
                $whereStr = " id=$oldId";
                $profit = $mydb->get_one($tableStr,$whereStr)['profit'];

                $profit = bcadd($profit , $data[0]['nextProfit']);
                $whereStr = " id=$newId  ";
                $mydb->update($tableStr,array('profit'=>$profit),$whereStr);
            }
        }


    }
    $whereStr = " id=$newId";
    $mydb->update($tableStr,array('func_ext'=>json_encode($yuceData)),$whereStr);
    return $yuceData;
}


function calcOld($oldFun,$newData){
    // 计算24期预测结果，修改23期func_ext数据
    $oldDataArray = explode(",",$newData);
    $prve_num = substr_count($newData,$oldFun['nextData']);
    if($prve_num>0){
        $prve_profit = $prve_num * $oldFun["nextBeishu"] * 2;
    }else{
        $prve_profit = - $oldFun["nextBeishu"];
    }
    $oldFun['nextNum'] = $prve_num;
    $oldFun['nextProfit'] = $prve_profit;

    return $oldFun;
}


?>
