<?php

namespace app\common\model;

class User extends Base
{
    /**
     * 注册信息
     * @param $data
     * @return false|int
     */
    function register($data)
    {
        return $this->save($data);
    }

    /**
     * 通过名字查找用户的信息
     */
    function getUserByName($name)
    {
        return $this->where(['username' => $name])->find();
    }

    /**
     * 获取QQ登录用户信息（判断是否有登录过）
     * @param $token
     * @param $openid
     * @return array|false|\PDOStatement|string|\think\Model
     */
    function getQQinfo($token,$openid)
    {
        return $this->where(['token' => $token,'openId'=>$openid])->find();
    }

    /**
     *修改QQ登录的数据
     * @param $data
     * @param $token
     * @param $openid
     * @return false|int
     */
    function qqUpdate($data,$token,$openid)
    {
        return  $this->save($data,['token' => $token,'openId'=>$openid]);
    }
}