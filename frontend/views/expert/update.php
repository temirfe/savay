<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Expert */

$this->title = Yii::t('app', 'Update', [
    'modelClass' => 'Expert',
]).': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Experts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="expert-update container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
