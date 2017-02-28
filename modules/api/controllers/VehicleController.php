<?php
    namespace app\modules\api\controllers;

    use app\controllers\Controller;
    use app\models\Grade;

    class VehicleController extends Controller
    {
        public $enableCsrfValidation = false;

        public function actionGrade()
        {
            $grade = new Grade();
            $grade->scenario = 'grade';
            $gradeList = Grade::find()->where('status != :status', ['status' => Grade::STATUS_NO])->asArray()->all();

            if ($gradeList) {
                //这里查询出来所有的数据   如果想要其中某几个数据可以foreach 拿出来
                return $this->renderJsonWithTrue($gradeList);
                //var_dump($gradeList);exit;
            }
            return $this->renderJsonWithFalse('等级不存在，请刷新再试');
        }
    }

