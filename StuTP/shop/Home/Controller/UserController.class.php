<?php

namespace Home\Controller;
use Think\Controller;

class  UserController extends Controller
{
    //前台用户登录页面
    public function login()
    {
        $this->display();
    }

//登录验证
    public function register()
    {
        if (!empty($_POST)) {
            $user = new  \Model\UserModel();
            $data = $user->create();
            dump($data);
            dump($_POST);
            /*  array(11) {
                  ["username"] => string(0) ""
                  ["password"] => string(0) ""
                  ["password2"] => string(0) ""
                  ["user_email"] => string(0) ""
                  ["user_qq"] => string(0) ""
                  ["user_tel"] => string(0) ""
                  ["user_sex"] => string(1) "2"
                  ["user_xueli"] => string(1) "5"
                  ["user_hobby"] => array(2) {
                      [0] => string(1) "2"
                      [1] => string(1) "3"
              }
                   ["user_introduce"] => string(0) ""
                  ["Submit"] => string(0) ""
             }*/

            //判断文本框中的值是否符合规范
            if ($data) {
                //根据间隔逗号（，），合并数组
                $_POST['user_hobby'] = implode(',', $_POST['user_hobby']);

                dump($_POST);   //["user_hobby"] => string(3) "2,3"

                $z = $data->save($_POST);
                if ($z) {
                    dump("注册成功");
                } else {
                    dump($user->getError());
                }
            } else {
                dump($user->getError());
                $this->assign('errinfo', $user->getError());
            }
        }
        $this->display();
    }
}
