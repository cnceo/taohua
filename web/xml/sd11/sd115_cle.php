<?php
    $headers["User-Agent"] = "null";
    $headerArr = array(); 
    foreach($headers as $n => $v){
        $headerArr[] = $n.':'.$v;  
    }
    $ch = curl_init("http://www.cailele.com/static/11yun/newlyopenlist.xml");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_HTTPHEADER , $headerArr);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
    $content = curl_exec($ch);
     
    $xml = simplexml_load_string($content);
     
    //for($i = 0; $i < count($xml->row); $i++){
		header("Content-type: application/xml");
		echo'<?xml version="1.0" encoding="utf-8"?><xml><row ';
    for($i = 0; $i < 1; $i++){
        foreach($xml->row->attributes() as $k=>$v){
            echo $k.'="'.$v.'" ';
        }
    }
		echo '/></xml>';
?>