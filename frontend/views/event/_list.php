<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\EventSearch */
/* @var $form yii\widgets\ActiveForm */
$start=strtotime($model->date_start);
$week=Yii::$app->formatter->asDatetime($start,'ccc');
$month= Yii::$app->formatter->asDatetime($start,'MMM');
$day= Yii::$app->formatter->asDatetime($start,'d');
$start_time= Yii::$app->formatter->asDatetime($start,'H:mm');
$status=$model->getStatus();
$label=$status['msg'];
?>
<div class='event-date list pull-left mr15 rel'>
    <div class='date-day'><?=$week?></div>
    <div class='date-number'><?=$day?></div>
    <div class='date-month'><?=$month?></div>
    <?=Html::a("",['/event/view','id'=>$model->id],['class'=>'false_link']);?>
</div>
<div class="event-info oh">
    <span class="event_label"><?=$label?></span>
    <h4 class="title"><?=Html::a($model->title,['/event/view','id'=>$model->id],['class'=>'darklink']);?></h4>
    <div class="times">
        <?php
        if($status['register']){
            echo Yii::t('app','Starts at');
            echo " <time>".$start_time."</time>";
        }
        ?>
    </div>
</div>
