<?php
    namespace app\modules\api\controllers;

    use app\controllers\Controller;
    use app\models\Comment;
    use app\models\Order;
    use app\models\User;
    use app\models\Vehicle;
    use yii\data\ActiveDataProvider;

    class OrderController extends Controller
    {
        public $enableCsrfValidation = false;

        //创建订单
        public function actionCreate()
        {
            $order = new Order();
            //$order->scenario = 'order';
            $token = \Yii::$app->request->get('token');
            $user = User::findIdentityByAccessToken($token);
            if ($user) {
                //创建订单
                //echo 111;
                /*'pickup' => '上车地点',
                'pickup_longitude' => '上车地点经度',
                'pickup_latitude' => '上车地点纬度',
                'destination' => '要去哪儿',
                'destination_longitude' => '目的地经度',
                'destination_latitude' => '目的地纬度',
                'desire_grade_id' => '车辆等级ID',
                'plan_at' => 0, //出发时间 type为预约用车时 该字段必填*/
                //获取信息
                $order->type = \Yii::$app->request->post('type');
                $order->pickup = \Yii::$app->request->post('pickup');
                $order->pickup_longitude = \Yii::$app->request->post('pickup_longitude');
                $order->pickup_latitude = \Yii::$app->request->post('pickup_latitude');
                $order->destination = \Yii::$app->request->post('destination');
                $order->destination_longitude = \Yii::$app->request->post('destination_longitude');
                $order->pickup_latitude = \Yii::$app->request->post('pickup_latitude');
                $order->desire_grade_id = \Yii::$app->request->post('desire_grade_id');
                $order->plan_at = \Yii::$app->request->post('plan_at');
                $order->member_id = $user->id;
                //var_dump($_POST);exit;
                if (!$_POST) {
                    return $this->renderJsonWithTrue('请完善订单');
                } else {
                    if ($order->save()) {
                        return $this->renderJsonWithTrue($order->id);
                        //return $this->renderJsonWithTrue($orderId);
                    } else {
                        $errors = $order->getFirstErrors();
                        $error = current($errors);
                        //var_dump($error);exit;
                        return $this->renderJsonWithFalse($error);
                    }
                }

            } else {
                return $this->renderJsonWithFalse('请登录');
            }
        }


        /**
         * 获取订单详情
         */
        public function actionDetail()
        {
            //接收参数
            $orderId = \Yii::$app->request->get('order-id');
            $token = \Yii::$app->request->get('token');

            //验证当前用户
            $user = User::findIdentityByAccessToken($token);
            if ($user == null) {
                return $this->renderJsonWithFalse('请登录');
            }

            /* @var $order Order */
            //查询订单信息
            $order = Order::find()->where(['id' => $orderId])->one();

            //验证订单id是否有效
            if ($order == null) {
                return $this->renderJsonWithFalse('订单id不存在');
            }

            //验证订单是否当前会员
            if ($order->member_id != $user->id) {
                return $this->renderJsonWithFalse('您无权查看此订单');
            }

            //司机
            $driver = null;
            if ($order->driver_id != 0) {
                $model = User::find()->where(['id' => $order->driver_id])->one();
                $driver['id'] = $model->id;
                $driver['nickname'] = $model->nickname;
            }

            //车辆
            $vehicle = null;
            if ($order->vehicle_id != 0) {
                $vehicle = Vehicle::find()->asArray()->where(['id' => $order->vehicle_id])->one();
            }

            $member = $user->attributes;
            unset($member['password_hash']);
            unset($member['access_token']);
            unset($member['remember_token']);
            unset($member['password_salt']);

            $data = [
                'order' => $order->attributes,
                'vehicle' => $vehicle,
                'member' => $member,
                'driver' => $driver,
            ];

            return $this->renderJsonWithTrue($data);

        }

        /**
         * 用户取消订单
         */
        public function actionCancel()
        {
            $token = \Yii::$app->request->get('token');
            $user = User::findIdentityByAccessToken($token);

            //查看用户表里有没有这个数据
            if ($user) {
                //得到post提交过来的订单id
                $orderId = intval(\Yii::$app->request->post('order-id'));

                /* @var $order Order */
                //通过订单ID查找订单
                $order = Order::find()->where(['status' => Order::STATUS_NEW, 'id' => $orderId])->One();

                //判断订单是否存在
                if ($order == null) {
                    return $this->renderJsonWithFalse('订单不存在');
                }
                //验证订单是否当前会员
                if ($order->member_id != $user->id) {
                    return $this->renderJsonWithFalse('您无权查看此订单');
                }
                //如果订单存在，则取消
                $res = Order::cancelOrderByOrderId($orderId);
                if ($res) {
                    return $this->renderJsonWithTrue('订单取消成功');
                } else {
                    return $this->renderJsonWithFalse('订单取消失败');
                }
            } else {
                return $this->renderJsonWithFalse('请登录');
            }
        }


        //订单评论
        //'order-id' => 订单id
        //'star' => 几星
        //'content' => 评论内容
        public function actionComment()
        {
            //通过token的值来查询用户
            $orderId = intval(\Yii::$app->request->post('order-id'));
            $token = \Yii::$app->request->get('token');

            //验证当前用户
            $user = User::findIdentityByAccessToken($token);
            if ($user == null) {
                return $this->renderJsonWithFalse('请登录');
            }

            /* @var $comment Comment */
            //通过订单号查询订单  订单存在且状态为已完成
            $order = Order::find()->where(['id' => $orderId, 'status' => Order::STATUS_SUCCESS])->one();
            //var_dump($order);exit;
            //如果查不到
            if ($order == null) {
                return $this->renderJsonWithFalse('此订单不存在');
            }
            //判断订单是否有内容
            $comment = Comment::findOne($orderId);
            //var_dump($comment);
            if ($comment->content) {
                return $this->renderJsonWithFalse('您已经评论过此订单');
            }

            //获取post提交过来的内容
            $comment->star = \Yii::$app->request->post('star');
            $comment->content = \Yii::$app->request->post('content');
            $comment->order_id = $orderId;
            //var_dump($_POST);exit;

            if ($comment->save()) {
                return $this->renderJsonWithTrue('订单评论成功');
            } else {
                $errors = $comment->getFirstErrors();
                $error = current($errors);
                //var_dump($error);exit;
                return $this->renderJsonWithFalse($error);
                //return $this->renderJsonWithFalse('订单评论失败');
            }
        }

       /* public function actionRecord()
        {
            //通过token的值来查询用户
            $token = \Yii::$app->request->get('token');
            //验证当前用户
            $user = User::findIdentityByAccessToken($token);
            if ($user == null) {
                return $this->renderJsonWithFalse('请登录');
            }
            $type = \Yii::$app->request->get('type') ? \Yii::$app->request->get('type') : Order::TYPE_NOW;
            $query = Order::find()->select([
                'id',
                'type',
                'member_id',
                'out_trade_no',
                'pickup',
                'destination',
                'plan_at',
                'driver_id',
                'vehicle_id',
                'on_at',
                'off_at',
                'grade_id',
                'distance',
                'total_fee',
                'status',
                'pay_type',
                'payment_status',
                'comment_status',
                'created_at',
                'updated_at',
            ])->where(['member_id' => $user->id, 'type' => $type])->orderBy(['id' => SORT_DESC])->asArray();

            //NEW 创建适配器
            $order = new ActiveDataProvider();
            //pageSize = 2;
            //实际上这一步是多余的
            //因为不开启这一步通过GET方式传递
            // per-page=X
            //请求数据同样可以实现自定义显示条数，但如果为空就显示全部订单，根据个人需要定制，添加如下代码设定默认为10，传递则不生效
            $order->pagination->pageSize = \Yii::$app->request->get('per-page') ? \Yii::$app->request->get('per-page') : 10;

            $order->query = $query;
            $orderList = $order->getModels();
            return $this->renderJsonWithTrue($orderList);
        }*/



        /**
         * 用车记录
         */
        public function actionRecord()
        {
            $token = \Yii::$app->request->get('token');

            //验证当前用户
            $user = User::findIdentityByAccessToken($token);
            if ($user == null) {
                return $this->renderJsonWithFalse('请登录');
            }


            //page => 当前页码  默认值1  第1页是最新订单
            //type => 用车类型  默认为10   必填  10现在用车 20预约用车

            //第几页
            //$page = \Yii::$app->request->get('page', 1);
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $type = \Yii::$app->request->get('type');

            //每页显示2条土
            $pageSize = 2;


            //跳过几条
            $offset = ($page - 1) * $pageSize;

            $list = Order::find()
                ->where(['type' => $type,'member_id'=>$user->id])
                ->limit($pageSize)
                ->offset($offset)
                ->asArray()
                ->all();


            return $this->renderJsonWithTrue($list);

        }

    }



