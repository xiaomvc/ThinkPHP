<?php

//设置格式
header("Content-type:text/html;charset=utf-8;");

define("APP_DEBUG", true);//开发模式
//define("APP_DEBUG", false);//生产模式

//样式，图片，脚本文件的绝对路径的常量
//前台的常量
define("CSS_URL", "/Home/Public/css/");
define("IMG_URL", "/Home/Public/images/");
define("JS_URL", "/Home/Public/js/");

//上传的图片路径
define('UP_IMG', '/public/uploads/');

//后台的常量
define('ADMIN_CSS_URL', '/Admin/Public/css/');
define('ADMIN_IMG_URL', '/Admin/Public/img/');
define('ADMIN_JS_URL', '/Admin/Public/js/');

include("../ThinkPHP/ThinkPHP.php");//引入TP框架

