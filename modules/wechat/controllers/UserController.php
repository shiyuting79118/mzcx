<?php

namespace app\modules\wechat\controllers;

use yii\web\Controller;

/**
 * 用户中心
 * @author  Zou Yiliang
 * @since   1.0
 * @author  Shi yuting
 */
class UserController extends Controller
{
    //用户中心首页
    public function actionIndex()
    {
        $this->layout = 'main-base';
        return $this->render('index');
    }

    //用户注册页
    public function actionRegister()
    {
        return $this->render('register');
    }

    //编辑用户
    public function actionUpdate()
    {
        return $this->render('update');
    }

}
