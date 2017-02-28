<?php

use yii\widgets\LinkPager;
use app\models\User;
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $user \app\models\User */

$dataProvider->pagination->pageSize = 2;
?>
<div class="page-title">帐户管理</div>

<div class="content-top">
    <ul class="top-nav">
        <li class="active"><span>全部</span></li>
        <li><a href="<?php echo \yii\helpers\Url::toRoute('user/driver')?>">司机</a></li>
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


            <form action="" method="get" class="form-inline form-search mt15">
                <div class="form-group">
                    <label>帐号</label>
                    <input name="username" value="<?= \yii\helpers\Html::encode(Yii::$app->request->get('username'))?>" type="text" class="form-control input-sm"/>
                </div>


                <div class="form-group">
                    <label>邮箱</label>
                    <input name="email"  value="<?= \yii\helpers\Html::encode(Yii::$app->request->get('email'))?>" type="text" class="form-control input-sm"/>
                </div>

                <div class="form-group">
                    <label>状态</label>
                    <select name="status" class="form-control input-sm">
                        <option value="0">--全部--</option>
                        <option value="<?= User::STATUS_YES?>">有效</option>
                        <option value="<?= User::STATUS_NO?>">禁用</option>
                    </select>
                </div>

                <div>
                    <button type="submit" class="btn btn-success btn-sm">
                        <span class="glyphicon glyphicon-search"></span> 搜索
                    </button>
                    <a href="<?php echo \yii\helpers\Url::toRoute('user/index')?>" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-repeat"></span> 全部</a>
                </div>
            </form>

            <div class="mt15 pr15">

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

                <?php foreach ($dataProvider->getModels() as $user) { ?>
                    <tr>
                        <td><?= \yii\bootstrap\Html::encode($user->id) ?></td>
                        <td><?= \yii\bootstrap\Html::encode($user->username) ?></td>
                        <td><?= \yii\bootstrap\Html::encode($user->email) ?></td>
                        <td><?= \yii\helpers\Html::encode($user->statusAlias())?></td>
                        <td>
                            <a href="">详情</a>
                            <a href="<?=\yii\helpers\Url::toRoute(['user/disable','id'=>$user->id])?>">禁用</a>
                            <a href="<?=\yii\helpers\Url::toRoute(['user/enable','id'=>$user->id])?>">启用</a>
                            <a class="pFinal-confirm" href="<?=\yii\helpers\Url::toRoute(['user/delete','id'=>$user->id])?>">删除</a>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>

            <div class="pull-right">
                <!--<span>共 100 条记录 </span>
                <span>每页 20 条</span>-->
                <?= LinkPager::widget([
                    'pagination' => $dataProvider->pagination,
                ]); ?>

            </div>
            <div class="clearfix"></div>

        </div>
    </div>


</div>
<!--content-main end-->