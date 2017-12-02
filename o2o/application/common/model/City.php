<?php

namespace app\common\model;

class City extends Base
{
    /**
     * 获取一级城市目录
     */
    function getFirstCityInfo()
    {

        return $this->where('status <> 0 and parent_id =0')->select();

    }

    /**
     * 获取二级城市目录
     * @param int $cityId
     * @return false|\PDOStatement|string|\think\Collection
     */
    function getSecondCityInfo($cityId=0)
    {
        $data = [
//            'status' => ['neq', 0],
            'parent_id' => ['gt', 0],
            'parent_id' => $cityId
        ];

        return $this->where($data)->select();
        //echo $this->getLastSql();
    }


    /**
     * 根据主键ID，获取一个城市信息
     * @param $id
     * @return array|false|\PDOStatement|string|\think\Model
     */
    function getCityById($id){
        return $this->where(['id'=>$id])->find();
    }
}