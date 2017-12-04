<?php

namespace app\api\controller;

use think\Controller;
use think\Request;

class V1 extends Controller
{
    private $obj;

    function __construct(Request $request = null)
    {
        $this->obj = model("share");
        parent::__construct($request);
    }

    /**
     * 获取图书信息
     * @return \think\response\Json
     */
    function book()
    {
        $start = input("start", 0, "intval");
        $count = input("count", 10, "intval");
        $sort = input("sort");
        $result = $this->obj->getBooksByCount($start, $count, $sort);

        $data = $this->makeData($result);

        return json(["error" => 0, "msg" => "ok", "data" => $data]);
    }

    /**
     * 搜索信息
     */
    function search()
    {
        $id = input("id");
        if (empty($id) || !is_numeric($id)) {
            return json(["error" => 1, "msg" => "参数错误"]);
            exit;
        }
        $result = $this->obj->getBooksById($id);
        $data = $this->makeData($result);
        return json(["error" => 0, "msg" => "ok", "data" => $data]);
    }

    /**
     * 获取留言信息
     */
    function saying()
    {
        $id = input("id", -1, "intval");
        $result = model("message")->getMessage($id);
        $data = [];
        if (!empty($result)) {
            foreach ($result as $key => $item) {
                if ($item['reply_id'] == 0) {
                    $data[$key] = [
                        "id" => $item['id'],
                        "reply_id" => $item['reply_id'],
                        "content" => cutstr_html($item['content'],1000),
                        "username" => $item['username'],
                        "logo" => "http://119.23.14.98" . $item['logo']
                    ];
                }
            }
        }

        return json(['error'=>0,"data"=>$data]);
    }

    /**
     * 处理数据库返回的数据
     * @param $result
     * @return array
     */
    function makeData($result)
    {
        $data = [[]];
        //判断数组的长度
        foreach ($result as $key => $item) {
            $data[$key] = [
                "id" => $item['id'],
                "title" => $item['title'],
                "logo" => "http://119.23.14.98" . $item['logo'],
                "ready" => $item['ready'],
                "introduce" => cutstr_html($item['introduce'], 20),
                "detail" => html_entity_decode($item['introduce'])
            ];
        }
        if (count($result) == 1) {
            $data = [
                "id" => $result['id'],
                "title" => $result['title'],
                "logo" => "http://119.23.14.98" . $result['logo'],
                "ready" => $result['ready'],
                "introduce" => cutstr_html($result['introduce']),
                "detail" => html_entity_decode($result['introduce'])
            ];
        }
        return $data;
    }
}
