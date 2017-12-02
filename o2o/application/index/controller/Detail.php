<?php

namespace app\index\controller;


class Detail extends Base
{
    public function index()
    {

        //头部信息需要的属性
        //获取城市栏目
        $city = model('city')->getFirstCityInfo();
        //判断session值是否为空
        if (session('cityId', '', 'o2o')) {
            $cityName = session('cityName', '', 'o2o'); //默认地区
        } else {
            $cityName = $city[2]['name']; //默认地区
        }

        $userName = session('userName', '', 'o2o');//获取登录的用户名
        //获取商品id，获取店铺和位置信息，分类栏目信息，计算开始、结束时间，获取百度地图

        $id = input('id', 0, 'intval');
        //商家商品信息
        $bisFoods = model('BisFoods')->getDealById($id);
        $locationInfo = '';//商家位置信息
        //判断是否为该数据
        if ($bisFoods && $bisFoods[0]['status'] == 1) {
            $locationInfo = model('bisLocation')->getBisByLocationids($bisFoods[0]['location_ids']);

        } else {
            $this->Error('参数错误');
        }
        //栏目信息
        $category = model('category')->getOneCategory($bisFoods[0]['category_id']);
        //商户名称信息
        $bis = model('bis')->getBisById($bisFoods[0]['bis_id']);
        $bisName = $bis['name'];

        //数据库开始时间。结束时间
        $start_time = $bisFoods[0]['start_time'];
        $end_time = $bisFoods[0]['end_time'];

        //计算后获取的开始结束时间
        $start = [];
        $end = [];

        //如果开始时间，大于当前时间
        if ($start_time == 0) {
            $start['success'] = 0;
            $time = 0;
        } elseif ($start_time >= time()) {
            $start['success'] = 1;
            $time = $start_time - time();

        } else {
            $start['success'] = -1;
            $time = time() - $start_time;

        }

        //开始的 天时分秒
        $start['d'] = floor($time / (60 * 60 * 24));
        $start['h'] = floor($time % (60 * 60 * 24) / (60 * 60));
        $start['m'] = floor($time % (60 * 60 * 24) % (60 * 60) / 60);
        $start['i'] = $time % (60 * 60 * 24) % (60 * 60) % 60;

        //如果结束时间，大于当前时间
        if ($end_time == 0) {
            $end['success'] = 0;//判断当前是什么状态
        } elseif ($end_time >= time()) {
            $end['success'] = 1;
        } else {
            $end['success'] = -1;
        }
        //获取静态图片要另写一个方法，在HTML中直接呈现，否则会乱码
        //$image = \Map::getStaticImage("116,40.1490726989");

        $center = [];
        foreach ($locationInfo as $k => $v) {
            $center[] = $v['xpoint'] . ',' . $v['ypoint'];
        }
//        dump($center);
        return $this->fetch('', [
            'cityName' => $cityName,
            'userName' => $userName,
            'title' => $bisName,//商家名称和标题名称
            'category' => $category,//栏目信息
            'bisFoods' => $bisFoods,//商家商品
            'locationInfo' => $locationInfo,//商店位置
            'center' => $center,//坐标
            'start' => $start,//开始时间
            'end' => $end,//结束时间
        ]);
    }

}
