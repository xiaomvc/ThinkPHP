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
 * @param $status 传递的状态数量0、1、-1
 * @return string 返回的显示的正常状态
 */
function status($status)
{
    $str = "";
    if ($status == 1) {
        $str = "<span class='label label-success radius'>正常</span>";
    } else if ($status == -1) {
        $str = "<span class='label label-danger radius'>待审</span>";
    } else if ($status == 0) {
        $str = "<span class='label label-danger radius'>删除</span>";
    } else {
        $str = "<span class='label label-danger radius'>状态未知</span>";
    }
    return $str;
}
///**
// * @param $status 传递的状态数量0、1、-1
// * @return string 返回的显示的正常状态
// */
//function foodStatus($status)
//{
//    $str = "";
//    if ($status == 1) {
//        $str = "<span class='label label-success radius'>已审核</span>";
//    } else if ($status == -1) {
//        $str = "<span class='label label-danger radius'>下架</span>";
//    } else if ($status == 0) {
//        $str = "<span class='label label-danger radius'>待审核</span>";
//    } else {
//        $str = "<span class='label label-danger radius'>状态未知</span>";
//    }
//    return $str;
//}

/**
 * 创建会话
 * @param $url
 * @param int $type
 * @param array $data
 * @return mixed
 */
function doCur($url, $type = 0, $data = [])
{
    // $url="http://api.map.baidu.com/geocoder/v2/?callback=renderOption&output=json&address=百度大厦&city=北京市&ak=vHOC4ouHiyvWddAsQKKr5PpsSQ1IYPCu";
    $ch = curl_init();//初始化会话句柄
    curl_setopt($ch, CURLOPT_URL, $url);//抓取的URL
    //设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);//设置header 0为不显示头部，1为显示头部
    // POST数据,post方式提交
    if ($type == 1) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    //运行cURL，请求网页
    $output = curl_exec($ch);
    curl_close($ch);// 关闭URL请求
    return $output;
}

/**
 * 分页
 * @param string $obj
 * @param bool $flag
 * @return string
 */
function paginate($obj = '', $flag = false)
{
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

