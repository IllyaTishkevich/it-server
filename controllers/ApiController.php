<?php

namespace app\controllers;

use app\models\Games;
use \Yii;
use yii\web\Response;

class ApiController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGames()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $games = Games::find()->all();
        return [$games];

    }

}
