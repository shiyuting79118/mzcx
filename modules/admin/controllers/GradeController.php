<?php

namespace app\modules\admin\controllers;

use app\models\Grade;
use yii\web\HttpException;
use yii\data\ActiveDataProvider;
class GradeController extends BaseController
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        //用升序排到的方式查出车辆等级表
        $query = Grade::find()->where('status != 90')->orderBy(['id' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider();

        $dataProvider->query = $query;

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * 新增车辆等级
     */
    public function actionCreate()
    {
        $grade = new Grade();
        $grade->loadDefaultValues();
        if (\Yii::$app->request->isPost) {

            $grade->scenario = 'grade';

            $grade->name = \Yii::$app->request->post('name');
            $grade->flag_fall = \Yii::$app->request->post('flag_fall');
            $grade->km_price = \Yii::$app->request->post('km_price');

            if ($grade->save()) {
                return $this->redirectWithSuccess('新增成功');
            }
            $grade->firstErrors;
            return $this->redirectWithError('新增失败');
        }

        return $this->render('create', [
            'grade' => $grade
        ]);
    }

    //删除等级
    public function actionDelete($id)
    {
        $grade = Grade::findOne($id);
        if($grade == null)
        {
            throw new HttpException('404','等级不存在');
        }

        $grade->status = Grade::STATUS_NO;
        if ($grade->save()) {
            return $this->redirectWithSuccess('删除成功');

        }
        return $this->redirectWithError('删除失败');
    }

    //等级修改
    public function actionUpdate($id)
    {
        //echo $id;
        //$gradeId = $id;

        $grade = Grade::findOne($_GET['id']);
        //$grade->loadDefaultValues();
        if(\Yii::$app->request->isPost){
            $grade->name = \Yii::$app->request->post('name');
            $grade->flag_fall = \Yii::$app->request->post('flag_fall');
            $grade->km_price = \Yii::$app->request->post('km_price');

            if ($grade->save()){
                return $this->redirectWithSuccess('修改成功');
                //return $this->render('index',['grade' => $grade]);

            }
            $grade->firstErrors;
            return $this->redirectWithError('修改失败');
        }

        $grade =self::findGrade($id);
        return $this->render('update', [
            'grade' => $grade
        ]);
    }

    /**
     * @param $id
     * @return grade|null
     * @throws HttpException
     */
    protected function findGrade($id)
    {
        $grade = Grade::find()->where('id=:id and status!=:status',
            ['id' => $id, 'status' => Grade::STATUS_NO])->one();
        if ($grade == null) {
            throw new HttpException(404, '等级不存在');
        }
        return $grade;
    }

}