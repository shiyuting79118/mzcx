<link rel="stylesheet" href="<?= \yii\helpers\Url::base() ?>/wechat-static/css/account.css"/>
<div class="bc-header">
    <div class="bc-header-action">
        <a href="<?=\yii\helpers\Url::toRoute('default/index')?>">
            <img height="20" src="<?= \yii\helpers\Url::base() ?>/wechat-static/img/header_home.png"  alt=""/></a>
    </div>
    <div class="bc-header-title"></div>
    <div class="bc-header-action"></div>
</div>


<div class="banner js-guest">
    <img class="thumb" width="" src="<?= \yii\helpers\Url::base() ?>/wechat-static/img/account_avatar.png" alt=""/>
    <a class="reg" href="<?= \yii\helpers\Url::toRoute('register') ?>">请先注册</a>
</div>
<!--这里作为模版并没有显示 -->
<div class="banner js-login" style="display:none">
    <a href="<?=\yii\helpers\Url::toRoute('user/update')?>" class="edit"><img src="<?= \yii\helpers\Url::base() ?>/wechat-static/img/register_edit.png"
                                 alt=""/><span>编辑</span></a>
    <img class="thumb" width="" src="<?= \yii\helpers\Url::base() ?>/wechat-static/img/account_avatar.png" alt=""/>

    <div class="info clearfix">
        <div class="fl">用户名：<span class="js-nickname"></span></div>
        <div class="fr">联系电话：<span class="js-mobile"></span></div>
    </div>
</div>


<div class="strong">
    <div class="bc-block-title"></div>
    <div class="bc-list bc-list-border-0">
        <a href="<?= \yii\helpers\Url::toRoute('order/record') ?>" class="bc-item">
            用车记录
        </a>
    </div>
    <div class="bc-block-title"></div>
    <div class="bc-list bc-list-border-0">
        <a href="<?= \yii\helpers\Url::toRoute('order/reserve') ?>" class="bc-item">
            我的预约
        </a>
    </div>

</div>

<script>

    $(function () {


        var loading =  pFinal.loading().start();

        $.ajax({
            type: "GET",
            url: "<?php echo \app\modules\wechat\Module::apiUrl('api/user/profile')?>?token=" + $.cookie("token"),
            dataType: "json",
            success: function (result) {
                loading.stop();
                if (result.status) {

                    console.log(result);

                    $(".js-nickname").html(result.data.nickname);
                    $(".js-mobile").html(result.data.mobile);

                    $(".js-login").show();
                    $(".js-guest").hide();

                }

            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                loading.stop();
                pFinal.alert("网络出错");
            }
        });
    });

</script>

