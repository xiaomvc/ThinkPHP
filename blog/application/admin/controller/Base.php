<?php

namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{

    /**
     * 初始化判断
     * Base constructor.
     */
    function __construct()
    {
        //可以随时访问（公共的）
        $bash = "User-login,User-verifyimg,User-adduser,User-exitlogin,User-otherlogin,User-callback";
        $url = request()->controller() . '-' . request()->action();
//        dump($url);
        //判断是否允许登录
        if (!in_array($url, explode(',', $bash))) {

            if (!$this->getUserInfo()) {
                //先登录
                $this->redirect('/admin/user/login');
            }
        }
        parent::__construct();
    }

    /**
     * 获取登录用户的信息
     * @return array|bool
     */
    function getUserInfo()
    {
        //判断是否有登陆
        $username = session('username', '', 'user');
        $logo = session('logo', '', 'user');
        $id = session('id', '', 'user');
        $user = "li,admin";//允许登录人员
        if (empty($username) || !substr_count($user, $username)) {
            return false;
        }
        //用户信息
        $user = [
            'username' => $username,
            'logo' => $logo,
            'id' => $id,
        ];
        return $user;
    }

    //发布评论
    function setMessage($table = null)
    {
        if ($_POST) {
            //发布评论
            $data = [
                'user_id' => empty(session('id', '', 'user')) ? -1 : session('id', '', 'user'),
                'note_id' => input('noteid', 0, "intval"),
                'reply_id' => input('replyid', 0, 'intval'),
                'tablename' => $table,
                'content' => input('introduce'),
                'create_time' => time()
            ];

            //添加留言
            $message = model('message');
            $result = $message->addMessage($data);
            //判断是否添加成功
            if ($result) {
                $userInfo = model('user')->getUserInfo($data['user_id']);

                if (!$userInfo) {
                    return ['error' => 1, 'msg' => '该用户状态出现问题'];
                }
                //添加用户的信息
                $data['username'] = $userInfo['username'];
                $data['logo'] = $userInfo['logo'];

                $data['create_time'] = date('Y-m-d H:i:s', $data['create_time']);
                $data['id'] = $message->id;//添加id值

                $bookid = $data["note_id"];
                $this->delHtml("admin/saying.html");
                $this->delHtml("saying.html");
                $this->delHtml("more/book$bookid.html");

                return ['error' => 0, 'msg' => $data];
            } else {
                return ['error' => 1, 'msg' => '添加失败，请刷新后再试'];
            }
        }
    }

    /**
     * 生成静态化文件
     * @param $url
     * @param $data
     * @return bool
     */
    function setHtml($file, $data)
    {
        if (substr_count($file, "/")) {
            //判断是否有目录
            $dir = explode("/", $file)[0];
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
        }
        $result = file_put_contents($file, $data);
        if (!$result) {
            $this->error("文件出错");
        }
    }

    //跳转
    function header($file)
    {
        $location = "//" . $_SERVER['HTTP_HOST'] . "/" . $file;
        header("Location:" . $location);
        exit;
    }

    /**
     * 删除HTML后缀的文件
     */
    function delHtml($dirName)
    {
        //判断是否为文件
        if (!is_dir($dirName)) {
            if (file_exists($dirName)) {
                unlink($dirName);
            }

        } else {
            //打开文件目录
            if ($handle = opendir("$dirName")) {
                //读取目录下的文件
                while ($item = readdir($handle)) {
                    //dump($item);前两个为 . 和  ..
                    if ($item != "." && $item != "..") {
                        //判断后缀是否为HTML
                        if (explode(".", $item)[1] == "html") {
                            if (unlink("$dirName/$item")) {
//                                dump("删除成功" . $dirName . "/" . $item);
                            }
                        }
                    }
                }
            }
        }

    }

}