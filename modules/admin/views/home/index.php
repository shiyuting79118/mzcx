<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = '管理后台';
?>
<style>
    .info-row {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<div class="container-fluid content-main">
    <div class="row">
        <div class="col-md-12" style="min-height: 500px;">

            <div class="alert alert-warning">
                欢迎进入 <span>管理</span> 后台
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">登录信息</div>
                        <div class="panel-body">

                            <div class="info-row">
                                登录帐户：<?= Html::encode(Yii::$app->user->identity->username); ?></div>
                            <div class="info-row"><!--所属角色：- --> &nbsp;</div>
                            <div class="info-row"> &nbsp;
                                <!--上次登录时间：---->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">系统信息</div>
                        <div class="panel-body">
                            <div class="info-row">操作系统：<?= PHP_OS ?></div>
                            <div class="info-row">服务器软件：<?= $_SERVER['SERVER_SOFTWARE'] ?></div>
                            <div class="info-row">
                                数据库版本：<?= Yii::$app->db->createCommand('SELECT VERSION()')->queryScalar() ?></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>