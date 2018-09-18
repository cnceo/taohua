<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/skin/admin/layout.css" media="all" />
<link type="text/css" rel="stylesheet" href="/skin/js/jqueryui/skin/smoothness/jquery-ui-1.8.23.custom.css" />
<script src="/skin/js/jquery-1.7.2.min.js"></script>
<script src="/skin/js/jqueryui/jquery.ui.core.js"></script>
<script src="/skin/js/jqueryui/jquery.ui.datepicker.js"></script>
<script src="/skin/js/jqueryui/i18n/jquery.ui.datepicker-zh-CN.js"></script>
<script>
$(function(){
	$(':input[type=date]').datepicker();
});
</script>
</head>
<body>
<form id="editEvent" action="/index.php/event/updateEvent" method="POST">
<?php
	if($args[0]){
		$id=intval($args[0]);
		$event=$this->getRow("select * from {$this->prename}events where id=$id");
		echo '<input type="hidden" name="id" value="', $event['id'], '"/>';
	}
?>
    <table class="tablesorter left" cellspacing="0" width="100%" style="font-size:12px;">
    <thead>
        <tr> 
            <td>项目</td> 
            <td>值</td> 
        </tr> 
    </thead>
    <tbody>
        <tr> 
            <td width="80">活动名称</td>
            <td><input type="text" name="title" value="<?=$event['title']?>"/></td>
        </tr>
        <tr>
            <td>活动介绍</td>
            <td><textarea rows="3"  cols="30" name="tips"><?=$event['tips']?></textarea></td>
        </tr>
        <tr> 
            <td>活动内容</td>
            <td><?=$event['content'] ? $event['content'] : "每日首次充值 %s 元以上可在平台页面上点击参与活动自由选择参与（最高可以领取 %s ）<br/>活动1：%s 倍流水可领取首次充值金额 %s ％的活动礼金<br/> 2：%s 倍流水可领取首次充值金额 %s ％的活动礼金<br/> 3：%s 倍流水可领取首次充值金额 %s ％的活动礼金<br/> 4：%s 倍流水可领取首次充值金额 %s ％的活动礼金"?>
                </td>
        </tr>
        <tr> 
            <td>首冲金额</td>
            <td><input type="text" name="coin"  value="<?=$event['coin']?>" placeholder="请填入首冲金额"/></td>
        </tr>
        <tr> 
            <td>满足流水倍数</td>
            <td><input type="text" name="condition"  value="<?=$event['condition']?>" placeholder="格式如：5|10|15|20"/>
                <span class="spn6">如多条则按照递增填写，'|'隔开。如10|20|30|40</span></td>
        </tr>
        <tr> 
            <td>返还率</td>
            <td><input type="text" name="rate"  <?php if($event['rate_type']=='2') echo "disabled=true";?> value="<?=$event['rate']?>" placeholder="格式如：5|10|15|20"/>%
                <span class="spn6">如多条则按照递增填写，'|'隔开，与'下注倍率'，个数保持一致。如：下注倍率10|20|30|40对应5|6|7|8</span></td>
        </tr>
        <tr>
            <td>返还金额</td>
            <td><input type="text" name="rebate"  <?php if($event['rate_type']=='1') echo "disabled=true";?> value="<?=$event['rebate']?>"/><span class="spn6">返回固定金额</span></td>
        </tr>
        <tr>
            <td>返还类型</td>
            <td><input type="radio" name="rate_type"  <? if($event['rate_type'] =='1' || !$event['rate_type']) echo "checked"; ?> value="1"/>返还率%
                <input type="radio" name="rate_type"  <? if($event['rate_type'] =='2') echo "checked"; ?>  value="2"/>返还金额
                <span class="spn6">当勾选“返还率”则“返还率”生效，勾选“返还金额”则“返还金额”生效，二选一生效</span>
            </td>
        </tr>
        <tr>
            <td>最高金额</td>
            <td><input type="text" name="max_rebate"  value="<?=$event['max_rebate']?>" placeholder="请填入返还最高金额"/><span class="spn6">返还最高金额</span></td>
        </tr>
        <tr>
            <td>活动时间</td>
            <td>从 <input type="date"  name="start_time" style="width:75px;" value="<?=date('Y-m-d H:i:s',$event['start_time'])?>"/> 到  <input type="date" name="end_time" style="width:75px;" value="<?php if($event['end_time']){echo date('Y-m-d H:i:s',$event['end_time']);}else{echo '0';}?>"/><span class="spn6">0为不过期</span></td>
        </tr>
        <tr>
            <td>状态</td> 
            <td>
                <label><input type="radio" value="1" name="enable" <?php if($event["enable"]==1){?> checked='checked'<?php }?>/>开启</label>
                <label><input type="radio" value="0" name="enable" <?php if($event["enable"]==0){?> checked='checked'<?php }?>/>关闭</label>
            </td> 
        <tr>
    </tbody>
    </table>
</form>
</body>
</html>
<script>
    $().ready(function(){
        var rateType = $("input[name='rate_type']:checked").val();
        if(rateType === '1')
        {
            $("input[name='rebate']").attr('disabled',true);
            $("input[name='rate']").attr('disabled',false);
        }else if(rateType ==='2'){
            $("input[name='rebate']").attr('disabled',false);
            $("input[name='rate']").attr('disabled',true);
        }
        if($("input[name='rate_type']"))
        $("input[name='rate_type']").change(function(){
            var val =$(this).val();
            if(val==='1'){
                $("input[name='rebate']").attr('disabled',true);
                $("input[name='rate']").attr('disabled',false);
            }else if(val ==='2'){
                $("input[name='rebate']").attr('disabled',false);
                $("input[name='rate']").attr('disabled',true);
            }
        });

    });
</script>