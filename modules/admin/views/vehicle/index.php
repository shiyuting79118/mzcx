<?php

use yii\widgets\LinkPager;
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $vehicle \app\models\Vehicle */

/*$dataProvider->pagination->pageSize = 2;*/
?>

<div class="page-title">车辆管理</div>

<!--content-main start-->
<div class="container-fluid content-main">
    <div class="row">
        <div class="col-md-12">

            <!--<div class="alert alert-info">
                <i class="icon-info-sign"></i> 提示信息提示信息提示信息提示信息提示信息提示信息
            </div>-->

            <?= $this->context->showRedirectMessage() ?>


           <!-- <form action="" method="get" class="form-inline form-search mt15">
                <div class="form-group">
                    <label>帐号</label>
                    <input name="username"
                           value="<?/*= \yii\helpers\Html::encode(Yii::$app->request->get('username'))*/?>"
                           type="text" class="form-control input-sm"/>
                </div>


               <div class="form-group">
                    <label>邮箱</label>
                    <input name="email"
                           value="<?/*= \yii\helpers\Html::encode(Yii::$app->request->get('email'))*/?>"
                           type="text" class="form-control input-sm"/>
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
                <a href="<?= \yii\helpers\Url::toRoute('vehicle/create-vehicle')?>" class="btn btn-sm btn-success pull-right"><span
                        class="glyphicon glyphicon-plus"></span> 添加车辆</a>

                <div class="clearfix"></div>
            </div>

            <table class="table table-hover mt15">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>司机</th>
                    <th>车辆等级</th>
                    <th>品牌</th>
                    <th>车型</th>
                    <th>颜色</th>
                    <th>车牌</th>
                    <th>照片</th>
                    <th>状态</th>
                    <th width="120">操作</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($dataProvider->getModels() as $vehicle) { ?>
                    <tr>
                        <td><?= \yii\bootstrap\Html::encode($vehicle->id) ?></td>
                        <td><?= \yii\helpers\Html::encode($vehicle->driver ? $vehicle->driver->nickname :'-') ?></td>
                        <td><?= \yii\bootstrap\Html::encode($vehicle->grade ? $vehicle->grade->name :'-') ?></td>
                        <td><?= \yii\bootstrap\Html::encode($vehicle->brand)?></td>
                        <td><?= \yii\bootstrap\Html::encode($vehicle->model)?></td>
                        <td><?= \yii\bootstrap\Html::encode($vehicle->color)?></td>
                        <td><?= \yii\bootstrap\Html::encode($vehicle->plate)?></td>
                        <td><?= \yii\bootstrap\Html::encode($vehicle->photo)?></td>
                        <td><?= \yii\bootstrap\Html::encode($vehicle->status)?></td>
                        <td>
                            <a href="">详情</a>
                            <a class="pFinal-confirm" href="<?=\yii\helpers\Url::toRoute(['vehicle/delete','id'=>$vehicle->id])?>">删除</a>
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