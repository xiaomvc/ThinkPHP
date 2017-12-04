<?php

namespace app\index\controller;

class About extends Base
{
    /**
     * 关于我
     * just about me
     * @return mixed
     */
    function me()
    {
        $file = "me.html";
        if (!file_exists($file)) {
            $data = $this->fetch();
            $result = $this->setHtml($file, $data);
        }
        $this->header($file);
    }
}