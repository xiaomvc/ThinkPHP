<?php

namespace app\index\controller;

use think\Controller;

class Life extends Controller{
    /**
     * 学无止境
     * 需求来源于生活
     * @return mixed
     */
    function learn(){
        return $this->fetch();
    }
}