<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:60:"/data/o2o/public/../application/index/view/detail/index.html";i:1504522583;s:61:"/data/o2o/public/../application/index/view/public/header.html";i:1505209558;s:58:"/data/o2o/public/../application/index/view/public/nav.html";i:1506414020;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="__STATIC__/index/css/base.css"/>
    <link rel="stylesheet" href="__STATIC__/index/css/common.css"/>
    <?php if(request()->Controller() != 'User'): ?>
    <link rel="stylesheet" href="__STATIC__/index/css/<?php echo lcfirst(request()->Controller()); ?>.css"/>
    <?php endif; ?>
    <script type="text/javascript" src="__STATIC__/index/js/html5shiv.js"></script>
    <script type="text/javascript" src="__STATIC__/index/js/respond.min.js"></script>
    <script type="text/javascript" src="__STATIC__/index/js/jquery-1.11.3.min.js"></script>

    <title><?php echo $title; ?></title>
    <script src="__STATIC__/common/check.js"></script>
    <script type="text/javascript" src="/static/common/common.js"></script>
</head>
<body>

<div class="header-bar">
    <div class="header-inner">
        <ul class="father">
            <li><a><?php echo $cityName; ?></a></li>
            <?php if(request()->controller() == 'Index'): ?>
            <li>|</li>
            <li class="city">
                <a>切换城市<span class="arrow-down-logo"></span></a>
                <div class="city-drop-down">
                    <h3>热门城市</h3>
                    <ul class="son">
                        <?php if(is_array($city) || $city instanceof \think\Collection || $city instanceof \think\Paginator): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li style="float:left"><a href="<?php echo URL('index',['cityId'=>$vo['id']]); ?>"><?php echo $vo['name']; ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>

                </div>
            </li>
            <?php endif; ?>
            <li><a href="/bis/user/login" style="margin-right:6px ">商户中心</a></li>
            <!--<li><a href="<?php echo URL('admin/index/index'); ?>" style="margin-left: -8px;">后台管理</a></li>-->
	   <li></li>
            <li>|</li>

            <?php if(!(empty($userName) || (($userName instanceof \think\Collection || $userName instanceof \think\Paginator ) && $userName->isEmpty()))): ?>
            <li><a href="javascript:confirm('是否确认退出')?exit('/index/user/exitLogin'):false;">退出登录</a></li>
            <li>|</li>
            <li style="color:blue;">欢迎：<?php echo $userName; ?></li>
            <?php else: ?>
            <li><a href="<?php echo URL('index/user/register'); ?>">注册</a></li>
            <li>|</li>
            <li><a href="<?php echo URL('index/user/login'); ?>">登录</a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<div class="nav-bar-header">
    <div class="nav-inner">
        <ul class="nav-list">
            <li class="nav-item">
                <span class="item">全部分类</span>
                <?php if(request()->controller() == 'Index'): ?>
                <div class="left-menu">
                    <?php if(is_array($firstCategory) || $firstCategory instanceof \think\Collection || $firstCategory instanceof \think\Paginator): $i = 0; $__LIST__ = $firstCategory;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
                    <div class="level-item">

                        <div class="first-level">
                            <dl>
                                <dt class="title"><a href="javascrpit:;" target="_top"><?php echo $vv['name']; ?></a></dt>
								<?php if(isset($se_category[$vv['id']])): if(is_array($se_category[$vv['id']]) || $se_category[$vv['id']] instanceof \think\Collection || $se_category[$vv['id']] instanceof \think\Paginator): $_59ca73a6ec450 = is_array($se_category[$vv['id']]) ? array_slice($se_category[$vv['id']],0,2, true) : $se_category[$vv['id']]->slice(0,2, true); if( count($_59ca73a6ec450)==0 ) : echo "" ;else: foreach($_59ca73a6ec450 as $key=>$v1): ?>
                                <!--二级分类栏目中的热门的两个-->
                                <dd><a href="/index/lists/index?categoryId=<?php echo $v1['id']; ?>" target="_top" class=""><?php echo $v1['name']; ?></a>
                                </dd>
                                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                            </dl>
                        </div>
                        <div class="second-level">
                            <div class="section">
                                <div class="section-item clearfix no-top-border">
                                    <h3>热门分类</h3>
                                    <ul>
									<?php if(isset($se_category[$vv['id']])): if(is_array($se_category[$vv['id']]) || $se_category[$vv['id']] instanceof \think\Collection || $se_category[$vv['id']] instanceof \think\Paginator): $i = 0; $__LIST__ = $se_category[$vv['id']];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?>
                                        <li><a href="/index/lists/index?categoryId=<?php echo $v2['id']; ?>" <?php if($v2['listorder'] != 0): ?>class="hot" <?php endif; ?>><?php echo $v2['name']; ?></a>
                                        </li>
                                        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                    </ul>
                                </div>
                                <div class="section-item clearfix">
                                    <h3>热门分类</h3>
                                    <ul>
									<?php if(isset($se_category[$vv['id']])): if(is_array($se_category[$vv['id']]) || $se_category[$vv['id']] instanceof \think\Collection || $se_category[$vv['id']] instanceof \think\Paginator): $i = 0; $__LIST__ = $se_category[$vv['id']];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?>
                                        <li><a href="/index/lists/index?categoryId=<?php echo $v2['id']; ?>" <?php if($v2['listorder'] != 0): ?>class="hot" <?php endif; ?>><?php echo $v2['name']; ?></a>
                                        </li>
                                        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>

                <?php endif; ?>
            </li>
            <li class="nav-item"><a href="<?php echo url('index/index/index'); ?>" class="item first active">首页</a></li>
            <li class="nav-item"><a class="item">团购</a></li>
            <li class="nav-item"><a class="item">商户</a></li>
        </ul>
    </div>
