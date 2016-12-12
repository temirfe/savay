<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Expert */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Experts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expert-view container">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
        echo Html::img("@web/images/expert/".$model->id."/s_".$model->image,['class'=>'round'])
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description',
            'email:email',
            'phone',
            'text:ntext',
            'image',
            'expertise_areas',
            'current_positions',
            'past_positions',
            'education',
            'cv',
        ],
    ]) ?>

</div>
