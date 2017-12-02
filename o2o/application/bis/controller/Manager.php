<?php

namespace app\bis\controller;

class Manager extends Base
{

    /**
     * 商家详细信息
     * @return mixed
     */
    function detail()
    {
        //获取登录的用户id
        $bis = $this->getLoginUser();

        //htmlentities()//过滤方法
        $data['id'] = $bis['bisId'];
        $Info = model('bis')->getBisById($data['id'], '', true);//商户信息(已删除的商家也可以查询)

        if (!$Info) {
            $this->error('信息错误，请稍后再试。。。', URL('index'));

        }

        $firstCityInfo = model('city')->getFirstCityInfo();//一级城市目录

        $secondCityInfo = model('city')->getSecondCityInfo($Info['city_id']);//二级城市目录

        $bisLocation = model('bisLocation')->getLocationById($Info['id'], true);//商户的位置信息

        $firstCategory = model('category')->getCategory();//一级分类栏目

        $secondCategory = model('category')->getCategory($bisLocation['category_id']);//二级分类栏目

        //判断类别路径中有没有逗号（有没有二级目录）
        $category_path = 0;
        if (substr_count($bisLocation['category_path'], ',') > 0) {
            $category_path = explode(',', $bisLocation['category_path'])[1];//通过逗号拆分
        };

        //二级城市目录id（判断路径中有没有二级城市）
        $city_path = -1;
        if (substr_count($Info['city_path'], ',') > 0) {
            $city_path = explode(',', $Info['city_path'])[1];
        }

        $account = model('bisAccount')->getAccountLocationById($Info['id'], true);

//        if (!$account) {
//            $this->error('数据出错');
//        }
//        dump($Info);exit;
        return $this->fetch('',
            ['Info' => $Info,       //商户信息
                'firstCityInfo' => $firstCityInfo,      //一级城市
                'secondCityInfo' => $secondCityInfo,    //二级城市
                'city_path' => $city_path,      //二级城市id路径
                'bisLocation' => $bisLocation,      //商户位置信息
                'firstCategory' => $firstCategory,      //一级类别
                'secondCategory' => $secondCategory,        //二级类别
                'category_path' => $category_path,     //二级类别的id路径
                'bisId' => $data['id'],
                'account' => $account,
            ]
        );
    }

