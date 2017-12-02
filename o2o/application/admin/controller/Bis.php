<?php

namespace app\admin\controller;


class Bis extends Base
{
    private $obj;

    /**
     * 初始化
     */
    function _initialize()
    {
        $this->obj = model('Bis');
    }

    /**
     * 商家列表
     * @return mixed
     */
    function index()
    {
        //获取正常的和已删除的商家信息
        $bisInfo1 = $this->obj->getBisByStatus(1);
        $bisInfo2 = $this->obj->getBisByStatus(0);
        $bisInfo = [];//将两个对象的数据合并到一个数组中
        foreach ($bisInfo1 as $k => $v) {
            $bisInfo[] = $v;
        }
        foreach ($bisInfo2 as $k => $v) {
            $bisInfo[] = $v;
        }
        //dump($bisInfo);exit;
        if (!$bisInfo && !empty($bisInfo)) {
            $this->error('信息错误，请稍后再试。。。');
            exti;
        }
//        dump($bisInfo);
        return $this->fetch('', ['bisInfo' => $bisInfo]);
    }

    /**
     * 申请入驻商家
     * @return mixed
     */
    function apply()
    {
        $bisInfo = $this->obj->getBisByStatus(-1);

        if (!$bisInfo && !empty($bisInfo)) {
            $this->error('信息错误，请稍后再试...');
            exit;
        }
        return $this->fetch('', ['bisInfo' => $bisInfo]);
    }

    /**
     * 商家详细信息
     * @return mixed
     */
    function detail()
    {
        $data['id'] = input('id', 0, 'intval');
        $Info = $this->obj->getBisById($data['id'],'',true);//商户信息(已删除的商家也可以查询)

        if (!$Info && !empty($Info)) {
            $this->error('信息错误，请稍后再试。。。', URL('index'));
            exit;
        }

        $firstCityInfo = model('city')->getFirstCityInfo();//一级城市目录

        $secondCityInfo = model('city')->getSecondCityInfo($Info['city_id']);//二级城市目录

        $bisLocation = model('bisLocation')->getLocationById($Info['id']);//商户的位置信息

        $firstCategory = model('category')->getCategory();//一级分类栏目

        $secondCategory = model('category')->getCategory($bisLocation['category_id']);//二级分类栏目

        //判断类别路径中有没有逗号（有没有二级目录）
        $category_path = 0;
        if (substr_count($bisLocation['category_path'], ',') > 0) {
            $category_path = explode(',', $bisLocation['category_path'])[1];//通过逗号拆分
        };

        //二级城市目录id（判断路径中有没有二级城市）
        $city_path = -1;
        if (substr_count($Info['city_path'], ',') > 0) {
            $city_path = explode(',', $Info['city_path'])[1];
        }


        return $this->fetch('',
            ['Info' => $Info,       //商户信息
                'firstCityInfo' => $firstCityInfo,      //一级城市
                'secondCityInfo' => $secondCityInfo,    //二级城市
                'city_path' => $city_path,      //二级城市id路径
                'bisLocation' => $bisLocation,      //商户位置信息
                'firstCategory' => $firstCategory,      //一级类别
                'secondCategory' => $secondCategory,        //二级类别
                'category_path' => $category_path       //二级类别的id路径
            ]
        );
    }

    /**
     * 删除商家信息
     * @return bool
     */
    function del()
    {
        $data['id'] = input('id', 0, 'intval');
        $data['status'] = 0;
        //获取相应的控制器
        $controller = request()->controller();
        $res = $this->obj->status($data, $controller);

        if ($res) {
            //  return ['success'=>1];
            return true;
        }
        return false;
    }

    /**
     * 修改商户的状态
     */
    function status()
    {
        $data['id'] = input('id');
        $data['status'] = input('status');

        //修改栏目状态信息
        //获取控制器
        $controller = Request()->controller();
        $status = model('category')->status($data, $controller);
        if ($status && !empty($status)) {
            $this->success('修改成功');
        }
        $this->error("修改失败");
    }
}