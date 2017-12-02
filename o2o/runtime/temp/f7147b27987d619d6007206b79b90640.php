<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:59:"/data/o2o/public/../application/index/view/lists/index.html";i:1505209988;s:61:"/data/o2o/public/../application/index/view/public/header.html";i:1505209558;s:58:"/data/o2o/public/../application/index/view/public/nav.html";i:1506414020;s:61:"/data/o2o/public/../application/index/view/public/footer.html";i:1503919918;}*/ ?>
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
								<?php if(isset($se_category[$vv['id']])): if(is_array($se_category[$vv['id']]) || $se_category[$vv['id']] instanceof \think\Collection || $se_category[$vv['id']] instanceof \think\Paginator): $_59ca0e82cc384 = is_array($se_category[$vv['id']]) ? array_slice($se_category[$vv['id']],0,2, true) : $se_category[$vv['id']]->slice(0,2, true); if( count($_59ca0e82cc384)==0 ) : echo "" ;else: foreach($_59ca0e82cc384 as $key=>$v1): ?>
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
<link rel="stylesheet" type="text/css" href="__STATIC__/index/css/footer.css"/>
<div class="page-body">
    <div class="filter-bg">
        <div class="filter-wrap">
            <div class="w-filter-ab-test">
                <div class="w-filter-top-nav clearfix" style="margin:12px">

                </div>

                <div class="filter-wrapper">
                    <div class="normal-filter ">
                        <div class="w-filter-normal-ab  filter-list-ab">
                            <h5 class="filter-label-ab">分类</h5>
                            <span class="filter-all-ab">
                                    <a href="/index/lists/index" class="w-filter-item-ab  item-all-auto-ab"><span
                                            class="item-content <?php if($categoryId == 0): ?>filter-active-all-ab<?php endif; ?> ">全部</span></a>
                                </span>
                            <div class="j-filter-items-wrap-ab filter-items-wrap-ab">
                                <div class="j-filter-items-ab filter-items-ab filter-content-ab">
                                    <?php if(is_array($firstCategory) || $firstCategory instanceof \think\Collection || $firstCategory instanceof \think\Paginator): $i = 0; $__LIST__ = $firstCategory;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
                                    <a href="/index/lists/index?categoryId=<?php echo $vv['id']; ?>" class="w-filter-item-ab "><span
                                            class='item-content <?php if($categoryId == $vv->id): ?>filter-active-all-ab<?php endif; ?>'><?php echo $vv['name']; ?></span></a>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="filter-wrapper">
                    <div class="normal-filter " style="margin-bottom:10px">
                        <div class="w-filter-normal-ab  filter-list-ab">
                            <h5 class="filter-label-ab" >子分类</h5>
                            <span class="filter-all-ab">

                                </span>
                            <div class="j-filter-items-wrap-ab filter-items-wrap-ab">
                                <div class="j-filter-items-ab filter-items-ab filter-content-ab">
                                    <?php if(is_array($secondCategory) || $secondCategory instanceof \think\Collection || $secondCategory instanceof \think\Paginator): $i = 0; $__LIST__ = $secondCategory;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
                                    <a href="/index/lists/index?categoryId=<?php echo $vv['id']; ?>"
                                       class="w-filter-item-ab"><span
                                            class="item-content <?php if($se_categoryId == $vv->id): ?>filter-active-all-ab<?php endif; ?>"><?php echo $vv['name']; ?></span></a>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="w-sort-bar">
                <div class="bar-area"
                     style="position: relative; left: 0px; margin-left: 0px; margin-right: 0px; margin-top: 0px; top: 0px;">
                        <span class="sort-area">
                            <a href="/index/lists/index?categoryId=<?php echo $se_categoryId; ?>" class="sort-default <?php if($orderId == ""): ?>sort-default-active<?php endif; ?>">默认</a>
                            <a href="/index/lists/index?categoryId=<?php echo $se_categoryId; ?>&order_count=1"
                               class="sort-item sort-down <?php if($orderId == "order_count"): ?>sort-default-active<?php endif; ?>"
                               title="点击按销量降序排序">销量↓</a>
                            <a href="/index/lists/index?categoryId=<?php echo $se_categoryId; ?>&order_price=1"
                               class="sort-item price-default price <?php if($orderId == "order_price"): ?>sort-default-active<?php endif; ?>"
                               title="点击按价格降序排序">价格↓</a>

                            <a href="/index/lists/index?categoryId=<?php echo $se_categoryId; ?>&order_time=1"
                               class="sort-item sort-up <?php if($orderId == "order_time"): ?>sort-default-active<?php endif; ?>"
                               title="发布时间由近到远">最新发布↑</a>
                        </span>

                </div>
            </div>
            <ul class="itemlist eight-row-height">
                <?php if(!(empty($dealInfo) || (($dealInfo instanceof \think\Collection || $dealInfo instanceof \think\Paginator ) && $dealInfo->isEmpty()))): if(is_array($dealInfo) || $dealInfo instanceof \think\Collection || $dealInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $dealInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
                <li class="j-card" >
                    <a>
                        <div class="imgbox">
                            <?php if($vv['buy_count'] > 8): ?>
                            <ul class="marketing-label-container">
                                <li class="marketing-label marketing-free-appoint"></li>
                            </ul>
                            <?php endif; ?>
                            <div class="range-area">
                                <div class="range-bg"></div>
                                <div class="range-inner">

                                </div>
                            </div>
                            <div class="borderbox">
                                <a style="z-index: 3" target="_blank" href="<?php echo url('index/detail/index',['id'=>$vv['id']]); ?>"><img
                                        src="__STATIC__/index/images/timg.jpg"/></a>
                            </div>
                        </div>
                    </a>
                    <div class="contentbox">
                        <a target="_blank" href="<?php echo url('index/detail/index',['id'=>$vv['id']]); ?>">
                            <div class="header">
                                <h4 class="title ">【<?php echo $vv['category_id']; ?>店通用】</h4>
                                <div class="collected">精选</div>
                            </div>
                            <p><?php echo html_entity_decode($vv['notes']); ?></p>
                        </a>
                        <div class="add-info"></div>
                        <div class="pinfo">
                            <span class="price"><span class="moneyico">¥<?php echo $vv['current_price']; ?></span></span>
                            <span class="ori-price">价值<span
                                    class="price-line">¥<?php echo $vv['origin_price']; ?><span></span></span></span>
                        </div>
                        <div class="footer">
                            <span class="sold">已售<?php echo $vv['buy_count']; ?></span>
                            <div class="bottom-border"></div>
                        </div>
                    </div>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; else: ?>
                <P style="font-size: 20px ;color: #ff0000; text-align:center" >该分类没数据</P>
                <?php endif; ?>
            </ul>
        </div>
    </div>

</div>

</div>
<?php echo paginate($dealInfo); ?>
<!--//引入封装好的js文件-->
<script src="__STATIC__/index/js/common.js"></script>

<footer class="footer" style="clear: both;">
    <div class="container">
        <p>
            感谢jQuery、layer、laypage、Validform、UEditor、My97DatePicker、iconfont、Datatables、WebUploaded、icheck、highcharts、bootstrap-Switch<br>
            Copyright &copy;2015-2017 H-ui.admin v3.1 All Rights Reserved.<br>
            本后台系统由<a href="http://www.h-ui.net/" target="_blank" title="H-ui前端框架">H-ui前端框架</a>提供前端技术支持</p>
    </div>
</footer>

<!--分页的样式-->
<style>
    .pagination {
        text-align: center;
        margin-top:10px;
    }

    .pagination li {
        display: inline;
        padding:0 5px;
        font-size: 20px;
    }
</style>
</head>
</body>
</html>
