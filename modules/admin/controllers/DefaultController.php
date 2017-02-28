<?php

namespace app\modules\admin\controllers;

use app\models\User;
use yii\web\Controller;

/**
 * 此控制器做登录，找回密码等功能
 */
class DefaultController extends Controller
{
    public $layout = false;
    public $enableCsrfValidation = false;


    public function actions()
    {
        return [
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::className(),
                'minLength' => 4,
                'maxLength' => 4,
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect(['home/index']);
    }

    //登录
    public function actionLogin()
    {

        //不是ajax时，显示登录界面
        if (!\Yii::$app->request->isAjax) {
            return $this->render('login');
        }

        //执行登录的操作

        //接收表单输入
        //$username = $_POST['username'];
        $username = \Yii::$app->request->post('username');
        $password = \Yii::$app->request->post('password');
        $captcha = \Yii::$app->request->post('captcha');
        $rememberMe = \Yii::$app->request->post('rememberMe');


        //验证码
        /* @var $action  \yii\captcha\CaptchaAction */
        $action = $this->createAction('captcha');
        if (!$action->validate($captcha, false)) {
            return json_encode(['status' => false, 'data' => '验证码不匹配']);
        }


        if (User::adminLogin($username, $password, $rememberMe)) {
            return json_encode(['status' => true, 'data' => '登录成功']);
        }

        return json_encode(['status' => false, 'data' => '登录失败']);
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();
        return $this->redirect(['home/index']);
    }


}
