<?php
/**
 * wechat php test
 */

////define your token
//define("TOKEN", "xiaok");
//$wechatObj = new wechatCallbackapiTest();
////$wechatObj->valid();
//$wechatObj->index();

class wechatCallbackapiTest
{
    public function index()
    {
        if (isset($_GET['echostr'])) {
            $this->valid();
        } else {
            $this->responseMsg();
        }
    }

    public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if ($this->checkSignature()) {
            echo $echoStr;
            exit;
        }
    }

    public function responseMsg()
    {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
        if (!empty($postStr)) {
            //经过simplexml对xml进行解释
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $type = $postObj->MsgType;
            $time = time();
            $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            <FuncFlag>0</FuncFlag>
                            </xml>";

            $imgTpl = "<xml>
                             <ToUserName><![CDATA[%s]]></ToUserName>
                             <FromUserName><![CDATA[%s]]></FromUserName>
                             <CreateTime>%s</CreateTime>
                             <MsgType><![CDATA[%s]]></MsgType>
                             <Image>
                             <MediaId><![CDATA[%s]]></MediaId>
                             </Image>
                             </xml>";
            $voiceTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Voice>
                            <MediaId><![CDATA[%s]]></MediaId>
                            </Voice>
                            </xml>";
            if ($keyword == '文本') {
                $str = '文本消息:' . $keyword;
                $MsgType = 'text';
                $echo = sprintf($textTpl, $fromUsername, $toUsername, $time, $MsgType, $str);
            } else if ($keyword == '图片') {
                $str = '文本消息:' . $keyword;
                $MsgType = 'text';
                $echo = sprintf($textTpl, $fromUsername, $toUsername, $time, $MsgType, $str);

            } else if ($keyword == '语音') {
                $str = '文本消息:' . $keyword;
                $MsgType = 'text';
                $echo = sprintf($textTpl, $fromUsername, $toUsername, $time, $MsgType, $str);
            } else {
                //获取图灵机器人返回的数据
                $data = file_get_contents("http://www.tuling123.com/openapi/api?key=2983f0c71ebb41c2a3dba7099e49cb8b&info={$keyword}");
                $data = json_decode($data);
                $echo = printf($textTpl, $fromUsername, $toUsername, time(), 'text', $data->text);
            }


            echo $echo;

        } else {
            echo "";
            exit;
        }
    }

    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }
}

?>