<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<script type="text/javascript" src="/skin/layer/layer.js"></script>
<script type="text/javascript" src="/skin/js/jquery-1.8.3.min.js"></script>
<style>
.paytip{margin:50px;font-size:20px;margin-left:200px;}
.payicon{width:48px; height:48px;vertical-align:middle;display:inline-block;margin:0 20px}
</style>
<script type="text/javascript">
$(function(){
	var gestatus = function(){ //提款
		var billno=$("#billnumsn").val();
		if(billno){
			$.getJSON('/ay/hlpay/getpaystatus.php?billno='+billno, function(tip){

				if(tip.paystatus=="ok"){

						$("body").html("<div class=\"paytip\"><img class=\"payicon\"src=\"/ay/hlpay/images/payok.jpg\"><span>充值成功</span></div>");
					
				}else{
					setTimeout(gestatus, 1000);

				}
			});
		}else{
			setTimeout(gestatus, 1000);

		}
	}
setTimeout(gestatus, 1000);
	
});

</script>
<body>
<?php
	//$paydir = dirname(dirname(dirname(dirname(__FILE__))));
	$paydir = dirname(dirname(dirname(__FILE__)));
	include $paydir.'/ay/hlpay/HttpClient.class.php';


	$trxType =  "AppPay";
	$r1_merchantNo =  "M800030704";
	$r2_orderNumber =$args[0]['rechargeId'];
	if($args[0]['mBankId']==2){
		$r7_appPayType =  "ALIPAY";

	}else{
		$r7_appPayType =  "WXPAY";
	}

	$r3_payType="SCAN";
	$r4_amount =  $args[0]['amount'];
	$r5_currency =  "CNY"; 
	$r6_authcode = "0";
	$r8_callbackUrl = "/ay/hlpay/apppaycallback.php";
	$r10_orderIp = '127.0.0.1';
	$r11_itemname = 'phone';
	$r16_desc = 'phone';


if($r3_payType<>"" && $r4_amount<>"" && $r6_authcode<>"" && $r7_appPayType<>""){

 
	
	#$signKey="XRkdQck5weoktPoaVztdQXtAklV8Sb2Q"; 
	$signKey="ySbs1bsRP4jnI56HOp1yFeka3A8bRqFR"; 

	

	$source = "#".$trxType."#".$r1_merchantNo."#".$r2_orderNumber."#".$r3_payType."#".$r4_amount."#".$r5_currency."#".$r7_appPayType."#".$r8_callbackUrl."#".$r10_orderIp."#".$signKey;
	#echo "source:".$source."<br/>";


	$sign= md5($source);

 
    $Client = new HttpClient("127.0.0.1"); 
    $url = "http://api.99juhe.com/trx-service/appPay/api.action";//请求的页面地址  request url
        //post的参数 
    $params = array('trxType'=>$trxType,'r1_merchantNo'=>$r1_merchantNo,'r2_orderNumber'=>$r2_orderNumber,'r3_payType'=>$r3_payType,'r4_amount'=>$r4_amount,'r5_currency'=>$r5_currency,'r6_authcode'=>$r6_authcode,'r7_appPayType'=>$r7_appPayType,'r8_callbackUrl'=>$r8_callbackUrl,'r10_orderIp'=>$r10_orderIp,'r11_itemname'=>$r11_itemname,'r16_desc'=>$r16_desc,'sign'=>$sign);

    $pageContents = HttpClient::quickPost($url, $params);  //发送请求 send request
     
       # echo "back msg:".$pageContents."<br/>";  //返回的结果   The returned result


	$obj = json_decode($pageContents);
	// var_dump($obj);
	// die();
	$json_merchantNo = $obj->{'r1_merchantNo'};
	$json_orderNumber = $obj->{'r2_orderNumber'};
	$json_serialNumber = $obj->{'r3_serialNumber'};
	$json_payType = $obj->{'r4_payType'};
	$json_qrcode = $obj->{'r5_qrcode'};
	$json_amount = $obj->{'r7_amount'};
	$json_currency = $obj->{'r8_currency'};
	$json_retCode = $obj->{'retCode'};
	$json_retMsg = $obj->{'retMsg'};
	$json_sign = $obj->{'sign'};
	$json_trxType = $obj->{'trxType'};
	 
}
if($args[0]['mBankId']==2){
	 $memberBank['bankName']="支付宝";
}else{
	$memberBank['bankName']="微信支付";
}

?>

	<input type="hidden" id="billnumsn" value="<?=$args[0]['rechargeId'] ?>">
    <ul>
     <li><span>支付类型：</span><b><?= $memberBank['bankName'] ?></b></li>
     <li><span>充值金额：</span>￥<?= $args[0]['amount'] ?>
      
     <li><span> </span>打开<?= $memberBank['bankName'] ?>扫码完成支付</li>
     <li><span> </span><div id="qrcode1" style="margin-left:180px"><img style="width:200px;height:200px" src="http://phpmkr.com/wxpay/qrcode.php?data=<?php echo urlencode($json_qrcode);?>"/></div></li>
    </ul>
 
  
<body>
</html>