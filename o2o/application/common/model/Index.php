<?php

namespace app\common\model;


class Index extends Base
{

    /**
     * @param $controller 控制器
     * @param $scene  验证场景
     * @param $data  验证数据
     */
    function validateInfo($controller, $scene, $data)
    {
        //判断参数是否有效
        if (empty($controller) || empty($scene) || empty($data)) {
            $this->error("参数错误");
            exit;
        }
        $validate = validate($controller);
        //验证字段是否符合规范
        if (!$validate->scene($scene)->check($data)) {
            $this->error($validate->getError());
            exit;
        };
    }

}