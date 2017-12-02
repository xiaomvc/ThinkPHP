<?php

namespace app\bis\controller;

use think\Controller;

class Base extends Controller
{
    private $user;

    function _initialize()
    {
        $login = $this->isLogin();
        //获取控制器和方法
        $controller = request()->controller();
        $action = request()->action();

        $allow = "User-login,User-register,Manager-jihuo";
        //允许登录页面
        if (substr_count($allow, $controller . '-' . $action) > 0 || substr_count($allow, $controller . '-' . $action) > 0) {
                //允许访问的页面
        } else {

            //是否登录状态
            if (!$login) {
                $js = <<<ecf
            <script>
            window.top.location.href="/bis/user/login";
</script>
ecf;
                echo($js);
            }
        }
    }

    function isLogin()
    {
        $login = $this->getLoginUser();
        if ($login && $login['bisId']) {

            return true;
        };
        return false;
    }

    function getLoginUser()
    {
        $id = session('bisId', '', 'bis');
        $name = session('bisName', '', 'bis');
        if (empty($this->user)) {
            $this->user = ['bisId' => $id, 'bisName' => $name];
        }
        return $this->user;
    }

}