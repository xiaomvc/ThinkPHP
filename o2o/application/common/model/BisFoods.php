<?php

namespace app\common\model;

class BisFoods extends Base
{

    //根据城市ID，查找商家合同信息和商家位置信息
    function getDealByCityId($cityId = 0)
    {
        return $this->where(['city_id' => $cityId])->select();
    }

    //根据ID，查找商家合同信息和商家位置信息
    function getDealById($Id = 0)
    {
        return $this->where(['id' => $Id])->select();
    }
    //根据bisID，查找商家合同信息
    function getDealByBidId($Id = 0)
    {
        return $this->where(['bis_id' => $Id])->select();
    }

    //根据条件，获取商家合同信息（商家商品信息）
    function getDealByCategory($data = [], $order = [])
    {
        //经典的例子
        $datas = [];//判断条件
        //判断栏目信息
        if (!empty($data['se_category_id'])) {
            //find_in_set 数据库函数，判断该值是否存在该字段
            $datas[] = "find_in_set(" . $data['se_category_id'] . ",se_category_id)";
        } elseif (!empty($data['category_id'])) {
            $datas[] = "category_id=" . $data['category_id'];
        }
//        $datas[] = "status=1";什么状态都可以查询
//        $datas[] = "(coupons_end_time >=" . time()." || coupons_end_time=0 )";


        $orderBy = [];//排序条件
        //定义排序条件
        if (!empty($order['buy_count'])) {
            $orderBy['buy_count'] = 'desc';
        } elseif (!empty($order['current_price'])) {
            $orderBy['current_price'] = 'desc';
        } elseif (!empty($order['create_time'])) {
            $orderBy['create_time'] = 'desc';
        }
        $orderBy['id'] = 'desc';


        //通过and 将$datas数组，组合成字符串
        //config("paginate.list_rows")config配置属性中的值
       return  $this->where(implode(' and ', $datas))->order($orderBy)->paginate(config("paginate.list_rows"));
//   dump($this->getLastSql());
    }
    //添加商品
    function add($data){
        return $this->save($data);
    }
}