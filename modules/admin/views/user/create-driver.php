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

            /* @var $user */

            $errors = $user->firstErrors;
            foreach ($user->firstErrors as $key => $error) {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }

            ?>


            <form action="<?php echo \yii\helpers\Url::toRoute('user/create-driver') ?>" class="form-horizontal"
                  method="post">

                <div class="form-group  <?php echo array_key_exists('username', $errors) ? 'has-error' : '' ?>">
                    <label for="input-username" class="col-sm-2 control-label">登录名称</label>

                    <div class="col-sm-8">
                        <input type="text" name="username" class="form-control" id="input-username"
                               value="<?= \yii\bootstrap\Html::encode($user->username) ?>" placeholder="username">

                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-8">
                        <input name="email" type="text" class="form-control" id="inputEmail" placeholder="Email">
                        <span class="help-block">请填入邮箱</span>
                    </div>

                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputStatus" class="col-sm-2 control-label">状态</label>

                    <div class="col-sm-8">
                        <?php echo \yii\helpers\Html::dropDownList('status',$user->status,$user->statusAlias(true),['class'=>'form-control','prompt'=>'请选择'])?>
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

            if (!pFinal.isEmail($("#inputEmail").val())) {
                // pFinal.alert("请输入正确的邮箱");
                //pFinal.toast("请输入正确的邮箱");

                $("#inputEmail").parent().parent().addClass("has-error");
                $("#inputEmail").next().html('请输入正确的邮箱') ;

                return false;
            }

            return true;
        });

    });


</script>