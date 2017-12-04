<?php

namespace app\api\controller;

use think\Controller;
use think\Request;

class Image extends Controller
{
    /**
     * 图片上传处理类
     * @return \think\response\Json
     */
    function uploadImage()
    {
        //获取上传的文件信息
        $fileInfo = Request::instance()->file('file');
        //对文件进行移动
        if (empty($fileInfo)) {
            //返回数据（layUI要求返回json数据）
            return json(["error" => 1]);
        }
        $newFile = $fileInfo->move("upload");
//        dump($fileInfo);exit;
        $error = 1;
        $pathName = '';
        //判断是否移动成功
        if ($newFile && $newFile->getPathname()) {
            $error = 0;
            //上传的路径名称
            $pathName = $newFile->getPathname();
        }
        //返回数据（layUI要求返回json数据）
        $date = ['error' => $error, 'pathName' => '/' . $pathName];
        return json($date);
    }
}