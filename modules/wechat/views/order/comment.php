<div class="bc-header">
    <div class="bc-header-action">
        <a href="javascript:history.go(-1);"><img height="20"
                                                  src="<?= \yii\helpers\Url::base() ?>/wechat-static/img/header_back.png"
                                                  alt=""/></a>
    </div>
    <div class="bc-header-title"></div>
    <div class="bc-header-action">
        <a href="<?=\yii\helpers\Url::toRoute('default/index')?>">
            <img height="20" src="<?= \yii\helpers\Url::base() ?>/wechat-static/img/header_home.png"  alt=""/></a>
    </div>
</div>
<div class="bc-margin">
    <div class="block-panel">
        <div class="hd">打车详情</div>
        <div class="bd">
            <div class="bc-list">
                <div class="bc-item bc-item-flex">
                    <div class="bc-item-head">司机姓名</div>
                    <div class="bc-item-body"><?= \yii\helpers\Html::encode($data['member']['nickname']) ?></div>
                </div>
                <div class="bc-item bc-item-flex">
                    <div class="bc-item-head">联系方式</div>
                    <div class="bc-item-body"><?= \yii\helpers\Html::encode($data['member']['mobile']) ?></div>
                </div>
                <div class="bc-item bc-item-flex">
                    <div class="bc-item-head">品牌</div>
                    <div class="bc-item-body">凯迪拉克XTS</div>
                </div>
                <div class="bc-item bc-item-flex">
                    <div class="bc-item-head">车牌号</div>
                    <div class="bc-item-body">沪A888888</div>
                </div>
                <div class="bc-item bc-item-flex">
                    <div class="bc-item-head">用车时间</div>
                    <div class="bc-item-body"><?= \yii\helpers\Html::encode($data['order']['plan_at']) ?></div>
                </div>
                <div class="bc-item bc-item-flex bc-border-0">
                    <div class="bc-item-head">目的地</div>
                    <div class="bc-item-body"><?= \yii\helpers\Html::encode($data['order']['destination']) ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bc-margin">
    <p>服务评价：</p>

    <div class="text-center">
        <ul class="bc-tiled star-bar">
            <li>
                <div class="star"></div>
                <div>非常满意</div>
            </li>
            <li>
                <div class="star"></div>
                <div>满意</div>
            </li>
            <li>
                <div class="star"></div>
                <div>一般</div>
            </li>
            <li class="active">
                <div class="star"></div>
                <div>不满意</div>
            </li>
        </ul>
    </div>
</div>
<div class="bc-margin">
    <div class="block-panel block-panel-2">
        <div class="bd">
            <textarea name="" id="" cols="30" rows="2" placeholder="请您对本次服务给点评价及建议，谢谢！"></textarea>
        </div>
    </div>
</div>