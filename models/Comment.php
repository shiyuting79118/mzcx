<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%comment}}".
 *
 * @property string $id
 * @property string $member_id
 * @property string $driver_id
 * @property string $order_id
 * @property integer $star
 * @property string $content
 * @property integer $created_at
 * @property integer $updated_at
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'driver_id', 'order_id', 'star', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id' => '会员ID',
            'driver_id' => '司机ID',
            'order_id' => '订单ID',
            'star' => '评论等级',
            'content' => '评论内容',
            'created_at' => '新增时间',
            'updated_at' => '修改时间',
        ];
    }

    /**
     * 当前对象关联的司机
     * @return null|User
     */
    public function getUser()
    {
        return User::findOne($this->member_id);
    }
}
