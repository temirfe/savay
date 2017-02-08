<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AttendantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Attendants');
$this->params['breadcrumbs'][] = $this->title;
$rows=Yii::$app->db->createCommand("SELECT id,title FROM event")->queryAll();
$events=ArrayHelper::map($rows,'id','title');
?>
<div class="attendant-index pl40 mr20">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Attendant'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['attribute' => 'id', 'contentOptions'=>['width'=>80]],
            [
                'attribute' => 'event_id',
                'format' => 'raw',
                /*'value' => function($model) use($events) {
                    return $events[$model->event_id];
                },*/
                'filter' => Html::activeDropDownList($searchModel, 'event_id', $events,['class'=>'form-control','prompt' => 'All']),
                'contentOptions'=>['width'=>250]
            ],
            'fullname',
            'email',
            'organization',
            'date_create',

            ['class' => 'yii\grid\ActionColumn', 'contentOptions'=>['width'=>80]],
        ],
    ]); ?>
</div>