    /**
     * 修改商户信息
     */
    function updateBis()
    {
        //商户修改商户信息
        if (input('post.')) {

            $name = input('bisName');
            $denglu = input('denglu');
            $bisId = input('bisId');
            //判断店铺名或账号名是否存在
            $bisName = model('bis')->getBisByName($name, $bisId, true);

            if ($bisName && !empty($bisName)) {
                return ['success' => -1, 'msg' => '商铺名重复', 'name' => 'bisName'];
            }
            $bisName = model('bisAccount')->getBis($denglu, $bisId, true);
//            dump($bisNames);exit;
            if ($bisName && !empty($bisName)) {
                return ['success' => -1, 'msg' => '账号名重复', 'name' => 'denglu'];
            }

            //收集表单数据
            $data = [
                'bisName' => input('bisName'),
                'fi_city_id' => input('fi_city_id'),
                'se_city_id' => input('se_city_id'),
                'licence_logo' => input('licence_logo'),
                'logo' => input('logo'),
                'description' => input('description'),
                'bank_info' => input('bank_info'),
                'bank_name' => input('bank_name'),
                'bank_user' => input('bank_user'),
                'faren' => input('faren'),
                'faren_tel' => input('faren_tel'),
                'email' => input('email'),
                'username' => input('username'),
                'tel' => input('tel'),
                'category_id' => input('category_id'),
                'se_category_id' => input('se_category_id'),
                'address' => input('address'),
                'open_time' => input('open_time'),
                'content' => input('content'),
                'denglu' => input('denglu'),
                'password' => input('password'),
            ];
            $bis = [
                'name' => $data['bisName'],
                'email' => $data['email'],
                'logo' => $data['logo'],
                'licence_logo' => $data['licence_logo'],
                'description' => $data['description'],
                'city_id' => $data['fi_city_id'],
                'city_path' => empty($data['se_city_id']) ? $data['fi_city_id'] : $data['fi_city_id'] . ',' . $data['se_city_id'],
                'bank_info' => $data['bank_info'],
                'bank_name' => $data['bank_name'],
                'bank_user' => $data['bank_user'],
                'faren' => $data['faren'],
                'faren_tel' => $data['faren_tel'],
            ];
            //添加商户
            $id = model('Bis')->updateBis($bisId, $bis);

            if ($id === false) {
                return ['success' => 0, 'msg' => '修改失败'];
            }

            $code = rand(1000, 9999);
            $bisAccount = [
                'username' => $data['denglu'],
                'password' => md5($data['password'] . $code),
                'code' => $code,
                'last_login_ip' => request()->ip(),
                'last_login_time' => time(),
            ];
            $id = model('bisAccount')->updateBis($bisId, $bisAccount);

            // dump($bisAccount);
            if ($id === false) {
                return ['success' => 0, 'msg' => '修改失败'];
            }

            $address = $data['address'];
            //获取地理坐标
            $location = \Map::getLngLat($address);

            //默认北京百度创业中心
            $xpoint = '116.241103';
            $ypoint = '39.957396';
            if ($location['status'] == 0 && !empty($location)) {
                $xpoint = $location['result']['location']['lng'];
                $ypoint = $location['result']['location']['lat'];
            }

            $bisLocation = [
                'name' => $data['bisName'],
                'logo' => $data['logo'],
                'tel' => $data['tel'],
                'contact' => $data['username'],
                'xpoint' => $xpoint,
                'ypoint' => $ypoint,
                'open_time' => $data['open_time'],
                'content' => $data['content'],
                'api_address' => $data['address'],
                'city_id' => $data['fi_city_id'],
                'city_path' => empty($data['se_city_id']) ? $data['fi_city_id'] : $data['fi_city_id'] . ',' . $data['se_city_id'],
                'category_id' => $data['category_id'],
                'category_path' => empty($data['se_category_id']) ? $data['category_id'] : $data['category_id'] . ',' . $data['se_category_id'],

            ];

            //添加商户位置信息
            $locationId = model('BisLocation')->updateBis($bisId, $bisLocation);
            if ($locationId === false) {
                return ['success' => 0, 'msg' => '修改失败'];
            }
            return ['success' => 1, 'msg' => '修改成功'];
        }


    }

    /**
     * 激活商家
     */
    function jihuo()
    {
        $bisId = input('id');
        $code = input('code');
	
        if (empty($bisId) || empty($code)) {
            print('商家入驻信息错误');
            exit;
        }
        //验证商户信息
        $bis = model('BisAccount')->jihuo($bisId, $code);

        if ($bis && !empty($bis)) {

            $data = ['id' => $bisId, 'status' => $code];
            $statusOne = model('Base')->status("bis", $data);
            $statusTwo = model('Base')->statusByBis($data, "BIsAccount");
            $statusThree = model('Base')->statusByBis($data, "BisLocation");
            if ($statusOne && $statusTwo && $statusThree) {
                	$this->success("注册成功,前去登录。。", 3, "/bis/user/login");

            }
           
	   $this->error("注册失败或已注册", 3, "/bis/user/login");

        }

        $this->error("信息验证错误，注册失败", 3, "/bis/user/login");
    }

    /**
     * 商户信息
     * @return mixed
     */
    function index()
    {
        //获取登录的用户id
        $bis = $this->getLoginUser();

        //htmlentities()//过滤方法
        $id = $data['id'] = $bis['bisId'];
        //不分状态
        $bis = model('bis')->getBisById($id, '', true);
//        dump($bis);exit;
        if ($bis && !empty($bis)) {

        } else {
            $this->error('状态错误');
        }

        return $this->fetch('', ['bisInfo' => $bis]);
    }

    /**
     * 删除商家信息
     * @return bool
     */
    function del()
    {
        $data['id'] = input('id', 0, 'intval');
        $data['status'] = 0;

        $res = model('Base')->status($data, "bis");

        if ($res) {
            //  return ['success'=>1];
            return true;
        }
        return false;
    }

    /**
     * 退出登录
     */
    function exitLogin()
    {
        session('bisId', null, 'bis');
        session('bisName', null, 'bis');
        $this->redirect('/bis/user/login');
    }
}