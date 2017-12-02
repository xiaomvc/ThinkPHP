<?php

namespace app\common\validate;

use think\Validate;

/**
 * Category分类的属性验证信息
 * Class Category
 * @package app\admin\validate
 */
class Share extends Validate
{
    //字段验证规则
    //'unique:share'其中的share为数据库表名
    //如果验证的数据中有主键值，不会对自己进行验证
    protected $rule = [
        ['id', 'require|number|egt:1', 'ID不能为空|ID必须为数字|ID必须大于1', 1],
        ['title', 'unique:share', '书的标题重复'],
        ['logo', 'require', '图片不能为空', 1],
        ['url', 'require|url', '地址不能为空|地址格式不正确', 1],
        ['produce_time', 'require|number', '发布时间不能为空|发布时间格式不正确', 1],
        ['introduce', 'require', '图书介绍不能为空', 1],
        ['status', 'require|in:0,1,-1|number', '状态不能为空|状态不合法|状态必须为数字', 1]
    ];
    //设置验证场景
    protected $scene = [
        'add' => ['title', 'logo', 'url', 'produce_time', 'introduce'],
        'edit' => ['id','title', 'logo', 'url', 'produce_time', 'introduce'],
        'del' => ['id', 'status'],
        'check' => ['title', 'id'],
    ];
}