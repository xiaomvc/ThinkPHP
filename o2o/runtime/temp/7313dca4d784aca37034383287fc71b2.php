<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:59:"/data/o2o/public/../application/index/view/index/index.html";i:1504349077;s:61:"/data/o2o/public/../application/index/view/public/header.html";i:1505209558;s:58:"/data/o2o/public/../application/index/view/public/nav.html";i:1506414020;}*/ ?>
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
								<?php if(isset($se_category[$vv['id']])): if(is_array($se_category[$vv['id']]) || $se_category[$vv['id']] instanceof \think\Collection || $se_category[$vv['id']] instanceof \think\Paginator): $_59ca0e069ab2b = is_array($se_category[$vv['id']]) ? array_slice($se_category[$vv['id']],0,2, true) : $se_category[$vv['id']]->slice(0,2, true); if( count($_59ca0e069ab2b)==0 ) : echo "" ;else: foreach($_59ca0e069ab2b as $key=>$v1): ?>
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

<div class="container">
    <div class="top-container">
        <div class="mid-area">
            <div class="slide-holder" id="slide-holder">
                <a href="#" class="slide-prev"><i class="slide-arrow-left"></i></a>
                <a href="#" class="slide-next"><i class="slide-arrow-right"></i></a>
                <ul class="slideshow">
                    <li><a href="" class="item-large"><img class="ad-pic"
                                                           src="__STATIC__/index/images/a1ec08fa513d2697b85e74c35dfbb2fb4216d89b.jpg"/></a>
                    </li>
                    <li><a href="" class="item-large"><img class="ad-pic"
                                                           src="__STATIC__/index/images/12312.jpg"/></a>
                    </li>
                    <li><a href="" class="item-large"><img class="ad-pic"
                                                           src="__STATIC__/index/images/63d0f703918fa0ec7c51e2912e9759ee3c6ddb9c.jpg"/></a>
                    </li>
                </ul>
            </div>
            <div class="list-container">

            </div>
        </div>
    </div>
    <div class="right-sidebar">
        <div class="right-ad">
            <ul class="slidepic">
                <li><a><img src="__STATIC__/index/images/72f082025aafa40f9205eb43a364034f79f01968.jpg"/></a></li>
            </ul>
        </div>

    </div>
    <div class="content-container">
        <div class="no-recom-container">
            <div class="floor-content-start">
                <?php if(!(empty($dealCategoryInfo) || (($dealCategoryInfo instanceof \think\Collection || $dealCategoryInfo instanceof \think\Paginator ) && $dealCategoryInfo->isEmpty()))): if(is_array($dealCategoryInfo) || $dealCategoryInfo instanceof \think\Collection || $dealCategoryInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $dealCategoryInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>

                <div class="floor-content">
                    <div class="floor-header">
                        <h3><?php echo $vv['name']; ?></h3>
                        <ul class="reco-words">
                            <?php if(is_array($se_category[$vv['id']]) || $se_category[$vv['id']] instanceof \think\Collection || $se_category[$vv['id']] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($se_category[$vv['id']]) ? array_slice($se_category[$vv['id']],0,3, true) : $se_category[$vv['id']]->slice(0,3, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                            <li><a href="/index/lists/index?categoryId=<?php echo $v1['id']; ?>" target="_blank"><?php echo $v1['name']; ?></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                            <li><a href="/index/lists/index?categoryId=<?php echo $vv['id']; ?>" class="no-right-border no-right-padding" target="_blank">全部<span
                                    class="all-cate-arrow"></span></a></li>
                        </ul>
                    </div>
                    <ul class="itemlist eight-row-height">
                        <?php if(is_array($BisFoods[$vv['id']]) || $BisFoods[$vv['id']] instanceof \think\Collection || $BisFoods[$vv['id']] instanceof \think\Paginator): $i = 0; $__LIST__ = $BisFoods[$vv['id']];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?>
                        <li class="j-card">
                            <a>
                                <div class="imgbox">
                                    <?php if($v2['buy_count'] > 6): ?>
                                    <ul class="marketing-label-container">
                                        <li class="marketing-label marketing-free-appoint"></li>
                                    </ul>
                                    <?php endif; ?>
                                    <div class="range-area">
                                        <div class="range-bg"></div>
                                        <div class="range-inner">
                                            <span class="white-locate"></span>
                                            <?php echo $location[$v2['bis_id']][0]['adress']; ?>
                                        </div>
                                    </div>
                                    <div class="borderbox">
                                        <?php if($mod == '0'): ?>
                                        <img src="__STATIC__/index/images/Puyh-fyavvsk3679563.jpg"/>
                                            <?php else: ?>
                                        <img src="__STATIC__/index/images/qeqw.jpg"/>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                            <div class="contentbox">
                                <a href="<?php echo url('index/detail/index',['id'=>$v2['id']]); ?>" target="_blank">
                                    <div class="header">
                                        <h4 class="title ">【<?php echo $v2['category_id']; ?>店通用】<?php echo $v2['name']; ?></h4>
                                    </div>
                                    <p><?php echo $v2['notes']; ?></p>
                                </a>
                                <div class="add-info"></div>
                                <div class="pinfo">
                                    <span class="price"><span class="moneyico">¥</span><?php echo $v2['current_price']; ?></span>
                                    <span class="ori-price">价值<span class="price-line">¥<span><?php echo $v2['origin_price']; ?></span></span></span>
                                </div>
                                <div class="footer">
                                    <span class="comment"><?php echo $location[$v2['bis_id']][0]['score']; ?>分</span><span class="sold">已售<?php echo $v2['buy_count']; ?></span>
                                    <div class="bottom-border"></div>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; else: ?>
                <p style="color: #ff0000 ;font-size: 30px;">该城市没数据，请选择其它城市</p>


                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="footer-content">
    <div class="copyright-info">

    </div>
</div>
<!--//引入封装好的js文件-->
<script src="__STATIC__/index/js/common.js"></script>
<script src="__STATIC__/index/js/index.js"></script>

</body>
</html>