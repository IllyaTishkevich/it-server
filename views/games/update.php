<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Games */
/* @var $services array */
/* @var $checked array */

$this->title = 'Update Games: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Games', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="games-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'services' => $services,
        'checked' => $checked
    ]) ?>

</div>
