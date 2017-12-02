<?php

namespace app\common\model;

class User extends Base
{
    //自动更新时间
    protected $autoWriteTimestamp=true;
    /**
     * 验证登录信息
     * @param $data
     * @return int
     */
    function checkLogin($data)
    {
        //先判断用户名是否存在
        $user = $this->where(['username' => $data['username']])->find();
        //在判断用户密码是否正确
        if ($user) {
            if ($user['openid'] == $data['openid']) {
                return ['error' => 0, 'user' => $user]; //登录成功
            } else {
                return ['error' => 1];   //密码错误
            }
        } else {
            return ['error' => -1];  //账号名称不存在
        }
    }

    /**
     * 添加用户
     * @param array $data
     * @return false|int|mixed
     */
    function addUser($data = [])
    {
        $user = $this->save($data);
        return $user;
    }

    /**
     * @param $userid
     * @return array|false|\PDOStatement|string|Model
     */
    function getUserInfo($userid)
    {
        return $this->find(['id' => $userid, 'status' => 1]);
    }

    /**
     * 获取第三方用户登录信息
     * openID判断
     * @param $data
     * @return array|false|\PDOStatement|string|Model
     */
    function getUser($data)
    {
        return $this->where(['openid' => $data['openid']])->find();
    }

    /**
     * 更新登录用户的信息
     * @param $data
     * @return false|int
     */
    function editUser($data)
    {
        return $this->save(['username' => $data['username'], 'logo' => $data['logo']], ['openid' => $data['openid']]);
    }

}