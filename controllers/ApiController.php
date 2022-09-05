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
                $data = Service::findOne(['id' => $gameService->service_id])->toArray();
                $data['id'] = $gameService->id;
                $gameArr['services'][] = $data;
            }
            $result[] = $gameArr;
        }

        return $result;

    }

    public function actionGame()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $request = Yii::$app->request;
        $params = $request->get();
        $id = $params['id'];

        $game = Games::findOne(['id' => $id]);

        $gameArr = $game->toArray();
        $gameServices = ServiceGames::findAll(['games_id' => $game->id]);
        foreach ($gameServices as $gameService)
        {
            $data = Service::findOne(['id' => $gameService->service_id])->toArray();
            $data['id'] = $gameService->id;
            $gameArr['services'][] = $data;
        }

        return $gameArr;

    }

    public function actionLots()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $request = Yii::$app->request;
        $params = $request->get();
        $id = $params['id'];

        $game = ServiceGames::findOne(['id' => $id]);

        return $game;
    }

}
