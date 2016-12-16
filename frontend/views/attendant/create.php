<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Attendant */

$this->title = Yii::t('app', 'Create Attendant');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Attendants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendant-create container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
