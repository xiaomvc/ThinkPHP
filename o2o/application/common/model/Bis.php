<?php

namespace app\common\model;

class Bis extends Base
{
    /**
     * 根据状态查询商家信息
     * @param int $status
     * @return false|\PDOStatement|string|\think\Collection
     */
    function getBisByStatus($status = 1)
    {
        $data = [
            'status' => $status
        ];
        //paginate（数量）分页
        return $this->where($data)->select();
    }

    /**
     * 根据ID查询商家信息
     * @param int $id
     * @param int $status
     * @return false|\PDOStatement|string|\think\Collection
     */
    function getBisById($id = 0, $status = 0, $flag = false)
    {
        if ($flag) {
            return $this->where(['id' => $id])->find();
        }
        return $this->where(['status' => ['neq', $status], 'id' => $id])->find();
        //echo $this->getLastSql();

    }

    /**
     * 更改状态
     * @param $data
     * @param $controller
     * @return bool|false|int
     */
    function status($data, $controller)
    {
        return parent::status($data, $controller); // TODO: Change the autogenerated stub
    }

    //通过名字查找商户信息
    function getBisByName($name, $id = 0, $flag = false)
    {
        if ($flag) {
            return $this->where(['name' => $name, 'id' => ['neq', $id]])->find();
        }
        return $this->where(['name' => $name])->find();
    }

    /**
     * 添加商户
     * @param $data
     * @return false|int
     */
    function addBis($data)
    {
        $this->save($data);
        return $this->getLastInsID();
    }

    /**
     * 修改商户
     * @param $data
     * @return false|int
     */
    function updateBis($bisId, $data)
    {
        return $this->where(['id' => $bisId])->update($data);
    }

}

