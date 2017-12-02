<?php

namespace app\common\model;

use think\Model;


class Base extends Model
{
    //自动填充时间
    protected $autoWriteTimestamp = true;
    protected $batchValidate = true;

    /**
     * 验证字段的方法
     * @param $controller 控制器
     * @param $scene 验证场景
     * @param $data 验证数据
     * @return array|null
     */
    function validateInfo($controller, $scene, $data)
    {
        //判断参数是否有效
        if (empty($controller) || empty($scene) || empty($data) || !is_array($data)) {
            return '参数错误';
        }
        //验证字段是否符合规范
        $validate = validate($controller);

        if (!$validate->scene($scene)->check($data)) {
            return $validate->getError();

        };
        return null;
    }

    /**
     * 修改状态信息，也可用作逻辑删除
     * @param $controller
     * @param $data
     * @return bool|false|int
     */
    function status($data, $controller)
    {
        $dataInfo = [
            'status' => $data["status"],
            'id' => $data["id"]
        ];
        //实例化不同的模型model
        return model($controller)->save(['status' => $dataInfo['status']], ['id' => $dataInfo['id']]);
    }

    /**
     * 通过bisId修改商户状态
     * @param $controller
     * @param $data
     * @return mixed
     */
    function statusByBis($controller, $data)
    {
        return model($controller)->where(['bis_id' => $data['id']])->save(['status' => $data['status']]);
    }
}