<?php

namespace app\modules\wechat\controllers;

use app\modules\wechat\Module;
use PFinal\Http\Client;
use yii\web\Controller;


class OrderController extends Controller
{

    public $layout = 'main';

    //用车记录
    public function actionRecord()
    {
        return $this->render('record');
    }

    //我的预约
    public function actionReserve()
    {
        return $this->render('reserve');
    }

    //现在用车
    public function actionOrderNow()
    {
        include_once \Yii::$app->basePath . '/http/Client.php';
        include_once \Yii::$app->basePath . '/http/Response.php';

        $client = new Client();
        $response = $client->get(Module::apiUrl('api/vehicle/grade'));
        $json = $response->getBody();
        //echo $json;exit;

        $arr = json_decode($json, true);//true 转数组
        //var_dump($arr);exit;

        return $this->render('order-now', [
            'data' => $arr['data']
        ]);
    }

    //预约用车
    public function actionOrderAfter()
    {

        include_once \Yii::$app->basePath . '/http/Client.php';
        include_once \Yii::$app->basePath . '/http/Response.php';

        $client = new Client();
        $response = $client->get(Module::apiUrl('api/vehicle/grade'));
        $json = $response->getBody();
        //echo $json;exit;

        $arr = json_decode($json, true);//true 转数组
        //var_dump($arr);exit;

        return $this->render('order-after', [
            'data' => $arr['data']
        ]);
    }

    //订单列表
    public function actionOrderList(){
        return $this->render('order-list');
    }

    //预约订单详情
    public function actionOrderAfterDetail(){
        $token= $_GET['token'];
        //echo $token;exit;
       // $orderId=$_GET['order_id'];
        $orderId=2;

        include_once \Yii::$app->basePath . '/http/Client.php';
        include_once \Yii::$app->basePath . '/http/Response.php';
        //获取订单详情
        $client = new Client();
        $response = $client->get(Module::apiUrl('api/order/detail?token='.$token.'&order-id='.$orderId));
        $json = $response->getBody();
        //echo $json;exit;

        $arr = json_decode($json, true);//true 转数组
        //var_dump($arr);exit;
        return $this->render('order-after-detail', [
            'data' => $arr['data']
        ]);

        //return $this->render('order-after-detail');
    }

    //订单评论
    public function actionComment()
    {
        //var_dump($_GET);exit;
        //var_dump($_POST);exit;
        $token= $_GET['token'];
        $orderId=25;

        include_once \Yii::$app->basePath . '/http/Client.php';
        include_once \Yii::$app->basePath . '/http/Response.php';
        //获取订单详情
        $client = new Client();
        $response = $client->get(Module::apiUrl('api/order/detail?token='.$token.'&order-id='.$orderId));
        $json = $response->getBody();
        //echo $json;exit;

        $arr = json_decode($json, true);//true 转数组
        //var_dump($arr);exit;
        return $this->render('comment', [
            'data' => $arr['data']
        ]);
        //return $this->render('comment');
    }

    //现在用车下单成功，跳转到成功页面
   public function actionSuccess()
    {
        return $this->render('success');
    }

}
