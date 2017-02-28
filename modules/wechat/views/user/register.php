<link rel="stylesheet" href="<?= \yii\helpers\Url::base() ?>/wechat-static/css/register.css"/>

<script src="<?= \yii\helpers\Url::base() ?>/static/jquery-cookie/jquery.cookie.js"></script>

<form id="myForm">
    <div class="bc-margin">
        <div class="bc-list">

            <label class="bc-item bc-item-flex">
                <span class="bc-item-head"><img
                        src="<?= \yii\helpers\Url::base() ?>/wechat-static/img/register_user.png" alt=""/></span>
            <span class="bc-item-body">
                <input name="nickname" class="js-nickname bc-item-input" type="text" placeholder="请输入姓名"/>
            </span>
            </label>

            <label class="bc-item bc-item-flex">
                <span class="bc-item-head"><img
                        src="<?= \yii\helpers\Url::base() ?>/wechat-static/img/register_phone.png" alt=""/></span>
            <span class="bc-item-body">
                <input name="mobile" class="js-mobile bc-item-input" type="tel" placeholder="请输入手机号"/>
            </span>
                <a class="js-get-code get-code bc-item-foot" href="javascript:;">获取短信验证码</a>
            </label>

            <label class="bc-item bc-item-flex">
                <span class="bc-item-head"><img
                        src="<?= \yii\helpers\Url::base() ?>/wechat-static/img/register_pass.png" alt=""/></span>
            <span class="bc-item-body">
                <input name="code" class="bc-item-input" type="tel" placeholder="请输入6位短信验证码"/>
            </span>
            </label>


            <label class="bc-item bc-item-flex">
                <span class="bc-item-head"><img
                        src="<?= \yii\helpers\Url::base() ?>/wechat-static/img/register_pass.png" alt=""/></span>
            <span class="bc-item-body">
                <input name="password" class="bc-item-input" type="tel" placeholder="请输入密码"/>
            </span>
            </label>


        </div>
    </div>
</form>


<div style="height: 50px"></div>
<div class="bc-margin">
    <a href="javascript:;" class="js-register bc-btn bc-btn-block bc-btn-primary">下一步</a>
</div>

<script>

    var registerCodeWateTime = 60;
    function check() {
        if (registerCodeWateTime >= 0) {
            $(".js-get-code").html(registerCodeWateTime-- + "秒后可重发");
            setTimeout(check, 1000);
        } else {
            registerCodeWateTime = 60;
            $(".js-get-code").html("获取短信验证码");
        }
    }

    $(function () {


        $(".js-get-code").click(function () {

            if (registerCodeWateTime != 60) {
                return;
            }

            var mobile = $(".js-mobile").val();
            if (!pFinal.isMobile(mobile)) {
                pFinal.alert("请输入正确的手机号码");
                return;
            }

            var loading = pFinal.loading(this, "正在发送...").start();
            $.ajax({
                type: "POST",
                url: "<?php echo \app\modules\wechat\Module::apiUrl('api/mobile/verify')?>",
                data: {"mobile": mobile, "code": ""},
                dataType: "json",
                success: function (result) {

                    loading.stop();

                    if (result.status) {

                        check();

                        pFinal.toast("发送成功");
                    } else {
                        pFinal.alert(result.data);
                    }
                },
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    loading.stop();
                    pFinal.alert("网络错误");
                }
            });

        });


        $(".js-register").click(function () {

            if ($(".js-nickname").val().length < 3 || $(".js-nickname").val().length > 12) {
                pFinal.toast("姓名应该是3-12个字符长度", 1000);
                return;
            }


            if ($(".js-mobile").val().length == 0) {
                pFinal.toast("请输入手机号码");
                return;
            }

            if (!pFinal.isMobile($(".js-mobile").val())) {
                pFinal.toast("请输入正确的手机号码");
                return;
            }


            var loading = pFinal.loading().start();

            $.ajax({
                type: "POST",
                url: "<?php echo \app\modules\wechat\Module::apiUrl('api/user/register')?>",
                data: $("#myForm").serialize(),
                dataType: "json",
                success: function (result) {

                    //{"status":true,"data":{"token":"TOKEN"}}


                    loading.stop();

                    if (result.status) {

                        console.log(result.data);
                        // alert(result.data.token)

                        $.cookie('token', result.data.token, {'path': '/'});

                        pFinal.alert("注册成功", function () {
                            window.location = "<?php echo \yii\helpers\Url::toRoute('index')?>";
                        });

                    } else {
                        pFinal.alert(result.data);
                    }

                },
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    loading.stop();
                    pFinal.alert("网络错误");
                }
            });


        });


    });

</script>