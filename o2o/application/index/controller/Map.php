<?php

namespace app\index\controller;

class Map extends Base
{
    function getImage($center)
    {
        $image = \Map::getStaticImage($center);

        if ($image) {
            return $image;
        }
        return "/static/index/images/404.jpg";
    }
}