<?php

    namespace app\models;

    use Yii;

    /**
     * This is the model class for table "{{%grade}}".
     *
     * @property string $id
     * @property string $name
     * @property string $flag_fall
     * @property string $km_price
     * @property integer $weight
     * @property integer $status
     * @property integer $created_at
     * @property integer $updated_at
     */
    class Grade extends \yii\db\ActiveRecord
    {
        // 10有效  90 删除
        const STATUS_YES = 10;
        const STATUS_NO = 90;

        /**
         * @inheritdoc
         */
        public static function tableName()
        {
            return '{{%grade}}';
        }

        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                [['flag_fall', 'km_price'], 'number'],
                [['flag_fall', 'km_price'], 'required'],
                [['weight', 'status', 'created_at', 'updated_at'], 'integer'],
                [['name'], 'string', 'max' => 255],
                [['name',], 'required', 'on' => 'grade']
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels()
        {
            return [
                'id' => 'ID',
                'name' => '等级名称',
                'flag_fall' => '起步价',
                'km_price' => '每公里单价',
                'weight' => '排序',
                'status' => '状态',
                'created_at' => '新增时间',
                'updated_at' => '修改时间',
            ];
        }
    }



