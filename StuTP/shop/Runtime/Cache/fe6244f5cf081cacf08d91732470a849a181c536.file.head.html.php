<?php /* Smarty version Smarty-3.1.6, created on 2017-07-16 23:29:39
         compiled from "E:/phpwamp/wwwroot/StuTP/shop/Admin/View\index\head.html" */ ?>
<?php /*%%SmartyHeaderCode:241205947ff4f07e0a3-70901058%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fe6244f5cf081cacf08d91732470a849a181c536' => 
    array (
      0 => 'E:/phpwamp/wwwroot/StuTP/shop/Admin/View\\index\\head.html',
      1 => 1500218977,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '241205947ff4f07e0a3-70901058',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5947ff4f0f33b',
  'variables' => 
  array (
    'username' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5947ff4f0f33b')) {function content_5947ff4f0f33b($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<meta http-equiv=content-type content="text/html; charset=utf-8"/>
<link href="<?php echo @ADMIN_CSS_URL;?>
admin.css" type="text/css" rel="stylesheet"/>

<script>


</script>
</head>
<body>
<table cellspacing=0 cellpadding=0 width="100%"
       background="<?php echo @ADMIN_IMG_URL;?>
header_bg.jpg" border=0>
    <tr height=56>
        <td width=260><img height=56 src="<?php echo @ADMIN_IMG_URL;?>
header_left.jpg"
                           width=260></td>
        <td style="font-weight: bold; color: #fff; padding-top: 20px"
            align=middle>当前用户：<?php echo @$_smarty_tpl->tpl_vars['username']->value;?>
 &nbsp;&nbsp; <a style="color: #fff"
                                                                        href=""
                                                                        target=main>修改口令</a> &nbsp;&nbsp; <a
                style="color: #fff"
                onclick="if (confirm('确定要退出吗？')) return true; else return false;"
                href="" target=_top>退出系统</a>
        </td>
        <td align=right width=268><img height=56
                                       src="<?php echo @ADMIN_IMG_URL;?>
header_right.jpg" width=268></td>
    </tr>
</table>
<table cellspacing=0 cellpadding=0 width="100%" border=0>
    <tr bgcolor=#1c5db6 height=4>
        <td></td>
    </tr>
</table>
</body>
</html><?php }} ?>