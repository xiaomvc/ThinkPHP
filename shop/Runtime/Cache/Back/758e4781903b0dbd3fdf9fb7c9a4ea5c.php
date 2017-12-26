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

        <tr>
            <td>类型名称 :
                <select name="type_id" onchange="show_attr()">
                    <option value="0">..请选择类型</option>
                    <?php if(is_array($type)): foreach($type as $key=>$v): ?><option value="<?php echo ($v["type_id"]); ?>"><?php echo ($v["type_name"]); ?></option><?php endforeach; endif; ?>
                </select>
            </td>
        </tr>
        </tbody>
    </table>

    <script type="text/javascript">




        function show_attr() {
            //获取select中name属性为type_id 的 select 标签
            //获取select中选中的option属性中的value值
            var type_id = $("select[name='type_id'] option:selected").val();
            //判断选中的是否大于0（因为第一个为提示信息：请选择...）
            if (type_id <= 0) {
                //删除第一个tr后面的元素，并返回，不继续执行
                $("table tr:not(:first)").remove();
                return;
            }
            ;
            //通过get的方式，向后台提交数据
            $.get('showType', {'type_id': type_id}, function (msg) {
                var str = "";
                // 转换格式
                var data = $.parseJSON(msg);
                $.each(data, function (k, v) {
                    if (v.auth_level == 0) {
                        str = str + "<tr><td>" + v.auth_name + " : <input name='type_name'/></td></tr>";
                    } else if (v.auth_level == 1) {
                        //$(this).parent().parent().parent()
                        //获取它的tr父级元素
                        str = str + "<tr><td><em><span onclick='add_item($(this).parent().parent().parent())'>[+]</span></em>" + v.auth_name + " : <input name='type_name'/></td></tr>";
                    }
                })
                //获取table中不是第一个tr元素，然后删除（删除第一个tr后，的元素内容呢）
                $("table tr:not(:first)").remove();
                //在table中添加新的元素
                $("table").append(str);
            });

            //这是原型写法
            /* $.ajax({
             url: "/index.php/Back/Type/showType",
             data: {'type_id': type_id},
             dataType: 'json',
             type: 'get',
             success: function ($msg) {}
             });*/
        };

        //add_item($(this).parent().parent().parent())
        //传递它的tr父级元素
        function add_item(obj) {
            //obj.clone()复制一份
            var fu_obj = obj.clone();
            //把复制品中的span内容删除
            fu_obj.find("span").remove();
            //在复制品中的em元素，添加新的span元素内容
            fu_obj.find("em").append("<span onclick='$(this).parent().parent().parent().remove()'>[-]</span>")
            //在原来的元素（tr），后面添加新的元素（新的复制品）
            obj.after(fu_obj);
        }

    </script>
</div>


</body>
</html>