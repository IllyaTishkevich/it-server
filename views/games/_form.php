<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Games */
/* @var $form yii\widgets\ActiveForm */
/* @var $services array */
/* @var $checked array */
?>

<div class="games-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'img')->fileInput() ?>

    <h6>Services</h6>
    <?php foreach ($services as $service) : ?>
        <?=$form->field($service, 'name')->checkbox(['label'=>"<span class='service-name'>$service->name</span>",
            'checked' => in_array($service->id, $checked), 'name'=>"Service[$service->id]"]); ?>
    <?php endforeach; ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
