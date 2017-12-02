<?php

namespace app\api\controller;

use think\Controller;

class Change extends Controller{
    /**
     * 一级城市下拉框改变时
     * 获取二级城市信息
     * @return bool
     */
    function cityChange()
    {
        $id = input('id');
        $data = model('city')->getSecondCityInfo($id);

        if ($data && !empty($data)) {
            return $data;
        }
        return false;
    }

    /**
     * 类别栏目改变时
     * @return mixed
     */
    function categoryChange()
    {
        $parentId = input('Id', 0, 'intval');
        $data = model('Category')->getCategory($parentId);

        if ($data && !empty($data)) {
            return ['1', $data];
        }
        return [0];
    }
}