<?php

namespace Back\Controller;

use Think\Controller;

class TypeController extends Controller
{

    function showlist()
    {

        //动态更改layout布局中的数据
        $nav = array(
            'title' => '类型管理',
            'first' => '类型管理',
            'second' => '类型列表',
            'linkTo' => array(
                '返回', 'javescript:;',
            ),
        );
        $this->assign('nav', $nav);

        $type = D('type')->select();
        //dump($type);
        $this->assign('type', $type);

        $this->display();
    }

    function showType()
    {
        $type_id = I('get.type_id');

        $data = D('auth')->limit($type_id, 3)->select();

        echo json_encode($data);
    }

}