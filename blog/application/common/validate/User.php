<?php

namespace app\common\validate;

use think\Validate;

class User extends Validate
{
//    protected $batch = true;//全部验证
    //验证规则
    protected $rule = [
        ['openid', 'unique:user', 'openid重复'],
        ['username', 'require|unique:user', '用户名不能为空|用户名重复']
    ];
    //验证条件
    protected $scene = [
        'add' => ['openid']
    ];
}