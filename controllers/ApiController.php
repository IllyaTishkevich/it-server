<?php

namespace app\controllers;

use app\models\Games;
use app\models\ServiceGames;
use app\models\Service;
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

        $result = [];
        $games = Games::find()->all();
        foreach ($games as $game) {
            $gameArr = $game->toArray();
            $gameServices = ServiceGames::findAll(['games_id' => $game->id]);
            foreach ($gameServices as $gameService)
            {
                $gameArr['services'][] = Service::findOne(['id' => $gameService->service_id])->toArray();
            }
            $result[] = $gameArr;
        }

        return $result;

    }

}
