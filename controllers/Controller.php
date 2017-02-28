<?php

namespace app\controllers;

use Yii;

class Controller extends \yii\web\Controller
{
    /**
     * 成功跳转
     * @param $message
     * @param null $url
     * @return \yii\web\Response
     */
    public function redirectWithSuccess($message, $url = null)
    {
        Yii::$app->session->setFlash('message', $message);
        Yii::$app->session->setFlash('status', 'success');
        if ($url === null) {
            $url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : \yii\helpers\Url::base();
        }
        return $this->redirect($url);
    }

    /**
     * 失败跳转
     * @param $message
     * @param null $url
     * @return \yii\web\Response
     */
    public function redirectWithError($message, $url = null)
    {
        Yii::$app->session->setFlash('message', $message);
        Yii::$app->session->setFlash('status', 'danger');
        if ($url === null) {
            $url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : \yii\helpers\Url::base();
        }
        return $this->redirect($url);
    }

    //输出提示信息
    public function showRedirectMessage()
    {
        if (Yii::$app->session->hasFlash('message')) { ?>
            <div
                class="alert alert-<?php echo \yii\helpers\Html::encode(Yii::$app->session->getFlash('status')); ?> alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <span><?php echo \yii\helpers\Html::encode(Yii::$app->session->getFlash('message')); ?></span>
            </div>
        <?php }
    }

    public function renderJsonWithTrue($data)
    {
        $data = ['status' => true, 'data' => $data];
        return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function renderJsonWithFalse($data)
    {
        $data = ['status' => false, 'data' => $data];
        return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

}