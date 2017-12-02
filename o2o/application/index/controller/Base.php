<?php

namespace app\index\controller;

use think\Controller;



class Base extends Controller
{
    /**
     * 初期化
     */
    function _initialize()
    {
        $login = $this->isLogin();
        if (!$login && request()->controller() != "User") {
            $js = <<<ecf
            <script>
            window.top.location.href="/index/user/login";
</script>
ecf;
            echo($js);
        }
    }

    /**
     * 检验登录
     * @return bool
     */
    function isLogin()
    {
//        return true;
        $login = $this->getLoginUser();
        if ($login && $login['userName']) {
            return true;
        };
        return false;
    }

    /**
     * 获取登录用户的信息
     * @return array
     */
    function getLoginUser()
    {
        $userName = session('userName', '', 'o2o');
        if (empty($this->user)) {
            $this->user = ['userName' => $userName];
        }
        return $this->user;
    }



}