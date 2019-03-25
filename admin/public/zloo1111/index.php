<?php
//获取数据
$xmlzz = file_get_contents('php://input');
file_put_contents('request.xml',$xmlzz);
//解析数据
//$ToUserName = (string)$xml->ToUserName;
//$FromUserName = (string)$xml->FromUserName;
//$MsgType = (string)$xml->MsgType;
//$Content = (string)$xml->Content;
$xml = simplexml_load_string($xmlzz);
foreach ($xml as $key=>$value){
    $$key =(string)$value;
}
//判断类型
switch ($MsgType){
    case 'text';
    require 'text.xml';
    break;
    case 'voice';
        $Content = $Recognition;
    require 'text.xml';
    break;
}
//ob_start();
//require 'text.xml';
//$content = ob_get_contents();
//file_put_contents('response.xml',$content);

