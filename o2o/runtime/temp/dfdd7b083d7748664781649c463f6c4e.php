<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:54:"/data/o2o/public/../application/bis/view/deal/add.html";i:1505352714;s:59:"/data/o2o/public/../application/bis/view/public/header.html";i:1505291238;s:59:"/data/o2o/public/../application/bis/view/public/footer.html";i:1504254367;}*/ ?>
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



<div class="cl pd-5 bg-1 bk-gray mt-20"> 添加团购商品信息</div>
<article class="page-container">
    <form class="form form-horizontal" id="form-article-add" method="post" action="/bis/deal/add">
        基本信息：
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>团购名称：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text " value="" placeholder=""  name="name">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属城市：</label>
            <div class="formControls col-xs-8 col-sm-2">
				<span class="select-box">
				<select name="city_id" class="select cityId" onchange="changeCityId()">
                  <option value="0">--请选择--</option>
                  <?php if(is_array($citys) || $citys instanceof \think\Collection || $citys instanceof \think\Paginator): $i = 0; $__LIST__ = $citys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                  <option value="<?php echo $vo['id']; ?>" <?php if($getLocations[0]['city_id'] == $vo['id']): ?>selected<?php endif; ?>><?php echo $vo['name']; ?></option>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
				</span>
            </div>
            <div class="formControls col-xs-8 col-sm-2">
				<span class="select-box">
				<select name="city_id" class="select se_city_id">
                 <?php if(is_array($secondCityInfo) || $secondCityInfo instanceof \think\Collection || $secondCityInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $secondCityInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                  <option value="<?php echo $vo['id']; ?>" <?php if($city_path == $vo['id']): ?>selected<?php endif; ?>><?php echo $vo['name']; ?></option>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
				</span>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属分类：</label>
            <div class="formControls col-xs-8 col-sm-3"> <span class="select-box">
				<select name="category_id" class="select categoryId" onchange="changeCategory()">
                  <option value="0">--请选择--</option>
                  <?php if(is_array($categorys) || $categorys instanceof \think\Collection || $categorys instanceof \think\Paginator): $i = 0; $__LIST__ = $categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                  <option value="<?php echo $vo['id']; ?>" <?php if($getLocations[0]['category_id'] == $vo['id']): ?>selected<?php endif; ?>><?php echo $vo['name']; ?></option>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
				</span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">所属子类：</label>
            <div class="formControls col-xs-8 col-sm-3 skin-minimal">
                <div class="check-box se_category_id" style="width: 800px;">
                    <?php if(is_array($secondCategory) || $secondCategory instanceof \think\Collection || $secondCategory instanceof \think\Paginator): $i = 0; $__LIST__ = $secondCategory;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <label style='padding:0px 3px ;'>
                        <input type='radio' value='<?php echo $vo['id']; ?>' name='se_category_id'
                               <?php if($category_path == $vo['id']): ?>checked<?php endif; ?>
                        /><?php echo $vo['name']; ?></label>

                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>


            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-9 col-sm-2">支持门店：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="check-box">
                    <?php if(is_array($getLocations) || $getLocations instanceof \think\Collection || $getLocations instanceof \think\Paginator): $k = 0; $__LIST__ = $getLocations;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
                    <input name="location_ids[]" type="checkbox" id="checkbox" value="<?php echo $vo['id']; ?>"
                           <?php if($k == 1): ?>checked<?php endif; ?>
                    />

                    <?php echo $vo['name']; endforeach; endif; else: echo "" ;endif; ?>

                </div>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">缩略图：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <img id="imgShow1" width="150" height="150" style="display: none;"/>
                <button type="button" class="layui-btn demo" ><i class="layui-icon"></i>上传图片</button>
                <input type="hidden" value="" name="image">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">团购开始时间：</label>
            <div class="formControls col-xs-8 col-sm-3">

                <input type="text" name="start_time" class="layui-input item"  value=""  >

            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">团购结束时间:</label>
            <div class="formControls col-xs-8 col-sm-3">

                <input type="text" name="end_time" class="layui-input item" id="countTimestart" value=""  >
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">库存数:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="" placeholder="" id="" name="total_count">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">原价:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="" placeholder="" id="" name="origin_price">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">团购价:</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" value="" placeholder="" id="" name="current_price">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">消费券生效时间：</label>
            <div class="formControls col-xs-8 col-sm-3">

                <input type="text" name="coupons_start_time" class="layui-input item"  value=""  >
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">消费券结束时间:</label>
            <div class="formControls col-xs-8 col-sm-3">

                <input type="text" name="coupons_end_time" class="layui-input item"  value=""  >
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">团购描述：</label>
            <div class="formControls col-xs-8 col-sm-9">

                <textarea class="layui-textarea change" id="editor"  type="text/plain" name="description" style="display: none"></textarea>
            </div>
        </div>
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2">购买须知：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <textarea class="layui-textarea change" id="editor2"  type="text/plain" name="notes" style="display: none"></textarea>
            </div>
        </div>

        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button id="button" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 申请</button>
            </div>
        </div>
    </form>
</article>

<!--//图片上传-->
<!--layui插件-->
<link rel="stylesheet" href="__STATIC__/layui/css/layui.css" media="all">
<script type="text/javascript" src="__STATIC__/layui/layui.js"></script>
<script type="text/javascript" src="__STATIC__/common/layui.js"></script>
<script type="text/javascript" src="__STATIC__/bis/dealAdd.js"></script>
<!--<script type="text/javascript" src="__STATIC__/common/selectChange.js"></script>-->
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
