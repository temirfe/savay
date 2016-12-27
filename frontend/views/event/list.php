<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ExpertSearch */
/* @var $upcomingDataProvider yii\data\ActiveDataProvider */
/* @var $pastDataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Events').' | '.Yii::t('app','CPLR');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expert-index container">

    <h1><?= Yii::t('app', 'Events') ?></h1>

    <h3><?=Yii::t('app','Upcoming events'); ?></h3>

    <?= ListView::widget([
        'dataProvider' => $upcomingDataProvider,
        'itemOptions' => ['class' => 'item col-md-6 mb10 mt10'],
        'emptyText' => Yii::t('app', 'No results found'),
        'summary'=>'',
        'options'=>['class'=>'item-view row'],
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_list',['model' => $model]);
        },
    ]) ?>

    <h3><?=Yii::t('app','Past events'); ?></h3>
    <?= ListView::widget([
        'dataProvider' => $pastDataProvider,
        'itemOptions' => ['class' => 'item col-md-6 mb10 mt10'],
        'emptyText' => Yii::t('app', 'No results found'),
        'summary'=>'',
        'options'=>['class'=>'item-view row'],
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_list',['model' => $model]);
        },
    ]) ?>
</div>
