<?php

namespace Model;

use Think\Model;

class GoodsModel extends Model
{
    //自定义当前model操作的真实数据表名字
    // 实际数据表名（包含表前缀）
    //           protected $trueTableName    =   'english';
    //设置验证规则
    // 是否批处理验证
    protected $patchValidate = true;
    //自定义验证信息
    protected $_validate = array(
        array('goods_name', 'require', '名称不能为空'),
        array('goods_number', 'number', '库存数量格式不正确'),
        array('goods_weight', 'number', '商品重量格式不正确'),
        array('goods_price', 'number', '价格格式不正确'),

    );
}
