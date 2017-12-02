<?php

namespace app\api\controller;

use think\Controller;
use think\Exception;
use think\Request;
use think\File;
use think\response\Json;

class Image extends Controller
{
    //处理上传图片
    function uploadImage()
    {

        try {
            //获取上传的文件信息
            //通过Request的类，可以获取到很多信息
            // $file = Request::instance()->file();//file中没有参数时，这种是获取到数组
            $fileInfo = Request::instance()->file('file');

            // $_FILES  也可以获取到上传的图片信息
            // $file->check();  File 类的方法
            //$file = new File();    //  File 文件类
            $fileInfo = $fileInfo->move('upload');
            //判断是否上传成功
            //dump($fileInfo);
            $success = 0;
            $pathName = '';
            if ($fileInfo && $fileInfo->getPathname()) {
                $success = 1;
                $pathName = $fileInfo->getPathname();
            }
            //返回json数据格式
            $data = array(
                'url' => '/'.$pathName,
                'success' => $success
            );
//            dump($data);
            return JSON($data);
        } catch (Exception $e) {
            return JSON(['url' => $e->getMessage(), 'success' => '0']);
        }
    }

}