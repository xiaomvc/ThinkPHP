<?php

namespace app\admin\controller;

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
        $file = "admin/book$page.html";
        if (!file_exists($file)) {
            //此处不用memcache缓存
//            if ($page > 1) {
//                $books = $this->obj->getBooks(1, "desc");
//
//            } else {
//                $mem = new Memcache();
//                if (!$mem->has("showBook$page")) {
                $books = $this->obj->getBooks(1, "desc");
//                    $mem->set("showBook$page", $books);
//                    echo('来自于数据库');
//                } else {
//                    $books = $mem->get("showBook$page");
//                }
//            }
            if (!$books) {
                $this->error("数据错误，请稍后再试...");
            }
            $data = $this->fetch('', ["books" => $books]);
            $this->setHtml($file, $data);
        }
        $this->header($file);
    }

/**
 * 图书添加
 * @return mixed
 */
function add()
{
    if ($_POST) {
        //图书添加的数据
        $data = [
            "title" => input("title"),
            "logo" => input("logo"),
            "url" => input("url"),
            "produce_time" => strtotime(input("time")),
            "introduce" => input("introduce"),
        ];
        //验证数据是否符合规范
        $validate = $this->obj->setValidate(request()->controller(), 'add', $data);
        if ($validate) {
            return json(["error" => -1, "msg" => $validate]);
        }

        //检查书名（标题）是否存在
//            $result = $this->obj->getBooksByTitle($data["title"]);
//            if ($result) {
//                return json(["error" => -1, "msg" => "书的标题重复"]);
//            }
        //添加图书
        $result = $this->obj->addBooks($data);
        if ($result) {
            //删缓存
            $mem = new Memcache();
            $mem->rm('memBook');
//            $mem->rm('showBook');
//                $mem->rm("adshowBook1");

            $this->delHtml("book");
            $this->delHtml("admin");
            $this->delHtml("index.html");

            return json(["error" => 0, "msg" => "添加成功"]);
        } else {
            return json(["error" => 1, "msg" => "添加失败，请稍后再试"]);
        }
    }
    $file = "admin/add.html";
    if (!file_exists($file)) {
        $data = $this->fetch('');
        $this->setHtml($file, $data);
    }
    $this->header($file);
}

/**
 * 图书修改
 * @return mixed
 */
function edit()
{
    if ($_POST) {
        //图书添加的数据
        $data = [
            "title" => input("title"),
            "logo" => input("logo"),
            "url" => input("url"),
            "produce_time" => strtotime(input("time")),
            "introduce" => input("introduce"),
            "id" => input('id')
        ];
        $validate = $this->obj->setValidate(request()->controller(), 'edit', $data);
        //判断数据是否规范
        if ($validate) {
            return ['error' => -1, 'msg' => $validate];
        }
        //修改图书信息
        $result = $this->obj->editBook($data);
        $id = $data['id'];
        if ($result) {
            $mem = new Memcache();
            $mem->rm('book' . $id);
            $mem->rm("memBook");
//            $mem->rm("showBook");

            $this->delHtml("more/book$id.html");
            $this->delHtml("admin");
            $this->delHtml("book");
            $this->delHtml("index.html");

            return ['error' => 0, 'msg' => "修改成功"];
        }
        return ['error' => 1, 'msg' => "修改失败"];

    }
    $id = input("id");
    if (!is_numeric($id)) {
        $this->error("参数错误");
    }

    $file = "admin/edit$id.html";
    if (!file_exists($file)) {
        //获取相应的图书信息
        $mem = new Memcache();
        if (!$mem->has('book' . $id)) {
            $book = $this->obj->getBooksById($id);
            $mem->set('book' . $id, $book);
//                echo('来源数据库');
        } else {
            $book = $mem->get('book' . $id);
        }
        if (!$book) {
            $this->error('拿不到数据');
        }

        $data = $this->fetch("", ["book" => $book]);
        $this->setHtml($file, $data);
    }
    $this->header($file);
}

/**
 *  删除图书
 * @return \think\response\Json
 */
function deal()
{
    if ($_POST) {
        $id = input("id");
        if (!is_numeric($id)) {
            $this->error("参数错误");
        }
        $resutl = $this->obj->dealBook($id);
        //恒判断
        if ($resutl === false) {
            return json(["error" => 1, "msg" => "删除失败"]);
        } else {
            //删除成功是，删除相应缓存
            $mem = new Memcache();
            $mem->rm('memBook');
            $mem->rm('book' . $id);
            $mem->rm("memSort");
//            $mem->rm("showBook");

            $this->delHtml("more/book$id.html");
            $this->delHtml("book");
            $this->delHtml("index.html");
            $this->delHtml("admin");

            return json(["error" => 0, "msg" => "删除成功"]);
        }
    }
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
//                echo('来源数据库');
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

        $data = $this->fetch("", ["book" => $book, "sort" => $sort, 'user' => $user, 'message' => $data]);
        $this->setHtml($file, $data);
    }
    $this->header($file);
}
}