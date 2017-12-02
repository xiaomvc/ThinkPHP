<?php

namespace app\index\controller;


use orgVerify;

class Index extends Base
{
    public function index()
    {
        //获取城市栏目
        $city = model('city')->getFirstCityInfo();
        //判断session值是否为空
        if (session('cityId', '', 'o2o')) {
            $cityName = session('cityName', '', 'o2o'); //默认地区
            $cityId = session('cityId', '', 'o2o'); //默认地区id
        } else {
            $cityName = $city[2]['name']; //默认地区
            $cityId = $city[2]['id']; //默认地区id
        }
        //更换地区
        $cityIdInfo = input('cityId');
        if (!empty($cityIdInfo)) {

            $oneCityInfo = model('city')->getCityById($cityIdInfo);//获取一个城市信息，根据ID

            if ($oneCityInfo && !empty($oneCityInfo)) {
                $cityId = $cityIdInfo; //更改默认地区id
                $cityName = $oneCityInfo['name']; //更改默认地区
                //把当前城市的信息存放起来
                session('cityId', $cityId, 'o2o');
                session('cityName', $cityName, 'o2o');
            } else {
                //地区和id不变
            }
        }

        $userName = session('userName', '', 'o2o');//获取登录的用户名

        //获取一级分类栏目
        $firstCategory = model('Category')->getCategory();
        //获取二级分类栏目（这是所有二级分类栏目）
        $secondCategory = model('Category')->getSecondCategory();
        $dealInfo = model('BisFoods')->getDealByCityId($cityId);//根据城市ID，查找商家合同信息

        $bisIocation = model('bisLocation')->getLocation();//查找商家位置信息


        $category = [];//对二级分类栏目，按照父级id进行分类
        //根据一级商品栏目，进行分类
        foreach ($secondCategory as $k => $v) {
            //根据父级id，进行分类，二维数组中
            $category[$v->parent_id][] = [
                'id' => $v->id,
                'name' => $v->name,
                'listorder' => $v->listorder,
            ];
        }
//        dump($category);

        $deal = [];//商家合同信息的属性
        $categoryId = '';
        //根据商品栏目进行分类
        foreach ($dealInfo as $k => $v) {
            $categoryId = $categoryId . "," . $v['category_id'];
            $deal[$v['category_id']][] = $v;
        }
        //获取城市id相应的栏目信息
        $dealCategoryInfo = model('category')->getCategoryById(trim($categoryId, ','));

        $location = [];//商家位置信息
        //根据商家id，进行分类
        foreach ($bisIocation as $k => $v) {
            $location[$v['bis_id']][] = ['adress' => $v['api_address'], 'score' => $v['preview']];
        }

//      dump($dealCategoryInfo);exit;
        return $this->fetch('', [
            'city' => $city,
            'cityId' => $cityId,
            'cityName' => $cityName,
            'userName' => $userName,
            'firstCategory' => $firstCategory,
            'title' => "首页",
            'se_category' => $category,    //分类后的二级分类栏目
            'BisFoods' => $deal,    //分类后的商家合同信息
            'location' => $location,    //分类后的商家位置信息
            'dealCategoryInfo' => $dealCategoryInfo,    //相应城市的栏目分类
        ]);

    }

}
