<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Expert */

$this->title = Yii::t('app', 'Create Expert');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Experts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expert-create container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
