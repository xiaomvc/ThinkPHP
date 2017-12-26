<?php

namespace Model;

use Think\Controller;

class RegistModel extends Controller{








    protected function _after_insert($data,$options) {

        sendEmail();

    }
}