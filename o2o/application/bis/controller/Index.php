<?php

namespace app\bis\controller;


class Index extends Base
{
    public function index()
    {
        $id = session('bisId', '', 'bis');
        $name = session('bisName', '', 'bis');

        return $this->fetch('', ['title' => '商户中心', 'name' => $name, 'id' => $id]);
    }

    public function introduce()
    {
        return $this->fetch();
    }
}
