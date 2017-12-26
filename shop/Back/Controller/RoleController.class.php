<?php

namespace Back\Controller;

use Think\Controller;

class RoleController extends Controller
{
    //显示用户权限
    function showlist()
    {
        //创建数组，可以动态更改布局中的数据
        $nav = array(
            'title' => '角色管理',
            'first' => '角色管理',
            'second' => '角色列表',
            'linkTo' => array(
                '添加角色', 'Role/addRole',
            ),
        );
        $this->assign('nav', $nav);

        $role = D('role');
        $show = $role->select();

        $this->assign('showlist', $show);

        //        dump($show);
        $this->display();
    }

    //更改用户的权限
    function upRole()
    {
        //判断是获取用户数据，还是提交用户数据
        //GET  或  POST 方式
        if (IS_POST) {
            //通过get的方式，获取地址栏中role_id的数据,默认为0
            //www.shop.com/admin/role/upRole/role_id/101
            $roleid = I('get.role_id', 0);
            //获取二级权限下的数据
            //复选框中的数据，此处的数据为数组
            /* array(2) {
              [0] => string(2) "21"
              [1] => string(2) "31"
              } */
            $auth_ids = $_POST['auth_ids'];
            //将数组信息转化为字符串，格式为：1,3,4,5
            $auth_id = implode(',', $auth_ids);

            //通过获取到的二级目录中的数据，查找相对应的一级目录（权限）的数据（id值）
            $auth_pid = D('auth')->where("auth_id in ({$auth_id}) and auth_level=1")->field('auth_pid')->select();

            //将一级目录的数据添加到二级目录中的数组中
            //再通过逗号的形式，组合为字符串
            foreach ($auth_pid as $k => $v) {
                //判断一级目录中的数据，是否存在重复
                if (!in_array($v['auth_pid'], $auth_ids)) {
                    array_push($auth_ids, $v['auth_pid']);
                }
            }

            //再通过逗号的形式，将一二级目录的数据组合为字符串
            //如: 12.，10,23，2，56
            $auth_ids = implode(',', $auth_ids);

            //查找相对应的控制器和方法
            $auth = D('auth')->where("auth_id in ({$auth_ids}) and auth_level=1")->field('auth_a,auth_c')->select();

            //将控制器和方法，进行组合
            $auth_ac = "";
            foreach ($auth as $k => $v) {
                $ac = $v['auth_c'] . "-" . $v['auth_a'];
                $auth_ac = $auth_ac . $ac . ",";

            }
            //去除，逗号
            $auth_ac = rtrim($auth_ac, ",");

            //创建数组，内容与数据库表中的内容相对应
            $data = array(
                'role_id' => $roleid,
                'role_auth_ids' => $auth_ids,
                'role_auth_ac' => $auth_ac,
            );
            //保存/更改数据（通过role_id(主键id值)）
            $s = D('role')->save($data);
            //判断是否更改成功（0或1，当重复修改相同的内容时，tp框架会有限制，这时为1，修改失败）
            if ($s) {
                $this->success('修改成功', U('showlist'), 3);
            } else {
                dump($roleid);
                $this->success('修改失败', U('showlist', array('role_id', 333)), 5);
            }

        } else {

            //动态更改layout布局中的数据
            $nav = array(
                'title' => '角色权限管理',
                'first' => '权限管理',
                'second' => '权限列表',
                'linkTo' => array(
                    '返回', 'Role/showlist',
                ),
            );
            $this->assign('nav', $nav);

            //获取参数role_id中的值，默认为0
            $roleid = I('role_id', 0);
            //通过role_id,查找该用户的权限
            $showlist = D('role')->find($roleid);
            //  $rname = $showlist['role_name'];该用户名

            $this->assign('showlist', $showlist);

            //查找所有的一二级目录（权限）的数据，在HTML中填充到复选框中
            $authA = D('auth')->where('auth_level=0')->select();
            $authB = D('auth')->where('auth_level=1')->select();


            $this->assign('authA', $authA);
            $this->assign('authB', $authB);

        }

        $this->display();
    }
}