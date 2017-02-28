<?php
    namespace app\modules\api\controllers;

    use app\controllers\Controller;
    use app\models\User;

    /**
     *用户api
     */
    class UserController extends Controller
    {
        public $enableCsrfValidation = false;

        /**
         * 注册
         * nickname   昵称
         * mobile     手机号码
         * code       手机短信验证码
         * password   登录密码
         * openid     微信openid
         */
        public function actionRegister()
        {

            //判断手机验证码
            $code = \Yii::$app->request->post('code');
            $mobile = \Yii::$app->request->post('mobile');

            //取缓存中的随机数
            $num = \Yii::$app->cache->get($mobile);

            //验证码过期或没有发送  或 无效
            if (empty($num) || $num != $code) {
                return $this->renderJsonWithFalse('手机短信验证码无效');
            }

            $user = new User();
            $user->scenario = 'register';

            $user->nickname = \Yii::$app->request->post('nickname');
            $user->mobile = $mobile;
            $user->password_salt = uniqid();
            $user->password_hash = User::makePasswordHash(\Yii::$app->request->post('password'), $user->password_salt);
            $user->openid = \Yii::$app->request->post('openid', '');

            $user->access_token = strtoupper(md5(uniqid() . time()));


            if ($user->save()) {
                $data = ['status' => true, 'data' => ['token' => $user->access_token]];
            } else {

                $errors = $user->getFirstErrors();
                $error = current($errors);

                $data = ['status' => false, 'data' => $error];

            }

            return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        //返回登录用户的个人信息
        public function actionProfile()
        {
            //获取当前用户  不能通过 id
            $token = \Yii::$app->request->get('token');
            $user = User::findIdentityByAccessToken($token);
            if ($user == null) {
                //  return json_encode(['status' => false, 'data' => '请登录']);
                return $this->renderJsonWithFalse('请登录');
            }

            //controller里有方法了
            /* @var $user User */
            /*return json_encode(['status' => true, 'data' => [
                'mobile' => $user->mobile,
                'nickname' => $user->nickname,
                'avatar' => $user->avatar,
            ]]);*/

            return $this->renderJsonWithTrue([
                'mobile' => $user->mobile,
                'nickname' => $user->nickname,
                'avatar' => $user->avatar,
            ]);
        }

        /**登录
         * @return string
         */
        public function actionLogin()
        {
            $user = new User();
            $user->scenario = 'login';
            $mobile = \Yii::$app->request->post('mobile');
            $password = \Yii::$app->request->post('password');
            //return json_encode($username);

            $user = User::findUserByMobileAndPassword($mobile, $password);
            if ($user) {
                //echo '111';
                //登录成功拿到token的值
                $data = ['status' => true, 'data' => ['token' => $user->access_token]];
                //return $this->renderJsonWithTrue('登录成功');
            } else {

                $data = ['status' => false, 'data' => '手机号码或密码错误'];
            }

            return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        public function actionUpdate()
        {
            $user = new User();
            $user->scenario = 'update';
            //获取token的值
            $token = \Yii::$app->request->get('token');
            //通过token的值来查找用户
            $user = User::findIdentityByAccessToken($token);
            if ($user) {
                $user->mobile = \Yii::$app->request->post('mobile');
                $user->nickname = \Yii::$app->request->post('nickname');
                $user->password_salt = uniqid();
                $user->password_hash = User::makePasswordHash(\Yii::$app->request->post('password'), $user->password_salt);
                $user->avatar = \Yii::$app->request->post('avatar');//头像
                if ($user->save()) {
                    return $this->renderJsonWithFalse('更新成功');
                    /*return $this->renderJsonWithTrue([
                        'mobile' => $user->mobile,
                        'nickname' => $user->nickname,
                        'avatar' => $user->avatar,
                    ]);*/
                } else {
                    return $this->renderJsonWithFalse('更新失败');
                }
            } else {
                //  return json_encode(['status' => false, 'data' => '请登录']);
                return $this->renderJsonWithFalse('请登录');
            }
        }

        //通过手机号码重置号码
        /* public function actionSetPasswordByMobile()
         {
             $user = new User();
             $user->scenario = 'setpasswordbymobile';
             $mobile =\Yii::$app->request->post('mobile');

             //通过mobile的值来查找用户
             $user = User::findUserByMobile($mobile);

         }*/

    }