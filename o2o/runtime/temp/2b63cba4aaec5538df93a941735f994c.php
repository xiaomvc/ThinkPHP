<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:58:"/data/o2o/public/../application/index/view/user/login.html";i:1506374188;s:61:"/data/o2o/public/../application/index/view/public/header.html";i:1505209558;}*/ ?>
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

<link rel="stylesheet" href="__STATIC__/index/css/login.css"/>
<title>登录</title>
<body>
<div class="wrapper">
    <div class="head">
        <ul>
            <li><a href="index.html"><img src="__STATIC__/index/images/logo.png" alt="logo"></a></li>
            <li class="divider"></li>
            <li>登录</li>
        </ul>
        <div class="login-link">
            <span>还没o2o团购网帐号</span>
            <a href="<?php echo URL('index/user/register'); ?>">注册</a>
        </div>
    </div>

    <div class="content">
        <div class="wrap">
            <div class="login-logo"></div>
            <div class="login-area">

                <div class="title">登录</div>

                <div class="login">
                    <form>
                        <div class="ordinaryLogin">

                            <p class="pass-form-item">
                                <label class="pass-label">用户名</label>
                                <input type="text" name="userName" class="pass-text-input" placeholder="用户名">
                            </p>
                            <p class="pass-form-item">
                                <label class="pass-label">密码</label>
                                <input type="password" name="password" class="pass-text-input" placeholder="密码">
                            </p>

                        </div>
                        <div>其它账号:<a href="<?php echo url('index/user/oauth'); ?>"><img style="vertical-align:middle "
                                                                            src="__STATIC__/index/images/qq_login.png"></a>
                        </div>
                        <div class="commonLogin">
                            <p class="pass-form-item">
                                <input id="button" type="button" value="登录" class="pass-button">


                            </p>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        function toQzoneLogin() {
            window.location.href = "http://www.61xiaok.xin/qq/example/oauth/index.php";
        }

    </script>

    <div class="footer">
        <ul class="first">

        </ul>
        <ul class="second">


        </ul>
    </div>
</div>
<!--//引入封装好的js文件-->
<script src="__STATIC__/common/check.js"></script>
<script src="__STATIC__/index/js/login.js"></script>

</body>
</html>