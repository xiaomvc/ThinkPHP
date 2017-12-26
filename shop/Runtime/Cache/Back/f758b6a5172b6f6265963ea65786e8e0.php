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


<div style="font-size: 13px; margin: 10px 5px;">
    <table class="table_a" border="1" width="100%">
        <tbody>
        <tr style="font-weight: bold;">
            <td>序号</td>
            <td>角色名称</td>
            <td>权限ID</td>
            <td align="center" colspan="3">操作</td>
        </tr>
        <?php if(is_array($showlist)): foreach($showlist as $key=>$show): ?><tr>
            <td><?php echo ($show["role_id"]); ?></td>
            <td><?php echo ($show["role_name"]); ?></td>
            <td><?php echo ($show["role_auth_ids"]); ?></td>


            <td><a href="<?php echo U('Role/upRole',array('role_id'=>$show['role_id'] )) ;?>">修改</a></td>
            <td><a href="#">删除</a></td>
        </tr><?php endforeach; endif; ?>
        </tbody>
    </table>
</div>


</body>
</html>