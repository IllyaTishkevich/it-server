<?php

namespace app\controllers;

use app\models\Games;
use app\models\GamesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\Service;
use app\models\ServiceGames;

/**
 * GamesController implements the CRUD actions for Games model.
 */
class GamesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Games models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GamesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Games model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $serviceGames = ServiceGames::findAll(['games_id' => $id]);
        $services = [];
        foreach ($serviceGames as $serviceGame) {
            $services[] = Service::findOne(['id' => $serviceGame->service_id]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'services' => $services
        ]);
    }

    /**
     * Creates a new Games model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Games();

        if ($this->request->isPost) {
            $model->load($this->request->post());

            $post = $this->request->post();

            $image = UploadedFile::getInstance($model, 'img');
            if($image && $model->upload($image)) {
                // file is uploaded successfully
                $model->img = '/uploads/'.$image->name;
            }

            $model->save();

            if ($post['Service']) {
                foreach ($post['Service'] as $id => $serv) {
                    $serviceGames = ServiceGames::find()->where(['games_id' => $model->id])
                        ->andWhere(['service_id' => $id])->one();

                    if(!$serviceGames) {
                        if ($serv == "1") {
                            $serviceGames = new ServiceGames();
                            $serviceGames->games_id = $model->id;
                            $serviceGames->service_id = $id;
                            $serviceGames->save();
                        }
                    } else {
                        if ($serv == "0") {
                            $serviceGames->delete();
                        }
                    }

                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->loadDefaultValues();
        }
        $services = Service::find()->all();

        return $this->render('create', [
            'model' => $model,
            'services' => $services,
        ]);
    }

    /**
     * Updates an existing Games model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost ) {
            $model->load($this->request->post());

            $post = $this->request->post();

            $image = UploadedFile::getInstance($model, 'img');
            if($image && $model->upload($image)) {
                // file is uploaded successfully
                $model->img = '/uploads/'.$image->name;
            }

            $model->save();

            if ($post['Service']) {
                foreach ($post['Service'] as $id => $serv) {
                    $serviceGames = ServiceGames::find()->where(['games_id' => $model->id])
                        ->andWhere(['service_id' => $id])->one();

                    if(!$serviceGames) {
                        if ($serv == "1") {
                            $serviceGames = new ServiceGames();
                            $serviceGames->games_id = $model->id;
                            $serviceGames->service_id = $id;
                            $serviceGames->save();
                        }
                    } else {
                        if ($serv == "0") {
                            $serviceGames->delete();
                        }
                    }

                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        $services = Service::find()->all();
        $serviceGames = ServiceGames::findAll(['games_id' => $model->id]);
        $checked = [];
        foreach ($serviceGames as $serviceGame) {
            $checked[] = $serviceGame->service_id;
        }
        return $this->render('update', [
            'model' => $model,
            'services' => $services,
            'checked' => $checked
        ]);
    }

    /**
     * Deletes an existing Games model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Games model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Games the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Games::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUploadImage() {
        $model = new \app\models\Games();
        if (Yii::$app->request->isPost) {
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->upload()) {
                // file is uploaded successfully
                echo "File successfully uploaded";
                return;
            }
        }
        return $this->render('upload', ['model' => $model]);
    }
}
