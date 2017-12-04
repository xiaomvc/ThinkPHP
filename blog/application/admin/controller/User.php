<?php

namespace app\admin\controller;

use think\captcha\Captcha;
use kuange\qqconnect\QC;
use think\Exception;

class User extends Base
{
    //实例化model
    private $obj;

    /**
     * 初始化数据
     * User constructor.
     */
    function __construct()
    {
        $this->obj = model('User');
        parent::__construct();
    }

    /**
     * 登录页面
     * @return mixed
     */
    function login()
    {
        //用户登录
        if ($_POST) {
            //检查验证码
            if (!captcha_check(input("verify"))) {
                return ['error' => 2, 'msg' => '验证码错误'];
            }
            $data = [
                'username' => input('login'),
                'openid' => input('pwd')
            ];
            //检查登录信息
            $user = model("User")->checkLogin($data);
            if ($user['error'] == 0) {
                //session保存用户信息
                session('username', $user['user']['username'], 'user');
                session('logo', $user['user']['logo'], 'user');
                session('id', $user['user']['id'], 'user');
                //登陆的基本信息
                $userinfo = [
                    'username' => $user['user']['username'],
                    'logo' => $user['user']['logo'],
                    'id' => $user['user']['id']
                ];

                return ['error' => 0, 'msg' => '登录成功', 'user' => $userinfo];
            } else if ($user['error'] == 1) {
                return ['error' => 1, 'msg' => '密码错误'];
            } else {
                return ['error' => 1, 'msg' => '账号不存在'];
            }

        }
        $file = "user.html";
        if (!file_exists($file)) {
            $data = $this->fetch();
            $this->setHtml($file, $data);
        }
        $this->header($file);
    }

    /**
     * 退出登录信息
     * @return array
     */
    function exitLogin()
    {
        session('username', null, 'user');
        session('logo', null, 'user');
        session('id', null, 'user');
        return ['error' => 0];
    }

    /**
     * 验证码
     * @return \think\Response
     */
    function verifyImg()
    {
        //实例化验证码对象
        $img = new Captcha(['length' => 4]);
        return $img->entry();
    }

    /**
     * 第三方登录QQ
     */
    function otherLogin()
    {
        $qc = new QC();
        return redirect($qc->qq_login());

    }

    /**
     * QQ回调方法
     * @return array
     */
    function callback()
    {
        try {
            $qc = new QC();
            $back = $qc->qq_callback();    // access_token
            $openid = $qc->get_openid();     // openid
            $qc = new QC($back, $openid);
            $userinfo = $qc->get_user_info();

            if ($userinfo) {

                //要添加到数据库中的数据
                $data = [
                    'username' => $userinfo['nickname'],
                    'logo' => $userinfo['figureurl_qq_2'],
                    'openid' => md5($openid)
                ];
                $userid = "";//用户ID
                //$result = $this->obj->setValidate(request()->controller(), 'add', $data, true);

                //获取登录过的用户,用openID判断
                $result = $this->obj->getUser($data);
                //判断用户是否有登陆过
                if (!$result) {
                    //添加用户到数据库中
                    $addResult = $this->obj->addUser($data);
                    if (!$addResult) {
                        $this->error('数据保存失败', '/index/index/index', '', 6);
                    }
                    $userid = $this->obj->id;//获取最新添加的ID值
                } else {
                    //修改登录过的用户的信息
                    $editU = $this->obj->editUser($data);

                    if ($editU === false) {
                        $this->error('更新用户状态出错', 'index/index/index', '', 6);
                    }
                    $userid = $result['id'];//获取用户id

                }
                //用户登录的基本信息
                $username = $userinfo['nickname'];
                $logo = $userinfo['figureurl_qq_2'];
                $id = $userid;

                //session保存用户信息
                session('username', $username, 'user');
                session('logo', $logo, 'user');
                session('id', $id, 'user');
            } else {
                $this->error('登录失败', '/index/index/index', '', 6);

            }
            //执行脚本文件
            $js = <<<eof
        <script type="text/javascript" src="/static/common/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript">
                //删除多余的span标签
                $(".userLogo",window.opener.document).siblings("span").remove();
                $(".userLogo",window.opener.document).find("img").attr("src","$logo");
                
                $(".userLogo",window.opener.document).after("<span><a href=\"javascript:;\">"+"$username"+"</a></span><span><a href=\"javascript:;\" onclick=\"exitLogin()\">退出登录</a></span>");
                $(".userid",window.opener.document).val("$id");
                window.close();
        </script>
eof;

            echo $js;
        } catch (Exception $e) {
            $this->error($e->getMessage(), '/index/index/index', '', 10);
        }

    }
}

