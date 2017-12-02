<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:59:"/data/o2o/public/../application/admin/view/index/index.html";i:1503944711;s:61:"/data/o2o/public/../application/admin/view/public/header.html";i:1504418558;s:58:"/data/o2o/public/../application/admin/view/public/nav.html";i:1503945269;s:59:"/data/o2o/public/../application/admin/view/public/menu.html";i:1504348857;}*/ ?>
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
    <script type="text/javascript" src="__STATIC__/admin/js/common.js"></script>
    <script type="text/javascript" src="__STATIC__/common/selectChange.js"></script>

    <!--&lt;!&ndash;//定义的方法&ndash;&gt;-->
    <!--<script type="text/javascript">-->
        <!--/*个人信息*/-->
        <!--function myselfinfo() {-->
            <!--layer.open({-->
                <!--type: 1,-->
                <!--area: ['300px', '200px'],-->
                <!--fix: false, //不固定-->
                <!--maxmin: true,-->
                <!--shade: 0.4,-->
                <!--title: '查看信息',-->
                <!--content: '<div>管理员信息</div>'-->
            <!--});-->
        <!--}-->

        <!--/*资讯-添加*/-->
        <!--function article_add(title, url) {-->
            <!--var index = layer.open({-->
                <!--type: 2,-->
                <!--title: title,-->
                <!--content: url-->
            <!--});-->
            <!--layer.full(index);-->
        <!--}-->

        <!--/*图片-添加*/-->
        <!--function picture_add(title, url) {-->
            <!--var index = layer.open({-->
                <!--type: 2,-->
                <!--title: title,-->
                <!--content: url-->
            <!--});-->
            <!--layer.full(index);-->
        <!--}-->

        <!--/*产品-添加*/-->
        <!--function product_add(title, url) {-->
            <!--var index = layer.open({-->
                <!--type: 2,-->
                <!--title: title,-->
                <!--content: url-->
            <!--});-->
            <!--layer.full(index);-->
        <!--}-->

        <!--/*用户-添加*/-->
        <!--function member_add(title, url, w, h) {-->
            <!--layer_show(title, url, w, h);-->
        <!--}-->

        <!--//处理表格数据，-->
        <!--//            $('.table-sort').dataTable({-->
        <!--//                "aaSorting": [[2, "desc"]],//默认第几个排序-->
        <!--//                "bStateSave": true,//状态保存-->
        <!--//                "aoColumnDefs": [-->
        <!--//                    //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示-->
        <!--//                    {"orderable": false, "aTargets": [0, 4]}// 制定列不参与排序-->
        <!--//                ]-->
        <!--//            });-->


        <!--&lt;!&ndash;请在下方写此页面业务相关的脚本&ndash;&gt;-->


        <!--/*系统-栏目-添加*/-->
        <!--function add_info(title, url, w, h) {-->
            <!--layer_show(title, url, w, h);-->
        <!--}-->

        <!--/*系统-栏目-编辑*/-->
        <!--function edit_info(title, url, id, w, h) {-->
            <!--layer_show(title, url, w, h);-->
        <!--}-->

        <!--/*系统-栏目-删除*/-->
        <!--function del_info(obj, id, url) {-->
            <!--layer.confirm('确认要删除吗？', function (index) {-->
                <!--$.ajax({-->
                    <!--type: 'POST',-->
                    <!--url: url,-->
                    <!--data: {'id': id},-->
                    <!--dataType: 'json',-->
                    <!--success: function (data) {-->
                        <!--//  alert(data['success']);-->
                        <!--if (data) {-->
                            <!--$(obj).parents("tr").remove();-->
                            <!--layer.msg('已删除!', {icon: 1, time: 1000});-->
                        <!--}-->

                    <!--},-->
                    <!--error: function (data) {-->
                        <!--if (!data) {-->
                            <!--console.log(data.msg);-->
                        <!--}-->
                    <!--},-->
                <!--});-->
            <!--});-->
        <!--}-->
    <!--</script>-->


<title>o2o平台</title>
</head>
<body>
<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <nav class="nav navbar-nav">
            <ul class="cl">
                <li style="font-size: 18px; padding-left: 20px;">o2o 平台</a>

                </li>
            </ul>
        </nav>
        <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
            <ul class="cl">
                <li>超级管理员</li>
                <li class="dropDown dropDown_hover"><a href="#" class="dropDown_A">admin <i class="Hui-iconfont">&#xe6d5;</i></a>
                    <ul class="dropDown-menu menu radius box-shadow">
                        <li><a href="#">个人信息</a></li>
                        <li><a href="#">切换账户</a></li>
                        <li><a href="#">退出</a></li>
                    </ul>
                </li>
                <li id="Hui-msg"><a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont"
                                                                                                    style="font-size:18px">&#xe68a;</i></a>
                </li>
                <li id="Hui-skin" class="dropDown right dropDown_hover"><a href="javascript:;" class="dropDown_A"
                                                                           title="换肤"><i class="Hui-iconfont"
                                                                                         style="font-size:18px">&#xe62a;</i></a>
                    <ul class="dropDown-menu menu radius box-shadow table-sort">
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
        <dl id="menu-article">
            <dt><i class="Hui-iconfont">&#xe616;</i> 分类管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a data-href="<?php echo URL('category/show'); ?>" data-title="生活分类" href="javascript:void(0)">生活分类</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-picture">
            <dt><i class="Hui-iconfont">&#xe613;</i> 商家管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a data-href="<?php echo URL('bis/index'); ?>" data-title="商家管理" href="javascript:void(0)">商家管理</a></li>
                    <li><a data-href="<?php echo URL('bis/apply'); ?>" data-title="商户入驻申请" href="javascript:void(0)">商户入驻申请</a></li>
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