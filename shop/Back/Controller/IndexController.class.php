<?php

namespace Back\Controller;

use Think\Controller;

class IndexController extends Controller
{
    //重构（调用该控制器时，会先调用该构造方法）
    function __construct()
    {
        //该控制器，不调用 layout 布局
        layout(false);
        //此时要调用原来的构造方法，否则会报错
        parent::__construct();

        if (session('name')) {
            $username = session('name');
            $this->assign('name', $username);
        }


    }


    public function index()
    {
        $goods = D('goods');
        // dump($goods->getError());
        $this->display();

    }

    //RBAC权限
    //根据用户权限查看
    public function left()
    {
        //定义登录用户
        $name = '小明';
        session('name', $name);
        //用户ID
        $id = 2;
        //判断用户是否为最高管理员
        if ($name !== 'admin') {
            //多表查询语句
            $role = D('manager')->alias('m')->join('sw_role as r on m.mg_role_id=r.role_id')->field('r.role_auth_ids')->where('m.mg_id=' . $id)->find();
            //获得该用户，所拥有的权限（权限id 如:1,2,3）
            $role_id = $role['role_auth_ids'];
            //获取一级和二级权限（根据该用户所拥有的权限查询）
            $authA = D('auth')->where("auth_id in ($role_id) and auth_level=0")->select();
            $authB = D('auth')->where("auth_id in ($role_id) and auth_level=1")->select();

        } else {
            //获取一级和二级权限（最高管理员没有权限限制）
            $authA = D('auth')->where(" auth_level=0")->select();
            $authB = D('auth')->where(" auth_level=1")->select();

        }
        //填充到模板中
        $this->assign('authA', $authA);
        $this->assign('authB', $authB);
        $this->display();
    }

    function ringht()
    {
        $this->display();
    }

    function head()
    {

        $this->display();
    }
}