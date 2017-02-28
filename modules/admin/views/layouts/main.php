<?php


/* @var $this \yii\web\View */


$controllerId = $this->context->getUniqueId();


?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= \yii\bootstrap\Html::encode(Yii::$app->name) ?></title>

    <link href="<?= \yii\helpers\Url::base() ?>/static/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= \yii\helpers\Url::base() ?>/static/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= \yii\helpers\Url::base() ?>/static/admin/css/layout.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?= \yii\helpers\Url::base() ?>/static/jquery/jquery.min.js"></script>

    <link href="<?= \yii\helpers\Url::base() ?>/static/art-dialog/css/ui-dialog.css" rel="stylesheet"/>
    <script src="<?= \yii\helpers\Url::base() ?>/static/art-dialog/dist/dialog-min.js"></script>

    <link href="<?= \yii\helpers\Url::base() ?>/static/pfinal/css/pfinal.css" rel="stylesheet"/>
    <script src="<?= \yii\helpers\Url::base() ?>/static/pfinal/pfinal.js"></script>

</head>
<body>

<!-- .row必须包含在 .container(固定宽度)或 .container-fluid(100% 宽度)中，以便为其赋予合适的排列(aligment)和内补(padding)-->
<nav class="layout-header">
    <div class="container layout-width">
        <div class="row">
            <div class="col-md-12">

                <div class="pull-left">
                    <a href="<?= \yii\helpers\Url::toRoute('home/index') ?>" class="logo">
                        <span class="fa fa-desktop"></span> 管理后台
                    </a>
                </div>

                <div class="top-menu pull-left hide">
                    <ul>
                        <li>
                            <a href="">首页</a>
                        </li>
                        <li>
                            <a class="active" href="">销售管理</a>

                            <div class="nav-child-menu">
                                <a href="">购车客户管理</a>
                                <a href="">购车询价</a>
                                <a href="">预约试驾</a>
                                <a href="">本店购车点评</a>
                            </div>
                        </li>
                        <li>
                            <a class="" href="">售后管理</a>

                            <div class="nav-child-menu">
                                <a href="">车主管理</a>
                                <a href="">养修预约</a>
                                <a href="">保险询价</a>
                                <a href="">紧急救援</a>
                            </div>
                        </li>
                        <li><a class="" href="">参数设置</a>

                            <div class="nav-child-menu">
                                <a href="">广告管理</a>
                                <a href="">关注奖励</a>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="pull-right">
                <span class="account-info">
                    <span><?= \yii\helpers\Html::encode(Yii::$app->user->identity->nickname) ?></span>

                    <a class="login-out" href="<?php echo \yii\helpers\Url::toRoute(['default/logout'])?>">退出</a>
                </span>

                </div>

            </div>
        </div>
    </div>
</nav>

<section class="container layout-main layout-width">
    <div class="row">
        <div class="col-md-12 display-table">

            <!--左菜单区域-->
            <div class="layout-menu">

                <ul class="main-menu">

                    <li class="<?= $controllerId == 'admin/user' ? 'active' : '' ?>">
                        <a class="menu-item" href="<?= \yii\helpers\Url::toRoute('user/index') ?>">
                            <i class="icon fa fa-user"></i>
                            <i class="icon pull-right"></i>
                            <span>用户管理</span>
                        </a>
                    </li>

                    <li class="<?= $controllerId == 'admin/order' ? 'active' : '' ?>">
                        <a class="menu-item" href="<?= \yii\helpers\Url::toRoute('order/index') ?>">
                            <i class="icon glyphicon glyphicon-user"></i>
                            <i class="icon pull-right"></i>
                            <span>订单管理</span>
                        </a>
                    </li>

                    <li class="">
                        <a class="menu-item" href="<?= \yii\helpers\Url::toRoute('grade/index')?>">
                            <i class="icon glyphicon glyphicon-th-large"></i>
                            <i class="icon pull-right"></i>
                            <span>等级管理</span>
                        </a>
                    </li>



                    <li class="<?= $controllerId == 'admin/vehicle' ? 'active' : '' ?>"">
                        <a class="menu-item" href="<?= \yii\helpers\Url::toRoute('vehicle/index') ?>">
                            <i class="icon glyphicon glyphicon-th-large"></i>
                            <i class="icon pull-right"></i>
                            <span>车辆管理</span>
                        </a>
                    </li>


                    <li class="<?= $controllerId == 'admin/comment' ? 'active' : '' ?>"">
                    <a class="menu-item" href="<?= \yii\helpers\Url::toRoute('comment/index') ?>">
                        <i class="icon glyphicon glyphicon-th-large"></i>
                        <i class="icon pull-right"></i>
                        <span>评论管理</span>
                    </a>
                    </li>


                    <li class="">
                        <a class="menu-item" href="">
                            <!--<i class="icon"></i>-->
                            <i class="icon pull-right"></i>
                            <span>主菜单5没有图标</span>
                        </a>
                    </li>
                </ul>

            </div>
            <!-- 左菜单区域结束-->

            <!--右内容区域-->
            <div class="layout-content">

                <?= $content ?>

            </div>
            <!--右内容区域结束-->

            <div class="clearfix"></div>
        </div>
    </div>
</section>

<footer class="layout-footer">
    <div class="container layout-width">
        <div class="row">
            <div class="col-md-12">
                <ul class="links">
                    <li><a href="" target="_blank">关于我们</a></li>
                    <li><a href="" target="_blank">服务协议</a></li>
                    <li><a href="" target="_blank">运营规范</a></li>
                    <li><a href="" target="_blank">客服中心</a></li>
                    <li><a href="" target="_blank">在线客服</a></li>
                    <li><p class="copyright">Copyright.All Rights Reserved.</p></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="<?= \yii\helpers\Url::base()?>/static/ie8/html5shiv.min.js"></script>
<script src="<?= \yii\helpers\Url::base()?>/static/ie8/respond.min.js"></script>
<![endif]-->

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?= \yii\helpers\Url::base() ?>/static/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>