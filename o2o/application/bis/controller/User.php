<?php

namespace app\bis\controller;


class User extends Base
{
    /**
     * 商户登录账号
     * @return mixed
     */
    function login()
    {
        if ($this->isLogin()) {
            $this->redirect('/bis/index/index');
        }
        if (input('post.')) {
            $userName = input('userName');
            $password = input('password');
            $bis = model('BisAccount')->getBis($userName);

            if ($bis && !empty($bis)) {
                if ($bis['password'] === md5($password . $bis['code'])) {
                    session('bisId', $bis['bis_id'], 'bis');
                    session('bisName', $bis['username'], 'bis');
                    return ['success' => 1, 'msg' => '登录成功'];
                }
            }
            return ['success' => 0, 'msg' => '账号或密码错误'];
        }

        return $this->fetch();
    }

    /**
     * 商户申请入驻
     * @return mixed
     */
    function register()
    {
        //商户申请入驻异步提交
        if (input('post.')) {
		
//            dump(input('.'));exit;
            //检查账号是否重复
            $name = input('bisName');
            $bisName = model('bis')->getBisByName($name);
            if ($bisName && !empty($bisName)) {
                return ['success' => -1, 'msg' => '商铺名重复', 'name' => 'bisName'];
            }

            $denglu = input('denglu');
            $denglu = model('bisAccount')->getBis($denglu);
            if ($denglu && !empty($denglu)) {
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
                'status' => 1,
            ];
            //添加商户
            $id = model('bis')->addBis($bis);

            if ($id <= 0) {
                return ['success' => 0, 'msg' => '申请失败'];
            }


            $code = rand(1000, 9999);
            $bis_id = $id;//商户主键
            $bisAccount = [
                'username' => $data['denglu'],
                'password' => md5($data['password'] . $code),
                'code' => $code,
                'bis_id' => $bis_id,
                'last_login_ip' => request()->ip(),
                'last_login_time' => time(),
                'status' => 1,
            ];
            //添加商家账号信息
            $bisAccountId = model('bisAccount')->addBis($bisAccount);
            if ($bisAccountId <= 0) {
                return ['success' => 0, 'msg' => '申请失败'];
            }

            $adress = $data['address'];
            //获取地理坐标
            $location = \Map::getLngLat($adress);
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
                'bis_id' => $bis_id,
                'open_time' => $data['open_time'],
                'content' => $data['content'],
                'api_address' => $data['address'],
                'city_id' => $data['fi_city_id'],
                'city_path' => empty($data['se_city_id']) ? $data['fi_city_id'] : $data['fi_city_id'] . ',' . $data['se_city_id'],
                'category_id' => $data['category_id'],
                'category_path' => empty($data['se_category_id']) ? $data['category_id'] : $data['category_id'] . ',' . $data['se_category_id'],
                'status' => 1,
            ];
            //添加商户位置信息
            $locationId = model('BisLocation')->addBis($bisLocation);
            if ($locationId <= 0) {
                return ['success' => 0, 'msg' => '申请失败'];
            }
            $content = "你好，欢迎商家入驻，我们这里有最好的...,等待你去发现，<a href='61xiaok.xin/bis/manager/jihuo?id=" . $bis_id . "&code=" . $code." target='_blank'>立即激活商家</a>";
			$title = "商家入驻情况";

           // $result = \phpmailer\Mail::send($content, $title,trim($data['email']));
			
           // if ($result['success'] == 0) {
            //    return '申请中,无法发送邮箱';
//                $this->error('申请中,邮箱发送失败' . $result['msg'], '/bis/user/login');
           // } elseif ($result['success'] == -1) {
            //    return ['success' => 0, 'msg' => '申请中,无法发送邮箱，，，'];
//                $this->error('申请中,邮箱发送失败' . $result['msg'], '/bis/user/login');
           // }

            return ['success' => 1, 'msg' => '已申请成功'];
        }


        $firstCityInfo = model('city')->getFirstCityInfo();//一级城市目录

        $firstCategory = model('category')->getCategory();//一级分类栏目
        return $this->fetch('',
            [
                'firstCityInfo' => $firstCityInfo,
                'firstCategory' => $firstCategory
            ]);
    }

    /**
     * 商家详细信息（移除到其它控制器了）
     * @return mixed
     */
    function index()
    {
        $data['id'] = input('id', 0, 'intval');

        $Info = model('bis')->getBisById($data['id']);//商户信息

        if (!$Info && !empty($Info)) {
            $this->error('信息错误，请稍后再试。。。');
            exit;
        }
        //如果该商户不存在时
        if (empty($Info)) {
            //两种跳转方式
            // $this->redirect('bis/register/waiting');
            $js = <<<eof
            <script>
                window.top.manager.href="/bis/register/waiting";
            </script>
eof;
            echo $js;
        }

        $firstCityInfo = model('city')->getFirstCityInfo();//一级城市目录

        $secondCityInfo = model('city')->getSecondCityInfo($Info['city_id']);//二级城市目录

        $bisLocation = model('bisLocation')->getLocationById($Info['id']);//商户的位置信息

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


        return $this->fetch('',
            ['Info' => $Info,       //商户信息
                'firstCityInfo' => $firstCityInfo,      //一级城市
                'secondCityInfo' => $secondCityInfo,    //二级城市
                'city_path' => $city_path,      //二级城市id路径
                'bisLocation' => $bisLocation,      //商户位置信息
                'firstCategory' => $firstCategory,      //一级类别
                'secondCategory' => $secondCategory,        //二级类别
                'category_path' => $category_path       //二级类别的id路径
            ]
        );
    }


}