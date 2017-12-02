<?php

namespace app\index\controller;


class Lists extends Base
{
    function index()
    {
        //思路（一个典型案例）
        //  城市和用户名，获取一二级分类栏目，判断categoryId是几级栏目
        //  判断排序类型，model层数据处理，模板parentId.商品数据.分页处理（带参数）request()->param()
        $cityName = session('cityName', '', 'o2o');
        $userName = session('userName', '', 'o2o');
        if (empty($cityName)) {
            $cityName = "广东";
        }
        //获取一级分类栏目
        $firstCategory = model('Category')->getCategory();

        $id = input('categoryId', 0, 'intval');
//        dump($id);
        $data = [];//栏目判断信息
        $firstCatIds = [];//一级栏目所有的id值
        $categoryId=0;//一级栏目选中
        $se_categoryId=0;//二级栏目选中
        if ($id == 0) {
            //0为无效数据
            $categoryId = 0;//栏目id，id为0
        } else {
            //若获取全部时，，就不用进入这里
            foreach ($firstCategory as $k => $v) {
                $firstCatIds[] = $v->id;
            }
            //判断获取到的id是否存在存在数组中（处理栏目id）
            if (in_array($id, $firstCatIds)) {
                $data['category_id'] = $id;//判断为：一级栏目id
                $categoryId = $id;//栏目id
                $se_categoryId = $id;//栏目id

            } else {
                $data['se_category_id'] = $id;//判断为：二级栏目id
                $categoryData = model('category')->getOneCategory($id);//获取相应id
//                dump(model('Category')->getLastSql());exit;
                //判断是否有对应的一级栏目id
                if ($categoryData && $categoryData['status'] != 0) {
                    $data['category_id'] = $categoryData['parent_id'];//一级栏目id
                    $categoryId = $categoryData['parent_id'];//一级栏目id
                    $se_categoryId = $categoryData['id'];//二级栏目id
                }else{
                //获取不到数据时
                $categoryId = 0;//栏目id = 0
                }
            }
        }
        //若有一级栏目id时
        if (!empty($data['category_id'])) {
            //获取二级分类栏目（这是所有二级分类栏目）
            $secondCategory = model('Category')->getCategory($data['category_id']);
        } else {
            $secondCategory = '';
        }

        //获取定义的排序条件
        $order = [];//排序定义数组
        $buy_count = input('order_count');
        $current_price = input('order_price');
        $create_time = input('order_time');
        if (!empty($buy_count)) {
            $order['buy_count'] = $buy_count;
            $orderId = 'order_count';//默认选中排序
        } elseif (!empty($current_price)) {
            $order['current_price'] = $current_price;
            $orderId = 'order_price';//默认选中排序
        } elseif (!empty($create_time)) {
            $order['create_time'] = $create_time;
            $orderId = 'order_time';//默认选中排序
        } else {
            $orderId = '';//默认选中排序
        }


        //获取商品信息
        $dealInfo = model('BisFoods')->getDealByCategory($data, $order);
//
//        dump(model('BisFoods')->getLastSql());
//        exit;

        return $this->fetch('', [
            'cityName' => $cityName,//城市名称
            'userName' => $userName,//用户名
            'title' => "栏目分类",//标题

            'firstCategory' => $firstCategory,//一级栏目名称
            'secondCategory' => $secondCategory,//二级栏目名称
            'categoryId' => $categoryId,//一级栏目选中
            'se_categoryId' => $se_categoryId,//二级栏目选中
            'orderId' => $orderId,//排序选中
            'dealInfo' => $dealInfo,//商家商品信息
        ]);
    }
}