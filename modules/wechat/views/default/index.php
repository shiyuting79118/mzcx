<link rel="stylesheet" href="<?=\yii\helpers\Url::base()?>/wechat-static/css/index.css"/>
<link rel="stylesheet" href="<?=\yii\helpers\Url::base()?>/wechat-static/lib/swiper/css/swiper.min.css"/>
<script src="<?=\yii\helpers\Url::base()?>/wechat-static/lib/swiper/js/swiper.min.js"></script>


<div id="header">
    <img class="logo" src="<?=\yii\helpers\Url::base()?>/wechat-static/img/logo.png" alt=""/>
    迈征出行
    <a class="user" href="<?php echo \yii\helpers\Url::toRoute('user/index')?>">
        <img src="<?=\yii\helpers\Url::base()?>/wechat-static/img/header_user.png" alt=""/>
    </a>
</div>

<div class="swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <a href="">
                <img class="img-responsive" src="<?=\yii\helpers\Url::base()?>/wechat-static/img/tmp/slide1.jpg" alt=""/>
            </a>
        </div>
        <div class="swiper-slide">
            <a href="">
                <img class="img-responsive" src="<?=\yii\helpers\Url::base()?>/wechat-static/img/tmp/slide2.jpg" alt=""/>
            </a>
        </div>
        <div class="swiper-slide">
            <a href="">
                <img class="img-responsive" src="<?=\yii\helpers\Url::base()?>/wechat-static/img/tmp/slide3.jpg" alt=""/>
            </a>
        </div>
    </div>
    <div class="dots"></div>
</div>
<!--轮播器-->
<script type="text/javascript">
    var mySwiper = new Swiper('.swiper-container', {
        loop: true,
        autoplay: 3000,
        pagination: '.dots',
        bulletClass: "dot",
        bulletActiveClass: "active"
    });
</script>

<ul class="nav-button bc-tiled">
    <li>
        <a href="<?=\yii\helpers\Url::toRoute('order/order-now')?>">
            <img src="<?=\yii\helpers\Url::base()?>/wechat-static/img/index_car.png" alt=""/>
            <div>
                现在用车
            </div>
        </a>
    </li>
    <li>
        <a href="<?=\yii\helpers\Url::toRoute('order/order-after')?>">
            <img src="<?=\yii\helpers\Url::base()?>/wechat-static/img/index_yuyue.png" alt=""/>
            <div>预约用车</div>
        </a>
    </li>
</ul>