<?php

namespace tools;

use Think\Controller;

class  AdminController extends Controller
{
    //构造方法
    function __construct()
    {
        //为了避免覆盖父类的构造方法，先执行父类的构造方法
        parent::__construct();
        $username = session('user_name');
        $user = ' tom,li,admin';

        //判断它是否有权限访问
        dump($username);

        //有一些操作，允许在"退出的状态"也让访问
        $rang_ac = "Manager-login,Manager-verifyImg";

        $rang_ac = "Manager-login,Manager-verifyImg";
        $nowac = CONTROLLER_NAME . '-' . ACTION_NAME;
        dump(!strpos($user, $username));

        if (!strpos($user, $username) && !strpos($rang_ac, $nowac)) {
		echo(strpos($rang_ac, $nowac));
            echo(strpos($user, $username));
            $script = <<<eof
    <script>window.top.manager.href=user</script>
eof;
            //echo($script);
        }
    }

    //构造方法
    function __construct1111111()
    {
        //为了避免覆盖父类的构造方法，先执行父类的构造方法
        parent::__construct();
        //用户访问权限控制
        //获得当前正在访问的"控制器-操作方法 nowac"
        //判断nowac是否在用户的角色权限列表里边存在
        //① 当前请求的控制器-操作方法
        $nowac = CONTROLLER_NAME . "-" . ACTION_NAME;

        $admin_name = session('admin_name');
        //用户没有登录系统，就使其退出并进入到登录页面
        //有一些操作，允许在"退出的状态"也让访问
        $rang_ac = "Manager-login,Manager-verifyImg";
        //① 用户不在登录状态
        //② 用户的操作 还没有在$rang_ac出现
        if (empty($admin_name) && strpos($rang_ac, $nowac) === false) {
            //$this -> redirect('Manager/login');
            $js = <<<eof
                <script type="text/javascript">
                window.top.manager.href="/shop/index.php/Admin/Manager/login";
                </script>
eof;
            echo $js;
        }

        //② 获得当前用户对应角色的权限列表信息
        //用户----组别----权限
        //用户信息
        $admin_id = session('admin_id');
        $admin_info = D('Manager')->find($admin_id);
        //角色信息
        $role_id = $admin_info['mg_role_id'];
        $role_info = D('Role')->find($role_id);
        //拥有的权限信息
        $auth_ac = $role_info['role_auth_ac'];

        //设置默认允许访问的权限
        $allowac = "Manager-login,Manager-logout,Manager-verifyImg,index-left,index-right,index-head,index-index";

        //判断：$nowac是否在$auth_ac存在
        //strpos(大字符串，小字符串) 在一个大的字符串中判断一个小的字符串从左边开始第一次出现的位置
        //         "hello beijing tianjin beijing"   "beijing"
        //① 当前访问的权限没有在"角色对应的权限列表"
        //② 当前访问的权限也没有在"默认允许列表里边"
        //③ 当前用户还不能是超级管理员admin
        if (strpos($auth_ac, $nowac) === false && strpos($allowac, $nowac) === false && $admin_name !== 'admin') {
            exit('没有访问权限！');
        }
    }
}