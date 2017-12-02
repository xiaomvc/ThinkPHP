<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:57:"/data/o2o/public/../application/bis/view/index/index.html";i:1503931580;s:59:"/data/o2o/public/../application/bis/view/public/header.html";i:1505291238;s:56:"/data/o2o/public/../application/bis/view/public/nav.html";i:1505373002;s:57:"/data/o2o/public/../application/bis/view/public/menu.html";i:1504149467;}*/ ?>
﻿<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="Bookmark" href="/favicon.ico">
    <link rel="Shortcut Icon" href="/favicon.ico"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="__STATIC__/admin/lib/html5shiv.js"></script>
    <script type="text/javascript" src="__STATIC__/admin/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="__STATIC__/admin/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/admin/lib/Hui-iconfont/1.0.8/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/admin/skin/blue/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/admin/css/style.css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="__STATIC__/admin/lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <script type="text/javascript" src="__STATIC__/admin/lib/jquery/1.9.1/jquery.js"></script>
    <script type="text/javascript" src="__STATIC__/admin/lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="__STATIC__/admin/js/H-ui.min.js"></script>

    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="__STATIC__/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="__STATIC__/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
    <script type="text/javascript" src="__STATIC__/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>

    <script type="text/javascript" src="__STATIC__/admin/js/H-ui.admin.js"></script>
    <!--正则检验-->
    <script type="text/javascript" src="__STATIC__/common/check.js"></script>
    <script type="text/javascript" src="__STATIC__/common/common.js"></script>

    <script type="text/javascript" src="__STATIC__/admin/js/common.js"></script>
    <script type="text/javascript" src="__STATIC__/common/selectChange.js"></script>
	<title>o2o商家平台</title>



<title>o2o平台</title>
</head>
<body>

<script type="text/javascript" src="/static/common/common.js"></script>
<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <nav class="nav navbar-nav">
            <ul class="cl">
                <li style="font-size: 18px; padding-left: 20px;">o2o 平台</a>
                <!-- <li><a style="color:white" href="<?php echo url('admin/index/index'); ?>">后台中心</a></li>-->
		<li></li>
               <li><a style="color:white" href="<?php echo url('index/index/index'); ?>">前台首页</a></li>
                </li>
            </ul>
        </nav>
        <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
            <ul class="cl">
                <li><?php echo $title; ?></li>
                <li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A"><?php echo $name; ?> <i class="Hui-iconfont">&#xe6d5;</i></a>
                    <ul class="dropDown-menu menu radius box-shadow">
                        <li><a href="/bis/manager/index?id=<?php echo $id; ?>">个人信息</a></li>
                        <li><a href="javascript:confirm('确定吗')?exit('/bis/manager/exitLogin'):false;">切换账户</a></li>
                        <li><a href="javascript:confirm('是否退出')?exit('/bis/manager/exitLogin'):false;">退出</a></li>
                    </ul>
                </li>
                <li id="Hui-msg"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>
                <li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
                    <ul class="dropDown-menu menu radius box-shadow">
                        <li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
                        <li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
                        <li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
                        <li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
                        <li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
                        <li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    </div>
</header>
<aside class="Hui-aside">
    <div class="menu_dropdown bk_2">

        <dl id="menu-picture">
            <dt><i class="Hui-iconfont">&#xe613;</i> 商家管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a data-href="<?php echo URL('bis/manager/index?id='.$id); ?>" data-title="商家个人中心" href="javascript:void(0)">商家个人中心</a></li>
                    <li><a data-href="<?php echo URL('bis/deal/index?id='.$id); ?>" data-title="发布商品" href="javascript:void(0)">发布商品</a></li>
                </ul>
            </dd>

        </dl>

    </div>
</aside>

<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a>
</div>

<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a>
</div>
<section class="Hui-article-box">
    <div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
        <div class="Hui-tabNav-wp">
            <ul id="min_title_list" class="acrossTab cl">
                <li class="active">
                    <span title="我的桌面" data-href="welcome.html">我的桌面</span>
                    <em></em></li>
            </ul>
        </div>
        <div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S"
                                                  href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a
                id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a>
        </div>
    </div>
    <div id="iframe_box" class="Hui-article">
        <div class="show_iframe">
            <div style="display:none" class="loading"></div>
            <iframe scrolling="yes" frameborder="0" src="<?php echo url('index/introduce'); ?>"></iframe>
        </div>
    </div>
</section>

<div class="contextMenu" id="Huiadminmenu">
    <ul>
        <li id="closethis">关闭当前</li>
        <li id="closeall">关闭全部</li>
    </ul>
</div>

</body>
</html>