<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Attendant */

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Attendants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendant-view container">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [                      // the owner name of the model
                'attribute' => 'event_id',
                'format'=>'raw',
                'value' => Html::a($model->event->title,['/event/view','id'=>$model->event_id]),
            ],
            'fullname',
            'email:email',
            'phone',
            'organization',
            'job_title',
            'date_create',
        ],
    ]) ?>

</div>