</div>

<div class="p-detail">
    <div class="p-bread-crumb">
        <div class="w-bread-crumb">
            <ul class="crumb-list">
                <li class="crumb"><a>团购</a><span class="ico-gt">&gt;</span></li>
                <li class="crumb"><a><?php echo $category['name']; ?></a><span class="ico-gt">&gt;</span></li>
                <li class="crumb crumb-last"><a><?php echo $bisFoods[0]['name']; ?></a></li>
            </ul>
        </div>
    </div>
    <div class="static-hook-real static-hook-id-5"></div>
    <div class="p-item-info">
        <div class="w-item-info">
            <h2><?php echo $bisFoods[0]['name']; ?></h2>
            <div class="item-title">
                <span class="text-main"><?php echo $title; ?></span>
            </div>
            <div class="ii-images static-hook-real static-hook-id-6">
                <div class="w-item-images">
                    <div class="images-board">
                        <div class="item-status ">
                            <span class="ico-status ico-jingxuan"></span>
                        </div>
                        <img src="<?php echo $bisFoods[0]['image']; ?>" class="item-img-large"/>
                    </div>
                    <ul class="images-list clearfix">
                        <li class="images images-last">
                            <img src="<?php echo $bisFoods[0]['image']; ?>"/>
                        </li>
                    </ul>
                    <div class="erweima-share-collect">
                        <ul class="item-option clearfix">
                            <li class=" ">


                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="ii-intro">
                <div class="w-item-intro">
                    <div class="price-area-wrap static-hook-real static-hook-id-8">
                        <div class="price-area has-promotion-icon">
                            <div class="pic-price-area">
                                <span class="unit">¥</span>
                                <span class="priceNum"><?php echo $bisFoods[0]['current_price']; ?></span>
                            </div>

                            <div class="market-price-area">
                                <div class="price">¥<?php echo $bisFoods[0]['origin_price']; ?></div>
                                <div class="name">价值</div>
                            </div>
                        </div>
                    </div>

                    <div class="static-hook-real static-hook-id-9">
                        <a class="link jingxuan-box" alt="更多精选品牌特惠">
                            <div class="box">
                                <div class="jx-update" id="j-jxUpdateTime">

                                    <?php switch($start['success']): case "0": ?> <span>已经开始</span><span class="jx-timerbox"></span><?php break; case "1": ?>
                                    <span>距离开始时间还有：</span>
                                    <span class="jx-timerbox"><?php echo $start['d']; ?>天<?php echo $start['h']; ?>时<?php echo $start['m']; ?>分<?php echo $start['i']; ?>秒</span>
                                    <?php break; case "-1": ?>
                                    <span>已开始：</span>
                                    <span class="jx-timerbox"><?php echo $start['d']; ?>天<?php echo $start['h']; ?>时<?php echo $start['m']; ?>分<?php echo $start['i']; ?>秒</span>
                                    <?php break; endswitch; ?>
                                </div>
                            </div>
                        </a>
                    </div>

                    <ul class="ugc-strategy-area static-hook-real static-hook-id-10">
                        <li class="item-bought">
                            <div class="sl-wrap">
                                <div class="sl-wrap-cnt">
                                    <div class="item-bought-num"><span
                                            class="intro-strong"><?php echo $bisFoods[0]['buy_count']; ?></span>人已团购
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="buy-panel-wrap">
                        <div class="buy-panel">
                            <div class="validdate-buycount-area static-hook-real static-hook-id-11">
                                <div class="item-countdown-row">
                                    <span class="name">
                                       结束时间：
                                    </span>
                                    <span class="value">
                                        <?php switch($end['success']): case "0": ?> 永久有效<?php break; case "1": ?> <?php echo date('Y-m-d H:i',$bisFoods[0]['end_time']); break; case "-1": ?><?php echo date('Y-m-d H:i',$bisFoods[0]['end_time']); ?> 已经结束了<?php break; endswitch; ?></span>
                                </div>
                                <div class="item-buycount-row j-item-buycount-row" style="">
                                    <div class="name">数&nbsp;&nbsp;&nbsp;量</div>
                                    <div class="buycount-ctrl">
                                        <a href="javascript:;" class="j-ctrl ctrl minus disabled"><span
                                                class="horizontal"></span></a>
                                        <input type="text" value="1" maxlength="10" autocomplete="off"
                                               style="padding:5px 0px">
                                        <a href="javascript:;" class="ctrl j-ctrl plus "><span
                                                class="horizontal"></span><span class="vertical"></span></a>
                                    </div>
                                    <div class="text-wrap">
                                        <span class="err-wrap j-err-wrap"></span>
                                        <span class="left-budget">优惠价剩余份  <em style="color: #ff0000;font-size: 18px"><?php echo $bisFoods[0]['total_count']; ?></em></span>

                                    </div>
                                </div>
                            </div>
                            <div class="item-buy-area">
                                <div style="float:left" class="static-hook-real static-hook-id-12">

                                    <?php if($end['success'] == 0 || $end['success'] == 1): ?>
                                    <a href="javascript:;" class="btn-buy btn-buy-qrnew j-btn-buy btn-hit">立即抢购</a>

                                    <?php else: ?>
                                    <a href="javascript:;" class="btn-buy btn-buy-qrnew j-btn-buy btn-hit"
                                       style="background: #C0C0C0;border-bottom:#C0C0C0; ">立即抢购</a>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-item-info-more">
        <div class="iim-wrapper">
            <div class="spec-nav ">
                <div class="nav-bar"></div>
                <div class="w-spec-nav" style="position: static; top: auto; z-index: auto;">
                    <ul class="sn-list">
                        <li class="spec-nav-current">
                            <i></i><a><span>本单详情</span></a>
                        </li>
                        <li class="">
                            <i></i><a><span>消费提示</span></a>
                        </li>
                        <li class="">
                            <i></i><a><span>商家介绍</span></a>
                        </li>
                    </ul>

                </div>
            </div>
            <ul class="j-info-all">
                <li class="tab">
                    <div class="ia-shop-branch">
                        <div class="w-shop-branch">
                            <h3 class="w-section-header">分店信息</h3>
                            <div class="branch-content">
                                <div class="shop-map">
                                    <?php if(is_array($center) || $center instanceof \think\Collection || $center instanceof \think\Paginator): $k = 0; $__LIST__ = $center;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($k % 2 );++$k;?>

                                    <div class="w-map image<?php echo $k; ?>" <?php if($k == 1): ?>style="display: blank;<?php else: ?>style="display: none;<?php endif; ?>">
                                        <img src="<?php echo url('index/map/getImage',['center'=>$vv]); ?>" width="350px">
                                    </div>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                                <div class="branch-detail">
                                    <div>

                                        <div class="branch-list-content">
                                            <div class="w-branch-list">
                                                <ul class="branch-list-content list">
                                                    <?php if(is_array($locationInfo) || $locationInfo instanceof \think\Collection || $locationInfo instanceof \think\Paginator): $k = 0; $__LIST__ = $locationInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($k % 2 );++$k;?>
                                                    <li class="branch <?php if($k == 1): ?>branch-open<?php endif; ?>">

                                                        <a target="_blank"
                                                           class="branch-name"><?php echo $vv['name']; ?></a>
                                                        <p class="branch-address"><?php echo $vv['api_address']; ?></p>
                                                        <p class="branch-tel"><?php echo $vv['tel']; ?></p>
                                                        <p class="map-travel">

                                                        </p>

                                                    </li>
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ifram"></div>
                </li>
                <li class="tab">
                    <div class="ifram"><?php echo html_entity_decode($bisFoods[0]['notes']); ?></div>
                </li>
                <li class="tab">
                    <div class="ifram"><?php echo html_entity_decode($bisFoods[0]['description']); ?></div>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="footer-content">
    <div class="copyright-info">
        <div class="site-info">

        </div>
        <div class="icons">

        </div>
        <div style="width:200px;margin:0 auto; padding:20px 0;">

        </div>
    </div>
</div>

<script type="text/javascript" src="/static/index/js/detail.js"></script>
</body>
</html>