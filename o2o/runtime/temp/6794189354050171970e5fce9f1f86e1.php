<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:59:"/data/o2o/public/../application/bis/view/manager/index.html";i:1505375139;s:59:"/data/o2o/public/../application/bis/view/public/header.html";i:1505291238;s:59:"/data/o2o/public/../application/bis/view/public/footer.html";i:1504254367;}*/ ?>

<!DOCTYPE HTML>
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



<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 商户列表</nav>
<div class="page-container">


    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort">
            <thead>
            <tr class="text-c">
                <th width="80">ID</th>
                <th width="100">商户名称</th>
                <th width="30">法人</th>
                <th width="150">联系电话</th>
                <th width="60">申请时间</th>
                <th width="60">状态</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>

            <tr class="text-c">
                <td><?php echo $bisInfo['id']; ?></td>
                <td><?php echo $bisInfo['name']; ?></td>
                <td class="text-c"><?php echo $bisInfo['faren']; ?></td>
                <td class="text-c"><?php echo $bisInfo['faren_tel']; ?></td>
                <td><?php echo $bisInfo['create_time']; ?></td>
                <td class="td-status"><?php echo status($bisInfo['status']); ?></td>


                <td class="f-14">

                    <a title="商家详细信息"
                       href=" <?php echo URL('manager/detail'); ?>" target="_blank"
                       style="text-decoration:none">
                        商家详细信息</a>

                    <a title="编辑商家"
                       href=" <?php echo URL('manager/detail'); ?>" target="_blank"
                       style="text-decoration:none">
                        <i class="Hui-iconfont">&#xe6df;</i></a>
                  <!--  <a title="删除" href="javascript:;" onclick="del_info(this,'<?php echo $bisInfo['id']; ?>','<?php echo URL('manager/del'); ?>')"
                       class="ml-5"
                       style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
		-->
                </td>

            </tr>
            </tbody>

        </table>


    </div>
    <!--包含头部文件-->
<footer class="footer mt-20" style="clear: both;">
    <div class="container">
        <p>
            感谢jQuery、layer、laypage、Validform、UEditor、My97DatePicker、iconfont、Datatables、WebUploaded、icheck、highcharts、bootstrap-Switch<br>
            Copyright &copy;2015-2017 H-ui.admin v3.1 All Rights Reserved.<br>
            本后台系统由<a href="http://www.h-ui.net/" target="_blank" title="H-ui前端框架">H-ui前端框架</a>提供前端技术支持</p>
    </div>
</footer>
<style>

    .footer {
        text-align: center;
        padding: 10px 0px;
    }

    .pagination {
        text-align: center;
        margin-top:10px;
    }

    .pagination li {
        display: inline;
        padding: 0 5px;
        font-size: 16px;
    }
</style>
</head>
</body>
</html>
