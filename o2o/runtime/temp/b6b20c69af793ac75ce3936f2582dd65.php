<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:56:"/data/o2o/public/../application/bis/view/user/login.html";i:1504349533;s:59:"/data/o2o/public/../application/bis/view/public/header.html";i:1505291238;s:59:"/data/o2o/public/../application/bis/view/public/footer.html";i:1504254367;}*/ ?>
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



<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"><h1 style="text-align:center; font-size: 20px;margin-top: 20px;">商户登录系统</h1></div>
<div class="loginWraper">

  <div id="loginform" class="loginBox">

    <form class="form form-horizontal" action="" method="post">

      <div class="row cl">

        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
          <input name="userName" type="text" placeholder="账户" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
          <input name="password" type="password" placeholder="密码" class="input-text size-L title">

        </div>

      </div>

      
      
      <div class="row cl">

        <div class="formControls col-xs-8 col-xs-offset-3">

          <input id="button" type="button" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;重&nbsp;&nbsp;&nbsp;&nbsp;置&nbsp;">
          <a href="<?php echo URL('bis/user/register'); ?>"><input name="" type="" class="btn btn-success radius size-L" value="&nbsp;申请&nbsp;&nbsp;&nbsp;&nbsp;入驻&nbsp;"></a>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="footer">Copyright tp5打造本地生活服务系统</div>
<script type="text/javascript" src="__STATIC__/bis/login.js"></script>
<!--包含尾部文件-->
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
