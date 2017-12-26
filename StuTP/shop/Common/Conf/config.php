<?php
return array(
    //'配置项'=>'配置值'

    //在页面底部设置显示跟踪信息
    'SHOW_PAGE_TRACE' => true,

    //设置请求的默认分组
    'DEFAULT_MODULE' => 'Home',  // 默认模块
    'DEFAULT_CONTROLLER' => 'index', // 默认控制器名称
    'DEFAULT_ACTION' => 'index', // 默认操作名称

    'MODULE_ALLOW_LIST' => array('Home', 'Admin'), //设置一个对比的分组列表

    'TMPL_ENGINE_TYPE' => 'smarty',     // 设置默认模板引擎

    /* //给Smarty做相关配置
     'TMPL_ENGINE_CONFIG' => array(
         'left_delimiter' => '<%%%',
         'right_delimiter' => '%%%>',
     ),*/

    /* 数据库设置 */
    'DB_TYPE' => 'mysql',     // 数据库类型
    'DB_HOST' => 'localhost', // 服务器地址
    'DB_NAME' => 'shop',          // 数据库名
    'DB_USER' => 'root',      // 用户名
    'DB_PWD' => '168168',          // 密码
    'DB_PORT' => '',        // 端口
    'DB_PREFIX' => 'sw_',    // 数据库表前缀
);




