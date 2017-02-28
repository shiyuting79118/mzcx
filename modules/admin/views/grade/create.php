<div class="page-title">用户管理</div>

<div class="content-top">
    <ul class="top-nav">
        <li class="active"><span>新增司机</span></li>

    </ul>
    <div class="clearfix"></div>
</div>

<!--content-main start-->
<div class="container-fluid content-main">
    <div class="row">
        <div class="col-md-12">


            <?= $this->context->showRedirectMessage() ?>

            <?php

            /* @var $grade */

            $errors = $grade->firstErrors;
            foreach ($grade->firstErrors as $key => $error) {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }

            ?>


            <form action="<?php echo \yii\helpers\Url::toRoute('grade/create') ?>" class="form-horizontal"
                  method="post">

                <div class="form-group  <?php echo array_key_exists('name', $errors) ? 'has-error' : '' ?>">
                    <label for="input-username" class="col-sm-2 control-label">等级名称</label>

                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control" id="input-username"
                               value="<?= \yii\bootstrap\Html::encode($grade->name) ?>" placeholder="username">

                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">起步价</label>

                    <div class="col-sm-8">
                        <input name="flag_fall" type="text" class="form-control" id="inputEmail" placeholder="起步价">
                    </div>

                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">每公里单价</label>

                    <div class="col-sm-8">
                        <input type="text" name="km_price" class="form-control" id="inputPassword3" placeholder="每公里单价">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        <button type="submit" class="btn btn-default">保存</button>
                    </div>
                </div>
            </form>


        </div>
    </div>

</div>
<!--content-main end-->


