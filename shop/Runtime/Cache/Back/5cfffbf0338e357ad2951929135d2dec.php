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


<p style="font-weight:bolder; text-indent:1em">当前角色:<span style="color:#0000cc"> <?php echo ($showlist["role_name"]); ?></span></p>
<div style="font-size: 13px;margin: 10px 5px">
    <form action="/index.php/Back/Role/upRole/role_id/101.html" method="post" enctype="multipart/form-data">
        <table style=" border-color:blueviolet; width:100%" class="table_a" border="1px">
            <tr>
                <td colspan="5" align="center">分配权限</td>
            </tr>

            <!--将所有的一级目录（权限），填充到td中-->
            <!--将所有的二级目录（权限）,填充到td中的checkbox复选框中-->
            <?php if(is_array($authA)): foreach($authA as $key=>$v): ?><tr>
                    <td style="font-weight: bolder;"><?php echo ($v["auth_name"]); ?></td>

                    <?php if(is_array($authB)): foreach($authB as $key=>$vv): if($vv['auth_pid'] == $v['auth_id']): ?><td>

                                <!--把input标签放到<label>中使用-->
                                <!--在input标签中添加<in>或<if>，判断该值是否存在或如果该值等于某值时，是否选中-->
                                <label><input type="checkbox" value="<?php echo ($vv["auth_id"]); ?>" name="auth_ids[]"
                                    <?php if(in_array(($vv['auth_id']), is_array($showlist['role_auth_ids'])?$showlist['role_auth_ids']:explode(',',$showlist['role_auth_ids']))): ?>checked<?php endif; ?>
                                    ><?php echo ($vv["auth_name"]); ?></label>

                              <!--  <label><input class="radio" type="radio" name="auth_ids[]" value="<?php echo ($vv["auth_id"]); ?>"
                                    <?php if(vv['auth_id'] == 1): ?>checked<?php endif; ?>
                                    > 私有</label>-->



                            </td><?php endif; endforeach; endif; ?>
                </tr><?php endforeach; endif; ?>

            <tr>
                <td align="center" colspan="5">
                    <input type="submit" value="修改">
                </td>
            </tr>
        </table>
    </form>
</div>


</body>
</html>