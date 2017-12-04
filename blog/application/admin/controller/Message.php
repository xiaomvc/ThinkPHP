<?php

namespace app\admin\controller;

class Message extends Base
{
    /**
     * 留言
     * @return mixed
     */
    function saying()
    {
        //发表评论
        if ($_POST) {

            return $this->setMessage($this->request->controller());
            exit;
        }
        $file = "admin/saying.html";
        if (!file_exists($file)) {
            $user = $this->getUserInfo();
//        if(!$user){
//            $this->error('用户状态出现问题，请刷新再试。。');
//        }

            //获取留言表内容
            $message = model('message');
            $saying = $message->getMessage(0, $this->request->controller());
            $data = [];   //留言信息按层次分类
            foreach ($saying as $k => $v) {
                $data[$v['reply_id']][] = $v;
            }
            $data = $this->fetch('', ['user' => $user, 'message' => $data]);
            $this->setHtml($file, $data);
        }
        $this->header($file);
    }
}