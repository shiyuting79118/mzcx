<?php

use yii\widgets\LinkPager;
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $model \app\models\Comment */

?>
<div class="page-title">评论管理</div>

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

                    <th>会员ID</th>
                    <th>司机ID</th>
                    <th>订单ID</th>
                    <th>星级</th>
                    <th>评论内容</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($dataProvider->getModels() as $model) { ?>
                    <tr>
                        <td><?= \yii\bootstrap\Html::encode($model->id) ?></td>
                        <td><?= \yii\bootstrap\Html::encode($model->getUser()->nickname) ?></td>
                        <td><?= \yii\bootstrap\Html::encode($model->driver_id) ?></td>
                        <td><?= \yii\bootstrap\Html::encode($model->order_id) ?></td>
                        <td><?= \yii\bootstrap\Html::encode($model->star) ?></td>
                        <td><?= \yii\bootstrap\Html::encode($model->content) ?></td>
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