<?php

namespace app\index\controller;

use think\Controller;

class Base extends Controller
{

    /**
     * 初始化判断
     * Base constructor.
     */
    function __construct()
    {
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
        if (empty($username) || empty($logo) || empty($id)) {
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
        //发布评论
        $data = [
            'user_id' => empty(session('id', '', 'user')) ? -1 : session('id', '', 'user'),
            'note_id' => empty(input('id')) ? 0 : input('id'),
            'reply_id' => input('replyid', 0, 'intval'),
            'tablename' => $table,
            'content' => input('introduce'),
            'create_time' => time()
        ];

        //添加留言
        $message = model('message');
        $result = $message->addMessage($data);
        //判断是否添加成功
        if ($result == 1) {
            $userInfo = model('user')->getUserInfo($data['user_id']);
            if (!$userInfo) {
                return ['error' => 1, 'msg' => '该用户状态出现问题'];
            }
            //添加用户的信息
            $data['username'] = $userInfo['username'];
            $data['logo'] = $userInfo['logo'];

            $data['create_time'] = date('Y-m-d H:i:s', $data['create_time']);
            $data['id'] = $message->id;//添加id值
            return ['error' => 0, 'msg' => $data];
        } else {
            return ['error' => 1, 'msg' => '添加失败，请刷新后再试'];
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
}