<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:59:"/data/o2o/public/../application/bis/view/user/register.html";i:1505295701;s:59:"/data/o2o/public/../application/bis/view/public/header.html";i:1505291238;s:61:"/data/o2o/public/../application/bis/view/public/register.html";i:1504371946;s:59:"/data/o2o/public/../application/bis/view/public/footer.html";i:1504254367;}*/ ?>
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
<article class="page-container" style="">
    <form class="form form-horizontal" style="" method="post" action="<?php echo URL('bis/user/register'); ?>">
        <p style="color:blue;"> 基本信息：</p>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商户名称：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text bisName" placeholder="商户名称" name="bisName">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属城市：</label>
            <div class="formControls col-xs-8 col-sm-2">
				<span class="select-box">
				<select name="fi_city_id" class="select cityId" onchange="changeCityId()">
                  <option value="0">--请选择--</option>
                    <?php if(is_array($firstCityInfo) || $firstCityInfo instanceof \think\Collection || $firstCityInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $firstCityInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ff): $mod = ($i % 2 );++$i;?>
                      <option value="<?php echo $ff['id']; ?>"><?php echo $ff['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
				</span>
            </div>
            <div class="formControls col-xs-8 col-sm-2">
				<span class="select-box">
                    <!--二级城市信息-->
				<select name="se_city_id" class="select se_city_id">

                </select>
				</span>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">缩略图：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <img id="imgShow1" width="150" height="150" style="display: none;"/>
                <button type="button" class="layui-btn demo" ><i class="layui-icon"></i>上传图片</button>

                <input type="hidden" value="" name=" logo">
            </div>
        </div>
        <div class="row cl" style="padding-top:20px;">
            <label class="form-label col-xs-4 col-sm-2">营业执照：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <img src="" id="imgShow2" width="150" height="150" style="display: none"/>
                <button type="button" class="layui-btn demo" ><i class="layui-icon"></i>上传图片</button>
                <input type="hidden" value="" name="licence_logo">
            </div>
        </div>

        <div class="row cl" style="">
            <label class="form-label col-xs-4 col-sm-2">商户介绍：</label>
            <textarea name="description" id="editorOne" style="width: 500px; "
                      class="formControls col-xs-8 col-sm-3"></textarea>
            <div class="row cl" style="clear: both;">
                <label class="form-label col-xs-4 col-sm-2">银行账号:</label>
                <div class="formControls col-xs-8 col-sm-3">
                    <input type="text" class="input-text" value="" placeholder="" name="bank_info">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">开户行名称:</label>
                <div class="formControls col-xs-8 col-sm-3">
                    <input type="text" class="input-text" value="" placeholder="" name="bank_name">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">开户行姓名:</label>
                <div class="formControls col-xs-8 col-sm-3">
                    <input type="text" class="input-text" value="" placeholder="" name="bank_user">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">法人:</label>
                <div class="formControls col-xs-8 col-sm-3">
                    <input type="text" class="input-text" value="" placeholder="" name="faren">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">法人电话:</label>
                <div class="formControls col-xs-8 col-sm-3">
                    <input type="text" class="input-text" value="" placeholder="" name="faren_tel">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>邮箱：</label>
                <div class="formControls col-xs-8 col-sm-3">
                    <input  type="text" class="input-text email" value="" placeholder="" name="email">
                </div>
            </div>
            <p style="color:blue"> 总店信息：</p>
            <div class="row cl" style="clear: both;">
                <label class="form-label col-xs-4 col-sm-2">用户名:</label>
                <div class="formControls col-xs-8 col-sm-3" style="padding-left: 15px;">
                    <input type="text" class="input-text" value="" placeholder=""
                           name="username">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">电话:</label>
                <div class="formControls col-xs-8 col-sm-3">
                    <input type="text" class="input-text" value="" placeholder="" name="tel">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属分类：</label>
                <div class="formControls col-xs-8 col-sm-3"> <span class="select-box">
				<select name="category_id" class="select categoryId" onchange="changeCategory()">
                  <option value="0">请选择</option>
                        <?php if(is_array($firstCategory) || $firstCategory instanceof \think\Collection || $firstCategory instanceof \think\Paginator): if( count($firstCategory)==0 ) : echo "" ;else: foreach($firstCategory as $key=>$fc): ?>
                                    <option value="<?php echo $fc['id']; ?>"><?php echo $fc['name']; ?></option>

                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
				</span>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">所属子类：</label>

                <div class="check-box se_category_id">

                </div>

            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">商户地址：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="" placeholder=""
                       name="address">

            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">营业时间:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="" placeholder=""
                       name="open_time">
            </div>
        </div>

        <div class="row cl" style="">
            <label class="form-label col-xs-4 col-sm-2">门店简介：</label>
            <textarea name="content" id="editorTwo" style="width: 500px; "
                      class="formControls col-xs-8 col-sm-3"></textarea>


        </div>
		<p style="color:blue;"> 账号信息：</p>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">登录名称:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text denglu" placeholder="登录时的用户名"
                       name="denglu">
            </div>
        </div><div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">账号密码:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" placeholder=""
                       name="password">
            </div>
        </div>
        </div>
        <div style=" text-align:center; "><input id="button" type="button" value="提交申请"
                                                 style="font-size: 16px; color: blue;"/></div>
    </form>
</article>

<!--公共的脚本文件-->
<script src="__STATIC__/admin/js/common.js" type="text/javascript"></script>
<!--编辑器-->
<script type="text/javascript" charset="utf-8" src="__STATIC__/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="__STATIC__/ueditor/ueditor.all.min.js"></script>

<script type="text/javascript" charset="utf-8" src="__STATIC__/ueditor/lang/zh-cn/zh-cn.js"></script>

<!--文件上传-->
<!--layui插件-->
<link rel="stylesheet" href="__STATIC__/layui/css/layui.css" media="all">
<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
<script type="text/javascript" src="__STATIC__/common/layui.js"></script>

<script type="text/javascript" src="__STATIC__/bis/register.js"></script>




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

