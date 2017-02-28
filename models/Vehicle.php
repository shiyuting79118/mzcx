<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%vehicle}}".
 *
 * @property string $id
 * @property string $driver_id
 * @property integer $grade_id
 * @property string $brand
 * @property string $model
 * @property string $color
 * @property string $plate
 * @property string $photo
 * @property integer $status
 * @property double $longitude
 * @property double $latitude
 * @property integer $created_at
 * @property integer $updated_at
 */
class Vehicle extends \yii\db\ActiveRecord
{
    //10停止接单 20允许接单 30正在处理订单 90为标记删除
    const STATUS_STOP = 10;
    const STATUS_ALLOW = 20;
    const STATUS_ING = 30;
    const STATUS_DEL = 90;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%vehicle}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['driver_id', 'grade_id', 'status'], 'integer'],
            [['brand', 'color', 'plate'], 'string', 'max' => 10],
            [['model','photo'], 'string', 'max' => 255],
            //必填
            [['driver_id','grade_id','brand','model','color','plate'],'required','on'=>'vehicle']

            //文件上传和图片名称验证
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'driver_id' => '司机ID',
            'grade_id' => '车型等级',
            'brand' => '品牌',
            'model' => '车型',
            'color' => '颜色',
            'plate' => '车牌',
            'photo' => '照片',
            'status' => '状态',
            'longitude' => '经度',
            'latitude' => '纬度',
            'created_at' => '新增时间',
            'updated_at' => '修改时间',
        ];
    }

    /**
     * @param bool $returnAll
     * @return array|null
     */
    public function statusAlias($returnAll = false)
    {
        $arr = [
            //10停止接单 20允许接单 30正在处理订单 90为标记删除

            self::STATUS_STOP => '停止接单',
            self::STATUS_ALLOW => '允许接单',
            self::STATUS_ING => '正在处理',
        ];

        if ($returnAll) {
            return $arr;
        }
        return array_key_exists($this->status, $arr) ? $arr[$this->status] : null;
    }

    /**
     * 当前对象关联的司机
     * @return null|User
     */
    public function getDriver()
    {
        return User::findOne($this->driver_id);
    }


    public function getGrade()
    {
        return Grade::findOne($this->grade_id);
    }

    
}
