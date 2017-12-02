<?php

namespace app\common\model;

use think\Model;

class Base extends Model
{
    //自动写入时间字段
//    protected $autoWriteTimestamp=true;
    /**
     * 验证数据是否正确
     * @param $controller   相应的控制器
     * @param $scene    验证场景
     * @param $data     验证数据
     * @param bool $batch 是否全部验证
     * @return null
     */
    function setValidate($controller, $scene, $data, $batch = false)
    {
        //实例化相应的validate对象
        $setValidate = validate($controller);
        //设置是否验证全部
        $setValidate->batch($batch);
        //进行验证数据
        $result = $setValidate->scene($scene)->check($data);
        //错误就返回错误信息
        if (!$result) {
            return $setValidate->getError();
        }
        return null;
    }

}