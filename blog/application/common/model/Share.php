<?php

namespace app\common\model;

class Share extends Base
{

    /**
     * 添加图书
     * @param $data
     * @return false|int
     */
    function addBooks($data)
    {
        return $this->save($data);
    }

    /**
     * 通过标题查找图书
     * @param null $title
     * @param int $status
     * @return array|false|\PDOStatement|string|Model
     */
    function getBooksByTitle($title = null, $status = 1)
    {
        return $this->where(["title" => $title, "status" => $status])->find();
    }

    /**
     * 通过id查找图书
     * @param $id
     * @param int $status
     * @return false|\PDOStatement|string|\think\Collection
     */
    function getBooksById($id, $status = 1)
    {
        return $this->where(["id" => $id, "status" => $status])->find();
    }

    /**
     * 根据状态查找图书信息
     * 先按produce_time发布时间，在按id排序1506700800
     * @param int $status 状态
     * @param $sort     排序的循序desc asc
     * @return false|\PDOStatement|string|\think\Collection
     */
    function getBooks($status = 1, $sort)
    {
        return $this->where(["status" => $status])->order("produce_time " . $sort . ",id")->paginate(config("paginate.list_rows"));
    }

    /**
     * 按量查询数据
     * @param $start
     * @param $count
     * @return false|\PDOStatement|string|\think\Collection
     */
    function getBooksByCount($start, $count, $sort)
    {
        if (empty($sort)) {
            return $this->where(['status' => 1])->order("id desc")->limit($start, $count)->select();
        } else {
            return $this->where(['status' => 1])->order("ready " . $sort . ",id")->limit($start, $count)->select();
        }
    }

    /**
     * 根据阅读量进行排序,状态进行查询
     * @param int $status
     * @param string $sort
     * @return false|\PDOStatement|string|\think\Collection
     */
    function getBooksByRead($num = 3, $status = 1, $sort = "desc")
    {
        return $this->where(["status" => $status])->order("ready " . $sort)->limit($num)->select();
    }

    /**
     * 通过id，逻辑删除图书信息
     * @param $id
     * @return false|int
     */
    function dealBook($id)
    {
        return $this->save(["status" => 0], ["id" => $id]);
    }

    /**
     * 阅读量
     * @param int $id
     * @return mixed
     */
    function setNumber($id = 0)
    {
        $sql = "update blog_share set ready=ready+1 where id=" . $id;
        return $this->query($sql);
    }

    /**
     * 获取阅读量
     * @return false|\PDOStatement|string|\think\Collection
     */
    function getNumber()
    {
        return $this->field('id,ready')->select();
    }

    /**
     * 更新图书信息
     * @param $data
     * @return false|int
     */
    function editBook($data)
    {
        return $this->save(["title" => $data['title'], "logo" => $data["logo"], "url" => $data["url"], "produce_time" => $data["produce_time"], "introduce" => $data["introduce"]], ['id' => $data['id']]);
    }

}