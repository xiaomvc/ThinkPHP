<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {

       //$goods=D('goods');
       // dump($goods->getError());
        $this->display();

    }

}