<?php /* Smarty version Smarty-3.1.6, created on 2017-07-04 22:33:40
         compiled from "E:/phpwamp/wwwroot/StuTP/shop/Admin/View\Goods\showlist.html" */ ?>
<?php /*%%SmartyHeaderCode:217855946a8cf8f6bc2-53317564%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ca9af0933aa42c1a36c185523320952d288b381e' => 
    array (
      0 => 'E:/phpwamp/wwwroot/StuTP/shop/Admin/View\\Goods\\showlist.html',
      1 => 1499165933,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '217855946a8cf8f6bc2-53317564',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5946a8cf9d180',
  'variables' => 
  array (
    'info' => 0,
    'k' => 0,
    'v' => 0,
    'showPage' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5946a8cf9d180')) {function content_5946a8cf9d180($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'E:\\phpwamp\\wwwroot\\StuTP\\ThinkPHP\\Library\\Vendor\\Smarty\\plugins\\modifier.date_format.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

    <title>会员列表</title>

    <link href="<?php echo @ADMIN_CSS_URL;?>
mine.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<style>
    .tr_color {
        background-color: #9F88FF
    }
</style>
<div class="div_head">
            <span>
                <span style="float: left;">当前位置是：商品管理-》商品列表</span>
                <span style=" float: right; margin-right: 8px; font-weight: bold;">
                    <a style=" text-decoration: none;" href="<?php echo @__CONTROLLER__;?>
/addlist">【添加商品】</a>
                </span>
            </span>
</div>
<div></div>
<div class="div_search">
            <span>
                <form action="#" method="get">
                    品牌<select name="s_product_mark" style="width: 100px;">
                        <option selected="selected" value="0">请选择</option>
                        <option value="1">苹果apple</option>
                    </select>
                    <input value="查询" type="submit"/>
                </form>
            </span>
</div>
<div style="font-size: 13px; margin: 10px 5px;">
    <table class="table_a" border="1" width="100%">
        <tbody>
        <tr style="font-weight: bold;">
            <td>序号</td>
            <td>商品名称</td>
            <td>库存</td>
            <td>价格</td>
            <td>图片</td>
            <td>缩略图</td>
            <td>品牌</td>
            <td>创建时间</td>
            <td align="center">操作</td>
        </tr>
        <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['info']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
        <tr id="<?php echo 'product.($k+1)';?>
">
            <td><?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
</td>
            <td><a href="#"><?php echo $_smarty_tpl->tpl_vars['v']->value['goods_name'];?>
</a></td>
            <td><?php echo $_smarty_tpl->tpl_vars['v']->value['goods_number'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['v']->value['goods_price'];?>
</td>
            <td><img src="<?php echo @UP_IMG;?>
<?php echo $_smarty_tpl->tpl_vars['v']->value['goods_big_img'];?>
" height="60" width="60"></td>
            <td><img src="<?php echo @UP_IMG;?>
<?php echo $_smarty_tpl->tpl_vars['v']->value['goods_small_img'];?>
" height="40" width="40"></td>

            <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['v']->value['goods_create_time'],'%Y-%m-%d %T');?>
</td><!--对 Unix 时间戳进行格式化-->
            <td><a href="<?php echo @__CONTROLLER__;?>
/updatelist/goods_id/<?php echo $_smarty_tpl->tpl_vars['v']->value['goods_id'];?>
">修改</a></td>
            <td><a href="javascript:;" onclick="delete_product(1)">删除</a></td>
        </tr>
        <?php } ?>

        </tbody>
        <?php echo $_smarty_tpl->tpl_vars['showPage']->value;?>

    </table>
</div>
</body>
</html><?php }} ?>