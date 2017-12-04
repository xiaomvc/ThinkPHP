<?php

namespace app\api\controller;

use think\Controller;
use wechat\WXBizMsgCrypt;

class Chat extends Controller
{
//    private $appid = "wx9e88e39940b0db0e";
//    private $secret = "4d79939c318db7c1a342efc23b6d852d";
    private $appid = "wxfa585b2d8331f421";
    private $secret = "b9eae1d702579713700afa0d030e64a6";
    private $token = "xiaok";

    public function demo()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        file_put_contents("tmp/2.txt", $postStr."\n\n", FILE_APPEND);
        if (!empty($postStr)) {
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $type = trim($postObj->MsgType);
            switch ($type) {
                case "event":
                    //判断是否刚关注
                    if ($postObj->Event == "subscribe") {
                        $text = "欢迎关注...";
                        $result = $this->receiveText($postObj, $text);
                    } elseif ($postObj->EventKey == "V1001_TODAY_MUSIC") {
                        $text = "歌曲测试中";
                        $result = $this->receiveText($postObj, $text);
                    }
                    break;
                case "text":
                    $msg = trim($postObj->Content);

                    if ($msg == "图文") {
                        $record = array(
                            ['title' => '山塘街',
                                'description' => '山塘街东起阊门渡僧桥，西至苏州名胜虎丘山的望山桥，长约七里，所以苏州俗语说“七里山塘到虎丘”...',
                                'picUrl' => 'http://www.61xiaok.xin/upload/qwe.jpg',
                                'url' => 'http://www.61xiaok.xin'],
                            ['title' => '山塘街',
                                'description' => '山塘街东起阊门渡僧桥，西至苏州名胜虎丘山的望山桥，长约七里，所以苏州俗语说“七里山塘到虎丘”...',
                                'picUrl' => 'http://www.61xiaok.xin/upload/qwe.jpg',
                                'url' => 'http://www.61xiaok.xin']
                        );
                        $result = $this->receiveNews($postObj, $record);
                    } else {
                        $text = "我不是文本";
                        $result = $this->receiveText($postObj, $text);
                    }
                    break;
                case "image":
                    $result = $this->receiveImage($postObj, $postObj->MediaId);
                    break;
                case "voice":
                    $result = $this->receiveVoice($postObj);
                    break;
                case "video":
                    $result = $this->receiveVideo($postObj);
                    break;
                case "shortvideo":
                    $result = $this->receiveShortvideo($postObj);
                    break;
                case "location":
                    $result = $this->receiveLocation($postObj);
                    break;
                case "link":
                    $result = $this->receiveLink($postObj);
                    break;
                default:
                    exit;
            }
            file_put_contents("tmp/2.txt", $result."\n\n", FILE_APPEND);
            echo $result;
        } else {
            echo "";
            exit;
        }
    }

    /**
     * 验证微信服务器和自己的服务器是否有对接成功
     * （微信提供的代码有些缺失！！）
     * @param $token
     * @return bool
     */
    private function checkSignature($token)
    {
        $signature = $_GET["signature"];

        $timestamp = $_GET["timestamp"];

        $nonce = $_GET["nonce"];

        $tmpArr = array($timestamp, $nonce, $token);

        sort($tmpArr, SORT_STRING);

        $tmpStr = implode('', $tmpArr);

        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            echo $_GET["echostr"];
        } else {
            return false;
        }
    }

    /**
     * HTTPS连接
     * @param $url
     * @param $data
     * @return mixed
     */
    private function https_request($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_POST, 1);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    /**
     * 设置菜单
     */
    private function setMenu()
    {
        $this->accessToken();
        $access = $_SESSION['accessToken'];

        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access";
        dump($url);
        $jsonArr = ' {
                 "button":[
                 {	
                      "type":"click",
                      "name":"今日歌曲",
                      "key":"V1001_TODAY_MUSIC"
                  },
                  {
                       "name":"菜单",
                       "sub_button":[
                       {	
                           "type":"view",
                           "name":"搜索",
                           "url":"http://yun.8miu.com/"
                        },
                        {
                           "type":"view",
                           "name":"书客",
                           "url":"http://www.61xiaok.xin/"
                        }]
                   }]
 }';
        $result = $this->https_request($url, $jsonArr);
        dump($result);
    }

    /**
     * 获取access_token
     */
    private function accessToken()
    {
        Session_start();

        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appid&secret=$this->secret";
        $access = file_get_contents($url);
        $access = json_decode($access, true);
        //dump($access);
        $_SESSION["accessToken"] = $access["access_token"];
        //dump($_SESSION["accessToken"]);
    }

    /**
     * 回复文本信息
     * @param $postObj
     * @return string
     */
    private function receiveText($postObj, $text)
    {
        $textTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[text]]></MsgType>
                <Content><![CDATA[%s]]></Content>
            </xml>";

        $result = sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, time(), $text);
        return $result;
    }

    /**
     * 回复图片
     * @param $object
     * @param $mediaId
     * @return string
     */
    private function receiveImage($object, $mediaId)
    {
        $imageTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[image]]></MsgType>
                <Image>
                <MediaId><![CDATA[%s]]></MediaId>
                </Image>
                </xml>";
        $result = sprintf($imageTpl, $object->FromUserName, $object->ToUserName, time(), $mediaId);
        return $result;
    }

    /**
     * 图文回复
     * 思路：把xml分成三份，根据数据判断图文的数量（8）
     * @param $object
     * @param $newsContent
     * @return string
     */
    private function receiveNews($object, $newsContent)
    {
        $newsTplHead = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[news]]></MsgType>
                <ArticleCount>%s</ArticleCount><Articles>";
        $newsTplBody = "<item>
                <Title><![CDATA[%s]]></Title> 
                <Description><![CDATA[%s]]></Description>
                <PicUrl><![CDATA[%s]]></PicUrl>
                <Url><![CDATA[%s]]></Url>
                </item>";
        $newsTplFoot = "</Articles></xml>";
        //        $title = $newsContent['title'];
        //        $desc = $newsContent['description'];
        //        $picUrl = $newsContent['picUrl'];
        //        $url = $newsContent['url'];
        $count = count($newsContent);
        $header = sprintf($newsTplHead, $object->FromUserName, $object->ToUserName, time(), $count);
        $body = '';
        // N 份图文信息
        foreach ($newsContent as $item) {
            $body .= sprintf($newsTplBody, $item['title'], $item['description'], $item['picUrl'], $item['url']);
        }

        return $header . $body . $newsTplFoot;
    }
}