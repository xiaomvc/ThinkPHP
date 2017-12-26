<?php

namespace Back\Controller;

use Think\Controller;

class GoodsController extends Controller
{

    function showlist()
    {
        $nav=array(
            'title'=>'商品展示',
            'first'=>'商品管理',
            'second'=>'商品列表',
            'linkTo'=>array(
                '添加商品','Goods/addlist',
            ),
        );
        $this->assign('nav',$nav);

        $this->display();
    }

    function addlist()
    {
        $nav=array(
            title=>'添加商品',
            first=>'商品管理',
            second=>'商品添加',
            linkTo=>array(
                '返回','Goods/showlist'
            ),
        );
        $this->assign('nav',$nav);


        $this->display();
    }

    function update()
    {
        $nav=array(
            title=>'修改商品',
            first=>'商品管理',
            second=>'商品修改',
            linkTo=>array(
                '返回','Goods/showlist'
            ),
        );
        $this->assign('nav',$nav);


        $this->display();
    }
}


