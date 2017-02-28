<div class="bc-header">
    <div class="bc-header-action">
        <a href="javascript:history.go(-1);"><img height="20"
                                                  src="<?= \yii\helpers\Url::base() ?>/wechat-static/img/header_back.png"
                                                  alt=""/></a>
    </div>
    <div class="bc-header-title">用车记录</div>
    <div class="bc-header-action"></div>
</div>

<div class="js-order-list bc-list">

    <!--<div class="js-order-item bc-item bc-item-flex">
        <div class="bc-item-body">
            <div>提交人：??</div>
            <div class="small text-muted">提交日期：<span class="js-order-created"></span></div>
        </div>
        <div class="bc-item-foot text-success"><span>已评价</span></div>
    </div>-->
</div>


<div class="tpl" style="display: none">
    <div class="js-order-item bc-item bc-item-flex">
        <div class="bc-item-body">
            <div>提交人：<span class="js-order-name"></span></div>
            <div class="small text-muted">提交日期：<span class="js-order-created"></span></div>
        </div>
        <div class="bc-item-foot text-success"><span class="js-order-comment"></span></div>
    </div>
</div>


<div class="bc-system-tip">
    <span class="js-more">加载更多</span>
</div>


<script>

    var token = $.cookie("token");

    var page = 1;
    var url = "<?php echo \app\modules\wechat\Module::apiUrl('api/order/record')?>?token=" + token;
    $(function () {

        if (!token) {
            window.location = "<?= \yii\helpers\Url::toRoute('user/register')?>";
            return;
        }
        loadData();

        $(".js-more").click(function () {
            page++;
            loadData();
        });

    });


    function loadData() {
        $.ajax({
            type: "GET",
            url: url + "&page=" + page + '&type=10',
            dataType: "json",
            success: function (result) {
                if (!result.status) {
                    pFinal.alert("请求数据失败，请刷新");
                    return;
                }
                showOrderList(result.data);
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                pFinal.alert("请求数据失败，请刷新");
            }
        });
    }


    function showOrderList(orderList) {
        //console.log(orderList);
        //console.log(orderList[0]['comment_status']);

        for (var i in orderList) {

            var time = pFinal.dateFormat(new Date(1000 * orderList[i].created_at), "yyyy-m-d h:i:s");

            var member_id = orderList[i]['member_id'];

            var comment_status = orderList[i]['comment_status'] == 10 ? '未评论' : '已评论';

            $(".tpl .js-order-item .js-order-name").html(member_id);
            $(".tpl .js-order-item .js-order-created").html(time);
            $(".tpl .js-order-item .js-order-comment").html(comment_status);

            $(".tpl .js-order-item").clone().appendTo(".js-order-list");
        }

        //这里的2是每页数据条数，如果接口每页是10条，这里就填写10
        if (orderList.length < 2) {
            $(".js-more").html("加载完毕");
        }

    }

</script>