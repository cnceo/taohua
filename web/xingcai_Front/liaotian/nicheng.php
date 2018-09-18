<?php
error_reporting(0);
isset($_POST['nc'])?$nc = $_POST['nc']:$nc = null;
echo setcookie("nc",$nc,time()+3600*24,'/');
?>