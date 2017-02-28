<?php

namespace app\modules\admin\controllers;

use app\models\Comment;
use yii\data\ActiveDataProvider;

class CommentController extends BaseController
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        $query = Comment::find()->orderBy(['id' =>SORT_ASC]);

        $dataProvider = new ActiveDataProvider();

        $dataProvider->query = $query;

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);

    }
}