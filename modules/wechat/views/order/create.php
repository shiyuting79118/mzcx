<style>
    .active {
        background-color: red;
    }
</style>
<div>上车地点</div>
<div>下车地点</div>
<div>
    <ul class="js-grade-list">
        <?php foreach ($data as $item) { ?>
            <li>
                <div><?= \yii\helpers\Html::encode($item['name']) ?></div>
                <div><?= \yii\helpers\Html::encode($item['flag_fall']) ?></div>
            </li>
        <?php } ?>
    </ul>

</div>

<script>

    $(function () {

        $(".js-grade-list li").click(function () {

             $(this).addClass("active").siblings().removeClass("active");

        });

        //$($(".js-grade-list li")[2]).addClass("active");

        //原生JS
        var arr1 = document.getElementsByTagName("li");
        //arr1[0].addClass("active");//报错
        //arr1[0].setAttribute("class","active");

        $(arr1[0]).addClass("active");


        // $(".js-grade-list li")[1]  普通对象


        /*$.ajax({
         type: "POST",
         url: "
        <?=\app\modules\wechat\Module::apiUrl('api/vehicle/grade')?>",
         data: {},
         dataType: "json",
         success: function (result) {
         console.log(result);
         },
         error: function (xmlHttpRequest, textStatus, errorThrown) {

         }
         });*/

    });

</script>