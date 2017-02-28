<?php

use yii\widgets\LinkPager;
use app\models\User;

/* @var $users \app\models\User[] */

?>
<div class="page-title">帐户管理</div>

<div class="content-top">
    <ul class="top-nav">
        <li class=""><a href="<?php echo \yii\helpers\Url::toRoute('user/index')?>">全部</a></li>
        <li class="active"><a href="<?php echo \yii\helpers\Url::toRoute('user/driver')?>">司机</a></li>
        <li><a href="<?php echo \yii\helpers\Url::toRoute('user/admin')?>">管理员</a></li>

    </ul>
    <div class="clearfix"></div>
</div>


<!--content-main start-->
<div class="container-fluid content-main">
    <div class="row">
        <div class="col-md-12">

            <!--<div class="alert alert-info">
                <i class="icon-info-sign"></i> 提示信息提示信息提示信息提示信息提示信息提示信息
            </div>-->

            <?= $this->context->showRedirectMessage() ?>


            <div class="mt15 pr15">
                <a href="<?= \yii\helpers\Url::toRoute('user/create-driver')?>" class="btn btn-sm btn-success pull-right"><span
                        class="glyphicon glyphicon-plus"></span> 添加记录</a>

                <div class="clearfix"></div>
            </div>

            <table class="table table-hover mt15">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>帐号</th>
                    <th>邮箱</th>
                    <th>状态</th>
                    <th width="120">操作</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?= \yii\bootstrap\Html::encode($user->id) ?></td>
                        <td><?= \yii\bootstrap\Html::encode($user->username) ?></td>
                        <td><?= \yii\bootstrap\Html::encode($user->email) ?></td>
                        <td><?= \yii\helpers\Html::encode($user->statusAlias())?></td>
                        <td>
                            <a href="<?php echo \yii\helpers\Url::toRoute(['user/update-driver','id'=>$user->id])?>">修改</a>
                            <a href="">禁用</a>
                            <a class="pFinal-confirm" href="<?=\yii\helpers\Url::toRoute(['user/delete','id'=>$user->id])?>">删除</a>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>

            <div class="clearfix"></div>

        </div>
    </div>


</div>
<!--content-main end-->