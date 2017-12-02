<?php

namespace app\common\model;


class BisLocation extends Base
{
    /**
     * 通过bis_id查商户的位置信息
     * @param $bisId
     * @return array|false|\PDOStatement|string|\think\Model
     */
    function getLocationById($bisId, $flag = false)
    {
        if ($flag) {
            return  $this->where(['bis_id' => $bisId])->find();

        }
        return $this->where(['status' => ['neq', 0], 'bis_id' => $bisId])->find();
    }
    /**
     * 通过bis_id查商户的位置信息
     * @param $bisId
     * @return array|false|\PDOStatement|string|\think\Model
     */
    function getLocationsById($bisId, $flag = false)
    {
        if ($flag) {
            return  $this->where(['bis_id' => $bisId])->select();

        }
        return $this->where(['status' => ['neq', 0], 'bis_id' => $bisId])->select();
    }

    /**
     * 获取所有商家位置信息
     * @return false|\PDOStatement|string|\think\Collection
     */
    function getLocation()
    {
        return $this->where(['status' => ['neq', 0]])->select();
    }

    /**
     * 获取商家位置信息，通过ids
     * @return false|\PDOStatement|string|\think\Collection
     */
    function getBisByLocationids($ids = [])
    {
        return $this->where(['id' => ['in', $ids]])->select();

    }

    /**
     * 添加商户的位置信息
     * @param $data
     * @return false|int
     */
    function addBis($data)
    {
        return $this->save($data);
    }

    /**
     * 修改商户的位置信息
     * @param $data
     * @return false|int
     */
    function updateBis($bisId, $data)
    {
        return $this->where(['bis_id' => $bisId])->update($data);
    }

}