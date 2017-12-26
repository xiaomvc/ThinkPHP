<?php
return array(
	//'配置项'=>'配置值'

    //给项目做静态文件访问路由路径的配置
    //前台
    'CSS_URL' => '/Home/Public/style/',
    'JS_URL' => '/Home/Public/js/',
    'IMG_URL' => '/Home/Public/images/',
    //后台
    'BACK_CSS_URL' => '/Back/Public/css/',
    'BACK_JS_URL' => '/Back/Public/js/',
    'BACK_IMG_URL' => '/Back/Public/img/',

    //在页面底部设置跟踪信息
    'SHOW_PAGE_TRACE' =>true,

    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'shop',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '168168',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'sw_',    // 数据库表前缀
);