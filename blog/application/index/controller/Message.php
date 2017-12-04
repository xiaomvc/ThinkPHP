<?php

namespace app\index\controller;

class Message extends Base
{
    /**
     * 留言
     * @return mixed
     */
    function saying()
    {
		 //发布评论
            if ($_POST) {
                //发表评论
                return $this->setMessage($this->request->controller());
            }
        //如果文件不存在，就读取渲染后的内容到文件中
        $file = "saying.html";
        if (!file_exists($file)) {
           
            $user = $this->getUserInfo();

            //获取留言表内容
            $message = model('message');
            $saying = $message->getMessage(0, $this->request->controller());
            $data = [];   //留言信息按层次分类
            foreach ($saying as $k => $v) {
                $data[$v['reply_id']][] = $v;
            }
            //获取返回渲染后的内容
            $replyUrl = "/admin/message/saying";
            $data = $this->fetch('', ['user' => $user, 'message' => $data,"replyUrl"=>$replyUrl]);
            $result = $this->setHtml($file, $data);
        }
        $this->header($file);exit;
    }
}