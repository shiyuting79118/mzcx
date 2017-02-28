<div class="page-title">车辆管理</div>

<div class="content-top">
    <ul class="top-nav">
        <li class="active"><span>新增车辆</span></li>

    </ul>
    <div class="clearfix"></div>
</div>

<!--content-main start-->
<div class="container-fluid content-main">
    <div class="row">
        <div class="col-md-12">


            <?= $this->context->showRedirectMessage() ?>

            <?php

            /* @var $model */

            $errors = $model->firstErrors;
            foreach ($model->firstErrors as $key => $error) {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }

            ?>


            <form enctype="multipart/form-data" action="<?php echo \yii\helpers\Url::toRoute('create') ?>" class="form-horizontal"
                  method="post">

                <div class="form-group  <?php echo array_key_exists('username', $errors) ? 'has-error' : '' ?>">
                    <label for="input-username" class="col-sm-2 control-label">plate</label>

                    <div class="col-sm-8">
                        <input type="text" name="plate" class="form-control" id="input-plate"
                               value="<?= \yii\bootstrap\Html::encode($model->plate) ?>" placeholder="username">

                    </div>
                </div>




                <div class="form-group  <?php echo array_key_exists('grade_id', $errors) ? 'has-error' : '' ?>">
                    <label for="input-grade" class="col-sm-2 control-label">等级</label>

                    <div class="col-sm-8">

                        <?php echo \yii\helpers\Html::dropDownList('grade_id',$model->grade_id,  \yii\helpers\ArrayHelper::map($gradeList,'id','name') ,['class'=>'form-control  '])?>


                    </div>
                </div>


                <div class="form-group  <?php echo array_key_exists('imageFile', $errors) ? 'has-error' : '' ?>">
                    <label for="input-grade" class="col-sm-2 control-label">图片</label>

                    <div class="col-sm-8">
                        <input type="file" name="imageFile" class="control-form ">

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


<script>

    $(function () {

        $("form").submit(function () {



            return true;
        });

    });


</script>