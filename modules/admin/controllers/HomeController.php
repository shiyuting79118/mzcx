<?php

namespace app\modules\admin\controllers;


class HomeController extends BaseController
{

    public function actionIndex()
    {
        return $this->render('index');

    }
}