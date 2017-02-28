<?php

use yii\widgets\LinkPager;
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $user \app\models\Grade */

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

            <div class="mt15 pr15">
                <a href="<?= \yii\helpers\Url::toRoute('grade/create')?>" class="btn btn-sm btn-success pull-right"><span
                        class="glyphicon glyphicon-plus"></span> 添加等级</a>

                <div class="clearfix"></div>
            </div>

            <table class="table table-hover mt15">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>等级名称</th>
                    <th>起步价</th>
                    <th>每公里单价</th>
                    <th width="120">操作</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($dataProvider->getModels() as $model) { ?>
                    <tr>
                        <td><?= \yii\bootstrap\Html::encode($model->id) ?></td>
                        <td><?= \yii\bootstrap\Html::encode($model->name) ?></td>
                        <td><?= \yii\bootstrap\Html::encode($model->flag_fall) ?></td>
                        <td><?= \yii\bootstrap\Html::encode($model->km_price) ?></td>
                        <td>
                            <a href="<?=\yii\helpers\Url::toRoute(['grade/update','id'=>$model->id])?>">修改</a>

                            <a class="pFinal-confirm"
                               href="<?=\yii\helpers\Url::toRoute(['grade/delete','id'=>$model->id])?>">删除</a>
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