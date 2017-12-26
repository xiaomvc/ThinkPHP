<?php

namespace Model;

use Think\Model;

class UserModel extends Model
{
    //model中的 字段映射定义
    /*protected $_map = array(
        'name' => 'user_name',
        'pwd' => 'user_pwd'
    );*/

    //自动完成（填充字段信息）
    protected $_auto = array(
        array('add_time', 'time', 1, 'function'),
        array('user_pwd', md5, 1, 'function')
    );


    protected $patchValidate = true;
    //设置验证条件
    protected $_validate = array(

        //为表单域定义具体验证规则
        //① 验证用户名，非空
        //array(字段名称 表单域name属性值，验证规则，错误提示[，验证条件，附加规则，验证时间])
        array('username', 'require', '用户名不能为空'),
        array('username', '', '用户名已存在', 2, 'unique'),//1：为必须验证 2：当文本框不为空的时候验证
        array('password', 'require', '密码不能为空'),
        array('password2', 'password', '密码不一致', 0, confirm),
        array('user_email', 'email', '邮箱格式不正确'),
        array('user_qq', 'number', 'qq只能为数字'),
        array('user_tel', '5,12', '电话格式不正确', 0, 'length'),
        array('user_xueli', '2,3,4,5,', '请选择学历', 0, 'in'),
        //         通过当前模型类的一个方法进行验证
        array('user_hobby', 'check_hobby', '爱好必须选两个，或以上', 1, 'callback')
    );

    function check_hobby($arg)
    {
        if (count($arg) > 2) {
            return true;
        } else {
            return false;
        }

    }
}