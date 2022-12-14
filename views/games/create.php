<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Games */
/* @var $services array */

$this->title = 'Create Games';
$this->params['breadcrumbs'][] = ['label' => 'Games', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="games-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'services' => $services,
        'checked' => []
    ]) ?>

</div>
