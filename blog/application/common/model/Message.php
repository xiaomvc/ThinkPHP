<?php

namespace app\common\model;

class Message extends Base
{
    /**
     * 添加留言
     * @param $data
     * @return false|int
     */
    function addMessage($data = [])
    {
        return $this->save($data);
    }

    /**
     * 获取留言
     * @param int $noteid
     * @param string $tbname
     * @return false|\PDOStatement|string|\think\Collection
     */
    function getMessage($noteid = -1, $tbname = "Share")
    {
        return $this->alias('m')->join('user u', "m.user_id=u.id")->where(['u.status' => 1, 'm.note_id' => $noteid, 'm.tablename' => $tbname])->field('m.id,m.reply_id,m.content,m.create_time,u.username,u.logo')->select();
    }
}