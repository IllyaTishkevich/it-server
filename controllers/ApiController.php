<?php

namespace app\controllers;

use app\models\Games;
use app\models\ServiceGames;
use app\models\Service;
use app\models\User;
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

    public function actionRegister()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $params = $request->get();
        if (isset($params['login']) && isset($params['password']) && $params['email']) {
            $user = User::findOne(['username' => $params['login']]);
            if ($user) {
                return ['error' => 'User alredy exist'];
            } else {
                $user = new User();
                $user->username = $params['login'];
                $user->password_hash = md5($params['password']);
                $user->email = $params['email'];
                $user->generateAuthKey();
                $user->created_at = time();
                $user->updated_at = time();
                $user->save(false);

                return $user->auth_key;
            }
        }
        return ['error' => 'Something went wrong.'];
    }

    public function actionUser()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $params = $request->get();
        if (isset($params['token'])) {
            $user = User::findOne(['auth_key' => $params['token']]);
            if ($user) {
                $result = $user->toArray();
                unset($result['password_hash']);
                unset($result['password_reset_token']);

                return $result;
            }
        }
        return ['error' => 'Something went wrong.'];
    }

    public function actionLogin()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $params = $request->get();
        if (isset($params['login']) && isset($params['password'])) {
            $user = User::findOne(['username' => $params['login'], 'password_hash' => md5($params['password'])]);
            if ($user) {
                $user->generateAuthKey();
                $user->updated_at = time();
                $user->save(false);

                return $user->auth_key;
            }
        }
        return ['error' => 'Something went wrong.'];
    }

    protected function generateKey($length = 16) {
        $max = ceil($length / 40);
        $random = '';
        for ($i = 0; $i < $max; $i ++) {
            $random .= sha1(microtime(true).mt_rand(10000,90000));
        }
        return substr($random, 0, $length);
    }
}
