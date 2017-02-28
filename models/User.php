<?php

    namespace app\models;

    use Yii;
    use yii\helpers\Html;
    use yii\web\IdentityInterface;

    /**
     * This is the model class for table "{{%user}}".
     *
     * @property string $id
     * @property string $username
     * @property string $mobile
     * @property string $email
     * @property string $password_hash
     * @property string $password_salt
     * @property string $remember_token
     * @property string $openid
     * @property string $nickname
     * @property string $avatar
     * @property integer $status
     * @property integer $created_at
     * @property integer $updated_at
     */
    class User extends \yii\db\ActiveRecord implements IdentityInterface
    {
        //注释...
        const STATUS_YES = 10;//正常
        const STATUS_NO = 20;//冻结
        const STATUS_WAR = 30;//异常
        const STATUS_DELETE = 90;//删除

        /**
         * @inheritdoc
         */
        public static function tableName()
        {
            return '{{%user}}';
        }

        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                [['status', 'created_at', 'updated_at'], 'integer'],
                [['username', 'mobile', 'email', 'password_hash', 'password_salt', 'remember_token', 'openid', 'nickname', 'avatar'], 'string', 'max' => 255],

                //司机
                [['email', 'username', 'status'], 'required', 'message' => '{attribute}不能为空', 'on' => 'driver'],
                [['username',], 'string', 'length' => [3, 12], 'on' => 'driver'],
                [['email',], 'email', 'on' => 'driver'],
                [['status',], 'in', 'range' => array_keys($this->statusAlias(true)), 'on' => 'driver'],

                //前台会员注册
                [['nickname', 'mobile'], 'required', 'message' => '{attribute}不能为空', 'on' => 'register'],
                [['nickname',], 'string', 'length' => [2, 10], 'on' => 'register'],
                ['mobile', 'unique', 'on' => 'register'],

                //前台会员注册
                [['nickname', 'mobile'], 'required', 'message' => '{attribute}不能为空', 'on' => 'login'],
                [['nickname',], 'string', 'length' => [2, 10], 'on' => 'login'],
                ['mobile', 'unique', 'on' => 'login'],

            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels()
        {
            return [
                'id' => 'ID',
                'username' => '登录帐号',
                'mobile' => '手机',
                'email' => '邮箱',
                'password_hash' => '密码Hash',
                'password_salt' => '密码Salt',
                'remember_token' => '记住我Token',
                'openid' => '微信Openid',
                'nickname' => '昵称',
                'avatar' => '头像',
                'status' => '状态',
                'created_at' => '新增时间',
                'updated_at' => '修改时间',
            ];
        }


        public static function adminLogin($username, $password, $rememberMe)
        {
            $user = self::findUserByNameAndPassword($username, $password);

            //判断用户是否admin管理员
            if ($user != null && $user->isAdmin()) {
                Yii::$app->user->login($user, $rememberMe ? 60 * 60 * 24 * 30 : 0);
                return true;
            }
            return false;
        }


        /**
         * 判断用户是否admin管理员
         * @return bool
         */
        public function isAdmin()
        {
            $sql = 'SELECT COUNT(*) FROM {{%admin_user}} WHERE user_id = :userId';
            return 1 == Yii::$app->db->createCommand($sql, ['userId' => $this->id])->queryScalar();
            /*$count = Yii::$app->db->createCommand($sql, ['userId' => $this->id])->queryScalar();
            if($count == 1){
                return true;
            }else{
                return false;
            }*/
        }

        /**
         * 判断用户是否司机
         * @return bool
         */
        public function isDriver()
        {
            $sql = 'SELECT COUNT(*) FROM {{%driver}} WHERE user_id = :userId';
            return 1 == Yii::$app->db->createCommand($sql, ['userId' => $this->id])->queryScalar();
        }

        /**
         * 将用户设置为司机
         * @return bool
         * @throws \yii\db\Exception
         */
        public function setIsDriver()
        {
            $sql = 'INSERT INTO {{%driver}} (user_id,created_at,updated_at) VALUES (:id,:c,:u)';

            return 1 == Yii::$app->db->createCommand($sql, ['id' => $this->id, 'c' => time(), 'u' => time()])->execute();
            //$row = Yii::$app->db->createCommand($sql, ['id' => $this->id, 'c' => time(), 'u' => time()])->execute();

            /*if ($row == 1) {
                return true;
            }
            return false;*/

            //return $row ==1;

        }


        /**
         * 前台登录(普通用户)
         * @param string $username 用户名
         * @param string $password 密码
         * @return bool 成功返回true，失败返回false
         */
        public static function login($username, $password)
        {
            $user = self::findUserByNameAndPassword($username, $password);
            if ($user != null) {
                Yii::$app->user->login($user);
                return true;
            }
            return false;
        }

        /**
         * 通过用户名和密码查找用户
         * @param $username
         * @param $password
         * @return User|null
         */
        public static function findUserByNameAndPassword($username, $password)
        {
            // 查用户名是否存在

            /* @var $user User */
            $user = self::find()
                ->where('username=:username and status=:status', [
                    'username' => $username,
                    'status' => self::STATUS_YES
                ])->one();

            if ($user == null) {
                return null;
            }

            //
            if ($user->password_hash == self::makePasswordHash($password, $user->password_salt)) {
                return $user;
            }

            return null;
        }

        public static function makePasswordHash($password, $salt)
        {
            return md5($password . $salt);
        }

        /**
         * @param int|string $id
         * @return null|static
         */
        public static function findIdentity($id)
        {
            return self::findOne(['id' => $id, 'status' => self::STATUS_YES]);
        }


        //根据accessToken查找用户
        public static function findIdentityByAccessToken($token, $type = null)
        {
            return User::find()->where(['access_token' => $token, 'status' => self::STATUS_YES])->one();
        }

        public function getId()
        {
            return $this->id;
        }

        //记住我
        public function getAuthKey()
        {
            return $this->remember_token;
        }

        //记住我
        public function validateAuthKey($authKey)
        {
            return $authKey == $this->remember_token;
        }


        public function statusAlias($returnAll = false)
        {
            $arr = [
                self::STATUS_YES => '正常',
                self::STATUS_WAR => '异常',
                self::STATUS_NO => '禁用',
            ];

            if ($returnAll) {
                return $arr;
            }

            return array_key_exists($this->status, $arr) ? $arr[$this->status] : null;
        }

        public static function findDriver()
        {
            $sql = "SELECT * FROM {{%driver}}";
            return $driverList = Yii::$app->db->createCommand($sql)->queryAll();
        }


        //API接口

        //通过手机号码查找用户
        public static function findUserByMobileAndPassword($mobile, $password)
        {
            /* @var $user User */
            $user = self::find()
                ->where('mobile=:mobile and status=:status', [
                    'mobile' => $mobile,
                    'status' => self::STATUS_YES
                ])->one();

            if ($user == null) {
                return null;
            }

            //
            if ($user->password_hash == self::makePasswordHash($password, $user->password_salt)) {
                return $user;
            }
            return null;
        }

        public static function findUserByMobile($mobile)
        {
            /* @var $user User */
            $user = self::find()
                ->where('mobile=:mobile and status=:status', [
                    'mobile' => $mobile,
                    'status' => self::STATUS_YES
                ])->one();

            if ($user == null) {
                return null;
            }

           /* //
            if ($user->password_hash == self::makePasswordHash($password, $user->password_salt)) {
                return $user;
            }*/
            return null;
        }


    }
