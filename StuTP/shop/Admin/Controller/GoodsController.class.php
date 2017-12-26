<?php

namespace Admin\Controller;

use tools\AdminController;
use tools;
use Think\Image;

//use Think;

class GoodsController extends AdminController
{
    //显示列表
    function showlist()
    {
        $goods = D('goods');    //实例化父类Model对象，同时操作goods数据表
        //(1)获取总的数据行数和要显示的行数
        $count = $goods->count();
        dump($count);
        $per = 8;
        //(2)实例化分页类的对象
        $page = new tools\Page($count, $per);
        //自定义SQL语句
        $sql = 'select * from sw_goods ORDER  BY goods_id DESC  ' . $page->limit;
        $info = $goods->query($sql);
        //调用显示跳转链接的HTML
        $showPage = $page->fpage(array(3, 4, 5, 6, 7, 8));
        //把查找到的数据和分页链接填充到模板中
        $this->assign('info', $info);
        $this->assign('showPage', $showPage);


        $this->display();

        //给新添加的商品生成静态文件：
        ob_start();//开启php缓冲区
        $cont = ob_get_contents();//收集内容、并制作静态文件
        file_put_contents("./_detail.html", $cont); //./Goods/174_detail.html
        ob_end_clean();//删除php缓冲区内容并关闭缓冲区
    }

    //添加信息
    function addlist()
    {
        //$_POST方式获得的数据信息
        /*           array(5) {
                       ["f_goods_name"] => string(1) "1"
                       ["f_goods_category_id"] => string(1) "0"
                       ["f_goods_brand_id"] => string(1) "0"
                       ["f_goods_price"] => string(1) "2"
                       ["f_goods_introduce"] => string(1) "3"
       }*/
        //判断是那种提交方式  get或post
        if (!empty($_POST)) {
            $goods = new \Model\GoodsModel();
            //检验表单中的信息
            $data = $goods->create();
            //   dump($data);


            //  dump($goods->getError());
            //  dump($_FILES['goods_img']);
            //文件保存的位置
            $dir = './public/uploads';
            //修改上传类中的属性，调用上传单个文件的方法
            $cfg = array(
                'rootPath' => $dir . '/',//保存根路径
            );
            $file = new tools\Upload($cfg);

            //判断目录是否存在
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            //如果附件上传成功，就可以通过uploadOne的返回值查看到附件
            //在服务器的存储情况
            $upInfo = $file->uploadOne($_FILES['goods_img']);

            //$_FILES 中的信息
            /*     array(5) {
                ["name"] => string(5) "3.jpg"
                ["type"] => string(10) "images/jpeg"
                ["tmp_name"] => string(27) "C:\Windows\temp\phpFA74.tmp"
                ["error"] => int(0)
                ["size"] => int(260018)
        }*/
            // dump($upInfo);
            //上传文件得到的信息
            /*
             * ["name"] => string(5) "6.jpg"
            ["type"] => string(10) "images/jpeg"
            ["size"] => int(100846)
            ["key"] => int(0)
            ["ext"] => string(3) "jpg"
            ["md5"] => string(32) "88efe9611e98a12ce352140f0bfdcfb8"
            ["sha1"] => string(40) "fef261bbf88f7587d2f662e5f439b3edb955cecd"
            ["savename"] => string(17) "5958bddc0d5f4.jpg"
            ["savepath"] => string(11) "2017-07-02/"
            }*/

            //保存到服务器中的路径
            $goodsimg = $file->rootPath . $upInfo['savepath'] . $upInfo['savename'];
            //保存到数据库的图片路径
            $goods_big_img = $upInfo['savepath'] . $upInfo['savename'];
            dump($goodsimg);
            //   exit;
            //练习：图片水印
            /* $pi = new \Think\Images();
             $pi->open($goodsimg);
             $pi->water('./public/uploads/2017-06-29/1111.jpg',9,80);
             $pi->save('./public/uploads/2017-06-29/121212.jpg');
             dump($pi);
            */
            //获取上传文件的错误，把信息填充到模板中
            $uperror = $file->getError();
            $this->assign('uperror', $uperror);
            //判断表单中的信息和图片是否规范
            if ($data && empty($uperror)) {
                //    $pi = new Think\Images();  //  use Think;
                $pi = new Image();  //    use Think\Images;
                $pi->open($goodsimg);
                $pi->thumb(200, 200);
                //保存到数据库中的缩略图
                $goods_small_img = $upInfo['savepath'] . '_small_' . $upInfo['savename'];
                //保存到服务器中的路径
                $small_img = $dir . '/' . $goods_small_img;
                $pi->save($small_img);

                //添加当前时间的 Unix 时间戳
                //添加图片
                $data['goods_create_time'] = time();
                $data['goods_big_img'] = $goods_big_img;
                $data['goods_small_img'] = $goods_small_img;

                //对富文本编辑器原生内容进行过滤，方式xss攻击
                //htmlpurifier过滤
                //1.先获取原生数据
                $introduce = $_POST['goods_introduce'];
                //2.对原生数据进行过滤
                $introduce = \fanXSS($introduce);
                //3.对过滤后的数据进行保存
                $data['goods_introduce'] = $introduce;


                dump(time());//如：98664709
                $result = $goods->add($data);
                // dump($result);
                // $this->redirect('showlist', array(), 2, '添加成功');
                dump('添加成功');
            } else {
                //把错误信息填充到模板中
                $this->assign('errinfo', $goods->getError());
                //$this->redirect('addlist', array(), 3, '添加失败');
            }
        }
        $this->display();
    }

//更新列表信息
//http://localhost/stuTP/shop/index.php/Admin/Goods/showlist/goods_id/2.html
    function updatelist()
    {
        //获得参数
        $goods_id = I('goods_id');
        //判断$goods_id 的参数是否为数字
        //如果不是数字，就会提示并且终止后面的代码执行
        echo($goods_id);
        is_numeric($goods_id) or die('参数错误');

        $goods = D('goods');
        //判断是那种提交方式
        if (!empty($_POST)) {
            dump($_POST);
            //收集表单信息
            $data = $goods->create();
            $result = $goods->save($data);
            //或者直接$goods->save($_POST);
            dump($result);
            //跳转到相应的页面
            if ($result) {
                $this->redirect('showlist', array(), 3, '修改成功');
            } else {

                $_POST = '';
                dump($_POST);

                $this->redirect('updatelist', array('goods_id' => $goods_id), 3, '修改有错误');
            };
        } else {
            // dump($goods_id);
            $upinfo = $goods->find($goods_id);
            if (!empty($upinfo)) {
                dump($upinfo['goods_introduce']);
                $this->assign('info', $upinfo);
            } else {
                $this->redirect('showlist', array(), 3, '没有数据');
            }
        }
        $this->display();
    }
}
