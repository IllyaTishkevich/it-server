<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Games */
/* @var $services array */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Games', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="games-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
        <tr>
            <th>ID</th>
            <td><?=$model->id?></td>
        </tr>
        <tr>
            <th>Name</th>
            <td><?=$model->name?></td>
        </tr>
        <tr>
            <th>Description</th>
            <td><?=$model->description?></td>
        </tr>
        <tr>
            <th>Img</th>
            <td>
                <?php if($model->img) : ?>
                    <img src="./<?=$model->img?>">
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Services</th>
            <td>
                <ol>
                <?php foreach ($services as $service) : ?>
                    <li>
                        <?=$service->name?>
                    </li>
                <?php endforeach;?>
                </ol>
            </td>
        </tr>
        </tbody>
    </table>

</div>
