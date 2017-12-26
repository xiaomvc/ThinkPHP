<?php /* Smarty version Smarty-3.1.6, created on 2017-07-25 17:13:42
         compiled from "E:/web/StuTP/shop/Admin/View\Goods\addlist.html" */ ?>
<?php /*%%SmartyHeaderCode:111235971cecb558532-88500856%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c1b2a8dfe42736468b9a02672bbe0ea4988203e0' => 
    array (
      0 => 'E:/web/StuTP/shop/Admin/View\\Goods\\addlist.html',
      1 => 1500974022,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '111235971cecb558532-88500856',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5971cecb617bd',
  'variables' => 
  array (
    'errinfo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5971cecb617bd')) {function content_5971cecb617bd($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>添加商品</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link href="<?php echo @ADMIN_CSS_URL;?>
mine.css" type="text/css" rel="stylesheet">


    <script type="text/javascript" charset="utf-8" src="/tools/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/tools/ueditor/ueditor.all.min.js"></script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/tools/ueditor/lang/zh-cn/zh-cn.js"></script>

    <script>
        <!--配置相应功能-->
        UEDITOR_CONFIG.toolbars=[[   'fullscreen', 'source', '|', 'undo', 'redo', '|',
            'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
            'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
            'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
            'directionalityltr', 'directionalityrtl', 'indent', '|',
            'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
            'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
            'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe', 'webapp', 'pagebreak', 'template', 'background', '|',
            'horizontal', 'date', 'time']];
    </script>


    <script src="/Common/Js/uploadPreview.js" type="text/javascript"></script>
    <script>
        window.onload = function () {
            new uploadPreview({ UpBtn: "up_img", DivShow: "imgdiv", ImgShow: "imgShow" });
        }
    </script>

</head>

<body>

<div class="div_head">
            <span>
                <span style="float:left">当前位置是：商品管理-》添加商品信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="<?php echo @__CONTROLLER__;?>
/showlist">【返回】</a>
                </span>
            </span>
</div>
<div></div>

<div style="font-size: 13px;margin: 10px 5px">
    <form action="<?php echo @__SELF__;?>
" method="post" enctype="multipart/form-data">
        <table border="1" width="100%" class="table_a">
            <tr>
                <td>商品名称</td>
                <td><input type="text" name="goods_name"/>
                    <span style="color:red;"><?php echo $_smarty_tpl->tpl_vars['errinfo']->value['goods_name'];?>
</span>
                </td>

            </tr>
            <tr>
                <td>商品库存</td>
                <td>
                    <input type="text" name="goods_number"/>
                    <span style="color:red;"><?php echo $_smarty_tpl->tpl_vars['errinfo']->value['goods_number'];?>
</span>
                </td>

            </tr>
            <tr>
                <td>商品重量</td>
                <td>
                    <input type="text" name="goods_weight"/>
                    <span style="color:red;"><?php echo $_smarty_tpl->tpl_vars['errinfo']->value['goods_weight'];?>
</span>
                </td>

            </tr>
            <tr>
                <td>商品价格</td>
                <td><input type="text" name="goods_price"/>
                    <span style="color:red;"><?php echo $_smarty_tpl->tpl_vars['errinfo']->value['goods_price'];?>
</span>
                </td>

            </tr>

            <tr>
                <td>商品图片</td>
                <td>
                    <div id="imgdiv">
                        <img id="imgShow" width="100" height="100" />
                    </div>
                    <input type="file" name="goods_img" id="up_img"/>

                </td>
            </tr>
            <tr>
            <td>商品详细描述</td>
            <td>
                <textarea id="editor" type="text/plain" style="width:1024px;height:500px;" name="goods_introduce"></textarea>
                <script type='text/javascript'>
                    UE.getEditor('editor');
                </script>
            </td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="添加">
                </td>
            </tr>
        </table>

    </form>
</div>
</body>
</html><?php }} ?>