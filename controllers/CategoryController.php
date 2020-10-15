<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Category;

class CategoryController extends Controller
{
    public function actionIndex()
    {
        $models = Category::find();
        $count = $models->count();

        $context = [
            'site' => 'Categories',
            'page' => 'Categories',
            'models' => $models->all(),
            'count' => $count,
        ];

        return $this->render('index', $context);
    }
}
