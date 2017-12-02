<?php

namespace app\bis\controller;


class Deal extends Base
{
    /**
     * 商家发布的商品
     * @return mixed
     */
    function index()
    {
        $bis = $this->getLoginUser();
        $bisId = $bis['bisId'];

        $bis = model('bisFoods')->getDealByBidId($bisId);

        return $this->fetch('', ['bis' => $bis]);
    }

    /**
     * 添加商品
     * @return mixed
     */
    function add()
    {
        $bis = $this->getLoginUser();
        $bisId = $bis['bisId'];
        //商家位置
        $getLocations = model('bisLocation')->getLocationsById($bisId);
        if (!$getLocations) {
            $this->error('没有该商家位置信息');
        }

        if (input('post.')) {

            $xpoint = $getLocations[0]['xpoint'];
            $ypoint = $getLocations[0]['ypoint'];
            $bisAccount = model('BisAccount')->getAccountLocationById($bisId, true);
            if (!$bisAccount) {
                $this->error('没有该商家账号信息');
            }
            $bis_account_id = $bisAccount['id'];
            $data = [
                'name' => input('name'),
                'category_id' => input('category_id'),
                'se_category_id' => empty(input('se_category_id')) ? input('category_id') : input('category_id') . ',' . input('se_category_id'),
                'bis_id' => $bisId,
                'location_ids' => count($_POST['location_ids']) > 1 ? implode(',', $_POST['location_ids']) : $_POST['location_ids'][0],
                'image' => input('image'),
                'description' => input('description'),
                'start_time' => strtotime(input('start_time')),
                'end_time' => strtotime(input('end_time')),
                'origin_price' => input('origin_price'),
                'current_price' => input('current_price'),
                'city_id' => empty(input('se_city_id')) ? input('city_id') : input('se_city_id'),
                'total_count' => input('total_count'),
                'coupons_begin_time' => strtotime(input('coupons_start_time')),
                'coupons_end_time' => strtotime(input('coupons_end_time')),
                'xpoint' => $xpoint,
                'ypoint' => $ypoint,
                'bis_account_id' => $bis_account_id,
                'notes' => input('notes'),
            ];
//            dump($data);
            $foods = model('bisFoods')->add($data);
            if ($foods === false) {
                $this->error('添加失败', url('bis/deal/index'));
            }

            $this->success('添加成功', url('bis/deal/index'));

        }

        $firstCityInfo = model('city')->getFirstCityInfo();//一级城市目录
        $secondCityInfo = model('city')->getSecondCityInfo($getLocations[0]['city_id']);//二级城市目录

        $firstCategory = model('category')->getCategory();//一级分类栏目
        $secondCategory = model('category')->getSecondCategorys($getLocations[0]['category_id']);//二级分类栏目
        //二级城市和栏目信息
        $city_path = $getLocations[0]['city_path'];
        $category_path = $getLocations[0]['category_path'];

        //检查二级城市和二级栏目
        if (substr_count($city_path, ',') > 0) {
            $city_path = explode(',', $city_path)[1];
        }
        if (substr_count($category_path, ',') > 0) {
            $category_path = explode(',', $category_path)[1];
        }
//        dump($category_path);exit;
        return $this->fetch('', [
                //一二级城市和二级城市id
                'citys' => $firstCityInfo,
                'secondCityInfo' => $secondCityInfo,
                'city_path' => $city_path,
                //一二级栏目和二级栏目id
                'categorys' => $firstCategory,
                'secondCategory' => $secondCategory,
                'category_path' => $category_path,
                //商家位置信息
                'getLocations' => $getLocations
            ]

        );
    }

    //商品发布详情
    function detail()
    {
        $id = input('id', 0, 'intval');
        //商品信息
        $foods = model('BisFoods')->getDealById($id);
        if (!$foods) {
            $this->error('状态错误');
        }

        $bis = $this->getLoginUser();//登录的用户信息
        $bisId = $bis['bisId'];
        //不能跨商家访问
        if ($foods[0]['bis_id'] !== $bisId) {
            $this->error('只能查看自己的商品信息', url('bis/index/index'));
        }

        //商家位置
        $getLocations = model('bisLocation')->getLocationsById($bisId);
        if (!$getLocations) {
            $this->error('状态错误');
        }

        $firstCityInfo = model('city')->getFirstCityInfo();//一级城市目录
        $flag = false;
        $secondCityInfo = [];//二级城市目录
        $cityInfo = [];//选中的城市id
        //判断是否在一级城市中
        foreach ($firstCityInfo as $k => $v) {
            if ($v->id == $foods[0]['city_id']) {
                $cityInfo['cityId'] = $foods[0]['city_id'];
                $flag = true;
            }
        }
        //城市id不在一级城市列表中
        if (!$flag) {
            //根据主键获取父级id
            $secondCityInfo = model('city')->getCityById($foods[0]['city_id']);
            //二级城市目录
            $secondCityInfo = model('city')->getSecondCityInfo($secondCityInfo['parent_id']);
            $cityInfo['cityId'] = $secondCityInfo[0]['parent_id'];
            $cityInfo['se_cityId'] = $foods[0]['city_id'];
        }


        $firstCategory = model('category')->getCategory();//一级分类栏目
        $secondCategory = model('category')->getSecondCategorys($foods[0]['category_id']);//二级分类栏目

        //二级栏目信息
        $category_path = $foods[0]['se_category_id'];


        //检查二级栏目
        if (substr_count($category_path, ',') > 0) {
            $category_path = explode(',', $category_path)[1];
        }


        return $this->fetch('',
            [
                //商品信息
                'foods' => $foods,
                //一二级城市和二级城市id
                'citys' => $firstCityInfo,
                'secondCityInfo' => $secondCityInfo,
                'cityInfo' => $cityInfo,
                //一二级栏目和二级栏目id
                'categorys' => $firstCategory,
                'secondCategory' => $secondCategory,
                'category_path' => $category_path,
                //商家位置信息
                'getLocations' => $getLocations
            ]);
    }

}