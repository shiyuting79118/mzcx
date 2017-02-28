<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="stylesheet" href="<?= \yii\helpers\Url::base() ?>/wechat-static/lib/basic-ui/css/basic-ui.css"/>
    <link rel="stylesheet" href="<?= \yii\helpers\Url::base() ?>/wechat-static/css/common.css"/>
    <link rel="stylesheet" href="<?= \yii\helpers\Url::base() ?>/wechat-static/css/use-car-pay.css"/>
</head>
<body>
<div class="bc-margin text-center" style="margin: 50px 0;">
    <img width="80" src="<?= \yii\helpers\Url::base() ?>/wechat-static/img/icon_success.png" alt=""/>

    <h3>支付成功</h3>
</div>

<div class="bc-margin">
    <p>服务评价：</p>

    <div class="text-center">
        <ul class="bc-tiled star-bar js-star">
            <li id="10">
                <div class="js-fcmy  star"></div>
                <div >非常满意</div>
            </li>
            <li id="20">
                <div class="js-my star"></div>
                <div>满意</div>
            </li>
            <li id="30">
                <div class="js-yb  star"></div>
                <div>一般</div>
            </li>
            <li id="40">
                <div class="js-bmy  star"></div>
                <div>不满意</div>
            </li>
        </ul>
    </div>
</div>
<div class="bc-margin">
    <div class=" block-panel-2">
        <div class="bd">
            <textarea class="js-content" name="" id="" cols="30" rows="2" placeholder="请您对本次服务给点评价及建议，谢谢！"></textarea>
        </div>
    </div>
</div>
<div class="bc-margin">
    <button class="bc-btn bc-btn-block bc-btn-primary js-go-comment">提交评价</button>
</div>


</body>
</html>
<script>
    $(function () {
        $(".js-star li").click(function () {
            $(this).addClass("active").siblings().removeClass("active");
        });
    });

    //post提交数据
    $(".js-go-comment").click(function () {
        var star = $(".active").attr("id");
        var content = $('.js-content').val();
        var orderid = <?= \Yii::$app->request->get('newOrderId')?>;

        $.ajax({
            type: "POST",
            url: "<?php echo \app\modules\wechat\Module::apiUrl('api/order/comment')?>?token=" + $.cookie("token"),
            data: {
                "order-id": orderid,
                "star": star,
                "content": content
            },
            dataType: "json",
            success: function (result) {

               // loading.stop();
                if (result.status) {
                    //console.log(result.data);
                    newOrderId = result.data;
                    pFinal.alert("成功", function () {
                        window.location = "<?php echo \yii\helpers\Url::toRoute('order/index')?>";
                    });
                }
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
               // loading.stop();
                pFinal.alert("网络出错");
            }

        });
        });
</script>
