<?php

use yii\widgets\LinkPager;
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $user \app\models\Order */

?>
<div class="page-title">车辆等级管理</div>

<!--content-main start-->
<div class="container-fluid content-main">
    <div class="row">
        <div class="col-md-12">

            <?= $this->context->showRedirectMessage() ?>

            <!--这里是用来搜索查询的-->
            <!--<form action="" method="get" class="form-inline form-search mt15">
                <div class="form-group">
                    <label>帐号</label>
                    <input name="username" value="<?/*= \yii\helpers\Html::encode(Yii::$app->request->get('username'))*/?>" type="text" class="form-control input-sm"/>
                </div>


                <div class="form-group">
                    <label>邮箱</label>
                    <input name="email"  value="<?/*= \yii\helpers\Html::encode(Yii::$app->request->get('email'))*/?>" type="text" class="form-control input-sm"/>
                </div>

                <div class="form-group">
                    <label>状态</label>
                    <select name="status" class="form-control input-sm">
                        <option value="0">--全部--</option>
                        <option value="<?/*= User::STATUS_YES*/?>">有效</option>
                        <option value="<?/*= User::STATUS_NO*/?>">禁用</option>
                    </select>
                </div>

                <div>
                    <button type="submit" class="btn btn-success btn-sm">
                        <span class="glyphicon glyphicon-search"></span> 搜索
                    </button>
                    <a href="<?php /*echo \yii\helpers\Url::toRoute('user/index')*/?>" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-repeat"></span> 全部</a>
                </div>
            </form>-->

            <div class="mt15 pr15">

                <div class="clearfix"></div>
            </div>

            <table class="table table-hover mt15">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>订单类型</th>
                    <th>会员ID</th>
                    <th>计划在哪上车</th>
                    <th>计划去哪儿</th>
                    <th>订单状态</th>
                    <th width="120">操作</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($dataProvider->getModels() as $model) { ?>
                    <tr>
                        <td><?= \yii\bootstrap\Html::encode($model->id) ?></td>
                        <td><?= \yii\bootstrap\Html::encode($model->type) ?></td>
                        <td><?= \yii\bootstrap\Html::encode($model->member_id) ?></td>
                        <td><?= \yii\bootstrap\Html::encode($model->pickup) ?></td>
                        <td><?= \yii\bootstrap\Html::encode($model->destination) ?></td>
                        <td><?= \yii\helpers\Html::encode($model->statusAlias())?></td>
                        <td>
                            <a href="<?=\yii\helpers\Url::toRoute(['order/view','id'=>$model->id])?>">详情</a>
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