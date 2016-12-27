<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Article*/
?>

<div class='pull-left article-thumb mr20'>
    <?php
    if($model->image){
        $img=Html::img("/images/article/".$model->id."/s_".$model->image,['class'=>'img-responsive']);
        echo Html::a($img,['/article/view','id'=>$model->id],['class'=>'img-responsive rel js_des_list_img']);

    }
    ?>
</div>

<div class="oh">
    <div class="text-uppercase bold blue font12"><?=$model->getLangTitle()?></div>
    <h3 class="mt5"><?=Html::a($model->title,['/article/view','id'=>$model->id],['class'=>'black']); ?></h3>
    <div class="color9 mt10 roboto font13">
        <div class='afterdot pull-left'><?=$model->getAuthors()?></div>
        <time class="date"><?=Yii::$app->formatter->asDate($model->date_create)?></time>
    </div>
</div>