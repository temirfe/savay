<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$author='';
$author2='';
$author3='';
$and1='';
$and2='';
if($model->expert_id){ $author=$model->expert->title; }
if($model->expert2_id){$and1=" ".Yii::t('app','and')." "; $author2=$model->expert2->title; }
if($model->expert3_id){$and1=", "; $and2=" ".Yii::t('app','and')." "; $author3=$model->expert3->title; }
$authors=$author.$and1.$author2.$and2.$author3;
?>
<div class="article-view">

    <div class="slider_wrap">
        <div class="slider"><?=Html::img('/images/article/'.$model->id.'/'.$model->image)?></div>
        <div class="slider_title">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <div class="container">
        <?php
            if($authors) echo "<div class='afterdot pull-left'>".$authors.'</div>';
            echo "<div>".Yii::$app->formatter->asDate($model->date_create)."</div>";
        ?>
        <?=$model->text;?>
        <?=$model->footnotes;?>
    </div>

</div>
