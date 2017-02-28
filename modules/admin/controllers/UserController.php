<?php

    namespace app\modules\admin\controllers;

    use app\models\User;
    use yii\data\ActiveDataProvider;
    use yii\web\HttpException;

    class UserController extends BaseController
    {

        public $enableCsrfValidation = false;

        public function actionIndex()
        {
            //$users =  User::find()->where('status != 90')->all();
            //var_dump($users);

            //查询条件
            $query = User::find()->where('status != 90')->orderBy(['id' => SORT_DESC]);

            //$username = isset($_GET['username']) ? $_GET['username'] : null;
            $username = \Yii::$app->request->get('username');
            if (!empty($username)) {
                $query->andWhere('username=:username', ['username' => $username]);
            }

            $email = \Yii::$app->request->get('email');
            if (!empty($email)) {
                $query->andWhere('email like :email', ['email' => '%' . $email . '%']);
            }

            $dataProvider = new ActiveDataProvider();
            $dataProvider->query = $query;
            //$dataProvider->pagination->pageSize = 2;

            return $this->render('index', [
                'dataProvider' => $dataProvider
            ]);
        }

        /**
         * 禁用户
         */
        public function actionDisable($id)
        {
            /*@var $user User*/
            $user = self::findUser($id);
            if ($user->id == \Yii::$app->user->identity->id) {
                return $this->redirectWithError('您不能禁用您自己');
            }
            if ($user->status == User::STATUS_NO) {
                return $this->redirectWithError('您已经是禁用状态');
            }
            $user->status = User::STATUS_NO;
            if ($user->save()) {
                return $this->redirectWithSuccess('禁用成功');
            }
            return $this->redirectWithError('禁用失败');
        }

        public function actionEnable($id)
        {
            /*@var $user User*/
            $user = self::findUser($id);
            if ($user->id == \Yii::$app->user->identity->id) {
                return $this->redirectWithError('您不能启用您自己');
            }
            if ($user->status == User::STATUS_YES) {
                return $this->redirectWithError('您已经是启用状态');
            }

            $user->status = User::STATUS_YES;
            if ($user->save()) {
                return $this->redirectWithSuccess('启用成功');
            }
            return $this->redirectWithError('启用失败');
        }

        //删除司机
        public function actionDelete($id)
        {
            /*@var $user User*/
            $user = self::findUser($id);

            if ($user->id == \Yii::$app->user->identity->id) {
                return $this->redirectWithError('您不能删除您自己');
            }


            $user->status = User::STATUS_DELETE;
            if ($user->save()) {
                //如果是司机，删除司机表数据
                /* if($user->isDriver())
                 {
                     //var_dump($user->isDriver());exit;
                     $sql = 'DELETE FROM {{%driver}} WHERE user_id=:userid';
                     \Yii::$app->db->createCommand($sql, ['userid' => $this->id])->execute();
                 }*/

                //return $this->redirect('index');
                return $this->redirectWithSuccess('删除成功');

            }


            //\Yii::$app->session->setFlash('message','删除失败');

            // return $this->redirect('index');

            return $this->redirectWithError('删除失败');
        }

        //司机列表
        public function actionDriver()
        {
            $sql = 'SELECT user_id FROM {{%driver}}';
            $arr = \Yii::$app->db->createCommand($sql)->queryAll();
            $driverIds = array_column($arr, 'user_id');
            //var_dump($driverIds);

            //$users = User::findAll($driverIds);
            //var_dump($users);exit;

            //过滤显示被删除的司机
            $users = [];
            if (count($driverIds) > 0) {
                $driverIds = array_map('intval', $driverIds);
                // var_dump($driverIds);exit;
                $idsStr = join(',', $driverIds);
                // echo $idsStr;
                //$users = User::findAll($driverIds);
                $sql = 'SELECT * FROM  {{%user}} WHERE id in(' . $idsStr . ') AND status!=' . User::STATUS_DELETE . ' AND status!=' . User::STATUS_NO;
                $users = User::findBySql($sql)->all();
            }

            return $this->render('driver', [
                'users' => $users,
            ]);
        }

        //新增司机
        public function actionCreateDriver()
        {
            $user = new User();
            $user->loadDefaultValues();
            //$user->status = User::STATUS_NO;

            if (\Yii::$app->request->isPost) {

                $user->scenario = 'driver';

                $user->username = \Yii::$app->request->post('username');
                $user->email = \Yii::$app->request->post('email');
                $user->status = \Yii::$app->request->post('status');
                $user->password_salt = uniqid();
                $user->password_hash = User::makePasswordHash(\Yii::$app->request->post('password'), $user->password_salt);

                if ($user->save()) {

                    //标记为司机
                    $user->setIsDriver();
                    return $this->redirectWithSuccess('新增成功', ['driver']);
                }
            }

            return $this->render('create-driver', [
                'user' => $user
            ]);
        }

        public function actionUpdateDriver($id)
        {
            $user = self::findUser($id);
            return $this->render('update-driver', [
                'user' => $user
            ]);

        }

        /**
         * @param $id
         * @return array|null|$user
         * @throws \yii\web\HttpException
         */
        protected function findUser($id)
        {
            $user = User::find()->where('id=:id and status!=:status', ['id' => $id, 'status' => User::STATUS_DELETE])->one();
            if ($user == null) {
                throw new HttpException(404, '用户不存在');
            }
            return $user;
        }

        public function actionAdmin()
        {

            //$adminarr = \Yii::$app->db->createCommand($sql)->queryAll();
            //var_dump($adminarr);exit;
            $sql = 'SELECT user_id FROM {{%admin_user}}';
            $arr = \Yii::$app->db->createCommand($sql)->queryAll();
            $adminIds = array_column($arr, 'user_id');
            //var_dump($adminIds);

            $users = User::findAll($adminIds);
            //var_dump($users);exit;

            return $this->render('admin', [
                'users' => $users,
            ]);


        }


    }