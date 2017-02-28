<?php

namespace app\modules\admin\controllers;

use app\models\Order;
use yii\data\ActiveDataProvider;

class OrderController extends BaseController
{
    public function actionIndex()
    {
        //用升序排到的方式查出订单表
        $query = Order::find()->orderBy(['id' =>SORT_ASC]);

        $dataProvider = new ActiveDataProvider();

        $dataProvider->query = $query;

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    //查看详情表
    public function actionView($id)
    {
        //echo $id;
        $query = Order::find()->where('id = '.$id);

        $dataProvider = new ActiveDataProvider();

        $dataProvider->query = $query;

        return $this->render('view', [
            'dataProvider' => $dataProvider
        ]);
    }
}