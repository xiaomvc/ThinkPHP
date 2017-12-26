/**
 * Created by Administrator on 2017/7/25.
 */

$(function () {
    $('#tabbar-div span').click(function(){
        $('#tabbar-div span').attr('class','tab-back');//全部标签 变暗
        $(this).attr('class','tab-front');//当前被点击标签 高亮

        $('.table_a').hide();//全部table 隐藏
        var idflag = $(this).attr('id');//当前被点击标签对应的table ID的值
        $('#'+idflag+"-tb").show();//点中的标签，相应的table显示

    });

    UEDITOR_CONFIG.toolbars = [[
        'fullscreen', 'source', '|', 'undo', 'redo', '|',
        'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
        'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
        'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
        'directionalityltr', 'directionalityrtl', 'indent', '|',
        'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
        'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
        'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe', 'insertcode', 'webapp', 'pagebreak', 'template', 'background', '|',
        'horizontal', 'date', 'time', 'spechars', 'snapscreen', '|'
    ]];
});