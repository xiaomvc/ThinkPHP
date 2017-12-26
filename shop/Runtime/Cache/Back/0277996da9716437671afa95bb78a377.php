<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title><?php echo ($nav["title"]); ?></title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link href="<?php echo (C("BACK_CSS_URL")); ?>mine.css" type="text/css" rel="stylesheet">

    <script type="text/javascript" charset="utf-8" src="/tools/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/tools/ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/tools/ueditor/lang/zh-cn/zh-cn.js"></script>


    <script src="/Common/Common/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/back/Public/js/echshoop.js"></script>


</head>


<body>

<div class="div_head">
            <span>
                <span style="float:left">当前位置是：<?php echo ($nav["first"]); ?>-》<?php echo ($nav["second"]); ?></span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="/index.php/Back/<?php echo ($nav["linkTo"]["1"]); ?>">【<?php echo ($nav["linkTo"]["0"]); ?>】</a>
                </span>
            </span>
</div>
<div></div>



<div id="tabbar-div">
    <p>
        <span id="general-tab" class="tab-front">通用信息</span>
        <span id="detail-tab" class="tab-back">详细描述</span>
        <span id="mix-tab" class="tab-back">其他信息</span>
        <span id="properties-tab" class="tab-back">商品属性</span>
        <span id="gallery-tab" class="tab-back">商品相册</span>
        <span id="linkgoods-tab" class="tab-back">关联商品</span>
        <span id="groupgoods-tab" class="tab-back">配件</span>
        <span id="article-tab" class="tab-back">关联文章</span>
    </p>
</div>

<div style="font-size: 13px;margin: 10px 5px">
    <form action="{/index.php/Back/Goods/addlist}" method="post" enctype="multipart/form-data">
        <table border="1" width="100%" class="table_a" id="general-tab-tb">
            <tr>
                <td>商品名称</td>
                <td><input type="text" name="f_goods_name"/></td>
            </tr>
            <tr>
                <td>商品分类</td>
                <td>
                    <select name="f_goods_category_id">
                        <option value="0">请选择</option>
                        {foreach from=$s_category_info key=_k item=_v}
                        <option value="<?php echo ($_v["category_id"]); ?>"><?php echo ($_v["category_name"]); ?></option>
                        {/foreach}
                    </select>
                </td>
            </tr>
            <tr>
                <td>商品品牌</td>
                <td>
                    <select name="f_goods_brand_id">
                        <option value="0">请选择</option>
                        {foreach from=$s_brand_info key=_k item=_v}
                        <option value="<?php echo ($_v["brand_id"]); ?>"><?php echo ($_v["brand_name"]); ?></option>
                        {/foreach}
                    </select>
                </td>
            </tr>
            <tr>
                <td>商品价格</td>
                <td><input type="text" name="f_goods_price"/></td>
            </tr>
            <tr>
                <td>商品图片</td>
                <td><input type="file" name="f_goods_image"/></td>
            </tr>
            <tr>
                <td>商品详细描述</td>
                <td>
                    <textarea name="f_goods_introduce" id="editor" type="text/plain"
                              style="width:1024px;height:500px;"></textarea>
                </td>
                <script>UE.getEditor('editor');</script>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="添加">
                </td>
            </tr>
        </table>
        <table border="1" width="100%" class="table_a" id="detail-tab-tb" style="display: none;"><tr><td>详细描述</td></tr></table>
        <table border="1" width="100%" class="table_a" id="mix-tab-tb" style="display: none;"><tr><td>其他信息</td></tr></table>
        <table border="1" width="100%" class="table_a" id="properties-tab-tb" style="display: none;"><tr><td>商品属性</td></tr></table>
        <table border="1" width="100%" class="table_a" id="gallery-tab-tb" style="display: none;"><tr><td>商品相册</td></tr></table>
        <table border="1" width="100%" class="table_a" id="linkgoods-tab-tb" style="display: none;"><tr><td>关联商品</td></tr></table>
        <table border="1" width="100%" class="table_a" id="groupgoods-tab-tb" style="display: none;"><tr><td>配件</td></tr></table>
        <table border="1" width="100%" class="table_a" id="article-tab-tb" style="display: none;"><tr><td>关联文章</td></tr></table>
    </form>
</div>


</body>
</html>