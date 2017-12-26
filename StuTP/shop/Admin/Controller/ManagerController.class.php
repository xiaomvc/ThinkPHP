<?php

namespace Admin\Controller;

use function PHPSTORM_META\type;
use Think\Controller;
use Think\Verify;

class  ManagerController extends Controller
{
//管理员（后台）登录页面
    public function login()
    {
        if ($_POST) {
            dump($_POST);
            //调用Think中的Verify的类，生成验证码
            $ver = new Verify();
            //通过Verify中的check方法，检验验证码是否正确
            if ($ver->check($_POST['verifyImg'])) {
                dump('验证码正确');
                //where判断条件
                $user = array(
                    'mg_name' => $_POST['mg_name'],
                    'mg_pwd' => $_POST['mg_pwd']
                );
                $manager = D('manager');
                $userInfo = $manager->where($user)->find();
                dump($userInfo);
                //判断账号和密码是否正确
                if ($userInfo) {
                    //账号和密码存储在session中
                    session('user_name', $_POST['mg_name']);
                    session('user_pwd', $_POST['mg_pwd']);

                    $this->redirect('index/index', array(), 3, '登陆成功');

                } else {
                    dump('账号或密码错误');
                }

            } else {
                dump('验证码错误');
            }
        }
       $this->display();
    }

//创建验证码的图片
    function verifyImg()
    {
        $arg = array(
            'fontSize' => 14,              // 验证码字体大小(px)
            'imageH' => 30,               // 验证码图片高度
            'imageW' => 100,               // 验证码图片宽度
            'length' => 4,               // 验证码位数
            'fontttf' => '5.ttf',              // 验证码字体，不设置随机获取
        );
        $Img = new Verify($arg);
        //生成验证码图片
        $Img->entry();
    }
}