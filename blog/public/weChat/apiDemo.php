<?php

// 第三方发送消息给公众平台

$signature = $_GET['signature'];
$token = "weChat";
$timeStamp = $_GET['timestamp'];
$nonce = $_GET['nonce'];
//$appId = "wx9e88e39940b0db0e";

$array=array($timeStamp ,$nonce ,$token );
sort($array);
$tmpstr=implode('',$array);
$tmpstr=sha1($tmpstr);
if($tmpstr==$signature){
	echo $_GET['echostr'];
	exit;
}

