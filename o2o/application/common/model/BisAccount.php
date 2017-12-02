<?php

namespace app\common\model;

class BisAccount extends Base
{
    /**
     * 添加商户账号信息
     * @param $data
     * @return false|int
     */
    function addBis($data)
    {
        return $this->save($data);
    }

    function getBis($name, $bis_id = 0, $flag = false)
    {
        if ($flag) {
            return $this->where(['username' => $name, 'bis_id' => ['neq', $bis_id]])->find();

        }

        return $this->where(['username' => $name])->find();
    }

    /**
     * 判断商家激活的条件
     * @param $id
     * @param $code
     * @return array|false|\PDOStatement|string|\think\Model
     */
    function jihuo($id, $code)
    {
        return $this->where(['id' => $id, 'code' => $code])->find();
    }

    /**
     * 修改商户
     * @param $data
     * @return false|int
     */
    function updateBis($bisId, $data)
    {
        return $this->where(['bis_id' => $bisId])->update($data);
    }

    /**
     * 通过bis_id查商户的账号信息
     * @param $bisId
     * @return array|false|\PDOStatement|string|\think\Model
     */
    function getAccountLocationById($bisId, $flag = false)
    {
        if ($flag) {
            return $this->where(['bis_id' => $bisId])->find();

        }
        return $this->where(['status' => ['neq', 0], 'bis_id' => $bisId])->find();
    }

}