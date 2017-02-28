<?php

    namespace app\modules\wechat;

    /**
     * wechat module definition class
     */
    class Module extends \yii\base\Module
    {
        public $layout = 'main-base';
        public $controllerNamespace = 'app\modules\wechat\controllers';

        /**
         * @inheritdoc
         */
        public function init()
        {
            parent::init();

            // custom initialization code goes here
        }

        //测试链接和上架链接 可以更换  params.php
        public static function apiUrl($api)
        {
            $baseUrl = \Yii::$app->params['isDev']
                ? \Yii::$app->params['apiUrlDev']
                : \Yii::$app->params['apiUrl'];
            return $baseUrl . $api;
        }
    }
