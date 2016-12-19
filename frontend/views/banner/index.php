<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Banners');
$this->params['breadcrumbs'][] = $this->title;
$names=[Yii::t('app','Articles'),Yii::t('app','Events')]
?>
<div class="banner-index container">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Banner'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['attribute' => 'id', 'contentOptions'=>['width'=>80]],
            [
                'attribute' => 'model_name',
                'format' => 'raw',
                'filter' => Html::activeDropDownList($searchModel, 'model_name', $names,['class'=>'form-control']),
            ],
            'model_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
