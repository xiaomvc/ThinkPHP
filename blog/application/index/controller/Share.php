<?php

namespace app\index\controller;

use think\cache\driver\Memcache;

class Share extends Base
{

    protected $obj;//model层

    //初始化
    function __construct()
    {
        $this->obj = model("share");
        parent::__construct();
    }

    /**
     * 图书分享
     * @return mixed
     */
    function books()
    {
//        $result = $this->obj->setValidate("share", "check", ["id" => 7, "title" => "女人受用一生的口才课"]);
//        dump($result);
//        exit;

        $page = input('page', '1', 'intval');
        $file = "book/page$page.html";
        if (!file_exists($file)) {
            //此处不用memcache缓存
//            if ($page > 1) {
            $books = $this->obj->getBooks(1, "desc");
//            } else {
//                $mem = new Memcache();
//                if (!$mem->has('showBook')) {
//                    $books = $this->obj->getBooks(1, "desc");
//                    $mem->set('showBook', $books);
////                    echo('来自于数据库');
//                } else {
//                    $books = $mem->get('showBook');
//                }
//        }
            if (!$books) {
                $this->error("数据错误，请稍后再试...");
            }
            //获取用户阅读量
            $ready = [];
            $number = $this->obj->getNumber();
            foreach ($number as $k => $v) {
                $ready[$v['id']] = $v['ready'];
            }
            $data = $this->fetch('', ["books" => $books, 'ready' => $ready]);
            $result = $this->setHtml($file, $data);
        }
        $this->header($file);
    }

    /**
     * 查看更多图书信息
     * @return mixed
     */
    function more()
    {
        //发布评论
        if ($_POST) {
            //发表评论
            return $this->setMessage($this->request->controller());
        }

        $id = input("id");
        if (!is_numeric($id)) {
            $this->error("参数错误");
        }
        $file = "more/book$id.html";
        if (!file_exists($file)) {
            //获取相应的图书信息
            $mem = new Memcache();
            if (!$mem->has('book' . $id)) {
                $book = $this->obj->getBooksById($id);
                $mem->set('book' . $id, $book);
                echo('来源数据库');
            } else {
                $book = $mem->get('book' . $id);
            }

            if (!$book) {
                $this->error('抱歉，没有该书本内容');
            }
            //相关推荐图书
            $sort = $this->obj->getBooksByRead(5);

            //获取登录用户信息
            $user = $this->getUserInfo();
            //获取留言表内容
            $message = model('message');
            $saying = $message->getMessage($id, $this->request->controller());
            $data = [];   //留言信息按层次分类
            foreach ($saying as $k => $v) {
                $data[$v['reply_id']][] = $v;
            }
            //浏览量
            if (!isset($_COOKIE['ready_' . $id])) {
                setcookie('ready_' . $id, '156', time() + 60);
                $result = $this->obj->setNumber($id);
            }
            $replyUrl = "/admin/share/more";
            $data = $this->fetch("", ["book" => $book, "sort" => $sort, 'user' => $user, 'message' => $data, 'replyUrl' => $replyUrl]);
            $result = $this->setHtml($file, $data);
        }
        $this->header($file);
    }

}