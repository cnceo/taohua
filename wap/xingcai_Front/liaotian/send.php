<?php
require_once("config.php");
isset($_POST['content'])?$content=$_POST['content']:$content=null;
isset($_POST['nicheng'])?$nicheng=$_POST['nicheng']:$nicheng=null;
$time = time();
$sql = "insert into dunling_chat (nicheng,content,time) values ('$nicheng','$content','$time')";
$ok = mysql_query($sql,$config);
mysql_close();
if($ok){
    echo "ok";
}
?>