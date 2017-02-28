<?php

namespace app\modules\admin\controllers;

class BaseController extends \app\controllers\Controller
{
    public function init()
    {
        parent::init();
        \Yii::$app->user->loginUrl = ['/admin/default/login'];
    }


    public function behaviors()
    {
        if ($this->getUniqueId() === 'admin/default') {
            return [];
        }
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
}