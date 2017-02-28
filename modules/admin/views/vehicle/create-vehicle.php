<div class="page-title">车辆管理</div>

<!--content-main start-->
<div class="container-fluid content-main">
    <div class="row">
        <div class="col-md-12">

            <?= $this->context->showRedirectMessage() ?>

            <?php

            /* @var $vehicle */

            $errors = $vehicle->firstErrors;
            foreach ($vehicle->firstErrors as $key => $error) {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }

            ?>

            <form enctype="multipart/form-data" action="<?php echo \yii\helpers\Url::toRoute('vehicle/create-vehicle') ?>"
                  class="form-horizontal" method="post">

                <div class="form-group">
                    <label for="inputGrade_id" class="col-sm-2 control-label">司机</label>

                    <div class="col-sm-8">
                        <?php echo \yii\helpers\Html::dropDownList('driver_id',$vehicle->grade_id,
                            \yii\helpers\ArrayHelper::map($driverList,'id','id') ,['class'=>'form-control  '])?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">品牌</label>

                    <div class="col-sm-8">
                        <input name="brand" type="text" class="form-control"  placeholder="请输入车辆品牌"
                               value="<?= \yii\bootstrap\Html::encode($vehicle->brand) ?>">
                        <span class="help-block"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">车型</label>

                    <div class="col-sm-8">
                        <input name="model" type="text" class="form-control"  placeholder="请输入车型"
                               value="<?= \yii\bootstrap\Html::encode($vehicle->model) ?>">
                        <span class="help-block"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputColor" class="col-sm-2 control-label">颜色</label>

                    <div class="col-sm-8">
                        <input type="text" name="color" class="form-control"  placeholder="请输入颜色"
                               value="<?= \yii\bootstrap\Html::encode($vehicle->color) ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPlate" class="col-sm-2 control-label">车牌</label>

                    <div class="col-sm-8">
                        <input type="text" name="plate" class="form-control"  placeholder="请输入车牌"
                               value="<?= \yii\bootstrap\Html::encode($vehicle->plate) ?>">
                    </div>
                </div>

                <div class="form-group  <?php echo array_key_exists('imageFile', $errors) ? 'has-error' : '' ?>">
                    <label for="inputPhoto" class="col-sm-2 control-label">图片</label>

                    <div class="col-sm-8">
                        <input type="file" name="imageFile" class="form-control ">

                    </div>
                </div>

                <div class="form-group">
                    <label for="inputGrade_id" class="col-sm-2 control-label">车辆等级</label>

                    <div class="col-sm-8">
                        <?php echo \yii\helpers\Html::dropDownList('grade_id',$vehicle->grade_id,
                            \yii\helpers\ArrayHelper::map($gradeList,'id','name') ,['class'=>'form-control  '])?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputStatus" class="col-sm-2 control-label">状态</label>

                    <div class="col-sm-8">
                        <?php echo \yii\helpers\Html::dropDownList('status',$vehicle->status,$vehicle->statusAlias(true),
                            ['class'=>'form-control','prompt'=>'请选择'])?>
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




</script>