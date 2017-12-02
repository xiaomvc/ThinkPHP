<?php

namespace app\common\validate;

use think\Validate;

/**
 * Category分类的属性验证信息
 * Class Category
 * @package app\admin\validate
 */
class Category extends Validate
{
    //字段验证规则
    protected $rule = [
        ['id', 'require|number|egt:1', 'ID不能为空|ID必须为数字|ID必须大于等于1', 1],
        ['name', 'require', '分类名不能为空', 1],
        //require和unique这两个规则不可以写在一起！！
       // ['name', '', '分类名已存在', 1, 'unique'],
        ['parent_id', 'require|egt:0|number', '父级不能为空|父级状态不合法|父级状态必须为数字', 1],
        ['status', 'require|in:0,1,-1|number', '状态不能为空|状态不合法|状态必须为数字', 1]
    ];
    //设置验证场景
    protected $scene = [
        'add' => ['name', 'parent_id', 'status'],
        'edit' => ['id', 'name', 'parent_id'],
        'del' => ['id', 'status'],
        'status' => ['id', 'status'],
        'show' => ['parent_id'],
        'editInfo'=>['id']
    ];
}