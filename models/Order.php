<?php

    namespace app\models;

    use Yii;

    /**
     * This is the model class for table "{{%order}}".
     *
     * @property string $id
     * @property integer $type
     * @property string $member_id
     * @property string $out_trade_no
     * @property string $pickup
     * @property double $pickup_longitude
     * @property double $pickup_latitude
     * @property string $destination
     * @property double $destination_longitude
     * @property double $destination_latitude
     * @property integer $desire_grade_id
     * @property string $plan_at
     * @property string $driver_id
     * @property string $vehicle_id
     * @property string $on_at
     * @property double $on_longitude
     * @property double $on_latitude
     * @property string $off_at
     * @property double $off_longitude
     * @property double $off_latitude
     * @property integer $grade_id
     * @property string $distance
     * @property string $total_fee
     * @property integer $status
     * @property integer $pay_type
     * @property integer $payment_status
     * @property integer $comment_status
     * @property integer $created_at
     * @property integer $updated_at
     */
    class Order extends \yii\db\ActiveRecord
    {

        /*10新订单 20确认接单、30成功完成订单、40客户取消、50司机取消*/
        const STATUS_NEW = 10;
        const STATUS_CONFIRM = 20;
        const STATUS_SUCCESS = 30;
        const STATUS_USER_CANCEL = 40;     //客户取消
        const STATUS_DRIVER_CANCEL = 90;

        const TYPE_NOW = 10;//现在用车
        const STATUS_BESPOKE = 20;//预约用车

        public static function tableName()
        {
            return '{{%order}}';
        }

        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                [['type', 'member_id', 'desire_grade_id', 'plan_at', 'driver_id', 'vehicle_id', 'on_at', 'off_at', 'grade_id', 'distance', 'total_fee', 'status', 'pay_type', 'payment_status', 'comment_status', 'created_at', 'updated_at'], 'integer'],
                [['pickup_longitude', 'pickup_latitude', 'destination_longitude', 'destination_latitude', 'on_longitude', 'on_latitude', 'off_longitude', 'off_latitude'], 'number'],
                [['out_trade_no'], 'string', 'max' => 32],
                [['pickup', 'destination'], 'string', 'max' => 255],
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels()
        {
            return [
                'id' => 'ID',
                'type' => '订单类型',
                'member_id' => '会员ID',
                'out_trade_no' => '订单号',
                'pickup' => '计划在哪上车',
                'pickup_longitude' => '经度',
                'pickup_latitude' => '纬度',
                'destination' => '计划去哪儿',
                'destination_longitude' => '经度',
                'destination_latitude' => '纬度',
                'desire_grade_id' => '期望车型等级',
                'plan_at' => '计划何时出发',
                'driver_id' => '司机ID',
                'vehicle_id' => '车辆ID',
                'on_at' => '上车时间',
                'on_longitude' => '经度',
                'on_latitude' => '纬度',
                'off_at' => '下车时间',
                'off_longitude' => '经度',
                'off_latitude' => '纬度',
                'grade_id' => '结算车型等级',
                'distance' => '行驶里程(米)',
                'total_fee' => '总费用',
                'status' => '订单状态',
                'pay_type' => '支付方式',
                'payment_status' => '支付状态',
                'comment_status' => '评论状态',
                'created_at' => '新增时间',
                'updated_at' => '修改时间',
            ];
        }

        //==============后台部分============================================
        public function statusAlias($returnAll = false)
        {
            $arr = [
                self::STATUS_NEW =>'新订单',
                self::STATUS_CONFIRM =>'确认接单',
                self::STATUS_SUCCESS =>'完成订单',
                self::STATUS_USER_CANCEL =>'客户取消',
                self::STATUS_DRIVER_CANCEL =>'司机取消',

            ];

            if ($returnAll) {
                return $arr;
            }

            return array_key_exists($this->status, $arr) ? $arr[$this->status] : null;
        }


        //=================API接口部分====================================================

        //根据用户id查找用户订单
       /* public static function findOrderByUserId($id)
        {
            //echo 111;
            return Order::find()->where(['id' => $id, 'status' => self::STATUS_NEW])->all();
        }*/

        //通过订单号取消新订单
        public static function cancelOrderByOrderId($id)
        {
            $order = Order::findOne($id);

            $status = Order::STATUS_USER_CANCEL;
            $order->status = $status;
            if ($order->save()) {
                return true;
            } else {
                return false;
            }
        }
    }
