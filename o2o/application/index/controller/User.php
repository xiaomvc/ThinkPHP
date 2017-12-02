<?php

namespace app\index\controller;

use kuange\qqconnect\QC;
use kuange\qqconnect\URL;

class User extends Base
{
    private $obj;//model

    //初始化
    function __construct()
    {
        $this->obj = model('User');

        parent::__construct();
    }

    /**
     * 登录验证
     * @return mixed
     */
    function login()
    {

        //如果给用户已经登录过，并且session还没过期，就自动登录
        if ($this->isLogin()) {
            // dump(123123123);
            $this->redirect('index/index/index');
        }

        if (input('post.')) {
            $userName = input('userName');
            $password = input('password');
            //根据用户名判断是否有该用户
            $userInfo = $this->obj->getUserByName($userName);

            if ($userInfo && !empty($userInfo)) {
                //加密判断
                $password = md5($password . $userInfo['code']);

                if ($password == $userInfo['password']) {
                    session('userName', $userInfo['username'], 'o2o');//存放用户名
//                    $js = <<<eof
//                    <script type="text/javascript">
//window.top.location.href="/index/index/index";
//                    </script>
//eof;
//                    echo $js;

                    return ['success' => 1, 'info' => '登录成功'];


                }
            }
            return ['success' => 0, 'info' => '账号或密码错误'];
        }
        return $this->fetch('', ['title' => '用户登录']);
    }

    //退出登录，并删除session值
    function exitLogin()
    {
        session('userName', null, 'o2o');
        $this->redirect('index/user/login');
    }

    /**
     * 注册信息
     * @return mixed
     */
    function register()
    {
        //注册信息提交时
        if (input('post.')) {

//            dump(input('.'));exit;
            $userName = $this->obj->getUserByName(input('userName'));

            if ($userName && !empty($userName)) {

                return ['success' => 0, 'info' => '该用户已存在'];
            }
            //生成随机数，添加到密码中，增加密码的复杂性
            $code = rand(1000, 9999);
            $data = [
                'username' => input('userName'),
                'password' => md5(trim(input('password') . $code)),
                'last_login_time' => time(),
                'code' => $code,
                'email' => input('email'),
                'status' => -1
            ];
            // 注册信息
            $result = $this->obj->register($data);
            //  $sql = $this->obj->getLastSql();
            // dump($sql);
            // exit;
            //注册成功
            if (!$result) {
                return ['success' => 0, 'info' => '添加失败，请稍后再试'];
            }
            return ['success' => 1, 'info' => '注册成功'];
        }
        return $this->fetch('', ['title' => '注册用户']);

    }

    /**
     * 获取验证码图片
     */
    function getVerify()
    {
        $cfg = [
            'length' => 4,
            'fontSize' => 22,
            'useNoise' => false,
        ];
        $verify = new \Verify($cfg);
        return $verify->entry();
    }

    /**
     * 判断验证码是否有效
     * @param int $verifyCode
     * @return bool
     */
    function checkCode()
    {
        //判断是否是post方式，校验
        if (input('post.')) {

            $verifyCode = input('verifyCode');
            $verify = new \Verify();
            //判断验证码是否有效
            if ($verify->check($verifyCode)) {
                return ['success' => 1];
            }
        }
        return ['success' => 0];
    }

    /**
     * QQ登录入口
     * @return \think\response\Redirect
     */
    function oauth()
    {
        $qc = new QC();
//       print ( $qc->qq_login());
        //$qc->qq_login()获取到的是连接地址
        return redirect($qc->qq_login());
    }

    /**
     * 回调函数
     */
    function callback()
    {
        $qc = new QC();
        //获取access_token和openid数据
        $access_token = $qc->qq_callback();
        $openid = $qc->get_openid();
        //需要重新new一个对象，获取登录用户信息
        $qc = new QC($access_token, $openid);
        $userinfo = $qc->get_user_info();
        //检验该QQ用户是否登录过
        $info = $this->obj->getQQinfo($access_token, $openid);
        if ($info && !empty($info)) {
            //已登录过的用户（更新数据库信息）
            $data = [
                'username' => $userinfo['nickname'],
                'last_login_time' => time()
            ];
            $data = $this->obj ->qqUpdate($data, $access_token, $openid);

            if ($data) {
                //保存QQ登录用户成功
                session('userName', $userinfo['nickname'], 'o2o');
                $this->redirect('/index/index/index');
            } else {
                $this->error('修改用户数据失败，哈哈，快告诉我', '/index/index/index');
            }

        } else {
            $data = [
                'username' => $userinfo['nickname'],
                'password' => md5('芝麻开门'),
                'code' => 1212,
                'last_login_time' => time(),
                'token' => $access_token,
                'openId' => $openid,
            ];
            //保存到数据库中
            $data = $this->obj->register($data);
            if ($data) {
                //保存QQ登录用户成功
                session('userName', $userinfo['nickname'], 'o2o');
                $this->redirect('/index/index/index');
            } else {
                $this->error('登录用户保存失败，哈哈,快告诉我', '/index/index/index');
            }
        }
    }
}
