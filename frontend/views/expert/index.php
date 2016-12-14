<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ExpertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Experts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expert-index container">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Expert'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['attribute' => 'id', 'contentOptions'=>['width'=>80]],
            'title',
            'description',
            'email:email',
            'phone',
            // 'text:ntext',
            // 'image',
            // 'expertise_areas',
            // 'current_positions',
            // 'past_positions',
            // 'education',
            // 'cv',

            ['class' => 'yii\grid\ActionColumn', 'contentOptions'=>['width'=>80]],
        ],
    ]); ?>
</div>
