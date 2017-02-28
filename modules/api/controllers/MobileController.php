<?php

    namespace app\modules\api\controllers;

    use app\controllers\Controller;
    use app\sms\SmsSdk;

    class MobileController extends Controller
    {
        public $enableCsrfValidation = false;

        //给指定手机短信验证码
        public function actionVerify()
        {
            //接收参数
            $mobile = \Yii::$app->request->post('mobile'); //手机号
            $code = \Yii::$app->request->post('code');     //图片验证码

            $num = rand(1000, 9999); //随机数

            if (SmsSdk::send($mobile, $num)) {

                //将随机数存到缓存中，注册时会用到这个随机数
                \Yii::$app->cache->set($mobile, $num, 60 * 5);

                return $this->renderJsonWithTrue('SUCCESS');
            }

            return $this->renderJsonWithTrue('ERROR');
        }
    }