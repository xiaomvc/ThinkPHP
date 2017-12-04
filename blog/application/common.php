<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * 去除HTML样式，并截取长度
 * @param $string
 * @param $sublen
 * @return mixed|string
 */
function cutstr_html($string, $sublen = 100)
{
    //将查询到的数据转义为HTML（数据库的内容有转义）
    $string = html_entity_decode($string);
    //去除字符串中的HTML标签
    $string = strip_tags($string);
    //通过正则替换字符串（这里只是替换空格）
    $string = preg_replace_callback("/&nbsp;/is", function ($match) {
        //        把检测到的字符串替换为空格
        $string = str_replace($match[0], "", $match[0]);
        return $string;
    }, $string);
    //这也是可以通过正则替换字符，，不过在较新的版本中被抛弃
    //    $string = preg_replace ('/&nbsp;/is', '', $string);
    //截取字符串
    if (strlen($string) > $sublen) {
        $string = mb_substr($string, 0, $sublen,"utf-8"). "... ...";
    };
    return $string ;
}

/**
 * 分页
 * @param string $obj
 * @param bool $flag
 * @return string
 */
function paginate($obj = '', $flag = false)
{
    //不分页的情况
    if (empty($obj)) {
        return '';
    }
    if ($flag) {
        $params = request()->param();//获取地址栏后面的参数
        //appends()在分页地址栏中添加参数
        return $obj->appends($params)->render();
    } else {
        //不添加参数

        return $obj->render();
    }

}

