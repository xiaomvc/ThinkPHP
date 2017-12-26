<?php

namespace Home\Controller;

use Think\Controller;

class  UserController extends Controller
{

    function login()
    {
        $this->display();

    }
    function qq_login(){
        //通过openid获得qq账号信息
        //把qq账号信息添加到自己的数据库里边
        //session持久化qq相关的信息
        /*        dump($_SESSION);
        array(7) {
          ["appid"] => int(101277963)
          ["appkey"] => string(32) "9f92bca6541bcb121e626d477f11b6c0"
          ["callback"] => string(54) "http://www.hulaquan.cc/Plugin/qq/oauth/qq_callback.php"
          ["scope"] => string(88) "get_user_info,add_share,list_album,add_album,upload_pic,add_topic,add_one_blog,add_weibo"
          ["state"] => string(32) "36c6c2ab832d857d3ca98d035af6de16"
          ["access_token"] => string(32) "9AD2AA9BADD3F210590851263C8A3633"
          ["openid"] => string(32) "CE464731B8886F0F4287436B1558883D"
        }
        */
        //调用获取qq账号信息的接口
        //在当前页面调用file_get_contents()触发请求其他页面，不给传递session信息
        //可以自己手动get传递

        $userinfo = file_get_contents("http://www.hulaquan.cc/Plugin/qq/user/get_user_info.php?access_token=".$_SESSION['access_token']."&appid=".$_SESSION['appid']."&openid=".$_SESSION['openid']);

        //把字符串转换为数组格式（json格式）
        $userinfo = json_decode($userinfo,true);
        //把收集到的信息写入数据库
        $arr = array(
            'user_name' => $userinfo['nickname'],
            'user_sex'  => $userinfo['gender'],
            'openid'  => $_SESSION['openid'],
            'user_pwd'  => md5(123),
        );
        $user = new \Model\UserModel();

        //判断此qq账号之前是否已经登陆过
        //登录：update更新
        //没有登录:insert写入
        $oneinfo = $user -> where(array('openid'=>$_SESSION['openid']))->find();
        if($oneinfo){
            $user ->where(array('openid'=>$_SESSION['openid']))-> save($arr);
        }else{
            if($newid = $user -> add($arr)){
                //持久化用户信息
            }
        }

        session('user_id',$newid['user_id']);
        session('user_name',$userinfo['nickname']);
        $this -> redirect('index/index');
    }

    function regist()
    {

        if ($_POST) {
            $url = "643568695@qq.com";

            dump($url);

           // $content = "请点击:<a href='' value='验证' />";
            $z = sendEmail($url, "我在测试", "测试文件");
            if (!$z) {
                dump($z);
                echo("发送失败");
            } else {
                echo("发送成功");
            }

        }
        $this->display();

    }
}
