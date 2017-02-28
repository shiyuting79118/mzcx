<?php

namespace app\modules\admin\controllers;

use app\models\Grade;
use app\models\UploadForm;
use app\models\User;
use app\models\Vehicle;
use yii\data\ActiveDataProvider;
use yii\web\HttpException;
use yii\web\UploadedFile;

class VehicleController extends BaseController
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        //用升序排到的方式查出车辆表
        $query = Vehicle::find()->where('status != 90')->orderBy(['id' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider();

        $dataProvider->query = $query;

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws HttpException
     *
     */
    public function actionDelete($id)
    {
        //找车辆Id 来删除车辆
        $vehicle = Vehicle::findOne($id);
        if($vehicle == null)
        {
            throw new HttpException('404','车辆不存在');
        }

        //车辆id存在  删除
        $vehicle->status = Vehicle::STATUS_DEL;

        if ($vehicle->save()) {

            return $this->redirectWithSuccess('删除成功');
        }
        return $this->redirectWithError('删除失败');
    }

    /**
     * 新增车辆
     * @return string
     */
    public function actionCreateVehicle()
    {
        $vehicle = new Vehicle();
        $vehicle->loadDefaultValues();
        $gradeList = Grade::find()->all();
        $driverList = User::find()->all();
        if (\Yii::$app->request->isPost) {
            $vehicle->scenario = 'vehicle';

            $uploadForm = new UploadForm();
            $uploadForm->imageFile = UploadedFile::getInstanceByName('imageFile');

            if (!$uploadForm->validate()) {
              var_dump( $uploadForm->getFirstErrors());exit;
//                return $this->redirectWithError("文件上传失败");
            }

            $filename = $uploadForm->upload('vehicle');
            if (!$filename) {
                return $this->redirectWithError("文件上传失败");
            }//获取数据
            $vehicle->driver_id = \Yii::$app->request->post('driver_id');
            $vehicle->grade_id = \Yii::$app->request->post('grade_id');
            $vehicle->status = \Yii::$app->request->post('status');
            $vehicle->brand = \Yii::$app->request->post('brand');
            $vehicle->model = \Yii::$app->request->post('model');
            $vehicle->plate = \Yii::$app->request->post('plate');
            $vehicle->color = \Yii::$app->request->post('color');
            $vehicle->photo = $filename;
            //添加到数据库
            if ($vehicle->save()) {
                return $this->redirectWithSuccess('新增成功');
            }
        }

        return $this->render('create-vehicle',
            [
                'vehicle' => $vehicle,
                'gradeList' => $gradeList,
                'driverList' => $driverList
            ]);
    }
}