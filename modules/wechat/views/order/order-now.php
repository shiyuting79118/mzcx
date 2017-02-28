<div class="bc-header">
    <div class="bc-header-action">
        <a href="<?= \yii\helpers\Url::toRoute('default/index') ?>">
            <img height="20" src="<?= \yii\helpers\Url::base() ?>/wechat-static/img/header_back.png" alt=""/></a>
    </div>
    <div class="bc-header-title">现在用车</div>
    <div class="bc-header-action"></div>
</div>

<div class="bc-margin">
    <div class="text-muted">您想去哪里呢？</div>
    <ul class="choice-list">
        <li>
            <div class="field">上车地点</div>
            <input type="text" class="js-upadd form-control" placeholder="上车地点"/>
        </li>
        <li>
            <div class="field">下车地点</div>
            <input type="text" class="js-downadd form-control" placeholder="下车地点"/>
            <i class="i-circle-on"></i>
        </li>
    </ul>
</div>
<div class="bc-margin">
    <ul class="js-grade-list bc-tiled tab-head text-muted">
        <?php foreach ($data as $key => $item) { ?>
            <li class="a" date-grade-id="<?= $item['id'] ?>">
                <div><?= \yii\helpers\Html::encode($item['name']) ?></div>
            </li>
        <?php } ?>
    </ul>
    <div class="tab-body">
        <div class="tab-item " style="display: block">
            <div class="row js-remark">
                <?php foreach ($data as $key => $item) { ?>
                <li  date-grade-id="<?= $item['id'] ?>" style="display:none;">
                    <div class="cell"><span
                            class="big"><?= \yii\helpers\Html::encode($item['flag_fall']) ?></span>元起
                    </div>
                    <div class="cell "><?= \yii\helpers\Html::encode($item['km_price']) ?></div>
                    <?php } ?>
                </li>
                <a href="" class="row big">查看须知</a>
            </div>
        </div>
    </div>
</div>


<div class="bc-margin">
    <span href="现在用车_地图轨迹.html" class="js-order-now bc-btn bc-btn-block bc-btn-primary">马上打车</span>
</div>
<div class="common-alert ">
    <div class="container cute-container">
        <div class="block-content">
            <div class="hd">
                <h1>乘车须知</h1>

                <a href="" class="close">&times;</a>
            </div>
            <div class="bd text-muted">
                <h4 class="text-primary">说明:</h4>

                <p>在高峰时段或特殊情景如大风情况下，周围服务司机较少，或司机距您较远，为促成交易，鼓励司机更快接单，平台会对订单适当加价，保障您的出行。</p>

                <p>服务中产生的高速费、停车费、长途服务费、夜间服务</p>

                <p>费等费用需要用户额外支付。</p>
            </div>
        </div>
    </div>
</div>


<script>

    $(function () {
        //修改样式
        $(".js-grade-list li").click(function () {
            $(this).addClass("active").siblings().removeClass("active");

            //第一步：获取Index的值
            var id = $(this).attr("date-grade-id");

            //第二步：将所有的li标签胡状态置为none
            $(".js-remark li").css("display", "none");

            //第三步：对应得到要显示的li标签
            $(".js-remark li[date-grade-id='" + id + "']").css("display", "block");
        });


        //post提交数据
        $(".js-order-now").click(function () {
            var up = $('.js-upadd').val();
            var down = $('.js-downadd').val();
            var id = $('.active').attr('date-grade-id');
            var token = console.log($.cookie('token'));
            var loading = pFinal.loading().start();
            $.ajax({
                type: "POST",
                url: "<?php echo \app\modules\wechat\Module::apiUrl('api/order/create')?>?token=" + $.cookie("token"),
                data: {
                    "type": 10,
                    "pickup": up,
                    "pickup_longitude": 111,
                    "pickup_latitude": 1122,
                    "destination": down,
                    "destination_longitude": 3424,
                    "destination_latitude": 3424,
                    "desire_grade_id": id,
                    "plan_at": 0
                },
                dataType: "json",
                success: function (result) {

                    loading.stop();
                    if (result.status) {
                        pFinal.alert("下单成功", function () {
                            var newOrderId=result.data;
                            window.location = "<?php echo \yii\helpers\Url::toRoute('order/success')?>?newOrderId="+newOrderId;
                        });
                    }
                },
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    loading.stop();
                    pFinal.alert("网络出错");
                }
            });
        });

    })
</script>

