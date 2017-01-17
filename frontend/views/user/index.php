<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Users');
$this->params['breadcrumbs'][] = $this->title;
$status=[0=>"Deleted",10=>'Active'];
?>
<div class="user-index container">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app','Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'id',
                'contentOptions'=>['width'=>80]
            ],
            'username',
             'email:email',
            // 'created_at',
            // 'updated_at',
            [
                'attribute'=>'status',
                'format'=>'raw',
                'value'=>function($model)use($status){
                    return $status[$model->status];
                }
            ],
            'role',

            ['class' => 'yii\grid\ActionColumn','contentOptions'=>['width'=>80]],
        ],
    ]); ?>
</div>
