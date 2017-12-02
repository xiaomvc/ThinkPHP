<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:61:"/data/o2o/public/../application/index/view/user/register.html";i:1504413635;s:61:"/data/o2o/public/../application/index/view/public/header.html";i:1505209558;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="__STATIC__/index/css/base.css"/>
    <link rel="stylesheet" href="__STATIC__/index/css/common.css"/>
    <?php if(request()->Controller() != 'User'): ?>
    <link rel="stylesheet" href="__STATIC__/index/css/<?php echo lcfirst(request()->Controller()); ?>.css"/>
    <?php endif; ?>
    <script type="text/javascript" src="__STATIC__/index/js/html5shiv.js"></script>
    <script type="text/javascript" src="__STATIC__/index/js/respond.min.js"></script>
    <script type="text/javascript" src="__STATIC__/index/js/jquery-1.11.3.min.js"></script>

    <title><?php echo $title; ?></title>
    <script src="__STATIC__/common/check.js"></script>
    <script type="text/javascript" src="/static/common/common.js"></script>


<link rel="stylesheet" href="__STATIC__/index/css/register.css"/>
<title>注册</title>
</head>
<body>
<div class="wrapper">
    <div class="head">
        <ul>
            <li><a href="index.html"><img src="__STATIC__/index/images/logo.png" alt="logo"></a></li>
            <li class="divider"></li>
            <li><a href="index.html"></a></li>
        </ul>
        <div class="login-link">
            <span>我已注册，现在就</span>
            <a href="<?php echo URL('index/user/login'); ?>">登录</a>
        </div>
    </div>

    <div class="content">
        <form method="post">
            <p class="pass-form-item">
                <label class="pass-label">用户名</label>
                <input type="text" name="userName"
                       class="pass-text-input" placeholder="请设置用户名">
            </p>
            <p class="pass-form-item">
                <label class="pass-label">邮箱号</label>
                <input type="text" name="email" class="pass-text-input" placeholder="可用于接受团购券账号和密码便于消费">
            </p>

            <p class="pass-form-item">
                <label class="pass-label">密码</label>
                <input type="text" name="password" class="pass-text-input" placeholder="请设置登录密码">
            </p>
            <p class="pass-form-item">
                <label class="pass-label">确认密码</label>
                <input type="text" name="repassword" class="pass-text-input"
                       placeholder="请设置登录密码">
            </p>
            <p class="pass-form-item">
                <label class="pass-label">验证码</label>
                <input type="text" name="verifyCode" class="pass-text-input "
                       placeholder="请输入验证码">
                <img id="verify" style="vertical-align: middle" src="<?php echo URL('index/user/getVerify'); ?>"/>
                <a onclick="getVerify()" href="javascript:;" style="font-size: 23px">点击更换</a>
            </p>

            <p class="pass-form-item">
                <input name="button" type="button" value="注册" class="pass-button">
            </p>
        </form>

    </div>

    <div class="foot">
        <div>
            <div>2017&nbsp;©Baidu</div>
        </div>
    </div>

</div>
<!--//引入封装好的js文件-->
<script src="__STATIC__/index/js/register.js"></script>

</body>
</html>