<?php

namespace app\index\controller;

use think\cache\driver\Memcache;
use  wxpay\database\WxPayUnifiedOrder;
use wxpay\database\WxPayResults;
use wxpay\NativePay;
use wxpay\WxPayConfig;

class Index extends Base
{

    private $obj;//model

    /**
     * 初始化
     * Index constructor.
     */
    function __construct()
    {
        $this->obj = model("share");
        parent::__construct();
    }

    /**
     * 首页，时间轴形式显示图书
     * @return mixed
     */
    public function index()
    {
//        header("Content-type: text/html; charset=utf-8");
//        var_dump($_SERVER["REQUEST_URI"]);
//        var_dump($_SERVER["SERVER_ADDR"]);
//        echo 1123;
//        var_dump((strtotime("2007-3-6") - strtotime("2007-3-5")) / (3600 * 24));
//        $str = "大师傅";
//        $rev = strrev($str);
//        echo $rev;
//        $len = strlen($str);
//        $newstr = '';
//        for ($i = $len - 1; $i >= 0; $i--) {
//            $newstr .= $str[$i];
//        }
//        echo $newstr;

        $file = "index.html";
        if (!file_exists($file)) {
			
            //memcache 缓存
            $mem = new Memcache();
            //图书信息
            if (!$mem->has('memBook')) {
                $books = $this->obj->getBooks(1, "desc");
                $mem->set('memBook', $books);
                echo("来自数据库");
            } else {
                //读取缓存数据
                $books = $mem->get('memBook');
            }

            //根据阅读量排序后的图书信息
            if (!$mem->has('memSort')) {
                $sortBooks = $this->obj->getBooksByRead();
                $mem->set('memSort', $sortBooks);
                echo("来自数据库2");
            } else {
                //读取缓存数据'
                $sortBooks = $mem->get('memSort');
            }

            //判断
            if ($books === false || $sortBooks === false) {
                $this->error("数据错误，请稍后再试");
            }
            //获取用户阅读量
            $ready = [];
            $number = $this->obj->getNumber();
            foreach ($number as $k => $v) {
                $ready[$v['id']] = $v['ready'];
            }
            $data = $this->fetch("", [
                "books" => $books,      //图书列表
                "sortBooks" => $sortBooks,   //推荐阅读
                "ready" => $ready   //用户阅读量
            ]);
            $result = $this->setHtml($file, $data);
        }

        $this->header($file);
    }

    //微信支付回调函数
    public function notify()
    {
        $weixinData = file_get_contents("php://input");
        $weixinData = "<xml>
   <return_code><![CDATA[SUCCESS]]></return_code>
   <return_msg><![CDATA[OK]]></return_msg>
   <appid><![CDATA[wx2421b1c4370ec43b]]></appid>
   <mch_id><![CDATA[10000100]]></mch_id>
   <nonce_str><![CDATA[IITRi8Iabbblz1Jc]]></nonce_str>
   <openid><![CDATA[oUpF8uMuAJO_M2pxb1Q9zNjWeS6o]]></openid>
   <sign><![CDATA[7921E432F65EB8ED0CE9755F0E86D72F]]></sign>
   <result_code><![CDATA[SUCCESS]]></result_code>
   <prepay_id><![CDATA[wx201411101639507cbf6ffd8b0779950874]]></prepay_id>
   <trade_type><![CDATA[JSAPI]]></trade_type>
</xml>";
        try {
            $resultObj = new WxPayResults();
            //把xml转为数组，init同时会判断数据是否正确
            $weixinData = $resultObj->Init($weixinData);
        } catch (\Exception $e) {
            $resultObj->setData("return_code", "FAIL");
            $resultObj->setData("return_msg", $e->getMessage());
            return $resultObj->toXml();
        }

        $outTradeNo = $weixinData['out_trade_no'];//获取商品编号
        //判断编号是否存在或是否已付款...
        //付款成功后的操作...
        //告诉微信服务器，付款成功，不用再回调了
        $resultObj->setData("return_code", "SUCCESS");
        $resultObj->setData("return_msg", "ok");
        return $resultObj->toXml();
    }

    /**
     * 流程：模式二
     * 1、调用统一下单，取得code_url，生成二维码
     * 2、用户扫描二维码，进行支付
     * 3、支付完成之后，微信服务器会通知支付成功
     * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
     */
    public function wxPay()
    {
        $notify = new NativePay();
        $input = new WxPayUnifiedOrder();
        $input->setBody("test");//商品描述
        $input->setAttach("test");//附加数据(某某分店)
        $input->setOutTradeNo(WxPayConfig::MCHID . date("YmdHis"));//商户订单号
        $input->setTotalFee("1");//标价金额(已分为单位)*100
        $input->setTimeStart(date("YmdHis"));//交易起始时间
        $input->setTimeExpire(date("YmdHis", time() + 600));//交易结束时间
        $input->setGoodsTag("test");//订单优惠标记
        $input->setNotifyUrl("http://http://119.23.14.98/index.php/index/index/notify");//通知地址(回调地址)
        $input->setTradeType("NATIVE");//交易类型
        $input->setProductId("123456789");//商品ID
        $result = $notify->getPayUrl($input);
        $url2 = $result["code_url"];
        if (empty($url2)) {
            return '';
        }
        return '<img alt="模式二扫码支付" src="/example/qrcode.php?data=' + urlencode($url2) + ';" style="width:150px;height:150px;"/>';
    }
}
