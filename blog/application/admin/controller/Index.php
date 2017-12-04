<?php

namespace app\admin\controller;


use think\cache\driver\Memcache;

class Index extends Base
{
    private $obj;//model

    /**
     * 初始化
     * Index constructor.
     */
    function __construct()
    {
        $this->obj = model("share");
        parent::__construct();
    }

    /**
     * 首页，时间轴形式显示图书
     * @return mixed
     */
    public function index()
    {
        $file = "admin/index.html";
        if (!file_exists($file)) {
            //memcache 缓存
            $mem = new Memcache();
            // $mem->clear();
            //图书信息
            if (!$mem->has('memBook')) {
                $books = $this->obj->getBooks(1, "desc");
                $mem->set('memBook', $books);
//                echo("来自数据库");
            } else {
                //读取缓存数据
                $books = $mem->get('memBook');
            }

            //根据阅读量排序后的图书信息
            if (!$mem->has('memSort')) {
                $sortBooks = $this->obj->getBooksByRead();
                $mem->set('memSort', $sortBooks);
//                echo("来自数据库2");
            } else {
                //读取缓存数据
                $sortBooks = $mem->get('memSort');
            }
            //判断
            if ($books === false || $sortBooks === false) {
                $this->error("数据错误，请稍后再试");
            }
            $data = $this->fetch("", [
                "books" => $books,      //图书列表
                "sortBooks" => $sortBooks   //推荐阅读
            ]);
            $result = $this->setHtml($file, $data);
        }
        $this->header($file);
    }
}
