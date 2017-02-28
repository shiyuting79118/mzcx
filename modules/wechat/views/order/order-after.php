<div class="bc-header">
    <div class="bc-header-action">
        <a href="<?= \yii\helpers\Url::toRoute('default/index') ?>">
            <img height="20" src="<?= \yii\helpers\Url::base() ?>/wechat-static/img/header_back.png" alt=""/></a>
    </div>
    <div class="bc-header-title">预约用车</div>
    <div class="bc-header-action"></div>
</div>
<div class="bc-margin">
    <div class="text-muted">您打算什么时间用车呢？</div>
    <ul class="choice-list">
        <li>
            <div class="field">预约日期</div>
            <input type="text" class="js-data form-control" placeholder="预约时间"/>
            <i class="i-arrow"></i>
        </li>
    </ul>
    <p class="text-primary fs-10">提示：(不支持当天预约)目前我集团仅支持早9点~晚6点间的预约。</p>
</div>
<div class="bc-margin">
    <div class="text-muted">您想去哪里呢？</div>
    <ul class="choice-list">
        <li>
            <div class="field">上车地点</div>
            <input type="text" class="js-upadd form-control" placeholder="上车地点"/>
            <i class="i-circle"></i>
        </li>
        <li>
            <div class="field">下车地点</div>
            <input type="text" class="js-downadd form-control" placeholder="下车地点"/>
            <i class="i-circle-on"></i>
        </li>
    </ul>
</div>
<div class="bc-list bc-list-insert ">
    <div class="bc-item bc-item-flex">
        <div class="bc-item-body text-center "><b>车型价格明细</b></div>
        <div class="bc-item-foot">
            <i class="bc-icon bc-icon-link"></i>
        </div>
    </div>
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
    <span href="现在用车_地图轨迹.html" class="js-order-after bc-btn bc-btn-block bc-btn-primary">预约打车</span>
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

<div class="">
    <div class="block-content">

        <div class="js-bc-list bc-list" style="display: block">
            <div class="bc-item bc-item-flex">
                <div class="bc-item-head">
                    <a href=""><img height="20" src="<?= \yii\helpers\Url::base() ?>/wechat-static/img/header_back.png"
                                    alt=""/></a>
                </div>
                <div class="bc-item-body text-center fs-16">
                    <b>车型价格明细</b>
                </div>
                <div class="bc-item-foot">
                    <span class="js-grade-close close">&times;</span>
                </div>
            </div>
            <div class="bc-item ">
                <div class="text-muted">

                    <table class="js-table">
                        <tr>
                            <th>车型</th>
                            <th>起步价</th>
                            <th>单价</th>
                        </tr>
                    </table>
                    <p>说明：</p>

                    <p>在高峰时段或特殊情景如大风情况下，周围服务司机较
                        少，或司机距您较远，为促成交易，鼓励司机更快接
                        单，平台会对订单适当加价，保障您的出行。
                    </p>

                    <p>服务中产生的高速费、停车费、长途服务费、夜间服务
                        费等费用需要用户额外支付。
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tpl hide">
    <table>
        <tr class="tr">
            <td><span class="js-grade-name"></span></td>
            <td><span class="js-grade-flag_fall"></span></td>
            <td>
                <div>每公里5.0元</div>
                <div>每分钟0.5元</div>
            </td>
        </tr>
    </table>
</div>
<script>

    $(function () {
        var token = $.cookie("token");

        var page = 1;
        var url = "<?php echo \app\modules\wechat\Module::apiUrl('api/order/record')?>?token=" + token;


        if (!token) {
            window.location = "<?= \yii\helpers\Url::toRoute('user/login')?>";
            return;
        }

        $(".js-grade-list li").click(function () {
            $(this).addClass("active").siblings().removeClass("active");

            //第一步：获取Index的值
            var id = $(this).attr("date-grade-id");

            //第二步：将所有的li标签胡状态置为none
            $(".js-remark li").css("display", "none");

            //第三步：对应得到要显示的li标签
            $(".js-remark li[date-grade-id='" + id + "']").css("display", "block");
        });

        loadData();

        //post提交数据
        $(".js-order-after").click(function () {
            var up = $('.js-upadd').val();
            var down = $('.js-downadd').val();
            var id = $('.active').attr('date-grade-id');
            var token = console.log($.cookie('token'));
            var loading = pFinal.loading().start();
            var data=$('.js-data').val();
            $.ajax({
                type: "POST",
                url: "<?php echo \app\modules\wechat\Module::apiUrl('api/order/create')?>?token=" + $.cookie("token"),
                data: {
                    "type": 20,
                    "pickup": up,
                    "pickup_longitude": 111,
                    "pickup_latitude": 1122,
                    "destination": down,
                    "destination_longitude": 3424,
                    "destination_latitude": 3424,
                    "desire_grade_id": id,
                    "plan_at":data
                },
                dataType: "json",
                success: function (result) {

                    loading.stop();
                    if (result.status) {
                        pFinal.alert("下单成功", function () {
                            window.location = "<?php echo \yii\helpers\Url::toRoute('order/order-after-detail')?>?token=" + $.cookie("token");
                        });
                    }
                },
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    loading.stop();
                    pFinal.alert("网络出错");
                }
            });
        });

    });

    //请求车辆等级
    function loadData() {
        $.ajax({
            type: "GET",
            url: "<?=\app\modules\wechat\Module::apiUrl('api/vehicle/grade')?>",
            dataType: "json",
            success: function (result) {
                if (!result.status) {
                    pFinal.alert("请求数据失败，请刷新");
                    return;
                }
                showGradeListDetail(result.data);

                console.log(result.data);
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
            }
        });
    }


    //克隆等级详细信息
    function showGradeListDetail(gradeList) {

        //console.log(gradeList[1]['name']);
        for (var i in gradeList) {
            //var time = pFinal.dateFormat(new Date(1000 * gradeList[i].created_at), "yyyy-m-d h:i:s");
            var name = gradeList[i]['name'];
            var flag_fall = gradeList[i]['flag_fall'];
            $(".tpl table .tr td .js-grade-name").html(name);
            $(".tpl table .tr td .js-grade-flag_fall").html(flag_fall);
            $(".tpl table tr").clone().appendTo(".js-table");
        }
    }


    //关闭价格详细信息
    //footer-panel的透明度也要改  在上面的class样式被去掉
     $(".js-grade-close").click(function () {

     $(".js-bc-list").attr("style","display:none");
     //$(this).parent().parent().parent().attr("display", "none");
     });


</script>
