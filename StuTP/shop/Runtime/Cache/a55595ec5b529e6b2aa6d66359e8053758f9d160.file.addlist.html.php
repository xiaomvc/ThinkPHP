<?php /* Smarty version Smarty-3.1.6, created on 2017-07-11 18:00:51
         compiled from "E:/phpwamp/wwwroot/StuTP/shop/Admin/View\Goods\addlist.html" */ ?>
<?php /*%%SmartyHeaderCode:107785947e18caa60e3-33947729%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a55595ec5b529e6b2aa6d66359e8053758f9d160' => 
    array (
      0 => 'E:/phpwamp/wwwroot/StuTP/shop/Admin/View\\Goods\\addlist.html',
      1 => 1499165933,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '107785947e18caa60e3-33947729',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5947e18cdf9aa',
  'variables' => 
  array (
    'errinfo' => 0,
    'uperror' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5947e18cdf9aa')) {function content_5947e18cdf9aa($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>添加商品</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link href="<?php echo @ADMIN_CSS_URL;?>
mine.css" type="text/css" rel="stylesheet">
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
                <td><input type="text" name="goods_name" />
                    <span style="color:red;"><?php echo $_smarty_tpl->tpl_vars['errinfo']->value['goods_name'];?>
</span>
                </td>

            </tr>
            <tr>
                <td>商品库存</td>
                <td>
                   <input type="text" name="goods_number" />
                    <span style="color:red;"><?php echo $_smarty_tpl->tpl_vars['errinfo']->value['goods_number'];?>
</span>
                </td>

            </tr>
            <tr>
                <td>商品重量</td>
                <td>
                    <input type="text" name="goods_weight" />
                    <span style="color:red;"><?php echo $_smarty_tpl->tpl_vars['errinfo']->value['goods_weight'];?>
</span>
                </td>

            </tr>
            <tr>
                <td>商品价格</td>
                <td><input type="text" name="goods_price" />
                    <span style="color:red;"><?php echo $_smarty_tpl->tpl_vars['errinfo']->value['goods_price'];?>
</span>
                </td>

            </tr>

            <tr>
                <td>商品图片</td>
                <td>
                    <input type="file" name="goods_img" />
                    <span style="color:red;"><?php echo $_smarty_tpl->tpl_vars['uperror']->value;?>
</span>
                </td>
            </tr>
            <tr>
                <td>商品详细描述</td>
                <td>
                    <textarea name="goods_introduce"></textarea>
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